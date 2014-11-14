@extends('layouts.base')
@section('css')
<?php
date_default_timezone_set('America/Chicago');
use Facebook\FacebookRequest;
use Facebook\FacebookSession;
?>


<div id="schedulePost" class="overlay_form">

 <form action="//<?php echo $bucket; ?>.s3.amazonaws.com" method="POST" enctype="multipart/form-data" 
 class="schedulepost-upload">

    <input type="hidden" name="key" value="${filename}">
    <input type="hidden" name="AWSAccessKeyId" value="<?php echo $accesskey; ?>">
    <input type="hidden" name="acl" value="private">
    <input type="hidden" name="success_action_status" value="201">
    <input type="hidden" name="policy" value="<?php echo $base64Policy; ?>">
    <input type="hidden" name="signature" value="<?php echo $signature; ?>">
<h4 id="forms-control-disabled" style="margin-left:5%;">Schedule a Facebook Post</h4>

   <span class="fileinput-button" style="position:absolute; top:210px; left:5% ">

     <img id="schedulePostImg"   height="60" width="60" src="images/image_placeholder.jpg">

     <input type="file" name="file" class="btn" >


   </span>


          
</form>



<form action="facebook/doschedulepost" method="POST" id="processform">
    <input type="hidden" name="schedule_post_original_name" id="schedule_post_original_name" />

  <div class="form-group" class="pull-left" style="width:80%; margin-left:5%;">
                <div class="input-group date form_datetime" data-date="1979-09-16T05:25:07Z" data-date-format="m/d/yyyy - HH:ii p" data-link-field="dtp_input1" style="width:200px;">
                    <input class="form-control" size="16" name="date" id="selectdate" type="text" value="Select a Date" readonly>
                    <input type="hidden" id="timestamp" name="timestamp">
      
          <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
        <input type="hidden" id="dtp_input1" value="" />
            </div>

       <textarea class="form-control" name="message" id="schedulePostMessage" rows="5" id="comment"  style="width:90%;margin-left:5%;" onkeyup="handleText('schedulePostMessage','schedulePostButton')"></textarea>
     
   
              <input id="schedulePostButton" class="btn btn-primary" disabled  type="submit" style="float:right; margin-top:20px; margin-right:5%;">
  

</form>

</div>


<div id="shareIdea" class="overlay_form">
 <form action="//<?php echo $bucket; ?>.s3.amazonaws.com" method="POST" enctype="multipart/form-data" 
 class="shareidea-upload">
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


<form action="facebook/doshareidea" method="POST" id="processform">
    <input type="hidden" name="upload_original_name" id="upload_original_name" />
      <input type="hidden" name="platform" value="facebook" />
       <textarea class="form-control" name="message" id="shareIdeaMessage" rows="5" id="comment"  style="margin-left:100px; 
       width:400px; height:75px;" onkeyup="handleText('shareIdeaMessage','shareIdeaButton')"></textarea>
     
   
              <input id="shareIdeaButton" class="btn btn-primary" disabled  type="submit" style="margin-top:15px;">

</form>
</div>

@stop


@section('pageContent')

<div class="cl-mcont">    

  <div class="row">
  <div class="col-md-12">

   
 @if (Session::has('flashError'))
  <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-warning sign"></i>{{Session::get('flashError')}}
               </div>
 @endif





@if(isset($feed))
@if(isset($_SESSION['fb_currentUser']))
<img style="float:left" src="http://graph.facebook.com/{{ $_SESSION['fb_currentUser']['id'] }}/picture">
<div style="margin-left:60px;">  Connected to facebook as {{ $_SESSION['fb_currentUser']['name'] }}</div>
<div style="margin-bottom:20px; margin-left:60px;"><a href="/facebook/disconnect">[disconnect]</a></div>
@endif


<div class="block-flat">

<button class="btn btn-primary pull-right" id="goUpload" type="button" href="#schedulePost">Schedule a Post</button>
 <div class="header">
<h3>Scheduled Posts</h3>
 </div>
 

@if(isset($scheduledPosts['data']))
<table>
 <tr>
 <td></td>
 <td><b>Message</b></td>

 </tr>
@foreach($scheduledPosts['data'] as $object)
@if(isset($object->message))
        <tr>
              <td>
                       @if(isset($object->picture))
                       <img src="{{$object->picture}}" width="40" height="40">
                       @endif
                     </td>
                     @if(isset($object->link))

                     @endif
                     <td><div><a href="{{$object->actions[0]->link}}">{{$object->message}}</a></div><div 
                     class="small">Scheduled for {{ date("M d h:ia", $object->scheduled_publish_time) }}</div></td>
                    
                   
         </tr>
      @endif


 @endforeach
 </table>
