@extends('layouts.base')
@section('css')
<div id="messageOverlay" class="overlay_form">
<form action="/postmessage" method="POST">
<h4 id="forms-control-disabled" style="margin-left:5%;">Send a message to {{$data['user']->firstName}}</h4>

     <textarea class="form-control" name="message" id="schedulePostMessage" rows="5" id="comment"  style="width:90%;margin-left:5%;" onkeyup="handleText('schedulePostMessage','schedulePostButton')"></textarea>
     <input type="hidden" name="toUser" value="{{$data['user']->id}}">
       <input id="schedulePostButton" class="btn btn-primary" disabled  type="submit" style="float:right; margin-top:20px; margin-right:5%;">
</div>
</form>
@stop

@section('pageContent')





<div class="cl-mcont">    <div class="row">
      <div class="col-sm-12">
        <div class="block-flat profile-info">
          <div class="row">
            <div class="col-sm-2">
              <div class="avatar"  >

               <div >
                <img  class="profile-avatar"  src="{{asset('images/avatars/avatar1.jpg')}}" alt="user-avatar"  />
          
                </div>

              </div>
             
            </div>
         
            <div class="col-sm-7" >
              <div class="personal">
                <h1 class="name">{{$data['user']->firstName . " " . $data['user']->lastName}}</h1>
                   <button class="btn btn-primary" id="sendMessage" type="button" href="#messageOverlay">Send a Message</button>
               <!-- <div class="btn btn-primary" id="sendMessage" href="#sculePost">Send a Message</div> -->
                <div style="padding-top:10px;"><span class="fa fa-phone" ></span> 
                @if($data['user']->phone != null)
                {{$data['user']->phone}}
                @else
                N/A
                @endif </div>
           
                 
              </div>
            </div>
           
          </div>
        </div>
      </div>
    </div>
</div>



  

@stop

@section('js')
 <script type="text/javascript">
$("#sendMessage").leanModal();
</script>
@stop