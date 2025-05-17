$(document).ready(function() {

    $(document).on('input', '.password-field', function() {
        var $old_password = $('#old-password').val().trim(), 
            $new_password = $('#new-password').val().trim(), 
            $repeat_password = $('#repeat-password').val().trim();
        
        if( $old_password && $new_password && $repeat_password ) {
            $('.btn-submit').prop('disabled', false);
        }
        else {
            $('.btn-submit').prop('disabled', true);
        }
    });
    $(document).on('click', '#btn-submit', function(e) {
        e.preventDefault();
        $('#update-password').submit();
    });
    $(document).on('submit', '#update-password', function(e) {
        e.preventDefault();
        var $this = $(this),
            $loading = $this.find('.loading'),
            $error = $this.find('.error'),
            $serialize = $this.serialize(),
            $formData = $serialize+'&action=sg_ancestry_site_admin_update_password&nonce='+admin_settings.nonce;
        $.ajax({
            type: 'POST',
            url: admin_settings.ajax_url,
            data: $formData,
            beforeSend: function() {
                $loading.fadeIn();
                $error.fadeOut().removeClass("success failed").html("");
                $('button#btn-submit').prop('disabled', true);
                $this.find('input').removeClass('alert');
            },
            success: function(data) {
                $loading.fadeOut();
                var $response = JSON.parse(data);
                if( $response.status == 1000 || $response.status == 2000 ) {
                    if( $response.status == 1000 ) {
                        $error.addClass('success');
                        $('#update-password')[0].reset();
                    }
                    else if( $response.status == 2000 ) {
                        $error.addClass('failed');
                        if( $response.hasOwnProperty('error') ) {
                            if( $response.error.hasOwnProperty('current') ) {
                                $this.find('#old-password').addClass('alert');
                            }
                            if( $response.error.hasOwnProperty('new') ) {
                                $this.find('#new-password').addClass('alert');
                            }
                            if( $response.error.hasOwnProperty('repeat') ) {
                                $this.find('#repeat-password').addClass('alert');
                            }
                        }
                    }
                    $error.html($response.message).fadeIn();
                    setTimeout(function() {
                        $('button#btn-submit').prop('disabled', false);
                    }, 250);
                }
                else {
                    $loading.fadeOut();
                    $error.addClass('failed').html("Something went wrong!").fadeIn();
                }
            },
            error: function(xhr) {
                console.warn(xhr);
                $('button#btn-submit').prop('disabled', false);
                $error.addClass('failed').html("Something went wrong!").fadeIn();
            }
        });
    });
});