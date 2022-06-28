@extends('layouts.admin.layout')

@section('body')

    <section style="padding-top:60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">

                        <div class="card-header">
                            Add Product
                        </div>
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error')}}
                        </div>
                        @endif

                        <div id="success_message"></div>

                        <ul id="saveform_errList"></ul>

                        <div class="card-body">
                            <form action="{{route('addProduct')}}" id="add_product" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="old_password">Add Title</label>
                                    <input type="text" name="title" class="title form-control" id="title">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Add image of the product</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="prod_image custom-file-input" name="prod_image" id="prod_image">
                                            <label class="custom-file-label" for="exampleInputFile">IMAGE</label>
                                            <img id="previewImg1" alt="template image" style="max-width:130px;margin-top:20px;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <textarea name="product_details" id="product_details" cols="30" rows="5" class="product_details form-control" placeholder="Topic details"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Price of the product</label>
                                    <input type="text" name="product_price" class="product_price form-control" id="product_price">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity of the product</label>
                                    <input type="text" name="quantity" class="quantity form-control" id="quantity">
                                </div>
                                <div class="form-group">
                                    <label for="exp_date">Expiring date</label>
                                    <input type="date" name="exp_date" class="exp_date form-control" id="exp_date">
                                </div>
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 @endsection
@section('js-script')

   <script>
        $(document).ready(function() {
            $("#add_product").on('submit', function(e) {
                e.preventDefault()


                var formData = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "addProduct",
                    data: formData,
                    // datatype: "json",
                    cache: false,
                    contentType: false,
                    processData: false,

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
                            $('#add_product')[0].reset();

                        }
                        
                    }
                });
            });
        });
    </script>
 @endsection
</body>

</html>