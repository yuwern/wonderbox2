			<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('Product Redemption Lists'); ?></h1>
                        </div>
                       	<div class="acc-trans">
                        	<h3><?php echo __l('Product Redemption Lists'); ?></h3>
							<?php echo $this->element('paging_counter');?>
                        	<div class="table-data">
                         	<ul id="ship-in">
                            	<li class="t-head">
                                	<div class="t-c1"><?php echo __l('DATE'); ?> </div>
                                    <div class="t-c2"><?php echo __l('PRODUCT NAME'); ?> </div>
                                    <div class="t-c3"><?php echo __l('WONDER POINTS'); ?> </div>
                                    <div class="t-c4"><?php echo __l('TRACKING NUMBER'); ?> </div>
                                    <div class="t-c5"><?php echo __l('GO'); ?></div>
                                   <div class="clear"></div>
                                </li>
							    <?php
									if (!empty($productRedemptionUsers)):

									$i = 0;
									foreach ($productRedemptionUsers as $productRedemptionUser):
										$class = null;
										if ($i++ % 2 == 0) {
											$class = ' class="altrow"';
										} ?>
									<li class="t-data">
										<div class="t-c1"><?php  echo  date("j F Y",strtotime($productRedemptionUser['ProductRedemptionUser']['created']));  ?></div>
										<div class="t-c2"><?php  echo  $this->Html->cText($productRedemptionUser['ProductRedemption']['name'],false);  ?></div>
										<div class="t-c3"><?php  echo  $this->Html->cText($productRedemptionUser['ProductRedemption']['redeem_wonder_point'],false);  ?>	</div>
										<div class="t-c4"><?php if(!empty($productRedemptionUser['ProductRedemptionUser']['tracking_number'])): 
																echo $this->Html->cText($productRedemptionUser['ProductRedemptionUser']['tracking_number']);
															else: 
																echo __l('Nil');
														   endif; ?></div>
										<div class="t-c5"><?php  if(!empty($productRedemptionUser['ProductRedemptionUser']['tracking_number'])): 
																echo $this->Html->link(__l('Go'),'http://203.106.236.200/official/etracking.php', array( 'title' => __l('Go'),'target'=>'_blank', 'class'=>"btn1"));
															 else:
															  echo "---";
															 endif; ?></div>
										<div class="clear"></div>
									</li>
								<?php
									endforeach;
									else:
								?>
									 <li class="t-data">
										<div class="t-no-result"><?php echo __l('No Product Redemption List available');?></div><div class="clear"></div>
									 </li>
								<?php
								endif;
								?>
                            </ul>
                         </div>
						   <?php
							if (!empty($transactions)) {
								?>
									<div class="js-pagination">
										<?php echo $this->element('paging_links'); ?>
									</div>
								<?php
							}
							?>
                        </div>
                        
                    </div>
           <?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>