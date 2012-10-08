	<script type="text/javascript">
		// Set up Sliders
		// **************
		$(function(){

			$('#slider2').anythingSlider({
				width               : 988,   // if resizeContent is false, this is the default width if panel size is not defined
				height              : 467,   // if resizeContent is false, this is the default height if panel size is not defined
				resizeContents      : true, // If true, solitary images/objects in the panel will expand to fit the viewport
				startStopped        : true,  // If autoPlay is on, this can force it to start stopped
				autoPlay            : false,
				buildArrows         : false,
				buildNavigation     : false
				
			});
			$('#js-goforward').click(function(){
					$('#slider2').data('AnythingSlider').goForward(); 
				});
			$('#js-gobackward').click(function(){
					$('#slider2').data('AnythingSlider').goBack(); 
			});
		});
	</script>
	<div class="brand">
            	<div class="brand-left">
                	<h1><?php echo __l('Brands'); ?></h1>
                    <p>Look no further to find all the information about our brand partners. Get to know their products and the philosophy they aspire in bringing you the best beauty and cosmetic product that best suits your beauty style . You will find this list continually expanding as we add new brands and products. Here is a list of brands we are working with:</p>
                </div>
            		<div class="brand-right">
            <ul id="slider2">
				<?php
				$total_brands = count($brands);
				$rcount= 1;
				if (!empty($brands)):
						$i = 0;
						foreach ($brands as $brand):
							$class = null;
				$i++;
				?> 
				<?php if($rcount == 1):?>
				<li class="panel1">
					<ul>
				<?php endif; ?>
                    	<li><?php     echo $this->Html->link($this->Html->showImage('Brand',  $brand['Attachment'], array('dimension' => 'brand_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($brand['Brand']['name'], false)), 'title' => $this->Html->cText($brand['Brand']['name'], false))), array('controller' => 'brands', 'action' => 'view', $brand['Brand']['slug']),array('title' =>sprintf(__l('%s'),$brand['Brand']['name']), 'escape' => false));
						?> </li>
					<?php $rcount++; 
						if($rcount == 10):
							$rcount = 1;
					?>
				    </ul>
				</li>
				<?php endif; ?>
				<?php
						if($total_brands == $i ):
							$rcount = 1;
				?>
				 </ul>
					</li>
				<?php endif; ?>
				<?php
						endforeach;
						else:
				?>
							<li>
								<p class="notice"><?php echo __l('No Brands available');?></p>
							</li>
				<?php
					endif;
				?>
			</ul>
			  <?php
			if(!empty($brands) && count($brands)>9): ?>
           	       <div class="slider">
                        <a title="Slide Left" class="slider-left" id="js-gobackward"></a>
                        <a title="Slide Right" class="slider-right" id="js-goforward"></a>
                  </div>
				 <?php  endif; ?>
                </div>
                   
	</div>


                
			