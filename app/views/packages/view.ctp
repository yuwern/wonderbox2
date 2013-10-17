             		<div class="submission">
                	<div class="submis-left"><?php echo $this->Html->image('submission_ad.jpg'); ?></div>
                    <div class="submis-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name');?> <?php echo __l('Subscription Checkout'); ?></h1>
                            <p><?php echo __l('Submission copywriting text, temporary text, layout format, copywriting text, temporary text, layout format.'); ?></p>
                        </div>
                       	<div class="step-bor">
                        	<ul>
                            	<li class="off1"><?php echo __l('PLAN'); ?> &amp; <?php echo __l('PAYMENT METHOD'); ?></li>
                                <li class="select"><?php echo __l('SHIPPING DETAIL'); ?></li>
                                <li><?php echo __l('CHECK OUT'); ?></li>
                            </ul>
                        </div>
                        <div class="shipp-left">
                        	<div class="shipp-box">
                            	<h3><?php echo __l('Subscription'); ?></h3>
                                <ul>
                                	<li><?php echo __l('Package Name');?></li><li class="font-tahoma"> <?php echo $package['Package']['name'];?></li>
                                    <li><?php echo __l('Plan');?></li><li class="font-tahoma"><?php echo $package['PackageType']['name'];?></li>
                                    <li><?php echo __l('Billing Cycle');?></li><li class="font-tahoma"><?php 
									if(!empty($package_type) && $package_type == ConstPaymentGateways::MOLPay):
									 echo __l('Not Applicable');
									else:
									 echo __l('Every Billing Cycle');
									endif;	?>
									</li>	
                                </ul>
                                <h3><?php echo __l('First Billing'); ?></h3>
                                <ul>
                                	<li><?php echo __l('DATE'); ?></li><li class="font-tahoma"><?php echo date('d M Y',strtotime('now')); ?></li>
                                    <li><?php echo __l('AMOUNT'); ?></li><li class="font-tahoma"><?php echo Configure::read('site.currency'). '  '. $package['Package']['cost'];?></li>
                                </ul>
                            </div>
                            <p><?php echo __l('Earn more WonderPoints with longer subscriptions:'); ?></p>
                                <ul class="font-tahoma">
                                	<li><?php echo __l('Be rewarded with WonderPoints with quarterly, bi-annual or annual subscriptions.'); ?></li>
                                    <li><?php echo __l('Receive your WonderPoints immediately upon completing your subscription.'); ?></li>
                                    <li><?php echo __l('Use WonderPoints to extend your WonderBox subscription by 1 month for 800 WonderPoints.'); ?></li>
                                    <li><?php echo __l('Redeem a WonderBox as a giftbox to your friend by using WonderPoints.'); ?></li>
                                </ul>
                        </div>
                        <div class="shipp-right">
                        	<h3><?php echo __l('Contact Information'); ?></h3>
						 	<?php echo $this->Form->create('Package', array('action'=>'purchase','class' => 'normal-form'));?>
							<?php	echo $this->Form->input('slug',array('type'=>'hidden','value'=>$package['Package']['slug']));echo $this->Form->input('UserShipping.id');?>
							<?php	$first_name = $this->request->data['User']['UserProfile']['first_name'];
							echo $this->Form->input('UserProfile.first_name',array('value'=>!empty($first_name)? $first_name:' ','label' => __l('First Name'))); ?>
							<?php  $last_name = $this->request->data['User']['UserProfile']['last_name'];
							echo $this->Form->input('UserProfile.last_name',array('value'=>!empty($last_name)? $last_name:' ','label' => __l('Last Name'))); ?>
							<?php echo $this->Form->input('UserShipping.contact_no',array('label' => __l('Mobile'))); ?>
                            <?php echo $this->Form->input('UserShipping.contact_no1',array('label' => __l('Home'))); ?>
							<h3 class="m-top40"><?php echo __l('Shipping Information'); ?></h3>
							<?php	echo $this->Form->input('UserShipping.address',array('label'=>__l('Address 1'),'info'=>__l('Unit/House Number')));?>
							<?php	echo $this->Form->input('UserShipping.address2',array('label'=>__l('Address 2'),'info'=>__l('Street Name/Residential Name')));?>
							<?php	echo $this->Form->input('UserShipping.address3',array('label'=>__l('Address 3'),'info'=>__l('Residential Name')));?>
							<?php	echo $this->Form->input('UserShipping.zip_code',array('label'=>__l('POST CODE')));?>
                            <?php	echo $this->Form->input('UserShipping.state_id');?>
							<?php	echo $this->Form->input('UserShipping.country_id',array('default'=>143));?>
							<?php   echo $this->Form->input('package_type_id',array('type'=>'hidden','value'=>$package_type)); 	?>
							<?php echo $this->Form->submit(__l('Next'),array('class'=>'btn1'));?>
							<?php echo $this->Form->end();?>
                        </div>
                    </div>
                </div>