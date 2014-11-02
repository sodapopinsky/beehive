<?php 
namespace NS\ProposedPosts;

use NS\Core\EloquentRepository;
use NS\Core\Exceptions\EntityNotFoundException;

class ProposedPostRepository extends EloquentRepository
{
    public function __construct(ProposedPost $model)
    {
        $this->model = $model;
    }

   
}