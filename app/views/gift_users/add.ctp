	         <div class="body">
			  <div class="gift-wonder">
                	<div class="giftw-left"><?php echo $this->Html->image('gift_wonder.jpg'); ?></div>
                    <div class="giftw-right">
                    	<div class="head">
                        	<h1><?php echo __l('Gift a WonderBox!'); ?></h1>
                            <p><?php echo __l('Gift a WonderBox copywriting text, temporary text copywriting text copy test temp text temporary tex. temporary text copywriting text copy test temp text temporary tex. temporary text copywriting text copy testrary tex.'); ?></p>
                        </div>
                       	<h2><?php echo __l('1. Select your subscription plan'); ?></h2>
						<?php 
						if(!empty($packages)):
						$i = 1;
						foreach($packages as $package):
						$class = 'm-right18';
						if($i == 4)
							$class = null;
						?>
						 <div class="pay-box <?php echo $class; ?>">
							  <h1><?php echo $package['PackageType']['name']; ?></h1>
							  <h2><?php echo  configure::read('site.currency'); ?><?php echo $package['Package']['cost']; ?></h2>
							  <span><?php echo __l('for'); ?> <?php echo $package['PackageType']['no_of_months']; ?> <?php echo __l('month'); ?></span>
							  <p><?php echo __l('WonderPoints earned:'); ?> <?php echo $package['Package']['no_of_wonderpoints']; ?></p>
							 <?php if($i== 1): ?>
								 <p class="align-Center"><a title="Selected" rel="<?php echo $package['Package']['slug'].'||'.configure::read('site.currency').$package['Package']['cost'].'||'.$package['PackageType']['name']; ?>" class="js-payment-gift-plan select-on" id="js-plan-<?php echo $package['Package']['id']; ?>"><?php echo __l('Selected'); ?></a></p>
							 <?php else: ?>
								 <p class="align-Center"><a title="Selected" rel="<?php echo $package['Package']['slug'].'||'.configure::read('site.currency').$package['Package']['cost'].'||'.$package['PackageType']['name']; ?>" class="js-payment-gift-plan select-off" id="js-plan-<?php echo $package['Package']['id']; ?>"><?php echo __l('Select'); ?></a></p>
							 <?php endif; ?>
						  
							</div>
						<?php $i++;
						endforeach; 
						endif;
						?>
                        <div class="clear"></div>
                        <h2><?php echo __l('2. Your Message & Receiver Details'); ?></h2>
						<?php echo $this->Form->create('GiftUser', array('action'=>'add','class' => 'normal'));?>
                        <div class="gw-box-left">
                        	<h3><?php echo __l('Contact Information'); ?></h3>
							<?php echo $this->Form->input('from',array('label'=>__l('YOUR NAME')));
								  echo $this->Form->input('message',array('label'=>__l('YOUR MESSAGE')));	
								  echo $this->Form->input('friend_name',array('label'=>__l('RECEIVER NAME')));
								  echo $this->Form->input('friend_mail',array('label'=>__l('RECEIVER MAIL')));
								  echo $this->Form->input('contact_no',array('label' => __l('RECEIVER TEL (MOBILE)')));
								  echo $this->Form->input('contact_no1',array('label' => __l('RECEIVER TEL (HOME)'))); 
							?>                            
                        </div>
                        <div class="gw-box-left">
                        	<h3><?php echo __l('Shipping Information'); ?></h3>
								<?php
									echo $this->Form->input('address',array('label'=> __l('ADDRESS 1'),'type'=>'text','info'=>__l('Unit/House Number 
')));
									echo $this->Form->input('address1',array('label'=> __l('ADDRESS 2'),'type'=>'text','info'=>__l('Street Name/Residential Name'
)));
									echo $this->Form->input('address2',array('label'=> __l('ADDRESS 3'),'type'=>'text','info'=>__l('Residential Name 
')));
									echo $this->Form->input('zip_code',array('label' => __l('POST CODE'))); 
									echo $this->Form->input('state_id');
									echo $this->Form->input('country_id',array('default'=>143)); 
									?>
									<div class="hide"><?php echo $this->Form->input('slug',array('value'=>$packages[0]['Package']['slug'],'type'=>'text','id'=>'js-subscription-plan')); ?></div>
                        </div>
                     <div class="clear"></div> 
                     <div class="table-data">
                         	<ul id="gift-data">
                            	<li class="t-head">
                                	<div class="t-c1"><h3><?php echo __l('Subscription Package Details'); ?></h3></div>
                                    <div class="t-c2"></div>
                                    <div class="clear"></div>
                                </li>
                                <li class="t-data">
                                	<div class="t-c1">
                                    	<p><label><?php echo __l('PACKAGE NAME'); ?></label> <span class="js-payment-month"><?php echo($packages[0]['PackageType']['name']); ?></span></p>
                                        <p><label><?php echo __l('PACKAGE AMOUNT'); ?></label><span class="js-payment-cost"> <?php echo Configure::read('site.currency'); ?><?php echo($packages[0]['Package']['cost']); ?></span></p>
                                    </div>
									
                                    <div class="t-c2"><?php echo $this->Form->submit(__l('Next'),array('class'=>'pay-btn1','div'=>'input'));?></div>
                                  <div class="clear"></div>
                                </li>
                                
                            </ul>
                         </div>
						<?php echo $this->Form->end();?>
                    </div>
                </div>
            </div>