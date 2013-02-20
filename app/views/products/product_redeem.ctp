			<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('Beauty Account'); ?></h1>
                            <p> <?php echo __l('Account copywriting text, temporary text, layout format, copywriting text, temporary text, layout format.'); ?></p>
                        </div>
                       	<div class="acc-subs">
                        	<h3><?php echo __l('My Product Redeem'); ?></h3>
							<?php echo $this->element('paging_counter');?>
                        	<div class="table-data">
                         	<ul id="ship-in">
                            	<li class="t-head">
                                	<div class="t-c1"><?php echo __l('Brand'); ?></div>
                                    <div class="t-c2"><?php echo __l('Product'); ?> </div>
                                    <div class="t-c3"><?php echo __l('Redeem WonderPoints'); ?> </div>
                                    <div class="t-c4"><?php echo __l('Redeem'); ?></div>
                                    <div class="clear"></div>
                                </li>
								<?php
									if (!empty($products)):

									$i = 0;
									foreach ($products as $product):
										$class = null;
										if ($i++ % 2 == 0) {
											$class = ' class="altrow"';
										}
								?>
								<li class="t-data">
                                	<div class="t-c1"><?php echo $this->Html->cText($product['Brand']['name'],false); ?></div>
                                    <div class="t-c2"><?php echo $this->Html->truncate($product['Product']['name'],25, array('ending' => '...')); ?> </div>
                                    <div class="t-c3"><?php echo $this->Html->cInt($product['Product']['redeem_wonder_point']); ?></div>
                                    <div class="t-c4"><?php	if(strtotime($product['Product']['end_date']) >= strtotime(date('Y-m-d'))):
									$status = $this->Html->checkProductRedeemStatus($product['Product']['id'],$this->Auth->user('id')); 
										if($status =='Completed'):
												echo '<span  class="red">Completed</span>';
											else:
												echo $this->Html->link(__l('Redeem'), array('controller' => 'products', 'action' => 'redeem', $product['Product']['slug']),array('title' =>__l('Redeem'),'class'=>'btn1', 'escape' => false));
												endif;
										 else:
											 echo '<span class="red">Closed</span>';
										 endif;
											?>		</div>
                                  <div class="clear"></div>
							 </li>    

					<?php
						endforeach;
					else:
					?>
						<li class="t-data"><div class="t-c1"><?php echo __l('No Product Redemption');?></div>
						</li>
					<?php
					endif;
					?>
                            </ul>
							<?php
							if (!empty($products)) {
								echo $this->element('paging_links');
							}
							?>
                         </div>
                        </div>
                    </div>
				<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>