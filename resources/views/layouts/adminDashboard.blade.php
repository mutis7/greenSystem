<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Green System') }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('adminAssets/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('adminAssets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('adminAssets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">

    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('adminAssets/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('adminAssets/build/css/custom.min.css')}}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{asset('adminAssets/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('adminAssets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('adminAssets/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('adminAssets/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('adminAssets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
  </head>  


  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-dashboard"></i> <span>Green System</span></a>
            </div>
            <div class="clearfix"></div>
            <hr />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('activeusers')}}">active</a></li>                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-user"></i> Employees <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('employees/create')}}">add employee</a></li>
                      <li><a href="{{url('employees')}}">view employees</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-car"></i> vehichles <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('vehicles/create')}}">add vehicle</a></li>
                      <li><a href="{{url('vehicles')}}">view vehicles</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-map"></i> regions <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a>Counties<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="{{url('/counties/create')}}">Add County</a></li>
                            <li><a href="{{url('/counties')}}">View Counties</a></li>
                          </ul>
                        </li>
                      <li><a>Locations<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="{{url('/locations/create')}}">Add Location</a></li>
                            <li><a href="{{url('/locations')}}">View Location</a></li>
                          </ul>
                        </li>
                      <li><a>Houses<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="{{url('allhouses')}}">Active Houses</a></li>
                             <li><a href="{{url('activatehouses')}}">Dormant Houses</a></li>                           
                          </ul>
                        </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-tasks"></i> Assign Employees<span class="fa fa-chevron-down"></span> </a>
                    <ul class="nav child_menu">
                        <li><a href="{{url('jobs/create')}}">Create job</a></li>
                        <li><a href="{{url('jobs')}}">View jobs</a></li>
                        <li><a href="{{url('exceptionjobs')}}">View exceptions</a></li>
                    </ul>
                  </li>
                  <li><a>Payments<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="{{url('/payments/create')}}">manual payments</a></li>
                            <li><a href="{{url('/payments')}}">View Payments</a></li>
                          </ul>
                        </li>
                  <li><a><i class="fa fa-list"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('readcomplaints')}}">read complaints</a></li>
                      <li><a href="#">B</a></li>
                      <li><a href="#">C</a></li>
                      <li><a href="#">D</a></li>
                      <li><a href="#">E</a></li>
                    </ul>
                  </li>
                </ul>
              </div>    

            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="#" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->username }} <span class=" fa fa-angle-down"></span></a>                  
                  
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{url('adminedit')}}"> Profile</a></li>
                    <li>
                       <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                         {{ csrf_field() }}
                        </form>
                       </li>
                  </ul>
                </li>
                <li role="presentation" class="dropdown">
                  <a href="{{url('unreadcomplaints')}}" class="info-number">
                    <span class="fa fa-envelope-o"></span> complaints 
                    @if($unread)
                    <span class="badge bg-green">{{$unread}} </span>                
                    @endif
                  </a>
                </li>
                <li><a href="{{url('activatehouses')}}" class="info-number">
                <span class="fa fa-houe"></span>pending Houses
                @if($pending)
                    <span class="badge bg-green">{{$pending}} </span>                
                    @endif
                </a></li>
                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
       <div class="right_col" role="main">
          <div class="">
            @yield('content')
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('adminAssets/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('adminAssets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('adminAssets/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('adminAssets/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

  
    <!-- Custom Theme Scripts -->
    <script src="{{asset('adminAssets/build/js/custom.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{ asset('adminAssets/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('adminAssets/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('adminAssets/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('adminAssets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ asset('adminAssets/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('adminAssets/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('adminAssets/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('adminAssets/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ asset('adminAssets/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ asset('adminAssets/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('adminAssets/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{ asset('adminAssets/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
  </body>
</html>
