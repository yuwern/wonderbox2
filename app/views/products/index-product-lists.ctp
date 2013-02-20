            <div class="pro-each-main-right">
				<ul class="all-products">
					<?php
					if (!empty($products)):
					$i = 0;
					foreach ($products as $product):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow"';
						}
					?>
				   <li><?php echo $this->Html->link($this->Html->showImage('Product',  $product['Attachment'][0], array('dimension' => 'product_normal', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['name'], false)), 'title' => $this->Html->cText($product['Product']['name'], false))).'<span class="shadow"></span><span class="bg_box"><span>'.$this->Html->cText($product['Product']['name'],false).'</span>'.Configure::read('site.currency').number_format($product['Product']['price'], 2, '.', '').'</span>', array('controller' => 'products', 'action' => 'view', $product['Product']['slug'],'admin'=>false),array('title' =>sprintf(__l('%s'),$product['Product']['name']), 'escape' => false));?></li>
					<?php
						endforeach;
					else:
					?>
						<li><?php echo $this->Html->image('no-product.png'); ?></li>
					<?php
					endif;
					?>
				 </ul>
				 <?php if (!empty($products)): ?>
				<p class="back-link"><?php echo $this->Html->link(__l('&raquo; View All Products'), array('controller' => 'products', 'action' => 'index','brand_id'=> $this->request->params['named']['brand_id'],'type'=>'product','admin'=>false),array('title' =>__l('View All Products'), 'escape' => false));?></p>
				<?php endif; ?>
		</div>