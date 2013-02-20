	   <div class="brand-main">
                	<div class="brand-left">
						<div class="head">
                        	<h1><?php echo $this->Html->cText($brand['Brand']['name'],false);?></h1>
                            <p>	<?php echo $this->Html->cHtml($brand['Brand']['short_description']);?></p>
                        </div>
					</div>
                    <div class="brand-right">
                    	<div class="pro-each-main-left">
                        	<?php echo $this->Html->showImage('Brand',  $brand['Attachment'], array('dimension' => 'brand_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($brand['Brand']['name'], false)), 'title' => $this->Html->cText($brand['Brand']['name'], false))); ?>
							<br/>
							<br/>
							<?php echo $this->Html->cHtml($brand['Brand']['description']);?>
                        </div>
                     	<?php echo $this->element('product-index', array('brand_id'=>$brand['Brand']['id']));?>
                    </div>
        </div>