		<div class="submission">
                	<div class="submis-left"><?php echo $this->Html->image('submission_ad.jpg'); ?></div>
                    <div class="submis-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name');?> <?php echo __l('Product Redemption Checkout'); ?></h1>
                        </div>
						<div class="step-bor end2">
                        	<ul>
                                <li class="off1">SHIPPING DETAIL </li>
                                <li class="select">CHECK OUT</li>
                            </ul>
                        </div>
                        <div class="shipp-left">
                        	<div class="shipp-box">
                            	<h3><?php echo __l('Subscription Package details'); ?></h3>
                                <ul>
                                	<li><?php echo __l('Name');?></li><li class="font-tahoma"> <?php echo $productRedemption['ProductRedemption']['name'];?></li>
                                    <li><?php echo __l('Package Amount');?></li><li class="font-tahoma">&nbsp;&nbsp;  <?php echo  configure::read('site.currency'); ?><?php echo $this->Html->cFloat( $productRedemption['ProductRedemption']['purchase_amount']); ?> </li>
                                </ul>
							</div>
							<div class="shipp-right">
								<?php $this->Gateway->$action($gateway_options); ?>
							</div>
                                                         
                        </div>                        
                    </div>
                </div>