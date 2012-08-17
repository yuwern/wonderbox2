	<div class="subscribe2">
				<div class="subscribe2-pad">
                    <h1><?php echo __l('Get Your Very Own Beautiful Surprise'); ?></h1>
                    <p class="gray"><?php echo __l('Quisque facilisis nisi et dolor ultricies rhoncus. Morbi nisi sem, tincidunt at gravida ac, eleifend quis tellus. Pellentesque vel sodales mauris. Maecenas in enim risus. Mauris condimentum dolor in ante pulvinar quis tristique leo dictum. Ut hendrerit ipsum in ante facilisis euismod. Mauris in est elit.'); ?> </p>
                   <div class="table-data">
                         	<ul>
                            	<li class="t-head">
                                	<div class="t-c1"><?php echo __l('Subscription Type'); ?> </div>
                                    <div class="t-c2"><?php echo __l('Billing Amount'); ?> </div>
                                    <div class="t-c3"><?php echo __l('Billing Cycle'); ?>  </div>
                                    <div class="t-c4"><?php echo __l('Wonderpoints'); ?></div>
                                    <div class="t-c5"><?php echo __l('Subscribe'); ?></div>
                                    <div class="clear"></div>
                                </li>
									<?php
									if (!empty($packages)):

									$i = 0;
									foreach ($packages as $package):
										$class = null;
										if ($i++ % 2 == 0) {
											$class = ' class="altrow"';
										}
									?>
                                <li class="t-data">
                                	<div class="t-c1"><?php echo $this->Html->cText($package['PackageType']['name']); ?></div>
                                    <div class="t-c2"><?php echo Configure::read('site.currency'). ' '. $this->Html->cInt($package['Package']['cost']);?> </div>
                                    <div class="t-c3"> <?php echo $this->Html->cText($package['Package']['name']);?> </div>
                                    <div class="t-c4"><?php echo (!empty($package['Package']['no_of_wonderpoints'])? __l('Earn').' '.$this->Html->cInt($package['Package']['no_of_wonderpoints']).' '.__l('credits'): '---');?></div>
                                    <div class="t-c5"><?php echo $this->Html->link(__l('Buy Now'), array('controller' => 'packages', 'action' => 'view',$package['Package']['slug']), array('class'=>'but6','title' =>__l('Buy Now'), 'escape' => false)); ?></div>
                                    <div class="clear"></div>
                                </li>
								<?php
								 endforeach;
								else:
								?>
								<li class="t-data">
                                	<div class="t-c1"><?php echo __l('No package is avialable');?></div>
                                    <div class="clear"></div>
                                </li>
                                
								<?php
									endif;
								?>
                            </ul>
                         </div>
                         <h3><?php echo __l('Mauris condimentum dolor in ante pulvinar quis tristique leo dictum.');?></h3>
                         <p><?php echo __l('Nunc posuere turpis eget diam dictum quis tincidunt odio varius. Ut eros diam, luctus sit amet mattis at, semper porttitor sem. Nunc sit amet feugiat arcu. Duis consequat, elit nec elementum accumsan, est nibh pharetra nisl, eu cursus odio justo quis diam. Pellentesque quis semper felis.');?> </p>
<p><?php echo __l('Quisque ultricies purus ut felis facilisis a condimentum metus semper. Aliquam erat volutpat. Nullam purus justo, elementum sit amet accumsan ut, consectetur ut leo. Aliquam ut hendrerit nibh.');?> </p>
<div class="pay-logo">
							<h2><?php echo __l('Payment Options'); ?></h2>
							<div>
<?php echo $this->Html->image('logo_visa.gif',array('width'=>65,'height'=>21)); ?><?php echo $this->Html->image('logo_mastercard.gif',array('width'=>51,'height'=>30)); ?><?php echo $this->Html->image('logo_7eleven.gif',array('width'=>42,'height'=>38)); ?><?php echo $this->Html->image('logo_myclear.gif',array('width'=>100,'height'=>38)); ?><?php echo $this->Html->image('logo_maybank2u.gif',array('width'=>130,'height'=>20)); ?><?php echo $this->Html->image('logo_pbebank.gif',array('width'=>84,'height'=>22)); ?></div>
							<div><?php echo $this->Html->image('logo_cimbclick.gif',array('width'=>88,'height'=>15)); ?><?php echo $this->Html->image('logo_bankislam.gif',array('width'=>123,'height'=>24)); ?>
							<?php echo $this->Html->image('logo_hongleongonline.gif',array('width'=>123,'height'=>24)); ?><?php echo $this->Html->image('logo_allianceonline.gif',array('width'=>108,'height'=>20)); ?><?php echo $this->Html->image('logo_amonline.gif',array('width'=>68,'height'=>13)); ?><?php echo $this->Html->image('logo_eonbank.gif',array('width'=>90,'height'=>13)); ?><?php echo $this->Html->image('logo_rhb.gif',array('width'=>70,'height'=>29)); ?></div>

							<div> <?php echo $this->Html->image('logo_popular.gif',array('width'=>80,'height'=>27)); ?><?php echo $this->Html->image('logo_molpoints_cybercafe.jpg',array('width'=>102,'height'=>37)); ?><?php echo $this->Html->image('logo_paypal.gif',array('width'=>74,'height'=>21)); ?><?php echo $this->Html->image('logo_webcash.gif',array('width'=>35,'height'=>32)); ?><?php echo $this->Html->image('logo_mepscash.gif',array('width'=>48,'height'=>31)); ?><?php echo $this->Html->image('logo_mobilemoney.gif',array('width'=>115,'height'=>28)); ?><?php echo $this->Html->image('logo_axs.gif',array('width'=>70,'height'=>23)); ?><?php echo $this->Html->image('logo_sg_post.gif',array('width'=>90,'height'=>36)); ?><?php echo $this->Html->image('logo_alipay.gif',array('width'=>60,'height'=>33)); ?><?php echo $this->Html->image('logo_unionpay.gif',array('width'=>50,'height'=>30)); ?></div>
						</div>
				</div>
			
</div>
