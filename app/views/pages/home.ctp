<script type="text/javascript">
$(document).ready(function(){
	var month = <?php  echo Configure::read('header.month') - 1; ?>;
	var year = <?php  echo Configure::read('header.year'); ?>;
	var ts = (new Date(year, month, 15)).getTime();
	$('#countdown').countdown({
		timestamp : ts
	});
});
</script>

<div class="brand_logo">

</div>

<div class="ad_sec">

<div class="ad1">
<h3><?php echo __l('Complete Your Beauty Profile')?></h3>
<?php echo __l('Sign-Up for a WonderBox account today and complete your beauty profile')?>
</div>

<div class="ad2">
<h3><?php echo __l('Share Your Blog with the Community')?></h3>
<?php echo __l('Share Your Blog with the Community so that others can read about your new beauty discovery')?>
</div>


<div class="ad3">
<h3><?php echo __l('Get Rewarded')?></h3>
<?php echo __l('If you are the lucky member selected during each period, you will receive a complimentary WonderBox fill with beauty samples or be invited to one of our exclusive beauty event.')?>
</div>

</div>

<div class="brand_logo">
</div>

<!-- Brand Logo Sec  -->
          		<!--<div class="brand_logo <?php if (!$this->Auth->sessionValid()): ?>	js-home-sign-pop-up <?php endif; ?>">
                  	  <h3><?php echo __l('Click to learn more about the unique services below:')?></h3>
                      <ul>

                                                <li><?php echo $this->Html->link($this->Html->image('wonderbox_service.jpg', array('width'=>'152','height'=>'49')), array('controller' => 'pages', 'action' => 'view','how_it_works'),array('title' =>'WonderBox', 'escape' => false));?></li>
						<li><?php echo $this->Html->link($this->Html->image('wondersurvey_service.jpg', array('width'=>'152','height'=>'49')), array('controller' => 'products', 'action' => 'survey'),array('title' =>'Share Your Feedback', 'escape' => false));?></li>
     	                                        <li><?php echo $this->Html->link($this->Html->image('wonderpoints_service.jpg', array('width'=>'152','height'=>'49')), array('controller' => 'pages', 'action' => 'view','earn-wonder-points'),array('title' =>'Ways to earn WonderPoints', 'escape' => false));?></li>
						<li><?php echo $this->Html->link($this->Html->image('wonderblog_service.jpg', array('width'=>'152','height'=>'49')), array('controller' => 'beauty_tips', 'action' => 'index'),array('title' =>'WonderBlog', 'escape' => false));?></li>
                                                <li><?php echo $this->Html->link($this->Html->image('wonderspree_service.jpg', array('width'=>'152','height'=>'49')), array('controller' => 'wonder_sprees', 'action' => 'index'),array('title' =>'WonderSpree', 'escape' => false));?></li>
                                                <li><?php echo $this->Html->link($this->Html->image('wondershop_service.jpg', array('width'=>'152','height'=>'49')), array('controller' => 'product_redemptions', 'action' => 'index'),array('title' =>'WonderShop', 'escape' => false));?></li>-->


				      </ul>
           		</div>
                <!-- ADD SEC -->
                <!--<div class="ad_sec">
                	<div class="ad1"><?php echo $this->element('home-page-organizers-index'); ?>
                	<?php echo __l('Previous WonderBox Editions'); ?>    </div>
                    <div class="ad2"><?php echo $this->Html->link($this->Html->image('ad2.jpg',array('width'=>'210','height'=>'200')), array('controller' => 'beauty_tips', 'action' => 'index'),array('title' =>'Beauty Tips', 'escape' => false));?>
                    <?php echo __l('Keep Up With The Latest Beauty Tips'); ?>    </div>
                    <div class="ad3">
                    <?php if($this->Html->checkPackageAvialable() > 0): ?>


                    	<div class="sub_box">
                       	  <div class="s-box-left">
                           	<h2><strong><?php echo __l('NEXT SURPRISE'); ?></strong></h2>
                            <p><?php echo $this->Html->image('sub_img.jpg',array('width'=>'89','height'=>'85')); ?></p>
                           </div>
                            <div class="s-box-right">
                            	<div class="date-row">
									<div id="countdown"></div>
                                	<p><?php echo __l('DAYS'); ?></p>
                                    <p><?php echo __l('HOURS'); ?></p>
                                    <p><?php echo __l('MINUTES'); ?></p>
                                </div>
                              <div class="rate-row">
                                	<span class="c1"><?php echo __l('LIMITED UNITS'); ?> <br /><b><?php echo __l('DELIVERY TO YOUR DOORSTEP'); ?></b></span>
                                    <span class="c2"><?php echo  configure::read('site.currency'); ?></span>
					                 <span class="c3"> <?php $cost = explode('.',$package['Package']['cost']); echo  $cost[0]; ?></span>
                                    <span class="c4"> <?php echo  $cost[1]; ?></span>
                                <div class="clear"></div>
								  <?php if($this->Html->checkPackageAvialable() > 0): ?>
                                  <p><?php echo $this->Html->link(' ', array('controller' => 'packages', 'action' => 'subscribe', 'admin' => false), array('escape'=>false,'title' =>__l('Subscribe Now'),'class'=>'rate-subs-now')); ?></p>
								  <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php echo __l('Counting Down To Your Next WonderBox'); ?>
                    </div>
                    <?php else: ?>
                    <p><?php echo $this->Html->image('sub_closed.jpg',array('width'=>'364','height'=>'196')); ?></p>
                    <?php echo __l('Subscription for Our Next WonderBox Edition Will Be Open Soon'); ?>
                    <?php endif; ?>-->

                </div> 
    