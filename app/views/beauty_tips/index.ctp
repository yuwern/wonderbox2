	<div class="gift-wonder">                
                	<div class="beauty-left1">
						<?php if(!empty($beautyTipSliders)): ?>
						<div class="showcase">
							<div id="slides">
								<div class="prev" title="Previous"></div>
								<div class="slides_container">
									<?php 
									  foreach($beautyTipSliders as $beautyTipSlider): ?>
										 <div class="slide"><?php echo $this->Html->showImage('BeautyTipSlider',  $beautyTipSlider['Attachment1'], array('dimension' => 'beautytipslider_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($beautyTipSlider['BeautyTip']['name'], false)), 'title' => $this->Html->cText($beautyTipSlider['BeautyTip']['name'], false))); ?><div class="caption"><?php echo $this->Html->link($this->Html->cText($beautyTipSlider['BeautyTip']['name'],false), array('controller' => 'beauty_tips', 'action' => 'view', $beautyTipSlider['BeautyTip']['slug']),array('title' =>sprintf(__l('%s'),$beautyTipSlider['BeautyTip']['name']),'class'=>'beauty-title', 'escape' => false));
										 if(!empty($beautyTipSlider['Category'])):?>
										 <div class="beauty-tags">
										<?php foreach($beautyTipSlider['Category'] as $category): ?>
											<a class="link" title="<?php echo  $category['name']; ?>"><?php echo $category['name'].' ';  ?></a>
										 <?php
										 endforeach; ?>
										</div>
										<?php endif;?>
										</div></div>
									  <?php endforeach;
								
								?>
								</div>
								<div class="next" title="Next"></div>
							</div>
						</div>
						<?php endif; ?>
							<?php if (!empty($beautyTips)): 
							$i = 0;
							foreach ($beautyTips as $beautyTip):
								$class = null;
								if ($i++ % 2 == 0) {
									$class = ' class="altrow"';
								}
							?>
						<div class="beauty_detail">
							<?php     echo $this->Html->link($this->Html->showImage('BeautyTip',  $beautyTip['Attachment'], array('dimension' => 'beautytips_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($beautyTip['BeautyTip']['name'], false)), 'title' => $this->Html->cText($beautyTip['BeautyTip']['name'], false))).'<span class="bro-bg"></span>', array('controller' => 'beauty_tips', 'action' => 'view', $beautyTip['BeautyTip']['slug']),array('title' =>sprintf(__l('%s'),$beautyTip['BeautyTip']['name']), 'escape' => false));?> 
							<div class="head1">
								<h1><?php echo $this->Html->link($this->Html->cText($beautyTip['BeautyTip']['name'],false), array('controller' => 'beauty_tips', 'action' => 'view', $beautyTip['BeautyTip']['slug']),array('title' =>sprintf(__l('%s'),$beautyTip['BeautyTip']['name']), 'escape' => false));?></h1>
								<div class="product_links"><?php if(!empty($beautyTip['Category'])):
								foreach($beautyTip['Category'] as $category):?>
									<a title="<?php echo $category['name'];  ?>"><?php echo $category['name'];  ?></a>
								<?php
								endforeach;	
								endif; ?></div>
								<p><?php echo $this->Html->truncate($beautyTip['BeautyTip']['description'],170, array('ending' => '...')); ?></p>
								<div class="more"><?php echo $this->Html->link(__l( '>> Read full article'), array('controller' => 'beauty_tips', 'action' => 'view', $beautyTip['BeautyTip']['slug']),array('title' =>__l('Read full article'), 'escape' => false)); ?></div>
							</div>

						</div>
						<?php
						endforeach;
					else:
					?>
					<div class="beauty_detail">
							<p class="notice"><?php echo __l('No Beauty Tips available');?></p>
					</div>
					<?php
					endif;
					?>
					<?php if (!empty($beautyTips) && $beautyTipsCount >= 10) { ?>
						<div>
								<?php echo $this->element('paging_links'); ?>
						</div>
					<?php } ?>
					</div>
                    <div class="beauty-right1">
					<?php echo $this->element('beautytips-siderbar'); ?>
					</div>