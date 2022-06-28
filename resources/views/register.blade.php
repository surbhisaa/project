<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- font icons -->
  <link rel="stylesheet" href='{{url("/")}}/assets/vendors/themify-icons/css/themify-icons.css'>
    <!-- owl carousel -->
    <link rel="stylesheet" href='{{url("/")}}/assets/vendors/owl-carousel/css/owl.carousel.css'>
    <link rel="stylesheet" href='{{url("/")}}/assets/vendors/owl-carousel/css/owl.theme.default.css'>
    <!-- Bootstrap + Ollie main styles -->
    <link rel="stylesheet" href='{{url("/")}}/assets/css/ollie.css'>
    <style>
            
            .card-body{
                align-items: center;
                background-color: #e9eccf;
                justify-content: center;
            }
            .input-group {
              width: 50%;
            }
            .form-control {
              background-color: #fff;
            }
        </style>

</head>
<body class="hold-transition register-page" style="background-image: url('{{url("assets/imgs/img-0.jpg")}}')">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Users</b>Registration</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form method="post" action="{{ route('register')}}">
          @csrf
        <div class="input-group mb-3">
          <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @error('name')
        <div class="text-danger"> {{$message}}</div>
        @enderror
        <div class="input-group mb-3">
          <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
        <div class="text-danger"> {{$message}}</div>
        @enderror
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
        <div class="text-danger"> {{$message}}</div>
        @enderror
        <div class="input-group mb-3">
          <input type="password" name="password-confirmation" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      <a href="{{route('getLogin')}}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

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