@section('pageContent')


<div class="cl-mcont">    <div class="row">
      <div class="col-sm-12">
        <div class="block-flat profile-info">




          <div class="row">
            <div class="col-sm-12">
            <form action="user/adduser" method="GET">
            <input type="submit" class="btn btn-primary pull-right" id="addUser" type="button" value="Add User">
        
 <div class="header">
          <h3>Co-Workers</h3>

 </div>

            <table class="striped">
      
            	@foreach($users as $user)
            	<tr>
<td><a href="/user/{{$user->id}}">{{$user->firstName . " " . $user->lastName}}</a></td>
</tr>
            	@endforeach

            </table>


            </div>
            
         
           
          </div>
        </div>
      </div>
    </div>
</div>



  

@stop