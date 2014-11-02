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

       $this->view('users.user');
       
   }

   public function userValidationError($errors)
   {
    return $this->redirectBack(['errors' => $errors]);
}

public function userCreated($thread)
{
    return $this->redirectAction('UsersController@index');
}



public function getCreateEmployee()
{
 $this->view('users.create');
}

public function createRootUser()
{
 return $this->userCreator->create($this, [
    'firstName' => "Nick",
    'lastName' => "Spitale",
    'password' => "password",
    'email' => "nick@theatomicburger.com",
    'organization' => 1
    ]);
}

public function postCreateEmployee()
{

    return $this->userCreator->create($this, [
        'firstName' => Input::get('firstName'),
        'lastName' => Input::get('lastName'),
        'password' => "password",
        'email' => "email",
        'organization' => 1
        ], new UserForm);
    
}


public function getEmployeeFile($id){
    $user = $this->users->requireById($id);
    $this->view('users.userfile',compact('user'));
}

}
