<?php namespace NS\ProposedPosts;
use NS\Core\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProposedPost extends Entity 
{
    use  SoftDeletingTrait;

    

    protected $table    = 'proposedPosts';
    protected $hidden   = ['github_id'];
    protected $fillable = ['message','organization', 'user', 'picture'];
    protected $dates    = ['deleted_at'];

       public function user()
    {
        return $this->belongsTo('NS\Accounts\User','user');
    }

}