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
					<p class="block-title custom">The Great Gatsby </p>
					<div class="thumb-holder">
						<div class="img-holder">
                                        <?php echo $this->Html->image('gatsby.jpg');?>
						</div>
						<p class="thumb-text">Unconventional, outrageous & flirtatious. Transform yourself into a mysterious and seductive flapper party girl of the 1920s.</p>
					<p><?php echo $this->Html->link('Buy @ WonderShop',array('controller' => 'product_redemptions', 'action' => 'view','little-black-box-the-great-gatsby'));?>
                           </div>
				</li>
				<li class="block-2">
					<p class="block-title custom">Retro Soul</p>
					<div class="thumb-holder">
						<div class="img-holder">
                                        <?php echo $this->Html->image('retro.jpg');?>
						</div>
						<p class="thumb-text">Think of the retro style, think of Austin Powers, oh Behave :) and reinvent the big hair,polka dot prints and plastic frame sunnies.</p>
					<p><?php echo $this->Html->link('Buy @ WonderShop',array('controller' => 'product_redemptions', 'action' => 'view','little-black-box-retro-soul'));?>
					</div>
				</li>
				<li class="block-3">
					<p class="block-title custom">Greek Goddess</p>
					<div class="thumb-holder">
						<div class="img-holder">
					 <?php echo $this->Html->image('greek.jpg');?>
                                                </div>
						<p class="thumb-text">Mimic the eternal beauty of Helen of Troy. Any fan of white toga dresses, gold hammered jewellery and gladiator heels would love this.  </p>
                                    <p><?php echo $this->Html->link('Buy @ WonderShop',array('controller' => 'product_redemptions', 'action' => 'view','little-black-box-greek-goddess'));?>

                                          


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
