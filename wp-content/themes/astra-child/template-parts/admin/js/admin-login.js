$(document).ready(function() {
  	let formSubmitted = false;
    var $loading = $('.app-card .loading'),
        $error = $('.error');
    $(document).on('click', '.btn.btn-template', function(e) {
        e.preventDefault();
        var $this = $(this),
            $target = $this.attr('data-method');
        sg_ancestry_signin_option($target);
    });

    function sg_ancestry_signin_option($method){
        $.ajax({
            type: 'POST',
            url: admin_login.ajax_url,
            data: {
                action: 'calling_template_login_redirection',
                nonce: admin_login.nonce,
                method: $method,
            },
            beforeSend: function() {
                $loading.fadeIn();
                $error.removeClass('success failed').html("").fadeOut();
            },
            success: function(data) {
                $loading.fadeOut();
                var $response = JSON.parse(data);
                if($response.status == 1000 || $response.status == 2000 ) {
                    if($response.status == 1000 ) {
                        $('.app-card .app-body').html($response.data.html);
                    }
                    if($response.status == 2000 ) {
                        $error.html($response.message).addClass('failed').fadeIn();
                    }
                }
                else {
                    $loading.fadeOut();
                    $error.addClass('failed').html('Something went wrong unexpectedly!').fadeIn();
                }
            },
            error: function(xhr) {
                $loading.fadeOut();
                $error.addClass('failed').html('Something went wrong!').fadeIn();
            }
        });
    }

    $(document).on('submit', '#login-form', function(e) {
        e.preventDefault();
        var $this = $(this),
            $error = $this.find('.error'),
            $data = $this.serialize(),
            $formData = $data+'&action=sg_ancestry_admin_login&nonce='+admin_login.nonce;
    	if (formSubmitted) return;
        $.ajax({
            type: 'POST',
            url: admin_login.ajax_url,
            data: $formData,
            beforeSend: function() {
                $this.addClass('disabled');
                $loading.fadeIn();
                $error.fadeOut().html("").removeClass('success failed');
            },
            success: function(data) {
                $loading.fadeOut();
                var $response = JSON.parse(data);
                if( $response.status == 1000 || $response.status == 2000  ) {
                    if( $response.status == 1000 ) {
						$this.find('input, button, textarea, select').prop('disabled', true);
                        $error.addClass('success').html($response.message).fadeIn();
                        setTimeout(function() {
                            window.location.href = $response.data.redirect;
                        }, 250);
                    }
                    if( $response.status == 2000 ) {
                        $this.removeClass('disabled');
                        $error.addClass('failed').html($response.message).fadeIn();
                    }
                }
                else {
                    $this.removeClass('disabled');
                    $error.addClass('failed').html("Something went wrong unexpectedly!").fadeIn();
                }
            },
            error: function(xhr) {
                $this.removeClass('disabled');
                $loading.fadeOut();
                $error.addClass('failed').html("Something went wrong!").fadeIn();
            }
        });
    });
	
	$(document).on('click', '#registration-form #btn-next-step', function(e) {
		e.preventDefault();
		var $this = $(this),
			$parents = $this.parents('.app-card'),
			$error = $this.siblings('.error'),
			$form = $this.parents('#registration-form'),
			$fullname = $form.find('#reg-fullname').val(),
			$step_1 = $form.find('#step-1'),
			$step_2 = $form.find('#step-2');
		if( $fullname.trim() === '') {
			$error.addClass('failed').html('Full name is mandatory!').fadeIn();
			console.log('Block');
		}
		else {
			$form.find('#display-reg-fullname').html($fullname);
			$error.fadeOut().removeClass('failed').html('');
			$step_1.removeClass('show');
			$step_2.addClass('active');
			setTimeout(function() {
				$step_1.removeClass('active');
				$step_2.addClass('show');
			}, 250);
			$parents.addClass('registration-step-2');
		}
	});
	
	$(document).on('click', '#registration-form #step-2 .btn-return', function(e) {
		e.preventDefault();
		var $this = $(this),
			$parents = $this.parents('.app-card'),
			$error = $this.siblings('.error'),
			$form = $this.parents('#registration-form'),
			$step_1 = $form.find('#step-1'),
			$step_2 = $form.find('#step-2');
		
			$step_2.removeClass('show');
			$step_1.addClass('active');
			setTimeout(function() {
				$step_2.removeClass('active');
			}, 250);
			setTimeout(function() {
				$step_1.addClass('show');
			}, 275);
			console.log('Pass');
			$parents.removeClass('registration-step-2');
	});
	
	$(document).on('submit', '#registration-form', function(e){
		e.preventDefault();
		var $this = $(this),
			$loading = $this.parents('.app-card').find('.loading'),
			$error = $this.find('.error'),
			$fullname = $this.find('#reg-fullname').val(),
			$step_1 = $this.find('#step-1'),
			$step_2 = $this.find('#step-2');
		if( $fullname.trim() !== '' && $step_1.hasClass('active') ) {
			$('#registration-form #btn-next-step').click();
		}
		else {
			var $formData = $this.serialize()+'&action=sg_ancestry_membership_registration&nonce='+admin_login.nonce;
			$.ajax({
				type: 'post',
				url: admin_login.ajax_url,
				data: $formData,
				beforeSend: function() {
					$loading.fadeIn();
					$error.fadeOut().removeClass('success failed').html('');
				},
				success: function(data) {
					$loading.fadeOut();
					var $response = JSON.parse(data);
					if( $response.status == 1000 || $response.status == 2000 ) {
						if( $response.status == 1000 ) {
							$error.addClass('success').html($response.message).fadeIn();
							$this.addClass('disabled').prop('disabled', true);
							window.location.href = $response.redirect;
						}
						if( $response.status == 2000 ) {
							$error.addClass('failed').html($response.message).fadeIn();
						}
					}
					else {
						$error.addClass('failed').html('Something went wrong unexpectedly!').fadeIn();
					}
				},
				error: function(xhr) {
					$loading.fadeOut();
					$error.addClass('failed').html('Something went wrong!').fadeIn();
				}
			});
		}
	});
});