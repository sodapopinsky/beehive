<?php 
namespace NS\Accounts;

use NS\Core\FormModel;
use App, Validator;

class UserForm extends FormModel
{
    protected $validationRules = [
        'firstName' => 'required',
        'lastName' => 'required'
    ];

 
}