<?php
namespace NS\ProposedPosts;
/**
* This class can call the following methods on the observer object:
*
* proposedPostValidationError($errors)
* proposedPostCreated($post)
*/
class ProposedPostCreator
{
    protected $posts;

    public function __construct(ProposedPostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function create(ProposedPostCreatorListener $listener, $data, $validator = null)
    {

        // check the passed in validator
        if ($validator && ! $validator->isValid()) {
            return $listener->proposedPostValidationError($validator->getErrors());
        }

        return $this->createProposedPostRecord($listener, $data);
        
    }

    private function createProposedPostRecord($listener, $data)
    {
        
        $post = $this->posts->getNew($data);

        // check the model validation
        if (! $this->posts->save($post)) {
            return $listener->proposedPostValidationError($post->getErrors());
        }

        return $listener->proposedPostCreated($post);
        
    }
}