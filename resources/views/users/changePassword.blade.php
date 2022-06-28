@extends('layouts.user.layout')

@section('temp_body')

<body>
    <section style="padding-top:60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">

                        <div class="card-header">
                            Change Password
                        </div>
               {{--         @if (Auth::check()) 
                        @if (session()->has('user_name'))
                            {{session()->get('user_name')}}
                        @else
                        Guest
                        @endif
                        @endif  it is not work because to set the session we need to call the route manualy --}}

                        <div id="success_message"></div>

                        <ul id="saveform_errList"></ul>

                        <div class="card-body">
                            <form action="{{route('updatePassword')}}" id="change_password" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" name="old_password" class="form-control" id="old_password">

                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="new_password" class="form-control" id="new_password">

                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password">

                                </div>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
@section('js-script')

    
    <!--ajax js -->
    <script src='{{url("/")}}/assets/js/changepassword.js'></script>
    

   <script>
        $(document).ready(function() {
            $("#change_password").on('submit', function(e) {
                e.preventDefault()


                var formData = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "updatePassword",
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
                            $('#change_password')[0].reset();

                        }
                        
                    }
                });
            });
        });
    </script>
    @endsection
