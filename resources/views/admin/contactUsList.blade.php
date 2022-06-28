@extends('layouts.admin.layout')

@section('body')

<!-- ReplyUserModel -->
<div class="modal fade" id="ReplyUserModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Make Reply To The User</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <ul id="updateform_errList"></ul>

                <input type="hidden" value="" id="edit_stud_id">

                <div class="form-group mb-3">
                    <label for="">Message</label>
                    <textarea name="reply" id="admin_message" cols="30" rows="5" class="reply form-control" placeholder="Your Message"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary send_message">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- end ReplyUserModel -->

<!-- ViewMessModel -->
<div class="modal fade" id="ViewMessModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Message that you send </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <ul id="updateform_errList"></ul>

                <div class="form-group mb-3">
                    <label for="">Message</label>
                    <input type="text" name="view" value="" id="view_message" cols="30" rows="5" class="reply form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end ViewMessModel -->

<section style="padding-top:60px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div id="success_message"></div>

                    <ul id="saveform_errList"></ul>

                    <div class="card-header">
                        Contact Us List
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="card-body pt-0 pb-0">
                                <div class="drag-drop-wrap">
                                    <div class="table-responsive table-revenue w-100 mb-30">
                                        <table class="table mb-0 table-basic" id="table_contact_us" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Message</th>
                                                    <th>Reply</th>
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
</section>
@endsection
@section('js-script')
<script>
    $(document).ready(function() {

        $('#table_contact_us').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, "desc"]
            ],
            ajax: "{{ url('getmessage') }}",
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
                    data: 'message'
                },
                {
                    data: 'reply',
                    render: function(data, type, row) {
                        if (data == null || data == '') {
                            return '<button type="button" value="' + row.id + '" class="reply_message btn btn-primary btn-sm"><i class="fa fa-edit">REPLY</button></td>'
                        }

                        return '<button type="button"value="' + data + '" class="view_message btn btn-warning btn-sm"><i class="fa fa-edit">View</button></td>'

                    }
                }

            ]

        });
    });


    $(document).on('click', '.view_message', function(e) {
        e.preventDefault();
        var stud_id = $(this).val();
        //console.log(stud_id);
        // $('#edit_stud_id').val(stud_id);
        $('#ViewMessModel').modal('show');
        $('#view_message').val(stud_id);

    });


    $(document).on('click', '.reply_message', function(e) {
        e.preventDefault();
        var stud_id = $(this).val();
        //console.log(stud_id);
        $('#edit_stud_id').val(stud_id);
        $('#ReplyUserModel').modal('show');
        // $.ajax({
        //     type: "get",
        //     url: "contactusList/" + stud_id,
        //     success: function(response) {
        //          console.log(response);
        //         if (response.status == 404) {
        //             $('#success_message').html("");
        //             $('#success_message').addClass('alert alert-danger');
        //             $('#success_message').text(response.massage);
        //         } else {
        //             $('#edit_stud_id').val(response.student.id);
        //             $('#admin_message').val(response.student.name);
        //         }
        //     }
        // });
    });


    $(document).on('click', '.send_message', function(e) {
        e.preventDefault();
        // console.log("hello");

        var data = {
            'reply': $('#admin_message').val(),
            'id': $('#edit_stud_id').val()
        }
        //console.log(data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: "adminMess",
            data: data,
            dataType: "json",
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
                    $('#admin_message').val('');

                }
            }

        });

    });
</script>
@endsection
</body>

</html>