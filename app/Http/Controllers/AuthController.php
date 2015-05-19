<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\AuthenticateUser;
use App\AuthenticateUserListener;

class AuthController extends Controller implements AuthenticateUserListener 
{
    /**
     * Handle user login request
     *
     * @param AuthenticateUser $authenticateUser
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|
     * \Symfony\Component\HttpFoundation\RedirectResponse [type] [description]
     */
	public function login(AuthenticateUser $authenticateUser, Request $request)
	{		
		if (Auth::check())
		{
            if (Auth::user()->confirmed)
            {
                return redirect('search');
            }
            else
            {
                return redirect('confirm');
            }
		}
		return $authenticateUser->execute($request->has('code'), $this, 'facebook');
	}

    public function confirm()
    {
        dd('confirm email motherfucker!');
    }

    /**
     * Handle user logged
     *
     * @param $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector [type] [description]
     */
	public function userHasLoggedIn($user)
	{
        return Redirect::intended();
	}

    /**
     * Handle user logout
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector [type] [description]
     */
	public function logout()
	{
		Auth::logout();
		return redirect('/');
	}

}
