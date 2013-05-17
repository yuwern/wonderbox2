	<!-- Brand Logo Sec  -->
                <div class="static">
               	  <div class="reach-banner">
                    	<div class="reach-banner-left">
                        	<div class="head"><h1><?php echo __l('REACH NEW CUSTOMERS'); ?></h1></div>
                            <p><?php echo __l('With WonderBox, you have the power to reach a growing number of new potential customers by engaging WonderBox\'s community.'); ?></p><p><?php echo __l('A new marketing channel with the ability to reach out to a target audience that was previously unreachable.'); ?></p>

<p><?php echo $this->Html->link($this->Html->image('contact_now.jpg',array('width'=>216,'height'=>35)), array('controller' => 'contacts', 'action' => 'add', 'admin' => false), array('title' => __l('Contact Us'),'escape'=>false));?></p>
                        </div>
                        <div class="reach-banner-right"><?php echo $this->Html->image('reach_img.jpg',array('width'=>670,'height'=>420)); ?></div>
                    </div>
                  <div class="w-list-box">
                    	<h2><?php echo __l('BENEFITS OF WONDERBOX'); ?></h2> 
                        <div class="wreach-box">
                   	  		<?php echo $this->Html->image('reach_box_img1.jpg',array('width'=>294,'height'=>164)); ?>
                            <div class="head"><h1><?php echo __l('REACH NEW CUSTOMERS'); ?></h1></div>
                            <p><?php echo __l('With WonderBox, you have the power to reach a growing number of new potential customers by engaging WonderBox\'s community.'); ?></p><p><?php echo __l('A new marketing channel with the ability to reach out to a target audience that was previously unreachable.'); ?></p>
                            <p class="w-members"> <?php echo __l('No. of WonderBox members :'); ?>  <?php echo $total_no_of_users; ?></p>
                        </div>
                        <div class="wreach-box">
							<?php echo $this->Html->image('reach_box_img2.jpg',array('width'=>294,'height'=>164)); ?>
                   	  	    <div class="head"><h1>  <?php echo __l('EXPERIENCE-BASED MARKETING'); ?></h1></div>
                            <p> <?php echo __l('The ability to engage customers in a totally new environment that provides them with the freedom to try and appreciate the product first hand.'); ?> </p>
                            
                        </div>
                        <div class="wreach-box m-none">
							<?php echo $this->Html->image('reach_box_img3.jpg',array('width'=>294,'height'=>164)); ?>
                   	  		 <div class="head"><h1> SOCIAL SEEDING </h1></div>
                            <p>With a vibrant and passionate community, WonderBox members blog, create YouTube videos and share pictures about their experiences with the new and exciting products and brands shared with them each month. </p>
                            <p class="bold">Youtube Sample : <a href="https://www.youtube.com/watch?v=CcAVOagEdpk">Video 1</a> | <a href="https://www.youtube.com/watch?v=OJslzww5zxo&list=PLit_u_wMzux4g4V57efVVGPZD7yL2jtwJ">Video 2 </a> | <a href="http://vimeo.com/63022764">Video 3</a> </p>
                            <p class="bold">Blog Sample : <a href="http://mabelebamwrites.wordpress.com/2013/01/22/little-wonders-january-2013-wonderbox/">Blog 1</a> | <a href="https://trello.com/card/http-mylovelybluesky-com-2013-02-beauty-box-wonderbox-february-2013/50d300094140f3cf0f005329/84">Blog 2 </a> | <a href="http://www.street-love.net/2012/12/wonderbox-december-2012-christmas-edition-review.html">Blog 3</a></p>
                            <p class="bold">Facebook Sample : <a href="http://sphotos-d.ak.fbcdn.net/hphotos-ak-snc6/602537_3751391111248_1442874169_n.jpg">Picture 1</a> | <a href="https://www.facebook.com/photo.php?fbid=396291157122747&set=p.396291157122747&type=1&ref=nf">Picture 2 </a> | <a href="http://www.facebook.com/photo.php?fbid=10200548585504279&set=o.286344731457250&type=1&theater">Picture 3</a></p>
                            
                            <p class="w-members">  <?php echo __l('Facebook fans :'); ?> <?php echo !empty($total_fan_count)? $total_fan_count: 0; ?></p>
                        </div>
                        
                        <div class="wreach-box">
							<?php echo $this->Html->image('reach_box_img4.jpg',array('width'=>294,'height'=>164)); ?>
                   	        <div class="head"><h1> CONSUMER INSIGHTS </h1></div>
                            <p>We provide our brand partners a simple and easy way to gather insights into consumer behaviour, trends and interests which will be useful for future marketing campaigns of existing or new products. </p>
                        </div>
                        <div class="wreach-box">
                   	  		<?php echo $this->Html->image('reach_box_img5.jpg',array('width'=>294,'height'=>164)); ?>
                   	       <div class="head"><h1> TARGET MARKETING </h1></div>
                            <p> A well-defined target market is the first element of a successful marketing strategy. We provide deep and rich segmentation options which include beauty profiles, as well as geographical, social economic and behavioural aspects.  And we are going to keep innovating and advancing the target marketing spectrum. It's just what we do.  </p>
                        </div>
                        <div class="wreach-box m-none">
                   	  		<?php echo $this->Html->image('reach_box_img6.jpg',array('width'=>294,'height'=>164)); ?>
                            <div class="head"><h1 class="f16"> CUSTOMER ANALYTICS &amp; REPORT </h1></div>
                            <p>Our interactive survey platform allows us to collect valuable customer feedback on key metrics ranging from brand affinity, product suitability to consumer retail behaviour. This consumer feedback will provide the capability to perform critical trending analysis over time to surface valuable marketing information. </p>
                        </div>
                        <div class="clear"></div>
                        <div class="pagenation">
                	<div class="page-link-l"><?php echo $this->Html->link(__l('&laquo; PREVIOUS PAGE  |  INTRODUCTION'), array('controller' => 'brands', 'action' => 'listing', 'admin' => false), array('title' => __l('PREVIOUS PAGE  |  INTRODUCTION"'),'escape'=>false));?></div>
                    <!--<div class="page-link-r">NEXT PAGE  &raquo;</div> -->
                </div>
                  </div>
       		  </div>