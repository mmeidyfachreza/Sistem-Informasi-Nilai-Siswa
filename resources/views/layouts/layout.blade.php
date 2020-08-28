<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SMK Negeri 2</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('template/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <script src="https://kit.fontawesome.com/ce07c321e4.js" crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="{{asset('template/vendor/font-awesome/css/font-awesome.min.css')}}"> --}}
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{asset('template/css/fontastic.css')}}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">

    @yield('link')

    <!-- jQuery Circle-->
    <link rel="stylesheet" href="{{asset('template/css/grasp_mobile_progress_circle-1.0.0.min.css')}}">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet"
        href="{{asset('template/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('template/css/style.default.premium.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('template/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('template/img/favicon.ico')}}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">

    @yield('custom-style')
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <nav class="side-navbar">
        <div class="side-navbar-wrapper">
            <!-- Sidebar Header    -->
            <div class="sidenav-header d-flex align-items-center justify-content-center">
                <!-- User Info-->
                @if (Auth::user()->guru)
                <div class="sidenav-header-inner text-center">
                    <h2 class="h5">{{Auth::user()->guru->nama}}</h2><span></span>
                </div>    
                @else
                <div class="sidenav-header-inner text-center">
                    <h2 class="h5">{{Auth::user()->siswa->nama}}</h2><span></span>
                </div>
                @endif
                <!-- Small Brand information, appears on minimized sidebar-->
                <div class="sidenav-header-logo"><a href="{{url('/')}}" class="brand-small text-center">
                        <strong>B</strong><strong class="text-primary">U</strong></a></div>
            </div>
            <!-- Sidebar Navigation Menus-->
            @yield('sidebar')
            
        </div>
    </nav>
    <div class="page">
        <!-- navbar-->
        <header class="header">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-holder d-flex align-items-center justify-content-between">
                        <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars">
                                </i></a><a href="{{url('/')}}" class="navbar-brand">
                                <div class="brand-text d-none d-md-inline-block"><span> </span><strong
                                        class="text-primary">SMK Negeri 2</strong></div>
                            </a></div>
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                            <!-- Notifications dropdown-->
                            
                            <!-- Log out-->
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link logout" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <span class="d-none d-sm-inline-block">Logout</span><i
                                        class="fa fa-sign-out"></i></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Counts Section -->
        @yield('content')
        <footer class="main-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <p>SMK Negeri 2&copy; 2020</p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <p>Version 1</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('template/js/grasp_mobile_progress_circle-1.0.0.min.js')}}"></script>
    <script src="{{asset('template/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>

    <script src="{{asset('template/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('template/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}">
    </script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


    <!-- Notifications-->
    <script src="{{asset('template/vendor/messenger-hubspot/build/js/messenger.min.js')}}"> </script>
    <script src="{{asset('template/vendor/messenger-hubspot/build/js/messenger-theme-flat.js')}}"> </script>
    <!-- Main File-->
    @yield('script')
    <script src="{{asset('template/js/front.js')}}"></script>
    @yield('custom-script')
</body>

</html>
