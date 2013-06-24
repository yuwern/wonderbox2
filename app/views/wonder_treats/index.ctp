		<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('Wonder Treats'); ?></h1>
                            <p> <?php // echo __l('Below are the WonderBox Edition You Are Subscribe To'); ?></p>
                        </div>
                       	<div class="acc-subscription">
                        	<h3><?php echo __l('My Wonder Treats'); ?></h3>
							<?php echo $this->element('paging_counter');?>
                        	<div class="table-data">
                         	<ul id="ship-in">
                            	<li class="t-head">
                                	<div class="t-c1"><?php echo __l('Purchase DATE'); ?></div>
                                    <div class="t-c2"><?php echo __l('BeautyTip NAME'); ?> </div>
                                    <div class="t-c3"><?php echo __l('Price'); ?> </div>
                                    <div class="t-c4"><?php echo __l('Redemption Start Date'); ?></div>
                                    <div class="t-c5"><?php echo __l('Redemption End Date'); ?></div>
                                    <div class="clear"></div>
                                </li>
								<?php
								if (!empty($wonderTreats)):

								$i = 0;
								foreach ($wonderTreats as $wonderTreat):
									$class = null;
									if ($i++ % 2 == 0) {
										$class = ' class="altrow"';
									}
								?>
								<li class="t-data">
                                	<div class="t-c1"><?php  echo  date("d F Y",strtotime($wonderTreat['WonderTreat']['purchase_date']));  ?></div>
                                    <div class="t-c2"><?php echo $this->Html->cText($wonderTreat['BeautyTip']['name']); ?></div>
                                    <div class="t-c3"><?php  echo  $this->Html->cFloat($wonderTreat['BeautyTip']['purchase_amount']);  ?></div>
                                    <div class="t-c4"><?php  echo  date("d F Y",strtotime($wonderTreat['BeautyTip']['redemption_start_date']));  ?></div>
                                    <div class="t-c4"><?php  echo  date("d F Y",strtotime($wonderTreat['BeautyTip']['redemption_end_date']));  ?></div>
                                  <div class="clear"></div>
							 </li>    

					<?php
						endforeach;
					else:
					?>
						<li class="t-data"><div class="t-no-result"><?php echo __l('No Wonder Treats available');?></div> <div class="clear"></div>
						</li>
					<?php
					endif;
					?>
                            </ul>
							<?php
							if (!empty($wonderTreats)) {
								echo $this->element('paging_links');
							}
							?>
                         </div>
                        </div>
                    </div>
				<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>