<?php namespace App\Repositories;

use App\User;

class UserRepository 
{
	/**
	 * Search user in DB or create him if it doesn't exist
	 * 
	 * @param  [type] $userData [description]
	 * @return [type]           [description]
	 */
	public function findUserOrCreate($userData) 
	{
        $user = User::firstOrCreate([
            'provider_id' => $userData->id,
            'name' => $userData->name,
			'email' => $userData->email,
			'avatar' => $userData->avatar,
			'link' => $userData->user['link']
        ]);

        $this->checkIfUserNeedsUpdating($userData, $user);

        return $user;
    }

    /**
     * Check whether the login data differs from the
     * DB data. If so, update the DB data.
     * 
     * @param  [type] $userData [description]
     * @param  [type] $user     [description]
     * @return [type]           [description]
     */
    public function checkIfUserNeedsUpdating($userData, $user) {

        $socialData = [
            'name' => $userData->name,
			'email' => $userData->email,
			'avatar' => $userData->avatar,
			'link' => $userData->user['link']
        ];
        $dbData = [
            'name' => $user->name,
			'email' => $user->email,
			'avatar' => $user->avatar,
			'link' => $user->user['link']
        ];

        if (!empty(array_diff($socialData, $dbData))) {
            $user->name = $userData->name;
			$user->email = $userData->email;
			$user->avatar = $userData->avatar;
            $user->save();
        }
    }
}