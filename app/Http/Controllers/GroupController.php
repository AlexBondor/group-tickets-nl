<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GroupController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display groups that user belongs to
	 * 
	 * @return [type] [description]
	 */
	public function index()
	{
		$my_groups = Auth::user()->groups->sortBy('destination_id');
		return view('groups.index', compact('my_groups'));
	}

}
