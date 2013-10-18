		<div class="Subscription">
                	<div class="subs-left"><?php echo $this->Html->image('subscribe_now.jpg'); ?></div>
                    <div class="subs-right">
                    	<div class="head">
                        	<h1><?php echo __l('Subscribe now!'); ?></h1>
                            <p><?php echo __l('Don\'t miss out! Only limited boxes available every month. Please subscribe to our Facebook page to be notified when we launch a new WonderBox edition.'); ?></p>
<p><?php echo __l('As only a limited number of WonderBoxes will be produced every month, WonderBoxes will be allocated on a first come first serve basis.'); ?></p>
                        </div>
                       	<div class="step-bor">
                        	<ul>
                            	<li class="select"><?php echo __l('PLAN'); ?> &amp; <?php echo __l('PAYMENT METHOD'); ?></li>
                                <li class="off"><?php echo __l('SHIPPING DETAIL'); ?> </li>
                                <li><?php echo __l('CHECK OUT'); ?></li>
                            </ul>
                        </div>
                        <h2><?php echo __l('1. Select your subscription plan'); ?></h2>

						<?php 
						if(!empty($packages)):
						$i = 1;
						foreach($packages as $package):
						$class = 'm-right18';
						if($i == 2)
							$class = null;
						?>
                        <div class="pay-box <?php echo $class; ?>">
                       	  <h1><?php echo $package['PackageType']['name']; ?></h1>
                          <h2><?php echo  configure::read('site.currency'); ?><?php echo $package['Package']['cost']; ?></h2>
                          <span><?php echo __l('for'); ?> <?php echo $package['PackageType']['no_of_months']; ?> <?php echo __l('WonderBox Edition'); ?></span>
                          <p><?php echo __l('WonderPoints earned:'); ?> <?php echo $package['Package']['no_of_wonderpoints']; ?></p>
						 <?php if($i== 1): ?>
							 <p class="align-left"><a title="Selected" rel="<?php echo $package['Package']['slug'].'||'.$package['Package']['cost'].'||'.$package['PackageType']['no_of_months']; ?>" class="js-payment-plan select-on" id="js-plan-<?php echo $package['Package']['id']; ?>"><?php echo __l('Selected'); ?></a></p>
							 <?php else: ?>
							 <p class="align-left"><a title="Selected" rel="<?php echo $package['Package']['slug'].'||'.$package['Package']['cost'].'||'.$package['PackageType']['no_of_months']; ?>" class="js-payment-plan select-off" id="js-plan-<?php echo $package['Package']['id']; ?>"><?php echo __l('Select'); ?></a></p>
							 <?php endif; ?>

                        </div>
						<?php $i++;
						endforeach; 
						endif;
						?>
                       <h2><?php echo __l('2. Select your payment method'); ?></h2>
						<?php echo $this->Form->create('Package', array('action'=>'paypal','class' => 'normal-form'));?>	
						 <div class="paypal-box">
							<?php echo $this->Form->input('package_type_id',array('options'=>$paymentgateways,'type'=>'radio','default'=>2,'class'=>'js-payment-options','legend' => false)); ?> 
<!--		<div class="pb-left">
					            <p><?php echo __l('You will be billed'); ?>  <?php echo Configure::read('site.currency'); ?> <span class="js-payment-cost"><?php echo($packages[0]['Package']['cost']); ?></span> <?php echo __l('every'); ?> <span class="js-payment-month"><?php echo($packages[0]['PackageType']['no_of_months']); ?></span> <?php echo __l('month(s)'); ?></p>
                                <p><?php echo $this->Html->image('paypal.jpg'); ?></p>
                            </div> -->
                            <div class="paypal-box">
                                <p><?php echo __l('You will be billed'); ?>  <?php echo Configure::read('site.currency'); ?><span class="js-payment-cost"> <?php echo($packages[0]['Package']['cost']); ?></span> <?php echo __l('for'); ?> <span class="js-payment-month"><?php echo($packages[0]['PackageType']['no_of_months']); ?></span> <?php echo __l('WonderBox Edition subscription only.'); ?></p>
                                <p><?php echo $this->Html->image('visa.jpg'); ?></p>
                            </div>
						<div class="hide"><?php echo $this->Form->input('slug',array('value'=>$packages[0]['Package']['slug'],'type'=>'text','id'=>'js-subscription-plan')); ?></div>
					   	</div>
						<div class="align-Center" ><?php echo $this->Form->submit(__l('Next'),array('class'=>'next-btn','div'=>'input'));?></div>

					  <?php echo $this->Form->end();?>
                     </div>
                </div>
