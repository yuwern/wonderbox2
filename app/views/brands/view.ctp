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
							<br/><br/>
							<?php echo $this->Html->cHtml($brand['Brand']['description']);?>
                        </div>
                     	<?php echo $this->element('product-index', array('brand_id'=>$brand['Brand']['id']));?>
						<div class="clear"></div>
					   <?php if(!empty($brand['BrandAddress'])): ?>
					     <div class="retail-click" id="js-retail-click"><a><span>RETAIL OUTLETS</span>Click to view all retail outlets</a></div>
						 <br />
                        <div class="retail_out hide" id="js-retail-out">
                       	  <h1><?php echo __l('RETAIL OUTLETS'); ?></h1>
						    <div class="retail_out_box">
                            	<ul>
									 <?php  $i = 0; 
										foreach($brand['BrandAddress'] as $brandAddress):
										$class = null;
										 if($i++  >= 3) {
										  $class = 'class="mtop15"';
										//	$i = 0;
										 }
									 ?>
                                	<li <?php echo $class; ?>>
                                    	<p>
										<?php if(!empty($brandAddress['Attachment'][0])): ?>
										<?php echo $this->Html->showImage('BrandAddress',  $brandAddress['Attachment'][0], array('dimension' => 'retaillogo_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($brandAddress['location'], false)), 'title' => $this->Html->cText($brandAddress['location'], false))); ?>
										<?php else: 
											echo $this->Html->image('retail_img4.jpg');
										endif; ?>										
										</p>
                                        <strong><?php echo __l('Address:'); ?></strong>
										<span><?php if(!empty($brandAddress['location'])): ?>  <?php echo $this->Html->cHtml($brandAddress['location']);?>
										<?php endif; ?>
										<?php if(!empty($brandAddress['telephone_no'])): ?>
										<br/>
										<strong><?php echo __l('Telephone No :'); ?></strong>  <?php echo $brandAddress['telephone_no']; ?>
										<?php endif; ?>
										<?php if(!empty($brandAddress['fax_no'])): ?>
										<br/>
                                        <strong><?php echo __l('Fax Number :'); ?></strong> <?php echo $this->Html->cText($brandAddress['fax_no'],false);?>
										<?php endif; ?>
										<?php if(!empty($brandAddress['email'])): ?>
										<br/>
										<strong><?php echo __l('Email:'); ?></strong> <a href="mailto: <?php echo $brandAddress['email'];?>" title="<?php echo $brandAddress['email'];?>"> <?php echo $this->Html->cText($brandAddress['email'],false);?></a>
										<?php endif; ?>
										<?php if(!empty( $brandAddress['website_url'])): ?>
										<br/>
										<a href="<?php echo  $brandAddress['website_url']; ?>" target="_blank"><?php echo $brandAddress['website_url']; ?></a>
										<?php endif; ?></span>
                                    </li>
									<?php endforeach; ?>
                                </ul>
                            </div>
                        </div><?php endif; ?>
                        <ul class="social-icon">
								<?php if(!empty( $brand['Brand']['facebook_url'])): ?>
                            	<li><a href="<?php echo $brand['Brand']['facebook_url']; ?>" class="s-f" target="_blank" title="Facebook URL">Facebook <span><?php echo $brand['Brand']['facebook_url']; ?></span></a></li>
								<?php endif; ?>
								<?php if(!empty( $brand['Brand']['web_url'])): ?>
                                <li><a href="<?php echo $brand['Brand']['web_url']; ?>" class="s-h" target="_blank"><?php echo $brand['Brand']['name'].' Homepage'; ?> <span><?php echo $brand['Brand']['web_url']; ?></span></a></li>
								<?php endif; ?>
								<?php if(!empty( $brand['Brand']['youtube_url'])): ?>
                                <li><a href="<?php echo $brand['Brand']['youtube_url']; ?>" class="s-y"  target="_blank"><?php echo __l('Youtube'); ?> <span><?php echo $brand['Brand']['youtube_url']; ?></span></a></li>
								<?php endif; ?>
							    <?php if(!empty( $brand['Brand']['promotion_url'])): ?>
                                <li><a href="<?php echo $brand['Brand']['promotion_url']; ?>" class="s-g" target="_blank">Latest Promotion <span><?php echo $brand['Brand']['promotion_url']; ?></span></a></li>
								<?php endif; ?>
                            </ul>
                   
                    </div>
					
        </div>