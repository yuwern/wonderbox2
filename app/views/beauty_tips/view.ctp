<div class="gift-wonder">
                	<div class="beauty-left1">
						<div class="tips_detail">
							<div class="head1">
								<h1><?php echo $this->Html->cText($beautyTip['BeautyTip']['name'],false);?></h1>
								<div class="product_links">
								<div class="f_left_link">
								<?php if(!empty($beautyTip['Category'])): 
										foreach($beautyTip['Category'] as $category): ?>
										<a class="tag" title="<?php echo $category['name']; ?> "> <?php echo $category['name']; ?> </a>
								<?php	endforeach;	
									endif; ?>
								</div>
								<div class="right_links">
									<?php echo $this->Html->getPaginateLinks('BeautyTip',$beautyTip['BeautyTip']['id']); ?>
								</div>
								</div>
								<br class="clr"></br>
								<?php     echo $this->Html->showImage('BeautyTip',  $beautyTip['Attachment'], array('dimension' => 'beautytipslider_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($beautyTip['BeautyTip']['name'], false)), 'title' => $this->Html->cText($beautyTip['BeautyTip']['name'], false)));?> 
								<br/>
								<div class="beauty-tip-content">
								<?php echo $this->Html->cHtml($beautyTip['BeautyTip']['description']);?>
								</div>
								<?php if(!empty($beautyTip['BeautyTip']['video_url'])): ?>
								<div class="video_player">
									<iframe width="670" height="390" src="<?php echo $beautyTip['BeautyTip']['video_url']; ?>" frameborder="0" allowfullscreen></iframe>
								</div>
								<?php endif; ?>
								<div class="user_msg">
									<?php     echo $this->Html->showImage('UserAvatar',  $beautyTip['User']['UserAvatar'], array('dimension' => 'profilenormal_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($beautyTip['User']['UserProfile']['first_name'], false)), 'title' => $this->Html->cText($beautyTip['User']['UserProfile']['first_name'], false)));?> 
									<br/>
									<div class="comments">
										<?php if(!empty($beautyTip['BeautyTip']['about_us'])): ?>
										<?php echo $this->Html->cHtml($beautyTip['BeautyTip']['about_us']); ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>						
					</div>
                    <div class="beauty-right1">
						<?php echo $this->element('beautytips-siderbar'); ?>
                    </div>
           </div>