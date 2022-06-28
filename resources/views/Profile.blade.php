<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Ollie landing page.">
    <meta name="author" content="Devcrud">
    <!-- AJAX Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>New project</title>


    <!-- font icons -->
    <link rel="stylesheet" href='{{url("/")}}/assets/vendors/themify-icons/css/themify-icons.css'>

    <!-- owl carousel -->
    <link rel="stylesheet" href='{{url("/")}}/assets/vendors/owl-carousel/css/owl.carousel.css'>
    <link rel="stylesheet" href='{{url("/")}}/assets/vendors/owl-carousel/css/owl.theme.default.css'>

    <!-- Bootstrap + Ollie main styles -->
    <link rel="stylesheet" href='{{url("/")}}/assets/css/ollie.css'>
    <style>
        .navbar.affix-top .nav-link {
            color: #ab5757;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <nav id="scrollspy" class="navbar navbar-light bg-light navbar-expand-lg fixed-top affix" data-spy="affix" data-offset-top="20">
        <div class="container">
            <a class="navbar-brand" href="#"><img src='{{url("/")}}/assets/imgs/brand.svg' alt="" class="brand-img"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard')}}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard')}}">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard')}}">Testmonial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard')}}">Blog</a>
                    </li>
                    @if (Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login')}}">Log in</a>
                    </li>
                    @endif
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <button class="btn btn-primary circle"><i class="ti-heart"></i></button>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="{{ route('changePassword')}}" class="dropdown-item">
                                <!-- Message Start -->
                                Change Password
                            </a>
                            <a href="{{ route('logout')}}" class="dropdown-item">
                                <!-- Message Start -->
                                <i class="feather icon-log-out"></i>Logout                          

                            </a>
                        </div>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            
                        </div>
                    </li>
                    @endif
                    <li class="nav-item ml-0 ml-lg-4">
                        <a class="nav-link btn btn-primary" href="components.html">Components</a>
                    </li>
                </ul>
                </ul>

            </div>
        </div>
    </nav>
    <form action="update" method="post" enctype="multipart/form-data" id="data">
    <section class="section" id="profile">

        <div class="container mb-3">
            <h6 class="xs-font mb-0">Welcome to your profile.</h6>
            <h3 class="profile-username text-center"> Welcome {{auth()->user()->name}}</h3>
            <h3 class="section-title mb-5">Profile</h3>

            <div class="blog-wrapper">
                <div class="img-wrapper">
                    <img src='{{url("imgs/")}}/{{$data->profile_image}}' alt="Download free bootstrap 4 landing page, free boootstrap 4 templates, Download free bootstrap 4.1 landing page, free boootstrap 4.1.1 templates, ollie Landing page">
                    <div class="date-container">
                        <h6 class="day">30</h6>
                        <h6 class="mun">Oct</h6>
                    </div>
                </div>

                <!-- @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif -->
                
                <ul id="saveform_errList"></ul>

                <div id="success_message"></div>

                <div class="row mt-5">
                    <div class="col-md-6">
                        <h6 class="section-secondary-title">Details :</h6>

                        <input type="hidden" value="{{auth()->user()->id}}" id="user_id">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control name" id="exampleFormControlInput1" name="name" placeholder= '{{ $data->name }}'>
                        </div>
                        <div class="form-group">
                            <lable>Address</lable>
                            <input type="text" class="form-control address" id="exampleFormControlInput1" name="address" placeholder= '{{ $data->address}}'>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control profile_image" id="exampleFormControlInput1" name="profile_image" placeholder="profile">
                        </div>
                        <div class="form-group">
                            <input value='{{ $data->date_of_birth}}' type="date" class="form-control date" id="exampleFormControlInput1" name="date_of_birth" placeholder='{{ $data->date_of_birth}}'>
                        </div>
                        <div class="form-group">
                            <?php 
                        if( $data->profile_type==0){
                            $profile_type = 'user';
                        } 
                        else
                        {
                            $profile_type = 'admin';
                        }
                        ?>    
                            <select class="form-control profile_type" name="profile_type" id="exampleFormControlSelect1" value='{{ $data->profile_type}}'>
                                <option>Working Profile</option>
                                <option value="admin" @if(@$profile_type=='admin') {{'selected'}} @endif>Admin</option>
                                <option value="user" @if(@$profile_type=='user') {{'selected'}} @endif>User</option>
                      
                            </select>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary update_details">Update Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="txt-wrapper">
                        <h4 class="blog-title">Your message.</h4>
                        @if(!empty($lastMsg))
                        <p>{{$lastMsg->message}}</p>
                        @else
                        <p>No message found.</p>
                        @endif

                        <a href="#" class="badge badge-info">Graphic Design</a>

                        <h6 class="blog-footer">
                            <a href="javascript:void(0)"><i class="ti-user"></i> Admin </a> |
                            <a href="javascript:void(0)"><i class="ti-thumb-up"></i> 213 </a> |
                            <a href="javascript:void(0)"><i class="ti-comments"></i> 123</a>
                        </h6>
                    </div>
                </div>
            </div>
    </section>
    </form>
    <footer class="footer mt-5 border-top">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 text-center text-md-left">
                <p class="mb-0">Copyright <script>
                        document.write(new Date().getFullYear())
                    </script> &copy; <a target="_blank" href="http://www.devcrud.com">DevCRUD</a></p>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="social-links">
                    <a href="javascript:void(0)" class="link"><i class="ti-facebook"></i></a>
                    <a href="javascript:void(0)" class="link"><i class="ti-twitter-alt"></i></a>
                    <a href="javascript:void(0)" class="link"><i class="ti-google"></i></a>
                    <a href="javascript:void(0)" class="link"><i class="ti-pinterest-alt"></i></a>
                    <a href="javascript:void(0)" class="link"><i class="ti-instagram"></i></a>
                    <a href="javascript:void(0)" class="link"><i class="ti-rss"></i></a>
                </div>
            </div>
        </div>
    </footer>

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

    <script>
        $(document).ready(function() {
                $("#data").submit(function(e) {
                        e.preventDefault()

                        var user_id = $('#user_id').val();
                    
                        var formData = new FormData(this);

                        // var data = {
                        //     'name': $('.name').val(),
                        //     'address': $('.address').val(),
                        //     'profile_image': $('.profile_image').val(),
                        //     'date_of_birth': $('.date').val(),
                        //     'profile_type': $('.profile_type').val(),
                        // }
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                                type: "post",
                                url: "update/" +user_id,
                                data: formData,
                                datatype: "json",
                                cache:false,
                                contentType:false,
                                processData:false,
                                success: function(response) {
                                    console.log(response)
                                    if (response.status == 400) {

                                        $('#saveform_errList').html("");
                                        $('#saveform_errList').addClass('alert alert-danger');
                                        $.each(response.errors, function(key, err_values) {
                                            $('#saveform_errList').append('<li>' + err_values + '</li>');
                                        });

                                    } else {
                                        $('#saveform_errList').html("");
                                        $('#success_message').addClass('alert alert-success')
                                        $('#saveform_errList').hide();
                                        $('#success_message').text(response.message)

                                    }
                                }
                            });
                        });
                   });
         </script>

     </body>
 </html>