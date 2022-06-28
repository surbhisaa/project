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
            })
            
            });
    </script>