<?php

use NS\ProposedPosts\ProposedPostCreator;
use NS\ProposedPosts\ProposedPost;
use NS\ProposedPosts\ProposedPostCreatorListener;
use NS\ProposedPosts\ProposedPostRepository;


class FacebookController extends BaseController implements ProposedPostCreatorListener {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $posts;
	protected $postCreator;

	public function __construct(ProposedPostRepository $posts, ProposedPostCreator $postCreator){
		$this->posts = $posts;
		$this->postCreator = $postCreator;
	}

	public function index()
	{
		$proposedPosts = ProposedPost::orderBy('created_at', 'DESC')->paginate(5);
		$this->view('facebook.facebook',compact('proposedPosts'));
	}


	public function doProposePost()
	{

		$this->postCreator->create($this, [
			'message' => Input::get('message'),
			'organization' => 1,
			'user' => Auth::user()->id,
			'picture' => Input::get('upload_original_name')
			]);


		return Redirect::action('FacebookController@index'); 

	}


	public function doFacebookLogout(){
		session_start();
		session_destroy();
		$this->view('facebook.facebook');

	}

	public function proposedPostValidationError($errors){

	}

	public function proposedPostCreated($post){

		
		if($post->picture != null){
/*
			$s3 = Aws\S3\S3Client::factory(array(
				'key'    => Config::get('constants.amazonS3Key'),
				'secret' => Config::get('constants.amazonS3Secret')
				));


			$result = $s3->copyObject(array(
				'Bucket' => Config::get('constants.photosBucket'),
    'ContentType'     => 'image/jpeg',  //must detect content type from file [*]NS
    'CopySource' => Config::get('constants.photosBucket') . "/" . Input::get('upload_original_name'),
    'Key' => $post->id,
    'MetadataDirective' => 'REPLACE',
    ));
    */

		}	

	}




}
