@extends('layouts.base')
@section('css')


<div id="overlay_form">
  <form>
    <h3 id="forms-control-disabled">Propose a Facebook Post</h3>
     <span class="fileinput-button" style="float:left; ">

     <img id="imgPreview" class=""  height="75" width="75" src="images/image_placeholder.jpg">

     <input type="file" name="file" class="btn" >

   </span>
 </form>
      <form action="facebook/doproposepost" method="POST" id="processform">
    <input type="hidden" name="upload_original_name" id="upload_original_name" />
      <input type="hidden" name="platform" value="facebook" />
      <input type="text" name="message" class="form-control" onkeydown="if(event.keyCode == 13) return false;"  style="margin-left:100px; width:400px; height:75px;">
              <input id="btnSubmitForm" class="btn btn-primary" type="submit" style="margin-top:15px;">

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
					<h3>Facebook Post Ideas</h3>

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
@stop

