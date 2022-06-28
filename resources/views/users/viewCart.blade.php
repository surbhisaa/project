@extends('layouts.user.layout')

@section('temp_body')

<body>
    <!-- <div class="py-3 mb-4 shadow-sm bg-warning border-top">
    @foreach($counts as $count)
        <div class="container">
            <h6 class="mb-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{url ('/')}}">Home</a>
                </li>
                <a class="nav-link" href="{{url('viewCart')}}">Cart
                <span class="badge badge-success cart_count">{{$count->count}}</span>
                </a>
                <a class="nav-link" href="{{url('wishList')}}">WishList
                    <span class="badge badge-primary wish_count">0</span>
                </a>

            </h6>
        </div>
    @endforeach
    </div> -->
    <!-- <div class="collapse navbar-collapse" id="navbarnav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{url ('/')}}">Home</a>
            </li>
            <li class="nav-link"> href="{{url('addtoCart')}}">Cart
                <a class="badge badge-pill bg primary">0</a>
            </li>
            <li class="nav-link" href="{{url('wishList')}}">WishList
                <a class="badge badge-pill bg success">0</a>
            </li>
        </ul>
    </div> -->
    <section style="padding-top:60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            Products
                        </div>
                        @foreach($cartItems as $items)
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src='{{url("imgs/")}}/{{$items->products->img_product}}' height="80px" width="80px" alt="Image here">
                                </div>
                                <div class="col-md-6">
                                    <h3> {{$items->products->title}}</h3>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-danger delete-cart-item" value="{{$items->products->id}}"><i class="fa fa-trash"></i>Remove</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection

    @section('temp_script')

    <script>
        $(document).ready(function() {

            loadCart();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            function loadCart() {
                $.ajax({
                    method: "GET",
                    url: "load-cart-data",
                    success: function(response) {
                        $('.cart_count').html('');
                        $('.cart_count').html(response.count);
                    }
                });
            }

            $(document).on('click', '.delete-cart-item', function(e) {
                e.preventDefault();
                var product_id = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "delete-cart-item",
                    data: {
                        'product_id': product_id
                    },
                    success: function(response) {
                        window.location.reload();
                        swal("", response.status, "success");

                    }

                });
            });
        });
    </script>

    @endsection