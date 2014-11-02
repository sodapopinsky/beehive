<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/icon.png">

  <title>Flat Dream</title>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

  <!-- Bootstrap core CSS -->
  <link href="js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="js/jquery.gritter/css/jquery.gritter.css" />
  <link rel="stylesheet" href="fonts/font-awesome-4/css/font-awesome.min.css">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="../../assets/js/html5shiv.js"></script>
    <script src="../../assets/js/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="js/jquery.nanoscroller/nanoscroller.css" />
    <link rel="stylesheet" type="text/css" href="js/jquery.codemirror/lib/codemirror.css">
  <link rel="stylesheet" type="text/css" href="js/jquery.codemirror/theme/ambiance.css">
  <link rel="stylesheet" type="text/css" href="js/jquery.vectormaps/jquery-jvectormap-1.2.2.css"  media="screen"/>
  
  <link href="css/skin-orange.css" rel="stylesheet" />  
  @yield('css')
</head>

<body>

<div id="cl-wrapper">

  <div class="cl-sidebar">
    <div class="cl-toggle"><i class="fa fa-bars"></i></div>
    <div class="cl-navblock">
      <div class="menu-space">
        <div class="content">

           <div class="sidebar-logo">
            <div class="logo">
                <a href="index2.html"></a>
            </div>
          </div>
         
          <ul class="cl-vnavigation">
     
            <li  ><a href="/facebook"><i class="fa  fa-facebook"></i><span>Facebook</span></a></li>
          <li  ><a href="/twitter"><i class="fa  fa-twitter"></i><span>Twitter</span></a></li>

          </ul>
        </div>
      </div>
      <div class="text-right collapse-button" style="padding:7px 9px;">
       copyright 2014 Nicholas Spitale
     
      </div>
    </div>
  </div>
  <div class="container-fluid" id="pcont">
   <!-- TOP NAVBAR -->
  <div id="head-nav" class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-collapse">
        <ul class="nav navbar-nav navbar-right user-nav">
          <li class="dropdown profile_menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img alt="Avatar" src="images/avatar6-2.jpg" /><span>{{Auth::user()->firstName . ' ' . Auth::user()->lastName}} </span> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="/user">My Profile</a></li>

              <li>{{link_to('logout','Sign Out')}}</li>
            </ul>
          </li>
        </ul>     
        <ul class="nav navbar-nav not-nav">
          <li class="button dropdown">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class=" fa fa-inbox"></i></a>
            <ul class="dropdown-menu messages">
              <li>
                <div class="nano nscroller">
                  <div class="content">
                    <ul>
                      <li>
                       
                         <div class="small text-center text-muted" style="padding-top:80px;">You have no messages</div>
                        
                      </li>
                
                    </ul>
                  </div>
                </div>
               <!--  <ul class="foot"><li><a href="#">View all messages </a></li></ul>   -->        
              </li>
            </ul>
          </li>
          <li class="button dropdown">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i></a>
            <ul class="dropdown-menu">
              <li>
                <div class="nano nscroller">
                  <div class="content">
                    <ul>
                     <!-- <li><a href="#"><i class="fa fa-cloud-upload info"></i><b>Daniel</b> is now following you <span class="date">2 minutes ago.</span></a></li> -->
                         <div class="small text-center text-muted" style="padding-top:80px;">You have no notifications</div>
                      
                    </ul>
                  </div>
                </div>
               <!--  <ul class="foot"><li><a href="#">View all activity </a></li></ul> -->          
              </li>
            </ul>
          </li>
          
        </ul>

      </div><!--/.nav-collapse animate-collapse -->
    </div>
  </div>
  

@yield('pageContent')


  <script src="js/jquery.js"></script>
  <script src="js/jquery.cookie/jquery.cookie.js"></script>
  <script src="js/jquery.pushmenu/js/jPushMenu.js"></script>
  <script type="text/javascript" src="js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
  <script type="text/javascript" src="js/jquery.sparkline/jquery.sparkline.min.js"></script>
  <script type="text/javascript" src="js/jquery.ui/jquery-ui.js" ></script>
  <script type="text/javascript" src="js/jquery.gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="js/behaviour/core.js"></script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <script src="js/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="js/jquery.codemirror/lib/codemirror.js"></script>
  <script src="js/jquery.codemirror/mode/xml/xml.js"></script>
  <script src="js/jquery.codemirror/mode/css/css.js"></script>
  <script src="js/jquery.codemirror/mode/htmlmixed/htmlmixed.js"></script>
  <script src="js/jquery.codemirror/addon/edit/matchbrackets.js"></script>
  <script src="js/jquery.vectormaps/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="js/jquery.vectormaps/maps/jquery-jvectormap-world-mill-en.js"></script>
  <script src="js/behaviour/dashboard.js"></script>
  
  
<script type="text/javascript" src="js/jquery.flot/jquery.flot.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.labels.js"></script>
</body>
</html>