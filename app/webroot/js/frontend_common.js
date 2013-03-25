var default_zoom_level = 10;
function __l(str, lang_code) {
    return(__cfg && __cfg('lang') && __cfg('lang')[str]) ? __cfg('lang')[str]: str;
}
function __cfg(c) {
    return(cfg && cfg.cfg && cfg.cfg[c]) ? cfg.cfg[c]: false;
}
$.fx.speeds._default = 1000;
jQuery(document).ready(function($) {
 	$('#slides').slides({
						preload: true,
						preloadImage: __cfg('path_absolute')+"img/loading.gif",
						play: 5000,
						pause: 2500,
						hoverPause: true
		});
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
	
	$('form select.js-autosubmit').livequery('change', function() {
        $(this).parents('form').submit();
    });
	$('#js-retail-click').livequery('click', function() {
		$(this).hide();
		$("#js-retail-out").slideDown('slow');
    });
	$('#js-retail-tab').livequery('click', function() {
		$("#js-retail-out").hide();
		$("#js-retail-click").slideDown('slow');
    });
	$(' .js-tabs').livequery(function() {
        $(this).tabs();
		ajaxOptions: {cache: false}
    });
});