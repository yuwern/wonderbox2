<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('WonderSpree'); ?></h1>
                            <p> <?php echo __l('Below are the WonderSpree Entries That You Have Share With Us. Thanks For Sharing!'); ?></p>
                        </div>
						
						<?php	if(empty($this->request->params['isAjax'])): ?>
						<div class="acc-subscription">
                        	<h3><?php echo __l('My WonderSpree'); ?></h3>
							<div class="add-block" style="float:right">
                           <?php echo $this->Html->link(__l('Add A WonderSpree'), array('controller' => 'wonder_sprees', 'action' => 'add'), array('title' => __l('Add A WonderSpree')));?>
                        </div>
						<?php endif; ?>

							<?php echo $this->element('paging_counter');?>
                        	<div class="table-data">
                         	<ul id="ship-in">
                            	<li class="t-head">
                                	<div class="t-c1"><?php echo __l('Amount'); ?></div>
                                    <div class="t-c2"><?php echo __l('Type'); ?> </div>
                                    <div class="t-c3"><?php echo __l('Discount Value'); ?> </div>
                                    <div class="t-c4"><?php echo __l('Location'); ?></div>
                                    <div class="t-c5"><?php echo __l('Purchase Date'); ?></div>
                                    <div class="clear"></div>
                                </li>
								<?php
								if (!empty($wonderSprees)):

								$i = 0;
								foreach ($wonderSprees as $wonderSpree):
								$class = null;
							    if ($i++ % 2 == 0) {
								$class = ' class="altrow"';
									}
								?>

								<li class="t-data">
                                	<div class="t-c1"><?php echo $this->Html->cFloat($wonderSpree['WonderSpree']['purchase_amt']);?></div>
									<div class="t-c1"><?php echo $this->Html->cText($wonderSpree['WonderSpree']['type']);?></div>
									
									<div class="t-c1"><?php if ($wonderSpree['WonderSpree']['previous_discount']== NULL)
									{
									echo 0;
									}
									else
									{
									echo $this->Html->cText($wonderSpree['WonderSpree']['previous_discount']);
									}
									?>
									</div>
									<div class="t-c1"><?php echo $this->Html->cText($wonderSpree['WonderSpree']['location']);?></div>
									<div class="t-c1"><?php echo $this->Html->cText($wonderSpree['WonderSpree']['purchase_date']);?></div>
									<div class="clear"></div>
							 </li>    

					<?php
						endforeach;
					else:
					?>
						<li class="t-data"><div class="t-no-result"><?php echo __l('No WonderSpree available');?></div> <div class="clear"></div>
						</li>
					<?php
					endif;
					?>
                            </ul>
							<?php
							if (!empty($wonderSprees)) {
								echo $this->element('paging_links');
							}
							?>
                         </div>
                        </div>
                    </div>
				<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>













