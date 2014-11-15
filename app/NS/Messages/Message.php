<?php 
namespace NS\Messages;
use NS\Core\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Message extends Entity 
{
   // use  SoftDeletingTrait;

    

    protected $table    = 'messages';
    protected $fillable = ['message','from', 'to'];
   // protected $dates    = ['deleted_at'];
/*
       public function user()
    {
        return $this->belongsTo('NS\Accounts\User','user');
    }
    */

}