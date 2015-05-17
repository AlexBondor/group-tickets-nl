<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Event;
use App\Events\NewCommentEvent;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

    /**
     * Create a new controller instance.
     *
     */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Handle after user login
	 *
	 * @return Response
	 */
	public function index()
    {
        return redirect('search');
    }
}
