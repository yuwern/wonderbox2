           		<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                       	<div class="acc-subs">
                        	<h3><?php echo __l('Please select the survey you would like to complete to earn more WonderPoints!'); ?></h3>
								<?php
								if(!empty($months)):
								echo $this->Form->create('Product', array('controller'=>'products','action' => 'survey'));
								echo $this->Form->input('month', array('type' => 'select','options'=> $months,'label'=>'Wonder Edition for','class'=>'js-autosubmit'));
								echo $this->Form->end();
								endif;	?>
							<?php echo $this->element('paging_counter');?>
                        	<div class="table-data">
                         	<ul id="ship-in" class="pro-serv">
                            	<li class="t-head">
                                	<div class="t-c1"><?php echo __l('Brand'); ?></div>
                                    <div class="t-c2"><?php echo __l('Product'); ?> </div>
                                    <div class="t-c3"><?php echo __l('WonderPoints'); ?> </div>
                                    <div class="t-c4"><?php echo __l('Survey'); ?></div>
                                    <div class="clear"></div>
                                </li>
								<?php
									if (!empty($months) && !empty($products)):

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
                                    <div class="t-c3"><?php echo $this->Html->cInt($product['Product']['wonder_point']); ?></div>
                                    <div class="t-c4"><?php	if(strtotime($product['Product']['end_date']) >= strtotime(date('Y-m-d'))):
														$status = $this->Html->checkProductSurveyStatus($product['Product']['id'],$this->Auth->user('id')); 
															if($status =='Completed'):
															echo '<span  class="red">Completed</span>';
															else:
															echo $this->Html->link(__l('Complete this Survey '), array('controller' => 'products', 'action' => 'quiz', $product['Product']['slug']),array('title' =>__l('Complete this Survey '),'class'=>'btn1', 'escape' => false));
															endif;
													else:
														 echo '<span class="red">Closed</span>';
													endif;
											?>	
								  </div>
                                  <div class="clear"></div>
							 </li>    

					<?php
						endforeach;
					else:
					?>
						<li class="t-data">	<p><?php echo __l('No Open survey for month\'s Wonder Edition');?></p>
						<div class="clear"></div>
						</li>
					<?php
					endif;
					?>
                            </ul>
							<?php
						/*	if (!empty($months) &&!empty($products)) {
								echo $this->element('paging_links');
							}
						*/	?>
                         </div>
                        </div>
                    </div>
				<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>