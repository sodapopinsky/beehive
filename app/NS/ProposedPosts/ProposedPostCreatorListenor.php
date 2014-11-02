<?php namespace NS\ProposedPosts;



interface ProposedPostCreatorListener
{
    public function proposedPostValidationError($errors);
    public function proposedPostCreated($post);
}