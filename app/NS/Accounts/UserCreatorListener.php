<?php namespace NS\Accounts;



interface UserCreatorListener
{
    public function userValidationError($errors);
    public function userCreated($user);
}