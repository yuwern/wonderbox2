	<div class="subs-checkout">
            <h1>Wonderbox Subscription Checkout</h1>
            	<div class="subs-checkout-left">
                	<h2>Subsciption</h2>
                    <ul>
                    	<li><label><?php echo __l('Package Name:'); ?></label><span> <?php echo $package['Package']['name'];?></span></li>
                        <li><label><?php echo __l('Plan:'); ?></label><span> <?php echo $package['PackageType']['name'];?></span></li>
                        <li><label><?php echo __l('Billing Cycle:'); ?></label><span><?php echo __l('Every Billing Cycle');?></span></li>
						<?php if(!empty($package['Package']['no_of_wonderpoints'])): ?>
                        <li><label><?php echo __l('Billing Amount:'); ?></label><span><?php echo __l('Earn').' '.$package['Package']['no_of_wonderpoints'].' '. __l('Wonder Points Every Billing Cycle');?></span></li>
						<?php endif; ?>	
                    </ul>
                    <h2>First Billing</h2>
                    <ul>
                    	<li><label>Date:</label><span><?php echo date('d M Y',strtotime('now')); ?></span></li>
                        <li><label><?php echo __l('Amount:'); ?></label><span><?php echo Configure::read('site.currency'). '  '. $package['Package']['cost'];?></span></li>
                        
                    </ul>
                </div>
            	<div class="subs-checkout-right">
                	<h2>Contact Information</h2>
                   	<?php echo $this->Form->create('Package', array('action'=>'purchase','class' => 'normal-form'));?>
				    <ul>
                   						
                        	<li><?php echo $this->Form->input('User.email',array('value'=>$this->Auth->user('email'),'readonly'=>'readonly'));?><?php	echo $this->Form->input('slug',array('type'=>'hidden','value'=>$package['Package']['slug']));echo $this->Form->input('UserShipping.id');?>
                            </li>
						    <li>
                            <?php
							echo $this->Form->input('UserShipping.contact_no',array('label' => __l('Mobile Number'))); ?>
                            </li>
                            <li>
							<?php echo $this->Form->input('UserShipping.contact_no1',array('label' => __l('Home Number'))); ?>
                            </li>
                            
                        </ul>
                        <h2>Shipping Information</h2>
                        <ul>
                        	<li>
                            	<?php	echo $this->Form->input('UserShipping.address',array('type'=>'textarea'));?>
                            </li>
                            <li>
                            	<?php	echo $this->Form->input('UserShipping.zip_code');?>
                            </li>
							<li>
                            	<?php	echo $this->Form->input('UserShipping.state_id');?>
                            </li>
							 <li>
                            	<?php	echo $this->Form->input('UserShipping.country_id',array('default'=>143));?>
                            </li>
							
                            <li id="paypalid">
                            	<?php
								 echo $this->Form->input('package_type_id',array('type'=>'hidden','value'=>$package_type));
								?>
							</li>
                      		 <li>
                            	<span><label for="ReTypePassword">&nbsp;</label></span>
                                <span><?php echo $this->Form->submit(__l('Subscribe'),array('class'=>'btn3'));?></span>
                            </li>
                                
                        </ul>
                        <?php echo $this->Form->end();?>
                </div>
               </div>
                
                
            