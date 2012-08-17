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
								<?php if(!empty($user['UserProfile']['address']) ): ?>
                                <li class="t-data">
                                	<div class="t-c1"><?php echo $this->Html->cText($user['Country']['name']); ?></div>
                                    <div class="t-c2"><?php echo $this->Html->cText($user['UserProfile']['address']); ?><br /><?php echo $this->Html->cText($user['State']['name']); ?>, <?php echo $this->Html->cText($user['Country']['name']); ?> <?php echo $this->Html->cText($user['UserProfile']['zip_code']); ?> </div>
                                    <div class="t-c3"><span><?php echo $this->Html->link(__l('Edit'), array('controller' => 'user_profiles', 'action' => 'shipping'),array('title' => __l('Edit'),'class'=>'btn3')); ?></span></div>
                                  <div class="clear"></div>
                                </li>
                                <?php else: ?>
							    <li class="t-data">
                                	<div class="t-c1"><span><?php echo __l('No Shipping information avialable'); ?></span></div>
									<div class="t-c3"><span><?php echo $this->Html->link(__l('Add'), array('controller' => 'user_profiles', 'action' => 'shipping'),array('title' => __l('Add'),'class'=>'btn3')); ?></span></div>
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
                 