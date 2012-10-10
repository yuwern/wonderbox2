<div class="brand-detail">

            	<div class="left-center">
                    <div class="brand-detail-left"><?php echo $this->Html->showImage('Brand',  $brand['Attachment'], array('dimension' => 'brand_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($brand['Brand']['name'], false)), 'title' => $this->Html->cText($brand['Brand']['name'], false))); ?></div>
                    <div class="brand-detail-center">
                        <h2><?php echo $this->Html->cText($brand['Brand']['name']);?></h2>
						<div id="inner-static">
                        <?php echo $this->Html->cHtml($brand['Brand']['description']);?>
						</div>
						<?php if(!empty($brand['BrandAddress'])): ?>
						<p class="a-right">
						 <span><a  class="btn3 f-right f12 js-toggle-show {'container':'js-learn-more'}" title="Retail Outlet">Retail Outlet</a></span></p>
						 <div class="brand-location js-learn-more hide">
						 <?php foreach($brand['BrandAddress'] as $brandAddress):?>
                        <div class="f-left p-right3 b-loc-left">
						<h2>Retail Outlet  </h2>
                      	 <p><b><?php echo __l('Address:'); ?></b></p> 
						<p> <?php echo $this->Html->cHtml($brandAddress['location']);?></p>
						<p>
					   <?php if(!empty($brandAddress['telephone_no'])): ?>
						<b><?php echo __l('Telephone:'); ?></b> <?php echo $this->Html->cText($brandAddress['telephone_no'],false);?><br/>
						<?php endif; ?>
					   <?php if(!empty($brandAddress['fax_no'])): ?>
						<b><?php echo __l('Fax:'); ?></b>  <?php echo $this->Html->cText($brandAddress['fax_no'],false);?><br/>
						<?php endif; ?>
					   <?php if(!empty($brandAddress['email'])): ?>
						<b><?php echo __l('Email:'); ?></b> <a href="mailto: <?php echo $brandAddress['email'];?>" title="<?php echo $brandAddress['email'];?>"> <?php echo $this->Html->cText($brandAddress['email'],false);?></a>
						<?php endif; ?>
					</p>
                   </div>
					<?php endforeach; ?>
					</div>
					<?php endif; ?>
                    </div>
                    <div class="clear"></div>
                    
                    </div>
              	<div class="brand-detail-right">
				<?php echo $this->Html->link(__l('Back To Brand Page'), array('controller' => 'brands', 'action' => 'index'),array('title' =>__l('Back To Brand Page'), 'escape' => false)); ?>
              	<h2><?php echo __l('WonderBox Products'); ?></h2>
         		<?php echo $this->element('product-index', array('brand_id'=>$brand['Brand']['id']));?>
              </div>
                         <div class="clear"></div>
                  <div class="web-url-box">
                    <ul>
                   	<?php if(!empty( $brand['Brand']['facebook_url'])): ?>
                	<li class="fecebook-url"><a href="<?php echo $brand['Brand']['facebook_url']; ?>"  target="_blank" title="Facebook URL"><?php echo $brand['Brand']['facebook_url']; ?></a></li>
					<?php endif; ?>
					<?php if(!empty( $brand['Brand']['web_url'])): ?>
                    <li class="web-url"><a href="<?php echo $brand['Brand']['web_url']; ?>" target="_blank" title="Web URL"><?php echo $brand['Brand']['web_url']; ?></a></li>
					<?php endif; ?>
					<?php if(!empty( $brand['Brand']['beauty_tip_url'])): ?>
                    <li class="beauty-url"><a href="<?php echo $brand['Brand']['beauty_tip_url']; ?>"  target="_blank"  title="Beauty Tips URL"><?php echo $brand['Brand']['beauty_tip_url']; ?></a></li>
					<?php endif; ?>
					<?php if(!empty( $brand['Brand']['promotion_url'])): ?>
                    <li class="promo-url"><a href="<?php echo $brand['Brand']['promotion_url']; ?>" target="_blank" title="Promotion URL"><?php echo $brand['Brand']['promotion_url']; ?></a></li>
					<?php endif; ?>
                    </ul>
                  </div>
                  <div class="facebook-comments">
                    <h2>Facebook Comments</h2>
					<div class="fb-comments" data-href="<?php echo Router::url('/',true); ?>brands/view/<?php echo $brand['Brand']['slug']; ?>" data-num-posts="5" data-width="970"></div>
                  </div>

	   </div>