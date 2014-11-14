@section('pageContent')


  <div class="row">
      <div class="col-md-12">

    <div class="block-flat">
          <div class="header">							
            <h3>Add User</h3>
          </div>
          <div class="content">
             <form method="POST" class="form-horizontal group-border-dashed" action="#" style="border-radius: 0px;"  role="form"  data-parsley-validate novalidate>
              <div class="form-group">
                <label class="col-sm-3 control-label">First Name</label>
                @if (Session::has('firstName'))
                required first 
                @endif

                <div class="col-sm-6">
                  <input type="text" name="firstName" required parsley-type="alphanum" id="firstName" class="form-control">
                </div>
                {{ $errors->first('firstName','<div class="error">:message</div>')}}
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Last Name</label>
             
                <div class="col-sm-6">
                  <input type="text" required parsley-type="alphanum" id="lastName" name="lastName" class="form-control">
                </div>
                      {{ $errors->first('lastName','<div class="error">:message</div>')}}
              </div>
            
              <div class="form-group">
                <label class="col-sm-3 control-label">Username</label>
                <div class="col-sm-6">
                  <input type="text" readonly="readonly" class="form-control" value="">
                </div>
              </div>
 
              <div class="form-group">
              
                <div class="col-sm-6">
                  <input type="submit" class="pull-right  btn btn-primary clearfix" value="submit">
                </div>
              </div>
              

            </form>
          </div>
        </div>

        </div>
        </div>
        @stop
 
        <!--
@section('js')
        <script src="{{asset('js/jquery.parsley/dist/parsley.js')}}" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('form').parsley();
    });
  </script>  
  @stop
  -->
