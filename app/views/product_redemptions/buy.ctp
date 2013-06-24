             		<div class="submission">
                	<div class="submis-left"><?php echo $this->Html->image('submission_ad.jpg'); ?></div>
                    <div class="submis-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name');?> <?php echo __l('Product Redemption Checkout'); ?></h1>
                        </div>
                       	<div class="step-bor">
                        	<ul>
                                 <li class="select"><?php echo __l('SHIPPING DETAIL'); ?></li>
                                <li><?php echo __l('CHECK OUT'); ?></li>
                            </ul>
                        </div>
                        <div class="shipp-left">
                        	<div class="shipp-box">
                            	<h3><?php echo __l('Subscription'); ?></h3>
                                <ul>
                                	<li><?php echo __l('Name');?></li><li class="font-tahoma"> :  <?php echo $productRedemption['ProductRedemption']['name'];?></li>
                                	                               
                                </ul>
								<br/>
                                <h3><?php echo __l('First Billing'); ?></h3>
                               <ul>
                                	<li><?php echo __l('DATE'); ?></li><li class="font-tahoma"><?php echo date('d M Y',strtotime('now')); ?></li>
                                    <li><?php echo __l('AMOUNT'); ?></li><li class="font-tahoma"><?php echo Configure::read('site.currency'). '  '. $productRedemption['ProductRedemption']['purchase_amount'];?></li>
                                </ul>
                            </div>
                            <p><?php echo __l('Lorem Ipsum is simply dummy text of the printing and typesetting industry.:'); ?></p>
                                <ul class="font-tahoma">
                                	<li><?php echo __l('Lorem Ipsum is simply dummy text of the printing and typesetting industry.'); ?></li>
                                    <li><?php echo __l('Lorem Ipsum is simply dummy text of the printing and typesetting industry.'); ?></li>
                                    <li><?php echo __l('Lorem Ipsum is simply dummy text of the printing and typesetting industry.'); ?></li>
                                    <li><?php echo __l('Lorem Ipsum is simply dummy text of the printing and typesetting industry.'); ?></li>
                                </ul>
                        </div>
                        <div class="shipp-right">
                        	<h3><?php echo __l('Contact Information'); ?></h3>
						 	<?php echo $this->Form->create('ProductRedemption', array('action'=>'checkout','class' => 'normal-form'));?>
							<?php	echo $this->Form->input('slug',array('type'=>'hidden','value'=>$productRedemption['ProductRedemption']['slug']));echo $this->Form->input('UserShipping.id');?>
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
							<?php echo $this->Form->submit(__l('Next'),array('class'=>'btn1'));?>
							<?php echo $this->Form->end();?>
                        </div>
                    </div>
                </div>