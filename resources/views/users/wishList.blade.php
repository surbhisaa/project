@extends('layouts.user.layout')

@section('temp_body')

<body>
    <div class = "py-3 mb-4 shadow-sm bg-warning border-top">
        <div class = "container">
        <h6 class = "mb-0">
                <li class = "nav-item">
                <a class = "nav-link active" href = "{{url ('/')}}">Home</a>
                </li>
                <a class = "nav-link" href="{{url('viewCart')}}">Cart
                <span class="badge badge-success cart_count">{{$cartcount}}</span>
                </a>
                <a class = "nav-link" href="{{url('wishList')}}">WishList
                <?php if (request()->session()->has('count')) {
                    $count = request()->session()->get('count');
                } else {
                    $count = 0;
                }
                echo ($count);
                ?>
                <span class="badge badge-primary wish_count">0</span>
                
            </h6>
        </div>
    </div>
    
    <section style="padding-top:60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    
                        <div class="card-header">
                            Products
                        </div>
                        @foreach($wishItems as $items)
                        <div class="card-body">
                            <div class = "row">
                                <div class = "col-md-4">
                                    <img src ='{{url("imgs/")}}/{{$items->products->img_product}}' height="80px" width="80px" alt="Image here">
                                </div>
                                <div class="col-md-6">
                                    <h3> {{$items->products->title}}</h3>
                                </div>
                                <div class="col-md-2">
                                <button class="btn btn-danger delete-wish-item" value="{{$items->products->id}}"><i class="fa fa-trash"></i>Remove</button>
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

        loadWish();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        function loadWish() {
            $.ajax({
                method: "GET",
                url: "load-wish-data",
                success: function(response) {
                    $('.wish_count').html('');
                    $('.wish_count').html(response.count);
                }
            });
        }


        $(document).on('click', '.delete-wish-item', function(e) {
        e.preventDefault();
        var product_id = $(this).val();

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
            method: "POST",
            url: "delete-wish-item",
            data: {
                'product_id':product_id
            },
            success: function (response) {
                window.location.reload();
                alert("",response.status,"success");

            }

        });
    });
});
</script>

@endsection