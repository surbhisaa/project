@extends('layouts.user.layout')

@section('temp_body')

<body>
    <section style="padding-top:60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            Products
                        </div>
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error')}}
                        </div>
                        @endif

                        <div id="success_message"></div>

                        <ul id="saveform_errList"></ul>

                        <div class="card-body">
                            <div class="owl-carousel owl-theme">

                            @foreach($prods as $prod)
                                <div class="item">
                                    <din class="card">
                                        <img src='{{url("imgs/")}}/{{$prod->img_product}}' alt="product_image">
                                        <div class="card-body">
                                            <h5>{{$prod->title}}</h5>
                                            <small>
                                                <p class="text-info">Obout Product: {{$prod->prod_details}}</p>
                                            </small><br>
                                            <small>Price: {{$prod->price}}</small><br>
                                            <small>Exp: {{$prod->exp_date}}</small><br>
                                            <small>Quantity: {{$prod->quantity}}</small>

                                            <div class="col-md-9"><br />

                                                <button type="button" class="btn btn-success me-3 addtoWishBtn float-start" value="{{$prod->id}}">Add to wishlist <i class="ti-heart"></i></button>
                                                <button type="button" class="btn btn-warning me-3 addtoCartBtn float-start" value="{{$prod->id}}">Add to Cart <i class="ti-thumb-up"></i></button>
                                            </div>
                                        </div>
                                </div>
                                </din>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

@endsection


@section('temp_script')


<script>
    $(document).ready(function() {
        $('.addtoCartBtn').click(function(e) {
            e.preventDefault();

            var product_id = $(this).val(); //closest('.product_data').find('.prod_id').val();
            // alert(product_id);
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $.ajax({
                type: "post",
                url: "addtoCart",
                data: {
                    'product_id': product_id
                },
                success: function(response) {
                    alert(response.status);

                }
            });

        });

        $('.addtoWishBtn').click(function(e) {
            e.preventDefault();

            var WishList_id = $(this).val(); //closest('.product_data').find('.prod_id').val();
            // alert(product_id);
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $.ajax({
                type: "post",
                url: "addtoWish",
                data: {
                    'WishList_id': WishList_id
                },
                success: function(response) {
                    alert(response.status);

                }
            });

        });
    });


    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
</script>

@endsection
</body>

</html>