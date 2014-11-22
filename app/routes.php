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
Route::get('user/adduser', 'UsersController@getAdduser');
Route::post('user/adduser', 'UsersController@postAdduser');

Route::get('user/{all}', 'UsersController@getProfile');

//Messaging
Route::post('postmessage', 'MessagesController@postMessage');
Route::get('messages', 'MessagesController@index');
Route::get('messages/conversation/{user}', 'MessagesController@getConversation');
//Facebook
Route::get('facebook', 'FacebookController@index');

Route::get('doFacebookLogout', 'FacebookController@doFacebookLogout');
Route::post('facebook/doshareidea', 'FacebookController@doShareIdea');
Route::get('facebook/disconnect', 'FacebookController@disconnectFacebook');
Route::post('facebook/likepost', 'FacebookController@likePost');
Route::post('facebook/doschedulepost', 'FacebookController@schedulePost');

//Twitter
Route::get('twitter', 'TwitterController@index');
Route::post('twitter/doproposetweet', 'TwitterController@doProposeTweet');
});

Route::get('createrootuser', 'UsersController@createRootUser');

Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@doLogin');


Route::group(['after' => 'allowOrigin'], function() {
Route::get('api/dologin', 'APIController@doLogin');
Route::get('json', 'HomeController@jsonData');
});


Route::any('{all}', 'UsersController@index')->where('all', '.*');


