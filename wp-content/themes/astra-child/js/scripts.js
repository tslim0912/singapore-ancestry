$(document).ready(function(){
    $('a.fancybox').fancybox({
        protect: true
    });
    
    var $obituary_slider, $user_review_slider;
    if( $('.obituary-slider')[0] ) {
        $obituary_slider = new Swiper('#obituary-slider', {
            slidesPerView: "auto",
            spaceBetween: 30,
			slidesOffsetAfter: 25,
			breakpoints: {
				0: {
					slidesOffsetBefore: 25,
					slidesOffsetAfter: 25,
				},
				1025: {
					slidesOffsetBefore: 0,
					slidesOffsetAfter: 25,
				}
			}
        });
    }
	
	if( $('#user-review-slider')[0] ) {
		$user_review_slider = new Swiper('.user-review-slider', {
			slidesPerView: 3,
            spaceBetween: 30,
			navigation: {
				nextEl: '.user-review-nav.nav-next',
				prevEl: '.user-review-nav.nav-prev',
			},
			breakpoints: {
				0: {
					slidesOffsetBefore: 25,
					slidesOffsetAfter: 25,
					slidesPerView: "auto",
				},
				768: {
					slidesOffsetBefore: 0,
					slidesOffsetAfter: 0,
				}
			}
		});
	}
	
	if( $('.grid-gallery')[0] ) {
	    
        var $grid = $('.grid-gallery').imagesLoaded(function(){
            $grid.isotope({
                itemSelector: '.grid-item',
                layoutMode: 'masonry',
                masonry: {
                    gutter: 20
                }
            });
        });
	}

    $(document).on('click', '.btn-share', function(e) {
        e.preventDefault();
        var $this = $(this),
            $link = $this.attr('data-value');
        
        $('.share-popup').remove();

        var popupHtml = `
        <div class="share-popup">
            <button type="button" class="share-close"><span class="d-none">Close</span><i class="fa fa-times" aria-hidden="true"></i></button>
            <input type="text" class="share-input" value="${$link}" readonly />
            <button class="btn-copy">Copy</button>
        </div>
        `;

        // Append after the clicked button
        $this.after(popupHtml);
    });

    $(document).on('click', '.share-close', function (e) {
        e.preventDefault();
        var $this = $(this),
            $parent = $this.parents('.share-popup');
        $parent.fadeOut();
        setTimeout(function() {
            $parent.remove();
        }, 350);
    });
    $(document).on('click', '.btn-copy', function () {
        var $input = $(this).siblings('.share-input');
        $input[0].select();
        document.execCommand('copy');
        $(this).after('<p class="note" style="margin-top:5px;font-size:14px;line-height:1;color:#005d00;">Copied to Clipboard!</p>');
        setTimeout(function(){
            $('.share-popup p.note').remove();
        }, 5000);
        // var value = $(this).siblings('.share-input').val();
        // navigator.clipboard.writeText(value)
        // .then(() => {
        //     alert('Copied to clipboard!');
        // })
        // .catch(err => {
        //     console.error('Failed to copy:', err);
        //     alert('Failed to copy to clipboard.');
        // });
    });

});