 <head>
<script type="text/javascript">
var fb_param = {};
fb_param.pixel_id = '6009335961098';
fb_param.value = '0.00';
fb_param.currency = 'MYR';
(function(){
  var fpw = document.createElement('script');
  fpw.async = true;
  fpw.src = '//connect.facebook.net/en_US/fp.js';
  var ref = document.getElementsByTagName('script')[0];
  ref.parentNode.insertBefore(fpw, ref);
})();
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6009335961098&amp;value=0&amp;currency=MYR" /></noscript>

 </head>
 
 
 <html>

	<body>

			<!-- slideshow -->
			<div id="slideshow">
    <a href="" id="slideshow-link" ><span></span></a>
				<ul id="slides">

                 <li><?php echo $this->Html->image('lbb_slide_02.jpg');?></li>


	          	</ul>
			</div>
			<!-- ENDS slideshow -->

			<!-- headline -->
			<div class="headline">
			MALAYSIA'S FIRST FASHION SUBSCRIPTION BOX<br></br>

                        <ul>Our fashionistas at Little Black Box offer you a chance to choose the theme that best reflects your personality and fashion sense. Select the style that best suits you from the 3 different styles below</ul>
                          </div>
			<!-- ENDS headline -->

			<!-- blocks -->
			<ul class="blocks-holder">

                            <li class="block-1">
					<p class="block-title custom">The Hipster</p>
					<div class="thumb-holder">
						<div class="img-holder">
                                        <?php echo $this->Html->image('Hipster.jpg');?>
						</div>
						<p class="thumb-text">For subcultural trendsetter girls who love mixing latest trend with their personal style.</p>
					<p><?php echo $this->Html->link('Buy @ WonderShop',array('controller' => 'product_redemptions', 'action' => 'view','little-black-box-hipster'));?>
                           </div>
				</li>
				<li class="block-2">
					<p class="block-title custom">Classic Chic</p>
					<div class="thumb-holder">
						<div class="img-holder">
                                        <?php echo $this->Html->image('ClassicChic.jpg');?>
						</div>
						<p class="thumb-text">Timeless. Sophisticated. Elegant. Classic chic style remains every girl's favorite for effortless beauty.</p>
					<p><?php echo $this->Html->link('Buy @ WonderShop',array('controller' => 'product_redemptions', 'action' => 'view','little-black-box-classic-chic'));?>
					</div>
				</li>
				<li class="block-3">
					<p class="block-title custom">Girly Girl</p>
					<div class="thumb-holder">
						<div class="img-holder">
					 <?php echo $this->Html->image('GirlyGirl.jpg');?>
                                                </div>
						<p class="thumb-text">Be in touch with your feminine personality. Add some pastels, floral, ribbons and pearl to bring out a softer look. </p>
                                    <p><?php echo $this->Html->link('Buy @ WonderShop',array('controller' => 'product_redemptions', 'action' => 'view','little-black-box-girly-girl'));?>

                                          


					</div>
				</li>
			</ul>
			

			<!-- ENDS blocks -->


		</div>
		<!-- ENDS MAIN -->



	</div>
	<!-- ENDS CONTENT -->
	</div>
	<!-- ENDS WRAPPER -->




	</body>
</html>
