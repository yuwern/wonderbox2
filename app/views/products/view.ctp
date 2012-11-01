<div class="product-detail">
		<div class="backlink"><?php echo $this->Html->link(__l('Back To Brand Page'), array('controller' => 'brands', 'action' => 'view',$product['Brand']['slug']),array('title' =>__l('Back To Brand Page'), 'escape' => false)); ?></div>
				<div class="product-detail-left"><?php echo $this->Html->showImage('Product',  $product['Attachment'][0], array('dimension' => 'brand_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['name'], false)), 'title' => $this->Html->cText($product['Product']['name'], false))); ?></div>
            	<div class="product-detail-right">
              	<h2><?php echo $this->Html->cText($product['Product']['name']);?></h2>
				<h2><?php echo __l('Brand'); ?> : <?php echo $this->Html->cText($product['Brand']['name']);?></h2>
				<h2><?php echo __l('Price'); ?> :<?php  echo Configure::read('site.currency').' '.number_format($product['Product']['price'], 2, '.', ''); ?> </h2>

                <?php echo $this->Html->cHtml($product['Product']['description']);?>
         
              </div>
              <div class="clear"></div>
</div>