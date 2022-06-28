<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>

    <!-- font icons -->
    <link rel="stylesheet" href='{{url("/")}}/assets/vendors/themify-icons/css/themify-icons.css'>
    <!-- owl carousel -->
    <link rel="stylesheet" href='{{url("/")}}/assets/vendors/owl-carousel/css/owl.carousel.css'>
    <link rel="stylesheet" href='{{url("/")}}/assets/vendors/owl-carousel/css/owl.theme.default.css'>
    <!-- Bootstrap + Ollie main styles -->
    <link rel="stylesheet" href='{{url("/")}}/assets/css/ollie.css'>
    <style>
            .main {
                text-align:center; 
            }
            .GFG {
                color:#009900;
                font-size:50px;
                font-weight:bold;
            }
            .input-group {
                position: relative;
                display:flex;
                flex-wrap: wrap;
                align-items: stretch;
                width: 50%;
            }
            .card-body{
                align-items: center;
                background-color: #e9eccf;
                display: inline;
                height: 50vh;
                justify-content: center;
            }
        </style>
</head>

<body class="hold-transition login-page" style="background-image: url('{{url("assets/imgs/img-0.jpg")}}')">

    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Login</b>Panel</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                @if(session('error'))
                <div class="text-danger text-center">
                    {{session('error')}}
                </div>
                @endif
                @if(session('success'))
                <div class="text-success text-center">
                    {{session('success')}}
                </div>
                @endif
                <p class="login-box-msg">Sign in to start your session</p>

                <div style="text-align:center webkit-center">
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="input-group mb-1">
                            <input name="email" type="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                        <div class="text-danger"> {{$message}}</div>
                        @enderror
                        <div class="input-group mb-1">
                            <input name="password" type="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                        <div class="text-danger"> {{$message}}</div>
                        @enderror
                        <div class="row" style="padding-left: 331px">
                            <div class="col-2">
                                <div class="icheck-primary">
                                    <input name="remember" type="checkbox" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>

                <p class="mb-0">
                    <a href="{{route('register')}}" class="text-center">Register a new membership</a>
                </p>
            </div>
        </div>
    </div>



    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- core  -->
    <script src='{{url("/")}}/assets/vendors/jquery/jquery-3.4.1.js'></script>
    <script src='{{url("/")}}/assets/vendors/bootstrap/bootstrap.bundle.js'></script>

    <!-- bootstrap 3 affix -->
    <script src='{{url("/")}}/assets/vendors/bootstrap/bootstrap.affix.js'></script>

    <!-- Owl carousel  -->
    <script src='{{url("/")}}/assets/vendors/owl-carousel/js/owl.carousel.js'></script>


    <!-- Ollie js -->
    <script src='{{url("/")}}/assets/js/Ollie.js'></script>

</body>

</html>