<?php 
namespace NS\Messages;



interface MessageCreatorListener
{
    public function messageValidationError($errors);
    public function messageCreated($message);
}