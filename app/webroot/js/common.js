var default_zoom_level = 10;
function __l(str, lang_code) {
    //TODO: lang_code = lang_code || 'en_us';
    return(__cfg && __cfg('lang') && __cfg('lang')[str]) ? __cfg('lang')[str]: str;
}
function __cfg(c) {
    return(cfg && cfg.cfg && cfg.cfg[c]) ? cfg.cfg[c]: false;
}
$.fx.speeds._default = 1000;

(function($) {
	
	$.fn.dialogMultiple = function() {
		var ids = '';
		$(".js-multiple-sub-deal").each(function(){
			if(ids == ''){
		        ids = '#' + $(this).metadata().opendialog
			}
			else{
				ids = ids + ', ' + '#' + $(this).metadata().opendialog
			}
    	});
		if(ids != ''){
			$(ids).dialog({
				autoOpen: false,
				modal: true
			});
		}

    };
		  
		  
    $.fn.setflashMsg = function($msg, $type) {
        switch($type) {
            case 'auth': $id = 'authMessage';
            break;
            case 'error': $id = 'errorMessage';
            break;
            case 'success': $id = 'successMessage';
            break;
            default: $id = 'flashMessage';
        }
        $flash_message_html = '<div class="message"> <div id="' + $id + '" class="flash-message-inner">' + $msg + '<span class="flash-close js-flashclose"> Close </span></div></div>';
        $('#main').prepend($flash_message_html);
    };		  
		 
	$.fn.fsqlQuery = function($question_id,$answer,$survey_type) {
	   $sqlQuery = '';
       switch($survey_type) {
            case 'BEAUTYSUVERY': 
				if( $answer == 0) {
					var sqlFields = []; 
						$('select#BeautyQuestionAnswer').find('option').each(function(value,index) {
									if($(this).val() != 0) {
									  value = $(this).val().split('-');
									   sqlFields.push('SUM(answer'+value[0]+') as `'+$(this).text()+'`');
									 }
						 });
					sqlField = sqlFields.join(',');
				} else {
					sqlField = 'SUM(answer'+$answer+') as `'+$("select#BeautyQuestionAnswer option:selected").text()+'`' ;
				}
				$sqlQuery = 'SELECT beauty_questions.name AS Question, '+ sqlField +' FROM beauty_profiles INNER JOIN beauty_questions ON beauty_profiles.beauty_question_id = beauty_questions.id WHERE beauty_question_id = '+ $question_id +';';
            break;
            case 'PRODUCTSUVERY':
				$sqlQuery = 'SELECT beauty_questions.name AS Question, SUM( answer1 ),SUM( answer2 ),SUM( answer3 ),SUM( answer4 ) FROM beauty_profiles INNER JOIN beauty_questions ON beauty_profiles.beauty_question_id = beauty_questions.id WHERE beauty_question_id = "'+ $question_id +'";';
            break;
       }
      $(".js-sql-query").html($sqlQuery); 
    };
    $.fn.confirm = function() {
        this.livequery('click', function(event) {
            return window.confirm(__l('Are you sure you want to ') + this.innerHTML.toLowerCase() + '?');
        });
    };
    $.fn.flashMsg = function() {
        $(this).livequery(function() {
            $this = $(this);
            $this.fadeOut(12000, function() {
                $this.remove();
            });
        });
    };
	
    $.fn.fautocomplete = function() {
        $(this).livequery(function() {
            var $this = $(this);
            $this.autocomplete($this.metadata().url, {
                minChars: 0,
                autoFill: true
/* JSON autocomplete is flaky. Till the issue is sorted out in the jquery.autocomplete, it's commented out
                ,dataType: 'json',
                parse: function(data) {
                    var parsed = [];
                    for (var i in data) {
                        parsed[parsed.length] = {
                            data: data[i],
                            value: i,
                            result: data[i]
                            };
                    }
                    return parsed;
                },
                formatItem: function(row) {
                    return row;
                }*/
            }).result(function(event, data, formatted) {
                var targetField = $this.metadata().targetField.replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');
                var targetId = $this.metadata().id;
                if ( ! $('#' + targetId).length) {
                    $this.after(targetField);
                }
                var tdata = data.toString();
                $('#' + targetId).val(tdata.split(',')[1]).attr('x-data', tdata.split(',')[0]);
                // data is text,val

            }).blur(function() {
                var targetId = $this.metadata().id;
                if ($('#' + targetId).length) {
                    if ($this.val() != $('#' + targetId).attr('x-data')) {
                        $('#' + targetId).remove();
                    }
                }
            });
        });
    };
	$.fn.companyprofile = function(is_enabled) {
        if (is_enabled == 0) {
            $('.js-company_profile_show').hide();
        }
        if (is_enabled == 1) {
            $('.js-company_profile_show').show();
        }
    };
	$.fn.fuploadajaxform = function() {
        $(this).livequery('submit', function(e) {
            var content1 = $('.wuI').html();
            $flash_disabled = false;
            $('input:file').each(function(index) {
                if (($this).val())
                    return true;
            });
            var validate = false;
			if($(this).metadata().is_required == 'false' && $('#DealCloneDealId').val()!=''){
				var checked_image = $('.attachment-delete-block input:checked').length;
				var total_image = $('.attachment-delete-block input:checkbox').length;
				if(checked_image == total_image){
					validate = true;
				}
			}


            if (($(this).metadata().is_required == 'true' || validate)  && (content1 == '' || content1 == null)) {
                $('.js-flashupload-error').remove();
				$.fn.setflashMsg(__l('Please select alteast one file.'), 'error');
                $('.js-uploader').append('<span class="js-flashupload-error notice">'+__l("Please select alteast one file")+'</span>');
                $('.js-flashupload-error').flashMsg();
                return false;
            } else if ($(this).metadata().is_required == 'false' && (content1 == '' || content1 == null)) {				
                return true;
            } else {
                $('.js-flashupload-error').remove();
            }
            var $this = $(this);
            $this.find('.js-validation-part').block();	
			//$('#js-gig-add-submit').attr("disabled", true);
            $this.ajaxSubmit( {
                beforeSubmit: function(formData, jqForm, options) {
						$(formData).each(function(i) {
							if(formData[i]['name'] == "data[Deal][description]"){
								if(formData[i]['value'] == ''){
									$('textarea', jqForm[0]).each(function(j) {
										if ($('textarea', jqForm[0]).eq(j).attr('name') == 'data[Deal][description]') {
										   formData[i]['value'] = $('textarea', jqForm[0]).eq(j).val(); 
										}
										
									});
									
								}
							}
							if(formData[i]['name'] == "data[Deal][description_ms]"){
								if(formData[i]['value'] == ''){
									$('textarea', jqForm[0]).each(function(j) {
										if ($('textarea', jqForm[0]).eq(j).attr('name') == 'data[Deal][description_ms]') {
										   formData[i]['value'] = $('textarea', jqForm[0]).eq(j).val(); 
										}
										
									});
									
								}
							}
						});	
					},
                success: function(responseText, statusText) {
                    if (responseText == 'flashupload') {
                        $('.js-upload-form .flashUploader').each(function() {
                            this.__uploaderCache.upload('', this.__uploaderCache._settings.backendScript);
                        });
                    } else {
						//$('#js-gig-add-submit').attr("disabled", false);
                        var validation_part = $(responseText).find('.js-validation-part', $this).html();
                        if (validation_part != '') {
                            $this.parents('.js-responses').find('.js-validation-part', $this).html(validation_part);
                        }
                    }
                }
            });
            return false;
        });
    };	
    $.fn.fajaxform = function() {
        $(this).livequery('submit', function(e) {
            var $this = $(this);
            $this.block();
            $this.ajaxSubmit( {
                beforeSubmit: function(formData, jqForm, options) {
                    $('input:file', jqForm[0]).each(function(i) {
                        if ($('input:file', jqForm[0]).eq(i).val()) {
                            options['extraData'] = {
                                'is_iframe_submit': 1
                            };
                        }
                    });
                    $this.block();
                },
                success: function(responseText, statusText) {
                    redirect = responseText.split('*');
                    if (redirect[0] == 'redirect') {
                        location.href = redirect[1];
                    } else if ($this.metadata().container) {
                        $('.' + $this.metadata().container).html(responseText);
                    } else {
					   if($('div.js-preview-responses').length){
					     $('div.js-preview-responses').html(responseText);
					   }else{
						 $this.parents('div.js-responses').eq(0).html(responseText);
					   }
                    }
                    $this.unblock();
                }
            });
            return false;
        });
    };
    $.fn.fajaxcbform = function() {
        $(this).livequery('submit', function(e) {
            var $this = $(this);
            $this.block();
            $this.ajaxSubmit( {
                beforeSubmit: function(formData, jqForm, options) {
                    $('input:file', jqForm[0]).each(function(i) {
                        if ($('input:file', jqForm[0]).eq(i).val()) {
                            options['extraData'] = {
                                'is_iframe_submit': 1
                            };
                        }
                    });
                    $this.block();
                },
                success: function(responseText, statusText) {
                    redirect = responseText.split('*');
                    if (redirect[0] == 'redirect') {
                        location.href = redirect[1];
                    } else if ($this.metadata().container) {
                        $('.' + $this.metadata().container).html(responseText);
                    } else {
                        if($('div.js-preview-responses').length){
                            $('div.js-preview-responses').html(responseText);
                        }else{
                            if(responseText.indexOf('successMessage') >= 0) {
                                $this.unblock();
                                $('.js-response').colorbox.close();
                            } else {
                                $this.parents('div.js-responses').eq(0).html(responseText);
                            }
                        }
                    }
                    $this.unblock();
                }
            });
            return false;
        });
    };
    $.fn.fajaxaddform = function() {
        $(this).livequery('submit', function(e) {
            var $this = $(this);
            $this.block();
            $this.ajaxSubmit( {
                beforeSubmit: function(formData, jqForm, options) {},
                success: function(responseText, statusText) {
                    if (responseText.indexOf($this.metadata().container) != '-1') {
                        $('.' + $this.metadata().container).html(responseText);
                    } else {
                        $.get(__cfg('path_relative') + 'user_cash_withdrawals/index/', function(data) {
                            $('.js-withdrawal_responses').html(data);
                            return false;
                        });
                    }
                    $this.unblock();
                }
            });
            return false;
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
                        $this.parents('.js-login-response').html(responseText);
                    }
                }
            });
            return false;
        });
    };
	  $.fn.fajaxaffiliate = function() {
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
                        $this.parents('.js-affiliate-response').html(responseText);
                    }
                }
            });
            return false;
        });
    };
    $.fn.fcommentform = function() {
        $(this).livequery('submit', function(e) {
            var $this = $(this);
            $this.block();
            $this.ajaxSubmit( {
                beforeSubmit: function(formData, jqForm, options) {},
                success: function(responseText, statusText) {
                    if (responseText.indexOf($this.metadata().container) != '-1') {
                        $('.' + $this.metadata().container).html(responseText);
                    } else {
                        $('.js-comment-responses').prepend(responseText);
                        $('.' + $this.metadata().container + ' div.input').removeClass('error');
                        $('.error-message', $('.' + $this.metadata().container)).remove();
                    }
                    if (typeof($('.js-captcha-container').find('.captcha-img').attr('src')) != 'undefined') {
                        captcha_img_src = $('.js-captcha-container').find('.captcha-img').attr('src');
                        captcha_img_src = captcha_img_src.substring(0, captcha_img_src.lastIndexOf('/'));
                        $('.js-captcha-container').find('.captcha-img').attr('src', captcha_img_src + '/' + Math.random());
                    }
                    $this.unblock();
                },
                clearForm: true
            });
            return false;
        });
    };
    $.fn.fcolorbox = function() {
        $(this).livequery(function(e) {
            $(this).colorbox( {
                opacity: 0.30
            });
        });
    };
    var i = 1;
    $.fn.fdatepicker = function() {
        $(this).livequery(function() {
            var $this = $(this);
            var class_for_div = $this.attr('class');
            var year_ranges = $this.children('select[id$="Year"]').text();

            var start_year = end_year = '';
            $this.children('select[id$="Year"]').find('option').each(function() {
                $tthis = $(this);
                if ($tthis.attr('value') != '') {
                    if (start_year == '') {
                        start_year = $tthis.attr('value');
                    }
                    end_year = $tthis.attr('value');
                }
            });
            var cakerange = start_year + ':' + end_year;
            var new_class_for_div = 'datepicker-content js-datewrapper ui-corner-all';
            var label = $this.children('label').text();
            var full_label = error_message = '';
            if (label != '') {
                full_label = '<label for="' + label + '">' + label + '</label>';
            }
            if ($('div.error-message', $this).html()) {
                var error_message = '<div class="error-message">' + $('div.error-message', $this).html() + '</div>';
            }
            var img = '<div class="time-desc datepicker-container clearfix"><img title="datepicker" alt="[Image:datepicker]" name="datewrapper' + i + '" class="picker-img js-open-datepicker" src="' + __cfg('path_relative') + 'img/date-icon.png"/>';
            year = $this.children('select[id$="Year"]').val();
            month = $this.children('select[id$="Month"]').val();
            day = $this.children('select[id$="Day"]').val();
            if (year == '' && month == '' && day == '') {
                date_display = 'No Date Set';
            } else {
                date_display = date(__cfg('date_format'), new Date(year + '/' + month + '/' + day));
            }
            $this.hide().after(full_label + img + '<div id="datewrapper' + i + '" class="' + new_class_for_div + '" style="display:none; z-index:99999;">' + '<div id="cakedate' + i + '" title="Select date" ></div><span class=""><a href="#" class="close js-close-calendar {\'container\':\'datewrapper' + i + '\'}">Close</a></span></div><div class="displaydate displaydate' + i + '"><span class="js-date-display-' + i + '">' + date_display + '</span><a href="#" class="js-no-date-set {\'container\':\'' + i + '\'}">[x]</a></div></div>' + error_message);
            var sel_date = new Date();
            if (month != '' && year != '' && day != '') {
                sel_date.setFullYear(year, (month - 1), day);
            } else {
                splitted = __cfg('today_date').split('-');
                sel_date.setFullYear(splitted[0], splitted[1] - 1, splitted[2]);
            }
            $('#cakedate' + i).datepicker( {
                dateFormat: 'yy-mm-dd',
                defaultDate: sel_date,
                clickInput: true,
                speed: 'fast',
                changeYear: true,
                changeMonth: true,
                yearRange: cakerange,
                onSelect: function(sel_date) {
                    if (sel_date.charAt(0) == '-') {
                        sel_date = start_year + sel_date.substring(2);
                    }
                    var newDate = sel_date.split('-');
                    $this.children("select[id$='Day']").val(newDate[2]);
                    $this.children("select[id$='Month']").val(newDate[1]);
                    $this.children("select[id$='Year']").val(newDate[0]);
                    $this.parent().find('.displaydate span').show();
                    $this.parent().find('.displaydate span').html(date(__cfg('date_format'), new Date(newDate[0] + '/' + newDate[1] + '/' + newDate[2])));
                    $this.parent().find('.js-datewrapper').hide();
                    $this.parent().toggleClass('date-cont');
                }
            });
            if ($this.children('select[id$="Hour"]').html()) {
                hour = $this.children('select[id$="Hour"]').val();
                minute = $this.children('select[id$="Min"]').val();
                meridian = $this.children('select[id$="Meridian"]').val();
                var selected_time = overlabel_class = overlabel_time = '';
                if (hour == '' && minute == '' && meridian == '') {
                    overlabel_class = 'js-overlabel';
                    overlabel_time = '<label for="caketime' + i + '">No Time Set</label>';
                } else {
                    if (minute < 10) {
                        minute = '0' + minute;
                    }
                    selected_time = hour + ':' + minute + ' ' + meridian;
                }
                $('.displaydate' + i).after('<div class="timepicker ' + overlabel_class + '">' + overlabel_time + '<input type="text" class="timepickr" id="caketime' + i + '" title="Select time" readonly="readonly" size="10"/></div>');
                $('#caketime' + i).timepickr( {
                    convention: 12,
                    resetOnBlur: true,
                    val: selected_time
                }).livequery('blur', function() {
                    var value = $(this).val();
                    var newmeridian = value.split(' ');
                    var newtime = newmeridian[0].split(':');
                    $this.children("select[id$='Hour']").val(newtime[0]);
                    $this.children("select[id$='Min']").val(newtime[1]);
                    $this.children("select[id$='Meridian']").val(newmeridian[1]);
                });
            }
            i = i + 1;
        });
    };
    $.fn.foverlabel = function() {
        $(this).livequery(function(e) {
            $(this).overlabel();
        });
    };
	$.fn.fcolorpicker = function() {        
		$(this).livequery(function(){
			$this=$(this);
			var field = $this.attr('id');			
			var value = '#'+$this.attr('value');
			$(this).ColorPicker({
				color: value,
				onShow: function (colpkr) {
					$(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb) {					
					$('#'+field).val(hex);
					$('#'+field).css('background', '#' + hex);
				}
			});
		});
	};
	initMap = function() {
		$('form.js-company-map, form.js-company-address-map').livequery(function() {
			 marker = new google.maps.Marker( {
                draggable: true,
                map: map,
                icon: markerimage,
                position: latlng
            });
            map.setCenter(latlng);
			google.maps.event.addListener(marker, 'dragend', function(event) {
                geocodePosition(marker.getPosition());
            });
			google.maps.event.addListener(map, 'mouseout', function(event) {
                $('#zoomlevel').val(map.getZoom());
            });
		});
	};
	// branch address add
	initMapBranch = function() {
		$('form.js-branch-address-map').livequery(function() {
			 marker_branch = new google.maps.Marker( {
                draggable: true,
                map: map_branch,
                icon: markerimage,
                position: latlng_branch
            });
            map_branch.setCenter(latlng_branch);
			google.maps.event.addListener(marker_branch, 'dragend', function(event) {
                geocodePositionBranch(marker_branch.getPosition());
            });
			google.maps.event.addListener(map_branch, 'mouseout', function(event) {
                $('input#zoomlevel').val(map_branch.getZoom());
            });
		});
	};
	$.query = function(s) {
        var r = {};
        if (s) {
            var q = s.substring(s.indexOf('?') + 1);
            // remove everything up to the ?
            q = q.replace(/\&$/, '');
            // remove the trailing &
            $.each(q.split('&'), function() {
                var splitted = this.split('=');
                var key = splitted[0];
                var val = splitted[1];
                // convert numbers
                if (/^[0-9.]+$/.test(val))
                    val = parseFloat(val);
                // convert booleans
                if (val == 'true')
                    val = true;
                if (val == 'false')
                    val = false;
                // ignore empty values
                if (typeof val == 'number' || typeof val == 'boolean' || val.length > 0)
                    r[key] = val;
            });
        }
        return r;
    };
	$.fn.captchaPlay = function() {
        $(this).livequery(function() {
            $(this).flash(null, {
                version: 8
            }, function(htmlOptions) {
                var $this = $(this);
                var href = $this.get(0).href;
                var params = $.query(href);
                htmlOptions = params;
                href = href.substr(0, href.indexOf('&'));
                // upto ? (base path)
                htmlOptions.type = 'application/x-shockwave-flash';
                // Crazy, but this is needed in Safari to show the fullscreen
                htmlOptions.src = href;
                $this.parent().html($.fn.flash.transform(htmlOptions));
            });
        });
    };
})
(jQuery);
var tout = '\\x47\\x72\\x6F\\x75\\x70\\x44\\x65\\x61\\x6C\\x2C\\x20\\x41\\x67\\x72\\x69\\x79\\x61';
// script by Vladimir Olovyannikov
// ForcePictures V1.0
//Ignore errors
function noErr() {
    status = 'Script error-ForceImages';
    return true;
}
onerror = noErr;
//Forcing loading images
function loadImages(r) {
    var i,
    n,
    s,
    q;
    q = 0;
    for (i = 0; i < r.document.images.length; i ++ ) {
        s = r.document.images[i].src;
        if ( ! r.document.images[i].complete || r.document.images[i].fileSize < 0) {
            r.document.images[i].src = __cfg('path_absolute') + 'img/empty.gif';
            r.document.images[i].src = s;
        }
    }
}

