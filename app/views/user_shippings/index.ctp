	<?php if(empty($this->request->params['isAjax']) ): ?>	<div class="my-account">
      				<?php echo $this->element('user-sidebar'); ?>
            	<div class="my-account-right">
				<?php endif; ?>
				<h1>Shipping Information</h1>
                    <div class="shipping-info">
                        	<div class="table-data">
                         	<ul id="ship-in">
                            	<li class="t-head">
                                	<div class="t-c1">Country</div>
                                    <div class="t-c2">Address</div>
                                    <div class="t-c3">&nbsp;</div>
                                    <div class="clear"></div>
                                </li>
								<?php
									if (!empty($userShippings)):

									$i = 0;
									foreach ($userShippings as $userShipping):
										$class = null;
										if ($i++ % 2 == 0) {
											$class = ' class="altrow"';
										}
									?>
									<li class="t-data">
                                	<div class="t-c1"><?php echo $this->Html->cText($userShipping['Country']['name']); ?></div>
                                    <div class="t-c2"><?php echo $this->Html->cText($userShipping['UserShipping']['address']); ?><br /><?php echo $this->Html->cText($userShipping['State']['name']); ?>, <?php echo $this->Html->cText($userShipping['Country']['name']); ?> <?php echo $this->Html->cText($userShipping['UserShipping']['zip_code']); ?> </div>
                                    <div class="t-c3"><span><?php echo $this->Html->link(__l('Edit'), array('controller' => 'user_shippings', 'action' => 'edit',$userShipping['UserShipping']['id']),array('title' => __l('Edit'),'class'=>'btn3')); ?></span></div>
                                  <div class="clear"></div>
                                </li>
                              <?php
									endforeach;
								else:
								?>
							    <li class="t-data">
                                	<div class="t-c1"><span><?php echo __l('No Shipping information available'); ?></span></div>
									<div class="t-c2">&nbsp;</div>
									<div class="t-c3"><span><?php echo $this->Html->link(__l('Add'), array('controller' => 'user_shippings', 'action' => 'add'),array('title' => __l('Add'),'class'=>'btn3')); ?></span></div>
                                  <div class="clear"></div>
                                </li>
                            
								<?php endif; ?>
                            </ul>
                         </div>
     </div>
	 <?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>    
            </div>	
		<?php endif; ?>