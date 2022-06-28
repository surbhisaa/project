@extends('layouts.admin.layout')

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection

@section('body')

<div class="row">
    <div class="container fluid">
        Dashboard

        <!-- EditUserModel -->

        <div class="modal fade" id="EditUserModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form enctype="multipart/form-data" id="dataUpdate" method="POST">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit and Update User</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <ul id="updateform_errList"></ul>

                            <input type="hidden" value="{{auth()->user()->id}}" id="edit_user_id">

                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" id="edit_name" name="name" class="name form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" id="edit_email" name="email" class="email form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Address</label>
                                <input type="text" id="edit_address" name="address" class="address form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">DOB</label>
                                <input type="date" id="edit_date" name="date" class="date form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Choose Profile Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="profile_image custom-file-input" name="profile_image" id="edit_profile">
                                        <label class="custom-file-label" for="exampleInputFile">IMAGE</label>
                                        <img id="previewImg1" alt="profile image" style="max-width:130px;margin-top:20px;" />
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary update_user">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- end EditUserModel -->

        <!-- DeleteUserModel -->
        <div class="modal fade" id="DeleteUserModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" id="delete_user_id">

                        <h4>Are you sure, you want to delete the status?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary delete_user_btn">Yes Change</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end DeleteUserModel -->

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Default Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"><b>DESCRIPTION</b>
                        <div id="show_desc">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>





        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">ADD </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="projectform" action="{{route('userStore')}}" enctype="multipart/form-data">
                            @CSRF
                            <input type="hidden" value="{{auth()->user()->id}}" name="id" id="user_id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampletitle">NAME</label>
                                    <input type="text" class="name form-control" name="name" id="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampletitle">PASSWORD</label>
                                    <input type="password" class="password form-control" name="password" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampletitle">EMAIL</label>
                                    <input type="text" class="email form-control" name="email" id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampletitle">ADDRESS</label>
                                    <input type="text" class="address form-control" name="address" id="address" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label for="exampletitle">DOB</label>
                                    <input type="date" class="date form-control" name="date" id="date" placeholder="date of birth">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Choose Profile Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="profile_image custom-file-input" name="profile_image" onchange="previewFile(event)">
                                            <label class="custom-file-label" for="exampleInputFile">IMAGE</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <img id="previewImg" alt="profile image" style="max-width:130px;margin-top:20px;">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{url('AdminLogin')}}">
                                    <button type="reset" class="btn btn-danger float-right mr-2">Reset</button>
                                </a>
                                <button type="submit" class=" add_user btn btn-primary float-right mr-2" id="submit">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <div class="col-md-8">
                    <div class="card mb-25">
                        <div class="card-header">
                            <h6>User Table</h6>
                        </div>

                        <div id="success_message"></div>

                        <ul id="saveform_errList"></ul>

                        <div class="card-body pt-0 pb-0">
                            <div class="drag-drop-wrap">
                                <div class="table-responsive table-revenue w-100 mb-30">
                                    <table class="table mb-0 table-basic" id="project_datatable" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>DOB</th>
                                                <th>Image</th>
                                                <th>Created at</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>

@yield('contactus')


@endsection


