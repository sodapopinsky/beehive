<?php 
namespace NS\Accounts;
use NS\Core\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

use Illuminate\Auth\Reminders\RemindableTrait;

use Illuminate\Auth\UserTrait;


use Eloquent;


class User extends Entity implements UserInterface, RemindableInterface 
{
    use  SoftDeletingTrait;

    

    protected $table    = 'users';
    protected $hidden   = ['github_id'];
    protected $fillable = ['password','organization', 'email', 'firstName', 'lastName','username'];
    protected $dates    = ['deleted_at'];

    protected $validationRules = [
        'github_id' => 'unique:users,github_id,<id>',
    ];

    

   /**
    * Get the unique identifier for the user.
    *
    * @return mixed
    */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
    * Get the password for the user.
    *
    * @return string
    */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
    * Get the e-mail address where password reminders are sent.
    *
    * @return string
    */
    public function getReminderEmail()
    {
        return $this->email;
    }

public function getRememberToken()
{
    return $this->remember_token;
}

public function setRememberToken($value)
{
    $this->remember_token = $value;
}

public function getRememberTokenName()
{
    return 'remember_token';
}
  

}