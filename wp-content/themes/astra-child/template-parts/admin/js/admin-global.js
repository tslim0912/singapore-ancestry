$(document).ready(function() {
    $(document).on('click', '#adminhead .mobile-toggler', function(e) {
        e.preventDefault();
        if( window.matchMedia('(max-width: 1199px)').matches ) {
            var $this = $(this),
                $parent = $this.parents('#adminhead');
            $this.prop('disabled', true);
            if( $parent.hasClass('adminhead-opened') ) {
                $parent.removeClass('adminhead-opened');
            }
            else {
                $parent.addClass('adminhead-opened');
            }
            setTimeout(function() {
                $this.prop('disabled', false);
            }, 250);
        }
    });
    $(document).on('click', '.show-password', function(e) {
        e.preventDefault();
        var $this = $(this),
            $input = $this.siblings('input'),
            $icon = $this.find('i');
        if( $input.attr('type') == 'password' ) {
            $input.attr('type', 'text');
            $icon.toggleClass('fa-eye fa-eye-slash');
        }
        else if( $input.attr('type') == 'text' ) {
            $input.attr('type', 'password');
            $icon.toggleClass('fa-eye-slash fa-eye');
        }
    });
	
	$(document).on('click', '#admin-signout', function(e) {
        e.preventDefault();
        var $this = $(this);
		if( $('.sa-popup-container')[0] ) {
			$('.sa-popup-container').fadeIn();
			setTimeout(function() {
				$('.sa-popup-container .sa-popup-inner').fadeIn().addClass('show');
			}, 250);
		}
		else {
			console.warn('SA popup is missing!');
		}
	});
	
	$(document).on('click', '#dismiss-logout-popup', function(e) {
        e.preventDefault();
        var $this = $(this);
		if( $('.sa-popup-container').is(':visible') ) {
			$('.sa-popup-container .sa-popup-inner').removeClass('show').fadeOut();
			setTimeout(function() {
				$('.sa-popup-container').fadeOut();
			});
		}
		else {
			console.warn('SA popup is not opened!');
		}
	});
	$(document).on('click', '#proceed-logout', function(e) {
        e.preventDefault();
        var $this = $(this),
			$loading = $this.parents('.sa-popup-inner').find('.loading'),
			$error = $this.parents('.sa-popup-inner').find('.error');
		$.ajax({
			type: 'post',
			url: admin_global.ajax_url,
			data: {
				action: 'sg_ancestry_attempting_to_signout',
				nonce: admin_global.nonce,
			},
			beforeSend: function() {
				$loading.fadeIn();
				$error.removeClass('success failed').html('').fadeIn();
			},
			success: function(data) {
				var $response = JSON.parse(data);
				if( $response.status == 1000 || $response.status == 2000 ) {
					if( $response.status == 1000 ) {
						$error.addClass('success');
						var $buttons = $this.parents('.btn-wrapper').find('button');
						$buttons.prop('disabled', true);
						var $redirect = $response['redirect'];
						window.location.href = $redirect;
					}
					if( $response.status == 2000 ) {
						$loading.fadeOut();
						$error.addClass('failed');
					}
					$error.html($response.message).fadeIn();
				}
				else {
					$error.addClass('success failed').html('Something went wrong unexpectedly!').fadeIn();
				}
			},
			error: function(xhr) {
				$loading.fadeOut();
				$error.addClass('success failed').html('Something went wrong!').fadeIn();
			}
		});
	});
});