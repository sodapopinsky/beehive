@extends('layouts.base')


@section('pageContent')



  <div class="cl-mcont aside" >    <div class="page-aside email" >



      <div class="">
        <div class="content" style="padding:10px;">
          <button class="navbar-toggle" data-target=".mail-nav" data-toggle="collapse" type="button">
            <span class="fa fa-chevron-down"></span>
          </button>          
          <h2 class="page-title">Conversations</h2>
        </div>        
        <div class="mail-nav collapse" >

        @foreach($data['conversations'] as $conversation)
          <div style="background:#F2F2F2; cursor:pointer; margin-bottom:1px; padding:10px 5px;" onclick="goAjax({{$conversation->fromUser()->first()->id}},'{{$conversation->fromUser()->first()->firstName . ' ' . $conversation->fromUser()->first()->lastName }}');"> 

        <span class="pull-right date">17 Feb</span> 
        <img class="avatar pull-left" alt="user-avatar" src="images/avatar_50.jpg"/> 
                  <span class="pull-left" style="margin-left:5px;"><b>{{$conversation->fromUser()->first()->firstName}}</b>
                  <p>{{$conversation->message}}</p> </span>
        
            <div style="clear:both"></div>      
        </div>
        @endforeach
      
    

       
          
        
        </div>

      </div>
    </div>  


 <div class="content">
<div style="height:60px; padding:10px;">
        
                  <h4 id="username"><b></b></h4>
                   </span>
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
 function goAjax(id,name){
   $("#username").html(name);
   $.ajax({url:"messages/conversation/"+id,success:function(result){
    $("#ajaxContent").html(result);
  }});

 }

</script>
@stop