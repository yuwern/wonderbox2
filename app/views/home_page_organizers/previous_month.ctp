<script type="text/javascript">
$(function(){
	var month = <?php  echo Configure::read('header.month') - 1; ?>;
	var year = <?php  echo Configure::read('header.year'); ?>;
	var ts = (new Date(year, month, 15)).getTime();
	$('#countdown').countdown({
		timestamp : ts
	});
});
</script>
<div class="body">
				  <div class="product_redeem">
               		<p><?php echo $this->Html->image('redeem_banner.jpg',array('width'=>'947','height'=>'95')); ?></p>
                    <h3><?php echo __l('Previous Month\'s WonderBox Edition'); ?> </h3>
					<?php if(!empty($homePageOrganizers)): ?>
					<?php $i = 0; 
						 $orgainzer_count = count($homePageOrganizers) - 1;
						foreach($homePageOrganizers as $homePageOrganizer): 
						 $class  = null;
						 if($i == 1)
						 $class = " mrl";
					   if($orgainzer_count == $i): ?>
					 <div class="pro-red-box coming-month">
                    	<div class="reddeem-box">
                           <h1><?php echo date("F Y",strtotime($homePageOrganizer['HomePageOrganizer']['edition_date'])); ?></h1>
                            <p><?php echo $this->Html->showImage('HomePageOrganizerThumb', (!empty($homePageOrganizer['Attachment1']) ? $homePageOrganizer['Attachment1'] : ''), array('dimension' => 'previousmonth_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($homePageOrganizer['HomePageOrganizer']['title'], false)), 'title' => $this->Html->cText($homePageOrganizer['HomePageOrganizer']['title'], false))); ?></p>
                            <div class="rate-row"> 
                                	 <div class="limit-unit">
                            	<div class="limit-text"><?php echo __l('Limited Units'); ?><span><?php echo __l('Delevery to your doorstep'); ?></span></div>
                                <div class="limit-amt"><span class="c2"><?php echo  configure::read('site.currency'); ?></span>
                                    <span class="c3"><?php $cost = explode('.',$package['Package']['cost']); echo  $cost[0]; ?></span>
                                    <span class="c4"><?php echo  $cost[1]; ?></span></div>
                            </div>
                                    
                                <div class="clear"></div>
                                  <div class="a-center"> <?php if($this->Html->checkPackageAvialable() > 0): ?>
								  <?php echo $this->Html->link(' ', array('controller' => 'packages', 'action' => 'subscribe', 'admin' => false), array('escape'=>false,'title' =>__l('Subscribe Now'),'class'=>'rate-subs-now')); ?>
								    <?php endif; ?>
								  </div>
                                </div>
                          </div>
                        <div class="set-box2 a-center inner-date">
								<div class="inner-date-left">Time Leave to Buy</div>
								<div class="inner-date-right">
                            	<div class="date-row">
									<div id="countdown"></div>
                                	<p><?php echo __l('DAYS'); ?></p>
                                    <p><?php echo __l('HOURS'); ?></p>
                                    <p><?php echo __l('MINUTES'); ?></p>
                                </div>
								</div>
                           </div>
                            </div>

					<?php else:  ?>
                    <div class="pro-red-box pre-month">
                    	<div class="reddeem-box">
                        	<h1><?php echo date("F Y",strtotime($homePageOrganizer['HomePageOrganizer']['edition_date'])); ?></h1>
                            <p><?php echo $this->Html->showImage('HomePageOrganizer', (!empty($homePageOrganizer['Attachment']) ? $homePageOrganizer['Attachment'] : ''), array('dimension' => 'productredemption_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($homePageOrganizer['HomePageOrganizer']['title'], false)), 'title' => $this->Html->cText($homePageOrganizer['HomePageOrganizer']['title'], false))); ?></p>
                            <p><?php echo $this->Html->link(__l('Feedback'), array('controller' => 'products', 'action' => 'survey'),array('class'=>'feedback','title' =>__l('Feedback'), 'escape' => false));	echo $this->Html->link(__l('What\'s inside'), array('controller' => 'home_page_organizers', 'action' => 'view', $homePageOrganizer['HomePageOrganizer']['slug']),array('title' =>__l('What\'s inside'),'class'=>'what-inside', 'escape' => false)); ?></p>
                        </div>
                        <div class="set-box2">
                        	<div>
                                <label><?php echo __l('WHAT\'S'); ?> <br /><?php echo __l('INSIDE'); ?></label>
							   <span><?php $products = $this->Html->getProductList($homePageOrganizer['HomePageOrganizer']['edition_date']);
								if(!empty($products)):
								 $total_product_count = count($products);
								 foreach($products as $product):
									if($total_product_count >= 5):
										echo $this->Html->truncate($product['Product']['name'],7, array('ending' => ' ')).', ';
									endif;
								 endforeach;
								 if($total_product_count > 5)
									echo $this->Html->link(__l('&raquo; Read more'), array('controller' => 'home_page_organizers', 'action' => 'view', $homePageOrganizer['HomePageOrganizer']['slug']),array('title' =>__l('Read More'), 'escape' => false));
								endif; 
								?>
							 </span>
    						</div>
                        </div>
                    </div>
					<?php endif; $i++; endforeach; ?>
					<?php else: ?>
						<div class="pro-red-box coming-month">
                    	<div class="reddeem-box">
                        	<h1><?php echo date("F Y",strtotime("now")); ?></h1>
                             <p><?php echo $this->Html->image('coming_mo_img.jpg'); ?></p>
							 <div class="rate-row"> 
                                	 <div class="limit-unit">
                            	<div class="limit-text"><?php echo __l('Limited Units'); ?><span><?php echo __l('Delevery to your doorstep'); ?></span></div>
                                <div class="limit-amt"><span class="c2"><?php echo  configure::read('site.currency'); ?></span>
                                    <span class="c3"><?php $cost = explode('.',$package['Package']['cost']); echo  $cost[0]; ?></span>
                                    <span class="c4"><?php echo  $cost[1]; ?></span></div>
                            </div>
                                    
                                <div class="clear"></div>
                                  <div class="a-center"> <?php if($this->Html->checkPackageAvialable() > 0): ?>
								  <?php echo $this->Html->link(' ', array('controller' => 'packages', 'action' => 'subscribe', 'admin' => false), array('escape'=>false,'title' =>__l('Subscribe Now'),'class'=>'rate-subs-now')); ?>
								    <?php endif; ?>
								  </div>
                                </div>
                          </div>
                        <div class="set-box2 a-center inner-date">
								<div class="inner-date-left">Time Leave to Buy</div>
								<div class="inner-date-right">
                            	<div class="date-row">
									<div id="countdown"></div>
                                	<p><?php echo __l('DAYS'); ?></p>
                                    <p><?php echo __l('HOURS'); ?></p>
                                    <p><?php echo __l('MINUTES'); ?></p>
                                </div>
								</div>
                           </div>
                            </div>
				
					<?php endif; ?>
				
          		</div>
            </div>