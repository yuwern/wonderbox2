		<div class="brand-main">
                	<div class="brand-left">
						<div class="head">
                        	<h1><?php echo $this->Html->cText(ucfirst($productRedemption['ProductRedemption']['name']),false); ?></h1>
                            <p><?php echo $this->Html->cHtml($productRedemption['ProductRedemption']['short_description']); ?></p>
                        </div>
					</div>
                    <div class="brand-right">
                    	<div class="all-pro">
                        	<p class="back-link f-right"><?php echo $this->Html->link('&raquo;'.__l('Back To Brand Page'), array('controller' => 'product_redemptions', 'action' => 'view',$productRedemption['ProductRedemption']['slug']),array('title' =>__l('Back To Brand Page'), 'escape' => false)); ?></p>
                        	<h1><?php echo $this->Html->cText(ucfirst($productRedemption['ProductRedemption']['name']),false); ?> <?php echo __l('(All Products)'); ?></h1>
                            <div class="clear"></div>
                    		<ul class="all-products">
								<?php
								if (!empty($relatedProducts)):
								$i = 1;
								foreach ($relatedProducts as $relatedProduct):
									$class = null;
										if ($i++% 4 == 0) {
										$class = ' class="no-padl"';
									}
								?>
                                <li <?php echo $class; ?>><?php     echo $this->Html->link($this->Html->showImage('Product',  $relatedProduct['Attachment'][0], array('dimension' => 'product_normal', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($relatedProduct['RelatedProduct']['name'], false)), 'title' => $this->Html->cText($relatedProduct['RelatedProduct']['name'], false))).'<span class="shadow"></span><span class="bg_box"><span>'.$this->Html->cText($relatedProduct['RelatedProduct']['name'], false).'</span>'.Configure::read('site.currency').number_format($relatedProduct['RelatedProduct']['price'], 2, '.', '').'</span>', array('controller' => 'related_products', 'action' => 'view', $relatedProduct['RelatedProduct']['slug']),array('title' =>sprintf(__l('%s'),$relatedProduct['RelatedProduct']['name']), 'escape' => false)); ?></li>
								<?php
								endforeach;
								else:
								?>
								<li>
										<p class="notice"><?php echo __l('No Products available');?></p>
								</li>
								<?php
								endif;
								?>
							</ul>
                      	</div>
						<?php
							if (!empty($relatedProducts)) {
								echo $this->element('paging_links');	
							}		
						?>
                    </div>
                </div>