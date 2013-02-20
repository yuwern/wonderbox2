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
                       <?php echo $this->Html->cHtml($product['Product']['description']);?>
                      </div>
                    </div>
                </div>