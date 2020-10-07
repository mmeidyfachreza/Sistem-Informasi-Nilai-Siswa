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
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span>Halaman Login</span><strong class="text-primary">SMKN 2</strong></div>
            <p>Pastikan akun anda sudah terdaftar terlebih dahulu</p>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('login') }}" class="text-left form-validate">
                @csrf
              <div class="form-group-material">
                <input id="email" type="text" name="email" required data-msg="Masukan Username Anda" class="input-material">
                <label for="email" class="label-material">Username</label>
              </div>
              <div class="form-group-material">
                <input id="password" type="password" name="password" required data-msg="Masukan Password Anda" class="input-material">
                <label for="password" class="label-material">Password</label>
              </div>
              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
              </div>
            </form>
          </div>
          <div class="copyrights text-center">
            <p><a href="#" class="external">SMK NEGERI 2</a>                        </p>
          </div>
        </div>
      </div>
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
