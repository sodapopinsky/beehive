@extends('layouts.base')
@section('css')

<?php
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
<h3 id="forms-control-disabled">Propose a Tweet</h3>

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
			<div class="block-flat">


			<button class="btn btn-primary pull-right" id="goUpload" type="button" href="#overlay_form">Share an Idea</button>
				<div class="header">
					<h3>Tweet Ideas</h3>

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
         <div class="small">shared on {{$post->created_at}}</div>
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
<script type="text/javascript">
$("#goUpload").leanModal();

</script>


<script>

function handleText(){


if($("#message").val().length > 0){
  
  $("#btnSubmitForm").prop("disabled",false);
}
else{
    
    $("#btnSubmitForm").prop("disabled",true);
}

}
$(document).ready( function() {

        
        var form =  $('.direct-upload');

        form.fileupload({
            url: form.attr('action'),
            type: 'POST',
            datatype: 'xml',
            add: function (event, data) {

       var goUpload = true;
        var uploadFile = data.files[0];
        if (!(/\.(gif|jpg|jpeg|tiff|png)$/i).test(uploadFile.name)) {
            alert('Please select an image file');
            goUpload = false;
        }
         if (uploadFile.size > 2000000) { // 2mb
           alert('Please upload a smaller image, max size is 2 MB');
            goUpload = false;
        }

  if (goUpload == true) {
                  $("#btnSubmitForm").prop("disabled",true);
        var reader = new FileReader();
        reader.onload = function(event) {
          $('#imgPreview').attr('src', event.target.result);
        }
        reader.readAsDataURL(data.files[0]);
                 //$('.progress').css('visibility', 'visible');
                // Message on unLoad.
                window.onbeforeunload = function() {
                    return 'Upload Not Complete';
                };

                // Submit
              
            data.submit();
        }
            },
            send: function(e, data) {

                // onSend
            },
            progress: function(e, data){
                // This is what makes everything really cool, thanks to that callback
                // you can now update the progress bar based on the upload progress.
                var percent = Math.round((data.loaded / data.total) * 100);
                $('.bar').css('width', percent + '%');
            },
            fail: function(e, data) {
                // Remove 'unsaved changes' message.
                window.onbeforeunload = null;
            },
            success: function(data) {
                // onSuccess
            },
            done: function (event, data) {
                  window.onbeforeunload = null;
                 
                     $('#upload_original_name').val(data.originalFiles[0].name);
   $("#btnSubmitForm").prop("disabled",false);

          
              
            }

        });
    
});
</script>
@stop

