		<div class="brand-main">
                	<div class="brand-left">
						<div class="head">
                        	<h1> <?php echo $this->Html->cText($relatedProduct['ProductRedemption']['name'],false);?></h1>
                            <p><?php echo $this->Html->cHtml($relatedProduct['ProductRedemption']['short_description']);?></p>
                        </div>
					</div>
                    <div class="brand-right">
                    	<div class="brand-sl-left"><?php echo $this->Html->showImage('RelatedProduct',  $relatedProduct['Attachment'][0], array('dimension' => 'product_view', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($relatedProduct['RelatedProduct']['name'], false)), 'title' => $this->Html->cText($relatedProduct['RelatedProduct']['name'], false))); ?></div>
                      <div class="brand-sl-right">
                      	<p class="back-link"><?php echo $this->Html->link('&raquo;'.__l('Back To Brand Page'), array('controller' => 'product_redemptions', 'action' => 'view',$relatedProduct['ProductRedemption']['slug']),array('title' =>__l('Back To Brand Page'), 'escape' => false)); ?></p>
                        <h1><?php echo $this->Html->cText($relatedProduct['RelatedProduct']['name'],false);?></h1>
                        <h2><?php  echo Configure::read('site.currency').number_format($relatedProduct['RelatedProduct']['price'], 2, '.', ''); ?> </h2>
                       <?php echo $this->Html->cHtml($relatedProduct['RelatedProduct']['description']);?>
                      </div>
                    </div>
                </div>