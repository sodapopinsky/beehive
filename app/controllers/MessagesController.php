<?php

use NS\Messages\MessageRepository;
use NS\Messages\MessageCreator;
use NS\Messages\MessageCreatorListener;
use NS\Messages\MessageForm;


class MessagesController extends BaseController implements MessageCreatorListener{

	protected $messages;
    protected $messageCreator;

    public function __construct(MessageRepository $messages, MessageCreator $messageCreator){
        $this->messages = $messages;
        $this->messageCreator = $messageCreator;

    }


    public function index()
    {
      $conversations = $this->messages->getConversationsById(Auth::user()->id);
      $this->view('messages.messages',compact('conversations'));


       
   }
   
   public function postMessage(){

return App::make('NS\Messages\MessageCreator')->create($this, [
            'message' => Input::Get('message'),
            'from' => Auth::user()->id,
            'to' => Input::Get('toUser')
            ],new MessageForm());

   }

   public function getConversation($user){

    $conversation = $this->messages->getSingleConversationByIds(Auth::user()->id,$user);
    return View::make('messages.conversation',array('messages' => $conversation));

    

   }

   public function messageValidationError($errors){
        return $this->redirectBack(['errors' => $errors]);
    }

    public function messageCreated($message){

        
      return $this->redirectBack(['success' => 1]);

    }


}
