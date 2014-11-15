<?php
namespace NS\Messages;
/**
* This class can call the following methods on the observer object:
*
* proposedPostValidationError($errors)
* proposedPostCreated($post)
*/
class MessageCreator
{
    protected $messages;

    public function __construct(MessageRepository $messages)
    {
        $this->messages = $messages;
    }

    public function create(MessageCreatorListener $listener, $data, $validator = null)
    {
    	
        // check the passed in validator
        if ($validator && ! $validator->isValid()) {
            return $listener->messageValidationError($validator->getErrors());
        }

        return $this->createMessageRecord($listener, $data);
        
    }

    private function createMessageRecord($listener, $data)
    {
        
        $message = $this->messages->getNew($data);

        // check the model validation
        if (! $this->messages->save($message)) {
            return $listener->messageValidationError($post->getErrors());
        }

        return $listener->messageCreated($message);
        
    }
}