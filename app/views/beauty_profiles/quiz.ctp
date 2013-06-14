	<script type="text/javascript">
		// Set up Sliders
		// **************
		$(function(){
			  $.fn.showbutton = function($slideNo ) {
					switch($slideNo){
						case 1:
						var noofItemSelect = parseInt($('#js-slide1_1').val()) + parseInt($('#js-slide1_2').val()) + parseInt($('#js-slide1_3').val())+ parseInt($('#js-slide1_4').val())+ parseInt($('#js-slide1_5').val())+ parseInt($('#js-slide1_6').val())+ parseInt($('#js-slide1_7').val())+ parseInt($('#js-slide1_8').val())+ parseInt($('#js-slide1_9').val());
						var kstart = 2;
						break;
						case 2:
						var noofItemSelect = parseInt($('#js-slide2_1').val()) + parseInt($('#js-slide2_2').val()) + parseInt($('#js-slide2_3').val());
						var kstart = 3;
						break;
						case 3:
						var noofItemSelect = parseInt($('#js-slide3_1').val()) + parseInt($('#js-slide3_2').val()) + parseInt($('#js-slide3_3').val())+ parseInt($('#js-slide3_4').val());
						var kstart = 4;
						break;
						case 4:
						var noofItemSelect = parseInt($('#js-slide4_1').val()) + parseInt($('#js-slide4_2').val()) + parseInt($('#js-slide4_3').val())+ parseInt($('#js-slide4_4').val())+parseInt($('#js-slide4_5').val()) + parseInt($('#js-slide4_6').val()) + parseInt($('#js-slide4_7').val());
						var kstart = 5;
						break;
						case 5:
						var noofItemSelect = parseInt($('#js-slide5_1').val()) + parseInt($('#js-slide5_2').val()) + parseInt($('#js-slide5_3').val())+ parseInt($('#js-slide5_4').val())+ parseInt($('#js-slide5_5').val())+ parseInt($('#js-slide5_6').val())+ parseInt($('#js-slide5_7').val());
						var kstart = 6;
						break;
						case 6:
						var noofItemSelect = parseInt($('#js-slide25_1').val()) + parseInt($('#js-slide25_2').val());
						var kstart = 7;
						break;
						case 7:
						var noofItemSelect = parseInt($('#js-slide26_1').val()) + parseInt($('#js-slide26_2').val()) + parseInt($('#js-slide26_3').val()) + parseInt($('#js-slide26_4').val())+ parseInt($('#js-slide26_5').val()) + parseInt($('#js-slide26_6').val()) +parseInt($('#js-slide26_7').val())+ parseInt($('#js-slide26_8').val()) + parseInt($('#js-slide26_9').val())+ parseInt($('#js-slide26_10').val()) + parseInt($('#js-slide26_11').val())+ parseInt($('#js-slide26_12').val()) + parseInt($('#js-slide26_13').val())+ parseInt($('#js-slide26_14').val()) + parseInt($('#js-slide26_15').val())+ parseInt($('#js-slide26_16').val()) + parseInt($('#js-slide26_17').val())+ parseInt($('#js-slide26_18').val()) + parseInt($('#js-slide26_19').val());
						var kstart = 8;
						break;
						case 8:
						var noofItemSelect = parseInt($('#js-slide27_1').val()) + parseInt($('#js-slide27_2').val())+ parseInt($('#js-slide27_3').val())+ parseInt($('#js-slide27_4').val())+ parseInt($('#js-slide27_5').val());
						var kstart = 9;
						break;
						case 9:
						var noofItemSelect = parseInt($('#js-slide28_1').val()) + parseInt($('#js-slide28_2').val());
						var kstart = 10;
						break;
						case 10 :
						var noofItemSelect = parseInt($('#js-slide29_1').val()) + parseInt($('#js-slide29_2').val()) + parseInt($('#js-slide29_3').val())+ parseInt($('#js-slide29_4').val())+ parseInt($('#js-slide29_5').val());	
						var kstart = 11;
						break;
						case 11 :
						var noofItemSelect = parseInt($('#js-slide30_1').val()) + parseInt($('#js-slide30_2').val()) + parseInt($('#js-slide30_3').val());	
						var kstart = 12;
						break;
						case 12:
						var noofItemSelect = parseInt($('#js-slide6_1').val()) + parseInt($('#js-slide6_2').val()) + parseInt($('#js-slide6_3').val())+ parseInt($('#js-slide6_4').val())+ parseInt($('#js-slide6_5').val())+ parseInt($('#js-slide6_6').val())+ parseInt($('#js-slide6_7').val());
						var kstart = 13;
						break; 
						case 13: 
						var noofItemSelect = parseInt($('#js-slide7_1').val()) + parseInt($('#js-slide7_2').val()) + parseInt($('#js-slide7_3').val())+ parseInt($('#js-slide7_4').val())+ parseInt($('#js-slide7_5').val())+ parseInt($('#js-slide7_6').val())+ parseInt($('#js-slide7_7').val())+ parseInt($('#js-slide7_8').val())+ parseInt($('#js-slide7_9').val())+ parseInt($('#js-slide7_10').val())+ parseInt($('#js-slide7_11').val())+ parseInt($('#js-slide7_12').val());
						var kstart = 14;
						break;
						case 14: 
						var noofItemSelect = parseInt($('#js-slide8_1').val()) + parseInt($('#js-slide8_2').val()) + parseInt($('#js-slide8_3').val())+ parseInt($('#js-slide8_4').val())+ parseInt($('#js-slide8_5').val())+ parseInt($('#js-slide8_6').val())+ parseInt($('#js-slide8_7').val())+ parseInt($('#js-slide8_8').val())+ parseInt($('#js-slide8_9').val());
						var kstart = 15;
						break;
						case 15: 
						var noofItemSelect = parseInt($('#js-slide9_1').val()) + parseInt($('#js-slide9_2').val()) + parseInt($('#js-slide9_3').val())+ parseInt($('#js-slide9_4').val());
						var kstart = 16;
						break;
						case 16: 
						var noofItemSelect = parseInt($('#js-slide10_1').val()) + parseInt($('#js-slide10_2').val()) + parseInt($('#js-slide10_3').val())+ parseInt($('#js-slide10_4').val());
						var kstart = 17;
						break;
						case 17: 
						var noofItemSelect = parseInt($('#js-slide11_1').val()) + parseInt($('#js-slide11_2').val()) + parseInt($('#js-slide11_3').val())+ parseInt($('#js-slide11_4').val())+ parseInt($('#js-slide11_5').val());
						var kstart = 18;
						break;
						case 18: 
						var noofItemSelect = parseInt($('#js-slide12_1').val()) + parseInt($('#js-slide12_2').val()) + parseInt($('#js-slide12_3').val())+ parseInt($('#js-slide12_4').val())+ parseInt($('#js-slide12_5').val());
						var kstart = 19;
						break;
						case 19:
						var noofItemSelect = parseInt($('#js-slide13_1').val()) + parseInt($('#js-slide13_2').val()) + parseInt($('#js-slide13_3').val())+ parseInt($('#js-slide13_4').val())+ parseInt($('#js-slide13_5').val());
						var kstart = 20;
						break;
						case 20:
						var noofItemSelect = parseInt($('#js-slide16_1').val()) + parseInt($('#js-slide16_2').val()) + parseInt($('#js-slide16_3').val())+ parseInt($('#js-slide16_4').val())+ parseInt($('#js-slide16_5').val())+parseInt($('#js-slide16_6').val()) + parseInt($('#js-slide16_7').val()) + parseInt($('#js-slide16_8').val())+ parseInt($('#js-slide16_9').val())+ parseInt($('#js-slide16_10').val());
						var kstart = 21;
						break;
						case 21:
						var noofItemSelect = parseInt($('#js-slide17_1').val()) + parseInt($('#js-slide17_2').val()) + parseInt($('#js-slide17_3').val());
						var kstart = 22;
						break;						
						case 22:
						var noofItemSelect = parseInt($('#js-slide14_1').val()) + parseInt($('#js-slide14_2').val()) + parseInt($('#js-slide14_3').val())+ parseInt($('#js-slide14_4').val())+ parseInt($('#js-slide14_5').val());
						var kstart = 23;
						break;
						case 23:
						var noofItemSelect = parseInt($('#js-slide15_1').val()) + parseInt($('#js-slide15_2').val()) + parseInt($('#js-slide15_3').val())+ parseInt($('#js-slide15_4').val())+ parseInt($('#js-slide15_5').val());
						var kstart = 24;
						break;
						case 24:
						var noofItemSelect = parseInt($('#js-slide32_1').val()) + parseInt($('#js-slide32_2').val()) + parseInt($('#js-slide32_3').val())+ parseInt($('#js-slide32_4').val())+ parseInt($('#js-slide32_5').val()) + parseInt($('#js-slide32_6').val()) + parseInt($('#js-slide32_7').val()) + parseInt($('#js-slide32_8').val())+ parseInt($('#js-slide32_9').val());
						var kstart = 25;
						break;
						case 25:
						var noofItemSelect = parseInt($('#js-slide33_1').val()) + parseInt($('#js-slide33_2').val()) + parseInt($('#js-slide33_3').val())+ parseInt($('#js-slide33_4').val())+ parseInt($('#js-slide33_5').val()) + parseInt($('#js-slide33_6').val()) + parseInt($('#js-slide33_7').val()) + parseInt($('#js-slide33_8').val())+ parseInt($('#js-slide33_9').val())+ parseInt($('#js-slide33_10').val()) + parseInt($('#js-slide33_11').val())+ parseInt($('#js-slide33_12').val())+ parseInt($('#js-slide33_13').val());
						var kstart = 26;
						break;
						case 26:
						var noofItemSelect = parseInt($('#js-slide34_1').val()) + parseInt($('#js-slide34_2').val()) + parseInt($('#js-slide34_3').val())+ parseInt($('#js-slide34_4').val())+ parseInt($('#js-slide34_5').val()) + parseInt($('#js-slide34_6').val()) + parseInt($('#js-slide34_7').val()) + parseInt($('#js-slide34_8').val())+ parseInt($('#js-slide34_9').val())+ parseInt($('#js-slide34_10').val()) + parseInt($('#js-slide34_11').val())+ parseInt($('#js-slide34_12').val());
						var kstart = 27;
						break;
						case 27:
						var noofItemSelect = parseInt($('#js-slide35_1').val()) + parseInt($('#js-slide35_2').val()) + parseInt($('#js-slide35_3').val())+ parseInt($('#js-slide35_4').val())+ parseInt($('#js-slide35_5').val()) + parseInt($('#js-slide35_6').val()) + parseInt($('#js-slide35_7').val()) + parseInt($('#js-slide35_8').val())+ parseInt($('#js-slide35_9').val())+ parseInt($('#js-slide35_10').val()) + parseInt($('#js-slide35_11').val())+ parseInt($('#js-slide35_12').val())+ parseInt($('#js-slide35_13').val());
						var kstart = 28;
						break;
						case 28:
						var noofItemSelect = parseInt($('#js-slide36_1').val()) + parseInt($('#js-slide36_2').val()) + parseInt($('#js-slide36_3').val())+ parseInt($('#js-slide36_4').val())+ parseInt($('#js-slide36_5').val()) + parseInt($('#js-slide36_6').val()) + parseInt($('#js-slide36_7').val()) + parseInt($('#js-slide36_8').val())+ parseInt($('#js-slide36_9').val())+ parseInt($('#js-slide36_10').val()) + parseInt($('#js-slide36_11').val())+ parseInt($('#js-slide36_12').val())+ parseInt($('#js-slide36_13').val()) + parseInt($('#js-slide36_14').val())+ parseInt($('#js-slide36_15').val())+ parseInt($('#js-slide36_16').val()) + parseInt($('#js-slide36_17').val())+ parseInt($('#js-slide36_18').val());
						var kstart = 29;
						break;
						case 29:
						var noofItemSelect = parseInt($('#js-slide37_1').val()) + parseInt($('#js-slide37_2').val()) + parseInt($('#js-slide37_3').val())+ parseInt($('#js-slide37_4').val())+ parseInt($('#js-slide37_5').val()) + parseInt($('#js-slide37_6').val()) + parseInt($('#js-slide37_7').val());
						var kstart = 30;
						break;
					}
					if(noofItemSelect == 0){
						for(var k=kstart ; k<=31; k++)
						$('#menu-link'+k).removeClass('js-visited'+k);
					}
					if(noofItemSelect != 0)
					$('#js-goforward').show();
					else
					$('#js-goforward').hide(); 
				};		
				
		 
			$('#slider2').anythingSlider({
				width               : 988,   // if resizeContent is false, this is the default width if panel size is not defined
				height              : 467,   // if resizeContent is false, this is the default height if panel size is not defined
				resizeContents      : true, // If true, solitary images/objects in the panel will expand to fit the viewport
				startStopped        : true,  // If autoPlay is on, this can force it to start stopped
				autoPlay            : false,
				buildArrows         : false,
				buildNavigation     : false,
				enableKeyboard      : false
				
			});
				$('#menu-link0').click(function(){
					$('#slider2').anythingSlider(1);
					$("#js-gobackward").hide();
					$("#js-goforward").show();
				});
				 $('.js-visited1').livequery('click',function() {
					$('#slider2').anythingSlider(2);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(1); 
				});
				$('.js-visited2').livequery('click',function() {
					$('#slider2').anythingSlider(3);
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(2); 
				});
				$('.js-visited3').livequery('click',function() {
					$('#slider2').anythingSlider(4);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(3) 
				});
				$('.js-visited4').livequery('click',function() {
					$('#slider2').anythingSlider(5);
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(4);
				});
				$('.js-visited5').livequery('click',function() {
					$('#slider2').anythingSlider(6);
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(5); 
				});
				$('.js-visited6').livequery('click',function() {
					$('#slider2').anythingSlider(7);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(6); 
				});
				$('.js-visited7').livequery('click',function() {
					$('#slider2').anythingSlider(8);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(7);
				});
				$('.js-visited8').livequery('click',function() {
					$('#slider2').anythingSlider(9);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(8);
				});
				$('.js-visited9').livequery('click',function() {
					$('#slider2').anythingSlider(10);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(9);
				});
				$('.js-visited10').livequery('click',function() {
					$('#slider2').anythingSlider(11);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(10);
				});
				$('.js-visited11').livequery('click',function() {
					$('#slider2').anythingSlider(12);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(11);
				});
				$('.js-visited12').livequery('click',function() {
					$('#slider2').anythingSlider(13);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(12);
				});
				$('.js-visited13').livequery('click',function() {
					$('#slider2').anythingSlider(14);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(13);
				});
				$('.js-visited14').livequery('click',function() {
					$('#slider2').anythingSlider(15);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(14);
				});
				$('.js-visited15').livequery('click',function() {
					$('#slider2').anythingSlider(16);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(15);
				});
				$('.js-visited16').livequery('click',function() {
					$('#slider2').anythingSlider(17);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(16);
				});
				$('.js-visited17').livequery('click',function() {
					$('#slider2').anythingSlider(18);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(17);
				});
				$('.js-visited18').livequery('click',function() {
					$('#slider2').anythingSlider(19);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(18);
				});
				$('.js-visited19').livequery('click',function() {
					$('#slider2').anythingSlider(20);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(19);
				});
				$('.js-visited22').livequery('click',function() {
					$('#slider2').anythingSlider(23);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(22);
				});
				$('.js-visited23').livequery('click',function() {
					$('#slider2').anythingSlider(24);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(23);
				});
				$('.js-visited24').livequery('click',function() {
					$('#slider2').anythingSlider(25);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(24);
				});
				$('.js-visited25').livequery('click',function() {
					$('#slider2').anythingSlider(26);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(25);
				});
				$('.js-visited26').livequery('click',function() {
					$('#slider2').anythingSlider(27);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(26);
				});
				$('.js-visited27').livequery('click',function() {
					$('#slider2').anythingSlider(28);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(27);
				});
				$('.js-visited28').livequery('click',function() {
					$('#slider2').anythingSlider(29);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(28);
				});
				$('.js-visited29').livequery('click',function() {
					$('#slider2').anythingSlider(30);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(29);
				});
				$('.js-visited30').livequery('click',function() {
					$('#slider2').anythingSlider(31);	
					$(".banner-nav .cur").removeClass("cur");
					$(this).addClass('cur');
					$.fn.showbutton(30);
				});
				$('#js-goforward').livequery('click',function() {
					var current = $('#slider2').data('AnythingSlider').currentPage; 
					$(".banner-nav .cur").removeClass("cur");
					$("#menu-link"+current).addClass('cur');
					$('.banner-nav .cur').addClass('js-visited'+current);
					if(current == 7 && $('#js-slide25_2').val() == 1 ){
						current = 9;
						$("#menu-link"+current).addClass('cur');
						$('.banner-nav .cur').addClass('js-visited'+current);
						$('#slider2').anythingSlider(10);
					}
					else if(current == 10 && $('#js-slide28_2').val() == 1 ){
						current = 12;
						$("#menu-link"+current).addClass('cur');
						$('.banner-nav .cur').addClass('js-visited'+current);
						$('#slider2').anythingSlider(13);
					}
					else if(current == 20 && ($('#js-slide13_3').val() == 1 || $('#js-slide13_4').val() == 1 || $('#js-slide13_5').val() == 1) ){
						current = 22;
						$("#menu-link"+current).addClass('cur');
						$('.banner-nav .cur').addClass('js-visited'+current);
						$('#slider2').anythingSlider(23);
					}
					else 
					$('#slider2').data('AnythingSlider').goForward(); 
					var nextCurrent = $('#slider2').data('AnythingSlider').currentPage; 

					if(nextCurrent != 1)
						$("#js-gobackward").show();
					if(nextCurrent != 1)
						$(this).hide();
					if(nextCurrent >= 2 && nextCurrent <= 30){
							$.fn.showbutton((nextCurrent- 1));
					}
					if(nextCurrent == 32){
					$("#js-gobackward").hide();
						$(this).hide();
						$.ajax({
							type: $('.js-autoSubmit').attr('method'),
							url: $('.js-autoSubmit').attr('action'),
							data: $('.js-autoSubmit').serialize(),
							success: function (data) {
								$('.banner-nav .finish').addClass('active');
								$('.banner-nav .start').addClass('end');
								$('.banner-nav .start').removeAttr('id');
								var visit = 1;
								$('.banner-nav li a').each(function(index) {
									var visited = parseInt(visit);
									$("#"+$(this).attr('id')).removeClass('js-visited'+visited );
									if(visit == 6 || visit == 9 || visit == 19)
										visit = visit + 3;
									else
										visit++;
								});
							}
						});
					window.setTimeout(function() {
						    window.location.href = "<?php echo Router::url('/', true); ?>" ;
						}, 3000);  
						
					}  
					$('#js-currentSlideNo').val(nextCurrent);
				});
				$('#js-gobackward').livequery('click',function() {
					var current = $('#slider2').data('AnythingSlider').currentPage; 
					$(".banner-nav .cur").removeClass("cur");
					if(current == 10  && $('#js-slide25_2').val() == 1 ){
						$('#slider2').anythingSlider(7);
					}
					else if(current == 13 && $('#js-slide28_2').val() == 1 ){
						$('#slider2').anythingSlider(10);
					}
					else if(current == 23 && ($('#js-slide13_3').val() == 1 || $('#js-slide13_4').val() == 1 || $('#js-slide13_5').val() == 1) ){
						$('#slider2').anythingSlider(20);
					}
					else if(current != 1 ) 
					$('#slider2').data('AnythingSlider').goBack(); 
					var nextCurrent = $('#slider2').data('AnythingSlider').currentPage; 
					$('#js-currentSlideNo').val(nextCurrent);
					if(nextCurrent  == 1)
					$("#js-gobackward").hide();
					$.fn.showbutton(nextCurrent-1);
					$("#menu-link"+(nextCurrent-1)).addClass('cur');

				});
				// SLIDE 1
			   $("#js-trendy").click(
				function(){
				    var noofSelectItem = parseInt($("#js-noofSelectItem").val());
					if($('#js-slide1_1').val()  == 0 && noofSelectItem < 3){
						$('#js-slide1_1').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
						$('#js-trendySelect').addClass('selected');
					} else {
						$(this).removeClass('active');
						$('#js-trendySelect').removeClass('selected');
						if($('#js-slide1_1').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide1_1').val(0) ;
					}
					$("#js-noofSelectItem").val(noofSelectItem);
					 $.fn.showbutton(1);
				});
				$("#js-professional").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem").val();
					if($('#js-slide1_2').val()  == 0 && noofSelectItem < 3){
						$('#js-slide1_2').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
						$('#js-professionalSelect').addClass('selected');
					} else {
						$(this).removeClass('active');
						$('#js-professionalSelect').removeClass('selected');
						if($('#js-slide1_2').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide1_2').val(0) ;
					}
					$("#js-noofSelectItem").val(noofSelectItem);
					 $.fn.showbutton(1);
				});
			 	$("#js-sporty").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem").val();
					if($('#js-slide1_3').val()  == 0 && noofSelectItem < 3){
						$('#js-slide1_3').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
						$('#js-sportySelect').addClass('selected');
					} else {
						$(this).removeClass('active');
						$('#js-sportySelect').removeClass('selected');
						if($('#js-slide1_3').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide1_3').val(0) ;
					}
					$("#js-noofSelectItem").val(noofSelectItem);
					$.fn.showbutton(1);
				});
			 	$("#js-low-maintenance").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem").val();
					if($('#js-slide1_4').val()  == 0 && noofSelectItem < 3){
						$('#js-slide1_4').val(1) ;
						$(this).addClass('active');
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$('#js-low-maintenanceSelect').addClass('selected');
					} else {
						$(this).removeClass('active');
						$('#js-low-maintenanceSelect').removeClass('selected');
						if($('#js-slide1_4').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide1_4').val(0) ;
					}
					$("#js-noofSelectItem").val(noofSelectItem);
					$.fn.showbutton(1);
				});
			 	$("#js-natural").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem").val();
					if($('#js-slide1_5').val()  == 0 && noofSelectItem < 3){
						$('#js-slide1_5').val(1) ;
						$(this).addClass('active');
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$('#js-naturalSelect').addClass('selected');
					} else {
						$(this).removeClass('active');
						$('#js-naturalSelect').removeClass('selected');
						if($('#js-slide1_5').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide1_5').val(0) ;
					}
					$("#js-noofSelectItem").val(noofSelectItem);
					$.fn.showbutton(1);
				});
			 	$("#js-sophi").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem").val();
					if($('#js-slide1_6').val()  == 0 && noofSelectItem < 3){
						$('#js-slide1_6').val(1) ;
						$(this).addClass('active');
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$('#js-sophiSelect').addClass('selected');
					} else {
						$(this).removeClass('active');
						$('#js-sophiSelect').removeClass('selected');
						if($('#js-slide1_6').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide1_6').val(0) ;
					}
					$("#js-noofSelectItem").val(noofSelectItem);
					$.fn.showbutton(1);
				});
				$("#js-outgoing").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem").val();
					if($('#js-slide1_7').val()  == 0 && noofSelectItem < 3){
						$('#js-slide1_7').val(1) ;
						$(this).addClass('active');
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$('#js-outgoingSelect').addClass('selected');
					} else {
						$(this).removeClass('active');
						$('#js-outgoingSelect').removeClass('selected');
						if($('#js-slide1_7').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide1_7').val(0) ;
					}
					$("#js-noofSelectItem").val(noofSelectItem);
					$.fn.showbutton(1);
				});
				$("#js-cons").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem").val();
					if($('#js-slide1_8').val()  == 0 && noofSelectItem < 3){
						$('#js-slide1_8').val(1) ;
						$(this).addClass('active');
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$('#js-consSelect').addClass('selected');
					} else {
						$(this).removeClass('active');
						$('#js-consSelect').removeClass('selected');
						if($('#js-slide1_8').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide1_8').val(0) ;
					}
					$("#js-noofSelectItem").val(noofSelectItem);
					$.fn.showbutton(1);
				});
				$("#js-formal").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem").val();
					if($('#js-slide1_9').val()  == 0 && noofSelectItem < 3){
						$('#js-slide1_9').val(1) ;
						$(this).addClass('active');
						noofSelectItem = parseInt(noofSelectItem) + 1;
						$('#js-formalSelect').addClass('selected');
					} else {
						$(this).removeClass('active');
						$('#js-formalSelect').removeClass('selected');
						if($('#js-slide1_9').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1;
						$('#js-slide1_9').val(0) ;
					}
					$("#js-noofSelectItem").val(noofSelectItem);
					$.fn.showbutton(1);
				});
				// SLIDE 2
				$("#js-nvconf").click(
					function(){		
						$('#js-sconf,#js-vconf').removeClass('active');
						$('#js-slide2_2,#js-slide2_3').val(0) ;
						if($('#js-slide2_1').val()  == 0){
							$('#js-slide2_1').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide2_1').val(0) ;
						}
						$.fn.showbutton(2);
				});
				$("#js-sconf").click(
					function(){		
						$('#js-nvconf,#js-vconf').removeClass('active');
						$('#js-slide2_1,#js-slide2_3').val(0) ;
						if($('#js-slide2_2').val()  == 0){
							$('#js-slide2_2').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide2_2').val(0) ;
						}
						$.fn.showbutton(2);
				});
				$("#js-vconf").click(
					function(){		
						$('#js-nvconf,#js-sconf').removeClass('active');
						$('#js-slide2_1,#js-slide2_2').val(0) ;
						if($('#js-slide2_3').val()  == 0){
							$('#js-slide2_3').val(1) ;
							$(this).addClass('active');
						} else {
							$(this).removeClass('active');
							$('#js-slide2_3').val(0) ;
						}
						$.fn.showbutton(2);
				});
				// SLIDE 3
				$("#js-daily-make-up1").click(
					function(){		
						$('#js-daily-make-up2,#js-daily-make-up3,#js-daily-make-up4').removeClass('active');
						$('#js-slide3_2,#js-slide3_3,#js-slide3_4').val(0) ;
						if($('#js-slide3_1').val()  == 0){
							$('#js-slide3_1').val(1) ;
							$(this).addClass('active');
						} else {
							$(this).removeClass('active');
							$('#js-slide3_1').val(0) ;
						}
					$.fn.showbutton(3);
				});
				$("#js-daily-make-up2").click(
					function(){		
						$('#js-daily-make-up1,#js-daily-make-up3,#js-daily-make-up4').removeClass('active');
						$('#js-slide3_1,#js-slide3_3,#js-slide3_4').val(0) ;
						if($('#js-slide3_2').val()  == 0){
							$('#js-slide3_2').val(1) ;
							$(this).addClass('active');
						} else {
							$(this).removeClass('active');
							$('#js-slide3_2').val(0) ;
						}
						$.fn.showbutton(3);
				});
				$("#js-daily-make-up3").click(
					function(){		
						$('#js-daily-make-up1,#js-daily-make-up2,#js-daily-make-up4').removeClass('active');
						$('#js-slide3_1,#js-slide3_2,#js-slide3_4').val(0) ;
						if($('#js-slide3_3').val()  == 0){
							$('#js-slide3_3').val(1) ;
							$(this).addClass('active');
						} else {
							$(this).removeClass('active');
							$('#js-slide3_3').val(0) ;
						}
						$.fn.showbutton(3);
				});
				$("#js-daily-make-up4").click(
					function(){		
						$('#js-daily-make-up1,#js-daily-make-up2,#js-daily-make-up3').removeClass('active');
						$('#js-slide3_1,#js-slide3_2,#js-slide3_3').val(0) ;
						if($('#js-slide3_4').val()  == 0){
							$('#js-slide3_4').val(1) ;
							$(this).addClass('active');
						} else {
							$(this).removeClass('active');
							$('#js-slide3_4').val(0) ;
						}
						$.fn.showbutton(3);
				});
			// slide 4
			$("#js-very-fair").click(
			function(){		
				$('#js-very-dark,#js-tan,#js-yellow-undertone,#js-dark,#js-fair,#js-olive').removeClass('active');
				$('#js-slide4_2,#js-slide4_3,#js-slide4_4,#js-slide4_5,#js-slide4_6,#js-slide4_7').val(0) ;
				if($('#js-slide4_1').val()  == 0){
					$('#js-slide4_1').val(1) ;
					$(this).addClass('active');

				} else {
					$(this).removeClass('active');
					$('#js-slide4_1').val(0) ;
				}
				$.fn.showbutton(4);
			});
			$("#js-very-dark").click(
			function(){		
				$('#js-very-fair,#js-tan,#js-yellow-undertone,#js-dark,#js-fair,#js-olive').removeClass('active');
				$('#js-slide4_1,#js-slide4_3,#js-slide4_4,#js-slide4_5,#js-slide4_6,#js-slide4_7').val(0) ;
				if($('#js-slide4_2').val()  == 0){
					$('#js-slide4_2').val(1) ;
					$(this).addClass('active');

				} else {
					$(this).removeClass('active');
					$('#js-slide4_2').val(0) ;
				}			
				$.fn.showbutton(4);
			});
			$("#js-tan").click(
			function(){		
				$('#js-very-fair,#js-very-dark,#js-yellow-undertone,#js-dark,#js-fair,#js-olive').removeClass('active');
				$('#js-slide4_1,#js-slide4_2,#js-slide4_4,#js-slide4_5,#js-slide4_6,#js-slide4_7').val(0) ;
				if($('#js-slide4_3').val()  == 0){
					$('#js-slide4_3').val(1) ;
					$(this).addClass('active');

				} else {
					$(this).removeClass('active');
					$('#js-slide4_3').val(0) ;
				}
				$.fn.showbutton(4);
			});
			$("#js-yellow-undertone").click(
			function(){		
				$('#js-very-fair,#js-very-dark,#js-tan,#js-dark,#js-fair,#js-olive').removeClass('active');
				$('#js-slide4_1,#js-slide4_2,#js-slide4_3,#js-slide4_5,#js-slide4_6,#js-slide4_7').val(0) ;
				if($('#js-slide4_4').val()  == 0){
					$('#js-slide4_4').val(1) ;
					$(this).addClass('active');

				} else {
					$(this).removeClass('active');
					$('#js-slide4_4').val(0) ;
				}
				$.fn.showbutton(4);
			});
			$("#js-dark").click(
			function(){		
				$('#js-very-fair,#js-very-dark,#js-tan,#js-yellow-undertone,#js-fair,#js-olive').removeClass('active');
				$('#js-slide4_1,#js-slide4_2,#js-slide4_3,#js-slide4_4,#js-slide4_6,#js-slide4_7').val(0) ;
				if($('#js-slide4_5').val()  == 0){
					$('#js-slide4_5').val(1) ;
					$(this).addClass('active');

				} else {
					$(this).removeClass('active');
					$('#js-slide4_5').val(0) ;
				}				
				$.fn.showbutton(4);
			});
			$("#js-fair").click(
			function(){		
				$('#js-very-fair,#js-very-dark,#js-tan,#js-yellow-undertone,#js-dark,#js-olive').removeClass('active');
				$('#js-slide4_1,#js-slide4_2,#js-slide4_3,#js-slide4_4,#js-slide4_5,#js-slide4_7').val(0) ;
				if($('#js-slide4_6').val()  == 0){
					$('#js-slide4_6').val(1) ;
					$(this).addClass('active');

				} else {
					$(this).removeClass('active');
					$('#js-slide4_6').val(0) ;
				}
				$.fn.showbutton(4);
			});
			$("#js-olive").click(
			function(){		
				$('#js-very-fair,#js-very-dark,#js-tan,#js-yellow-undertone,#js-dark,#js-fair').removeClass('active');
				$('#js-slide4_1,#js-slide4_2,#js-slide4_3,#js-slide4_4,#js-slide4_5,#js-slide4_6').val(0) ;
				if($('#js-slide4_7').val()  == 0){
					$('#js-slide4_7').val(1) ;
					$(this).addClass('active');

				} else {
					$(this).removeClass('active');
					$('#js-slide4_7').val(0) ;
				}
				$.fn.showbutton(4);
			});
			// SLIDE 5
			$("#js-skin-concerns-none").click(
				function(){
					if($('#js-slide5_1').val()  == 0){
						$('#js-slide5_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide5_1').val(0) ;
					}
				$.fn.showbutton(5);
			});
			$("#js-skin-concerns-pigmentation").click(
				function(){
					if($('#js-slide5_2').val()  == 0){
						$('#js-slide5_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide5_2').val(0) ;
					}
				$.fn.showbutton(5);			
			});
			$("#js-skin-concerns-blemishes").click(
				function(){
					if($('#js-slide5_3').val()  == 0){
						$('#js-slide5_3').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide5_3').val(0) ;
					}
				$.fn.showbutton(5);			
			});
			$("#js-skin-concerns-sensitivity").click(
				function(){
					if($('#js-slide5_4').val()  == 0){
						$('#js-slide5_4').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide5_4').val(0) ;
					}
					$.fn.showbutton(5);
			});
			$("#js-skin-concerns-wrinkles").click(
				function(){
					if($('#js-slide5_5').val()  == 0){
						$('#js-slide5_5').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide5_5').val(0) ;
					}
			   	$.fn.showbutton(5);
			});
			$("#js-skin-concerns-acne").click(
				function(){
					if($('#js-slide5_6').val()  == 0){
						$('#js-slide5_6').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide5_6').val(0) ;
					}
				$.fn.showbutton(5);
			});
			$("#js-skin-concerns-rosacea").click(
				function(){
					if($('#js-slide5_7').val()  == 0){
						$('#js-slide5_7').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide5_7').val(0) ;
					}
				$.fn.showbutton(5);			
			});
			$("#js-do-you-smoke1").click(
				function(){
					$('#js-do-you-smoke2').removeClass('active');
					$('#js-slide25_2').val(0) ;
					if($('#js-slide25_1').val()  == 0){
						$('#js-slide25_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide25_1').val(0) ;
					}
				$.fn.showbutton(6);			
			});
			$("#js-do-you-smoke2").click(
			function(){
				$('#js-do-you-smoke1').removeClass('active');
					$('#js-slide25_1').val(0) ;
					if($('#js-slide25_2').val()  == 0){
						$('#js-slide25_2').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide25_2').val(0) ;
					}
				$.fn.showbutton(6);			
			});

			$("#js-frequent-smoke1").click(
				function(){
					$('#js-frequent-smoke2,#js-frequent-smoke3,#js-frequent-smoke4,#js-frequent-smoke5').removeClass('active');
					$('#js-slide27_2,#js-slide27_3,#js-slide27_4,#js-slide27_5').val(0) ;
					if($('#js-slide27_1').val()  == 0){
						$('#js-slide27_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide27_1').val(0) ;
					}
				$.fn.showbutton(8);			
			});
			$("#js-frequent-smoke2").click(
			function(){
				 $('#js-frequent-smoke1,#js-frequent-smoke3,#js-frequent-smoke4,#js-frequent-smoke5').removeClass('active');
				 $('#js-slide27_1,#js-slide27_3,#js-slide27_4,#js-slide27_5').val(0) ;
					if($('#js-slide27_2').val()  == 0){
						$('#js-slide27_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide27_2').val(0) ;
					}
				$.fn.showbutton(8);			
			});
			$("#js-frequent-smoke3").click(
			function(){
				 $('#js-frequent-smoke1,#js-frequent-smoke2,#js-frequent-smoke4,#js-frequent-smoke5').removeClass('active');
				 $('#js-slide27_1,#js-slide27_2,#js-slide27_4,#js-slide27_5').val(0) ;
					if($('#js-slide27_3').val()  == 0){
						$('#js-slide27_3').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide27_3').val(0) ;
					}
				$.fn.showbutton(8);			
			});
			$("#js-frequent-smoke4").click(
			function(){
				 $('#js-frequent-smoke1,#js-frequent-smoke2,#js-frequent-smoke3,#js-frequent-smoke5').removeClass('active');
				 $('#js-slide27_1,#js-slide27_2,#js-slide27_3,#js-slide27_5').val(0) ;
					if($('#js-slide27_4').val()  == 0){
						$('#js-slide27_4').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide27_4').val(0) ;
					}
				$.fn.showbutton(8);			
			});			
			$("#js-frequent-smoke5").click(
			function(){
				 $('#js-frequent-smoke1,#js-frequent-smoke2,#js-frequent-smoke3,#js-frequent-smoke4').removeClass('active');
				 $('#js-slide27_1,#js-slide27_2,#js-slide27_3,#js-slide27_4').val(0) ;
					if($('#js-slide27_5').val()  == 0){
						$('#js-slide27_5').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide27_5').val(0) ;
					}
				$.fn.showbutton(8);			
			});

			// Slider 7 ( Main Question )
			$("#js-do-you-alcoholic1").click(
				function(){
					$('#js-do-you-alcoholic2').removeClass('active');
					$('#js-slide28_2').val(0) ;
					if($('#js-slide28_1').val()  == 0){
						$('#js-slide28_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide28_1').val(0) ;
					}
				$.fn.showbutton(9);			
			});
			$("#js-do-you-alcoholic2").click(
			function(){
				$('#js-do-you-alcoholic1').removeClass('active');
					$('#js-slide28_1').val(0) ;
					if($('#js-slide28_2').val()  == 0){
						$('#js-slide28_2').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide28_2').val(0) ;
					}
				$.fn.showbutton(9);			
			});
			// Slider 7 a)
			$("#js-do-you-alcoholic-bear").click(
				function(){
					if($('#js-slide29_1').val()  == 0){
						$('#js-slide29_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide29_1').val(0) ;
					}
				$.fn.showbutton(10);
			});
			$("#js-do-you-alcoholic-cocktail").click(
				function(){
					if($('#js-slide29_2').val()  == 0){
						$('#js-slide29_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide29_2').val(0) ;
					}
				$.fn.showbutton(10);			
			});
			
			$("#js-do-you-alcoholic-spirits").click(
				function(){
					if($('#js-slide29_3').val()  == 0){
						$('#js-slide29_3').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide29_3').val(0) ;
					}
				$.fn.showbutton(10);			
			});
			
			$("#js-do-you-alcoholic-beerandspirits").click(
				function(){
					if($('#js-slide29_4').val()  == 0){
						$('#js-slide29_4').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide29_4').val(0) ;
					}
				$.fn.showbutton(10);			
			});
			
			$("#js-do-you-alcoholic-premiumbeer").click(
				function(){
					if($('#js-slide29_5').val()  == 0){
						$('#js-slide29_5').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide29_5').val(0) ;
					}
				$.fn.showbutton(10);			
			});

			/* Slide 7 b */
			$("#js-3drinks-per-occation").click(
			function(){
				 $('#js-13drinks-per-occation,#js-1drinks-per-occation').removeClass('active');
				 $('#js-slide30_2,#js-slide30_3').val(0) ;
					if($('#js-slide30_1').val()  == 0){
						$('#js-slide30_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide30_1').val(0) ;
					}
				$.fn.showbutton(11);			
			});
			$("#js-13drinks-per-occation").click(
			function(){
				 $('#js-3drinks-per-occation,#js-1drinks-per-occation').removeClass('active');
				 $('#js-slide30_1,#js-slide30_3').val(0) ;
					if($('#js-slide30_2').val()  == 0){
						$('#js-slide30_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide30_2').val(0) ;
					}
				$.fn.showbutton(11);			
			});
			$("#js-1drinks-per-occation").click(
			function(){
				 $('#js-3drinks-per-occation,#js-13drinks-per-occation').removeClass('active');
				 $('#js-slide30_1,#js-slide30_2').val(0) ;
					if($('#js-slide30_3').val()  == 0){
						$('#js-slide30_3').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide30_3').val(0) ;
					}
				$.fn.showbutton(11);			
			});
			
			// SLIDE 6
			$("#js-skin-type-combination").click(
				function(){		
					if($('#js-slide6_1').val()  == 0){
						$('#js-slide6_1').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide6_1').val(0) ;
					}
				 $.fn.showbutton(12);			
			});
			$("#js-skin-type-oily").click(
				function(){		
					if($('#js-slide6_2').val()  == 0){
						$('#js-slide6_2').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide6_2').val(0) ;
					}
				$.fn.showbutton(12);			
			});
			$("#js-skin-type-mature").click(
				function(){		
					if($('#js-slide6_3').val()  == 0){
						$('#js-slide6_3').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide6_3').val(0) ;
					}
				$.fn.showbutton(12);			
			});
			$("#js-skin-type-normal").click(
				function(){		
					if($('#js-slide6_4').val()  == 0){
						$('#js-slide6_4').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide6_4').val(0) ;
					}
				$.fn.showbutton(12);			
			});
			$("#js-skin-type-sensitive").click(
				function(){		
					if($('#js-slide6_5').val()  == 0){
						$('#js-slide6_5').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide6_5').val(0) ;
					}
				$.fn.showbutton(12);			
			});
			$("#js-skin-type-dry").click(
				function(){		
					if($('#js-slide6_6').val()  == 0){
						$('#js-slide6_6').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide6_6').val(0) ;
					}
				$.fn.showbutton(12);			
			});

			$("#js-skin-type-other").click(
				function(){		
					if($('#js-slide6_7').val()  == 0){
						$('#js-slide6_7').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide6_7').val(0) ;
					}
				$.fn.showbutton(12);			
			});
			$('#js-skin-text-other-value').keyup(function(event) {
					$("#js-slide6_8").val($(this).val());
					 if($(this).val().length == 0) 
					 $("#js-slide6_7").val(0);
					 else 
					 $("#js-slide6_7").val(1);
			});
			//Slide 7
			$("#js-beauty-product-cleanser").click(
				function(){
				 	var noofSelectItem = parseInt($("#js-noofSelectItem2").val());
					if($('#js-slide7_1').val()  == 0 && noofSelectItem < 3){
						$('#js-slide7_1').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide7_1').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide7_1').val(0) ;
					}
				$("#js-noofSelectItem2").val(noofSelectItem);
				$.fn.showbutton(13);
			});
			$("#js-beauty-product-hair-care").click(
				function(){
   				   var noofSelectItem = parseInt($("#js-noofSelectItem2").val());
					if($('#js-slide7_2').val()  == 0  && noofSelectItem < 3){
						$('#js-slide7_2').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide7_2').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide7_2').val(0) ;
					}
				$("#js-noofSelectItem2").val(noofSelectItem);
				$.fn.showbutton(13);
			});
			$("#js-beauty-product-trendy").click(
			   function(){
				 var noofSelectItem = parseInt($("#js-noofSelectItem2").val());
					if($('#js-slide7_3').val()  == 0 && noofSelectItem < 3){
						$('#js-slide7_3').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide7_3').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide7_3').val(0) ;
					}
				$("#js-noofSelectItem2").val(noofSelectItem);
				$.fn.showbutton(13);
			});
			$("#js-beauty-product-fragrance").click(
			   function(){
				   var noofSelectItem = parseInt($("#js-noofSelectItem2").val());

					if($('#js-slide7_4').val()  == 0  && noofSelectItem < 3){
						$('#js-slide7_4').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide7_4').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide7_4').val(0) ;
					}
				$("#js-noofSelectItem2").val(noofSelectItem);
				$.fn.showbutton(13);
			});

			$("#js-beauty-product-eye-cream").click(
			   function(){
				 var noofSelectItem = parseInt($("#js-noofSelectItem2").val());
					if($('#js-slide7_5').val()  == 0  && noofSelectItem < 3){
						$('#js-slide7_5').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide7_5').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide7_5').val(0) ;
					}
				$("#js-noofSelectItem2").val(noofSelectItem);
				$.fn.showbutton(13);
			});
			$("#js-beauty-product-lip-gloss").click(
			   function(){
				 var noofSelectItem = parseInt($("#js-noofSelectItem2").val());
					if($('#js-slide7_6').val()  == 0 && noofSelectItem < 3){
						$('#js-slide7_6').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide7_6').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide7_6').val(0) ;
					}
				$("#js-noofSelectItem2").val(noofSelectItem);
				$.fn.showbutton(13);
			});
			$("#js-beauty-product-lipstick").click(
			   function(){
				    var noofSelectItem = parseInt($("#js-noofSelectItem2").val());
					if($('#js-slide7_7').val()  == 0 && noofSelectItem < 3){
						$('#js-slide7_7').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide7_7').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide7_7').val(0) ;
					}
				$("#js-noofSelectItem2").val(noofSelectItem);
				$.fn.showbutton(13);
			});
			$("#js-beauty-product-nail").click(
			   function(){
				    var noofSelectItem = parseInt($("#js-noofSelectItem2").val());
					if($('#js-slide7_8').val()  == 0 && noofSelectItem < 3){
						$('#js-slide7_8').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide7_8').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide7_8').val(0) ;
					}
				$("#js-noofSelectItem2").val(noofSelectItem);
				$.fn.showbutton(13);
			});
			$("#js-beauty-product-body-lotion").click(
			   function(){
				 var noofSelectItem = parseInt($("#js-noofSelectItem2").val());
					if($('#js-slide7_9').val()  == 0 && noofSelectItem < 3){
						$('#js-slide7_9').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide7_9').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide7_9').val(0) ;
					}
					$("#js-noofSelectItem2").val(noofSelectItem);
				$.fn.showbutton(13);
			});
			$("#js-beauty-product-concealer").click(
			   function(){
				
				 var noofSelectItem = parseInt($("#js-noofSelectItem2").val());
					if($('#js-slide7_10').val()  == 0 && noofSelectItem < 3){
						$('#js-slide7_10').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide7_10').val()== 1 || noofSelectItem < 3 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide7_10').val(0) ;
					}
					$("#js-noofSelectItem2").val(noofSelectItem);
				$.fn.showbutton(13);
			});
			$("#js-beauty-product-foundation").click(
			   function(){
					 var noofSelectItem = parseInt($("#js-noofSelectItem2").val());
					if($('#js-slide7_11').val()  == 0 && noofSelectItem < 3){
						$('#js-slide7_11').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide7_11').val()== 1 || noofSelectItem < 3 )
							noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide7_11').val(0) ;
					}
					$("#js-noofSelectItem2").val(noofSelectItem);
				$.fn.showbutton(13);
			});
			$("#js-beauty-product-facecream").click(
			   function(){
				var noofSelectItem = parseInt($("#js-noofSelectItem2").val());
					if($('#js-slide7_12').val()  == 0 && noofSelectItem < 3){
						$('#js-slide7_12').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide7_12').val()== 1 || noofSelectItem < 3 )
							noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide7_12').val(0) ;
					}
				$("#js-noofSelectItem2").val(noofSelectItem);
				$.fn.showbutton(13);
			});
			// slide 8
		$("#js-hair-frizzy").click(
		   function(){
		    	var noofSelectItem = parseInt($("#js-noofSelectItem3").val());
				if($('#js-slide8_1').val()  == 0  && noofSelectItem < 3){
					$('#js-slide8_1').val(1) ;
					noofSelectItem = parseInt(noofSelectItem) + 1; 
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
					if($('#js-slide8_1').val()== 1 || noofSelectItem < 3 )
					noofSelectItem = parseInt(noofSelectItem) - 1; 
					$('#js-slide8_1').val(0) ;
				}
				$("#js-noofSelectItem3").val(noofSelectItem);
				$.fn.showbutton(14);
		});
		$("#js-hair-dry").click(
		   function(){
				var noofSelectItem = parseInt($("#js-noofSelectItem3").val());
				if($('#js-slide8_2').val()  == 0 && noofSelectItem < 3){
					$('#js-slide8_2').val(1) ;
					noofSelectItem = parseInt(noofSelectItem) + 1; 
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
					if($('#js-slide8_2').val()== 1 || noofSelectItem < 3 )
					noofSelectItem = parseInt(noofSelectItem) - 1; 
					$('#js-slide8_2').val(0) ;
				}
				$("#js-noofSelectItem3").val(noofSelectItem);
				$.fn.showbutton(14);
		});
		$("#js-hair-damaged").click(
		   function(){
				var noofSelectItem = parseInt($("#js-noofSelectItem3").val());
				if($('#js-slide8_3').val()  == 0 && noofSelectItem < 3){
					$('#js-slide8_3').val(1) ;
					noofSelectItem = parseInt(noofSelectItem) + 1; 
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
					if($('#js-slide8_3').val()== 1 || noofSelectItem < 3 )
					noofSelectItem = parseInt(noofSelectItem) - 1; 
					$('#js-slide8_3').val(0) ;
				}
				$("#js-noofSelectItem3").val(noofSelectItem);
				$.fn.showbutton(14);
		});
		$("#js-hair-chemically-treated").click(
		   function(){
				var noofSelectItem = parseInt($("#js-noofSelectItem3").val());
				if($('#js-slide8_4').val()  == 0 && noofSelectItem < 3){
					$('#js-slide8_4').val(1) ;
					noofSelectItem = parseInt(noofSelectItem) + 1; 
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
					if($('#js-slide8_4').val()== 1 || noofSelectItem < 3 )
					noofSelectItem = parseInt(noofSelectItem) - 1; 
					$('#js-slide8_4').val(0) ;
				}
				$("#js-noofSelectItem3").val(noofSelectItem);
				$.fn.showbutton(14);
		});
		$("#js-hair-oily").click(
		   function(){
			var noofSelectItem = parseInt($("#js-noofSelectItem3").val());
				if($('#js-slide8_5').val()  == 0 && noofSelectItem < 3){
					$('#js-slide8_5').val(1) ;
					noofSelectItem = parseInt(noofSelectItem) + 1; 
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
					if($('#js-slide8_5').val()== 1 || noofSelectItem < 3 )
					noofSelectItem = parseInt(noofSelectItem) - 1; 
					$('#js-slide8_5').val(0) ;
				}
				$("#js-noofSelectItem3").val(noofSelectItem);
				$.fn.showbutton(14);
		});
		$("#js-hair-thick").click(
		   function(){
				var noofSelectItem = parseInt($("#js-noofSelectItem3").val());
				if($('#js-slide8_6').val()  == 0 && noofSelectItem < 3){
					$('#js-slide8_6').val(1) ;
					noofSelectItem = parseInt(noofSelectItem) + 1; 
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
					if($('#js-slide8_6').val()== 1 || noofSelectItem < 3 )
					noofSelectItem = parseInt(noofSelectItem) - 1; 
					$('#js-slide8_6').val(0) ;
				}
				$("#js-noofSelectItem3").val(noofSelectItem);
				$.fn.showbutton(14);
		});
		$("#js-hair-normal").click(
		   function(){
  			 var noofSelectItem = parseInt($("#js-noofSelectItem3").val());
				if($('#js-slide8_7').val()  == 0 && noofSelectItem < 3){
					$('#js-slide8_7').val(1) ;
					noofSelectItem = parseInt(noofSelectItem) + 1; 
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
					if($('#js-slide8_7').val()== 1 || noofSelectItem < 3 )
					noofSelectItem = parseInt(noofSelectItem) - 1; 
					$('#js-slide8_7').val(0) ;
				}
				$("#js-noofSelectItem3").val(noofSelectItem);
				$.fn.showbutton(14);
		});
		$("#js-hair-curly").click(
		   function(){
  			 var noofSelectItem = parseInt($("#js-noofSelectItem3").val());
				if($('#js-slide8_8').val()  == 0  && noofSelectItem < 3){
					$('#js-slide8_8').val(1) ;
					noofSelectItem = parseInt(noofSelectItem) + 1; 
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
					if($('#js-slide8_8').val()== 1 || noofSelectItem < 3 )
					noofSelectItem = parseInt(noofSelectItem) - 1; 
					$('#js-slide8_8').val(0) ;
				}
				$("#js-noofSelectItem3").val(noofSelectItem);
				$.fn.showbutton(14);
		});
		$("#js-hair-fine").click(
		   function(){
			 var noofSelectItem = parseInt($("#js-noofSelectItem3").val());
				if($('#js-slide8_9').val()  == 0 && noofSelectItem < 3){
					$('#js-slide8_9').val(1) ;
					noofSelectItem = parseInt(noofSelectItem) + 1; 
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
					if($('#js-slide8_9').val()== 1 || noofSelectItem < 3 )
					noofSelectItem = parseInt(noofSelectItem) - 1; 
					$('#js-slide8_9').val(0) ;
				}
				$("#js-noofSelectItem3").val(noofSelectItem);
				$.fn.showbutton(14);
		});
		// slide 9
		$("#js-your-hair-colouring").click(
			   function(){
					 var noofSelectItem = parseInt($("#js-noofSelectItem4").val());
					if($('#js-slide9_1').val()  == 0 && noofSelectItem < 3){
						$('#js-slide9_1').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide9_1').val()== 1 || noofSelectItem < 3 )
					     noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide9_1').val(0) ;
					}
				$("#js-noofSelectItem4").val(noofSelectItem);
				$.fn.showbutton(15);
			});
			$("#js-your-hair-perming").click(
			   function(){
				  var noofSelectItem = parseInt($("#js-noofSelectItem4").val());
					if($('#js-slide9_2').val()  == 0 && noofSelectItem < 3){
						$('#js-slide9_2').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide9_2').val()== 1 || noofSelectItem < 3 )
					     noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide9_2').val(0) ;
					}
				$("#js-noofSelectItem4").val(noofSelectItem);
				$.fn.showbutton(15);
			});
			$("#js-your-hair-straightening").click(
			   function(){
				  var noofSelectItem = parseInt($("#js-noofSelectItem4").val());
					if($('#js-slide9_3').val()  == 0 && noofSelectItem < 3){
						$('#js-slide9_3').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide9_3').val()== 1 || noofSelectItem < 3 )
					     noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide9_3').val(0) ;
					}
				$("#js-noofSelectItem4").val(noofSelectItem);
				$.fn.showbutton(15);
			});

			$("#js-your-hair-treatment").click(
			   function(){
   				  var noofSelectItem = parseInt($("#js-noofSelectItem4").val());
					if($('#js-slide9_4').val()  == 0 && noofSelectItem < 3){
						$('#js-slide9_4').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide9_4').val()== 1 || noofSelectItem < 3 )
					     noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide9_4').val(0) ;
					}
				$("#js-noofSelectItem4").val(noofSelectItem);
				$.fn.showbutton(15);
			});
			//slide 10
			$("#js-pedicure-feel-like").click(
				function(){		
					$('#js-pedicure-one-month,#js-pedicure-two-weeks, #js-pedicure-one-week').removeClass('active');
					$('#js-slide10_2,#js-slide10_3,#js-slide10_4').val(0) ;
					if($('#js-slide10_1').val()  == 0){
						$('#js-slide10_1').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide10_1').val(0) ;
					}
					$.fn.showbutton(16);
			});
			$("#js-pedicure-one-month").click(
				function(){		
					$('#js-pedicure-feel-like,#js-pedicure-two-weeks, #js-pedicure-one-week').removeClass('active');
					$('#js-slide10_1,#js-slide10_3,#js-slide10_4').val(0) ;
					if($('#js-slide10_2').val()  == 0){
						$('#js-slide10_2').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide10_2').val(0) ;
					}
					$.fn.showbutton(16);
			});
			$("#js-pedicure-two-weeks").click(
				function(){		
					$('#js-pedicure-feel-like,#js-pedicure-one-month, #js-pedicure-one-week').removeClass('active');
					$('#js-slide10_1,#js-slide10_2,#js-slide10_4').val(0) ;
					if($('#js-slide10_3').val()  == 0){
						$('#js-slide10_3').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide10_3').val(0) ;
					}
					$.fn.showbutton(16);
			});
			$("#js-pedicure-one-week").click(
				function(){		
					$('#js-pedicure-feel-like,#js-pedicure-one-month, #js-pedicure-two-weeks').removeClass('active');
					$('#js-slide10_1,#js-slide10_2,#js-slide10_3').val(0) ;
					if($('#js-slide10_4').val()  == 0){
						$('#js-slide10_4').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide10_4').val(0) ;
					}
					$.fn.showbutton(16);
			});
			//slide 11
			$("#js-pedicure-product-price").click(
			   function(){
					if($('#js-slide11_1').val()  == 0){
						$('#js-slide11_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide11_1').val(0) ;
					}
					$.fn.showbutton(17);
			});
			$("#js-pedicure-product-ease").click(
			   function(){
					if($('#js-slide11_2').val()  == 0){
						$('#js-slide11_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide11_2').val(0) ;
					}
					$.fn.showbutton(17);
			});
			$("#js-pedicure-product-color").click(
			   function(){
					if($('#js-slide11_3').val()  == 0){
						$('#js-slide11_3').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide11_3').val(0) ;
					}
					$.fn.showbutton(17);
			});
			$("#js-pedicure-product-brand").click(
			   function(){
					if($('#js-slide11_4').val()  == 0){
						$('#js-slide11_4').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide11_4').val(0) ;
					}
					$.fn.showbutton(17);
			});
			$("#js-pedicure-product-last").click(
			   function(){
					if($('#js-slide11_5').val()  == 0){
						$('#js-slide11_5').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide11_5').val(0) ;
					}
					$.fn.showbutton(17);
			});
			//slide 12
			$("#js-cosmetic-product1").click(
				function(){		
					$('#js-cosmetic-product2,#js-cosmetic-product3, #js-cosmetic-product4, #js-cosmetic-product5, #js-cosmetic-product6').removeClass('active');
					$('#js-slide12_2,#js-slide12_3,#js-slide12_4,#js-slide12_5,#js-slide12_6').val(0) ;
					if($('#js-slide12_1').val()  == 0){
						$('#js-slide12_1').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide12_1').val(0) ;
					}
					$.fn.showbutton(18);
			});


			$("#js-cosmetic-product2").click(
				function(){		
					$('#js-cosmetic-product1,#js-cosmetic-product3, #js-cosmetic-product4, #js-cosmetic-product5, #js-cosmetic-product6').removeClass('active');
					$('#js-slide12_1,#js-slide12_3,#js-slide12_4,#js-slide12_5,#js-slide12_6').val(0) ;
					if($('#js-slide12_2').val()  == 0){
						$('#js-slide12_2').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide12_2').val(0) ;
					}
				$.fn.showbutton(18);
			});

			$("#js-cosmetic-product3").click(
				function(){		
					$('#js-cosmetic-product1,#js-cosmetic-product2, #js-cosmetic-product4, #js-cosmetic-product5, #js-cosmetic-product6').removeClass('active');
					$('#js-slide12_1,#js-slide12_2,#js-slide12_4,#js-slide12_5,#js-slide12_6').val(0) ;
					if($('#js-slide12_3').val()  == 0){
						$('#js-slide12_3').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide12_3').val(0) ;
					}
				$.fn.showbutton(18);
			});
			$("#js-cosmetic-product4").click(
				function(){		
					$('#js-cosmetic-product1,#js-cosmetic-product2, #js-cosmetic-product3, #js-cosmetic-product5, #js-cosmetic-product6').removeClass('active');
					$('#js-slide12_1,#js-slide12_3,#js-slide12_2,#js-slide12_5,#js-slide12_6').val(0) ;
					if($('#js-slide12_4').val()  == 0){
						$('#js-slide12_4').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide12_4').val(0) ;
					}
				$.fn.showbutton(18);
			});
			$("#js-cosmetic-product5").click(
				function(){		
					$('#js-cosmetic-product1,#js-cosmetic-product2, #js-cosmetic-product3, #js-cosmetic-product4, #js-cosmetic-product6').removeClass('active');
					$('#js-slide12_1,#js-slide12_3,#js-slide12_2,#js-slide12_4,#js-slide12_6').val(0) ;
					if($('#js-slide12_5').val()  == 0){
						$('#js-slide12_5').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide12_5').val(0) ;
					}
				$.fn.showbutton(18);
			});
			$("#js-cosmetic-product6").click(
				function(){		
					$('#js-cosmetic-product1,#js-cosmetic-product2, #js-cosmetic-product3, #js-cosmetic-product4, #js-cosmetic-product5').removeClass('active');
					$('#js-slide12_1,#js-slide12_3,#js-slide12_2,#js-slide12_4,#js-slide12_5').val(0) ;
					if($('#js-slide12_6').val()  == 0){
						$('#js-cosmetic-product7').show();
						$('#js-cosmetic-product6').hide();
						$('#js-slide12_6').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide12_6').val(0) ;
					}
				$.fn.showbutton(18);
			});
			$('#js-cosmetic-product7val').keyup(function(event) {
					$("#js-slide12_7").val($(this).val());
			});
			// Slide 13

			$("#js-employment-status1").click(
				function(){		
					$('#js-employment-status1,#js-employment-status2, #js-employment-status3, #js-employment-status4, #js-employment-status5').removeClass('active');
					$('#js-slide13_2,#js-slide13_3,#js-slide13_4,#js-slide13_5').val(0) ;
					if($('#js-slide13_1').val()  == 0){
						$('#js-slide13_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide13_1').val(0) ;
					}
					$.fn.showbutton(19);
			});
			$("#js-employment-status2").click(
				function(){		
					$('#js-employment-status1,#js-employment-status2, #js-employment-status3, #js-employment-status4, #js-employment-status5').removeClass('active');
					$('#js-slide13_1,#js-slide13_3,#js-slide13_4,#js-slide13_5').val(0) ;
					if($('#js-slide13_2').val()  == 0){
						$('#js-slide13_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide13_2').val(0) ;
					}
					$.fn.showbutton(19);
			});
			$("#js-employment-status3").click(
				function(){		
					$('#js-employment-status1,#js-employment-status2, #js-employment-status3, #js-employment-status4, #js-employment-status5').removeClass('active');
					$('#js-slide13_1,#js-slide13_2,#js-slide13_4,#js-slide13_5').val(0) ;
					if($('#js-slide13_3').val()  == 0){
						$('#js-slide13_3').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide13_3').val(0) ;
					}
					$.fn.showbutton(19);
			});
			$("#js-employment-status4").click(
				function(){		
					$('#js-employment-status1,#js-employment-status2, #js-employment-status3, #js-employment-status4, #js-employment-status5').removeClass('active');
					$('#js-slide13_1,#js-slide13_2,#js-slide13_3,#js-slide13_5').val(0) ;
					if($('#js-slide13_4').val()  == 0){
						$('#js-slide13_4').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide13_4').val(0) ;
					}
					$.fn.showbutton(19);
			});
			$("#js-employment-status5").click(
				function(){		
					$('#js-employment-status1,#js-employment-status2, #js-employment-status3, #js-employment-status4, #js-employment-status5').removeClass('active');
					$('#js-slide13_1,#js-slide13_2,#js-slide13_3,#js-slide13_4').val(0) ;
					if($('#js-slide13_5').val()  == 0){
						$('#js-slide13_5').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide13_5').val(0) ;
					}
					$.fn.showbutton(19);
			});
			// SLIDE 13 a) - Sub Question
			$("#js-industry-work1").click(
				function(){		
					$('#js-industry-work1,#js-industry-work2, #js-industry-work3, #js-industry-work4, #js-industry-work5,#js-industry-work6,#js-industry-work7, #js-industry-work8, #js-industry-work9, #js-industry-work10').removeClass('active');
					$('#js-slide16_2,#js-slide16_3,#js-slide16_4,#js-slide16_5,#js-slide16_6,#js-slide16_7,#js-slide16_8,#js-slide16_9,#js-slide16_10').val(0) ;
					if($('#js-slide16_1').val()  == 0){
						$('#js-slide16_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide16_1').val(0) ;
					}
					$.fn.showbutton(20);
			});			
			$("#js-industry-work2").click(
				function(){		
					$('#js-industry-work1,#js-industry-work2, #js-industry-work3, #js-industry-work4, #js-industry-work5,#js-industry-work6,#js-industry-work7, #js-industry-work8, #js-industry-work9, #js-industry-work10').removeClass('active');
					$('#js-slide16_1,#js-slide16_3,#js-slide16_4,#js-slide16_5,#js-slide16_6,#js-slide16_7,#js-slide16_8,#js-slide16_9,#js-slide16_10').val(0) ;
					if($('#js-slide16_2').val()  == 0){
						$('#js-slide16_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide16_2').val(0) ;
					}
					$.fn.showbutton(20);
			});						
			$("#js-industry-work3").click(
				function(){		
					$('#js-industry-work1,#js-industry-work2, #js-industry-work3, #js-industry-work4, #js-industry-work5,#js-industry-work6,#js-industry-work7, #js-industry-work8, #js-industry-work9, #js-industry-work10').removeClass('active');
					$('#js-slide16_1,#js-slide16_2,#js-slide16_4,#js-slide16_5,#js-slide16_6,#js-slide16_7,#js-slide16_8,#js-slide16_9,#js-slide16_10').val(0) ;
					if($('#js-slide16_3').val()  == 0){
						$('#js-slide16_3').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide16_3').val(0) ;
					}
					$.fn.showbutton(20);
			});
			$("#js-industry-work4").click(
				function(){		
					$('#js-industry-work1,#js-industry-work2, #js-industry-work3, #js-industry-work4, #js-industry-work5,#js-industry-work6,#js-industry-work7, #js-industry-work8, #js-industry-work9, #js-industry-work10').removeClass('active');
					$('#js-slide16_1,#js-slide16_2,#js-slide16_3,#js-slide16_5,#js-slide16_6,#js-slide16_7,#js-slide16_8,#js-slide16_9,#js-slide16_10').val(0) ;
					if($('#js-slide16_4').val()  == 0){
						$('#js-slide16_4').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide16_4').val(0) ;
					}
					$.fn.showbutton(20);
			});			
			$("#js-industry-work5").click(
				function(){		
					$('#js-industry-work1,#js-industry-work2, #js-industry-work3, #js-industry-work4, #js-industry-work5,#js-industry-work6,#js-industry-work7, #js-industry-work8, #js-industry-work9, #js-industry-work10').removeClass('active');
					$('#js-slide16_1,#js-slide16_2,#js-slide16_3,#js-slide16_4,#js-slide16_6,#js-slide16_7,#js-slide16_8,#js-slide16_9,#js-slide16_10').val(0) ;
					if($('#js-slide16_5').val()  == 0){
						$('#js-slide16_5').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide16_5').val(0) ;
					}
					$.fn.showbutton(20);
			});
			$("#js-industry-work6").click(
				function(){		
					$('#js-industry-work1,#js-industry-work2, #js-industry-work3, #js-industry-work4, #js-industry-work5,#js-industry-work6,#js-industry-work7, #js-industry-work8, #js-industry-work9, #js-industry-work10').removeClass('active');
					$('#js-slide16_1,#js-slide16_2,#js-slide16_3,#js-slide16_4,#js-slide16_5,#js-slide16_7,#js-slide16_8,#js-slide16_9,#js-slide16_10').val(0) ;
					if($('#js-slide16_6').val()  == 0){
						$('#js-slide16_6').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide16_6').val(0) ;
					}
					$.fn.showbutton(20);
			});			
			$("#js-industry-work7").click(
				function(){		
					$('#js-industry-work1,#js-industry-work2, #js-industry-work3, #js-industry-work4, #js-industry-work5,#js-industry-work6,#js-industry-work7, #js-industry-work8, #js-industry-work9, #js-industry-work10').removeClass('active');
					$('#js-slide16_1,#js-slide16_2,#js-slide16_3,#js-slide16_5,#js-slide16_6,#js-slide16_4,#js-slide16_8,#js-slide16_9,#js-slide16_10').val(0) ;
					if($('#js-slide16_7').val()  == 0){
						$('#js-slide16_7').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide16_7').val(0) ;
					}
					$.fn.showbutton(20);
			});			
			$("#js-industry-work8").click(
				function(){		
					$('#js-industry-work1,#js-industry-work2, #js-industry-work3, #js-industry-work4, #js-industry-work5,#js-industry-work6,#js-industry-work7, #js-industry-work8, #js-industry-work9, #js-industry-work10').removeClass('active');
					$('#js-slide16_1,#js-slide16_2,#js-slide16_3,#js-slide16_5,#js-slide16_6,#js-slide16_7,#js-slide16_4,#js-slide16_9,#js-slide16_10').val(0) ;
					if($('#js-slide16_8').val()  == 0){
						$('#js-slide16_8').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide16_8').val(0) ;
					}
					$.fn.showbutton(20);
			});	
			$("#js-industry-work9").click(
				function(){		
					$('#js-industry-work1,#js-industry-work2, #js-industry-work3, #js-industry-work4, #js-industry-work5,#js-industry-work6,#js-industry-work7, #js-industry-work8, #js-industry-work9, #js-industry-work10').removeClass('active');
					$('#js-slide16_1,#js-slide16_2,#js-slide16_3,#js-slide16_5,#js-slide16_6,#js-slide16_7,#js-slide16_8,#js-slide16_4,#js-slide16_10').val(0) ;
					if($('#js-slide16_9').val()  == 0){
						$('#js-slide16_9').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide16_9').val(0) ;
					}
					$.fn.showbutton(20);
			});
			$("#js-industry-work10").click(
				function(){		
					$('#js-industry-work1,#js-industry-work2, #js-industry-work3, #js-industry-work4, #js-industry-work5,#js-industry-work6,#js-industry-work7, #js-industry-work8, #js-industry-work9, #js-industry-work10').removeClass('active');
					$('#js-slide16_1,#js-slide16_2,#js-slide16_3,#js-slide16_5,#js-slide16_6,#js-slide16_7,#js-slide16_8,#js-slide16_9,#js-slide16_4').val(0) ;
					if($('#js-slide16_10').val()  == 0){
						$('#js-slide16_10').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide16_10').val(0) ;
					}
					$.fn.showbutton(20);
			});
			// SLIDE 13 b)
			$("#js-years-in-emp1").click(
				function(){		
					$('#js-years-in-emp2, #js-years-in-emp3').removeClass('active');
					$('#js-slide17_2,#js-slide17_3').val(0) ;
					if($('#js-slide17_1').val()  == 0){
						$('#js-slide17_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide17_1').val(0) ;
					}
					$.fn.showbutton(21);
			});
			$("#js-years-in-emp2").click(
				function(){		
					$('#js-years-in-emp1, #js-years-in-emp3').removeClass('active');
					$('#js-slide17_1,#js-slide17_3').val(0) ;
					if($('#js-slide17_2').val()  == 0){
						$('#js-slide17_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide17_2').val(0) ;
					}
					$.fn.showbutton(21);
			});			
			$("#js-years-in-emp3").click(
				function(){		
					$('#js-years-in-emp1, #js-years-in-emp2').removeClass('active');
					$('#js-slide17_1,#js-slide17_2').val(0) ;
					if($('#js-slide17_3').val()  == 0){
						$('#js-slide17_3').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide17_3').val(0) ;
					}
					$.fn.showbutton(21);
			});
			// SLIDE 14
			$("#js-beauty-product1").click(
			   function(){
					if($('#js-slide14_1').val()  == 0){
						$('#js-slide14_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide14_1').val(0) ;
					}
					$.fn.showbutton(22);
			});
			$("#js-beauty-product2").click(
			   function(){
					if($('#js-slide14_2').val()  == 0){
						$('#js-slide14_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide14_2').val(0) ;
					}
				$.fn.showbutton(22);
			});
			$("#js-beauty-product3").click(
			   function(){
					if($('#js-slide14_3').val()  == 0){
						$('#js-slide14_3').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide14_3').val(0) ;
					}
					$.fn.showbutton(22);
			});
			$("#js-beauty-product4").click(
			   function(){
					if($('#js-slide14_4').val()  == 0){
						$('#js-slide14_4').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide14_4').val(0) ;
					}
					$.fn.showbutton(22);
			});
			$("#js-beauty-product5").click(
			   function(){
					$('#js-beauty-product7val,#js-slide14_7').val('');
					if($('#js-slide14_5').val()  == 0){
						$('#js-slide14_5').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide14_5').val(0) ;
					}
					$.fn.showbutton(22);
			});
			$("#js-beauty-product6").click(
			   function(){
					if($('#js-slide14_6').val()  == 0){
						$('#js-beauty-product7').show();
						$('#js-beauty-product6').hide();
						$('#js-slide14_6').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide14_6').val(0) ;
					}
					$.fn.showbutton(22);
			});
			$('#js-beauty-product7val').keyup(function(event) {
					$("#js-slide14_7").val($(this).val());
			});
			
			$("#js-income-level1").click(
				function(){		
					$('#js-income-level2,#js-income-level3, #js-income-level4,#js-income-level5').removeClass('active');
					$('#js-slide15_2,#js-slide15_3,#js-slide15_4,#js-slide15_5').val(0) ;
					if($('#js-slide15_1').val()  == 0){
						$('#js-slide15_1').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide15_1').val(0) ;
					}
					$.fn.showbutton(23);
			});
			$("#js-income-level2").click(
				function(){		
					$('#js-income-level1,#js-income-level3, #js-income-level4, #js-income-level5').removeClass('active');
					$('#js-slide15_1,#js-slide15_3,#js-slide15_4,#js-slide15_5').val(0) ;
					if($('#js-slide15_2').val()  == 0){
						$('#js-slide15_2').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide15_2').val(0) ;
					}
				$.fn.showbutton(23);
			});	
			$("#js-income-level3").click(
				function(){		
					$('#js-income-level1,#js-income-level2, #js-income-level4, #js-income-level5').removeClass('active');
					$('#js-slide15_1,#js-slide15_2,#js-slide15_4,#js-slide15_5').val(0) ;
					if($('#js-slide15_3').val()  == 0){
						$('#js-slide15_3').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide15_3').val(0) ;
					}
				$.fn.showbutton(23);
			});
			$("#js-income-level4").click(
				function(){		
					$('#js-income-level1,#js-income-level2, #js-income-level3, #js-income-level5').removeClass('active');
					$('#js-slide15_1,#js-slide15_3,#js-slide15_2,#js-slide15_5').val(0) ;
					if($('#js-slide15_4').val()  == 0){
						$('#js-slide15_4').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide15_4').val(0) ;
					}
				$.fn.showbutton(23);
			});
			$("#js-income-level5").click(
				function(){		
					$('#js-income-level1,#js-income-level2, #js-income-level3, #js-income-level4').removeClass('active');
					$('#js-slide15_1,#js-slide15_3,#js-slide15_2,#js-slide15_4').val(0) ;
					if($('#js-slide15_5').val()  == 0){
						$('#js-slide15_5').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide15_5').val(0) ;
					}
				$.fn.showbutton(23);
			});
			// SLIDE 24
			$("#js-newspaper").click(
				function(){
				    var noofSelectItem = parseInt($("#js-noofSelectItem5").val());
					if($('#js-slide32_1').val()  == 0 && noofSelectItem < 5){
						$('#js-slide32_1').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide32_1').val()== 1 || noofSelectItem < 5 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide32_1').val(0) ;
					}
					$("#js-noofSelectItem5").val(noofSelectItem);
					 $.fn.showbutton(24);
				});
				$("#js-beauty-magazine").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem5").val();
					if($('#js-slide32_2').val()  == 0 && noofSelectItem < 5){
						$('#js-slide32_2').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide32_2').val()== 1 || noofSelectItem < 5 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide32_2').val(0) ;
					}
					$("#js-noofSelectItem5").val(noofSelectItem);
					 $.fn.showbutton(24);
				});			
				$("#js-social-media").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem5").val();
					if($('#js-slide32_3').val()  == 0 && noofSelectItem < 5){
						$('#js-slide32_3').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide32_3').val()== 1 || noofSelectItem < 5 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide32_3').val(0) ;
					}
					$("#js-noofSelectItem5").val(noofSelectItem);
					 $.fn.showbutton(24);
				});							
				$("#js-online-beauty-blog").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem5").val();
					if($('#js-slide32_4').val()  == 0 && noofSelectItem < 5){
						$('#js-slide32_4').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide32_4').val()== 1 || noofSelectItem < 5 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide32_4').val(0) ;
					}
					$("#js-noofSelectItem5").val(noofSelectItem);
					 $.fn.showbutton(24);
				});											
				$("#js-television").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem5").val();
					if($('#js-slide32_5').val()  == 0 && noofSelectItem < 5){
						$('#js-slide32_5').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide32_5').val()== 1 || noofSelectItem < 5 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide32_5').val(0) ;
					}
					$("#js-noofSelectItem5").val(noofSelectItem);
					 $.fn.showbutton(24);
				});
				$("#js-radio").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem5").val();
					if($('#js-slide32_6').val()  == 0 && noofSelectItem < 5){
						$('#js-slide32_6').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide32_6').val()== 1 || noofSelectItem < 5 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide32_6').val(0) ;
					}
					$("#js-noofSelectItem5").val(noofSelectItem);
					 $.fn.showbutton(24);
				});
				$("#js-billboard").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem5").val();
					if($('#js-slide32_7').val()  == 0 && noofSelectItem < 5){
						$('#js-slide32_7').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide32_7').val()== 1 || noofSelectItem < 5 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide32_7').val(0) ;
					}
					$("#js-noofSelectItem5").val(noofSelectItem);
					 $.fn.showbutton(24);
				});
				$("#js-roadshows").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem5").val();
					if($('#js-slide32_8').val()  == 0 && noofSelectItem < 5){
						$('#js-slide32_8').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide32_8').val()== 1 || noofSelectItem < 5 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide32_8').val(0) ;
					}
					$("#js-noofSelectItem5").val(noofSelectItem);
					 $.fn.showbutton(24);
				});
				$("#js-counter-beauty").click(
				function(){
					var noofSelectItem = $("#js-noofSelectItem5").val();
					if($('#js-slide32_9').val()  == 0 && noofSelectItem < 5){
						$('#js-slide32_9').val(1) ;
						noofSelectItem = parseInt(noofSelectItem) + 1; 
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						if($('#js-slide32_9').val()== 1 || noofSelectItem < 5 )
						noofSelectItem = parseInt(noofSelectItem) - 1; 
						$('#js-slide32_9').val(0) ;
					}
					$("#js-noofSelectItem5").val(noofSelectItem);
					 $.fn.showbutton(24);
				});

				// SLIDE 25
			$("#js-newspaper-read1").click(
			   function(){
					if($('#js-slide33_1').val()  == 0){
						$('#js-slide33_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_1').val(0) ;
					}
					$.fn.showbutton(25);
			});
			$("#js-newspaper-read2").click(
			   function(){
					if($('#js-slide33_2').val()  == 0){
						$('#js-slide33_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_2').val(0) ;
					}
				$.fn.showbutton(25);
			});
			$("#js-newspaper-read3").click(
			   function(){
					if($('#js-slide33_3').val()  == 0){
						$('#js-slide33_3').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_3').val(0) ;
					}
				$.fn.showbutton(25);
			});			
			$("#js-newspaper-read4").click(
			   function(){
					if($('#js-slide33_4').val()  == 0){
						$('#js-slide33_4').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_4').val(0) ;
					}
				$.fn.showbutton(25);
			});			
			$("#js-newspaper-read5").click(
			   function(){
					if($('#js-slide33_5').val()  == 0){
						$('#js-slide33_5').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_5').val(0) ;
					}
				$.fn.showbutton(25);
			});			
			$("#js-newspaper-read6").click(
			   function(){
					if($('#js-slide33_6').val()  == 0){
						$('#js-slide33_6').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_6').val(0) ;
					}
				$.fn.showbutton(25);
			});			
			$("#js-newspaper-read7").click(
			   function(){
					if($('#js-slide33_7').val()  == 0){
						$('#js-slide33_7').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_7').val(0) ;
					}
				$.fn.showbutton(25);
			});			
			$("#js-newspaper-read8").click(
			   function(){
					if($('#js-slide33_8').val()  == 0){
						$('#js-slide33_8').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_8').val(0) ;
					}
				$.fn.showbutton(25);
			});			
			$("#js-newspaper-read9").click(
			   function(){
					if($('#js-slide33_9').val()  == 0){
						$('#js-slide33_9').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_9').val(0) ;
					}
				$.fn.showbutton(25);
			});			
			$("#js-newspaper-read10").click(
			   function(){
					if($('#js-slide33_10').val()  == 0){
						$('#js-slide33_10').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_10').val(0) ;
					}
				$.fn.showbutton(25);
			});			
			$("#js-newspaper-read11").click(
			   function(){
					if($('#js-slide33_11').val()  == 0){
						$('#js-slide33_11').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_11').val(0) ;
					}
				$.fn.showbutton(25);
			});			
			$("#js-newspaper-read12").click(
			   function(){
					if($('#js-slide33_12').val()  == 0){
						$('#js-slide33_12').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_12').val(0) ;
					}
				$.fn.showbutton(25);
			});
			
			$("#js-newspaper-read13").click(
			   function(){
					if($('#js-slide33_13').val()  == 0){
						$('#js-slide33_13').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide33_13').val(0) ;
					}
				$.fn.showbutton(25);
			});
			// SLIDER 26 
			$("#js-radiostation1").click(
			   function(){
					if($('#js-slide34_1').val()  == 0){
						$('#js-slide34_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide34_1').val(0) ;
					}
				$.fn.showbutton(26);
			});
			$("#js-radiostation2").click(
			   function(){
					if($('#js-slide34_2').val()  == 0){
						$('#js-slide34_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide34_2').val(0) ;
					}
				$.fn.showbutton(26);
			});
			$("#js-radiostation3").click(
			   function(){
					if($('#js-slide34_3').val()  == 0){
						$('#js-slide34_3').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide34_3').val(0) ;
					}
				$.fn.showbutton(26);
			});			
			$("#js-radiostation4").click(
			   function(){
					if($('#js-slide34_4').val()  == 0){
						$('#js-slide34_4').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide34_4').val(0) ;
					}
				$.fn.showbutton(26);
			});
			$("#js-radiostation5").click(
			   function(){
					if($('#js-slide34_5').val()  == 0){
						$('#js-slide34_5').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide34_5').val(0) ;
					}
				$.fn.showbutton(26);
			});
			$("#js-radiostation6").click(
			   function(){
					if($('#js-slide34_6').val()  == 0){
						$('#js-slide34_6').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide34_6').val(0) ;
					}
				$.fn.showbutton(26);
			});
			$("#js-radiostation7").click(
			   function(){
					if($('#js-slide34_7').val()  == 0){
						$('#js-slide34_7').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide34_7').val(0) ;
					}
				$.fn.showbutton(26);
			});
			$("#js-radiostation8").click(
			   function(){
					if($('#js-slide34_8').val()  == 0){
						$('#js-slide34_8').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide34_8').val(0) ;
					}
				$.fn.showbutton(26);
			});			
			$("#js-radiostation9").click(
			   function(){
					if($('#js-slide34_9').val()  == 0){
						$('#js-slide34_9').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide34_9').val(0) ;
					}
				$.fn.showbutton(26);
			});
			$("#js-radiostation10").click(
			   function(){
					if($('#js-slide34_10').val()  == 0){
						$('#js-slide34_10').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide34_10').val(0) ;
					}
				$.fn.showbutton(26);
			});
			$("#js-radiostation11").click(
			   function(){
					if($('#js-slide34_11').val()  == 0){
						$('#js-slide34_11').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide34_11').val(0) ;
					}
				$.fn.showbutton(26);
			});
			$("#js-radiostation12").click(
			   function(){
					if($('#js-slide34_12').val()  == 0){
						$('#js-slide34_12').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide34_12').val(0) ;
					}
					$("#js-radio-station-list").hide();
					$("#js-radio-station-text").show();
				$.fn.showbutton(26);
			});
			$('#js-otherradiostext').keyup(function(event) {
					$("#js-slide34_13").val($(this).val());
			});
			// SLIDE 27
			$("#js-tv-station1").click(
			   function(){
					if($('#js-slide35_1').val()  == 0){
						$('#js-slide35_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_1').val(0) ;
					}
				$.fn.showbutton(27);
			});
			$("#js-tv-station2").click(
			   function(){
					if($('#js-slide35_2').val()  == 0){
						$('#js-slide35_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_2').val(0) ;
					}
				$.fn.showbutton(27);
			});
			$("#js-tv-station3").click(
			   function(){
					if($('#js-slide35_3').val()  == 0){
						$('#js-slide35_3').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_3').val(0) ;
					}
				$.fn.showbutton(27);
			});
			$("#js-tv-station4").click(
			   function(){
					if($('#js-slide35_4').val()  == 0){
						$('#js-slide35_4').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_4').val(0) ;
					}
				$.fn.showbutton(27);
			});
			$("#js-tv-station5").click(
			   function(){
					if($('#js-slide35_5').val()  == 0){
						$('#js-slide35_5').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_5').val(0) ;
					}
				$.fn.showbutton(27);
			});
			$("#js-tv-station6").click(
			   function(){
					if($('#js-slide35_6').val()  == 0){
						$('#js-slide35_6').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_6').val(0) ;
					}
				$.fn.showbutton(27);
			});
			$("#js-tv-station7").click(
			   function(){
					if($('#js-slide35_7').val()  == 0){
						$('#js-slide35_7').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_7').val(0) ;
					}
				$.fn.showbutton(27);
			});
			$("#js-tv-station8").click(
			   function(){
					if($('#js-slide35_8').val()  == 0){
						$('#js-slide35_8').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_8').val(0) ;
					}
				$.fn.showbutton(27);
			});
			$("#js-tv-station9").click(
			   function(){
					if($('#js-slide35_9').val()  == 0){
						$('#js-slide35_9').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_9').val(0) ;
					}
				$.fn.showbutton(27);
			});
			$("#js-tv-station10").click(
			   function(){
					if($('#js-slide35_10').val()  == 0){
						$('#js-slide35_10').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_10').val(0) ;
					}
				$.fn.showbutton(27);
			});
			$("#js-tv-station11").click(
			   function(){
					if($('#js-slide35_11').val()  == 0){
						$('#js-slide35_11').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_11').val(0) ;
					}
				$.fn.showbutton(27);
			});
			$("#js-tv-station12").click(
			   function(){
					if($('#js-slide35_12').val()  == 0){
						$('#js-slide35_12').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_12').val(0) ;
					}
				$.fn.showbutton(27);
			});
			$("#js-tv-station13").click(
			   function(){
					if($('#js-slide35_13').val()  == 0){
						$('#js-slide35_13').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide35_13').val(0) ;
					}
				    $("#js-tv-station-list").hide();
					$("#js-tv-station-text").show();
				$.fn.showbutton(27);
			});
			$('#js-othertvstationtext').keyup(function(event) {
					$("#js-slide35_14").val($(this).val());
			});
			// SLIDE 28
			$("#js-beauty-magazine1").click(
			   function(){
					if($('#js-slide36_1').val()  == 0){
						$('#js-slide36_1').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_1').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine2").click(
			   function(){
					if($('#js-slide36_2').val()  == 0){
						$('#js-slide36_2').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_2').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine3").click(
			   function(){
					if($('#js-slide36_3').val()  == 0){
						$('#js-slide36_3').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_3').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine4").click(
			   function(){
					if($('#js-slide36_4').val()  == 0){
						$('#js-slide36_4').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_4').val(0) ;
					}
				$.fn.showbutton(28);
			});
			
			$("#js-beauty-magazine5").click(
			   function(){
					if($('#js-slide36_5').val()  == 0){
						$('#js-slide36_5').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_5').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine6").click(
			   function(){
					if($('#js-slide36_6').val()  == 0){
						$('#js-slide36_6').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_6').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine7").click(
			   function(){
					if($('#js-slide36_7').val()  == 0){
						$('#js-slide36_7').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_7').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine8").click(
			   function(){
					if($('#js-slide36_8').val()  == 0){
						$('#js-slide36_8').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_8').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine9").click(
			   function(){
					if($('#js-slide36_9').val()  == 0){
						$('#js-slide36_9').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_9').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine10").click(
			   function(){
					if($('#js-slide36_10').val()  == 0){
						$('#js-slide36_10').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_10').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine11").click(
			   function(){
					if($('#js-slide36_11').val()  == 0){
						$('#js-slide36_11').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_11').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine12").click(
			   function(){
					if($('#js-slide36_12').val()  == 0){
						$('#js-slide36_12').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_12').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine13").click(
			   function(){
					if($('#js-slide36_13').val()  == 0){
						$('#js-slide36_13').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_13').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine14").click(
			   function(){
					if($('#js-slide36_14').val()  == 0){
						$('#js-slide36_14').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_14').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine15").click(
			   function(){
					if($('#js-slide36_15').val()  == 0){
						$('#js-slide36_15').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_15').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine16").click(
			   function(){
					if($('#js-slide36_16').val()  == 0){
						$('#js-slide36_16').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_16').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine17").click(
			   function(){
					if($('#js-slide36_17').val()  == 0){
						$('#js-slide36_17').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_17').val(0) ;
					}
				$.fn.showbutton(28);
			});
			$("#js-beauty-magazine18").click(
			   function(){
					if($('#js-slide36_18').val()  == 0){
						$('#js-slide36_18').val(1) ;
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
						$('#js-slide36_18').val(0) ;
					}
				$.fn.showbutton(28);
			});
			// SLIDE 29
			$("#js-smartphone1").click(
				function(){		
					if($('#js-slide37_1').val()  == 0){
						$('#js-slide37_1').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide37_1').val(0) ;
					}
				$.fn.showbutton(29);
			});
			$("#js-smartphone2").click(
				function(){		
					if($('#js-slide37_2').val()  == 0){
						$('#js-slide37_2').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide37_2').val(0) ;
					}
				$.fn.showbutton(29);
			});
			$("#js-smartphone3").click(
				function(){		
					if($('#js-slide37_3').val()  == 0){
						$('#js-slide37_3').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide37_3').val(0) ;
					}
				$.fn.showbutton(29);
			});
			$("#js-smartphone4").click(
				function(){		
					if($('#js-slide37_4').val()  == 0){
						$('#js-slide37_4').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide37_4').val(0) ;
					}
				$.fn.showbutton(29);
			});
			$("#js-smartphone5").click(
				function(){		
					if($('#js-slide37_5').val()  == 0){
						$('#js-slide37_5').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide37_5').val(0) ;
					}
				$.fn.showbutton(29);
			});
			$("#js-smartphone6").click(
				function(){		
					if($('#js-slide37_6').val()  == 0){
						$('#js-slide37_6').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide37_6').val(0) ;
					}
				$.fn.showbutton(29);
			});
			$("#js-smartphone7").click(
				function(){		
					if($('#js-slide37_7').val()  == 0){
						$('#js-slide37_7').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide37_7').val(0) ;
					}
				$("#js-smartphone-list").hide();
				$("#js-smartphone-text").show();
				$.fn.showbutton(29);
			});
			$('#js-othersmartphonetext').keyup(function(event) {
					$("#js-slide37_8").val($(this).val());
			});
			// SLIDE 30
			$("#js-mobile-network1").click(
				function(){		
					if($('#js-slide38_1').val()  == 0){
						$('#js-slide38_1').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide38_1').val(0) ;
					}
				$.fn.showbutton(30);
			});
			$("#js-mobile-network2").click(
				function(){		
					if($('#js-slide38_2').val()  == 0){
						$('#js-slide38_2').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide38_2').val(0) ;
					}
				$.fn.showbutton(30);
			});
			$("#js-mobile-network3").click(
				function(){		
					if($('#js-slide38_3').val()  == 0){
						$('#js-slide38_3').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide38_3').val(0) ;
					}
				$.fn.showbutton(30);
			});
			$("#js-mobile-network4").click(
				function(){		
					if($('#js-slide38_4').val()  == 0){
						$('#js-slide38_4').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide38_4').val(0) ;
					}
				$.fn.showbutton(30);
			});
			$("#js-mobile-network5").click(
				function(){		
					if($('#js-slide38_5').val()  == 0){
						$('#js-slide38_5').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide38_5').val(0) ;
					}
				$.fn.showbutton(30);
			});
			$("#js-mobile-network6").click(
				function(){		
					if($('#js-slide38_6').val()  == 0){
						$('#js-slide38_6').val(1) ;
						$(this).addClass('active');

					} else {
						$(this).removeClass('active');
						$('#js-slide38_6').val(0) ;
					}
				$.fn.showbutton(30);
			});
			$(".js-caggs1").click(
				function(){		
				 if( $(this).is(':checked')) {
					$('#js-slide26_1').val(1) ;
				 } else{
					$('#js-slide26_1').val(0) ;
				 }
				$.fn.showbutton(7);
			});
			$(".js-caggs2").click(
				function(){		
				 if( $(this).is(':checked')) {
					$('#js-slide26_2').val(1) ;
				 } else{
					$('#js-slide26_2').val(0) ;
				 }
				$.fn.showbutton(7);
			});
			$(".js-caggs3").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_3').val(1) ;
				} else{
					$('#js-slide26_3').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs4").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_4').val(1) ;
				} else{
					$('#js-slide26_4').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs5").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_5').val(1) ;
				} else{
					$('#js-slide26_5').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs6").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_6').val(1) ;
				} else{
					$('#js-slide26_6').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs7").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_7').val(1) ;
				} else{
					$('#js-slide26_7').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs8").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_8').val(1) ;
				} else{
					$('#js-slide26_8').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs9").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_9').val(1) ;
				} else{
					$('#js-slide26_9').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs10").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_10').val(1) ;
				} else{
					$('#js-slide26_10').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs11").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_11').val(1) ;
				} else{
					$('#js-slide26_11').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs12").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_12').val(1) ;
				} else{
					$('#js-slide26_12').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs13").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_13').val(1) ;
				} else{
					$('#js-slide26_13').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs14").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_14').val(1) ;
				} else{
					$('#js-slide26_14').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs15").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_15').val(1) ;
				} else{
					$('#js-slide26_15').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs16").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_16').val(1) ;
				} else{
					$('#js-slide26_16').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs17").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_17').val(1) ;
				} else{
					$('#js-slide26_17').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs18").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_18').val(1) ;
				} else{
					$('#js-slide26_18').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs19").click(
				function(){		
				if( $(this).is(':checked')) {
					$('#js-slide26_19').val(1) ;
				} else{
					$('#js-slide26_19').val(0) ;
				}
				$.fn.showbutton(7);
			});
			$(".js-caggs20").keyup(function(event) {
					$("#js-slide26_20").val($(this).val());
			});
		});
	</script>
            <!--Getstarted Banner -->
            <div class="banner">
            	<ul id="slider2">

				<li class="panel1"><!-- Slide 0 -->
					<div class="textSlide slide_1">
						<div class="<?php echo (!empty($mybeautyprofile)? 'in-wel-pad':  'welcome-slide');?>">
                           	<?php 
									echo $this->Html->image('getstarted_welcome_text.png');
							?>
                            <p><?php echo __l('Your complete beauty profile helps us to find the best products for you, for your next monthly WonderBox'); ?></p>
                        </div>
                    </div>
				</li>

				<li class="panel2"><!-- Slide 1 -->
               		<div class="get-slide2-left"> <?php 
					if(!empty($mybeautyprofile)):
						echo $this->Html->image('getstarted_describ2.png');
					else:
						echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132)); 
					endif;
					?>
					<p><?php echo __l('Choose up to 3 styles!'); ?></p></div>
                            <div class="get-slide2-right">
                            	<div class="choose-box">
                                	<h1><?php echo __l('Which beauty style describes you?'); ?> </h1>
                                    <ul class="checkbox">
                                    	<li class="trendy" id="js-trendy"><a  title="Trendy" id="js-trendySelect"><?php echo __l('Trendy'); ?></a></li>
                                        <li class="pro" id="js-professional"><a  title="Professional" id="js-professionalSelect"><?php echo __l('Professional'); ?></a></li>
                                        <li class="sporty" id="js-sporty"><a  title="Sporty" id="js-sportySelect"><?php echo __l('Sporty'); ?></a></li>
                                        <li class="low" id="js-low-maintenance"><a  title="Low-Maintenance" id="js-low-maintenanceSelect"><?php echo __l('Low-Maintenance'); ?></a></li>
                                        <li class="natural" id="js-natural"><a title="Natural" id="js-naturalSelect"><?php echo __l('Natural'); ?></a></li>
                                        <li class="sophi" id="js-sophi"><a title="Sophisticated" id="js-sophiSelect"><?php echo __l('Sophisticated'); ?></a></li>
                                        <li class="outgoing" id="js-outgoing"><a title="Outgoing" id="js-outgoingSelect"><?php echo __l('Outgoing'); ?></a></li>
                                        <li class="cons" id="js-cons"><a title="Conservative" id="js-consSelect"><?php echo __l('Conservative'); ?></a></li>
                                        <li class="formal" id="js-formal"><a  title="Formal" id="js-formalSelect"><?php echo __l('Formal'); ?></a></li>                       </ul>
                           </div>
                    </div>
				</li>

				<li class="panel3"><!-- Slide 2 -->
					<div class="get-slide2-left"> <?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					      <p><?php echo __l('Please choose one!'); ?></p></div>
                            <div class="get-slide2-right">
                            	<div class="slide2">
                                	<h1><?php echo __l('How comfortable are you with makeup?'); ?></h1>
                                    <ul>
                                    	<li class="nv_conf" id="js-nvconf"><a title="Not Very Comfortable" id="js-nvconfSelect"><?php echo __l('Not Very Comfortable'); ?></a></li>
                                        <li class="s_conf" id="js-sconf"><a title="Somewhat Comfortable" id="js-sconfSelect"><?php echo __l('Somewhat Comfortable'); ?> </a></li>
                                        <li class="v_conf" id="js-vconf"><a title="Very Comfortable" id="js-vconfSelect"><?php echo __l('Very Comfortable'); ?></a></li>
                                   </ul>
								
                           </div>
                    </div>
				</li>

				<li class="panel4"><!-- Slide 3 -->
					<div class="get-slide2-left">  <?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					          <p><?php echo __l('Please choose one!'); ?></p>
					</div>
                            <div class="get-slide2-right">
                            	<div class="slide3">
                                	<h1><?php echo __l('How much time does it take you to apply you daily make-up?'); ?></h1>
                                    <ul>
                                    	<li><a  title="Less then 15mins" id="js-daily-make-up1" ><?php echo __l('Less then'); ?> <br /><?php echo __l('15mins'); ?></a></li>
                                        <li><a  title="Between 15mins - 30mins"  id="js-daily-make-up2"><?php echo __l('Between'); ?> <br /><?php echo __l('15mins - 30mins'); ?></a></li>
                                        <li><a  title="Between 30mins - 45mins" id="js-daily-make-up3"><?php echo __l('Between'); ?> <br /><?php echo __l('30mins - 45mins'); ?></a></li>
                                        <li><a  title="About 1 hour"  id="js-daily-make-up4"><?php echo __l('About 1 hour'); ?></a></li>
                                    </ul>
                           		</div>
                    </div>
				</li>

				<li class="panel5"><!-- Slide 4 -->
					<div class="get-slide2-left"> <?php  if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
										   <p><?php echo __l('Please choose one!'); ?></p></div>
                            <div class="get-slide2-right">
                            	<div class="slide4">
                                	<h1><?php echo __l('Which of the following best describe you skin tone?'); ?></h1>
                                    <ul>
                                    	<li><a id="js-very-fair" title="Very Fair"><?php echo __l('Very Fair'); ?></a></li>
                                        <li><a id="js-very-dark" title="Very Dark"><?php echo __l('Very Dark'); ?> </a></li>
                                        <li><a id="js-tan" title="Tan"><?php echo __l('Tan'); ?></a></li>
                                        <li><a id="js-yellow-undertone" title="Yellow Undertone"><?php echo __l('Yellow Undertone'); ?></a></li>
								    </ul>
									  <ul class="listrow_2">
										<li><a id="js-dark" title="Dark"><?php echo __l('Dark'); ?></a></li>
                                        <li><a id="js-fair" title="Fair"><?php echo __l('Fair'); ?></a></li>
                                        <li><a id="js-olive" title="Olive"><?php echo __l('Olive'); ?></a></li>
		                            </ul>
                           		</div>
                    </div>
				</li>
                 <li class="panel5"><!-- Slide 5 -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Choose 1 or more!'); ?></p></div>
                            <div class="get-slide2-right">
                            	<div class="slide4">
                                	<h1><?php echo __l('Which of these skin concerns apply to you?'); ?></h1>
                      			    <ul>
                                        <li><a id="js-skin-concerns-none" title="None"><?php echo __l('None');?></a></li>
                                        <li><a id="js-skin-concerns-pigmentation" title="Pigmentation"><?php echo __l('Pigmentation');?></a></li>
                                        <li><a id="js-skin-concerns-blemishes" title="Blemishes"><?php echo __l('Blemishes');?></a></li>
                                        <li><a id="js-skin-concerns-sensitivity" title="Sensitivity"><?php echo __l('Sensitivity');?></a></li>
                                   </ul>
                                    <ul class="listrow_2">
                                          <li><a id="js-skin-concerns-wrinkles" title="Wrinkles / Texture"><?php echo __l('Wrinkles / Texture');?></a></li>
                                        <li><a id="js-skin-concerns-acne" title="Acne"><?php echo __l('Acne');?></a></li>
                                        <li><a id="js-skin-concerns-rosacea" title="Rosacea"><?php echo __l('Rosacea');?></a></li>
                                    </ul>
                           		</div>
                    </div>
				</li>
				<li class="panel5"><!-- new Question Slide 6 -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Please choose one!'); ?></p></div>
                          <div class="get-slide2-right">
                            	<div class="slide4">
                                	<h1><?php echo __l('Do you smoke? (Your lifestyle choices has an impact on your skin condition and by understanding further of you lifestyle, we will be able to recomand the best skincare product for your skin ) '); ?></h1>
                      			    <ul>
                                        <li><a id="js-do-you-smoke1" title="Yes"><?php echo __l('Yes');?></a></li>
                                        <li><a id="js-do-you-smoke2" title="No"><?php echo __l('No');?></a></li>
                                     </ul>
                               </div>
						</div>
				</li>
				<li class="panel5"><!-- new Question Slide 6 a) -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Please choose one!'); ?></p></div>
                          <div class="get-slide2-right">
                            	<div class="comp-survey-td beauty-ser">
                                	<h1><?php echo __l('6a) What type of ciggerates do you smoke?'); ?></h1>
								     <div class="table-data">
                      			    <ul>
                                         <li class="t-head">
											 <div class="t-c1">&nbsp;</div>
                                                <div class="t-c2"><?php echo __l('Regular');?></div>
                                                <div class="t-c3"><?php echo __l('Lights');?></div>
                                                <div class="t-c4"><?php echo __l('Mentol');?></div>
                                                <div class="t-c5"><?php echo __l('Mentol Lights');?></div>
                                                <div class="clear"></div>
                                            </li> 
                                            <li class="t-data">
                                                <div class="t-c1"><?php echo __l('Dunhil');?></div>
                                                <div class="t-c2"><input name="caggs1" type="checkbox" value="1" class="js-caggs1" /></div>
                                                <div class="t-c3"><input name="caggs1" type="checkbox" value="1" class="js-caggs2" /></div>
                                                <div class="t-c4"><input name="caggs1" type="checkbox" value="1" class="js-caggs3" /></div>
                                                <div class="t-c5"><input name="caggs1" type="checkbox" value="1" class="js-caggs4" /></div>
                                                <div class="clear"></div>
                                            </li>
                                            <li class="t-data">
                                                <div class="t-c1"><?php echo __l('Malboro');?></div>
                                                <div class="t-c2"><input name="caggs2" type="checkbox" value="1" class="js-caggs5" /></div>
                                                <div class="t-c3"><input name="caggs2" type="checkbox" value="1" class="js-caggs6" /></div>
                                                <div class="t-c4"><input name="caggs2" type="checkbox" value="1" class="js-caggs7" /></div>
                                                <div class="t-c5"><input name="caggs2" type="checkbox" value="1" class="js-caggs8" /></div>
                                                <div class="clear"></div>
                                            </li>
                                            <li class="t-data">
                                                <div class="t-c1"><?php echo __l('Salem');?></div>
                                                <div class="t-c2">&nbsp;</div>
                                                <div class="t-c3">&nbsp;</div>
                                                <div class="t-c4"><input name="caggs3" type="checkbox" value="1" class="js-caggs9" /></div>
                                                <div class="t-c5"><input name="caggs3" type="checkbox" value="1" class="js-caggs10" /></div>
                                                <div class="clear"></div>
                                            </li>
											 <li class="t-data">
                                                <div class="t-c1"><?php echo __l('PallMall');?></div>
                                                <div class="t-c2"><input name="caggs4" type="checkbox" value="1" class="js-caggs11" /></div>
                                                <div class="t-c3"><input name="caggs4" type="checkbox" value="1" class="js-caggs12" /></div>
                                                <div class="t-c4"><input name="caggs4" type="checkbox" value="1" class="js-caggs13" /></div>
                                                <div class="t-c5"><input name="caggs4" type="checkbox" value="1" class="js-caggs14" /></div>
                                                <div class="clear"></div>
                                            </li>
											 <li class="t-data">
                                                <div class="t-c1"><?php echo __l('Kent');?></div>
                                                <div class="t-c2"><input name="caggs5" type="checkbox" value="1" class="js-caggs15" /></div>
                                                <div class="t-c3">&nbsp;</div>
                                                <div class="t-c4">&nbsp;</div>
                                                <div class="t-c5">&nbsp;</div>
                                                <div class="clear"></div>
                                            </li>
											 <li class="t-data">
                                                <div class="t-c1"><?php echo __l('L&M');?></div>
                                                <div class="t-c2"><input name="caggs6" type="checkbox" value="1" class="js-caggs16" /></div>
                                                <div class="t-c3"><input name="caggs6" type="checkbox" value="1" class="js-caggs17" /></div>
                                                <div class="t-c4"><input name="caggs6" type="checkbox" value="1" class="js-caggs18" /></div>
                                                <div class="t-c5"><input name="caggs6" type="checkbox" value="1" class="js-caggs19" /></div>
                                                <div class="clear"></div>
                                            </li>
											<li class="t-data">
                                                <div class="t-c1"><?php echo __l('Others');?></div>
                                                <div class="t-c2"><input name="caggs7" type="text"  class="js-caggs20" /></div>
                                                <div class="t-c3">&nbsp;</div>
                                                <div class="t-c4">&nbsp;</div>
                                                <div class="t-c5">&nbsp;</div>
                                                <div class="clear"></div>
                                            </li>
                                     </ul>
									 </div>
                               </div>
						</div>
				</li>
				<li class="panel5"><!-- new Question Slide 6 b) -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Please choose one!'); ?></p></div>
                          <div class="get-slide2-right">
                            <div class="slide12">
                                	<h1 class="pr0"><?php echo __l('6b) How frequent do you smoke?'); ?></h1>
                      			    <ul>
                                        <li id="js-frequent-smoke1" ><a title=">20 sticks a day"><?php echo __l('>20 sticks a day');?></a></li>
                                        <li id="js-frequent-smoke2"><a  title="10-20 sticks a day"><?php echo __l('10-20 sticks a day');?></a></li>
                                        <li id="js-frequent-smoke3"><a  title="<10 sticks a day"><?php echo __l('<10 sticks a day');?></a></li>
									    <li id="js-frequent-smoke4"><a  title="Occationally"><?php echo __l('Occationally');?></a></li>
                                        <li id="js-frequent-smoke5"><a  title="When I am out with friends"><?php echo __l('When I am out with friends');?></a></li>
                                     </ul>
                               </div>
						</div>
				 </li>
				 <li class="panel5"><!-- new Question Slide 7 -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Please choose one!'); ?></p></div>
                          <div class="get-slide2-right">
                            	<div class="slide4">
                                	<h1><?php echo __l('Do you consume alcoholic drinks ? (Your lifestyle choices has an impact on your skin condition and by understanding further of you lifestyle, we will be able to recommend the best skincare product for your skin)'); ?></h1>
                      			    <ul>
                                        <li><a id="js-do-you-alcoholic1" title="Yes"><?php echo __l('Yes');?></a></li>
                                        <li><a id="js-do-you-alcoholic2" title="No"><?php echo __l('No');?></a></li>
                                     </ul>
                               </div>
						</div>
				</li>				
				 <li class="panel7a"><!-- new Question Slide 7 a -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Choose 1 or more!'); ?></p></div>
                          <div class="get-slide2-right">
                            	<div class="slide14">
                                	<h1><?php echo __l('7a) What type of alcoholic beverages do you consume?'); ?></h1>
                      			    <ul>
                                        <li class="s17a-img1" id="js-do-you-alcoholic-bear" ><a title="Beer"><?php echo __l('Beer');?></a></li>
                                        <li class="s17a-img2" id="js-do-you-alcoholic-cocktail"><a  title="Cocktail"><?php echo __l('Cocktail');?></a></li>
                                        <li class="s17a-img3" id="js-do-you-alcoholic-spirits"><a  title="Spirits"><?php echo __l('Spirits');?></a></li>
									    <li class="s17a-img4" id="js-do-you-alcoholic-beerandspirits"> <a  title="Beer and Spirits"><?php echo __l('Beer and Spirits');?></a></li>
                                        <li class="s17a-img5" id="js-do-you-alcoholic-premiumbeer"><a  title="Premium Beer"><?php echo __l('Premium Beer');?></a></li>
                                     </ul>
                               </div>
						</div>
				</li>
				 <li class="panel5"><!-- new Question Slide 7 b -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Please choose one!'); ?></p></div>
                          <div class="get-slide2-right">
                            	<div class="slide12">
                                	<h1 class="pr0"><?php echo __l('7b) How much do you drink?'); ?></h1>
                      			    <ul>
                                        <li id="js-3drinks-per-occation"><a title=">3 drinks per occation"><?php echo __l('>3 drinks per occation');?></a></li>
                                        <li id="js-13drinks-per-occation"><a  title="1-3 drinks per occation"><?php echo __l('1-3 drinks per occation');?></a></li>
                                        <li id="js-1drinks-per-occation"><a  title="1 drink per occation"><?php echo __l('1 drink per occation');?></a></li>
                                     </ul>
                               </div>
						</div>
				  </li>
				  <li class="panel5"><!-- Slide 6 -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Choose 1 or more!'); ?></p></div>
                            <div class="get-slide2-right">
                            	<div class="slide4 slide6">
                                	<h1><?php echo __l('What skin type best describes you?'); ?></h1>
                                    <ul>
                                    	<li><a id="js-skin-type-combination" title="Combination(dry with oily T-Zone)"><?php echo __l('Combination'); ?> <br /><?php echo __l('(Dry with oily T-Zone)'); ?></a></li>
                                        <li><a id="js-skin-type-oily" title="Oily"><?php echo __l('Oily'); ?> </a></li>
                                        <li><a id="js-skin-type-mature" title="Mature"><?php echo __l('Mature'); ?> </a></li>
                                     </ul>
                                    <ul>
                                        <li><a id="js-skin-type-normal" title="Normal"><?php echo __l('Normal'); ?> </a></li>
                                        <li><a id="js-skin-type-sensitive" title="Sensitive"><?php echo __l('Sensitive'); ?> </a></li>
                                        <li><a id="js-skin-type-dry" title="Dry"><?php echo __l('Dry'); ?> </a></li>
                                     </ul>
                                    <!-- <ul>
                                        <li  id="js-skin-type-other-value"><input type="text" id="js-skin-text-other-value" class="input_slide6" value="(Specify other skin type here)" /></li>
                                     </ul>  -->
                                 </div>
                    </div>
				</li>
			   <li class="panel5"><!-- Slide 7 -->
					<div class="get-slide2-left"> <?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>  
					<p><?php echo __l('Choose up to 3 products!'); ?></p></div>
                            <div class="get-slide2-right">
                            	<div class="slide7">
                                	<h1><?php echo __l('What beauty products are you interested in?'); ?></h1>
                                    <ul>
                                    	<li class="s7-img1" id="js-beauty-product-cleanser"><a title="Cleanser"><?php echo __l('Cleanser'); ?></a></li>
                                        <li class="s7-img2" id="js-beauty-product-hair-care"><a title="Hair Care"><?php echo __l('Hair Care'); ?></a></li>
                                        <li class="s7-img3" id="js-beauty-product-trendy"><a  title="Trendy makeup color"><?php echo __l('Trendy makeup color'); ?></a></li>
                                        <li class="s7-img4" id="js-beauty-product-fragrance"><a  title="Fragrance"><?php echo __l('Fragrance'); ?></a></li>
                                        <li class="s7-img5" id="js-beauty-product-eye-cream"><a  title="Eye cream"><?php echo __l('Eye cream'); ?></a></li>
                                        <li class="s7-img6"  id="js-beauty-product-lip-gloss"><a title="Lip Gloss"><?php echo __l('Lip Gloss'); ?></a></li>
                                        <li class="s7-img7" id="js-beauty-product-lipstick"><a title="Lipstick"><?php echo __l('Lipstick'); ?></a></li>
                                        <li class="s7-img8" id="js-beauty-product-nail" ><a  title="Nail Colors"><?php echo __l('Nail Colors'); ?></a></li>
                                        <li class="s7-img9" id="js-beauty-product-body-lotion"><a  title="Body Lotion"><?php echo __l('Body Lotion'); ?></a></li>
                                        <li class="s7-img10" id="js-beauty-product-concealer"><a  title="Concealer"><?php echo __l('Concealer'); ?></a></li>
                                        <li class="s7-img11" id="js-beauty-product-foundation"><a title="Foundation"><?php echo __l('Foundation'); ?></a></li>
                                        <li class="s7-img12" id="js-beauty-product-facecream"><a  title="Face cream"><?php echo __l('Face cream'); ?></a></li>
                                    </ul>
                           		</div>
                    </div>
				</li>
		         <li class="panel5"><!-- Slide 8 -->
					<div class="get-slide2-left">  <?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Choose up to 3!'); ?></p></div>
                            <div class="get-slide2-right">
                            	<div class="slide7 slide8">
                                	<h1><?php echo __l('Which of the following best describes your hair?'); ?></h1>
                                    <ul>
                                    	<li class="s8-img1" id="js-hair-frizzy"><a  title="Frizzy"><?php echo __l('Frizzy'); ?></a></li>
                                        <li class="s8-img2" id="js-hair-dry"><a  title="Dry"><?php echo __l('Dry'); ?></a></li>
                                        <li class="s8-img3" id="js-hair-damaged"><a  title="Damaged/ broken"><?php echo __l('Damaged/ broken'); ?></a></li>
                                        <li class="s8-img4" id="js-hair-chemically-treated"><a title="Chemically treated (Color-treated/highlighted/Salon straightened/relaxed)"><?php echo __l('Chemically treated (Color-treated/highlighted/Salon straightened/relaxed)'); ?></a></li>
                                        <li class="s8-img5" id="js-hair-oily"><a title="Oily"><?php echo __l('Oily'); ?></a></li>
                                        <li class="s8-img6" id="js-hair-thick"><a title="Thick"><?php echo __l('Thick'); ?></a></li>
                                        <li class="s8-img7" id="js-hair-normal"><a title="Normal"><?php echo __l('Normal'); ?></a></li>
                                        <li class="s8-img8" id="js-hair-curly"><a title="Curly"><?php echo __l('Curly'); ?></a></li>
                                        <li class="s8-img9" id="js-hair-fine"><a title="Fine"><?php echo __l('Fine'); ?></a></li>
                                    </ul>
                           		</div>
                    </div>
				</li>
		            <li class="panel5"><!-- Slide 9 -->
					<div class="get-slide2-left">
                    	<?php						if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif;?>
                        <p><?php echo __l('Choose up to 3!'); ?></p>
                    </div>
                            <div class="get-slide2-right">
                            	<div class="slide9">
                                	<h1><?php echo __l('What do you usually do with your hair ?'); ?></h1>
                                    <ul>
                                    	<li class="s9-img1" id="js-your-hair-colouring"><a  title="Hair Colouring"><?php echo __l('Hair Colouring'); ?></a></li>
                                        <li class="s9-img2" id="js-your-hair-perming"><a  title="Hai Perming"><?php echo __l('Hai Perming'); ?></a></li>
                                        <li class="s9-img3"  id="js-your-hair-straightening"><a  title="Hair Straightening"><?php echo __l('Hair Straightening'); ?></a></li>
                                        <li class="s9-img4" id="js-your-hair-treatment"><a title="Hair Treatment"><?php echo __l('Hair Treatment'); ?></a></li>
                                    </ul>
                           		</div>
                    </div>
				</li>
                <li class="panel4"><!-- Slide 10 -->
					<div class="get-slide2-left">
                    	<?php							if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif;?>
                        <p><?php echo __l('Please choose one!'); ?></p>
                    </div>
                    <div class="get-slide2-right">
                        <div class="slide3">
                            <h1><?php echo __l('How often do you have a manicure / pedicure?'); ?> </h1>
                            <ul>
                                <li id="js-pedicure-feel-like"><a  title="When i feel like it"><?php echo __l('When I feel'); ?> <br /><?php echo __l('like it'); ?></a></li>
                                <li id="js-pedicure-one-month"><a  title="Once a month"><?php echo __l('Once a month'); ?></a></li>
                                <li id="js-pedicure-two-weeks"><a  title="Once every 2 weeks"><?php echo __l('Once every 2 weeks'); ?></a></li>
                                <li id="js-pedicure-one-week"><a  title="Once a week"><?php echo __l('Once a week'); ?></a></li>
                            </ul>
                        </div>
                    </div>
				</li>
				<li class="panel5"><!-- Slide 11 -->
					<div class="get-slide2-left">
                    				<?php	if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
											else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
											endif; ?>
                        <p><?php echo __l('Choose 1 or more!'); ?></p>
                    </div>
                    <div class="get-slide2-right">
                        <div class="slide4 slide11">
                            <h1><?php echo __l('What do you look for in a Manicure-Pedicure Product ?'); ?></h1>
           				    <ul>
								<li id="js-pedicure-product-price"><a title="Price"><?php echo __l('Price'); ?></a></li>
                                <li id="js-pedicure-product-ease"><a title="Ease of Application"><?php echo __l('Ease of Application'); ?></a></li>
                                <li id="js-pedicure-product-color"><a title="Colour Selection"><?php echo __l('Colour Selection'); ?></a></li>
                            </ul>
                            <ul class="listrow_2">
                                <li id="js-pedicure-product-brand"><a title="Brand Name"><?php echo __l('Brand Name'); ?></a></li>
                                <li id="js-pedicure-product-last"><a title="How long does it last"><?php echo __l('How long does it last'); ?></a></li>
                            </ul>
                          </div>
                    </div>
				</li>
                <li class="panel5"><!-- Slide 12 -->
					<div class="get-slide2-left">
                    					<?php	if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
											else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
											endif; ?>
                        <p><?php echo __l('Please choose one!'); ?></p>
                    </div>
                            <div class="get-slide2-right">
                            	<div class="slide12">
                                	<h1><?php echo __l('How much do you usually spend on beauty and cosmetic products in a month ?');?></h1>
                                    <ul>
                                    	<li id="js-cosmetic-product1"><a  title="Less then RM200"><?php echo __l('Less then RM200');?></a></li>
                                        <li id="js-cosmetic-product2"><a  title="Between RM200 - RM499"><?php echo __l('Between RM200 - RM499');?></a></li>
                                        <li id="js-cosmetic-product3"><a  title="Between RM 500 - RM 1000"><?php echo __l('Between RM 500 - RM 1000');?></a></li>
                                        <li id="js-cosmetic-product4"><a  title="Between RM 1000 - RM 2000"><?php echo __l('Between RM 1000 - RM 2000');?></a></li>
                                        <li id="js-cosmetic-product5"><a  title="More then RM 2000"><?php echo __l('More then RM 2000');?></a></li>
                                       </ul>
                             </div>
                    </div>
				</li>
				<li class="panel5"><!-- Slide 13 -->
					<div class="get-slide2-left">
                    				<?php	if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
											else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
											endif; ?>
                        <p><?php echo __l('Please choose one!'); ?></p>
                    </div>
                            <div class="get-slide2-right js-employement-status">
                            	<div class="slide13">
                                	<h1><?php echo __l('What is your current employment status?'); ?></h1>
								    <ul>
                                    	<li id="js-employment-status1"><a  title="Employed"><?php echo __l('Employed'); ?></a></li>
                                        <li id="js-employment-status2"><a  title="Self-employed"><?php echo __l('Self-employed'); ?></a></li>
                                        <li id="js-employment-status3"><a  title="A homemaker"><?php echo __l('Homemaker'); ?></a></li>
                                    </ul>
                                    <ul class="listrow_2">
                                        <li id="js-employment-status4"> <a  title="A student"><?php echo __l('Student'); ?></a></li>
                                        <li id="js-employment-status5"><a  title="Retired"><?php echo __l('Retired'); ?></a></li>
                                    </ul>  
                             </div>
                    </div>
				</li>
				<li class="panel5"><!-- Slide 13 a)-->
					<div class="get-slide2-left">
                    				<?php	if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
											else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
											endif; ?>
                        <p><?php echo __l('Please choose one!'); ?></p>
                    </div>
                    <div class="get-slide2-right">
                            	<div class="slide13 slide15a">
                                	<h1><?php echo __l('15a) What industry are you working in?'); ?></h1>
								    <ul>
                                    	<li id="js-industry-work1"><a  title="Advertising"><?php echo __l('Advertising'); ?></a></li>
                                        <li id="js-industry-work2"><a  title="Fashion & Accessories"><?php echo __l('Fashion & Accessories'); ?></a></li>
                                        <li id="js-industry-work3"><a  title="Medical & Biotechnology"><?php echo __l('Medical & Biotechnology'); ?></a></li>
                                        <li id="js-industry-work4"><a  title="Consulting"><?php echo __l('Consulting'); ?></a></li>
                                        <li id="js-industry-work5"><a  title="Consumer Products"><?php echo __l('Consumer Products'); ?></a></li>
                                        <li id="js-industry-work6"> <a  title="Beauty & Cosmetics"><?php echo __l('Beauty & Cosmetics'); ?></a></li>
                                        <li id="js-industry-work7"><a  title="Banking & Financial Services"><?php echo __l('Banking & Financial Services'); ?></a></li>
                                        <li id="js-industry-work8"><a  title="Retail & Wholesale"><?php echo __l('Retail & Wholesale'); ?></a></li>
                                        <li id="js-industry-work9"><a  title="IT Services"><?php echo __l('IT Services'); ?></a></li>
                                        <li id="js-industry-work10"><a  title="Engineering"><?php echo __l('Engineering'); ?></a></li>
                                    </ul>  
                             </div>
                    </div>
				</li>
				 <li class="panel5"><!-- Slide 13 b) -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Please choose one!'); ?></p></div>
                          <div class="get-slide2-right">
                            	<div class="slide12">
                                	<h1><?php echo __l('15b) Years in employment? '); ?></h1>
                      			    <ul>
                                        <li id="js-years-in-emp1"><a  title=">5 years"><?php echo __l('>5 years');?></a></li>
                                        <li id="js-years-in-emp2"><a  title="Between 3-5 years"><?php echo __l('Between 3-5 years');?></a></li>
                                        <li id="js-years-in-emp3"><a  title="<3 years"><?php echo __l('<3 years');?></a></li>
                                     </ul>
                               </div>
						</div>
				</li>
			  <li class="panel5"><!-- Slide 14 -->
					<div class="get-slide2-left">
                    					<?php	if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
											else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
											endif; ?>
                        <p><?php echo __l('Choose 1 or more!'); ?></p>
                    </div>
                            <div class="get-slide2-right">
                            	<div class="slide14">
                                	<h1><?php echo __l('Where do you usually shop for beauty products?'); ?> </h1>
                                    <ul>
                                    	<li class="s14-img1" id="js-beauty-product1"><a  title="Departmetal Store"><?php echo __l('Departmetal Store'); ?></a></li>
                                        <li class="s14-img2" id="js-beauty-product2"><a  title="Mass Retailers"><?php echo __l('Mass Retailers'); ?></a></li>
                                        <li class="s14-img3" id="js-beauty-product3"><a  title="Online Store"><?php echo __l('Online Store'); ?></a></li>
                                        <li class="s14-img4" id="js-beauty-product4"><a  title="Specialty Retailers"><?php echo __l('Specialty Retailers'); ?></a></li>
                                        <li class="s14-img4" id="js-beauty-product5"><a  title="Company-owned Store"><?php echo __l('Company-owned Store'); ?></a></li>
									    </ul>
                           		</div>
                    </div>
				</li>
				 <li class="panel5"><!-- Slide 15 -->
					<div class="get-slide2-left">
                    					<?php	if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
											else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
											endif; ?>
                        <p><?php echo __l('Please choose one!'); ?></p>
                    </div>
                            <div class="get-slide2-right">
                            	<div class="slide12">
                                	<h1><?php echo __l('What is your income level?');?></h1>
                                    <ul>
                                    	<li id="js-income-level1"><a  title="Below RM3,000 per month"><?php echo __l('Below RM3,000 per month');?></a></li>
                                        <li id="js-income-level2"><a  title="RM3,000 - RM 5,000 per month"><?php echo __l('RM3,000 - RM 5,000 per month');?></a></li>
                                        <li id="js-income-level3"><a  title="RM5,000 - RM 10,000 per month"><?php echo __l('RM5,000 - RM 10,000 per month');?></a></li>
                                        <li id="js-income-level4"><a  title="RM10,000 - RM 20,000 per month"><?php echo __l('RM10,000 - RM 20,000 per month');?></a></li>
                                        <li id="js-income-level5"><a  title="Above RM20,000 per month"><?php echo __l('Above RM20,000 per month');?></a></li>
                                       </ul>
                             </div>
                    </div>
				</li>
				<li class="panel5"><!-- Slide 24 -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Choose up to 5!'); ?></p></div>
                          <div class="get-slide2-right">
                            	<div class="slide13 slide15a">
                                	<h1><?php echo __l('Please select the top 5 source of beauty information for you ?'); ?></h1>
                      			    <ul>
                                        <li id="js-newspaper"><a  title="Newspaper"><?php echo __l('Newspaper');?></a></li>
                                        <li id="js-beauty-magazine"><a  title="Beauty Magazine"><?php echo __l('Beauty Magazine');?></a></li>
                                        <li  id="js-social-media"><a title="Social Media"><?php echo __l('Social Media');?></a></li>
                                        <li id="js-online-beauty-blog"><a  title="Online Beauty Blogs"><?php echo __l('Online Beauty Blogs');?></a></li>
                                        <li id="js-television"><a  title="Television"><?php echo __l('Television');?></a></li>
                                        <li id="js-radio"><a  title="Radio"><?php echo __l('Radio');?></a></li>
                                        <li id="js-billboard"><a  title="Billboard"><?php echo __l('Billboard');?></a></li>
                                        <li id="js-roadshows"><a  title="Roadshows"><?php echo __l('Roadshows');?></a></li>
                                        <li id="js-counter-beauty"><a  title="Counter Beauty Consultant"><?php echo __l('Counter Beauty Consultant ');?></a></li>
                                     </ul>
                               </div>
						</div>
				</li>
				<li class="panel5"><!-- Slide 25 -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Choose 1 or more!'); ?></p></div>
                          <div class="get-slide2-right">
                            	<div class="slide19">
                                	<h1><?php echo __l('Please select the newspaper that you read ?'); ?></h1>
                      			    <ul>
                                        <li class="s7-img1" id="js-newspaper-read1"><a  title="The Star"><?php echo __l('The Star');?></a></li>
                                        <li class="s7-img2" id="js-newspaper-read2"><a  title="News Straits Times"><?php echo __l('News Straits Times');?></a></li>
                                        <li class="s7-img3" id="js-newspaper-read3"><a  title="Utusan Malaysia"><?php echo __l('Utusan Malaysia');?></a></li>
                                        <li class="s7-img4" id="js-newspaper-read4"><a  title="The Sun"><?php echo __l('The Sun');?></a></li>
                                        <li class="s7-img5" id="js-newspaper-read5"><a  title="Kosmo"><?php echo __l('Kosmo');?></a></li>
									    <li class="s7-img6" id="js-newspaper-read6"><a title="Berita Harian"><?php echo __l('Berita Harian');?></a></li>
                                        <li class="s7-img7" id="js-newspaper-read7"><a  title="Harian Metro"><?php echo __l('Harian Metro');?></a></li>
                                        <li class="s7-img8" id="js-newspaper-read8"><a title="Malay Mail"><?php echo __l('Malay Mail');?></a></li>
                                        <li class="s7-img9" id="js-newspaper-read9"><a  title="The Borneo Post"><?php echo __l('The Borneo Post');?></a></li>
                                        <li class="s7-img10" id="js-newspaper-read10"><a  title="New Sabah Times"><?php echo __l('New Sabah Times');?></a></li>
                                        <li class="s7-img11" id="js-newspaper-read11"><a  title="Nanyang Siang Pau"><?php echo __l('Nanyang Siang Pau');?></a></li>
                                        <li class="s7-img12" id="js-newspaper-read12"><a  title="Sin Chew Jit Poh"><?php echo __l('Sin Chew Jit Poh');?></a></li>
                                        <li class="s7-img13" id="js-newspaper-read13"><a  title="Guang Ming"><?php echo __l('Guang Ming');?></a></li>
                                     </ul>
                               </div>
						</div>
				</li>
				<li class="panel5"><!-- Slide 26 -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Choose 1 or more!'); ?></p></div>
                          <div class="get-slide2-right">
                            	<div class="slide20">
                                	<h1><?php echo __l('Please select the radio station that you listen to daily?'); ?></h1>
                      			    <ul id="js-radio-station-list">
                                        <li class="s7-img1" id="js-radiostation1"><a  title="SINAR fm"><?php echo __l('SINAR fm');?></a></li>
                                        <li class="s7-img2" id="js-radiostation2"><a  title="ERA fm"><?php echo __l('ERA fm');?></a></li>
                                        <li class="s7-img3" id="js-radiostation3"><a  title="MY fm"><?php echo __l('MY fm');?></a></li>
                                        <li class="s7-img4" id="js-radiostation4" ><a title="hitz.fm"><?php echo __l('hitz.fm');?></a></li>
                                        <li class="s7-img5" id="js-radiostation5" ><a title="Mix fm"><?php echo __l('Mix fm');?></a></li>
                                        <li class="s7-img6" id="js-radiostation6"><a title="Lite fm"><?php echo __l('Lite fm');?></a></li>
                                        <li class="s7-img7" id="js-radiostation7"><a title="BFM"><?php echo __l('BFM');?></a></li>
                                        <li class="s7-img8" id="js-radiostation8" ><a title="Red fm"><?php echo __l('Red fm');?></a></li>
                                        <li class="s7-img9" id="js-radiostation9"><a  title="988 fm"><?php echo __l('988 fm');?></a></li>
                                        <li class="s7-img10" id="js-radiostation10"><a  title="Capital fm"><?php echo __l('Capital fm');?></a></li>
                                        <li class="s7-img11" id="js-radiostation11" ><a title="One fm"><?php echo __l('One fm');?></a></li>
                                        <li class="s7-img12" id="js-radiostation12" ><a title="Others"><?php echo __l('Others');?></a></li>
                                     </ul>
									 <div id="js-radio-station-text" class="hide"> <input type="text" name="otherradio" id="js-otherradiostext"/></div>
                               </div>
						</div>
				</li>
				<li class="panel5"><!-- Slide 27 -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Choose 1 or more!'); ?></p></div>
                          <div class="get-slide2-right js-do-you-smoke">
                            	<div class="slide21">
                                	<h1><?php echo __l('Please select your favorite TV station?'); ?></h1>
                      			    <ul id="js-tv-station-list">
                                        <li class="s7-img1" id="js-tv-station1"><a  title="TV1"><?php echo __l('TV1');?></a></li>
                                        <li class="s7-img2" id="js-tv-station2"><a title="TV2"><?php echo __l('TV2');?></a></li>
                                        <li class="s7-img3" id="js-tv-station3"><a title="TV3"><?php echo __l('TV3');?></a></li>
                                        <li class="s7-img4" id="js-tv-station4"><a title="NTV 7"><?php echo __l('NTV 7');?></a></li>
                                        <li class="s7-img5" id="js-tv-station5"><a title="TV9"><?php echo __l('TV9');?></a></li>
                                        <li class="s7-img6" id="js-tv-station6"><a title="Astro Awani"><?php echo __l('Astro Awani');?></a></li>
                                        <li class="s7-img7" id="js-tv-station7" ><a title="Astro Prima"><?php echo __l('Astro Prima');?></a></li>
                                        <li class="s7-img8" id="js-tv-station8"><a title="Astro AEC"><?php echo __l('Astro AEC');?></a></li>
                                        <li class="s7-img9" id="js-tv-station9"><a title="Astro RIA"><?php echo __l('Astro RIA');?></a></li>
                                        <li class="s7-img10"  id="js-tv-station10"><a title="Astro Wa Lai Toi"><?php echo __l('Astro Wa Lai Toi');?></a></li>
                                        <li class="s7-img11" id="js-tv-station11"><a title="Star World"><?php echo __l('Star World');?></a></li>
                                        <li class="s7-img12"  id="js-tv-station12"><a title="FOX"><?php echo __l('FOX');?></a></li>
                                        <li class="s7-img13" id="js-tv-station13"><a title="Others"><?php echo __l('Others');?></a></li>
                                     </ul>
									 <div id="js-tv-station-text" class="hide"> <input type="text" name="othertvstation" id="js-othertvstationtext"/></div>
                               </div>
						</div>
				</li>
				<li class="panel5"><!-- Slide 28 -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('Choose 1 or more!'); ?></p></div>
                          <div class="get-slide2-right">
                            	<div class="slide22">
                                	<h1><?php echo __l('Please select your favorite beauty magazine?'); ?></h1>
                      			    <ul>
                                        <li class="s7-img1" id="js-beauty-magazine1"><a  title="Female Malaysia"><?php echo __l('Female Malaysia');?></a></li>
                                        <li class="s7-img2" id="js-beauty-magazine2"><a  title="CLEO"><?php echo __l('CLEO');?></a></li>
                                        <li class="s7-img3" id="js-beauty-magazine3"><a title="Her World"><?php echo __l('Her World');?></a></li>
                                        <li class="s7-img4" id="js-beauty-magazine4"><a  title="Marie Claire"><?php echo __l('Marie Claire');?></a></li>
                                        <li class="s7-img5" id="js-beauty-magazine5"><a  title="APPLE"><?php echo __l('APPLE');?></a></li>
                                        <li class="s7-img6" id="js-beauty-magazine6"><a  title="CITTA BELLA"><?php echo __l('CITTA BELLA');?></a></li>
                                        <li class="s7-img7" id="js-beauty-magazine7"><a title="CLIVE"><?php echo __l('CLIVE');?></a></li>
                                        <li class="s7-img8" id="js-beauty-magazine8"><a  title="Cosmopolitan"><?php echo __l('Cosmopolitan');?></a></li>
                                        <li class="s7-img9" id="js-beauty-magazine9"><a title="Dara"><?php echo __l('Dara');?></a></li>
                                        <li class="s7-img10" id="js-beauty-magazine10"><a title="EH!"><?php echo __l('EH!');?></a></li>
                                        <li class="s7-img11" id="js-beauty-magazine11"><a  title="Feminine"><?php echo __l('Feminine');?></a></li>
                                        <li class="s7-img12" id="js-beauty-magazine12"><a title="Galaxie"><?php echo __l('Galaxie');?></a></li>
                                        <li class="s7-img13" id="js-beauty-magazine13"><a title="GLAM"><?php echo __l('GLAM');?></a></li>
                                        <li class="s7-img14" id="js-beauty-magazine14"><a title="Harper's BAZAAR"><?php echo __l('Harper\'s BAZAAR');?></a></li>
                                        <li class="s7-img15" id="js-beauty-magazine15"><a title="Jelita"><?php echo __l('Jelita');?></a></li>
                                        <li class="s7-img16" id="js-beauty-magazine16"><a title="Jessica Malaysia"><?php echo __l('Jessica Malaysia');?></a></li>
                                        <li class="s7-img17" id="js-beauty-magazine17"><a title="NuYou"><?php echo __l('NuYou');?></a></li>
                                        <li class="s7-img18" id="js-beauty-magazine18"><a title="Nona"><?php echo __l('Nona');?></a></li>
                                     </ul>
                               </div>
						</div>
				</li>
				<li class="panel5"><!-- Slide 29 -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('More than 1 choice!'); ?></p></div>
                          <div class="get-slide2-right">
                            	<div class="slide23">
                                	<h1><?php echo __l('What model of smartphone are you using?'); ?></h1>
                      			    <ul id="js-smartphone-list">
                                        <li  class="s7-img1" id="js-smartphone1"><a  title="Apple Iphone"><?php echo __l('Apple Iphone');?></a></li>
                                        <li  class="s7-img2" id="js-smartphone2"><a  title="Samsung"><?php echo __l('Samsung');?></a></li>
                                        <li  class="s7-img3" id="js-smartphone3"><a  title="HTC"><?php echo __l('HTC');?></a></li>
                                        <li  class="s7-img4" id="js-smartphone4"><a  title="Nokia"><?php echo __l('Nokia');?></a></li>
                                        <li  class="s7-img5" id="js-smartphone5"><a  title="Blackberry"><?php echo __l('Blackberry');?></a></li>
                                        <li  class="s7-img6" id="js-smartphone6"><a  title="LG"><?php echo __l('LG');?></a></li>
                                        <li  class="s7-img8" id="js-smartphone7"><a  title="Others"><?php echo __l('Others');?></a></li>
                                     </ul>
 									 <div id="js-smartphone-text" class="hide"> <input type="text" name="othersmartphonestation" id="js-othersmartphonetext"/></div>
                               </div>
						</div>
				</li>				
				<li class="panel5"><!-- Slide 30 -->
					<div class="get-slide2-left"><?php if(!empty($mybeautyprofile)):
															echo $this->Html->image('getstarted_describ2.png');
														else:
															echo $this->Html->image('getstarted_describ.png',array('width'=> 366,'height'=>132));
														endif; ?>
					   <p><?php echo __l('More than 1 choice!'); ?></p></div>
                          <div class="get-slide2-right">
                            	<div class="slide24">
                                	<h1><?php echo __l('Which mobile network are you using ?'); ?></h1>
                      			    <ul>
                                        <li class="s7-img1" id="js-mobile-network1"><a title="Maxis"><?php echo __l('Maxis');?></a></li>
                                        <li class="s7-img2" id="js-mobile-network2"><a title="Digi"><?php echo __l('Digi');?></a></li>
                                        <li class="s7-img3" id="js-mobile-network3"><a title="Digi"><?php echo __l('Celcom');?></a></li>
                                        <li class="s7-img4" id="js-mobile-network4"><a title="Tunes Mobile"><?php echo __l('Tunes Mobile');?></a></li>
                                        <li class="s7-img5" id="js-mobile-network5"><a  title="U Mobile"><?php echo __l('U Mobile');?></a></li>
                                        <li class="s7-img6" id="js-mobile-network6"><a  title="YES Mobile"><?php echo __l('YES Mobile');?></a></li>
                                     </ul>
                               </div>
						</div>
				</li>
				<li class="panel5"><!-- Slide 16 -->
					<div class="banner-thank">
                    	<h1><?php echo __l('Thank you for completing your WonderBox beauty profile.'); ?></h1>
                        <p><?php echo __l('This information will go a long way towards making your experience with WonderBox an even better one!'); ?></p>
                    </div>
				</li>
			</ul>
            <span class="left-arrow hide" id="js-gobackward"></span>
            <span class="right-arrow" id="js-goforward"></span>
            <div class="clear"></div>
            <div class="banner-nav">
            	<span class="start" id="menu-link0">Start</span>
              <ul>
                	<li><a id="menu-link1" >1</a></li>
                    <li><a id="menu-link2" >2</a></li>
                    <li><a id="menu-link3" >3</a></li>
                    <li><a id="menu-link4" >4</a></li>
                    <li><a id="menu-link5" >5</a></li>
                    <li><a id="menu-link6" >6</a></li>
                  <!--  <li><a id="menu-link7" >7</a></li> 
				    <li><a id="menu-link8" >8</a></li>-->
                    <li><a id="menu-link9" >7</a></li>
				   <!--  <li><a id="menu-link10" >10</a></li>
                    <li><a id="menu-link11" >11</a></li>-->
                    <li><a id="menu-link12" >8</a></li>
                    <li><a id="menu-link13" >9</a></li>
                    <li><a id="menu-link14" >10</a></li>
					<li><a id="menu-link15" >11</a></li>
					<li><a id="menu-link16" >12</a></li>
					<li><a id="menu-link17" >13</a></li>
					<li><a id="menu-link18" >14</a></li>
					<li><a id="menu-link19" >15</a></li>
					<!--<li><a id="menu-link20" >20</a></li>
					<li><a id="menu-link21" >21</a></li> -->
					<li><a id="menu-link22" >16</a></li>
					<li><a id="menu-link23" >17</a></li>
					<li><a id="menu-link24" >18</a></li>
					<li><a id="menu-link25" >19</a></li>
					<li><a id="menu-link26" >20</a></li>
					<li><a id="menu-link27" >21</a></li>
					<li><a id="menu-link28" >22</a></li>
					<li><a id="menu-link29" >23</a></li>
					<li><a id="menu-link30" >24</a></li>
                </ul> 
                <span class="finish">Finish!</span>
            </div>
            </div>

<?php echo $this->Form->create('BeautyProfile', array('class' => 'normal js-autoSubmit'));?>
<!-- slide 1 -->

<?php echo $this->Form->input('BeautyProfile.1.beauty_question_id',array('value'=> 1,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.1.answer1',array('value'=> 0,'id'=>'js-slide1_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.1.answer2',array('value'=> 0,'id'=>'js-slide1_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.1.answer3',array('value'=> 0,'id'=>'js-slide1_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.1.answer4',array('value'=> 0,'id'=>'js-slide1_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.1.answer5',array('value'=> 0,'id'=>'js-slide1_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.1.answer6',array('value'=> 0,'id'=>'js-slide1_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.1.answer7',array('value'=> 0,'id'=>'js-slide1_7','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.1.answer8',array('value'=> 0,'id'=>'js-slide1_8','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.1.answer9',array('value'=> 0,'id'=>'js-slide1_9','type'=>'hidden')); ?>

<!-- slide 2 -->
<?php echo $this->Form->input('BeautyProfile.2.beauty_question_id',array('value'=> 2,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.2.answer1',array('value'=> 0,'id'=>'js-slide2_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.2.answer2',array('value'=> 0,'id'=>'js-slide2_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.2.answer3',array('value'=> 0,'id'=>'js-slide2_3','type'=>'hidden')); ?>

<!-- slide 3 -->
<?php echo $this->Form->input('BeautyProfile.3.beauty_question_id',array('value'=> 3,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.3.answer1',array('value'=> 0,'id'=>'js-slide3_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.3.answer2',array('value'=> 0,'id'=>'js-slide3_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.3.answer3',array('value'=> 0,'id'=>'js-slide3_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.3.answer4',array('value'=> 0,'id'=>'js-slide3_4','type'=>'hidden')); ?>

<!-- slide 4 -->
<?php echo $this->Form->input('BeautyProfile.4.beauty_question_id',array('value'=> 4,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.4.answer1',array('value'=> 0,'id'=>'js-slide4_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.4.answer2',array('value'=> 0,'id'=>'js-slide4_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.4.answer3',array('value'=> 0,'id'=>'js-slide4_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.4.answer4',array('value'=> 0,'id'=>'js-slide4_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.4.answer5',array('value'=> 0,'id'=>'js-slide4_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.4.answer6',array('value'=> 0,'id'=>'js-slide4_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.4.answer7',array('value'=> 0,'id'=>'js-slide4_7','type'=>'hidden')); ?>
<!-- slide 5 -->
<?php echo $this->Form->input('BeautyProfile.5.beauty_question_id',array('value'=>5,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.5.answer1',array('value'=> 0,'id'=>'js-slide5_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.5.answer2',array('value'=> 0,'id'=>'js-slide5_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.5.answer3',array('value'=> 0,'id'=>'js-slide5_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.5.answer4',array('value'=> 0,'id'=>'js-slide5_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.5.answer5',array('value'=> 0,'id'=>'js-slide5_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.5.answer6',array('value'=> 0,'id'=>'js-slide5_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.5.answer7',array('value'=> 0,'id'=>'js-slide5_7','type'=>'hidden')); ?>
<!-- slide 6 -->
<?php echo $this->Form->input('BeautyProfile.6.beauty_question_id',array('value'=>6,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.6.answer1',array('value'=> 0,'id'=>'js-slide6_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.6.answer2',array('value'=> 0,'id'=>'js-slide6_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.6.answer3',array('value'=> 0,'id'=>'js-slide6_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.6.answer4',array('value'=> 0,'id'=>'js-slide6_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.6.answer5',array('value'=> 0,'id'=>'js-slide6_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.6.answer6',array('value'=> 0,'id'=>'js-slide6_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.6.answer7',array('value'=> 0,'id'=>'js-slide6_7','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.6.other_answer',array('value'=> 0,'id'=>'js-slide6_8','type'=>'hidden')); ?>

<!-- slide 7  -->
<?php echo $this->Form->input('BeautyProfile.7.beauty_question_id',array('value'=>7,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.7.answer1',array('value'=> 0,'id'=>'js-slide7_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.7.answer2',array('value'=> 0,'id'=>'js-slide7_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.7.answer3',array('value'=> 0,'id'=>'js-slide7_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.7.answer4',array('value'=> 0,'id'=>'js-slide7_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.7.answer5',array('value'=> 0,'id'=>'js-slide7_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.7.answer6',array('value'=> 0,'id'=>'js-slide7_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.7.answer7',array('value'=> 0,'id'=>'js-slide7_7','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.7.answer8',array('value'=> 0,'id'=>'js-slide7_8','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.7.answer9',array('value'=> 0,'id'=>'js-slide7_9','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.7.answer10',array('value'=> 0,'id'=>'js-slide7_10','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.7.answer11',array('value'=> 0,'id'=>'js-slide7_11','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.7.answer12',array('value'=> 0,'id'=>'js-slide7_12','type'=>'hidden')); ?>

<!-- slide 8  -->
<?php echo $this->Form->input('BeautyProfile.8.beauty_question_id',array('value'=>8,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.8.answer1',array('value'=> 0,'id'=>'js-slide8_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.8.answer2',array('value'=> 0,'id'=>'js-slide8_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.8.answer3',array('value'=> 0,'id'=>'js-slide8_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.8.answer4',array('value'=> 0,'id'=>'js-slide8_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.8.answer5',array('value'=> 0,'id'=>'js-slide8_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.8.answer6',array('value'=> 0,'id'=>'js-slide8_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.8.answer7',array('value'=> 0,'id'=>'js-slide8_7','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.8.answer8',array('value'=> 0,'id'=>'js-slide8_8','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.8.answer9',array('value'=> 0,'id'=>'js-slide8_9','type'=>'hidden')); ?>

<!-- slide 9  -->
<?php echo $this->Form->input('BeautyProfile.9.beauty_question_id',array('value'=>9,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.9.answer1',array('value'=> 0,'id'=>'js-slide9_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.9.answer2',array('value'=> 0,'id'=>'js-slide9_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.9.answer3',array('value'=> 0,'id'=>'js-slide9_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.9.answer4',array('value'=> 0,'id'=>'js-slide9_4','type'=>'hidden')); ?>

<!-- slide 10  -->
<?php echo $this->Form->input('BeautyProfile.10.beauty_question_id',array('value'=>10,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.10.answer1',array('value'=> 0,'id'=>'js-slide10_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.10.answer2',array('value'=> 0,'id'=>'js-slide10_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.10.answer3',array('value'=> 0,'id'=>'js-slide10_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.10.answer4',array('value'=> 0,'id'=>'js-slide10_4','type'=>'hidden')); ?>

<!-- slide 11  -->
<?php echo $this->Form->input('BeautyProfile.11.beauty_question_id',array('value'=>11,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.11.answer1',array('value'=> 0,'id'=>'js-slide11_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.11.answer2',array('value'=> 0,'id'=>'js-slide11_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.11.answer3',array('value'=> 0,'id'=>'js-slide11_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.11.answer4',array('value'=> 0,'id'=>'js-slide11_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.11.answer5',array('value'=> 0,'id'=>'js-slide11_5','type'=>'hidden')); ?>

<!-- slide 12  -->
<?php echo $this->Form->input('BeautyProfile.12.beauty_question_id',array('value'=>12,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.12.answer1',array('value'=> 0,'id'=>'js-slide12_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.12.answer2',array('value'=> 0,'id'=>'js-slide12_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.12.answer3',array('value'=> 0,'id'=>'js-slide12_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.12.answer4',array('value'=> 0,'id'=>'js-slide12_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.12.answer5',array('value'=> 0,'id'=>'js-slide12_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.12.answer6',array('value'=> 0,'id'=>'js-slide12_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.12.other_answer',array('value'=> 0,'id'=>'js-slide12_7','type'=>'hidden')); ?>

<!-- slide 13  -->
<?php echo $this->Form->input('BeautyProfile.13.beauty_question_id',array('value'=>13,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.13.answer1',array('value'=> 0,'id'=>'js-slide13_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.13.answer2',array('value'=> 0,'id'=>'js-slide13_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.13.answer3',array('value'=> 0,'id'=>'js-slide13_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.13.answer4',array('value'=> 0,'id'=>'js-slide13_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.13.answer5',array('value'=> 0,'id'=>'js-slide13_5','type'=>'hidden')); ?>

<!-- slide 14  -->
<?php echo $this->Form->input('BeautyProfile.14.beauty_question_id',array('value'=>14,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.14.answer1',array('value'=> 0,'id'=>'js-slide14_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.14.answer2',array('value'=> 0,'id'=>'js-slide14_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.14.answer3',array('value'=> 0,'id'=>'js-slide14_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.14.answer4',array('value'=> 0,'id'=>'js-slide14_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.14.answer5',array('value'=> 0,'id'=>'js-slide14_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.14.answer6',array('value'=> 0,'id'=>'js-slide14_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.14.other_answer',array('value'=> 0,'id'=>'js-slide14_7','type'=>'hidden')); ?>


<!-- slide 15  -->
<?php echo $this->Form->input('BeautyProfile.15.beauty_question_id',array('value'=>15,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.15.answer1',array('value'=> 0,'id'=>'js-slide15_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.15.answer2',array('value'=> 0,'id'=>'js-slide15_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.15.answer3',array('value'=> 0,'id'=>'js-slide15_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.15.answer4',array('value'=> 0,'id'=>'js-slide15_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.15.answer5',array('value'=> 0,'id'=>'js-slide15_5','type'=>'hidden')); ?>


<!-- slide 13 a) - Sub Question  -->
<?php echo $this->Form->input('BeautyProfile.24.beauty_question_id',array('value'=>24,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.24.answer1',array('value'=> 0,'id'=>'js-slide16_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.24.answer2',array('value'=> 0,'id'=>'js-slide16_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.24.answer3',array('value'=> 0,'id'=>'js-slide16_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.24.answer4',array('value'=> 0,'id'=>'js-slide16_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.24.answer5',array('value'=> 0,'id'=>'js-slide16_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.24.answer6',array('value'=> 0,'id'=>'js-slide16_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.24.answer7',array('value'=> 0,'id'=>'js-slide16_7','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.24.answer8',array('value'=> 0,'id'=>'js-slide16_8','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.24.answer9',array('value'=> 0,'id'=>'js-slide16_9','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.24.answer10',array('value'=> 0,'id'=>'js-slide16_10','type'=>'hidden')); ?>

<!-- slide 13 b) - Sub Question  -->

<?php echo $this->Form->input('BeautyProfile.31.beauty_question_id',array('value'=>31,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.31.answer1',array('value'=> 0,'id'=>'js-slide17_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.31.answer2',array('value'=> 0,'id'=>'js-slide17_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.31.answer3',array('value'=> 0,'id'=>'js-slide17_3','type'=>'hidden')); ?>

<!-- slide after Question  5 -->
<?php echo $this->Form->input('BeautyProfile.25.beauty_question_id',array('value'=>25,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.25.answer1',array('value'=> 0,'id'=>'js-slide25_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.25.answer2',array('value'=> 0,'id'=>'js-slide25_2','type'=>'hidden')); ?>


<?php echo $this->Form->input('BeautyProfile.26.beauty_question_id',array('value'=>26,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer1',array('value'=> 0,'id'=>'js-slide26_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer2',array('value'=> 0,'id'=>'js-slide26_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer3',array('value'=> 0,'id'=>'js-slide26_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer4',array('value'=> 0,'id'=>'js-slide26_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer5',array('value'=> 0,'id'=>'js-slide26_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer6',array('value'=> 0,'id'=>'js-slide26_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer7',array('value'=> 0,'id'=>'js-slide26_7','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer8',array('value'=> 0,'id'=>'js-slide26_8','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer9',array('value'=> 0,'id'=>'js-slide26_9','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer10',array('value'=> 0,'id'=>'js-slide26_10','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer11',array('value'=> 0,'id'=>'js-slide26_11','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer12',array('value'=> 0,'id'=>'js-slide26_12','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer13',array('value'=> 0,'id'=>'js-slide26_13','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer14',array('value'=> 0,'id'=>'js-slide26_14','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer15',array('value'=> 0,'id'=>'js-slide26_15','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer16',array('value'=> 0,'id'=>'js-slide26_16','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer17',array('value'=> 0,'id'=>'js-slide26_17','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer18',array('value'=> 0,'id'=>'js-slide26_18','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.answer19',array('value'=> 0,'id'=>'js-slide26_19','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.26.other_answer',array('value'=> 0,'id'=>'js-slide26_20','type'=>'hidden')); ?>

<?php echo $this->Form->input('BeautyProfile.27.beauty_question_id',array('value'=>27,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.27.answer1',array('value'=> 0,'id'=>'js-slide27_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.27.answer2',array('value'=> 0,'id'=>'js-slide27_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.27.answer3',array('value'=> 0,'id'=>'js-slide27_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.27.answer4',array('value'=> 0,'id'=>'js-slide27_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.27.answer5',array('value'=> 0,'id'=>'js-slide27_5','type'=>'hidden')); ?>

<!-- Slide Main Question  7 -->

<?php echo $this->Form->input('BeautyProfile.28.beauty_question_id',array('value'=>28,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.28.answer1',array('value'=> 0,'id'=>'js-slide28_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.28.answer2',array('value'=> 0,'id'=>'js-slide28_2','type'=>'hidden')); ?>

<!-- Slide Question  7 a) -->

<?php echo $this->Form->input('BeautyProfile.29.beauty_question_id',array('value'=>29,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.29.answer1',array('value'=> 0,'id'=>'js-slide29_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.29.answer2',array('value'=> 0,'id'=>'js-slide29_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.29.answer3',array('value'=> 0,'id'=>'js-slide29_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.29.answer4',array('value'=> 0,'id'=>'js-slide29_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.29.answer5',array('value'=> 0,'id'=>'js-slide29_5','type'=>'hidden')); ?>

<!-- Slide Question  7 b) -->

<?php echo $this->Form->input('BeautyProfile.30.beauty_question_id',array('value'=>30,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.30.answer1',array('value'=> 0,'id'=>'js-slide30_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.30.answer2',array('value'=> 0,'id'=>'js-slide30_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.30.answer3',array('value'=> 0,'id'=>'js-slide30_3','type'=>'hidden')); ?>

<!-- Slide Question 24 -->

<?php echo $this->Form->input('BeautyProfile.32.beauty_question_id',array('value'=>32,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.32.answer1',array('value'=> 0,'id'=>'js-slide32_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.32.answer2',array('value'=> 0,'id'=>'js-slide32_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.32.answer3',array('value'=> 0,'id'=>'js-slide32_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.32.answer4',array('value'=> 0,'id'=>'js-slide32_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.32.answer5',array('value'=> 0,'id'=>'js-slide32_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.32.answer6',array('value'=> 0,'id'=>'js-slide32_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.32.answer7',array('value'=> 0,'id'=>'js-slide32_7','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.32.answer8',array('value'=> 0,'id'=>'js-slide32_8','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.32.answer9',array('value'=> 0,'id'=>'js-slide32_9','type'=>'hidden')); ?>


<!-- Slide Question 25 -->

<?php echo $this->Form->input('BeautyProfile.33.beauty_question_id',array('value'=>33,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer1',array('value'=> 0,'id'=>'js-slide33_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer2',array('value'=> 0,'id'=>'js-slide33_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer3',array('value'=> 0,'id'=>'js-slide33_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer4',array('value'=> 0,'id'=>'js-slide33_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer5',array('value'=> 0,'id'=>'js-slide33_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer6',array('value'=> 0,'id'=>'js-slide33_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer7',array('value'=> 0,'id'=>'js-slide33_7','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer8',array('value'=> 0,'id'=>'js-slide33_8','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer9',array('value'=> 0,'id'=>'js-slide33_9','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer10',array('value'=> 0,'id'=>'js-slide33_10','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer11',array('value'=> 0,'id'=>'js-slide33_11','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer12',array('value'=> 0,'id'=>'js-slide33_12','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.33.answer13',array('value'=> 0,'id'=>'js-slide33_13','type'=>'hidden')); ?>

<!-- Slide Question 26 -->

<?php echo $this->Form->input('BeautyProfile.34.beauty_question_id',array('value'=>34,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.answer1',array('value'=> 0,'id'=>'js-slide34_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.answer2',array('value'=> 0,'id'=>'js-slide34_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.answer3',array('value'=> 0,'id'=>'js-slide34_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.answer4',array('value'=> 0,'id'=>'js-slide34_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.answer5',array('value'=> 0,'id'=>'js-slide34_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.answer6',array('value'=> 0,'id'=>'js-slide34_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.answer7',array('value'=> 0,'id'=>'js-slide34_7','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.answer8',array('value'=> 0,'id'=>'js-slide34_8','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.answer9',array('value'=> 0,'id'=>'js-slide34_9','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.answer10',array('value'=> 0,'id'=>'js-slide34_10','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.answer11',array('value'=> 0,'id'=>'js-slide34_11','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.answer12',array('value'=> 0,'id'=>'js-slide34_12','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.34.other_answer',array('value'=> 0,'id'=>'js-slide34_13','type'=>'hidden')); ?>

<!-- Slide Question 27 -->

<?php echo $this->Form->input('BeautyProfile.35.beauty_question_id',array('value'=>35,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer1',array('value'=> 0,'id'=>'js-slide35_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer2',array('value'=> 0,'id'=>'js-slide35_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer3',array('value'=> 0,'id'=>'js-slide35_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer4',array('value'=> 0,'id'=>'js-slide35_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer5',array('value'=> 0,'id'=>'js-slide35_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer6',array('value'=> 0,'id'=>'js-slide35_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer7',array('value'=> 0,'id'=>'js-slide35_7','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer8',array('value'=> 0,'id'=>'js-slide35_8','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer9',array('value'=> 0,'id'=>'js-slide35_9','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer10',array('value'=> 0,'id'=>'js-slide35_10','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer11',array('value'=> 0,'id'=>'js-slide35_11','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer12',array('value'=> 0,'id'=>'js-slide35_12','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.answer13',array('value'=> 0,'id'=>'js-slide35_13','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.35.other_answer',array('value'=> 0,'id'=>'js-slide35_14','type'=>'hidden')); ?>


<!-- Slide Question 28 -->

<?php echo $this->Form->input('BeautyProfile.36.beauty_question_id',array('value'=>36,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer1',array('value'=> 0,'id'=>'js-slide36_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer2',array('value'=> 0,'id'=>'js-slide36_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer3',array('value'=> 0,'id'=>'js-slide36_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer4',array('value'=> 0,'id'=>'js-slide36_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer5',array('value'=> 0,'id'=>'js-slide36_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer6',array('value'=> 0,'id'=>'js-slide36_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer7',array('value'=> 0,'id'=>'js-slide36_7','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer8',array('value'=> 0,'id'=>'js-slide36_8','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer9',array('value'=> 0,'id'=>'js-slide36_9','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer10',array('value'=> 0,'id'=>'js-slide36_10','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer11',array('value'=> 0,'id'=>'js-slide36_11','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer12',array('value'=> 0,'id'=>'js-slide36_12','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer13',array('value'=> 0,'id'=>'js-slide36_13','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer14',array('value'=> 0,'id'=>'js-slide36_14','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer15',array('value'=> 0,'id'=>'js-slide36_15','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer16',array('value'=> 0,'id'=>'js-slide36_16','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer17',array('value'=> 0,'id'=>'js-slide36_17','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.36.answer18',array('value'=> 0,'id'=>'js-slide36_18','type'=>'hidden')); ?>

<!-- Slide Question 29 -->

<?php echo $this->Form->input('BeautyProfile.37.beauty_question_id',array('value'=>37,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.37.answer1',array('value'=> 0,'id'=>'js-slide37_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.37.answer2',array('value'=> 0,'id'=>'js-slide37_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.37.answer3',array('value'=> 0,'id'=>'js-slide37_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.37.answer4',array('value'=> 0,'id'=>'js-slide37_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.37.answer5',array('value'=> 0,'id'=>'js-slide37_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.37.answer6',array('value'=> 0,'id'=>'js-slide37_6','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.37.answer7',array('value'=> 0,'id'=>'js-slide37_7','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.37.other_answer',array('value'=> 0,'id'=>'js-slide37_8','type'=>'hidden')); ?>

<!-- Slide Question 30 -->

<?php echo $this->Form->input('BeautyProfile.38.beauty_question_id',array('value'=>38,'type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.38.answer1',array('value'=> 0,'id'=>'js-slide38_1','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.38.answer2',array('value'=> 0,'id'=>'js-slide38_2','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.38.answer3',array('value'=> 0,'id'=>'js-slide38_3','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.38.answer4',array('value'=> 0,'id'=>'js-slide38_4','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.38.answer5',array('value'=> 0,'id'=>'js-slide38_5','type'=>'hidden')); ?>
<?php echo $this->Form->input('BeautyProfile.38.answer6',array('value'=> 0,'id'=>'js-slide38_6','type'=>'hidden')); ?>

<!-- Other variable -->
<?php echo $this->Form->input('OtherVariable.currentSlide',array('value'=> 1,'id'=>'js-currentSlideNo','type'=>'hidden')); ?>
<?php echo $this->Form->input('OtherVariable.js-noofSelectItem',array('value'=> 0,'id'=>'js-noofSelectItem','type'=>'hidden')); ?>
<?php echo $this->Form->input('OtherVariable.js-noofSelectItem2',array('value'=> 0,'id'=>'js-noofSelectItem2','type'=>'hidden')); ?>
<?php echo $this->Form->input('OtherVariable.js-noofSelectItem3',array('value'=> 0,'id'=>'js-noofSelectItem3','type'=>'hidden')); ?>
<?php echo $this->Form->input('OtherVariable.js-noofSelectItem4',array('value'=> 0,'id'=>'js-noofSelectItem4','type'=>'hidden')); ?>
<?php echo $this->Form->input('OtherVariable.js-noofSelectItem5',array('value'=> 0,'id'=>'js-noofSelectItem5','type'=>'hidden')); ?>
<div class="hide">
<?php echo $this->Form->submit(__l('Add')); ?>
</div>
<?php echo $this->Form->end(); ?>

<!--Getstarted Banner End -->
               	