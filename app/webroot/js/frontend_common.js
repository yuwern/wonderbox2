var default_zoom_level = 10;
function __l(str, lang_code) {
    return(__cfg && __cfg('lang') && __cfg('lang')[str]) ? __cfg('lang')[str]: str;
}
function __cfg(c) {
    return(cfg && cfg.cfg && cfg.cfg[c]) ? cfg.cfg[c]: false;
}
function productVote(product_slug,question_id,answer){
		$(".js-loading-img").show();
		$.ajax( {
				type: 'POST',
				url: __cfg('path_absolute')+'malaysia/product_votes/add?product_slug='+ product_slug +'&product_question_id='+ question_id +'&answer='+answer,
				cache: true,
				success: function() {
					//alert('success');
				}
		});
		$(".js-loading-img").hide();
}
(function($) {
    $.fn.fcolorbox = function() {
        $(this).livequery(function(e) {
            $(this).colorbox( {
                opacity: 0.30
            });
        });
    };

    $.fn.fajaxlogin = function() {
           $(this).livequery('submit', function(e) {
            var $this = $(this);
			$this.block();
	        $this.ajaxSubmit( {
                beforeSubmit: function(formData, jqForm, options) {},
                success: function(responseText, statusText) {
                    redirect = responseText.split('*');
                    if (redirect[0] == 'redirect') {
                        location.href = redirect[1];
                    } else if (responseText == 'success') {
                        window.location.reload();
                    } else {
						 $this.parents('div.js-responses').html(responseText);
			        }
					$this.unblock();
                }
            });
            return false;
        });
   };
})
(jQuery);
$.fx.speeds._default = 1000;
jQuery(document).ready(function($) {
 	$('#slides').slides({
						preload: true,
						preloadImage: __cfg('path_absolute')+"img/loading.gif",
						play: 5000,
						pause: 2500,
						hoverPause: true
		});
	$('a.js-thickbox').fcolorbox();
	$('a.js-sign-pop-up').colorbox( {
                opacity: 0.30,
				height: "440px"
            });
	$('.js-home-sign-pop-up').colorbox({
                opacity: 0.30,
				height: "440px",
				href : __cfg('path_absolute')+"malaysia/users/login",
				open : true
            });
	$('form.js-ajax-login').fajaxlogin();
  	$('a.js-payment-plan').livequery('click',function(){
	 	$(".js-payment-plan").addClass("select-off");
		$("#"+$(this).attr('id')).removeClass('select-off').addClass('select-on');
		var content = $.trim($('#'+$(this).attr("id")).attr('rel'));
		response = content.split("||");
		$("#js-subscription-plan").val(response[0]);
		$(".js-payment-cost").html(response[1]);
		$(".js-payment-month").html(response[2]);
	});
	$('a.js-payment-gift-plan').livequery('click',function(){
	 	$(".js-payment-gift-plan").addClass("select-off");
		$("#"+$(this).attr('id')).removeClass('select-off').addClass('select-on');
		var content = $.trim($('#'+$(this).attr("id")).attr('rel'));
		response = content.split("||");
		$("#js-subscription-plan").val(response[0]);
		$(".js-payment-cost").html(response[1]);
		$(".js-payment-month").html(response[2]);
	});
	 $('form select.js-autosubmit').livequery('change', function() {
        $(this).parents('form').submit();
    });
	$('#js-retail-click').livequery('click', function() {
		$(this).hide();
		$("#js-retail-out").slideDown('5000');

    });
	$('#js-retail-tab').livequery('click', function() {
		$("#js-retail-out").slideUp('500');
		$("#js-retail-click").slideDown('5000');

    });
	$('.js-used-product-yes').livequery('click', function() {
		$('.js-used-product-no').removeClass('active');
		$(this).addClass('active');
		$(".js-current-product").show();
		productVote($(".js-product-slug").val(),1,1);
    });	
	$('.js-used-product-no').livequery('click', function() {
		$('.js-used-product-yes').removeClass('active');
		$(this).addClass('active');
		$(".js-current-product").hide();
		productVote($(".js-product-slug").val(),1,0);
    });
	$('.js-current-product-yes').livequery('click', function() {
		$('.js-current-product-no').removeClass('active');
		$(this).addClass('active');
		productVote($(".js-product-slug").val(),2,1);
    });
	$('.js-current-product-no').livequery('click', function() {
		$('.js-current-product-yes').removeClass('active');
		$(this).addClass('active');
		productVote($(".js-product-slug").val(),2,0);
    });	
	$('.js-buy-product-yes').livequery('click', function() {
		$('.js-buy-product-no').removeClass('active');
		$(this).addClass('active');
		productVote($(".js-product-slug").val(),3,1);
		$(".js-buy-url").show();		
    });
	$('.js-buy-product-no').livequery('click', function() {
		$('.js-buy-product-yes').removeClass('active');
		$(this).addClass('active');
		productVote($(".js-product-slug").val(),3,0);
		$(".js-buy-url").hide();
    });
	$('form input#BeautyTipQ').val(__l('Enter keywords'));
    $('form input#BeautyTipQ').focus(function() {
        var search = $(this).val();
	    if (search == __l('Enter keywords')) {
            $(this).val('');
            $(this).blur(function() {
                if ($(this).val() == '') {
                    $(this).val(search);
                }
            });
        }
    });
	$('.js-link-redirect').livequery('click', function() {
		var product_slug = $(".js-product-slug").val();
		$.ajax( {
				type: 'POST',
				url: __cfg('path_absolute')+'malaysia/products/clicked?product_slug='+ product_slug ,
				cache: true,
				success: function() {
					window.open($('.js-link-redirect').attr('href'),'_blank');
				}
		});
		return false;
    });
		// open thickbox
    
		$(' .js-tabs').livequery(function() {
        $(this).tabs();
		ajaxOptions: {cache: false}
    });
});