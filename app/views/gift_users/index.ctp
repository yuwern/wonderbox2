    	<div class="acc-trans">
		<?php echo $this->element('paging_counter');?>
                        	<div class="table-data">
                         	<ul id="ship-in">
                            	<li class="t-head">
                                	<div class="t-c1"><?php echo __l('Purchased Date'); ?></div>
                                    <div class="t-c2"><?php echo __l('Amount'); ?> </div>
                                    <div class="t-c3"><?php echo __l('Send To'); ?> </div>
                                    <div class="t-c4"><?php echo __l('Message'); ?></div>
                                    <div class="clear"></div>
                                </li>
								<?php
									if (!empty($giftUsers)):

									$i = 0;
									foreach ($giftUsers as $giftUser):
										$class = null;
										if ($i++ % 2 == 0) {
											$class = ' class="altrow"';
										}
								?>
								<li class="t-data">
                                	<div class="t-c1"><?php echo $this->Html->cText($giftUser['GiftUser']['created'],false);?></div>
                                    <div class="t-c2"><?php echo Configure::read('site.currency'). '  '. $this->Html->cText($giftUser['Package']['cost']);?></div>
                                    <div class="t-c3"><?php echo $this->Html->cText($giftUser['GiftUser']['friend_name']);?></div>
                                    <div class="t-c4"><?php echo $this->Html->cText($giftUser['GiftUser']['message']);?></div>
                                  <div class="clear"></div>
							 </li>    

					<?php
						endforeach;
					else:
					?>
						<li class="t-data"><div  class="t-no-result"><?php echo __l('No Gift Subscriptions available');?></div><div class="clear"></div>
						</li>
					<?php
					endif;
					?>
                         </ul>
							<?php
							if (!empty($giftUsers)) {
								echo $this->element('paging_links');
							}
							?>
                         </div>
				</div>		  