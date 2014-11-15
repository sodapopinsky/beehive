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
   
}