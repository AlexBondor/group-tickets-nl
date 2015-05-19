<?php namespace App;

use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Repositories\UserRepository;
use App\AuthenticateUserListener;
use Illuminate\Contracts\Auth\Guard;

class AuthenticateUser {

	private $socialite;
	private $auth;
	private $usersRepo;

	/**
	 * Called when object initialized
	 * 
	 * @param Socialite      $socialite [description]
	 * @param Guard          $auth      [description]
	 * @param UserRepository $usersRepo     [description]
	 */
	public function __construct(Socialite $socialite, Guard $auth, UserRepository $usersRepo) 
	{   
		$this->socialite = $socialite;
		$this->usersRepo = $usersRepo;
		$this->auth = $auth;
    }

    public function execute($hasCode, $listener, $provider) 
    {
	  	// If not authenticated yet
		if (!$hasCode) 
		{
			return $this->getAuthorizationFirst($provider);	
		}

		$user = $this->usersRepo->findUserOrCreate($this->getSocialUser($provider));
		
		$this->auth->login($user, true);

		return $listener->userHasLoggedIn($user);
    }

    private function getAuthorizationFirst($provider) 
    { 
        return $this->socialite->driver($provider)->redirect();
    }

    private function getSocialUser($provider) 
    {
        return $this->socialite->driver($provider)->user();
    }

}
