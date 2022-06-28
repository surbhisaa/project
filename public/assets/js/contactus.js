<script>
        $(document).ready(function() {

            $('#contact_us').DataTable({
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
                    data: 'message'
                },
                {
                    data: 'reply'
                }    
            ]

        });
    });
    </script>