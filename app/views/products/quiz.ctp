	<script type="text/javascript">
		// Set up Sliders
		// **************
		$(function(){
			 $.fn.showbutton = function($slideNo ) {
					switch($slideNo){
						case 1:
						var noofItemSelect = parseInt($('#js-slide1_1').val()) + parseInt($('#js-slide1_2').val()) + parseInt($('#js-slide1_3').val())+ parseInt($('#js-slide1_4').val())+ parseInt($('#js-slide1_5').val());
						var kstart = 2;
						break;
						case 2:
						var noofItemSelect = parseInt($('#js-slide2_1').val()) + parseInt($('#js-slide2_2').val()) + parseInt($('#js-slide2_3').val())+ parseInt($('#js-slide2_4').val()) + parseInt($('#js-slide2_5').val()) ;
						var kstart = 3;
						break;
						case 3:
						var noofItemSelect = parseInt($('#js-slide3_1').val()) + parseInt($('#js-slide3_2').val()) + parseInt($('#js-slide3_3').val())+ parseInt($('#js-slide3_4').val());
						var kstart = 4;
						break;
						case 4:
						var noofItemSelect = parseInt($('#js-slide4_1').val()) + parseInt($('#js-slide4_2').val()) + parseInt($('#js-slide4_3').val())+ parseInt($('#js-slide4_4').val())+parseInt($('#js-slide4_5').val());
						var kstart = 5;
						break;
						case 5:
						var noofItemSelect = parseInt($('.js-level-satisfaction1:checked').length) + parseInt($('.js-level-satisfaction2:checked').length)  + parseInt($('.js-level-satisfaction3:checked').length) + parseInt($('.js-level-satisfaction4:checked').length) + parseInt($('.js-level-satisfaction5:checked').length);
						if(noofItemSelect != 5)
							noofItemSelect = 0 ;
						else
							noofItemSelect = 1 ;
						var kstart = 6;
						break;
						case 6:
						var noofItemSelect = parseInt($('#js-slide6_1').val()) + parseInt($('#js-slide6_2').val()) + parseInt($('#js-slide6_3').val())+ parseInt($('#js-slide6_4').val())+ parseInt($('#js-slide6_5').val())+ parseInt($('#js-slide6_6').val())+ parseInt($('#js-slide6_7').val());
						var kstart = 7;
						break;
						case 7: 
						var noofItemSelect = parseInt($('#js-slide7_1').val()) + parseInt($('#js-slide7_2').val()) + parseInt($('#js-slide7_3').val())+ parseInt($('#js-slide7_4').val())+ parseInt($('#js-slide7_5').val());
						var kstart = 8;
						break;
					}
					if(noofItemSelect == 0){
						for(var k=kstart ; k<=8; k++)
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
				buildNavigation     : false
				
			});
				$('#menu-link0').livequery('click',function() {
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
			
				// SLIDE 1
				$("#js-product1").click(
					function(){		
						$('#js-product2,#js-product3,#js-product4,#js-product5').removeClass('active');
						$('#js-slide1_2,#js-slide1_3,#js-slide1_4,#js-slide1_5').val(0) ;
						if($('#js-slide1_1').val()  == 0){
							$('#js-slide1_1').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide1_1').val(0) ;
						}
					$.fn.showbutton(1);
				});
				$("#js-product2").click(
					function(){		
						$('#js-product1,#js-product3,#js-product4,#js-product5').removeClass('active');
						$('#js-slide1_1,#js-slide1_3,#js-slide1_4,#js-slide1_5').val(0) ;
						if($('#js-slide1_2').val()  == 0){
							$('#js-slide1_2').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide1_2').val(0) ;
						}
						$.fn.showbutton(1);
				});
				$("#js-product3").click(
					function(){		
						$('#js-product1,#js-product2,#js-product4,#js-product5').removeClass('active');
						$('#js-slide1_1,#js-slide1_2,#js-slide1_4,#js-slide1_5').val(0) ;
						if($('#js-slide1_3').val()  == 0){
							$('#js-slide1_3').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide1_3').val(0) ;
						}
						$.fn.showbutton(1);
				});
				$("#js-product4").click(
					function(){		
						$('#js-product1,#js-product2,#js-product3,#js-product5').removeClass('active');
						$('#js-slide1_1,#js-slide1_2,#js-slide1_3,#js-slide1_5').val(0) ;
						if($('#js-slide1_4').val()  == 0){
							$('#js-slide1_4').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide1_4').val(0) ;
						}
						$.fn.showbutton(1);
				});
				$("#js-product5").click(
					function(){		
						$('#js-product1,#js-product2,#js-product3,#js-product4').removeClass('active');
						$('#js-slide1_1,#js-slide1_2,#js-slide1_3,#js-slide1_4').val(0) ;
						if($('#js-slide1_5').val()  == 0){
							$('#js-slide1_5').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide1_5').val(0) ;
						}
						$.fn.showbutton(1);
				});
				
				// SLIDE 2
				$("#js-likely1").click(
					function(){		
						$('#js-likely1,#js-likely2,#js-likely3,#js-likely4,#js-likely5').removeClass('active');
						$('#js-slide2_2,#js-slide2_3,#js-slide2_4,#js-slide2_5').val(0) ;
						if($('#js-slide2_1').val()  == 0){
							$('#js-slide2_1').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide2_1').val(0) ;
						}
						$.fn.showbutton(2);
				});
				
				$("#js-likely2").click(
					function(){		
						$('#js-likely1,#js-likely2,#js-likely3,#js-likely4,#js-likely5').removeClass('active');
						$('#js-slide2_1,#js-slide2_3,#js-slide2_4,#js-slide2_5').val(0) ;
						if($('#js-slide2_2').val()  == 0){
							$('#js-slide2_2').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide2_2').val(0) ;
						}
						$.fn.showbutton(2);
				});
				$("#js-likely3").click(
					function(){		
						$('#js-likely1,#js-likely2,#js-likely3,#js-likely4,#js-likely5').removeClass('active');
						$('#js-slide2_1,#js-slide2_2,#js-slide2_4,#js-slide2_5').val(0) ;
						if($('#js-slide2_3').val()  == 0){
							$('#js-slide2_3').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide2_3').val(0) ;
						}
						$.fn.showbutton(2);
				});
				$("#js-likely4").click(
					function(){		
						$('#js-likely1,#js-likely3,#js-likely2,#js-likely4,#js-likely5').removeClass('active');
						$('#js-slide2_1,#js-slide2_2,#js-slide2_3,#js-slide2_5').val(0) ;
						if($('#js-slide2_4').val()  == 0){
							$('#js-slide2_4').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide2_4').val(0) ;
						}
						$.fn.showbutton(2);
				});
				$("#js-likely5").click(
					function(){		
						$('#js-likely1,#js-likely3,#js-likely2,#js-likely4,#js-likely5').removeClass('active');
						$('#js-slide2_1,#js-slide2_2,#js-slide2_3,#js-slide2_4').val(0) ;
						if($('#js-slide2_5').val()  == 0){
							$('#js-slide2_5').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide2_5').val(0) ;
						}
						$.fn.showbutton(2);
				});

				// SLIDE 3
				$("#js-time-tried1").click(
					function(){		
						$('#js-time-tried1,#js-time-tried2,#js-time-tried3,#js-time-tried4').removeClass('active');
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
				$("#js-time-tried2").click(
					function(){		
						$('#js-time-tried1,#js-time-tried2,#js-time-tried3,#js-time-tried4').removeClass('active');
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
				$("#js-time-tried3").click(
					function(){		
						$('#js-time-tried1,#js-time-tried2,#js-time-tried4').removeClass('active');
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
				$("#js-time-tried4").click(
					function(){		
						$('#js-time-tried1,#js-time-tried2,#js-time-tried3').removeClass('active');
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

				//SLIDE 4
				
				$("#js-overall-satisfaction1").click(
					function(){		
						$('#js-overall-satisfaction2,#js-overall-satisfaction3,#js-overall-satisfaction4,#js-overall-satisfaction5').removeClass('active');
						$('#js-slide4_1,#js-slide4_2,#js-slide4_3,#js-slide4_4,#js-slide4_5').val(0) ;
						if($('#js-slide4_1').val()  == 0){
							$('#js-slide4_1').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide4_1').val(0) ;
						}
						$.fn.showbutton(4);
				});							
				$("#js-overall-satisfaction2").click(
					function(){		
						$('#js-overall-satisfaction1,#js-overall-satisfaction3,#js-overall-satisfaction4,#js-overall-satisfaction5').removeClass('active');
						$('#js-slide4_1,#js-slide4_2,#js-slide4_3,#js-slide4_4,#js-slide4_5').val(0) ;
						if($('#js-slide4_2').val()  == 0){
							$('#js-slide4_2').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide4_2').val(0) ;
						}
						$.fn.showbutton(4);
				});											
				$("#js-overall-satisfaction3").click(
					function(){		
						$('#js-overall-satisfaction1,#js-overall-satisfaction2,#js-overall-satisfaction4,#js-overall-satisfaction5').removeClass('active');
						$('#js-slide4_1,#js-slide4_2,#js-slide4_3,#js-slide4_4,#js-slide4_5').val(0) ;
						if($('#js-slide4_3').val()  == 0){
							$('#js-slide4_3').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide4_3').val(0) ;
						}
						$.fn.showbutton(4);
				});								
				$("#js-overall-satisfaction4").click(
					function(){		
						$('#js-overall-satisfaction1,#js-overall-satisfaction2,#js-overall-satisfaction3,#js-overall-satisfaction5').removeClass('active');
						$('#js-slide4_1,#js-slide4_2,#js-slide4_3,#js-slide4_4,#js-slide4_5').val(0) ;
						if($('#js-slide4_4').val()  == 0){
							$('#js-slide4_4').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide4_4').val(0) ;
						}
						$.fn.showbutton(4);
				});					
				$("#js-overall-satisfaction5").click(
					function(){		
						$('#js-overall-satisfaction1,#js-overall-satisfaction2,#js-overall-satisfaction3,#js-overall-satisfaction4').removeClass('active');
						$('#js-slide4_1,#js-slide4_2,#js-slide4_3,#js-slide4_4,#js-slide4_5').val(0) ;
						if($('#js-slide4_5').val()  == 0){
							$('#js-slide4_5').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide4_5').val(0) ;
						}
						$.fn.showbutton(4);
				});
				$("#js-overall-satisfaction5").click(
					function(){		
						$('#js-overall-satisfaction1,#js-overall-satisfaction2,#js-overall-satisfaction3,#js-overall-satisfaction4').removeClass('active');
						$('#js-slide4_1,#js-slide4_2,#js-slide4_3,#js-slide4_4,#js-slide4_5').val(0) ;
						if($('#js-slide4_5').val()  == 0){
							$('#js-slide4_5').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide4_5').val(0) ;
						}
						$.fn.showbutton(4);
				});
				// SLIDE 5

				$(".js-level-satisfaction1").click(function(){
					$('#js-slide5_1').val($(this).val() );
					$.fn.showbutton(5);
				});
				$(".js-level-satisfaction2").click(function(){
					$('#js-slide5_2').val($(this).val() );
					$.fn.showbutton(5);
				});
				$(".js-level-satisfaction3").click(function(){
					$('#js-slide5_3').val($(this).val() );
					$.fn.showbutton(5);
				});
				$(".js-level-satisfaction4").click(function(){
					$('#js-slide5_4').val($(this).val() );
					$.fn.showbutton(5);
				});
				$(".js-level-satisfaction5").click(function(){
					$('#js-slide5_5').val($(this).val() );
					$.fn.showbutton(5);
				});
				//SLIDE 6

				$("#js-frequently1").click(
					function(){		
						$('#js-frequently1,#js-frequently2,#js-frequently3,#js-frequently4,#js-frequently5,#js-frequently6,#js-frequently7').removeClass('active');
						$('#js-slide6_1,#js-slide6_2,#js-slide6_3,#js-slide6_4,#js-slide6_5,#js-slide6_6,#js-slide6_7').val(0) ;
						if($('#js-slide6_1').val()  == 0){
							$('#js-slide6_1').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide6_1').val(0) ;
						}
						$.fn.showbutton(6);
				});
				$("#js-frequently2").click(
					function(){		
						$('#js-frequently1,#js-frequently2,#js-frequently3,#js-frequently4,#js-frequently5,#js-frequently6,#js-frequently7').removeClass('active');
						$('#js-slide6_1,#js-slide6_2,#js-slide6_3,#js-slide6_4,#js-slide6_5,#js-slide6_6,#js-slide6_7').val(0) ;
						if($('#js-slide6_2').val()  == 0){
							$('#js-slide6_2').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide6_2').val(0) ;
						}
						$.fn.showbutton(6);
				});				
				$("#js-frequently3").click(
					function(){		
						$('#js-frequently1,#js-frequently2,#js-frequently3,#js-frequently4,#js-frequently5,#js-frequently6,#js-frequently7').removeClass('active');
						$('#js-slide6_1,#js-slide6_2,#js-slide6_3,#js-slide6_4,#js-slide6_5,#js-slide6_6,#js-slide6_7').val(0) ;
						if($('#js-slide6_3').val()  == 0){
							$('#js-slide6_3').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide6_3').val(0) ;
						}
						$.fn.showbutton(6);
				});				
				$("#js-frequently4").click(
					function(){		
						$('#js-frequently1,#js-frequently2,#js-frequently3,#js-frequently4,#js-frequently5,#js-frequently6,#js-frequently7').removeClass('active');
						$('#js-slide6_1,#js-slide6_2,#js-slide6_3,#js-slide6_4,#js-slide6_5,#js-slide6_6,#js-slide6_7').val(0) ;
						if($('#js-slide6_4').val()  == 0){
							$('#js-slide6_4').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide6_4').val(0) ;
						}
						$.fn.showbutton(6);
				});
				$("#js-frequently5").click(
					function(){		
						$('#js-frequently1,#js-frequently2,#js-frequently3,#js-frequently4,#js-frequently5,#js-frequently6,#js-frequently7').removeClass('active');
						$('#js-slide6_1,#js-slide6_2,#js-slide6_3,#js-slide6_4,#js-slide6_5,#js-slide6_6,#js-slide6_7').val(0) ;
						if($('#js-slide6_5').val()  == 0){
							$('#js-slide6_5').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide6_5').val(0) ;
						}
						$.fn.showbutton(6);
				});
				$("#js-frequently6").click(
					function(){		
						$('#js-frequently1,#js-frequently2,#js-frequently3,#js-frequently4,#js-frequently5,#js-frequently6,#js-frequently7').removeClass('active');
						$('#js-slide6_1,#js-slide6_2,#js-slide6_3,#js-slide6_4,#js-slide6_5,#js-slide6_6,#js-slide6_7').val(0) ;
						if($('#js-slide6_6').val()  == 0){
							$('#js-slide6_6').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide6_6').val(0) ;
						}
						$.fn.showbutton(6);
				});
				$("#js-frequently7").click(
					function(){		
						$('#js-frequently1,#js-frequently2,#js-frequently3,#js-frequently4,#js-frequently5,#js-frequently6,#js-frequently7').removeClass('active');
						$('#js-slide6_1,#js-slide6_2,#js-slide6_3,#js-slide6_4,#js-slide6_5,#js-slide6_6,#js-slide6_7').val(0) ;
						if($('#js-slide6_7').val()  == 0){
							$('#js-slide6_7').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide6_7').val(0) ;
						}
						$.fn.showbutton(6);
				});
				//SLIDE 7 		
				
				$("#js-full-size-product1").click(
					function(){		
						$('#js-full-size-product1,#js-full-size-product2,#js-full-size-product3,#js-full-size-product4,#js-full-size-product5').removeClass('active');
						$('#js-slide7_1,#js-slide7_2,#js-slide7_3,#js-slide7_4,#js-slide7_5').val(0) ;
						if($('#js-slide7_1').val()  == 0){
							$('#js-slide7_1').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide7_1').val(0) ;
						}
						$.fn.showbutton(7);
				});
				$("#js-full-size-product2").click(
					function(){		
						$('#js-full-size-product1,#js-full-size-product2,#js-full-size-product3,#js-full-size-product4,#js-full-size-product5').removeClass('active');
						$('#js-slide7_1,#js-slide7_2,#js-slide7_3,#js-slide7_4,#js-slide7_5').val(0) ;
						if($('#js-slide7_2').val()  == 0){
							$('#js-slide7_2').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide7_2').val(0) ;
						}
						$.fn.showbutton(7);
				});
				$("#js-full-size-product3").click(
					function(){		
						$('#js-full-size-product1,#js-full-size-product2,#js-full-size-product3,#js-full-size-product4,#js-full-size-product5').removeClass('active');
						$('#js-slide7_1,#js-slide7_2,#js-slide7_3,#js-slide7_4,#js-slide7_5').val(0) ;
						if($('#js-slide7_3').val()  == 0){
							$('#js-slide7_3').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide7_3').val(0) ;
						}
						$.fn.showbutton(7);
				});			   
				$("#js-full-size-product4").click(
					function(){		
						$('#js-full-size-product1,#js-full-size-product2,#js-full-size-product3,#js-full-size-product4,#js-full-size-product5').removeClass('active');
						$('#js-slide7_1,#js-slide7_2,#js-slide7_3,#js-slide7_4,#js-slide7_5').val(0) ;
						$(".js-slide-content7").hide();
						$(".js-slide-content-text8").show();
						if($('#js-slide7_4').val()  == 0){
							$('#js-slide7_4').val(1) ;
							$('#js-slide8_1').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide7_4').val(0) ;
						}
						$.fn.showbutton(7);
				});				
				$("#js-full-size-product5").click(
					function(){		
						$('#js-full-size-product1,#js-full-size-product2,#js-full-size-product3,#js-full-size-product4,#js-full-size-product5').removeClass('active');
						$('#js-slide7_1,#js-slide7_2,#js-slide7_3,#js-slide7_4,#js-slide7_5').val(0) ;
						$(".js-slide-content7").hide();
						$(".js-slide-content-text8").show();
						if($('#js-slide7_5').val()  == 0){
							$('#js-slide7_5').val(1) ;
							$('#js-slide8_2').val(1) ;
							$(this).addClass('active');

						} else {
							$(this).removeClass('active');
							$('#js-slide7_5').val(0) ;
						}
						$.fn.showbutton(7);
				});
				$('#js-slide7-text-content').keyup(function(event) {
					$("#js-slide8otheranswer").val($(this).val());
				});
				$('#js-goforward').click(function(){
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
					if(nextCurrent == 2 || nextCurrent == 3 || nextCurrent == 4 || nextCurrent == 5 || nextCurrent == 6 || nextCurrent == 7 || nextCurrent == 8 )
						$.fn.showbutton((nextCurrent- 1));
					if(nextCurrent == 9){
					 $("#js-gobackward").hide();
						$(this).hide();
						$.ajax({
							type: $('.js-autoSubmit').attr('method'),
							url: $('.js-autoSubmit').attr('action'),
							data: $('.js-autoSubmit').serialize(),
							success: function (data) {
								$(".js-currentWonderpoint").html( data);
								$('.banner-nav .finish').addClass('active');
								$('.banner-nav .start').addClass('end');
								$('.banner-nav .start').removeAttr('id');
								$('.banner-nav li a').each(function(index) {
									var visited = parseInt(index)+1;
									$("#"+$(this).attr('id')).removeClass('js-visited'+visited );
								});
							}
						});
						window.setTimeout(function() {
						    window.location.href = "<?php echo Router::url('/', true); ?>products/survey" ;
						}, 3000);
					}
				});
				$('#js-gobackward').click(function(){
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
		});
	</script>	<div class="my-account">
            	    <?php echo $this->element('user-sidebar'); ?><div class="my-account-right acc-banner">
           	    <div class="comp-survey">
                     	<div class="comp-survey-img">  <?php  echo $this->Html->showImage('Product',  $product['Attachment'][0], array('dimension' => 'brand_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['name'], false)), 'title' => $this->Html->cText($product['Product']['name'], false))); ?></div>
                        <div class="comp-survey-name">
                        	<h1><?php echo $this->Html->cText($product['Brand']['name']); ?></h1>
                            <h2><?php echo $this->Html->cText($product['Product']['name']); ?></h2>
                            <p><strong><?php echo __l('Discription:'); ?></strong></p>
                            <div id="inner-static"><p><?php echo $this->Html->cHtml($product['Product']['description']); ?></p></div>
                        </div>
                    </div>
                	 <!--Getstarted Banner -->
          			 <div class="banner pro-survey">
				<ul id="slider2">

				<li class="panel1"><!-- Slide 0 -->
					<div class="textSlide slide_1">
				    	<div class="in-wel-pad">
							<?php echo $this->Html->image('acc-banner_welcome2.png');?>
                            <p><?php echo __l('Our brand partners would like to hear from you. We appreciate your participation as your feedback will help us bring on-board new and exciting brand partners.'); ?> </p>
                        </div>
                    </div>
				</li>

				<li class="panel2"><!-- Slide 1 -->
               		<div class="get-slide2-left">
						<?php echo $this->Html->image('product_describ2.png');?>
                        <p><?php echo __l('Please choose one!'); ?></p>
                    </div>
                    <div class="get-slide2-right">
                          <div class="slide4 slide11">
                            <h1><?php echo __l('How long have you been using our products?'); ?></h1>
                            <ul>
                                <li><a title="First Time" id="js-product1"><?php echo __l('First Time'); ?></a></li>
                                <li><a title="Less than 6 months" id="js-product2"><?php echo __l('Less than 6 months'); ?></a></li>
                                <li><a title="1 year to less than 3 years"  id="js-product3"><?php echo __l('1 year to less than 3 years'); ?></a></li>
                            </ul>
                            <ul class="listrow_2">
                                <li><a title="3 year to less than 5 years" id="js-product4"><?php echo __l('3 year to less than 5 years'); ?></a></li>
                                <li><a title="5 years or more" id="js-product5"><?php echo __l('5 years'); ?> <br /><?php echo __l('or more'); ?></a></li>
                            </ul>
                          </div>
                    </div>
				</li>

				<li class="panel3"><!-- Slide 2 -->
					<div class="get-slide2-left">
                    	<?php echo $this->Html->image('product_describ2.png');?>
                        <p><?php echo __l('Please choose one!'); ?></p>
                    </div>
                    <div class="get-slide2-right">
                        <div class="slide4 slide11">
                            <h1><?php echo __l('How likely is it that you would recommend this product to a friend/colleague?'); ?></h1>
                            <ul>
                                <li><a  title="Very likely" id="js-likely1"><?php echo __l('Very likely'); ?></a></li>
                                <li><a  title="Somewhat likely" id="js-likely2"><?php echo __l('Somewhat'); ?> <br /><?php echo __l('likely'); ?></a></li>
                                <li><a  title="Neutral" id="js-likely3"><?php echo __l('Neutral'); ?></a></li>
                            </ul>
                            <ul class="listrow_2">
                                <li><a  title="Somewhat unlikely" id="js-likely4"><?php echo __l('Somewhat unlikely'); ?></a></li>
                                <li><a  title="Very unlikely" id="js-likely5"><?php echo __l('Very'); ?><br /><?php echo __l('unlikely'); ?></a></li>
                            </ul>
                          </div>
                    </div>
				</li>

				<li class="panel4"><!-- Slide 3 -->
					<div class="get-slide2-left">
                    	<?php echo $this->Html->image('product_describ2.png');?>
                        <p><?php echo __l('Please choose one!'); ?></p>
                    </div>
                    <div class="get-slide2-right">
                        <div class="slide3">
                            <h1><?php echo __l('How many times have you tried this product ?');?></h1>
                            <ul>
                                <li><a  title="Less the 2 times" id="js-time-tried1"><?php echo __l('Less than');?> <br /><?php echo __l('2 times');?></a></li>
                                <li><a  title="More then 2 times" id="js-time-tried2"><?php echo __l('More than');?> <br /><?php echo __l('2 times');?></a></li>
                                <li><a  title="More then 5 times" id="js-time-tried3"><?php echo __l('More than');?> <br /><?php echo __l('5 times');?></a></li>
                                <li><a  title="More then 8 times" id="js-time-tried4"><?php echo __l('More than');?> <br /><?php echo __l('8 times');?></a></li>
                            </ul>
                        </div>
                    </div>
				</li>

				<li class="panel5"><!-- Slide 4 -->
					<div class="get-slide2-left">
                    	<?php echo $this->Html->image('product_describ2.png');?>
                        <p><?php echo __l('Please choose one!'); ?></p>
                    </div>
                    <div class="get-slide2-right">
                        <div class="slide4 slide11">
                            <h1><?php echo __l('How satisfied are you with this product?');?></h1>
                            <ul>
                                <li><a  title="Very Satisfied" id="js-overall-satisfaction1"><?php echo __l('Very Satisfied');?></a></li>
                                <li><a  title="Somewhat Satisfied" id="js-overall-satisfaction2"><?php echo __l('Somewhat Satisfied');?></a></li>
                                <li><a  title="Neutral" id="js-overall-satisfaction3"><?php echo __l('Neutral');?></a></li>
                            </ul>
                            <ul class="listrow_2">
                                <li><a  title="Somewhat Dissatisfied" id="js-overall-satisfaction4"><?php echo __l('Somewhat Dissatisfied');?></a></li>
                                <li><a  title="Very Dissatisfied" id="js-overall-satisfaction5"><?php echo __l('Very'); ?><br/><?php echo __l('Dissatisfied');?></a></li>
                            </ul>
                          </div>
                    </div>
				</li>
                
                <li class="panel5"><!-- Slide 5 -->
					<div class="get-slide2-left">
                    	<?php echo $this->Html->image('product_describ2.png');?>
                        <p><?php echo __l('Only 1 per line'); ?></p>
                    </div>
                            <div class="get-slide2-right">
                            	<div class="comp-survey-td">
                                	<h1><?php echo __l('Please indicate your level of satisfaction with the following attributes of this product.');?></h1>
                                    <div class="table-data">
                                        <ul>
                                            <li class="t-head">
											 <div class="t-c1">&nbsp;</div>
                                                <div class="t-c2"><?php echo __l('Very');?> <br /><?php echo __l('Dissatisfied');?></div>
                                                <div class="t-c3"><?php echo __l('Somewhat Dissatisfied');?></div>
                                                <div class="t-c4"><?php echo __l('Neutral');?></div>
                                                <div class="t-c5"><?php echo __l('Somewhat Satisfied');?></div>
                                                <div class="t-c6"><?php echo __l('Very Satisfied');?></div>
                                                <div class="clear"></div>
                                            </li> 
                                            <li class="t-date">
                                                <div class="t-c1"><?php echo __l('Product Quality');?></div>
                                                <div class="t-c2"><input name="pro1" type="radio" value="1" class="js-level-satisfaction1"/></div>
                                                <div class="t-c3"><input name="pro1" type="radio" value="2" class="js-level-satisfaction1"/></div>
                                                <div class="t-c4"><input name="pro1" type="radio" value="3" class="js-level-satisfaction1"/></div>
                                                <div class="t-c5"><input name="pro1" type="radio" value="4" class="js-level-satisfaction1"/></div>
                                                <div class="t-c6"><input name="pro1" type="radio" value="5" class="js-level-satisfaction1"/></div>
                                                <div class="clear"></div>
                                            </li>
                                            <li class="t-date">
                                                <div class="t-c1"><?php echo __l('Product Sample Size');?></div>
                                                <div class="t-c2"><input name="pro2" type="radio" value="1"  class="js-level-satisfaction2"/></div>
                                                <div class="t-c3"><input name="pro2" type="radio" value="2"  class="js-level-satisfaction2"/></div>
                                                <div class="t-c4"><input name="pro2" type="radio" value="3"  class="js-level-satisfaction2"/></div>
                                                <div class="t-c5"><input name="pro2" type="radio" value="4"  class="js-level-satisfaction2"/></div>
                                                <div class="t-c6"><input name="pro2" type="radio" value="5"  class="js-level-satisfaction2"/></div>
                                                <div class="clear"></div>
                                            </li>
                                            <li class="t-date">
                                                <div class="t-c1"><?php echo __l('Product Suitablity');?></div>
                                                <div class="t-c2"><input name="pro3" type="radio" value="1" class="js-level-satisfaction3"/></div>
                                                <div class="t-c3"><input name="pro3" type="radio" value="2" class="js-level-satisfaction3"/></div>
                                                <div class="t-c4"><input name="pro3" type="radio" value="3" class="js-level-satisfaction3" /></div>
                                                <div class="t-c5"><input name="pro3" type="radio" value="4" class="js-level-satisfaction3"/></div>
                                                <div class="t-c6"><input name="pro3" type="radio" value="5" class="js-level-satisfaction3"/></div>
                                                <div class="clear"></div>
                                            </li>
                                            <li class="t-date">
                                                <div class="t-c1"><?php echo __l('Product Packaging');?></div>
                                                <div class="t-c2"><input name="pro4" type="radio" value="1" class="js-level-satisfaction4"/></div>
                                                <div class="t-c3"><input name="pro4" type="radio" value="2" class="js-level-satisfaction4"/></div>
                                                <div class="t-c4"><input name="pro4" type="radio" value="3" class="js-level-satisfaction4"/></div>
                                                <div class="t-c5"><input name="pro4" type="radio" value="4" class="js-level-satisfaction4"/></div>
                                                <div class="t-c6"><input name="pro4" type="radio" value="5" class="js-level-satisfaction4"/></div>
                                                <div class="clear"></div>
                                            </li>
                                            <li class="t-date">
                                                <div class="t-c1"><?php echo __l('Product Retail Price');?></div>
                                                <div class="t-c2"><input name="pro5" type="radio" value="1" class="js-level-satisfaction5"/></div>
                                                <div class="t-c3"><input name="pro5" type="radio" value="2" class="js-level-satisfaction5"/></div>
                                                <div class="t-c4"><input name="pro5" type="radio" value="3" class="js-level-satisfaction5"/></div>
                                                <div class="t-c5"><input name="pro5" type="radio" value="4" class="js-level-satisfaction5"/></div>
                                                <div class="t-c6"><input name="pro5" type="radio" value="5" class="js-level-satisfaction5"/></div>
                                                <div class="clear"></div>
                                            </li>
                                        </ul>
                                     </div>
                           		</div>
                    </div>
				</li>
                
                <li class="panel5"><!-- Slide 6 -->
					<div class="get-slide2-left">
                    	<?php echo $this->Html->image('product_describ2.png');?>
                        <p><?php echo __l('Please choose one!'); ?></p>
                    </div>
                            <div class="get-slide2-right">
                            	<div class="slide4">
                            <h1><?php echo __l('How frequently have you been purchasing our product?'); ?></h1>
                            <ul>
                                <li><a  title="Every week" id="js-frequently1"><?php echo __l('Every week'); ?></a></li>
                                <li><a  title="Every 2 - 3 week" id="js-frequently2"><?php echo __l('Every 2 - 3'); ?><br/><?php echo __l('weeks'); ?></a></li>
                                <li><a  title="Every month" id="js-frequently3"><?php echo __l('Every month'); ?></a></li>
                                <li><a  title="Every 2 - 3 months" id="js-frequently4"><?php echo __l('Every 2 - 3 months'); ?></a></li>
                                
                            </ul>
                            <ul class="listrow_2">
                                <li><a  title="Every 4 - 6 months" id="js-frequently5"><?php echo __l('Every 4 - 6 months'); ?></a></li>
                                <li><a  title="Once or twice a year" id="js-frequently6"><?php echo __l('Once or twice');?><br/><?php echo __l('a year'); ?></a></li>
                                <li><a  title="Never before" id="js-frequently7"><?php echo __l('Never before'); ?></a></li>
                               
                            </ul>
                          </div>
                    </div>
				</li>
                <li class="panel5"><!-- Slide 7 -->
					<div class="get-slide2-left">
                    	<?php echo $this->Html->image('product_describ2.png');?>
                        <p class="js-slide-content7"><?php echo __l('Please choose one!'); ?></p>
                    </div>
                            <div class="get-slide2-right">
                            	<div class="slide4 slide11 js-slide-content7">
                            <h1><?php echo __l('Would you purchase a full size of this product?');?></h1>
                            <ul>
                                <li><a  title="Very likely" id="js-full-size-product1"><?php echo __l('Very likely');?></a></li>
                                <li><a  title="Somewhat likely" id="js-full-size-product2"><?php echo __l('Somewhat');?> <br /><?php echo __l('likely');?></a></li>
                                <li><a  title="Neutral" id="js-full-size-product3"><?php echo __l('Neutral');?></a></li>
							</ul>
                            <ul class="listrow_2">
                                <li><a  title="Somewhat unlikely" id="js-full-size-product4"><?php echo __l('Somewhat unlikely');?></a></li>
                                <li><a  title="Very unlikely" id="js-full-size-product5"><?php echo __l('Very unlikely');?></a></li>
                            </ul>
				            </div>
							<div class="slide7 com-slide8 hide js-slide-content-text8">
                                	<h1><?php echo __l('In the same product category, please share the other brand that you are more likely to purchase in comparison to our product'); ?></h1>
                                    <p><input name="" type="text" id="js-slide7-text-content" /></p>

                           		</div>

                    </div>
				</li>
                <!--<li class="panel5">
					<div class="get-slide2-left">
                    	<?php // echo $this->Html->image('product_describ2.png');?>
                       <p>Choose as many  as you like!</p>
                    </div>
                    <div class="get-slide2-right">
                            	<div class="slide7 com-slide8">
                                	<h1><?php //echo __l('In the same product category, please share the other brand that you are more likely to purchase in comparison to our product'); ?></h1>
                                    <p><input name="" type="text" /></p>

                           		</div>
                    </div>
				</li> -->
                <li class="panel5"><!-- Slide 14 -->
					<div class="banner-thank">
                    	<h1><?php echo __l('Thanks You For Participating in'); ?> <span><?php echo $this->Html->cText($product['Brand']['name'],false); ?></span> 's <span><?php echo $this->Html->cText($product['Product']['name'], false); ?></span> <?php echo __l('Survey'); ?>. </h1>
                        <p><?php echo __l('As a token of appreciation'); ?>, <span><strong><?php echo $this->Html->cInt($product['Product']['wonder_point']); ?></strong></span> <?php echo __l('will be added to your account.');?> </p>
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
                    <li><a id="menu-link7" >7</a></li>
                </ul> 
                <span class="finish">Finish!</span>
            </div>
            </div>
		             <!--Getstarted Banner End -->
                </div>
		<?php echo $this->Form->create('ProductSurvey', array('class' => 'normal js-autoSubmit'));?>
		<!-- slide 1 -->

		<?php echo $this->Form->input('ProductSurvey.1.beauty_question_id',array('value'=> 16,'type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.1.answer1',array('value'=> 0,'id'=>'js-slide1_1','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.1.answer2',array('value'=> 0,'id'=>'js-slide1_2','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.1.answer3',array('value'=> 0,'id'=>'js-slide1_3','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.1.answer4',array('value'=> 0,'id'=>'js-slide1_4','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.1.answer5',array('value'=> 0,'id'=>'js-slide1_5','type'=>'hidden')); ?>
		<!-- slide 2 -->

		<?php echo $this->Form->input('ProductSurvey.2.beauty_question_id',array('value'=> 17,'type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.2.answer1',array('value'=> 0,'id'=>'js-slide2_1','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.2.answer2',array('value'=> 0,'id'=>'js-slide2_2','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.2.answer3',array('value'=> 0,'id'=>'js-slide2_3','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.2.answer4',array('value'=> 0,'id'=>'js-slide2_4','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.2.answer5',array('value'=> 0,'id'=>'js-slide2_5','type'=>'hidden')); ?>
		<!-- slide 3 -->
		
		<?php echo $this->Form->input('ProductSurvey.3.beauty_question_id',array('value'=> 18,'type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.3.answer1',array('value'=> 0,'id'=>'js-slide3_1','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.3.answer2',array('value'=> 0,'id'=>'js-slide3_2','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.3.answer3',array('value'=> 0,'id'=>'js-slide3_3','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.3.answer4',array('value'=> 0,'id'=>'js-slide3_4','type'=>'hidden')); ?>
			
		<!-- slide 4 -->
		
		<?php echo $this->Form->input('ProductSurvey.4.beauty_question_id',array('value'=> 19,'type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.4.answer1',array('value'=> 0,'id'=>'js-slide4_1','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.4.answer2',array('value'=> 0,'id'=>'js-slide4_2','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.4.answer3',array('value'=> 0,'id'=>'js-slide4_3','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.4.answer4',array('value'=> 0,'id'=>'js-slide4_4','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.4.answer5',array('value'=> 0,'id'=>'js-slide4_5','type'=>'hidden')); ?>

					
		<!-- slide 5 -->
		
		<?php echo $this->Form->input('ProductSurvey.5.beauty_question_id',array('value'=> 20,'type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.5.answer1',array('value'=> 0,'id'=>'js-slide5_1','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.5.answer2',array('value'=> 0,'id'=>'js-slide5_2','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.5.answer3',array('value'=> 0,'id'=>'js-slide5_3','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.5.answer4',array('value'=> 0,'id'=>'js-slide5_4','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.5.answer5',array('value'=> 0,'id'=>'js-slide5_5','type'=>'hidden')); ?>
							
		<!-- slide 6 -->
		
		<?php echo $this->Form->input('ProductSurvey.6.beauty_question_id',array('value'=> 21,'type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.6.answer1',array('value'=> 0,'id'=>'js-slide6_1','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.6.answer2',array('value'=> 0,'id'=>'js-slide6_2','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.6.answer3',array('value'=> 0,'id'=>'js-slide6_3','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.6.answer4',array('value'=> 0,'id'=>'js-slide6_4','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.6.answer5',array('value'=> 0,'id'=>'js-slide6_5','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.6.answer6',array('value'=> 0,'id'=>'js-slide6_6','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.6.answer7',array('value'=> 0,'id'=>'js-slide6_7','type'=>'hidden')); ?>

		<!-- slide 7 -->
		
		<?php echo $this->Form->input('ProductSurvey.7.beauty_question_id',array('value'=> 22,'type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.7.answer1',array('value'=> 0,'id'=>'js-slide7_1','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.7.answer2',array('value'=> 0,'id'=>'js-slide7_2','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.7.answer3',array('value'=> 0,'id'=>'js-slide7_3','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.7.answer4',array('value'=> 0,'id'=>'js-slide7_4','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.7.answer5',array('value'=> 0,'id'=>'js-slide7_5','type'=>'hidden')); ?>

		<!-- slide 8 -->
		
		<?php echo $this->Form->input('ProductSurvey.8.beauty_question_id',array('value'=> 23,'type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.8.answer1',array('value'=> 0,'id'=>'js-slide8_1','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.8.answer2',array('value'=> 0,'id'=>'js-slide8_2','type'=>'hidden')); ?>
		<?php echo $this->Form->input('ProductSurvey.8.other_answer',array('id'=>'js-slide8otheranswer','type'=>'hidden')); ?>
		<!-- Other variable -->
		<?php echo $this->Form->input('OtherValue.product_id',array('value'=>$product['Product']['id'],'type'=>'hidden')); ?>
		<?php echo $this->Form->input('OtherValue.wonder_point',array('value'=>$product['Product']['wonder_point'],'type'=>'hidden')); ?>
		<div class="hide">
		<?php echo $this->Form->submit(__l('Add')); ?>
		</div>
		<?php echo $this->Form->end(); ?>

        </div>
                
