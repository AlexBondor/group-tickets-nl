<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\AuthenticateUser;
use App\AuthenticateUserListener;

class AuthController extends Controller implements AuthenticateUserListener 
{
	/**
	 * Handle user login request
	 * 
	 * @return [type] [description]
	 */
	public function login(AuthenticateUser $authenticateUser, Request $request)
	{
		if (Auth::check())
		{
			return redirect('home');
		}
		return $authenticateUser->execute($request->has('code'), $this, 'facebook');
	}

	/**
	 * Handle user logged
	 * 
	 * @return [type] [description]
	 */
	public function userHasLoggedIn($user)
	{
		return redirect('home');
	}

	/**
	 * Handle user logout
	 * 
	 * @return [type] [description]
	 */
	public function logout()
	{
		Auth::logout();
		return redirect('/');
	}

}