@section('js-script')
<script>
    function previewFile(event) {
        // console.log(input.id);
        var output = document.getElementById('previewImg');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    }
    $(document).ready(function() {

        //feting the data from database
        //fetchuser();

        $("#projectform").on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "users",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                success: function(res) {

                    if (res.status_code == 200) {
                        toastr.success(res.message);
                        $('#project_datatable').DataTable().reload();
                        //show_project();
                        $("#projectform").trigger("reset");
                        $("#submit").text("Save");
                    } else if (res.status_code == 301) {
                        $.each(res.message, function(key, value) {
                            toastr.error(value);
                        });
                    } else if (res.status_code == 201) {
                        toastr.error(res.message);
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });

        $(document).on('click', '.edit_user', function(e) {
            e.preventDefault();
            var user_id = $(this).val();
            console.log(user_id);
            $('#EditUserModel').modal('show');
            $.ajax({
                type: "GET",
                url: "edit-user/" + user_id,
                success: function(response) {
                    console.log(response);
                    if (response.status == 404) {
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                    } else {

                        $('#edit_user_id').val(response.user.id);
                        $('#edit_name').val(response.user.name);
                        $('#edit_email').val(response.user.email);
                        $('#edit_address').val(response.user.address);
                        $('#edit_date').val(response.user.date_of_birth);
                        $('#edit_profile').attr('src', response.user.profile_image);

                    }

                }
            });
        });


        $('#project_datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, "desc"]
            ],
            ajax: "{{ url('getData') }}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'address'
                },
                {
                    data: 'date_of_birth'
                },
                {
                    data: 'profile_image',
                    render: function(data, type, full, meta) {
                        return '<img src= "{{asset("imgs")}}/' + data + '" style= "max-width:60px;"/>';

                    }
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        var btn = ''
                        if (data == "active") {
                            btn += '<button class = " status_id btn btn-success" data-value="inactive" data-id="' + row.id + '">' + data + '</button>';
                        } else {
                            btn += '<button class = "status_id btn btn-danger" data-value="active" data-id="' + row.id + '" >' + data + '</button>';
                        }
                        return btn;


                    }
                },
                {
                    data: 'edit',
                    render: function(data, type, row) {
                        return '<button type="button"value="' + row.id + '" class="edit_user btn btn-primary btn-sm"><i class="fa fa-edit">EDIT</button></td>'

                    }
                },
                {
                    data: 'delete',
                    render: function(data, type, row) {
                        return '<button type="button"value="' + row.id + '" class="delete_user btn btn-danger btn-sm"><i class="fa fa-trash">DELETE</button></td>'
                        
                    }
                }
            ]
        });

        //$(document).on('click', '.update_user', function(e) {
        $("#dataUpdate").submit(function(e) {
            e.preventDefault();
            var user_id = $('#edit_user_id').val();
            var formData = new FormData(this);
            // var data = {
            //     'name': $('#edit_name').val(),
            //     'email': $('#edit_email').val(),
            //     'address': $('#edit_address').val(),
            //     'date': $('#edit_date').val(),
            //     'profile_image': $('#edit_profile').val(),
            //     'status': $('#edit_status').val()
            // }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "update-user/" + user_id,
                data: formData,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    //console.log(response);
                    if (response.status == 400) {
                        //error
                        $('#updateform_errList').html("");
                        $('#updateform_errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#updateform_errList').append('<li>' + err_values + '</li>');
                        });
                    } else if (response.status == 200) {
                        $('#updateform_errList').html("");
                        $('#success_message').addClass('alert alert-success')
                        $('#success_message').text(response.message)

                    } else {
                        $('#updateform_errList').html("");
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success')
                        $('#success_message').text(response.message)

                        $('#EditUserModel').model('hide');
                        //fetchuser();

                    }

                }
            });
        });


        //     $(document).on('click', '.add_user', function(e) {
        //         e.preventDefault();
        //         // console.log("hello");

        //         var data = {
        //             'name': $('.name').val(),
        //             'email': $('.email').val(),
        //             'address': $('.address').val(),
        //             'date_of_birth': $('.date').val(),
        //             'profile_image': $('.file').val()

        //         }
        //         //console.log(data);

        //         $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });

        //         $.ajax({
        //             type: "POST",
        //             url: "users/",
        //             data: data,
        //             dataType: "json",
        //             success: function(response) {
        //                 // console.log(response)
        //                 if (response.status == 400) {
        //                     // show_validation_error(response.errors);
        //                     // $.each($data, function(index, value) {
        //                     // $('form [name="' +  + '"]').parent().after('<span class="help-block text-danger">' + value + '</span>');
        //                     // });
        //                     $('#saveform_errList').html("");
        //                     $('#saveform_errList').addClass('alert alert-danger');
        //                     $.each(response.errors, function(key, err_values) {
        //                         $('#saveform_errList').append('<li>' + err_values + '</li>');
        //                     });

        //                 } else {
        //                     $('#saveform_errList').html("");
        //                     $('#success_message').addClass('alert alert-success')
        //                     $('#success_message').text(response.message)
        //                     $('#AddUserModel').model('hide');
        //                     $('#AddUserModel').find('input').val("");
        //                     //fetchuser();
        //                 }
        //             }

        //         });

        //     });
        // });

        //search button
        $(document).on('click', '.search_button', function(e) {
            e.preventDefault();
            var search_id = $('#search_test').val();
            if (search_id != '') {
                $.ajax({
                    url: "fetch_users",
                    method: 'post',
                    data: {
                        search: search_id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function(response) {
                        // $('#search_test').val(search_id);
                        $('tbody').html("");
                        // console.log(response);
                        $.each(response.users, function(key, item) {
                            // console.log(item);
                            $('tbody').append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.name + '</td>\
                        <td>' + item.email + '</td>\
                        <td>' + item.address + '</td>\
                        <td>' + item.date_of_birth + '</td>\
                        <td>' + item.profile_image + '</td>\
                        <td><button type="button"value="' + item.id + '" class="edit_user btn btn-primary btn-sm"><i class="fa fa-edit">EDIT</button></td>\
                        <td><button type="button"value="' + item.id + '" class="delete_user btn btn-danger btn-sm"><i class="fa fa-trash">DELETE</button></td>\
                    </tr>');
                        });
                    }
                });

            } else {
                return 'Data not found';

            }

        });

        //  delete button 
        $(document).on('click', '.delete_user', function(e) {
            e.preventDefault();
            var user_id = $(this).val();
            //console.log(user_id);
            $('#delete_user_id').val(user_id);
            $('#DeleteUserModel').modal('show');
        });

        $(document).on('click', '.delete_user_btn', function(e) {
            e.preventDefault();

            var user_id = $('#delete_user_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "delete-user/",
                data: {
                    id: user_id,
                    status: 'delete'
                },
                success: function(response) {
                    //console.log(response);
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#DeleteUserModel').model('hide');
                    $('#project_datatable').DataTable().ajax.reload();

                    //fetchuser();
                }
            })
        });

        $(document).on('click', '.status_id', function(e) {
            e.preventDefault();
            if (confirm('To confirm  click OK ')) {
                var id = $(this).data('id');
                var status = $(this).data('value');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'changeStatus',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(data) {
                        if (data['status'] == "success") {
                            $('button[data-id]').removeClass('active').addClass('inactive');
                        }
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(data.success);
                        $('#project_datatable').DataTable().ajax.reload();
                    }

                });
            }
        });
    });
</script>
@endsection