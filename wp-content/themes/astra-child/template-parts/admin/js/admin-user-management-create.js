$(document).ready(function() {
    const input = document.querySelector(".input-control.intl-phone");
    const iti = window.intlTelInput(input, {
        initialCountry: "sg",
        loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
    });

    $(document).on('click', '#btn-submit', function(e) {
        e.preventDefault();
        $('#create-new-user').submit();
    });

    $(document).on('submit', '#create-new-user', function(e) {
        e.preventDefault();
        var $this = $(this),
            $error = $this.siblings('.error'),
            $loading = $this.find('.loading'),
            $serialize = $this.serialize(),
            $formData = $serialize+'&action=sg_ancestry_create_new_user&nonce='+admin_user_management_create.nonce;
        if (iti.isValidNumber()) {
            const fullNumber = iti.getNumber();
            $formData += '&user_mobile='+fullNumber;
        }
        else {
            $error.addClass('failed').html("The contact number is mandatory!");
            $error.fadeIn();
        }
        $.ajax({
            type: 'POST',
            url: admin_user_management_create.ajax_url,
            data: $formData,
            beforeSend: function() {
                $loading.fadeIn();
                $error.removeClass('success failed').html("");
                $error.fadeOut();
            },
            success: function(data) {
                $loading.fadeOut();
                var $response = JSON.parse(data);
                if( $response.status == 1000 ||  $response.status == 2000 ) {
                    if( $response.status == 1000 ) {
                        $error.addClass('success').html($response.message);
                        $('#create-new-user')[0].reset();
                    }
                    if( $response.status == 2000 ) {
                        $error.addClass('failed');
                        if( $response.error.hasOwnProperty("name") ) {
                            $error.html($response.error.name);
                        }
                        if( $response.error.hasOwnProperty("id") ) {
                            $error.html($response.error.id);
                        }
                        if( $response.error.hasOwnProperty("email") ) {
                            $error.html($response.error.email);
                        }
                        if( $response.error.hasOwnProperty("phone") ) {
                            $error.html($response.error.phone);
                        }
                        if( $response.error.hasOwnProperty("password") ) {
                            $error.html($response.error.password);
                        }
                        if( $response.error.hasOwnProperty("password_confirm") ) {
                            $error.html($response.error.password_confirm);
                        }
                        if( $response.error.hasOwnProperty("status") ) {
                            $error.html($response.error.status);
                        }
                        if( $response.error.hasOwnProperty("user") ) {
                            $error.html($response.error.user);
                        }
                        $('html, body').animate({ scrollTop: 0 }, 500);
                    }
                    $error.fadeIn();
                }
                else {
                    $loading.fadeOut();
                    $error.addClass('failed').html("Something went wrong! Please try again later.");
                    $error.fadeIn();
                }
            },
            error: function(xhr) {
                $loading.fadeOut();
                $error.addClass('failed').html("Something went wrong unexpectedly! Please try again later.");
                $error.fadeIn();
            },
        });
    });
});