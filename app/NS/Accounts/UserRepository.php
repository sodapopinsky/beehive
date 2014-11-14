<?php 
namespace NS\Accounts;

use NS\Core\EloquentRepository;
use NS\Core\Exceptions\EntityNotFoundException;

class UserRepository extends EloquentRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

 public function getByUsernamePassword($username,$password)
    {
        return $this->model->where('username', '=', $username)->where('password', '=', $password)->first();
    }
   
}