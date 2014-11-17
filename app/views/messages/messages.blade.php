@extends('layouts.base')


@section('pageContent')



  <div class="cl-mcont aside" >    <div class="page-aside email" >


      <div class="">
        <div class="content" style="padding:10px;">
          <button class="navbar-toggle" data-target=".mail-nav" data-toggle="collapse" type="button">
            <span class="fa fa-chevron-down"></span>
          </button>          
          <h4 class="page-title">Conversations</h4>
        </div>        
        <div class="mail-nav collapse" >

        @foreach($data['conversations'] as $key => $conversation)
        <?php
        if(!isset($initId)){
        if($key == $conversation->from){
           $initName = $conversation->fromUser()->first()->firstName . ' ' . $conversation->fromUser()->first()->lastName;
        }
        else{
          $initName = $conversation->toUser()->first()->firstName . ' ' . $conversation->toUser()->first()->lastName;
        }
       
        $initId = $key;
      }
        ?>
    
          <div style="background:#F2F2F2; cursor:pointer; margin-bottom:1px; padding:10px 5px;" onclick="goAjax({{$key}},'{{ $initName }}');"> 

        <span class="pull-right date">{{$conversation->created_at}}</span> 
       
                  <span class="pull-left" style="margin-left:5px;"><b>{{$conversation->toUser()->first()->firstName . ' ' . $conversation->toUser()->first()->lastName}}</b>
                  <p>{{$conversation->message}}</p> </span>
        
            <div style="clear:both"></div>      
        </div>
        @endforeach
      
    

       
          
        
        </div>

      </div>
    </div>  


 <div class="content" >


<div style="height:60px; padding:10px; background-color:#FFFFFF;">
        
                  <h4 id="username"><b></b></h4>
                   </span>
      </div>

    <div class="mail editor" style=" padding:5px; background-color:#FFF; border-bottom: 1px solid #E5E5E5">
    <form method="post" action="/postmessage">
    <input type="hidden" \ name="toUser" id="toUser">
        <textarea style="height:100px;  " class="form-control" id="some-textarea" name="message" placeholder="Say something..."></textarea>
        <div class="form-group" style="background-color:#FFF; height:40px;">
          <button class="btn btn-primary pull-right" type="submit"><i class="fa fa-envelope"></i> Send</button>
          </div>

   
        </form>
      </div>

    <div class="mail-inbox" id="ajaxContent">   
    </div>
  </div> 

      </div>
  
  </div> 
  
</div>

@stop

@section('js')
 <script type="text/javascript">

 
  $( document ).ready(function() {
        
   goAjax(<?php echo $initId;?>,"<?php echo $initName;?>")
  });
 

 function goAjax(id,name){
   $("#ajaxContent").html("<div style='width:100%; margin-left:50%; margin-top:50px;'><img  src='images/ajax-loader.gif'></div>");
       $("#username").html(name);
   
   $.ajax({url:"messages/conversation/"+id,success:function(result){
    $("#toUser").val(id);
    $("#ajaxContent").html(result);
  }});

 }

</script>
@stop