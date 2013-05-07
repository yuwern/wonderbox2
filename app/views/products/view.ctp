		<div class="brand-main">
                	<div class="brand-left">
						<div class="head">
                        	<h1> <?php echo $this->Html->cText($product['Brand']['name'],false);?></h1>
                            <p><?php echo $this->Html->cHtml($product['Brand']['short_description']);?></p>
                        </div>
					</div>
                    <div class="brand-right">
                    	<div class="brand-sl-left"><?php echo $this->Html->showImage('Product',  $product['Attachment'][0], array('dimension' => 'product_view', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['name'], false)), 'title' => $this->Html->cText($product['Product']['name'], false))); ?></div>
                      <div class="brand-sl-right">
                      	<p class="back-link"><?php echo $this->Html->link('&raquo;'.__l('Back To Brand Page'), array('controller' => 'brands', 'action' => 'view',$product['Brand']['slug']),array('title' =>__l('Back To Brand Page'), 'escape' => false)); ?></p>
                        <h1><?php echo $this->Html->cText($product['Product']['name'],false);?></h1>
                        <h2><?php  echo Configure::read('site.currency').number_format($product['Product']['price'], 2, '.', ''); ?> </h2>
						<div>
					<p style="padding:10px;"> I have used this product before <span class="js-used-product-yes" style="background:red;color:#fff"> Yes </span> <span class="js-used-product-no" > No </span> </p>
							<p class="hide js-current-product"  style="padding:10px;"> I am currently using this product. <span class="js-current-product-yes"> Yes </span> <span class="js-current-product-no"> No </span> </p>
							<p  style="padding:10px;"> I want to try or buy this product <span class="js-buy-product-yes"> Yes </span> <span class="js-buy-product-no"> No </span> </p>
							<p class="hide js-buy-url"  style="padding:10px;"> Buy now at <a href="http://www.google.com" class="js-link-redirect">Logo</a> </p>
						</div>
						<div class="js-loading-img hide"><?php echo $this->Html->image('loading.gif'); ?></div>
 
                       <?php echo $this->Html->cHtml($product['Product']['description']);?>
						<input type="hidden" name="slug" value="<?php echo $product['Product']['slug']; ?>" class="js-product-slug"/>

                      </div>
                    </div>
                </div>