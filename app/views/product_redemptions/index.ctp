            <div class="body">
				<!-- Brand Logo Sec  -->
                <div class="product_redeem">
               		<p><?php echo $this->Html->image('redeem_banner.jpg',array('width'=>'947','height'=>'95')); ?></p>
                    <h3><?php echo __l('Product Redemption'); ?></h3>
					<?php
					if (!empty($productRedemptions)):
					$i = 1;
					foreach ($productRedemptions as $productRedemption):
						$class = null;
						if($i == 2)
							$class = 'mrl';
					?>
                    <div class="pro-red-box <?php echo $class; ?>">
                        <div class="reddeem-box">
                            <p><?php echo $this->Html->showImage('ProductRedemption',  $productRedemption['Attachment'][0], array('dimension' => 'productredemption_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($productRedemption['ProductRedemption']['name'], false)), 'title' => $this->Html->cText($productRedemption['ProductRedemption']['name'], false)));?></p>
                            <p><?php   $status = $this->Html->checkProductRedeemStatus($productRedemption['ProductRedemption']['id'],$this->Auth->user('id')); 
											if($status =='Completed'):
												echo '<a class="redeem-complete">Completed</a>';
											else:
												echo $this->Html->link(__l('Redeem'), array('controller' => 'product_redemptions', 'action' => 'redeem', $productRedemption['ProductRedemption']['slug']),array('class'=>'redeem-now','title' =>__l('Redeem'), 'escape' => false));
											endif;
									      echo $this->Html->link(__l('What\'s Inside'), array('controller' => 'product_redemptions', 'action' => 'view', $productRedemption['ProductRedemption']['slug']),array('class'=>'what-inside','title' =>__l('What\'s Inside'), 'escape' => false));
							?></p>
                        </div>
                        <div class="set-box">
                            <h4 class="set-head"><?php echo $this->Html->cText($productRedemption['ProductRedemption']['name'],false);?></h4>
                            <label><?php echo __l('WHAT\'S'); ?> <br /><?php echo __l('INSIDE'); ?></label>
                            <span><?php if(!empty($productRedemption['RelatedProduct'])):
										foreach($productRedemption['RelatedProduct'] as $relatedProduct):
											echo $this->Html->cText($relatedProduct['name'],false).', ';
										endforeach;
										echo $this->Html->link(__l('&raquo; Read more'), array('controller' => 'product_redemptions', 'action' => 'view', $productRedemption['ProductRedemption']['slug']),array('title' =>__l('Read More'), 'escape' => false));
									 endif; ?> </span>
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