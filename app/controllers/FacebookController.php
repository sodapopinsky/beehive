<?php

use NS\ProposedPosts\ProposedPostCreator;
use NS\ProposedPosts\ProposedPost;
use NS\ProposedPosts\ProposedPostCreatorListener;
use NS\Core\S3;
use NS\Core\Facebook;
use NS\ProposedPosts\ProposedPostRepository;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;

class FacebookController extends BaseController implements ProposedPostCreatorListener {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $posts;
	protected $postCreator;
	protected $pageID;
	protected $s3;
	protected $facebook;

	public function __construct(ProposedPostRepository $posts, ProposedPostCreator $postCreator, S3 $s3,Facebook $facebook){
		$this->posts = $posts;
		$this->postCreator = $postCreator;
		$this->pageID = "382316005227557";
		$this->s3 = $s3;
		$this->facebook = $facebook;
		session_start(); 
	}


	public function index()
	{

		$session = $this->facebook->getSession();

		if ( isset( $session ) ) {
			$scheduledPosts = $this->facebook->getScheduledPosts($session);
			$feed = $this->facebook->getFeed($session);
			$permissions = $this->facebook->getPermissions($session);
			$accounts = $this->facebook->getAccounts($session);

		} 


		$proposedPosts = ProposedPost::orderBy('created_at', 'DESC')->where('platform','facebook')->paginate(5);

		$bucket = Config::get('constants.photosBucket');
		$accesskey = Config::get('constants.amazonS3Key');
		$secret = Config::get('constants.amazonS3Secret');


		$s3 = $this->s3->client; 

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


		$loginUrl = $this->facebook->loginUrl;



		$this->view('facebook.facebook',compact('scheduledPosts','permissions','accounts','feed','loginUrl','session','proposedPosts','s3','bucket','accesskey','secret','base64Policy','signature'));



	}



	public function schedulePost(){


		$session = $this->facebook->getSession();
		$scheduledTime = time() + (7 * 24 * 60 * 60); 



		$request = new FacebookRequest( $session, 'GET', '/'.$_SESSION['fb_currentUser']['id'].'/accounts' );
		$response = $request->execute();
		$accounts = $response->getGraphObject()->asArray();


		$access_token = "1";
		foreach($accounts['data'] as $object){
			if($object->id == $this->pageID){
				$access_token = $object->access_token;
			}

		}



		if(Input::Get('schedule_post_original_name') != ""){
			//photo uploaded
			$url = $this->s3->client->getObjectUrl(Config::get('constants.photosBucket')
				,Input::Get('schedule_post_original_name'),'+120 minutes');
			//$url =  "https://s3.amazonaws.com/beehive-photos/" . $url;

			$request = new FacebookRequest(
				$session,
				'POST',
				'/'.$this->pageID.'/photos',
				array (
					'message' => Input::Get('message'),
					'access_token' => urlencode($access_token),
					'url' => $url,
					 'scheduled_publish_time' => $scheduledTime,
   					 'published' => false,
					)
				);


		}
		else{
	//no photo uploaded

			$request = new FacebookRequest(
				$session,
				'POST',
				'/'.$this->pageID.'/feed',
				array (
					'message' => Input::Get('message'),
					'access_token' => urlencode($access_token),
					)
				);


		}

		$response = $request->execute();



		return Redirect::action('FacebookController@index'); 

	}






	public function likePost(){

		session_start(); 

		$session = $this->getFacebookSession();


		if ( isset( $session ) ) {

  // save the session
			$_SESSION['fb_token'] = $session->getToken();
  // create a session using saved token or the new one we generated at login
			$session = new FacebookSession( $session->getToken() );

  // graph api request for page data
			$endpoint = '/303058509888806/likes?access_token=' . $session->getToken();
                //  echo $endpoint;
			$postID = Input::get('postID');
			$request = new FacebookRequest( $session, 'POST', '/'.$postID.'/likes'); 

			$response = $request->execute();
              //    $graphObject = $response->getGraphObject()->asArray();
		} 

		return Redirect::action('FacebookController@index'); 

	}


	public function doShareIdea()

	{

		$this->postCreator->create($this, [
			'message' => Input::get('message'),
			'platform' => Input::get('platform'),
			'organization' => 1,
			'user' => Auth::user()->id,
			'picture' => Input::get('upload_original_name')
			]);


		return Redirect::action('FacebookController@index'); 

	}
	public function disconnectFacebook(){

		unset($_SESSION['fb_token']);
		unset($_SESSION['fb_currentUser']);
		return Redirect::action('FacebookController@index'); 
	}

	public function doFacebookLogout(){

		session_destroy();
		$this->view('facebook.facebook');

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
