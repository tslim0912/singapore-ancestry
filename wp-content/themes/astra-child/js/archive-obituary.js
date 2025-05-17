$(document).ready(function(){

    $(document).on('click', '.obituary-listing-slider .swiper-slide', function(e) {
        e.preventDefault();
        var $this = $(this),
            $target = $this.attr('data-value'),
            $id = $this.attr('data-id'),
            $loading = $('.listing-obituary .obituary-card .loading');
        $('.obituary-listing-slider .swiper-slide').removeClass('selected');
        $this.addClass('selected');
        
        const newUrl = new URL(window.location.href);
        newUrl.searchParams.set('people', $target);
        window.history.pushState({}, '', newUrl);
        console.log('clicked', $target);
        
        $.ajax({
            type: 'POST',
            url: obituary.ajax_url,
            data: {
                action: 'get_obiutary_full_information',
                nonce: obituary.nonce,
                name: $target,
                id: $id,
                share: window.location.href
            },
            beforeSend: function() {
                $loading.fadeIn();
            },
            success: function(data) {
                $loading.fadeOut();
                var $response = JSON.parse(data);
                if( $response.status == 1000 ||  $response.status == 2000  ) {
                    if( $response.status == 1000 ) {
                        if ($response.data && $response.data.hasOwnProperty('details')) {
                            $('.obituary-card .obituary-details').html($response.data.details);
                            setTimeout(function() {
                                var $obituary_details;
                                if( $('#obituary-details-slider')[0] ){
                                    $obituary_details = new Swiper('#obituary-details-slider', {
                                        slidesPerView: 1,
                                        spaceBetween: 25,
                                        pagination: {
                                            el: '.obituary-details-pagination',
                                            clickable: true,
                                        },
                                    });
                                }
                                else {
                                    console.warn('#obituary-details-slider not found in DOM.');
                                }
                            }, 250);
                        }
                        if ($response.data && $response.data.hasOwnProperty('map')) {
                            $('.obituary-card .obituary-map-navigation').html($response.data.map);
                        }
                        if ($response.data && $response.data.hasOwnProperty('extra')) {
                            $('.obituary-content .obituary-extra').html($response.data.extra);
                        }
                    }
                    if( $response.status == 2000 ) {

                    }
                }
                else {
                    console.log('Something went wrong!');
                    console.log(xhr);
                }
            },
            error: function(xhr) {
                $loading.fadeOut();
                console.log('Error');
                console.log(xhr);
            }
        });
    });

    var $obituary_details;
    if( $('#obituary-details-slider')[0] ){
        $obituary_details = new Swiper('#obituary-details-slider', {
            slidesPerView: 1,
            spaceBetween: 25,
            pagination: {
                el: '.obituary-details-pagination',
                clickable: true,
            },
        });
    }
});