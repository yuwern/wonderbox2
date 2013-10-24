
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


			<!-- page-content -->
			<div class="page-content">
				
				
				<!-- one col -->
				<p class="sub-header">How It Works</p>
				<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, are sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus.</p>
				<div class="clear "></div>
				<!-- ENDS one col -->
				


				<!-- 4 cols -->
				<div class="one-fourth">
					<p class="sub-header">1: Select Your Personal Style </p>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor qenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis.</p>
				</div>
				<div class="one-fourth">
					<p class="sub-header">2. Complete Payment At WonderShop </p>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor qenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis.</p>
				</div>
				<div class="one-fourth">
					<p class="sub-header">3. Wait for Delivery Date</p>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor qenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis.</p>
				</div>
				<div class="one-fourth last">
					<p class="sub-header">4. Receive Little Black Box</p>
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor qenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis.</p>
				</div>
				<div class="clear "></div>
				<!-- ENDS 4 cols -->


				
				
			</div>
			<!-- ENDS page content -->



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
