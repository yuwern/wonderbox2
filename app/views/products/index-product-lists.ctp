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
                	<li><?php echo $this->Html->link($this->Html->showImage('Product',  $product['Attachment'][0], array('dimension' => 'product_normal', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['name'], false)), 'title' => $this->Html->cText($product['Product']['name'], false))), array('controller' => 'products', 'action' => 'view', $product['Product']['slug'],'admin'=>false),array('title' =>sprintf(__l('%s'),$product['Product']['name']), 'escape' => false));?><br /><?php echo $this->Html->link($this->Html->cText($product['Product']['name'],false), array('controller' => 'products', 'action' => 'view', $product['Product']['slug'],'admin'=>false),array('title' =>sprintf(__l('%s'),$product['Product']['name']), 'escape' => false));?><span><?php  echo Configure::read('site.currency').' '.number_format($product['Product']['price'], 2, '.', ''); ?></span></li>
					<?php
						endforeach;
					else:
					?>
						<li><?php echo $this->Html->image('no-product.jpg'); ?></li>
					<?php
					endif;
					?>
				  <?php if (!empty($products)): ?>
					<li><?php echo $this->Html->link(__l('View All Products'), array('controller' => 'products', 'action' => 'index','brand_id'=> $this->request->params['named']['brand_id'],'type'=>'product','admin'=>false),array('title' =>__l('View All Products'), 'escape' => false));?></li>
					<?php endif; ?>
                 </ul>