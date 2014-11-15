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
}