$(document).ready(function() {
    
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
        
        $.ajax({
            type: 'POST',
            url: gallery.ajax_url,
            data: {
                action: 'get_obiutary_gallery_box',
                nonce: gallery.nonce,
                name: $target,
                id: $id,
                share: window.location.href
            },
            beforeSend: function() {
                $loading.fadeIn();
                $('.obituary-gallery-box').fadeOut();
                $('.obituary-gallery-box').html('');
                if( $('.gallery-lightbox')[0] ) {
                    $('.gallery-lightbox a').remove();
                }
            },
            success: function(data) {
                $loading.fadeOut();
                var $response = JSON.parse(data);
                if( $response.status == 1000 ||  $response.status == 2000  ) {
                    if( $response.status == 1000 ) {
                        if ($response.data && $response.data.hasOwnProperty('gallery')) {
                            $('.obituary-gallery-box').html($response.data.gallery);
                            $('.obituary-gallery-box').fadeIn();
                            setTimeout(function(){
                                var $grid = $('.grid-gallery').isotope({
                                    itemSelector: '.grid-item',
                                    layoutMode: 'masonry',
                                    masonry: {
                                        gutter: 20
                                    }
                                });

                                $grid.isotope('reloadItems').isotope();

                                $grid.imagesLoaded(function() {
                                    $grid.isotope('layout');
                                });
                            }, 300);
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

    $(document).on('click', '#btn-preview', function(e) {
        e.preventDefault();
        var $this = $(this),
            $id = $this.attr('data-id');
        if( $this.hasClass('btn-fancybox') ) {
            $('.gallery-lightbox a').first().click();
        }
        else {
            var $html = `
                <div class="verification-popup">
                    <div class="vp-overlay"></div>
                    <div class="wp-form-wrapper">
                        <button type="button" class="btn-close vp-close" id="vp-close"><span class="d-none">Close</span></button>
                        <form class="wp-form verify-obituary-gallery" id="verify-obituary-gallery" method="post" action="">
                            <div class="loading"><span class="loader"></span></div>
                            <div class="wp-row wp-row-header text-center">
                                <h4>Private Gallery</h4>
                                <p>This is a private gallery, please enter the passcode to </p>
                            </div>
                            <div class="wp-row wp-row-body">
                                <div class="wp-form-group">
                                    <label for="obituary-password">Gallery Passcode</label>
                                    <input type="text" class="input-control obituary-password" name="obituary_password" id="obituary_password"/>
                                </div>
                            </div>
                            <div class="wp-row wp-row-footer">
                                <input type="hidden" id="obituary_id" name="obituary_id" value="${$id}" />
                                <button type="submit" class="btn btn-submit"><span>Submit</span></button>
                                <div class="error"></div>
                            </div>
                        </form>
                    </div>
                </div>`;
            $('body').addClass('vp-popup-opened').append($html);
            setTimeout(function() {
                $('.verification-popup').fadeIn();
            }, 150);
            setTimeout(function() {
                $('.verification-popup .wp-form-wrapper').fadeIn();
                $this.addClass('btn-fancybox');
            }, 250);
        }
    });

    function close_gallery_verification_popup() {
        $('.verification-popup .wp-form-wrapper').fadeOut();
        setTimeout(function() {
            $('.verification-popup').fadeOut();
            $('body').removeClass('vp-popup-opened');
        }, 150);
        setTimeout(function() {
            $('.verification-popup').remove();
        }, 250);
    }

    $(document).on('click', '.verification-popup .btn-close', function(e) {
        e.preventDefault();
        close_gallery_verification_popup();
    });
    
    $(document).on('submit', '#verify-obituary-gallery', function(e) {
        e.preventDefault();
        var $this = $(this),
            $loading = $this.find('.loading'),
            $error = $this.find('.error'),
            $obituary_id = $this.find('#obituary_id').val(),
            $obituary_password = $this.find('#obituary_password').val();
        $.ajax({
            type: 'POST',
            url: gallery.ajax_url,
            data: {
                action: 'obituary_retrieving_lightbox_list',
                nonce: gallery.nonce,
                obituary_id: $obituary_id,
                obituary_password: $obituary_password
            },
            beforeSend: function() {
                $loading.fadeIn();
                $error.hide().removeClass('success failed');
            },
            success: function(data) {
                $loading.fadeOut();
                var $response = JSON.parse(data);
                if( $response.status == 1000 ||  $response.status == 2000  ) {
                    if( $response.status == 1000 ) {
                        var $public = $response.data.public;
                        if( $public ) {
                            $('body').append($response.data.lightbox);
                            $('#btn-preview').addClass('btn-gallery');
                            setTimeout(function() {
                                $('.gallery-lightbox a').first().click();
                                close_gallery_verification_popup();
                            }, 500);
                            $error.addClass('success').html($response.message);
                        }
                    }
                    if( $response.status == 2000 ) {
                        $error.addClass('failed').html($response.message);
                    }
                    $error.fadeIn();
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