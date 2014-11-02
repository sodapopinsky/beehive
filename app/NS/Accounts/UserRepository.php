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

 public function getByEmailPassword($email,$password)
    {
        return $this->model->where('email', '=', $email)->where('password', '=', $password)->first();
    }
   
}