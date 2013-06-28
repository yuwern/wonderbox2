			<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('Account Transactions'); ?></h1>
                        </div>
                       	<div class="acc-trans">
                        	<h3><?php echo __l('My Transactions'); ?></h3>
							<?php echo $this->element('paging_counter');?>
                        	<div class="table-data">
                         	<ul id="ship-in">
                            	<li class="t-head">
                                	<div class="t-c1"><?php echo __l('DATE'); ?> </div>
                                    <div class="t-c2"><?php echo __l('BILLING CYCLE'); ?> </div>
                                    <div class="t-c3"><?php echo __l('TYPE'); ?> </div>
                                    <div class="t-c4"><?php echo __l('AMOUNT'); ?> </div>
                                    <div class="t-c5"><?php echo __l('WONDER POINTS'); ?></div>
                                    <div class="clear"></div>
                                </li>
							    <?php
									if (!empty($transactions)):
										$i = 0;
										$j = 1;
										foreach ($transactions as $transaction):
											$class = null;
											if ($i++ % 2 == 0) {
												$class = ' class="altrow"';
											}
								?>
									<li class="t-data">
										<div class="t-c1"><?php  echo  date("j F Y",strtotime($transaction['Transaction']['created']));  ?></div>
										<div class="t-c2"><?php  
											 if($transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPoint ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPointAdd || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductSurveryWonderPoint || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ShareExperience ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductDamage || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::Refund     || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperiencePhoto || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperienceBlog || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::ExperienceVideo || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::BeautyTipAmountPaid  || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::ProductRedemptionAmountPaid  ):
 											echo ' -- ';
											else:
											echo $this->Html->cText($transaction['Package']['name'],false);
											endif;
											?>
										</div>
										<div class="t-c3">	<?php 
											 if($transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPoint ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPointAdd || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductSurveryWonderPoint || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ShareExperience ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductDamage || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::Refund     || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperiencePhoto || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperienceBlog || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::ExperienceVideo|| $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::BeautyTipAmountPaid   ):

											echo $this->Html->cText($transaction['TransactionType']['name'],false);
											else:
											echo $this->Html->cText($transaction['TransactionType']['name'],false);
											endif;
										?></div>
										<div class="t-c4"><?php
										if($transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPoint ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPointAdd || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductSurveryWonderPoint || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ShareExperience ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductDamage || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::Refund     || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperiencePhoto || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperienceBlog || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::ExperienceVideo   ):
												echo ' -- ';
										else:
												echo Configure::read('site.currency'). ' '. $this->Html->cFloat($transaction['Transaction']['amount'],false);
										endif;
										?></div>
									<div class="t-c5">  <?php if($transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPoint ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralWonderPointAdd || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductSurveryWonderPoint || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ShareExperience ||$transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ProductDamage || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::Refund     || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperiencePhoto || $transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ExperienceBlog || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::ExperienceVideo || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::BeautyTipAmountPaid || $transaction['Transaction']['transaction_type_id'] ==  ConstTransactionTypes::ProductRedemptionAmountPaid   ):
										   echo $this->Html->cText($transaction['Transaction']['wonder_points']);
										else:
										  echo $this->Html->cText($transaction['Package']['no_of_wonderpoints'],false);
										endif;
									 ?></div>
										<div class="clear"></div>
									</li>
								<?php
									$j++;
									endforeach;
									else:
								?>
									 <li class="t-data">
										<div class="t-no-result"><?php echo __l('No Transactions available');?></div><div class="clear"></div>
									 </li>
								<?php
								endif;
								?>
                            </ul>
                         </div>
						   <?php
							if (!empty($transactions)) {
								?>
									<div class="js-pagination">
										<?php echo $this->element('paging_links'); ?>
									</div>
								<?php
							}
							?>
                        </div>
                        
                    </div>
           <?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>