<div class="body">
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar({ size: 370,sizethumb: 70 });	
		});
	</script>	
    
				<!-- Brand Logo Sec  -->
                <div class="product_redeem">
					<div class="pro-mon-img"><?php echo $this->Html->showImage('HomePageOrganizer', (!empty($homePageOrganizer['Attachment']) ? $homePageOrganizer['Attachment'] : ''), array('dimension' => 'productredemptionbig_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($homePageOrganizer['HomePageOrganizer']['title'], false)), 'title' => $this->Html->cText($homePageOrganizer['HomePageOrganizer']['title'], false))); ?>
                     
	        </div>
                    <div class="pro-mon-dec">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> - <?php echo date("F",strtotime($homePageOrganizer['HomePageOrganizer']['edition_date'])).' '.__l('Edition'); ?></h1>
                        </div>
                      <div id="scrollbar1">
		<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
		<div class="viewport">
			 <div class="overview">
			<?php echo $this->Html->cHtml($homePageOrganizer['HomePageOrganizer']['content']); ?>                 
			</div>
		</div>
	</div>
                    </div>	
                  <div class="clear"></div>
                    <h1 class="bor-bottom"><?php echo $this->Html->image('whats_head.jpg',array('width'=>'178','height'=>'40')); ?></h1>
                    <div class="pro-mon-box">
                    	<ul class="all-products">
							<?php
							if (!empty($products)):
							$i = 0;
							foreach ($products as $product):
								$class = null;
								if ($i == 4) {
									$class = ' class="no-padl"';
									$i = 0;
								}
								$i++;
							?>
                             <li <?php echo $class; ?>><?php echo $this->Html->link($this->Html->showImage('Product',  $product['Attachment'][0], array('dimension' => 'product_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['name'], false)), 'title' => $this->Html->cText($product['Product']['name'], false))).'<span class="shadow"></span><span class="bg_box"><span>'.$this->Html->cText($product['Product']['name'],false).'</span>'.Configure::read('site.currency').number_format($product['Product']['price'], 2, '.', '').'</span>', array('controller' => 'products', 'action' => 'view', $product['Product']['slug'],'admin'=>false),array('title' =>sprintf(__l('%s'),$product['Product']['name']), 'escape' => false));?></li>
						<?php
							endforeach;
						else:
						?>
							<li><?php echo $this->Html->image('no-product.png'); ?></li>
						<?php
						endif;
						?>
					 </ul>
							
                  </div>			
       		  </div>
            </div>