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
								<?php     echo $this->Html->showImage('BeautyTip',  $beautyTip['Attachment1'], array('dimension' => 'beautytipslider_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($beautyTip['BeautyTip']['name'], false)), 'title' => $this->Html->cText($beautyTip['BeautyTip']['name'], false)));?> 
								<br/>
								<div class="beauty-tip-content">
								<?php echo $this->Html->cHtml($beautyTip['BeautyTip']['description']);?>
								</div>
								<?php if(!empty($beautyTip['BeautyTip']['video_url'])): ?>
								<div class="video_player">
									<iframe width="670" height="390" src="<?php echo $beautyTip['BeautyTip']['video_url']; ?>" frameborder="0" allowfullscreen></iframe>
								</div>
								<?php endif; ?>
								<?php if(!empty($beautyTip['BeautyTip']['about_us'])): ?>
								<div class="user_msg">
									<?php
									if(!empty( $beautyTip['Attachment2'])):
									echo $this->Html->showImage('ContributorImage',  $beautyTip['Attachment2'], array('dimension' => 'profilenormal_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText('Contributor image', false)), 'title' => $this->Html->cText('Contributor image', false)));
									else:
									echo $this->Html->image('defaultavatar.jpg',array('width'=>90,'height'=>90)); 
									endif;
									?> 
									<br/>
									<div class="comments">
										<?php echo $this->Html->cHtml($beautyTip['BeautyTip']['about_us']); ?>
									</div>
								</div>
								<?php endif; ?>
								
							</div>
						</div>						
					</div>
                    <div class="beauty-right1">
						<?php echo $this->element('beautytips-siderbar'); ?>
                    </div>
           </div>
		     <div class="clear"></div>
            <div class="pagenation">
					<?php echo $this->Html->getPaginateBottomLinks('BeautyTip',$beautyTip['BeautyTip']['id']); ?>
           </div>
		   