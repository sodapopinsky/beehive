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
                <h1 class="name">{{$user->firstName . " " . $user->lastName}}</h1>
                <div class="btn btn-primary">Send a Message</div>
                <div style="padding-top:10px;"><span class="fa fa-phone" ></span> 
                @if($user->phone != null)
                {{$user->phone}}
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