$(document).ready(function() {
    $('a.fancybox').fancybox({
        protect: true
    });
    const urlParams = new URLSearchParams(window.location.search);
    const peopleParam = urlParams.get('people');
  
    if (peopleParam && peopleParam.trim() !== '') {
        setTimeout(function() {
            $('#obituary-listing-slider .swiper-slide[data-value="'+peopleParam+'"]').trigger('click');
        }, 500);
    }
    
    function initiate_obituary_slider() {
        $ob_slider = new Swiper('#obituary-listing-slider', {
            slidesPerView: 4,
            grid: {
                rows: 2,
                fill: 'row',
            },
            spaceBetween: 10,
            pagination: {
                el: '.ob-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.ob-nav-next',
                prevEl: '.ob-nav-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: "auto",
                    grid: {
                        rows: 2,
                        fill: 'row',
                    },
                    spaceBetween: 25,
                    slidesOffsetBefore: 25,
                    slidesOffsetAfter: 25,
                },
                768: {
                    slidesPerView: 4,
                    grid: {
                        rows: 2,
                        fill: 'row',
                    },
                    spaceBetween: 10,
                    slidesOffsetBefore: 0,
                    slidesOffsetAfter: 0,
                }
            }
        });
    }
    
    var $ob_slider;
    if( $('.listing-obituary .obituary-listing-slider')[0] ) {
        initiate_obituary_slider();
    }
    
    $(document).on('submit', '#obituary-search-form', function(e) {
        e.preventDefault();
        var $this = $(this),
            $loading = $this.find('.loading'),
            $error = $this.find('.error'),
            $keyword = $this.find('#obituary_keyword').val();
        $.ajax({
            type: 'POST',
            url: obituary_related.ajax_url,
            data: {
                action: 'global_obituary_slider_search',
                nonce: obituary_related.nonce,
                keyword: $keyword
            },
            beforeSend: function() {
                $loading.fadeIn();
                $error.hide().removeClass('success failed').html('');
            },
            success: function(data) {
                $loading.fadeOut();
                var $response = JSON.parse(data);
                if( $response.status == 1000 ||  $response.status == 2000  ) {
                    if( $response.status == 1000 ) {
                        
                        if( $ob_slider ) {
                            $ob_slider.destroy(true, true);
                        }
                        $('#obituary-listing-slider .swiper-wrapper').html($response.data.slider);
                        setTimeout(function() {
                            initiate_obituary_slider();
                        }, 250);
                        
                    }
                    if( $response.status == 2000 ) {
                        $error.addClass('failed').html($response.message);
                        setTimeout(function() {
                            $error.fadeIn();
                        }, 250);
                    }
                }
                else {
                    $error.addClass('failed').html('Something went wrong unexpectedly!');
                    $error.fadeIn();
                }

            },
            error: function(xhr) {
                $loading.fadeOut();
                $error.addClass('failed').html('Something went wrong while verifying the passcode!');
                $error.fadeIn();
            }
        });
    });
});