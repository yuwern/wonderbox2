
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
						var noofItemSelect = parseInt($('#js-slide6_1').val()) + parseInt($('#js-slide6_2').val()) + parseInt($('#js-slide6_3').val())+ parseInt($('#js-slide6_4').val())+ parseInt($('#js-slide6_5').val())+ parseInt($('#js-slide6_6').val())+ parseInt($('#js-slide6_7').val());
						var kstart = 7;
						break;
						case 7: 
						var noofItemSelect = parseInt($('#js-slide7_1').val()) + parseInt($('#js-slide7_2').val()) + parseInt($('#js-slide7_3').val())+ parseInt($('#js-slide7_4').val())+ parseInt($('#js-slide7_5').val())+ parseInt($('#js-slide7_6').val())+ parseInt($('#js-slide7_7').val())+ parseInt($('#js-slide7_8').val())+ parseInt($('#js-slide7_9').val())+ parseInt($('#js-slide7_10').val())+ parseInt($('#js-slide7_11').val())+ parseInt($('#js-slide7_12').val());
						var kstart = 8;
						break;
						case 8: 
						var noofItemSelect = parseInt($('#js-slide8_1').val()) + parseInt($('#js-slide8_2').val()) + parseInt($('#js-slide8_3').val())+ parseInt($('#js-slide8_4').val())+ parseInt($('#js-slide8_5').val())+ parseInt($('#js-slide8_6').val())+ parseInt($('#js-slide8_7').val())+ parseInt($('#js-slide8_8').val())+ parseInt($('#js-slide8_9').val());
						var kstart = 9;
						break;
						case 9: 
						var noofItemSelect = parseInt($('#js-slide9_1').val()) + parseInt($('#js-slide9_2').val()) + parseInt($('#js-slide9_3').val())+ parseInt($('#js-slide9_4').val());
						var kstart = 10;
						break;
						case 10: 
						var noofItemSelect = parseInt($('#js-slide10_1').val()) + parseInt($('#js-slide10_2').val()) + parseInt($('#js-slide10_3').val())+ parseInt($('#js-slide10_4').val());
						var kstart = 11;
						break;
						case 11: 
						var noofItemSelect = parseInt($('#js-slide11_1').val()) + parseInt($('#js-slide11_2').val()) + parseInt($('#js-slide11_3').val())+ parseInt($('#js-slide11_4').val())+ parseInt($('#js-slide11_5').val());
						var kstart = 12;
						break;
						case 12: 
						var noofItemSelect = parseInt($('#js-slide12_1').val()) + parseInt($('#js-slide12_2').val()) + parseInt($('#js-slide12_3').val())+ parseInt($('#js-slide12_4').val())+ parseInt($('#js-slide12_5').val());
						var kstart = 13;
						break;
						case 13:
						var noofItemSelect = parseInt($('#js-slide13_1').val()) + parseInt($('#js-slide13_2').val()) + parseInt($('#js-slide13_3').val())+ parseInt($('#js-slide13_4').val())+ parseInt($('#js-slide13_5').val());
						var kstart = 15;
						break;
						case 14:
						var noofItemSelect = parseInt($('#js-slide14_1').val()) + parseInt($('#js-slide14_2').val()) + parseInt($('#js-slide14_3').val())+ parseInt($('#js-slide14_4').val())+ parseInt($('#js-slide14_5').val());
						var kstart = 16;
						break;
					}
					if(noofItemSelect == 0){
						for(var k=kstart ; k<=14; k++)
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
				
				$('#js-goforward').livequery('click',function() {
					var current = $('#slider2').data('AnythingSlider').currentPage; 
					$(".banner-nav .cur").removeClass("cur");
					$("#menu-link"+current).addClass('cur');
					$('.banner-nav .cur').addClass('js-visited'+current);
					$('#slider2').data('AnythingSlider').goForward(); 
					var nextCurrent = $('#slider2').data('AnythingSlider').currentPage; 
					if(nextCurrent != 1)
						$("#js-gobackward").show();
					if(nextCurrent != 1)
						$(this).hide();
					if(nextCurrent == 2 && $("#js-noofSelectItem").val() >= 1)
						$(this).show();
					var noofSelectItem = parseInt($('#js-slide2_1').val()) + parseInt($('#js-slide2_2').val()) + parseInt($('#js-slide2_3').val());
					if(nextCurrent == 3 && noofSelectItem == 1)
						$(this).show();
					var noofSelectItem1 = parseInt($('#js-slide3_1').val()) + parseInt($('#js-slide3_2').val()) + parseInt($('#js-slide3_3').val()) + parseInt($('#js-slide3_4').val());
					if(nextCurrent == 4 && noofSelectItem1 == 1)
						$(this).show();
					var noofSelectItem2 = parseInt($('#js-slide4_1').val()) + parseInt($('#js-slide4_2').val()) + parseInt($('#js-slide4_3').val())+ parseInt($('#js-slide4_4').val())+ parseInt($('#js-slide4_5').val())+ parseInt($('#js-slide4_6').val())+ parseInt($('#js-slide4_7').val());
					if(nextCurrent == 5 && noofSelectItem2 == 1)
						$(this).show();
					var noofSelectItem3 = parseInt($('#js-slide5_1').val()) + parseInt($('#js-slide5_2').val()) + parseInt($('#js-slide5_3').val())+ parseInt($('#js-slide5_4').val())+ parseInt($('#js-slide5_5').val())+ parseInt($('#js-slide5_6').val())+ parseInt($('#js-slide5_7').val());
					if(nextCurrent == 6 && noofSelectItem3 >= 1)
						$(this).show();
					var noofSelectItem4 = parseInt($('#js-slide6_1').val()) + parseInt($('#js-slide6_2').val()) + parseInt($('#js-slide6_3').val())+ parseInt($('#js-slide6_4').val())+ parseInt($('#js-slide6_5').val())+ parseInt($('#js-slide6_6').val())+ parseInt($('#js-slide6_7').val());
					if(nextCurrent == 7 && noofSelectItem4 >= 1)
						$(this).show();
					if(nextCurrent == 8 || nextCurrent == 9 || nextCurrent == 10 || nextCurrent == 11 || nextCurrent == 12 || nextCurrent == 13 || nextCurrent == 14 || nextCurrent == 15)
						$.fn.showbutton((nextCurrent- 1));
					if(nextCurrent == 16){
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
								$('.banner-nav li a').each(function(index) {
									var visited = parseInt(index)+1;
									$("#"+$(this).attr('id')).removeClass('js-visited'+visited );
								});
							}
						});
					} 
					$('#js-currentSlideNo').val(nextCurrent);
				});
				$('#js-gobackward').livequery('click',function() {
					var current = $('#slider2').data('AnythingSlider').currentPage; 
					$(".banner-nav .cur").removeClass("cur");
					if(current != 1 )
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
				 $.fn.showbutton(6);			
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
				$.fn.showbutton(6);			
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
				$.fn.showbutton(6);			
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
				$.fn.showbutton(6);			
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
				$.fn.showbutton(6);			
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
				$.fn.showbutton(6);			
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
				$.fn.showbutton(6);			
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
				$.fn.showbutton(7);
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
				$.fn.showbutton(7);
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
				$.fn.showbutton(7);
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
				$.fn.showbutton(7);
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
				$.fn.showbutton(7);
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
				$.fn.showbutton(7);
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
				$.fn.showbutton(7);
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
				$.fn.showbutton(7);
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
				$.fn.showbutton(7);
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
				$.fn.showbutton(7);
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
				$.fn.showbutton(7);
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
				$.fn.showbutton(7);
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
				$.fn.showbutton(8);
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
				$.fn.showbutton(8);
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
				$.fn.showbutton(8);
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
				$.fn.showbutton(8);
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
				$.fn.showbutton(8);
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
				$.fn.showbutton(8);
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
				$.fn.showbutton(8);
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
				$.fn.showbutton(8);
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
				$.fn.showbutton(8);
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
				$.fn.showbutton(9);
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
				$.fn.showbutton(9);
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
				$.fn.showbutton(9);
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
				$.fn.showbutton(9);
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
					$.fn.showbutton(10);
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
					$.fn.showbutton(10);
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
					$.fn.showbutton(10);
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
					$.fn.showbutton(10);
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
					$.fn.showbutton(11);
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
					$.fn.showbutton(11);
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
					$.fn.showbutton(11);
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
					$.fn.showbutton(11);
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
					$.fn.showbutton(11);
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
					$.fn.showbutton(12);
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
				$.fn.showbutton(12);
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
				$.fn.showbutton(12);
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
				$.fn.showbutton(12);
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
				$.fn.showbutton(12);
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
				$.fn.showbutton(12);
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
					$.fn.showbutton(13);
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
					$.fn.showbutton(13);
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
					$.fn.showbutton(13);
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
					$.fn.showbutton(13);
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
					$.fn.showbutton(13);
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
					$.fn.showbutton(14);
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
				$.fn.showbutton(14);
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
					$.fn.showbutton(14);
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
					$.fn.showbutton(14);
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
					$.fn.showbutton(14);
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
					$.fn.showbutton(14);
			});
			$('#js-beauty-product7val').keyup(function(event) {
					$("#js-slide14_7").val($(this).val());
			});

		});
	</script>
            <!--Getstarted Banner -->
            <div class="banner">
            	<ul id="slider2">

				<li class="panel1"><!-- Slide 0 -->
					<div class="textSlide slide_1">
					<?php 
					if(!empty($mybeautyprofile)):
						echo $this->Html->image('acc-banner_welcome.png',array('class'=> 'in-wel-pad'));
					else:
						echo $this->Html->image('getstarted_welcome_text.png',array('width'=> 620,'height'=>134));
					endif;
					?>
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
                                	<h1><?php echo __l('If you\'re going to splurge on beauty product, it\'s going to be on:'); ?></h1>
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
                                        <li id="js-cosmetic-product3"><a  title="Between RM 200 - RM 1000"><?php echo __l('Between RM 200 - RM 1000');?></a></li>
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
                            <div class="get-slide2-right">
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
                <li class="panel5"><!-- Slide 14 -->
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
                	<li><a id="menu-link1"  >1</a></li>
                    <li><a id="menu-link2" >2</a></li>
                    <li><a id="menu-link3" >3</a></li>
                    <li><a id="menu-link4" >4</a></li>
                    <li><a id="menu-link5" >5</a></li>
                    <li><a id="menu-link6" >6</a></li>
                    <li><a id="menu-link7" >7</a></li>
				    <li><a id="menu-link8" >8</a></li>
                    <li><a id="menu-link9" >9</a></li>
				    <li><a id="menu-link10">10</a></li>
                    <li><a id="menu-link11" >11</a></li>
                    <li><a id="menu-link12" >12</a></li>
                    <li><a id="menu-link13" >13</a></li>
                    <li><a id="menu-link14" >14</a></li>
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

<!-- Other variable -->
<?php echo $this->Form->input('OtherVariable.currentSlide',array('value'=> 1,'id'=>'js-currentSlideNo','type'=>'hidden')); ?>
<?php echo $this->Form->input('OtherVariable.js-noofSelectItem',array('value'=> 0,'id'=>'js-noofSelectItem','type'=>'hidden')); ?>
<?php echo $this->Form->input('OtherVariable.js-noofSelectItem2',array('value'=> 0,'id'=>'js-noofSelectItem2','type'=>'hidden')); ?>
<?php echo $this->Form->input('OtherVariable.js-noofSelectItem3',array('value'=> 0,'id'=>'js-noofSelectItem3','type'=>'hidden')); ?>
<?php echo $this->Form->input('OtherVariable.js-noofSelectItem4',array('value'=> 0,'id'=>'js-noofSelectItem4','type'=>'hidden')); ?>
<div class="hide">
<?php echo $this->Form->submit(__l('Add')); ?>
</div>
<?php echo $this->Form->end(); ?>

			        <!--Getstarted Banner End -->
               	