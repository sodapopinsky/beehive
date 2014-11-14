<?php

use NS\Accounts\UserCreatorListener;
use NS\Accounts\UserRepository; 

class AuthController extends BaseController
{
    protected $layout = 'layouts.plain';
    protected $users;
    protected $userCreator;

    public function __construct(UserRepository $users){
        $this->users = $users;
    }

    public function getLogin()
    {
        $this->view('login');

    }

  public function doLogin()
    {
      
        Auth::logout();  
        $user = $this->users->getByUsernamePassword(Input::get('username'),Input::get('password'));
        if(!$user){ 
            $failures = array('You call that a login attempt?', 'We are having a blast in here.', 'I know you can do it.');
        Session::flash('denied', $failures[array_rand($failures,1)] . ' Try again.');
        return Redirect::action('AuthController@getLogin'); 
         }
         Auth::login($user, true); 
        return Redirect::action('UsersController@index');  
     
    }
    
    public function doLogout()
    {
        Auth::logout();
        return Redirect::action('AuthController@getLogin'); 

    }


  

    
}