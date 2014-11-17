<?php 
namespace NS\Core;
use App;
use Config;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
class Facebook
{
    protected $client;
    protected $pageID;
    public $loginUrl;
    public $redirectUrl;
    public function __construct()
    {
        $this->pageID = "382316005227557";
        if(App::isLocal()){
        $this->redirectUrl = 'http://localhost:8000/facebook';
      }
      else{
         $this->redirectUrl = 'http://atomicbeehive.herokuapp.com/facebook';
      }
        	//$abtest = "382316005227557";
		//$ab = "157606107767381";

    }

public function getSession(){

     FacebookSession::setDefaultApplication('801125503264512', '43011e6e224645a7c5a40c69b729379c');
 

     $helper = new FacebookRedirectLoginHelper( $this->redirectUrl );
       
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
if(isset($session)){
           // save the session
                 $_SESSION['fb_token'] = $session->getToken();
  // create a session using saved token or the new one we generated at login
                  $session = new FacebookSession( $session->getToken() );


                                

  				if(!isset($_SESSION['fb_currentUser'])){
  					$this->getUser($session);
              }


              }

               $scope = array('publish_actions','email', 'user_friends',
                'manage_pages');
  $helper = new FacebookRedirectLoginHelper(  $this->redirectUrl  );
      $this->loginUrl = $helper->getLoginUrl($scope);


return $session;
}


// graph api request for user data
private function getUser($session){
  $request = new FacebookRequest( $session, 'GET', '/me' );
           $response = $request->execute();
                  $_SESSION['fb_currentUser'] =  $response->getGraphObject()->asArray();
}

public function getScheduledPosts($session){
	$request = new FacebookRequest( $session, 'GET', '/'.$this->pageID.'/promotable_posts?is_published=false'); //need to 
                  $response = $request->execute();
                  $graphObject = $response->getGraphObject()->asArray();
                  return $graphObject;
}

public function getFeed($session){
                  $request = new FacebookRequest( $session, 'GET', '/'.$this->pageID.'/feed'); //need to implement pagination
                  $response = $request->execute();
                  $graphObject = $response->getGraphObject()->asArray();
                  return $graphObject;
}

public function getPermissions($session){
 $request = new FacebookRequest( $session, 'GET', '/me/permissions' );
              $response = $request->execute();
                  $permissions = $response->getGraphObject()->asArray();
                  return $permissions;
}
public function getAccounts($session){
  $request = new FacebookRequest( $session, 'GET', '/'.$_SESSION['fb_currentUser']['id'].'/accounts' );
              $response = $request->execute();
                  $accounts = $response->getGraphObject()->asArray();
                  return $accounts;
              }


}