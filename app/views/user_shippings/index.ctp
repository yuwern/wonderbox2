		      	<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('Shipping Address'); ?></h1>
                        </div>
                       	<div class="acc-shipp-info">
                        	<h3><?php echo __l('Shipping Information'); ?></h3>
                        	<div class="table-data">
                         	<ul id="ship-in">
                            	<li class="t-head">
                                	<div class="t-c1"><?php echo __l('Country'); ?></div>
                                    <div class="t-c2"><?php echo __l('Address'); ?></div>
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
									<div class="t-c1"><?php echo $this->Html->cText($userShipping['Country']['name'],false); ?></div>
                                    <div class="t-c2"><?php echo $this->Html->cText($userShipping['UserShipping']['address'],false); ?>, <?php echo $this->Html->cText($userShipping['UserShipping']['address2'],false); ?>, <?php echo $this->Html->cText($userShipping['UserShipping']['address3'],false); ?>, <?php echo $this->Html->cText($userShipping['State']['name'],false); ?>, <?php echo $this->Html->cText($userShipping['Country']['name'],false); ?> <?php echo $this->Html->cText($userShipping['UserShipping']['zip_code'],false); ?> </div>
                                    <div class="t-c3"><span><?php echo $this->Html->link(__l('Edit'), array('controller' => 'user_shippings', 'action' => 'edit',$userShipping['UserShipping']['id']),array('title' => __l('Edit'),'class'=>'btn1')); ?></span></div>
                                  <div class="clear"></div>
								  </li>
								 <?php
									endforeach;
								else:
								?>
								  <li class="t-data">
                                	<div class="t-c1"><span><?php echo __l('No Shipping information available'); ?></span></div>
									<div class="t-c2">&nbsp;</div>
									<div class="t-c3"><span><?php echo $this->Html->link(__l('Add'), array('controller' => 'user_shippings', 'action' => 'add'),array('title' => __l('Add'),'class'=>'btn1')); ?></span></div>
                                  <div class="clear"></div>
                                </li>
                            	<?php endif; ?>
                            </ul>
                         </div>
                        </div>                        
                    </div>
			<?php if(empty($this->request->params['isAjax']) ): ?>
			</div>
			<?php endif; ?>