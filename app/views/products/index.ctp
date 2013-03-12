		<div class="brand-main">
                	<div class="brand-left">
						<div class="head">
                        	<h1><?php echo $this->Html->cText(ucfirst($products[0]['Brand']['name']),false); ?></h1>
                            <p><?php echo $this->Html->cHtml($products[0]['Brand']['short_description']); ?></p>
                        </div>
					</div>
                    <div class="brand-right">
                    	<div class="all-pro">
                        	<p class="back-link f-right"><?php echo $this->Html->link('&raquo;'.__l('Back To Brand Page'), array('controller' => 'brands', 'action' => 'view',$products[0]['Brand']['slug']),array('title' =>__l('Back To Brand Page'), 'escape' => false)); ?></p>
                        	<h1><?php echo $this->Html->cText(ucfirst($products[0]['Brand']['name']),false); ?> <?php echo __l('(All Products)'); ?></h1>
                            <div class="clear"></div>
                    		<ul class="all-products">
								<?php
								if (!empty($products)):
								$i = 1;
								foreach ($products as $product):
								$class = null;
								if ($i++% 4 == 0) {
									$class = ' class="no-padl"';
								}
								?>
                                <li <?php echo $class; ?>><?php     echo $this->Html->link($this->Html->showImage('Product',  $product['Attachment'][0], array('dimension' => 'product_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['name'], false)), 'title' => $this->Html->cText($product['Product']['name'], false))).'<span class="shadow"></span><span class="bg_box"><span>'.$this->Html->cText($product['Product']['name'], false).'</span>'.Configure::read('site.currency').number_format($product['Product']['price'], 2, '.', '').'</span>', array('controller' => 'products', 'action' => 'view', $product['Product']['slug']),array('title' =>sprintf(__l('%s'),$product['Product']['name']), 'escape' => false)); ?></li>
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
							if (!empty($products)) {
								echo $this->element('paging_links');	
							}		
						?>
                    </div>
                </div>