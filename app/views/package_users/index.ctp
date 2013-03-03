			<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('Subscription Status'); ?></h1>
                            <p> <?php echo __l('Below are the WonderBox Edition You Are Subscribe To'); ?></p>
                        </div>
                       	<div class="acc-subscription">
                        	<h3><?php echo __l('My Subscriptions'); ?></h3>
							<?php echo $this->element('paging_counter');?>
                        	<div class="table-data">
                         	<ul id="ship-in">
                            	<li class="t-head">
                                	<div class="t-c1"><?php echo __l('PACKAGE NAME'); ?></div>
                                    <div class="t-c2"><?php echo __l('START DATE'); ?> </div>
                                    <div class="t-c3"><?php echo __l('TILL DATE'); ?> </div>
                                    <div class="t-c4"><?php echo __l('STATUS'); ?></div>
                                    <div class="t-c5"><?php echo __l('TRACKING NUMBER'); ?></div>
                                    <div class="t-c6"><?php echo __l('GO'); ?></div>
                                    <div class="clear"></div>
                                </li>
								<?php
								if (!empty($packageUsers)):

								$i = 0;
								foreach ($packageUsers as $packageUser):
									$class = null;
									if ($i++ % 2 == 0) {
										$class = ' class="altrow"';
									}
								?>
								<li class="t-data">
                                	<div class="t-c1"><?php echo $this->Html->cText($packageUser['Package']['PackageType']['name'],false); ?></div>
                                    <div class="t-c2"><?php  echo  date("F Y",strtotime($packageUser['PackageUser']['start_date']));  ?></div>
                                    <div class="t-c3"><?php  echo  date("F Y",strtotime($packageUser['PackageUser']['end_date']));  ?></div>
                                    <div class="t-c4"><?php  echo  date("F Y",strtotime($packageUser['PackageUser']['start_date']));  ?></div>
                                    <div class="t-c5"><?php if(!empty($packageUser['PackageUser']['tracking_number'])): 
																echo $this->Html->cText($packageUser['PackageUser']['tracking_number']);
															else: 
																echo __l('Nil');
														   endif; ?>
									</div>
								   <div class="t-c6"><?php  if(!empty($packageUser['PackageUser']['tracking_number'])): 
																echo $this->Html->link(__l('Go'),'http://203.106.236.200/official/etracking.php', array( 'title' => __l('Go'),'target'=>'_blank', 'class'=>"btn1"));
															 else:
															  echo "---";
															 endif; ?>
									</div>
                                  <div class="clear"></div>
							 </li>    

					<?php
						endforeach;
					else:
					?>
						<li class="t-data"><div class="t-no-result"><?php echo __l('No Subscription available');?></div> <div class="clear"></div>
						</li>
					<?php
					endif;
					?>
                            </ul>
							<?php
							if (!empty($packageUsers)) {
								echo $this->element('paging_links');
							}
							?>
                         </div>
                        </div>
                    </div>
				<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>