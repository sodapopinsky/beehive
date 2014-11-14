<?php

use NS\Accounts\UserRepository;
use NS\Accounts\UserCreator;
use NS\Accounts\UserCreatorListener;
use NS\Accounts\UserForm;


class UsersController extends BaseController implements UserCreatorListener{

	protected $users;
    protected $userCreator;

    public function __construct(UserRepository $users, UserCreator $userCreator){
        $this->users = $users;
        $this->userCreator = $userCreator;
    }


    public function index()
    {
        $users = $this->users->getAll();
       $this->view('users.users',compact('users'));
       
   }

   public function userValidationError($errors)
   {
    return $this->redirectBack(['errors' => $errors]);
}

public function userCreated($thread)
{
    return $this->redirectAction('UsersController@index');
}

public function getAddUser(){
     $this->view('users.create');
}

public function getProfile($id){

  
    $user = $this->users->getById($id);
    $this->view('users.profile',compact('user'));

}

public function postAddUser(){
    $username = strtolower(Input::Get('firstName') . Input::Get('lastName'));
    return $this->userCreator->create($this, [
    'firstName' => Input::Get('firstName'),
    'lastName' => Input::Get('lastName'),
    'password' => "password",
    'username' => $username,
    'organization' => 1
    ], new UserForm);
    
            return Redirect::action('UsersController@index'); 
}

public function createRootUser(){
  
    return $this->userCreator->create($this, [
    'firstName' => "Nick",
    'lastName' => "Spitale",
    'password' => "password",
    'username' => "nickspitale",
    'organization' => 1
    ]);
    
            return Redirect::action('UsersController@index'); 
}

public function getCreateEmployee()
{
 $this->view('users.create');
}



public function getEmployeeFile($id){
    $user = $this->users->requireById($id);
    $this->view('users.userfile',compact('user'));
}

}
