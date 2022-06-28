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

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <nav id="scrollspy" class="navbar navbar-light bg-light navbar-expand-lg fixed-top" data-spy="affix" data-offset-top="20">
        <div class="container">
            <a class="navbar-brand" href="#"><img src='{{url("/")}}/assets/imgs/brand.svg' alt="" class="brand-img"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testmonial">Testmonial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('viewProduct')}}">Products</a>
                    </li>
                    <li class="nav-item">
                    <a class = "nav-link" href="{{url('viewCart')}}">Cart
                    <span class="badge badge-success cart_count">{{$cartcount}}</span>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class = "nav-link" href="{{url('wishList')}}">WishList
                    <span class="badge badge-warning wish_count">{{$wishCount}}</span>
                    </a>
                    </li>


                @if (Auth::check() && !auth()->user()->profile_type)  
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
                            <a href="{{ route('Profile')}}" class="dropdown-item">
                                <!-- Message Start -->
                                Profile
                            </a>
                            <a href="{{ route('logout')}}" class="dropdown-item">
                                <!-- Message Start -->
                                Logout
                            </a>
                        </div>
                    </li>
                    @endif
                @endif    
                    <li class="nav-item ml-0 ml-lg-4">
                        <a class="nav-link btn btn-primary" href="components.html">Components</a>
                    </li>
                </ul>
                </ul>

            </div>
        </div>
    </nav>


    <header id="home" class="header">
        <div class="overlay"></div>

        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="container">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="carousel-title">We Make<br> Creative Design</h1>
                            <button class="btn btn-primary btn-rounded">Learn More</button>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="carousel-title">We Make <br> Responsive Design</h1>
                            <button class="btn btn-primary btn-rounded">Learn More</button>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="carousel-title">We Make <br> Simple Design</h1>
                            <button class="btn btn-primary btn-rounded">Learn More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="infos container mb-4 mb-md-2">
            <div class="title">
                <h6 class="subtitle font-weight-normal">Are locking for</h6>
                <h5>Lorem inpsum</h5>
                <p class="font-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
            <div class="socials text-right">
                <div class="row justify-content-between">
                    <div class="col">
                        <a class="d-block subtitle"><i class="ti-microphone pr-2"></i> (123) 456-7890</a>
                        <a class="d-block subtitle"><i class="ti-email pr-2"></i> info@website.com</a>
                    </div>
                    <div class="col">
                        <h6 class="subtitle font-weight-normal mb-2">Social Media</h6>
                        <div class="social-links">
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-facebook"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-twitter-alt"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-google"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-pinterest-alt"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-instagram"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-rss"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('temp_body')


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
        </div>
    </section>

    

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

    @yield('temp_script')