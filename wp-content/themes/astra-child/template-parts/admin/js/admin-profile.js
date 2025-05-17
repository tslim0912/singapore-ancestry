$(document).ready(function() {
    if( $('body').hasClass('login-as-subscriber') ) {
        var input = document.querySelector(".input-control.intl-phone.user-mobile");
        var iti = window.intlTelInput(input, {
            initialCountry: "sg",
            loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
        });
    }
    else if( $('body').hasClass('loagin-as-contributor') ) {
        
    }
    else if( $('body').hasClass('loagin-as-site-admin') || $('body').hasClass('loagin-as-administrator') ) {
        
    }
    
    $(document).on('click', '#btn-submit', function(e) {
        e.preventDefault();
        $('.edit-account-profile').submit();
    });
    $(document).on('submit', '.edit-account-profile', function(e) {
        e.preventDefault();
        var $this = $(this),
            $error = $this.siblings('.error'),
            $loading = $this.find('.loading'),
            $user_role = $this.find('#user-role').val(),
            $serialize = $this.serialize(),
            $data = $serialize+'&action=sg_ancestry_update_user_details&nonce='+admin_profile.nonce;
            
        if( $user_role == 'subscriber' ) {
            if (iti.isValidNumber()) {
                var fullNumber = iti.getNumber();
                $data += '&user_mobile='+fullNumber;
                console.log(fullNumber);
            }
            
        }   
        else if( $user_role == 'contributor' ) {
            
        }   
        else {
            
        }
        
        
        $.ajax({
            type: 'POST',
            url: admin_profile.ajax_url,
            data: $data,
            beforeSend: function() {
                $loading.fadeIn();
                $error.fadeOut().removeClass('success failed warning').html("");
            },
            success: function(data) {
                $loading.fadeOut();
                var $response = JSON.parse(data);
                if( $response.status == 1000 || $response.status == 2000 || $response.status == 3000 ) {
                    if( $response.status == 1000 ) {
                        $error.addClass('success').html($response.message).fadeIn();
                    }
                    if( $response.status == 2000 ) {
                        for ( let $field in $response.error ) {
                            if( $response.error.hasOwnProperty($field) ) {
                                let $messages = $response.error[$field];
            
                                // Ensure it's always an array
                                if (!Array.isArray($messages)) {
                                    $messages = [$messages];
                                }
            
                                $messages.forEach(function(msg) {
                                    $error.append(msg);
                                });
                            }
                        }
                    }
                    if( $response.status == 3000 ) {
                        $error.addClass('warning').html($response.message).fadeIn();
                    }
                }
                else {
                    $error.addClass('failed').html("Something went wrong! Please try again later.").fadeIn();
                }
            },
            error: function(xhr) {
                $loading.fadeOut();
                $error.addClass('failed').html("Something went wrong! Please try again later.").fadeIn();
            }
        });
    });
});