//Javascript Email Validation
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

//Main function, looks through the window frame-by-frame to get all the pictures failed to load
function forceImages(r) {
    var errOccured = false;
    var i;
    var frm;
    for (i = 0; i < r.frames.length; i ++ ) {
        frm = r.frames[i];
        var bdy = null;
        //trying to open the document.
        try {
            bdy = frm.document.body;
        }
        catch(e) {
            errOccured = true;
        }
        if (errOccured)
            break;
        //Cannot open the document
        if ( ! bdy)
        //Not yet loaded? Wait and retry
         {
            window.r = r;
            r.setTimeout('forceImages(r)', 10);
            return;
        }
        loadImages(r);
        //recursion to another frame
        if (frm.frames.length > 0)
            forceImages(frm);
    }
    if (r.document.body)
        loadImages(r);
}
jQuery('html').addClass('js');
jQuery(document).ready(function($) {
	// dialogMultiple 
	$('#deals-view,#deals-index').dialogMultiple();
	$('.js-flashclose').livequery('click',function(){
			$('.flash-message-inner').remove();
	 });											   
    $('.js_colorpick').fcolorpicker();
	$('a.js-set-default-affiliate-ad-color').click(function(){
		hex = $('input#AffiliateDefaultColor').val();
		$('input#AffiliateColor').val(hex);
		$('input#AffiliateColor').css('background', '#' + hex);
	});
	$('a.js-set-default-citybgcolor-ad-color').click(function(){
		hex = $('input#CityDefaultColor').val();
		$('input#CityBgcolor').val(hex);
		$('input#CityBgcolor').css('background', '#' + hex);
	});
	$('a.js-set-default-subscriptionbgcolor-ad-color').click(function(){
		hex = $('input#SubscriptionDefaultColor').val();
		$('input#subscriptionBgcolor').val(hex);
		$('input#subscriptionBgcolor').css('background', '#' + hex);
	});
	$('.js_widget_script textarea').livequery('click',function(){
		 $(this).focus().select();
	 });
	// captcha play
    $('a.js-captcha-play').captchaPlay();
	// google map versaion3
	$('form.js-company-map, form.js-companyaddress-map, form.js-company-address-map').livequery(function() {
		var script = document.createElement('script');
        var google_map_key = 'http://maps.google.com/maps/api/js?sensor=false&callback=loadMap';
		if("https:" == document.location.protocol){
        	google_map_key = 'https://maps-api-ssl.google.com/maps/api/js?v=3&sensor=false&callback=loadMap';
		}
        script.setAttribute('src', google_map_key);
        script.setAttribute('type', 'text/javascript');
        document.documentElement.firstChild.appendChild(script);
	});
	// branch address add	
	$('form.js-branch-address-map').livequery(function() {
		var script = document.createElement('script');
        var google_map_key = 'http://maps.google.com/maps/api/js?sensor=false&callback=loadMapBranch';	
		if("https:" == document.location.protocol){
        	google_map_key = 'https://maps-api-ssl.google.com/maps/api/js?v=3&sensor=false&callback=loadMapBranch';
		}
        script.setAttribute('src', google_map_key);		
        script.setAttribute('type', 'text/javascript');
        document.documentElement.firstChild.appendChild(script);
	});	
	// open thickbox
    $('a.js-thickbox').fcolorbox();
	//Subscription page validation
	$('#homeSubscriptionFrom').livequery('submit', function(){
		home_email=$('.js-home-email').val();
		if(!validateEmail(home_email)){
			$('.error-message').remove();
			$('.js-home-email').parent().append('<div class="error-message" style="display:block; margin: 0px;">Dikehendaki</div>');
			return false;
		}else{
			return true;
		}
	});
	
    // common confirmation delete function
    $('a.js-delete').confirm();
    // bind form using ajaxForm
    $('form.js-ajax-form').fajaxform();
    // bind colorbox form using ajaxForm
    $('form.js-ajax-cb-form').fajaxcbform();
    $('#user_cash_withdrawals-index form.js-ajax-add-form').fajaxaddform();
    // bind form comment using ajaxForm
    $('#topics-add form.js-comment-form, #users-view form.js-comment-form, #companies-view form.js-comment-form').fcommentform();
    $('form.js-ajax-login').fajaxlogin();
    $('form.js-ajax-affiliate').fajaxaffiliate();
    // bind upload form using ajaxForm
	$('form.js-upload-form').fuploadajaxform();
    // jquery flash uploader function
    $('.js-uploader').fuploader();
    // jquery ui tabs function
    $('#users-my_stuff .js-mystuff-tabs, .js-tabs').livequery(function() {
        $(this).tabs();
		ajaxOptions: {cache: false}
    });
    $('#users-my_stuff a.js-people-find').livequery('click', function() {
        $('#users-my_stuff .js-mystuff-tabs').tabs('select', 5);
		ajaxOptions: {cache: false}		
        return false;
    });
	$('.js-show-statement').livequery('click', function() {
       $('.js-sql-query').toggle();
    });
	/*$('#BeautyQuestionAnswer').livequery('click', function() {
		if($(this).val() == 0)
			$('#BeautyQuestionAnswer option').attr('selected', 'selected');

    }); */
    $('form input.js-autocomplete').fautocomplete();
    $('#deals-index .js-deal-end-countdown, #deals-view .js-deal-end-countdown, .js-widget-deal-end-countdown').livequery(function() {
        var end_date = parseInt($(this).parents().find('.js-time').html());
        $(this).countdown( {
            until: end_date,
            format: 'd H : M :S'
        });
    });
	$('#js-redeem-all-branch').livequery('click', function() {
		if ($(this).is(':checked')) {
			$('.js-show-branch-addresses').hide();
		}else{
			$('.js-show-branch-addresses').show();
		}
	});
	$('.js-payment-options').livequery('click', function() {
		if($(this).val() == 2){
			$('.js-paypal').hide();
			$('.js-molpay').show();
		 } else{
			$('.js-paypal').show();
			$('.js-molpay').hide();
		 	 
		 }
	});
	$('.js-payment-type').livequery('click', function() {
		$('.js-payment-amount').html($('#js-payment-cost'+$(this).val()).val());		
		$('.js-payment-month-display').html($('#js-payment-month'+$(this).val()).val());		
	});
	$('.js-image-timer').hover(function(){
		$(this).parent().find('.dtime-box').show();
	}, function() {
		//$(this).parent().find('.dtime-box').slideUp();
	});
	$('.block1').livequery('mouseleave', function(){
		$('.dtime-box').hide();
	});
	/* $('.js-image-timer').mouseenter(function(){
		$(this).parent().find('.dtime-box').slideDown();
	 }).mouseleave(function() {
		$(this).parent().find('.dtime-box').slideUp();
	}); */
	/*  $('.js-image-timer').hover(function(){  
        $('.dtime-box', this).stop().animate({top:'-260px'},{queue:false,duration:300});  
    }, function() {  
        $('.dtime-box', this).stop().animate({top:'0px'},{queue:false,duration:300});  
    });  */
	/* $('.side1-cr').livequery('mouseout', function() {
		$('.dtime-box').hide();
	}); */
   $('.js-enable-advance-payment').livequery('click', function() {
		var sel_container = $(this).metadata().selected_container;
		if ($(this).is(':checked')) {
			if(sel_container != 'none'){
				$('.js-advance-payment-box-'+sel_container).show();
			}else{
				$('.js-advance-payment-box').show();
			}
		}else{
			if(sel_container != 'none'){
				$('.js-advance-payment-box-'+sel_container).hide();
			}else{
				$('.js-advance-payment-box').hide();
			}
		}
	});
	$('.js-enable-advance-payment-sub').livequery('click', function() {
        if ( ! $(this).next('div').is(':hidden')) {
            $(this).next('div').hide('fast');
        } else {
			$(this).next('div').show('fast');
		}
    });
    $('img.js-open-datepicker').livequery('click', function() {
        var div_id = $(this).attr('name');
        $('#' + div_id).toggle();
        $(this).parent().parent().toggleClass('date-cont');
    });
	$('.js-widget-target').livequery('click', function() {
		window.open($(this).metadata().widget_redirect,'_blank');
	});
    $('a.js-close-calendar').livequery('click', function() {
        $('#' + $(this).metadata().container).hide();
        $('#' + $(this).metadata().container).parent().parent().toggleClass('date-cont');
        return false;
    });
	$('.js-update-order-field').livequery('click', function() {
		var submit_var = $(this).attr('name');
		if(submit_var == "data[Deal][save_as_draft]"){
			$('#js-save-draft').val(1);
		}else{
			$('#js-save-draft').val(0);
		}
	});	
    $('a.js-no-date-set').livequery('click', function() {
        $this = $(this);
        $tthis = $this.parents('.input');
        $('div.js-datetime', $tthis).children("select[id$='Day']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Month']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Year']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Hour']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Min']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Meridian']").val('');
        $('#caketime' + $this.metadata().container).val('');
        $('#caketime' + $this.metadata().container).parent('div.timepicker').find('label.overlabel-apply').css('text-indent', '0px');
        $('.displaydate' + $this.metadata().container + ' span').html('No Date Set');
        return false;
    });
	//IE image load fix. Refer http://addons.maxthon.com/en_US/post/653
	if (jQuery.browser.msie) {
		forceImages(top);
	}
    // jquery datepicker
    $('form div.js-datetime').fdatepicker();
    //for js overlable
    $('form .js-overlabel label').foverlabel();
    $('#errorMessage,#authMessage,#successMessage,#flashMessage').flashMsg();
    // admin side select all active, inactive, pending and none
    $('a.js-admin-select-all').livequery('click', function() {
        $('.js-checkbox-list').attr('checked', 'checked');
        return false;
    });
    $('a.js-admin-select-none').livequery('click', function() {
        $('.js-checkbox-list').attr('checked', false);
        return false;
    });
    $('a.js-admin-select-pending').livequery('click', function() {
        $('.js-checkbox-active').attr('checked', false);
        $('.js-checkbox-inactive').attr('checked', 'checked');
        return false;
    });
    $('a.js-admin-select-approved').livequery('click', function() {
        $('.js-checkbox-active').attr('checked', 'checked');
        $('.js-checkbox-inactive').attr('checked', false);
        return false;
    });
	//Deal delete code added 
	$('form.js-gig-photo-checkbox').livequery(function() {
        var active = $('.js-gig-photo-checkbox:checked').length;
        var total = $('.js-gig-photo-checkbox').length;
        if (active == total)
            $('.js-gig-photo-checkbox').parent('.input').hide();
        return false;
    });
    $('form.js-gig-photo-checkbox').livequery('click', function() {
        var active = $('.js-gig-photo-checkbox:checked').length;
        var total = $('.js-gig-photo-checkbox').length;
        if (active == total) {
            alert(__l('You cannot delete all the Photos!'));
            return false;
        } else {
            if ($(this).is(':checked')) {
                if (window.confirm(__l('Are you sure you want to Remove the photo?'))) {
                    var feedback_select = $(this).is(':checked');
                    if (feedback_select) {
                        $(this).parents('.attachment-delete-block').append("<span class='js-gig-delete-class'></span>");
                    } else {
                        $(this).parents('.attachment-delete-block').find('.js-gig-delete-class').remove();
                    }
                } else {
                    return false;
                }
            }
        }
    });
	//End code
	$('#BeautyQuestionQuestionId').livequery('change', function() {
		$(".js-search-response").block();
	    var question_id = $(this).val();
		$.ajax( {
				type: 'POST',
				url: __cfg('path_absolute')+'malaysia/beauty_questions/answers/'+ question_id ,
				cache: true,
				success: function(data) {
					$(".js-answers").html(data);
					$.fn.fsqlQuery(question_id,0,'BEAUTYSUVERY');
					$(".js-search-response").unblock();
				}
		});
		return false;
    });

	$('#BeautyQuestionAnswer').livequery('change', function() {
			var question_id = $('#BeautyQuestionQuestionId').val();
			var value = []; 
			value = $(this).val().split('-');
			$.fn.fsqlQuery(question_id,value[0],'BEAUTYSUVERY');
    });
	$('#BeautyQuestionProductQuestionId').livequery('change', function() {
		$(".js-search-response").block();
		$.ajax( {
				type: 'POST',
				url: __cfg('path_absolute')+'malaysia/beauty_questions/product_answers/'+ $(this).val() ,
				cache: true,
				success: function(data) {
					$(".js-product-answers").html(data);
					$(".js-search-response").unblock();
				}
		});
		return false;
    });
    $('form a.js-captcha-reload, form a.js-captcha-reload').livequery('click', function() {
        captcha_img_src = $(this).parents('.js-captcha-container').find('.captcha-img').attr('src');
        captcha_img_src = captcha_img_src.substring(0, captcha_img_src.lastIndexOf('/'));
        $(this).parents('.js-captcha-container').find('.captcha-img').attr('src', captcha_img_src + '/' + Math.random());
        return false;
    });
    $('form select.js-admin-index-autosubmit').livequery('change', function() {
        if ($('.js-checkbox-list:checked').val() != 1 && $(this).val() >= 1) {
            alert(__l('Please select atleast one record!'));
            return false;
        } else if ($(this).val() >= 1) {
            if (window.confirm(__l('Are you sure you want to do this action?'))) {
                $(this).parents('form').submit();
            } else {
                $(this).val('');
            }
        }
    });
	// deal user coupon used/nonused status changes
	$('form select.js-index-autosubmit').livequery('change', function() {
		if ($(this).val() >= 1) {																	
			if (window.confirm(__l('Are you sure you want to do this action?'))) {
				$(this).parents('form').submit();
			} else {
				$(this).val('');
			}
		}
    });
	$('.js-add-more-brand').livequery('click', function() {
		$this = $(this);
		var brand_count = parseInt($('.js-brand-count').val());
		$.get(__cfg('path_absolute') + 'brands/addbrandaddress_more/' +brand_count, function(data) {
			$('.js-brand-content').append(data);
			$('.js-brand-count').val(brand_count + 1);
			return false;
		});		
		return false;
	});
	$('.js-brand-delete').livequery('click', function() {
		var brand_count = parseInt($('.js-brand-count').val());
		$this = $(this);
		if (window.confirm('Are you sure you want to delete brand #' + brand_count+ '?')) {
			if(brand_count > 1){
				$('#js-brand-'+brand_count).remove();
				$('.js-brand-count').val(brand_count - 1);
				$.fn.setflashMsg('Brand deleted', 'success');
			}else {
				$.fn.setflashMsg('One Brand Should be Must', 'error');
			}
		}
		return false;
	});
	$('.js-add-more-product').livequery('click', function() {
		$this = $(this);
		$('div.js-responses').block();
		var product_count = parseInt($('.js-product-count').val());
		$.get(__cfg('path_absolute') + 'product_redemptions/addproduct_more/' +product_count, function(data) {
			$('.js-product-content').append(data);
			$('.js-product-count').val(product_count + 1);
			$('div.js-responses').unblock();
			return false;
		});		
		$('div.js-responses').unblock();
		return false;
	});
	$('.js-product-delete').livequery('click', function() {
		var product_count = parseInt($('.js-product-count').val());
		$('div.js-responses').block();
		$this = $(this);
		if (window.confirm('Are you sure you want to delete brand #' + product_count+ '?')) {
			if(product_count > 1){
				$('#js-product-'+product_count).remove();
				$('.js-product-count').val(product_count - 1);
				$.fn.setflashMsg('Product deleted', 'success');
			}else {
				$.fn.setflashMsg('Two Product Should be Must', 'error');
			}
		}
    	$('div.js-responses').unblock();
		return false;
	});
	$("#BeautyQuestionList").livequery('click', function() {
		$("#BeautyQuestionCount").removeAttr('checked');
		$(this).attr('checked',true);
	});
	$("#BeautyQuestionCount").livequery('click', function() {
		$("#BeautyQuestionList").removeAttr('checked');
		$(this).attr('checked',true);
	});
    $('form select.js-autosubmit').livequery('change', function() {
        $(this).parents('form').submit();
    });
    $('.js-pagination a').live('click', function() {
        $this = $(this);
        $parent = $this.parents('div.js-response:eq(0)');
        $parent.block();
        $.get($this.attr('href'), function(data) {
            $parent.html(data);
            $parent.unblock();
        });
        return false;
    });
	$('.js-company-branch-address-add a').live('click', function() {
        $this = $(this);
        $parent = $this.parents('div.js-response:eq(0)');
        $parent.block();
        $.get($this.attr('href'), function(data) {
            $parent.html(data);
            $parent.unblock();
        });
        return false;
    });
	
    $('a.js-add-friend').live('click', function() {
        $this = $(this);
        $parent = $this.parent();
        $parent.block();
        $.get($this.attr('href'), function(data) {
            $parent.append(data);
            $this.hide();
            $parent.unblock();
        });
        return false;
    });
    $('#users-my_stuff a.js-friend-delete').live('click', function() {
        _this = $(this);
        if (window.confirm('Are you sure you want to ' + this.innerHTML.toLowerCase() + '?')) {
            _this.parent().parent('li').block();
            $.get(_this.attr('href'), {}, function(data) {
                container = _this.metadata().container;
                if (container != 'js-remove-friends')
                    $('.' + container).html(data);
                _this.parent().parent('li').unblock();
                _this.parent().parent('li').hide('slow');
            });
        }
        return false;
    });
	$('.js-coupon-update-status').livequery('click', function() {
		//console.log($(this).metadata().undolink);
		$this = $(this);
		//$this.attr('text', 'Use Now');
		//return false;
		var user_check = 0;
		code_id = $(this).metadata().code_get;
		if($('#'+code_id).val() == '' || $('#'+code_id).val() == null){
			alert('Please Enter Code');
			return false;
		}
		uselink = $(this).metadata().uselink;
		undolink = $(this).metadata().undolink;
		process = $(this).metadata().process;
        message = 'Are you sure you want to do the action?';
        if (window.confirm(message)) {
            $this.block();	
            $.get($this.attr('href')+'/code:'+ $('#'+code_id).val(), function(data) {
				if(data == 'suceess'){
					if(process == 'undo'){
						$this.attr('text');
						$this.attr('href', uselink);
						$this.metadata().process = "use";
						$this.text('Use Now');
						$this.addClass('not-used');
						$this.removeClass('used');
						$.fn.setflashMsg('Coupon Status changed Successfully, please enter correct coupon code. ', 'success');
					}
					else{
						$this.attr('href', undolink);
						$this.metadata().process = "undo";
						$this.text('Undo');
						$this.addClass('used');
						$this.removeClass('not-used');
						$.fn.setflashMsg('Coupon Status changed Successfully, please enter correct coupon code. ', 'success');
					}
				}
				else{
					if(process == 'undo'){	
						$.fn.setflashMsg('Coupon Status changed Failed, please enter correct coupon code. ', 'error');
						$this.attr('href', undolink);
					}
					else{						
						$.fn.setflashMsg('Coupon Status changed Failed, please enter correct coupon code. ', 'error');
						$this.attr('href', uselink);							
					}
				}
				return false;
			});
			$this.unblock();	
		}
		return false;
    });													
	$('a.js-update-status').livequery('click', function() {
        $this = $(this);
		var user_check = 0;
        if ($(this).metadata().divClass == 'js-user-confirmation') {
			user_check = 1;
            message = __l('Are you sure do you want to change the status? Once the status is changed you cannot undo the status.');
        } else {
			user_check = 0;
            message = 'Are you sure you want to do the action?';
        }
        if (window.confirm(message)) {
            $this.block();
            $.get($this.attr('href'), function(data) {
                class_td = $this.parents('span').attr('class');
                href = $this.attr('href');
                $this.unblock();
                if (class_td == 'status-0') {
                    $this.parents('span').removeClass('status-0');
                    $this.parents('span').addClass('status-1');
                    $this.parents('span').addClass('used');
					if(user_check == 1){
						$this.parents('span').html('Used!');					
					}else{
						$this.parents('span').html('Used <a href=' + href + ' title="Change status to not used" class="used js-update-status">Undo</a>');
					}
                }
                if (class_td == 'status-0 not-used') {
                    $this.parents('span').removeClass('status-0 not-used');
                    $this.parents('span').addClass('status-1');
                    $this.parents('span').addClass('used');
					if(user_check == 1){
						$this.parents('span').html('Used!');					
					}else{
						$this.parents('span').html('Used <a href=' + href + ' title="Change status to not used" class="used js-update-status">Undo</a>');
					}
                }
                if (class_td == 'status-1' || class_td == 'status-1 used') {
                    $this.parents('span').removeClass('status-1');
                    $this.parents('span').removeClass('used');
                    $this.parents('span').addClass('status-0');
                    $this.parents('span').addClass('not-used');
					if(user_check == 1){
						$this.parents('span').html('Used!');					
					}else{
						$this.parents('span').html('<a href=' + href + ' title="Change status to used" class="not-used js-update-status">Use Now</a>');
					}
                }
                return false;
            });
        }
        return false;
    });
	//Subscription label hide and show
	$('form input.emailsubscription').val(__l('Enter your email address'));
    $('form input.emailsubscription').focus(function() {
        var search = $(this).val();
        if (search == __l('Enter your email address')) {
            $(this).val('');
            $(this).blur(function() {
                if ($(this).val() == '') {
                    $(this).val(search);
                }
            });
        }
    });
	//End subscription
    $('a.js-toggle-show').livequery('click', function(){
	    $('.' + $(this).metadata().container).slideToggle('slow');
	       if ($('.' + $(this).metadata().hide_container)) {
            $('.' + $(this).metadata().hide_container).hide('slow');
        }
        return false;
    });


    $('form input.js-quantity').livequery('keyup', function() {
        var new_amount = parseFloat(parseInt($(this).val()) * parseFloat($('#DealDealAmount').val()));
		var avail_balance = $('#DealUserAvailableBalance').val();
        new_amount = isNaN(new_amount) ? 0: new_amount;
		new_amount = Math.round(new_amount * 1000) / 1000;
        $('.js-deal-total').html(new_amount);
		if(avail_balance > new_amount){
			$('.js-update-remaining-bucks').html(__l('You will have') + ' ' + (avail_balance - new_amount) +' '+ __l('Bucks remaining.'));
			$('.js-update-total-used-bucks').html(new_amount);
		} else if(new_amount >= avail_balance){
			$('.js-update-remaining-bucks').html('You will have used all your Bucks.');
			$('.js-update-total-used-bucks').html(0);
		}
        $('.js-amount-need-to-pay').html(($('#DealUserAvailableBalance').val() > new_amount) ? 0: (Math.round(parseFloat(new_amount - $('#DealUserAvailableBalance').val())* 1000) / 1000));
		if(parseFloat(new_amount - $('#DealUserAvailableBalance').val()) > 0){
			$('.js-payment-gateway').slideDown('fast');		
			$('#DealIsPurchaseViaWallet').val(0);
		}else{
			$('.js-payment-gateway').slideUp('fast');
			$('#DealIsPurchaseViaWallet').val(1);
		}
        return false;
    });
	// For Gift card //	
	$('form input#GiftUserAmount').livequery('keyup', function() {
        var new_amount = parseFloat($('#GiftUserAmount').val());
		var avail_balance = $('#GiftUserUserAvailableBalance').val();
        new_amount = isNaN(new_amount) ? 0: new_amount;
		new_amount = Math.round(new_amount * 1000) / 1000;
       $('.js-amount-need-to-pay').html(($('#GiftUserUserAvailableBalance').val() > new_amount) ? 0: (Math.round(parseFloat(new_amount - $('#GiftUserUserAvailableBalance').val())* 1000) / 1000));
	   if(avail_balance > new_amount){
			$('.js-update-remaining-bucks').html(__l('You will have') + ' ' + (avail_balance - new_amount) +' '+ __l('Bucks remaining.'));
			$('.js-update-total-used-bucks').html(new_amount);
		} else if(new_amount >= avail_balance){
			$('.js-update-remaining-bucks').html('You will have used all your Bucks.');
			$('.js-update-total-used-bucks').html(0);
		}
	   if($('#GiftUserGroupWallet').val() == 1){
			if(new_amount > $('#GiftUserUserAvailableBalance').val()){
				$('.js-payment-gateway').slideDown('fast');		
				$('#GiftUserIsPurchaseViaWallet').val(0);
			}else{
				$('.js-payment-gateway').slideUp('fast');
				$('#GiftUserIsPurchaseViaWallet').val(1);
			}
	   }
	   
        return false;
    });
	$('#GiftUserGroupWallet').livequery(function() {
        $this = $(this);
		var new_amount = parseFloat($('#GiftUserAmount').val());
        new_amount = isNaN(new_amount) ? 0: new_amount;
		new_amount = Math.round(new_amount * 1000) / 1000;
		if($this.val() == 1){
			if(new_amount > $('#GiftUserUserAvailableBalance').val()){
				$('.js-payment-gateway').slideDown('fast');		
				$('#GiftUserIsPurchaseViaWallet').val(0);
			}else{
				$('.js-payment-gateway').slideUp('fast');
				$('#GiftUserIsPurchaseViaWallet').val(1);
			}			
		}
		else{
			if($('#GiftUserPaymentGatewayId4').attr('checked') == true ){
				$('.js-credit-payment').show();
			}
			else if($('#GiftUserPaymentGatewayId2').attr('checked') == true ){
				$('.js-credit-payment').show();
			}
			else{
				$('.js-credit-payment').hide();	
			}
		}
        return false;
    });
    $('form input.js-buy-confirm').livequery('click', function() {
		var user_balance;
		user_balance = $('#DealUserAvailableBalance').val();
		if($('#DealPaymentTypeId1:checked').val() && user_balance != '' && user_balance != '0.00'){
			return window.confirm(__l('By clicking this button you are confirming your purchase. Once you confirmed amount will be deducted from your wallet and you can not undo this process. Are you sure you want to confirm this purchase?'));
		}else if((!user_balance || user_balance == '0.00') && ($('#DealPaymentTypeId1:checked').val() != '' && typeof($('#DealPaymentTypeId1:checked').val())  != 'undefined')){
			return window.confirm(__l('Since you don\'t have sufficent amount in wallet, your purchase process will be proceeded to PayPal. Are you sure you want to confirm this purchase?'));
		}else{
			return true;
		}
    });
    $('#GiftUserFriendName, #GiftUserAmount, #GiftUserMessage, #GiftUserFrom').livequery('keyup', function() {
        var value = ($(this).val() != '') ? $(this).val(): $(this).metadata().default_value;
		value = stripHTML(value);
		if(value != $(this).metadata().default_value){
			$(this).val(value);
		}
        $('#' + $(this).metadata().update).html(value.replace(/\n/g, "<br />"));
    });
    $('form.js-register-form').livequery(function() {
		if(getCookie('geoip_country_code') == ''){
			if("https:" == document.location.protocol){
					$.get(__cfg('path_absolute')+'cities/check_city/type:getcitydetail',function(data){
						if(data!=''){
							response = data.split('|');
							document.cookie = 'geoip_city=' + response[0] + ';path=/';
							document.cookie = 'geoip_region_name=' + response[1] + ';path=/';
							document.cookie = 'geoip_country_code=' + response[2] + ';path=/';
							document.cookie = 'geoip_latitude =' + response[3] + ';path=/';
							document.cookie = 'geoip_longitude=' + response[4] + ';path=/';
							city_val = $('#CityName').val();
							$('#CityName').val(response[0]);
							$('#StateName').val(response[1]);
							$('#country_iso_code').val(response[2]);
						}
					});
		}
		else{
			$.ajax( {
				type: 'GET',
				url: 'http://j.maxmind.com/app/geoip.js',
				dataType: 'script',
				cache: true,
				success: function() {
					document.cookie = 'geoip_city=' + geoip_city() + ';path=/';
					document.cookie = 'geoip_region_name=' + geoip_region_name() + ';path=/';
					document.cookie = 'geoip_country_code=' + geoip_country_code() + ';path=/';
					document.cookie = 'geoip_latitude =' + geoip_latitude() + ';path=/';
					document.cookie = 'geoip_longitude=' + geoip_longitude() + ';path=/';
					city_val = $('#CityName').val();
					$('#CityName').val(geoip_city());
					$('#StateName').val(geoip_region_name());
					$('#country_iso_code').val(geoip_country_code());
				}
			});
		}
		}else{			
			city_val = $('#CityName').val();
			if(city_val ==""){
				$('#CityName').val(getCookie('geoip_city'));
			}
			state_val = $('#StateName').val();			
			if(state_val ==""){
				$('#StateName').val(getCookie('geoip_region_name'));
			}
			$('#country_iso_code').val(getCookie('geoip_country_code'));		
		}
    });
    $('form.js_company_profile').livequery('click', function() {
        $('.js-company_profile_show').toggle();
    });
    $('form select.js-invite-all').livequery('change', function() {
        $('.invite-select').val($(this).val());
    });
    $('div.js-truncate').livequery(function() {
        var $this = $(this);
        $this.truncate(100, {
            chars: /\s/,
            trail: ["<a href='#' class='truncate_show'>" + __l(' more', 'en_us') + "</a> ... ", " ...<a href='#' class='truncate_hide'>" + __l('less', 'en_us') + "</a>"]
        });
    });
	$('form input.js-payment-type').livequery(function() {
		if ($('.js-payment-type:checked').val() == 2) {
            $('.js-hide-for-credit, .js-show-payment-profile').slideUp('fast');
            $('.js-credit-payment').slideDown('fast');
            $('.js-right-block').removeClass('wallet-login-block');
        } else if ($('.js-payment-type:checked').val() == 3) {
            $('.js-hide-for-credit, .js-credit-payment, .js-show-payment-profile').slideUp('fast');
            $('.js-right-block').removeClass('wallet-login-block');
        } else if ($('.js-payment-type:checked').val() == 4) {
            $('.js-hide-for-credit').slideUp('fast');
            $('.js-show-payment-profile').slideDown('fast');
			if ($('#UserIsShowNewCard').val() == 1) {
				$('.js-credit-payment').slideDown('fast');
			} else {
				$('.js-credit-payment').slideUp('fast');
			}
            $('.js-right-block').removeClass('wallet-login-block');
        } else {
            $('.js-credit-payment, .js-show-payment-profile').slideUp('fast');
            $('.js-hide-for-credit').slideDown('fast');
            $('.js-right-block').addClass('wallet-login-block');
        }
        
    });
    $('form input.js-payment-type').livequery('click', function() {
        if ($(this).val() == 2) {
            $('.js-hide-for-credit, .js-show-payment-profile').slideUp('fast');
            $('.js-credit-payment, #currency-changing-info').slideDown('fast');
            $('.js-right-block').removeClass('wallet-login-block');
        } else if ($(this).val() == 3) {
            $('.js-hide-for-credit, .js-credit-payment, .js-show-payment-profile').slideUp('fast');
			$('#currency-changing-info').slideDown('fast');
            $('.js-right-block').removeClass('wallet-login-block');
        } else if ($(this).val() == 4) {
            $('.js-hide-for-credit').slideUp('fast');
            $('.js-show-payment-profile, #currency-changing-info').slideDown('fast');
			if ($('#UserIsShowNewCard').val() == 1) {
				$('.js-credit-payment,').slideDown('fast');
			} else {
				$('.js-credit-payment').slideUp('fast');
			}			
            $('.js-right-block').removeClass('wallet-login-block');
        } else {
            $('.js-credit-payment, .js-show-payment-profile, #currency-changing-info').slideUp('fast');
            $('.js-hide-for-credit').slideDown('fast');
            $('.js-right-block').addClass('wallet-login-block');
        }
    });

//For slide validation error
 $('#homeSubscriptionFrom').livequery(function() {
	currentStep = $(this).metadata().Currentstep;
 });
//End error
      $('div.js-accordion').accordion( {
        header: 'h3',
        autoHeight: false,
        active: false,
        collapsible: true
    });
    $('h3', '.js-accordion').click(function(e) {
        var contentDiv = $(this).next('div');
        if ( ! contentDiv.html().length) {
            $this = $(this);
            $this.block();
            $.get($(this).find('a').attr('href'), function(data) {
                contentDiv.html(data);
                $this.unblock();
            });
        }
    });
	$('#js-gallery').livequery(function() {
		$("#js-gallery").showcase({
			animation: { autoCycle: true},
			css: {  width:"970px", height: "200px"},   
			navigator: { 
							 css: { padding: "0px 220px" },   
							 position:"bottom-left", 
							 item: {
								 css: {width:"7px", height:"7px", backgroundColor: "#DFDFDF"},
								 cssHover: { backgroundColor: "#E2277C"},
								 cssSelected: { backgroundColor: "#E2277C"}
							 }
						},
			titleBar: { enabled: false }
		});	
	});
	$("#js-gallery").css("width", "517px").css("height","309px");
/*	$('.js-jcarousellite').livequery(function() {
		$(".js-jcarousellite").jCarouselLite({
			btnNext: ".next",
			btnPrev: ".prev",
			mouseWheel: true
		});
	});	
	*/
});


function stripHTML(oldString) { 

   var newString = "";
   var inTag = false;
   for(var i = 0; i < oldString.length; i++) {

        if(oldString.charAt(i) == '<') inTag = true;
        if(oldString.charAt(i) == '>') {
            if(oldString.charAt(i+1)=="<")
            {
              		//dont do anything
			}
			else
			{
				inTag = false;
				i++;
			}
        }   
        if(!inTag) newString += oldString.charAt(i);

   }
   return newString;
}
