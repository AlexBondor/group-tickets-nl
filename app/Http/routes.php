<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/**
 * Welcome screen
 */
Route::get('/', 'WelcomeController@index');

/**
 * Handle user after login
 */
Route::get('home', 'HomeController@index');

/**
 * Groups handling
 */
Route::get('groups', 'GroupController@index');

/**
 * Search handling
 */
Route::get('search', 'SearchController@index');

/**
 * Social authentication
 */
Route::get('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');