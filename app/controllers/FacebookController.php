<?php

use NS\ProposedPosts\ProposedPostCreator;
use NS\ProposedPosts\ProposedPost;
use NS\ProposedPosts\ProposedPostCreatorListener;
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

	public function __construct(ProposedPostRepository $posts, ProposedPostCreator $postCreator){
		$this->posts = $posts;
		$this->postCreator = $postCreator;
	}


	public function index()
	{
		session_start(); 

		$session = $this->getFacebookSession();

$abtest = "382316005227557";
$ab = "157606107767381";

	  



// see if we have a session
                 if ( isset( $session ) ) {

  // save the session
                 $_SESSION['fb_token'] = $session->getToken();
  // create a session using saved token or the new one we generated at login
                  $session = new FacebookSession( $session->getToken() );

// graph api request for user data
  				if(!isset($_SESSION['fb_currentUser'])){
                  $request = new FacebookRequest( $session, 'GET', '/me' );
                  $response = $request->execute();
                  $_SESSION['fb_currentUser'] =  $response->getGraphObject()->asArray();
              }
  // graph api request for page data
                  $request = new FacebookRequest( $session, 'GET', '/'.$abtest.'/feed'); //need to implement pagination
                  $response = $request->execute();
                  $graphObject = $response->getGraphObject()->asArray();

              $request = new FacebookRequest( $session, 'GET', '/me/permissions' );
              $response = $request->execute();
                  $permissions = $response->getGraphObject()->asArray();
        
            $request = new FacebookRequest( $session, 'GET', '/'.$_SESSION['fb_currentUser']['id'].'/accounts' );
              $response = $request->execute();
                  $accounts = $response->getGraphObject()->asArray();
			

$access_token = "1";
foreach($accounts['data'] as $object){
	if($object->id == $abtest){
		$access_token = $object->access_token;
	}

  }

/*
              $request = new FacebookRequest(
  $session,
  'POST',
  '/'.$abtest.'/feed',
  array (
    'message' => 'Test 2',
    'access_token' => urlencode($access_token)
  )
);
$response = $request->execute();
$postresponse = $response->getGraphObject();
*/
               

            } else {
              $graphObject = null;
            }

            



		$proposedPosts = ProposedPost::orderBy('created_at', 'DESC')->where('platform','facebook')->paginate(5);

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

  $scope = array('publish_actions','email', 'user_friends',
                'manage_pages');
  $helper = new FacebookRedirectLoginHelper( 'http://localhost:8000/facebook' );
      $loginUrl = $helper->getLoginUrl($scope);

 

		$this->view('facebook.facebook',compact('permissions','accounts','graphObject','loginUrl','session','proposedPosts','s3','bucket','accesskey','secret','base64Policy','signature'));
	


	}

public function getFacebookSession(){

		 FacebookSession::setDefaultApplication('801125503264512', '43011e6e224645a7c5a40c69b729379c');
 

// login helper with redirect_uri

          $helper = new FacebookRedirectLoginHelper( 'http://localhost:8000/facebook' );
       
// see if a existing session exists

          if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
  // create new session from saved access_token
            $session = new FacebookSession( $_SESSION['fb_token'] );

	
  // validate the access_token to make sure it's still valid
            try {
              if ( !$session->validate() ) {
                $session = null;
              }
            } catch ( Exception $e ) {
    // catch any exceptions
              $session = null;
            }
          }  

          if ( !isset( $session ) || $session === null ) {
  // no session exists

            try {

              $session = $helper->getSessionFromRedirect();
            } catch( FacebookRequestException $ex ) {
    // When Facebook returns an error
    // handle this better in production code
              print_r( $ex );
            } catch( Exception $ex ) {
    // When validation fails or other local issues
    // handle this better in production code
              print_r( $ex );
            }

          }
return $session;
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


public function doProposePost()

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
		session_start(); 
	  unset($_SESSION['fb_token']);
      unset($_SESSION['fb_currentUser']);
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
