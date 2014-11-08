<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('logout', 'AuthController@doLogout');
Route::group(['before' => 'auth'], function() {
	
Route::get('/', 'UsersController@index');
Route::get('user', 'UsersController@index');

//Facebook
Route::get('facebook', 'FacebookController@index');
Route::get('facebook/here', 'FacebookController@here');
Route::get('doFacebookLogout', 'FacebookController@doFacebookLogout');
Route::post('facebook/doproposepost', 'FacebookController@doProposePost');
Route::get('facebook/disconnect', 'FacebookController@disconnectFacebook');

//Twitter
Route::get('twitter', 'TwitterController@index');
Route::post('twitter/doproposetweet', 'TwitterController@doProposeTweet');
});

Route::get('createrootuser', 'UsersController@createRootUser');

Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@doLogin');

