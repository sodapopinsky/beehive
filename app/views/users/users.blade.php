@section('pageContent')


  <div class="cl-mcont">    <div class="row">
      <div class="col-sm-12">

        <div class="block-flat">
          <form action="user/adduser" method="GET">
            <input type="submit" class="btn btn-primary pull-right" id="addUser" type="button" value="Add User">
      </form>
            <div class="header">
              <h3>Co-Workers</h3>
            </div>
            <div class="content">
              <table class="no-border">
                <thead class="no-border">
                  <tr>
                    <th style="width:50%;">Name</th>
             
                  </tr>
                </thead>
                <tbody class="no-border-x no-border-y">
                  @foreach($users as $user)
              <tr>
<td><a href="/user/{{$user->id}}">{{$user->firstName . " " . $user->lastName}}</a></td>
</tr>
              @endforeach
                              </tbody>
              </table>
            </div>
          </div>

      </div>
    </div>


</div>

  

@stop