            <div class="body">
				<!-- Brand Logo Sec  -->
                <div class="product_redeem">
               		<p><?php echo $this->Html->image('redeem_banner.jpg',array('width'=>'947','height'=>'95')); ?></p>
                    <h3><?php echo __l('Welcome to WonderShop'); ?></h3>
					<?php
					if (!empty($productRedemptions)):
					$i = 1;
					foreach ($productRedemptions as $productRedemption):
						$class = null;
						/*if($i == 2)
							$class = 'mrl'; */
					?>
                    <div class="pro-red-box <?php echo $class; ?>">
                        <div class="reddeem-box">
						<div class="prod_img">
                            <p><?php echo $this->Html->showImage('ProductRedemption',  $productRedemption['Attachment'][0], array('dimension' => 'productredemption_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($productRedemption['ProductRedemption']['name'], false)), 'title' => $this->Html->cText($productRedemption['ProductRedemption']['name'], false)));?></p>
	
							<div class="redeem-bghover"><h4><?php echo __l('Number Of Boxes Left'); ?></h4> </div>
							<div class="redeem-bghovercont"> <?php 
							$total_quantity = $this->Html->checkProductRedeemProductQuantity($productRedemption['ProductRedemption']['id'],$productRedemption['ProductRedemption']['quantity']);
							if( $total_quantity> 0): ?>
							<?php echo $total_quantity; ?>
							<?php else: ?>
							<?php echo __l('No longer available'); ?>
							<?php endif; ?>
							</div>
							</div>
                            <p><?php   if($total_quantity > 0 ) :
										$status = $this->Html->checkProductRedeemStatus($productRedemption['ProductRedemption']['id'],$this->Auth->user('id')); 
											if($status =='Completed'):
												echo '<a class="redeem-complete">Completed</a>';
											else:
												echo $this->Html->link(__l('Redeem'), array('controller' => 'product_redemptions', 'action' => 'redeem', $productRedemption['ProductRedemption']['slug']),array('class'=>'redeem-now','title' =>__l('Redeem'), 'escape' => false));
											endif;
										else:
											echo '<a class="redeem-no-longer-avialable">No longer avialable</a>';
									    endif;
									      echo $this->Html->link(__l('What\'s Inside'), array('controller' => 'product_redemptions', 'action' => 'view', $productRedemption['ProductRedemption']['slug']),array('class'=>'what-inside','title' =>__l('What\'s Inside'), 'escape' => false));
							?></p>
                        </div>
                        <div class="set-box">
                            <h4 class="set-head"><?php echo $this->Html->cText($productRedemption['ProductRedemption']['name'],false);?></h4>
                            <label><?php echo __l('REDEEM WITH'); ?></label>
                            <span class="wonder-points"><?php echo __l('WonderPoints :'); ?> <?php echo $this->Html->cInt($productRedemption['ProductRedemption']['redeem_wonder_point'],false);?> </span>
                        </div>
					    <div class="set-box-purchase bor-top-none">
						<?php if(!empty($productRedemption['ProductRedemption']['is_purchase'])):
								if($total_quantity > 0 ) :
									echo $this->Html->link(__l('Purchase Now For').' '. configure::read('site.currency').'  '.$productRedemption['ProductRedemption']['purchase_amount'], array('controller' => 'product_redemptions', 'action' => 'buy', $productRedemption['ProductRedemption']['slug']),array('title' =>__l('Purchase Now For').' '. configure::read('site.currency').'  '.$productRedemption['ProductRedemption']['purchase_amount'],'class'=> 'btn1 d-block', 'escape' => false));
								else:
									echo '<p class="no-purchase-option">No longer avialable</p>';
								endif;
							 else:?>
								<p class="no-purchase-option"><?php 	echo __l('NOT FOR SALE'); 	 ?></p>
							<?php
							 endif;
								?>
						</div>

                    </div>
					<?php
					$i++;
						endforeach;
					else:
					?>
					<p class="notice"><?php echo __l('No Product Redemptions available');?></p>
					<?php
					endif;
					?>
					<div class="clearfix"></div>
					<?php
				/*	if (!empty($productRedemptions)) {
						echo $this->element('paging_links');
					}
				*/	?>
                 
          		</div>
            </div>