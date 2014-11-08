@extends('layouts.base')
@section('css')
<?php
use Facebook\FacebookRequest;
use Facebook\FacebookSession;
?>
<div id="overlay_form">
 <form action="//<?php echo $bucket; ?>.s3.amazonaws.com" method="POST" enctype="multipart/form-data" class="direct-upload">
    <!-- We'll specify these variables with PHP -->
    <!-- Note: Order of these is Important -->
    <input type="hidden" name="key" value="${filename}">
    <input type="hidden" name="AWSAccessKeyId" value="<?php echo $accesskey; ?>">
    <input type="hidden" name="acl" value="private">
    <input type="hidden" name="success_action_status" value="201">
    <input type="hidden" name="policy" value="<?php echo $base64Policy; ?>">
    <input type="hidden" name="signature" value="<?php echo $signature; ?>">
<h3 id="forms-control-disabled">Share a Facebook Post Idea</h3>

   <span class="fileinput-button" style="float:left; ">

     <img id="imgPreview" class=""  height="75" width="75" src="images/image_placeholder.jpg">

     <input type="file" name="file" class="btn" >

   </span>
</form>


<form action="twitter/doproposetweet" method="POST" id="processform">
    <input type="hidden" name="upload_original_name" id="upload_original_name" />
      <input type="hidden" name="platform" value="twitter" />
       <textarea class="form-control" name="message" id="message" rows="5" id="comment"  style="margin-left:100px; width:400px; height:75px;" onkeyup="handleText()"></textarea>
     
   
              <input id="btnSubmitForm" class="btn btn-primary" disabled  type="submit" style="margin-top:15px;">

</form>
</div>

@stop


@section('pageContent')

<div class="cl-mcont">    

  <div class="row">
  <div class="col-md-12">

 <?php
// see if we have a session
                 if ( isset( $session ) ) {

  // save the session
                  $_SESSION['fb_token'] = $session->getToken();
  // create a session using saved token or the new one we generated at login
                  $session = new FacebookSession( $session->getToken() );

  // graph api request for user data
  //$request = new FacebookRequest( $session, 'GET', '/me' );
                  $request = new FacebookRequest( $session, 'GET', '/theatomicburger/posts' );

                  $response = $request->execute();
  // get response
                  $graphObject = $response->getGraphObject()->asArray();
                  $i=0;
                  foreach($graphObject['data'] as $object){

                   if(isset($object->message)){
                    $i++;
                    ?>
                    <tr>

                      <td>
                       @if(isset($object->picture))
                       <img src="{{$object->picture}}" width="35" height="35">
                       @endif
                     </td>
                     @if(isset($object->link))

                     @endif
                     <td><div><a href="{{$object->actions[0]->link}}">{{$object->message}}</a></div><div class="small">{{date("M d Y h:ia",strtotime($object->created_time));}}</div></td>
                     <td>{{count($object->likes->data)}}
                     </td>
                   </tr>
                   <?php

                   if($i>=5)
                    break;

                }


              }


            } else {
  // show login url
              echo '<a href="' . $helper->getLoginUrl( array( 'email', 'user_friends','manage_pages' ) ) . '">Login</a>';
            }

            ?>


  </div>
    <div class="col-md-12">
      <div class="block-flat">


      <button class="btn btn-primary pull-right" id="goUpload" type="button" href="#overlay_form">Share an Idea</button>
        <div class="header">
          <h3>Facebook Post Ideas</h3>

        </div>

        <div class="content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          @if(count($proposedPosts) == 0)
          <div class="text-muted text-center" style="padding:30px;"> You have not shared any tweet ideas</div>
          @endif

         @foreach($proposedPosts as $post)
         <tr>
         <td>
          <?php 
          if($post->picture != null){ ?>
          <img style="float:left;" width="75" height="75" src="{{$s3->getObjectUrl(Config::get('constants.photosBucket'),$post->id,'+120 minutes')}}">
          <?php
          } 
          ?>
        
         <div style="float:left; margin-left:10px;">
          <div>{{ $post->message }}</div>
         <div class="small">shared by {{$post->user()->first()->firstName . " " .$post->user()->first()->lastName}} on {{$post->created_at}}</div>
       </div>
          <div class="clearfix"></div>
       </td>
     </tr>

         @endforeach

        </table>    
        <?php echo $proposedPosts->links(); ?> 
      </div>

      </div>
      

    </div>


  </div>
  <!-- End Row -->

</div>
@stop

@section('js')
 <script src="js/pages/twitter.js"></script>
@stop

