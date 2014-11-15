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

        <div style="background:#F2F2F2; margin-bottom:1px; padding:10px 5px;"> 

        <span class="pull-right date">17 Feb</span> 
        <img class="avatar pull-left" alt="user-avatar" src="images/avatar_50.jpg"/> 
                  <span class="pull-left" style="margin-left:5px;"><b>Jeff Hanneman</b>
                  <p>My vMaps plugin doesn't work</p> </span>
        
            <div style="clear:both"></div>      
        </div>
     
      <div style="background:#F2F2F2; margin-bottom:1px; padding:10px 5px;"> 

        <span class="pull-right date">17 Feb</span> 
        <img class="avatar pull-left" alt="user-avatar" src="images/avatar_50.jpg"/> 
                  <span class="pull-left" style="margin-left:5px;"><b>Jeff Hanneman</b>
                  <p>My vMaps plugin doesn't work</p> </span>
        
            <div style="clear:both"></div>      
        </div>
         <div style="background:#F2F2F2; margin-bottom:1px; padding:10px 5px;"> 

        <span class="pull-right date">17 Feb</span> 
        <img class="avatar pull-left" alt="user-avatar" src="images/avatar_50.jpg"/> 
                  <span class="pull-left" style="margin-left:5px;"><b>Jeff Hanneman</b>
                  <p>My vMaps plugin doesn't work</p> </span>
        
            <div style="clear:both"></div>      
        </div>


       
          
        
        </div>

      </div>
    </div>  


 <div class="content">

    <div class="mail-inbox">
      <div class="head">
        <h3>Inbox <span>(13 new)</span></h3>
        <input type="text" class="form-control"  placeholder="Search mail..." />
      </div>
      <div class="filters">
        <input id="check-all" type="checkbox" name="checkall" />
        <span>Select All</span>
        <div class="btn-group pull-right">
          <button class="btn btn-sm btn-flat btn-default" type="button"><i class="fa fa-angle-left"></i></button> 
          <button class="btn btn-sm btn-flat btn-default" type="button"><i class="fa fa-angle-right"></i></button> 
        </div>        
        <div class="btn-group pull-right">
          <button data-toggle="dropdown" class="btn btn-sm btn-flat btn-default dropdown-toggle" type="button">
          Order by <span class="caret"></span>
          </button>
          <ul role="menu" class="dropdown-menu">
            <li><a href="#">Date</a></li>
            <li><a href="#">From</a></li>
            <li><a href="#">Subject</a></li>
            <li class="divider"></li>
            <li><a href="#">Size</a></li>
          </ul>
        </div>

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
