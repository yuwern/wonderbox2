	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar2').tinyscrollbar();	
		});
	</script><!-- Brand Logo Sec  -->
				<p class="back-link pad_bot5"><?php echo $this->Html->link('&raquo;'.__l('Back To Brand Page'), array('controller' => 'brands', 'action' => 'view',$product['Brand']['slug']),array('title' =>__l('Back To Brand Page'), 'escape' => false)); ?></p>
          		<div class="brand-main pad_none">
                    	<div class="brand-sl-left"><?php echo $this->Html->showImage('Product',  $product['Attachment'][0], array('dimension' => 'product_view', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['name'], false)), 'title' => $this->Html->cText($product['Product']['name'], false))); ?></div>
                      <div class="brand-sl-right brand-sl-right1">
						<div class="head">
							<h1><?php echo $this->Html->cText($product['Product']['name'],false);?></h1>
							<h2><?php  echo Configure::read('site.currency').number_format($product['Product']['price'], 2, '.', ''); ?></h2>
						</div>
						<?php if ($this->Auth->sessionValid()): ?>
						<div class="review_details">
							<div class="js-loading-img hide"><?php echo $this->Html->image('loading1.gif'); ?></div>
							<div class="review_cont">
								<div class="review">
									<p> <b><?php echo __l('I have used this product before'); ?></b> <span class="js-used-product-no"><?php echo __l('No'); ?> </span> <span class="js-used-product-yes"><?php echo __l('Yes'); ?> </span>  </p>
								</div>
								<p class="current hide js-current-product">  <b><?php echo __l('I am currently using this product.'); ?></b> <span class="js-current-product-no"><?php echo __l('No'); ?> </span> <span class="js-current-product-yes"><?php echo __l('Yes'); ?> </span>  </p>
							</div>
							<div class="review_cont">
								<div class="review">
									<p> <b><?php echo __l('I want to try or buy this product'); ?></b> <span class="js-buy-product-no"> <?php echo __l('No'); ?> </span> <span class="js-buy-product-yes"> <?php echo __l('Yes'); ?> </span>  </p>
								</div>
								<p class="current hide js-buy-url"> <b class="wid1"><?php echo __l('Buy now at'); ?></b>
								<?php if(!empty($product['Product']['buy_url'])):
									if(!empty($product['Attachment1'])):
									echo $this->Html->link($this->Html->showImage('BuySiteLogo',  $product['Attachment1'][0], array('dimension' => 'buy_logo_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['name'], false)), 'title' => $this->Html->cText($product['Product']['name'], false))), $product['Product']['buy_url'] ,array('class'=>'js-link-redirect','escape'=>false)); 
									else:
									echo $this->Html->link($this->Html->image('cart.jpg'), $product['Product']['buy_url'] ,array('class'=>'js-link-redirect','escape'=>false));
									endif;
									endif; ?> 
								<input type="hidden" name="slug" value="<?php echo $product['Product']['slug']; ?>" class="js-product-slug"/>
								</p>
							</div>
						</div>
						<?php endif; ?>
						 <div id="scrollbar2">
							<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
							<div class="viewport">
							<div class="overview">
								<?php echo $this->Html->cHtml($product['Product']['description']);?>
							</div>
						</div>
						</div>
                      </div>
                </div>