@endif
 @if(count($scheduledPosts) == 0)
    <div class="text-muted text-center" style="padding:30px;"> There are no posts scheduled</div>
 @endif
 

 </div>


<div class="block-flat">
 <div class="header">
          <h3>Recent Posts</h3>

 </div>


 <div>

 

 @if(isset($feed['data']))
<table>
 <tr>
 <td></td>
 <td><b>Message</b></td>
 <td></td>
 <td><b>Likes</b></td>
 </tr>
  @foreach($feed['data'] as $object)

      @if(isset($object->message))
        <tr>
              <td>
                       @if(isset($object->picture))
                       <img src="{{$object->picture}}" width="40" height="40">
                       @endif
                     </td>
                     @if(isset($object->link))

                     @endif
                     <td><div><a href="{{$object->actions[0]->link}}">{{$object->message}}</a></div><div 
                     class="small">{{date("M d Y h:ia",strtotime($object->created_time));}}</div></td>
                     <td>
                      @if(isset($object->likes))
                      <?php $found = 0;?>
                      @foreach($object->likes->data as $liker)
                            @if($liker->id == $_SESSION['fb_currentUser']['id'])
                            
                            <i class="fa  fa-thumbs-o-up"></i><span>Liked</span>

                            <?php $found = 1;?>
                      @endif 

                      @endforeach
                      @if($found == 0)
                      <form action="/facebook/likepost" method="post">
                     
                      <input type="hidden" name="postID" value="{{$object->id}}">
                     
                      <button type="submit"> <i class="fa  fa-thumbs-o-up"></i><span>Like</span></button>

                       </form>
                      @endif
                      @endif
                     </td>
                     <td>
                      @if(isset($object->likes))
                      {{count($object->likes->data)}}
                      @endif
                     </td>
         </tr>
      @endif

  @endforeach

  </table>

  @else
 
    <div class="text-muted text-center" style="padding:30px;"> There have been no recent posts</div>
 @endif

</div>
@else

<a class="btn btn-facebook" href="{{ $loginUrl }} "><i class="fa fa-facebook"></i> | Connect with Facebook</a>

@endif



  </div>
  </div>
    <div class="col-md-12">
      <div class="block-flat">


      <button class="btn btn-primary pull-right" id="goShareIdea" type="button" href="#shareIdea">Share an Idea</button>
        <div class="header">
          <h3>Post Ideas</h3>

        </div>

        <div class="content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          @if(count($proposedPosts) == 0)
          <div class="text-muted text-center" style="padding:30px;"> You have not shared any post ideas</div>
          @endif

         @foreach($proposedPosts as $post)
         <tr>
         <td>
          <?php 
          if($post->picture != null){ ?>
          <img style="float:left;" width="75" height="75" src="{{$s3->getObjectUrl(Config::get('constants.photosBucket')
          ,$post->id,'+120 minutes')}}">
          <?php
          } 
          ?>
        
         <div style="float:left; margin-left:10px;">
          <div>{{ $post->message }}</div>
         <div class="small">shared by {{$post->user()->first()->firstName . " " .$post->user()->first()->lastName}} on
          {{$post->created_at}}</div>
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
 <script src="js/pages/facebook.js"></script>
 <script type="text/javascript">


var d = new Date();


var month = d.getMonth() + 1;
var day = d.getDate();

var start = d.getFullYear() + '-' +
    ((''+month).length<2 ? '0' : '') + month + '-' +
    ((''+day).length<2 ? '0' : '') + day;

  d.setMonth(d.getMonth() + 3);

  var month = d.getMonth() + 1;
var day = d.getDate();

var end = d.getFullYear() + '-' +
    ((''+month).length<2 ? '0' : '') + month + '-' +
    ((''+day).length<2 ? '0' : '') + day;


    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1,
        startDate: start,
       endDate: end
    }).on('changeDate', function(ev){
     var requiredTime = (d.getTimezoneOffset()*2000 + Math.round(+new Date() - d.getTimezoneOffset()*60*1000));
    
      if(ev.date.valueOf() < requiredTime){
         $('#selectdate').val('Select a Date');
         alert("Date of post must be at least 15 minutes from now");

      }
      else{
         $('#timestamp').val(ev.date.valueOf() + Math.round(d.getTimezoneOffset()*60*1000));
          
      }
      
  
});
  $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });

 
</script>



@stop

