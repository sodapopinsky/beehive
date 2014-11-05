@section('pageContent')


<div class="cl-mcont">    <div class="row">
      <div class="col-sm-12">
        <div class="block-flat profile-info">
          <div class="row">
            <div class="col-sm-2">
              <div class="avatar">
                <img src="images/avatars/avatar1.jpg" alt="user-avatar" class="profile-avatar" />
              </div>
            </div>
            
            <div class="col-sm-7">
              <div class="personal">
                <h1 class="name">{{Auth::user()->firstName . " " . Auth::user()->lastName}}</h1>
                <p class="description"><p>
              </div>
            </div>
           
          </div>
        </div>
      </div>
    </div>
</div>



  

@stop