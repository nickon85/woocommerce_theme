// https://gist.github.com/artikus11/e8b79287911eb30b3acde3979502f3ae

(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})();

window.addEventListener('scroll', function () {
    document.getElementById('header-nav').classList.toggle('headernav-scroll', window.scrollY > 135);
});

jQuery(document).ready(function ($) {
    const $body = $('body');

    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#top').fadeIn();
        } else {
            $('#top').fadeOut();
        }
    });

    $('#top').click(function () {
        $('html, body').animate({scrollTop: 0}, 500);
        return false;
    });

    $(".owl-carousel-full").owlCarousel({
        margin: 20,
        responsive: {
            0: {
                items: 1
            },
            500: {
                items: 2
            },
            700: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });

    $body.on('adding_to_cart', function (e, btn, data) {
        btn.removeClass('loading');
        btn.closest('.product-card').find('.ajax-loader').fadeIn();
    })

    $body.on('added_to_cart', function (e, response_fragments, response_cart_hash, btn) {
        btn.closest('.product-card').find('.ajax-loader').fadeOut();
        console.log('added_to_cart')
    })

    const $active_content_product_img = $('.product-content-wrapper .carousel-item.active');
    if ($active_content_product_img) {
        const $img_width = $active_content_product_img.width() + 'px';
        $('.product-content-wrapper .carousel-item').each(function (i) {
            this.style.maxHeight = $img_width.toString();
        });
    }

    $('main.main').on('click', '.quantity button', function () {
        let btn = $(this);
        const grouped_product = btn.closest('.woocommerce-grouped-product-list-item__quantity').length;
        let input_qty = btn.parent().find('.qty');
        let prev_val = +(input_qty.val());
        let new_val = grouped_product ? 0 : 1;
        if (btn.hasClass('btn-plus')) {
            new_val = prev_val + 1;
        } else {
            if ((!grouped_product && prev_val > 1)
                || (grouped_product && prev_val > 0)) {
                new_val = prev_val - 1;
            }
        }
        input_qty.val(new_val);
        $('.update-cart').prop('disabled', false);
    })


    //	AJAX Method

    /*$('.wishlist-icon').on('click', function () {
        let $this = $(this);

        if ($this.hasClass('lock')) {
            iziToast.warning({
                message: 'Wait for the operation complete',
                timeout: 2000
            });
            return false;
        }
        $('.wishlist-icon').addClass('lock');

        let productId = $this.data('id');
        let ajaxLoader = $this.closest('.product-card').find('.ajax-loader');

        $.ajax({
            url: nickonstart_wishlist_object.url,
            type: 'POST',
            data: {
                action: 'nickonstart_wishlist_action',
                nonce: nickonstart_wishlist_object.nonce,
                product_id: productId
            },
            beforeSend: function () {
                ajaxLoader.fadeIn();
            },
            success: function (res) {
                $('.wishlist-icon').removeClass('lock');
                res = JSON.parse(res);
                if (res.status === 'success') {
                    $this.toggleClass('in_wishlist');

                    $('.wishlist-icon').each(function () {
                        let id = String($(this).data('id'));
                        let wishlist = $.cookie('wishlist');
                        if (wishlist !== undefined) {
                            let ids = wishlist.split(',');
                            if ($(this).hasClass('in_wishlist') && ids.indexOf(id) === -1) {
                                $(this).toggleClass('in_wishlist');
                            }
                        }
                    })

                    iziToast.success({
                        message: res.answer,
                    });
                } else {
                    iziToast.error({
                        message: res.answer,
                    });
                }

                if (location.pathname === '/wishlist/') {
                    iziToast.warning({
                        message: nickonstart_wishlist_object.reload,
                        timeout: 2000,
                        onClosing: function (instance, toast, closedBy) {
                            location = location.href;
                        }
                    });
                }

                ajaxLoader.fadeOut();
            },
            error: function () {
                $('.wishlist-icon').removeClass('lock');
                ajaxLoader.fadeOut();
                iziToast.error({
                    message: nickonstart_wishlist_object.error,
                });
            }
        });
    })*/


	//	Non AJAX Method

    /*$('.wishlist-icon').on('click', function () {
        let $this = $(this);
        let productId = $this.data('id');
        let ajaxLoader = $this.closest('.product-card').find('.ajax-loader');

        ajaxLoader.fadeIn();

        let wishlist = $.cookie('wishlist');

        if (wishlist === undefined) {
            wishlist = [productId];
            $.cookie('wishlist', JSON.stringify(wishlist), {expires: 365, path: '/'});
            iziToast.success({
                message: nickonstart_wishlist_object.success,
            });

        } else {
            wishlist = JSON.parse(wishlist);
            if (wishlist.includes(productId)) {

                let index = wishlist.indexOf(productId);
                wishlist.splice(index, 1);
                iziToast.success({
                    message: nickonstart_wishlist_object.remove,
                });

                if (location.pathname === '/wishlist/') {
                    iziToast.warning({
                        message: nickonstart_wishlist_object.reload,
                        timeout: 2000,
                        onClosing: function (instance, toast, closedBy) {
                            location = location.href;
                        }
                    });
                }

            } else {
                if (wishlist.length >= nickonstart_wishlist_object.limit) {
                    wishlist.shift();
                }
                wishlist.push(productId);
                iziToast.success({
                    message: nickonstart_wishlist_object.success,
                });
            }

            $.cookie('wishlist', JSON.stringify(wishlist), {expires: 365, path: '/'});
			
        }
		
		$this.toggleClass('in_wishlist');

		let newWishlist = $.cookie('wishlist');
		if (newWishlist !== undefined) {
			newWishlist = JSON.parse(newWishlist);
			$('.wishlist-icon').each(function () {
            let id = $(this).data('id');
                if ($(this).hasClass('in_wishlist') && newWishlist.indexOf(id) === -1) {
                    $(this).toggleClass('in_wishlist');
                }
        })
		
		$('#wishlist-link span').text(newWishlist.length);
		}
		
        ajaxLoader.fadeOut();
    });*/


	//	DB Method
	
	$('.wishlist-icon').on('click', function () {
		let $this = $(this);
        let productId = $this.data('id');
        let ajaxLoader = $this.closest('.product-card').find('.ajax-loader');
		
		if (!nickonstart_wishlist_object.is_auth) {
			iziToast.error({
                        message: nickonstart_wishlist_object.need_auth,
                    });
					return false;
		}
		
		$.ajax({
            url: nickonstart_wishlist_object.url,
            type: 'POST',
            data: {
                action: 'nickonstart_wishlist_action_db',
                nonce: nickonstart_wishlist_object.nonce,
                product_id: productId
            },
            beforeSend: function () {
                ajaxLoader.fadeIn();
            },
            success: function (res) {
                res = JSON.parse(res);
                if (res.status === 'success') {
                    $this.toggleClass('in_wishlist');
                    iziToast.success({
                        message: res.answer,
                    });
                } else {
                    iziToast.error({
                        message: res.answer,
                    });
                }

                if (location.pathname === '/wishlist/') {
                    iziToast.warning({
                        message: nickonstart_wishlist_object.reload,
                        timeout: 2000,
                        onClosing: function (instance, toast, closedBy) {
                            location = location.href;
                        }
                    });
                }
				
				 $('.wishlist-icon').each(function () {
                        let id = String($(this).data('id'));
                        if (res.wishlist !== undefined) {
                            if ($(this).hasClass('in_wishlist') && res.wishlist.indexOf(id) === -1) {
                                $(this).toggleClass('in_wishlist');
                            }
                        }
                    })
					$('#wishlist-link span').text(res?.wishlist.length ?? '0');

                ajaxLoader.fadeOut();
            },
            error: function () {
                ajaxLoader.fadeOut();
                iziToast.error({
                    message: nickonstart_wishlist_object.error,
                });
            }
        });
	});
	
});

Fancybox.bind("[data-fancybox]", {
		

});

