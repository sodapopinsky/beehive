<?php 
namespace NS\Messages;

use NS\Core\FormModel;
use App, Validator;

class MessageForm extends FormModel
{
    protected $validationRules = [
        'message' => 'required',
    ];

 
}