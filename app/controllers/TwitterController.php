<?php

use NS\ProposedPosts\ProposedPostCreator;
use NS\ProposedPosts\ProposedPost;
use NS\ProposedPosts\ProposedPostCreatorListener;
use NS\ProposedPosts\ProposedPostRepository;


class TwitterController extends BaseController implements ProposedPostCreatorListener {

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
		$proposedPosts = ProposedPost::orderBy('created_at', 'DESC')->where('platform','twitter')->paginate(5);

		$bucket = Config::get('constants.photosBucket');
$accesskey = Config::get('constants.amazonS3Key');
$secret = Config::get('constants.amazonS3Secret');

        $s3 = Aws\S3\S3Client::factory(array(
    'key'    => Config::get('constants.amazonS3Key'),
    'secret' => Config::get('constants.amazonS3Secret')
));

           
$now = strtotime(date("Y-m-d\TG:i:s"));
$expire = date('Y-m-d\TG:i:s\Z', strtotime('+30 minutes', $now));
$policy = '{
            "expiration": "' . $expire . '",
            "conditions": [
                {
                    "bucket": "' . $bucket . '"
                },
                {
                    "acl": "private"

                },
                
                [
                    "starts-with",
                    "$key",
                    ""
                ],
                {
                    "success_action_status": "201"
                }
            ]
        }';


$base64Policy = base64_encode($policy);
$signature = base64_encode(hash_hmac("sha1", $base64Policy, $secret, $raw_output = true));


		$this->view('twitter.twitter',compact('proposedPosts','s3','bucket','accesskey','secret','base64Policy','signature'));
	}


	public function doProposeTweet()
	{

		$this->postCreator->create($this, [
			'message' => Input::get('message'),
			'platform' => Input::get('platform'),
			'organization' => 1,
			'user' => Auth::user()->id,
			'picture' => Input::get('upload_original_name')
			]);


		return Redirect::action('TwitterController@index'); 

	}



	public function proposedPostValidationError($errors){

	}

	public function proposedPostCreated($post){

		
		if($post->picture != null){

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

			$s3->deleteObject(array(
				'Bucket' => Config::get('constants.photosBucket'),
    'Key' => $post->picture,
    ));
    

		}	

	}




}
