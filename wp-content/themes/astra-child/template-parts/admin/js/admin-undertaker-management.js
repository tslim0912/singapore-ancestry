$(document).ready(function() {
    $(document).on('click', 'table .sorting', function(e) {
        e.preventDefaul();
        var $this = $(this),
            $orderby = $this.attr('data-orderby'),
            $order = $this.attr('data-order'),
            $loading = $('.admin-table-box .loading'),
            $loading = $('.admin-table-box .loading');
        
        if ( $orderby && $order ) {
            console.log('orderby:', $orderby, 'order:', $order);
            $.ajax({
                type: 'POST',
                url: admin_undertaker_management.ajax_url,
                data: {
                    action: 'sg_ancestry_undertaker_sorting',
                    nonce: admin_undertaker_management.nonce,
                    orderby: $orderby,
                    order: $order
                },
                beforeSend: function() {
                    $loading.fadeIn();
                },
                success: function(data) {
                    $loading.fadeOut();
                    var $response = JSON.parse(data);
                    if( $response.status == 1000 || $response.status == 2000 ) {
                        if( $response.status == 1000 ) {}
                        if( $response.status == 2000 ) {}
                    }
                    else {

                    }
                },
                error: function(xhr) {
                    $loading.fadeOut();
                }
            });
        }
    });
});