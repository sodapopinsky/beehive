<?php 
namespace NS\Messages;

use NS\Core\EloquentRepository;
use NS\Core\Exceptions\EntityNotFoundException;

class MessageRepository extends EloquentRepository
{
    public function __construct(Message $model)
    {
        $this->model = $model;
    }

public function getByUserID($id){
 	return $this->model->where('to', '=', $id)->get();
}


public function getConversationsById($id){
 	$conversations =  $this->model->where('to', '=', $id)->orderBy('created_at', 'desc')->get();

 	$uniqueArray = array();
foreach($conversations as $conversation){
if(array_key_exists($conversation->from, $uniqueArray)){
  continue;
}
else{
  $uniqueArray[$conversation->from] = $conversation;
}
}



return $uniqueArray;
   }


   public function getSingleConversationByIds($user1, $user2){
 	//$conversations =  $this->model->where('to', '=', $id)->orderBy('created_at', 'desc')->get();


  $conversations = $this->model->where('to', '=', $user1)->where('from','=',$user2)
            ->orWhere(function($query) use ($user1,$user2)
            {
                $query->where('to', '=', $user2)
                      ->where('from', '<>', $user1);
            })->get();
            return $conversations;

   }


}