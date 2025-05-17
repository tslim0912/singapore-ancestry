$(document).ready(function() {
    const input = document.querySelector(".input-control.intl-phone.company-mobile");
    const iti = window.intlTelInput(input, {
        initialCountry: "sg",
        loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
    });
    const input2 = document.querySelector(".input-control.intl-phone.pic-mobile");
    const iti2 = window.intlTelInput(input2, {
        initialCountry: "sg",
        loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
    });

    $(document).on('click', '#btn-submit', function(e) {
        e.preventDefault();
        $('#create-new-undertaker').submit();
    });

    $(document).on('submit', '#create-new-undertaker', function(e) {
        e.preventDefault();
        var $this = $(this),
            $error = $this.siblings('.error'),
            $loading = $this.find('.loading'),
            $serialize = $this.serialize(),
            $formData = $serialize+'&action=sg_ancestry_create_new_undertaker&nonce='+admin_undertaker_management_create.nonce;
        if (iti.isValidNumber()) {
            const fullNumber = iti.getNumber();
            $formData += '&undertaker_company_mobile='+fullNumber;
        }
        else {
            $error.addClass('.error').html("The company mobile is invalid!").fadeIn();
        }
        if (iti2.isValidNumber()) {
            const fullNumber2 = iti2.getNumber();
            $formData += '&pic_mobile='+fullNumber2;
        }
        else {
            $error.addClass('.error').html("The PIC mobile is invalid!").fadeIn();
        }
        
        $.ajax({
            type: 'POST',
            url: admin_undertaker_management_create.ajax_url,
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
                        $('#create-new-undertaker')[0].reset();
                    }
                    if( $response.status == 2000 ) {
                        $error.addClass('failed');
                        if( $response.error.hasOwnProperty("company_name") ) {
                            $error.append($response.error.company_name);
                        }
                        if( $response.error.hasOwnProperty("company_id") ) {
                            $error.append($response.error.company_id);
                        }
                        if( $response.error.hasOwnProperty("company_address") ) {
                            $error.append($response.error.company_address);
                        }
                        if( $response.error.hasOwnProperty("company_postcode") ) {
                            $error.append($response.error.company_postcode);
                        }
                        if( $response.error.hasOwnProperty("company_city") ) {
                            $error.append($response.error.company_city);
                        }
                        if( $response.error.hasOwnProperty("company_state") ) {
                            $error.append($response.error.company_state);
                        }
                        if( $response.error.hasOwnProperty("company_country") ) {
                            $error.append($response.error.company_country);
                        }
                        if( $response.error.hasOwnProperty("company_mobile") ) {
                            $error.append($response.error.company_mobile);
                        }
                        if( $response.error.hasOwnProperty("pic_fullname") ) {
                            $error.append($response.error.pic_fullname);
                        }
                        if( $response.error.hasOwnProperty("pic_id") ) {
                            $error.append($response.error.pic_id);
                        }
                        if( $response.error.hasOwnProperty("pic_email") ) {
                            $error.append($response.error.pic_email);
                        }
                        if( $response.error.hasOwnProperty("pic_mobile") ) {
                            $error.append($response.error.pic_mobile);
                        }
                        if( $response.error.hasOwnProperty("pic_password") ) {
                            $error.append($response.error.pic_password);
                        }
                        if( $response.error.hasOwnProperty("user") ) {
                            $error.append($response.error.user);
                        }
                        if( $response.error.hasOwnProperty("post") ) {
                            $error.append($response.error.post);
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