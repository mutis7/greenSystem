<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>{{ config('app.name', 'Green System') }}</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{asset('assets/css/light-bootstrap-dashboard.css')}}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel='stylesheet' type='text/css'>
    <link href="{{asset('assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    <script src="{{asset('js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    {{ Auth::user()->username }}
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="{{url('/home')}}">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                
                    <a href="{{ url('useredit/'. Auth::user()->id) }}">
                        <i class="pe-7s-user"></i>
                        <p>My Profile</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/houses') }}">
                        <i class="pe-7s-home"></i>
                        <p>Houses</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('payforhouses') }}">
                        <i class="pe-7s-wallet"></i>
                        <p>Payments</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/suggestions')}}">
                        <i class="pe-7s-bell"></i>
                        <p>Suggestions</p>
                    </a>
                </li>
				
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">

            @yield('content')   

        </div>


        

</body>

    <!--   Core JS Files   -->

    <script src="{{asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="{{asset('assets/js/bootstrap-checkbox-radio-switch.js')}}"></script>

	<!--  Charts Plugin -->
	<script src="{{asset('assets/js/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>

	

</html>
