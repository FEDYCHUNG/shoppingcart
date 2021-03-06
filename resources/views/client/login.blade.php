<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V3</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ url('frontend/login/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/login/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/login/fonts/iconic/css/material-design-iconic-font.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/login/vendor/animate/animate.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/login/vendor/css-hamburgers/hamburgers.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/login/vendor/animsition/css/animsition.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/login/vendor/select2/select2.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/login/vendor/daterangepicker/daterangepicker.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/login/css/util.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/login/css/main.css') }}" />
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{ asset('frontend/login/images/bg-01.jpg') }}');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="get" action="{{ route('login') }}">
                    @csrf
                    <a href="{{ url('/') }}">
                        <span class="login100-form-logo">
                            <i class="zmdi zmdi-landscape"></i>
                        </span>
                    </a>

                    <span class="login100-form-title p-b-34 p-t-27">
                        Log in
                    </span>

                    @if (Session::has('status'))
                        <div class="alert alert-success">
                            {{ Session::get('status') }}
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

                    <div class="wrap-input100 validate-input" data-validate="Enter email">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="p-t-50 text-center">
                        <a class="txt1" href="{{ url('/signup') }}">
                            Don't have account ? Sign up
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ url('frontend/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('frontend/login/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('frontend/login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ url('frontend/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('frontend/login/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('frontend/login/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ url('frontend/login/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('frontend/login/vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('frontend/login/js/main.js') }}"></script>

</body>

</html>
