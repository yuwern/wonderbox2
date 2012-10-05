<div class="product">	<h1> <?php echo $this->Html->cText(ucfirst($products[0]['Brand']['name'])); ?></h1>
          	<div class="product-data">
			
                    <ul>
						<?php
							if (!empty($products)):

							$i = 0;
							foreach ($products as $product):
								$class = null;
								if ($i++ % 2 == 0) {
									$class = ' class="altrow"';
								}
						?>
						<li><?php     echo $this->Html->link($this->Html->showImage('Product',  $product['Attachment'][0], array('dimension' => 'brand_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['name'], false)), 'title' => $this->Html->cText($product['Product']['name'], false))), array('controller' => 'products', 'action' => 'view', $product['Product']['slug']),array('title' =>sprintf(__l('%s'),$product['Product']['name']), 'escape' => false));
						?>
						<p><?php
						echo  $this->Html->link($this->Html->truncate($product['Product']['name'],25, array('ending' => '...')), array('controller' => 'products', 'action' => 'view', $product['Product']['slug']),array('title' =>sprintf(__l('%s'),$product['Product']['name']), 'escape' => false)); ?></p>
						<p><span><?php echo Configure::read('site.currency').' '.$this->Html->cText($product['Product']['price'],false); ?></span></p>
						</li>
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
				<div>		<?php
					if (!empty($products)) {
						echo $this->element('paging_links');	
					}		
					?></div>
	</div>	
			