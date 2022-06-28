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