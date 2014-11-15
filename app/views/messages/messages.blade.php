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
          <div style="background:#F2F2F2; margin-bottom:1px; padding:10px 5px;"> 

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

    <div class="mail-inbox">
    <div style="height:60px; padding:10px;">
        
                  <h4><b>Jeff Hanneman</b></h4>
                   </span>
      </div>

 
      <div class="mails">
        <div class="item">
          <div><input type="checkbox" name="c[]" /> </div>
          <div>
            <span class="date pull-right"><i class="fa fa-paperclip"></i> 20 Nov</span>
            <h4 class="from">Jeff Hanneman</h4>
            <p class="msg">Urgent - You forgot your keys in the class room, please come imediatly!</p>
          </div>
        </div>
        <div class="item">
          <div><input type="checkbox" name="c[]" /> </div>
          <div>
            <span class="date pull-right"><i class="fa fa-paperclip"></i> 20 Nov</span>
            <h4 class="from">John Doe</h4>
            <p class="msg">Urgent - You forgot your keys in the class room, please come imediatly!</p>
          </div>
        </div>
        <div class="item">
          <div><input type="checkbox" name="c[]" /> </div>
          <div>
            <span class="date pull-right"><i class="fa fa-paperclip"></i> 20 Nov</span>
            <h4 class="from">John Doe</h4>
            <p class="msg">Urgent - You forgot your keys in the class room, please come imediatly!</p>
          </div>
        </div>
        <div class="item">
          <div><input type="checkbox" name="c[]" /> </div>
          <div>
            <span class="date pull-right"><i class="fa fa-paperclip"></i> 20 Nov</span>
            <h4 class="from">John Doe</h4>
            <p class="msg">Urgent - You forgot your keys in the class room, please come imediatly!</p>
          </div>
        </div>
        <div class="item">
          <div><input type="checkbox" name="c[]" /> </div>
          <div>
            <span class="date pull-right"><i class="fa fa-paperclip"></i> 20 Nov</span>
            <h4 class="from">John Doe</h4>
            <p class="msg">Urgent - You forgot your keys in the class room, please come imediatly!</p>
          </div>
        </div>
        <div class="item">
          <div><input type="checkbox" name="c[]" /> </div>
          <div>
            <span class="date pull-right"><i class="fa fa-paperclip"></i> 20 Nov</span>
            <h4 class="from">John Doe</h4>
            <p class="msg">Urgent - You forgot your keys in the class room, please come imediatly!</p>
          </div>
        </div>

      </div>
    </div>
  </div> 

      </div>
  
  </div> 
  
</div>
@stop
