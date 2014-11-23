<?php
use NS\Accounts\UserRepository; 
class APIController extends Controller{

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


  protected $users;

    public function __construct(UserRepository $users){
        $this->users = $users;
    }
		public function doLogin()
	{

 $user = $this->users->getByUsernamePassword(Input::get('username'),Input::get('password'));
        if(!$user){ 
        return Response::json(array('errors' => 'User Not Found'))->setCallback(Input::get('callback'));
         }
   

return Response::json(array('firstName' => $user->firstName, 'lastName' => $user->lastName))->setCallback(Input::get('callback'));
	}






}
