
	<body>

	<!-- WRAPPER -->
	<div id="wrapper">

	<!-- TOP -->
	<!--<div id="top">
	  <div class="box">
	  	<div id="latest-tweet"><img src="img/twitter.png" class="twitter-bird" alt="Twitter" /></div>
	  	<script>Chirp({user:"ansimuz",max:1})</script>
	  </div>
	</div>-->
	<!-- ENDS TOP -->


	<!-- CONTENT -->
	<div id="content">

	<!-- top button -->
	<!--<div class="open-top">
		<a href="#" class="open"><img src="../img/top-tab.png" class="twitter-bird" alt="Twitter" /></a>
	</div>
	<!-- ENDS top button -->

		<!-- MAIN -->
		<div id="main">
                            <div id="logo">
			   <?php echo $this->Html->image('lbblogo.jpg');?>
                              </div>

			<!-- navigation -->
			<div id="centeredmenu">
			   <ul class="sf-menu">
			      <li class="current_page_item">
                              <?php echo $this->Html->link(__l('Home'), array('controller'=> 'subscriptions', 'action'=>'littleblackbox'));?>
                              </li>
                               <li><?php echo $this->Html->link(__l('How It Works'), array('controller' => 'subscriptions', 'action' => 'how_it_work', 'admin' => false), array('title' => __l('How It Works'))); ?>   </li>
                                            </ul>

			     		      </div>
			      <!--<li><a href="gallery.html">GALLERY</a>
			      	<ul>
			            <li><a href="gallery.html">TWO COLS</a></li>
			            <li><a href="gallery-3.html">THREE COLS</a></li>
			            <li><a href="gallery-4.html">FOUR COLS</a></li>
			         </ul>
			      </li>
			     <li><a href="blog.html">BLOG</a>
			      	<ul>
			            <li><a href="blog.html">SIDEBAR</a></li>
			            <li><a href="blog-full.html">FULL WIDTH</a></li>
			         </ul>
			      </li>
			      <li><a href="contact.html">CONTACT</a></li>
			      <li><a href="#">COLOR SKINS</a>
			      	<ul>
			            <li><a href="../blue">BLUE</a></li>
			            <li><a href="../red">RED</a></li>
			            <li><a href="../black">BLACK</a></li>
			         </ul>
			      </li>
			       <li><a href="http://luiszuno.com/blog/downloads/muro-template">DOWNLOAD</a></li>
			   </ul>
			</div>
			<div class="clear"></div>
			<!-- ENDS navigation -->


			<!-- slideshow -->
			<div id="slideshow">
    <a href="" id="slideshow-link" ><span></span></a>
				<ul id="slides">

                 <li><?php echo $this->Html->image('lbb_slide_01.jpg');?></li>


	          	</ul>
			</div>
			<!-- ENDS slideshow -->

			<!-- headline -->
			<div class="headline">
			MALAYSIA'S FIRST FASHION SUBSCRIPTION BOX<br></br>

                        3 different styles for you
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
					<p><?php echo $this->Html->link('Buy @ WonderShop',array('controller' => 'product_redemptions', 'action' => 'index'));?>
                           </div>
				</li>
				<li class="block-2">
					<p class="block-title custom">Classic Chic</p>
					<div class="thumb-holder">
						<div class="img-holder">
                                        <?php echo $this->Html->image('ClassicChic.jpg');?>
						</div>
						<p class="thumb-text">Timeless. Sophisticated. Elegant. Classic chic style remains every girl's favorite for effortless beauty.</p>
					<p><?php echo $this->Html->link('Buy @ WonderShop',array('controller' => 'product_redemptions', 'action' => 'index'));?>
					</div>
				</li>
				<li class="block-3">
					<p class="block-title custom">Girly Girl</p>
					<div class="thumb-holder">
						<div class="img-holder">
					 <?php echo $this->Html->image('GirlyGirl.jpg');?>
                                                </div>
						<p class="thumb-text">Be in touch with your feminine personality. Add some pastels, floral, ribbons and pearl to bring out a softer look. </p>
                                    <p><?php echo $this->Html->link('Buy @ WonderShop',array('controller' => 'product_redemptions', 'action' => 'index'));?>



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



	<!-- FOOTER -->
	<div id="footer">
		<div id="footer-wrapper">



			<!-- footer-cols -->
			<!--<ul class="footer-cols">
				<li class="col">
					<h6>LINKS</h6>
					<ul>
						<li><a href="http://www.luiszuno.com">More Freebies</a></li>
						<li><a href="http://themeforest.net/user/Ansimuz/portfolio?ref=Ansimuz">Premium Themes</a></li>
					</ul>
				</li>
				<li class="col">
					<h6>SEARCH THE SITE</h6>
					<form  method="get" id="searchform" action="">
						<div>
							<input type="text" value="Search..." name="s" id="s" onfocus="defaultInput(this)" onblur="clearInput(this)" />
							<input type="submit" id="searchsubmit" value=" " />
						</div>
					</form>
				</li> -->
				<ul class="footer-cols">
				<li class="col">
					<h6>FOLLOW US</h6>
					<ul>

						<li class="icon facebook">
						<a href="https://www.facebook.com/littleblackboxMY" title="Facebook" target="_blank"><?php echo $this->Html->image('f.jpg',array('width'=>'32','height'=>'32')); ?></a></li>

					</ul>
				</li>
			</ul>
			<!-- footer-cols -->




		</div>

		<div class="footer-bottom">
			<p class="legal">Muro created by <a href="http://www.luiszuno.com">luiszuno.com</a></p>
		</div>

	</div>
	<!-- ENDS FOOTER -->


	<!-- start cufon -->
	<script type="text/javascript"> Cufon.now(); </script>
	<!-- ENDS start cufon -->


	</body>
</html>
