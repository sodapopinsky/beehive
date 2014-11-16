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
 	$conversations =  $this->model->where('to', '=', $id)
  ->orWhere(function($query) use ($id)
            {
                $query->where('from', '=', $id);
                  
            })->
  orderBy('created_at', 'desc')->get();

 	$uniqueArray = array();
foreach($conversations as $conversation){
  if($conversation->from != $id)
    $other = $conversation->from;
  else
    $other = $conversation->to;
if(array_key_exists($other, $uniqueArray)){
  continue;
}
else{
  $uniqueArray[$other] = $conversation;
}
}



return $uniqueArray;
   }


   public function getSingleConversationByIds($user1, $user2){
 	//$conversations =  $this->model->where('to', '=', $id)->orderBy('created_at', 'desc')->get();


  $conversations = $this->model->where('to', '=', $user2)->where('from','=',$user1)
            ->orWhere(function($query) use ($user1,$user2)
            {
                $query->where('to', '=', $user1)
                      ->where('from', '=', $user2);
            })->get();
            return $conversations;

   }


}