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
                    <p>Quisque et sem vel massa tempor placerat et ut ligula. Fusce at felis id diam fringilla vulputate. Integer auctor augue vitae neque accumsan a imperdiet tellus congue. Sed eu ipsum sit amet nisl adipiscing gravida ut ut massa. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum vitae elementum dui. In porttitor, eros eu scelerisque vestibulum, lacus ante sollicitudin augue, id convallis nisl lacus ut sapien. Quisque viverra est commodo lorem lobortis accumsan. Curabitur a dolor ut orci laoreet placerat ut vitae massa. </p>
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


                
			