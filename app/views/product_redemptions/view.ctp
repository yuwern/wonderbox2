	<div class="body">
				<!-- Brand Logo Sec  -->
          		<div class="brand-main">
                	<div class="brand-left">
						<div class="head">
                        	<h1><?php echo $this->Html->cText($productRedemption['ProductRedemption']['name'],false);?></h1>
                            <p><?php echo $this->Html->cHtml($productRedemption['ProductRedemption']['short_description']);?></p>
                        </div>
					</div>
                    <div class="brand-right">
                    	<div class="pro-each-main-left">
							<?php echo $this->Html->showImage('ProductRedemption',  $productRedemption['Attachment'][0], array('dimension' => 'productredemptionbig_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($productRedemption['ProductRedemption']['name'], false)), 'title' => $this->Html->cText($productRedemption['ProductRedemption']['name'], false)));?>
                        	<?php echo $this->Html->cHtml($productRedemption['ProductRedemption']['description']);?>
                        </div>
                     	<div class="pro-each-main-right">
							<?php echo $this->Html->image('whats_head.jpg',array('width'=>'178','height'=>'40')); ?>
							<?php if(!empty($productRedemption['RelatedProduct'])): ?>
                            <ul class="all-products">
								<?php foreach($productRedemption['RelatedProduct'] as $relatedProduct): ?>	
							   <li><?php echo $this->Html->link($this->Html->showImage('RelatedProduct',  $relatedProduct['Attachment'][0], array('dimension' => 'product_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($relatedProduct['name'], false)), 'title' => $this->Html->cText($relatedProduct['name'], false))).'<span class="shadow"></span><span class="bg_box"><span>'.$this->Html->cText($relatedProduct['name'],false).'</span>'.Configure::read('site.currency').number_format($relatedProduct['price'], 2, '.', '').'</span>', array('controller' => 'related_products', 'action' => 'view', $relatedProduct['slug'],'admin'=>false),array('title' =>sprintf(__l('%s'),$relatedProduct['name']), 'escape' => false));?></li>
								<?php  endforeach; ?>
                               </ul>
                           <p class="back-link"><?php echo $this->Html->link(__l('&raquo; View All Products'), array('controller' => 'related_products', 'action' => 'index',$productRedemption['ProductRedemption']['slug'],'admin'=>false),array('title' =>__l('View All Products'), 'escape' => false));?></p>
						   <?php else: ?>
						   <ul class="all-products">
								<li> <?php echo $this->Html->image('no-product.png'); ?></li>
						   </ul>
						   <?php endif; ?>
                        </div>
                    </div>
                </div>
         </div>