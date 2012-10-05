<div class="product-detail">
				<div class="product-detail-left"><?php echo $this->Html->showImage('Product',  $product['Attachment'][0], array('dimension' => 'brand_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['name'], false)), 'title' => $this->Html->cText($product['Product']['name'], false))); ?></div>
            	<div class="product-detail-right">
              	<h2><?php echo $this->Html->cText($product['Product']['name']);?></h2>
				<h2><?php echo __l('Brand'); ?> : <?php echo $this->Html->cText($product['Category']['name']);?></h2>
				<h2>Price :<?php  echo Configure::read('site.currency').' '.$this->Html->cFloat($product['Product']['price'],false); ?> </h2>

                <?php echo $this->Html->cHtml($product['Product']['description']);?>
         
              </div>
              <div class="clear"></div>
</div>