<script>
    $(document).ready(function() {

loadCart();
loadWish();
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
            })
        }
    });
        
</script>