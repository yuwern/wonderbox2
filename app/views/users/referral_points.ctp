		      	<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                   	<div class="head">
                        	<h1><?php echo __l('My WonderPoints'); ?></h1>
                            <p><?php echo __l(''); ?></p>
                        </div>
                       	<div class="referral_point-banner">
                        	<h1><?php echo __l('Start refer'); ?> &amp; <?php echo __l('EARN'); ?> <br /><?php echo __l('text draft'); ?></h1>
                            <div class="refer-point">
                            	<div class="poin-left">
                                	<p><?php echo __l('Your total points'); ?></p>
                                    <span><?php echo $this->Html->cInt($referral_points['TotalPoints']['All'],false); ?></span>
                                </div>
                                <div class="poin-right">
                                	<p><?php echo __l('This month'); ?></p>
                                    <span><?php echo $this->Html->cInt($referral_points['TotalPoints']['Month'],false); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="poin-box">
                        	<div class="p-box">
							  	<h1><?php echo __l('Friends Referral Program'); ?></h1>
                           		<p class="rpoint-img"><?php echo $this->Html->image('refer_pro_img.jpg'); ?></p> 
                                <p><?php echo __l('No. of friends joined'); ?></p>
                            	<p><label><?php echo __l('This month'); ?> 	</label><span>: <strong><?php echo $referral_points['TotalReferralFriend']['Month']['total_no_users']; ?></strong></span></p>
                                <p><label><?php echo __l('Total'); ?>  	</label><span>: <strong><?php echo $referral_points['TotalReferralFriend']['All']['total_no_users']; ?></strong></span></p> 
                                <div class="total-point">
                                	<p class="a-center"><?php echo $this->Html->image('total_point.jpg',array('width'=>155,'height'=>27)); ?></p>
                                    <p class="total-earn-point">
                                    	<span><?php echo $this->Html->cInt($referral_points['TotalReferralFriend']['All']['wonderpoint'],false); ?></span>
                                    </p>
                                    <p class="a-center"><em><?php echo __l('Points earned this month:'); ?><span class="pink"> <?php echo $this->Html->cInt($referral_points['TotalReferralFriend']['Month']['wonderpoint'],false); ?> WP</span></em></p>
                                </div>
                          </div>
                            
                            <div class="p-box">
                            	<h1><?php echo __l('Survey'); ?></h1>
                           		<p class="rpoint-img"><?php echo $this->Html->image('refer_pro_img2.jpg'); ?></p> 
                                <p><?php echo __l('No of survey completed'); ?></p>
                            	<p><label><?php echo __l('This month '); ?>	</label><span>: <strong><?php echo $referral_points['TotalSurvey']['Month']['no_of_survey']; ?></strong></span></p>
                                <p><label><?php echo __l('Total'); ?>  	</label><span>: <strong><?php echo $referral_points['TotalSurvey']['All']['no_of_survey']; ?></strong></span></p> 
                                <div class="total-point">
                                	<p class="a-center"><?php echo $this->Html->image('total_point.jpg',array('width'=>155,'height'=>27)); ?></p>
                                    <p class="total-earn-point">
                                    	<span><?php echo $this->Html->cInt($referral_points['TotalSurvey']['All']['wonderpoint'],false); ?></span>
                                    </p>
                                    <p class="a-center"><em><?php echo __l('Points earned this month:'); ?><span class="pink"> <?php echo $this->Html->cInt($referral_points['TotalSurvey']['Month']['wonderpoint'],false); ?> WP</span></em></p>
                                </div>
                          </div>
                            <div class="p-box mr-none">
                            	<h1><?php echo __l('Experience shared'); ?></h1>
                           		<p class="rpoint-img"><?php echo $this->Html->image('refer_pro_img3.jpg'); ?></p> 
                                <p><?php echo __l('Shared Experience'); ?></p>
                            	<p><label><?php echo __l('This month'); ?> 	</label><span>: <strong><?php echo $referral_points['TotalExperienceShared']['Month']['no_of_survey']; ?></strong></span></p>
                                <p><label><?php echo __l('Total'); ?>  	</label><span>: <strong><?php echo $referral_points['TotalExperienceShared']['All']['no_of_survey']; ?></strong></span></p> 
                                <div class="total-point">
                                	<p class="a-center"><?php echo $this->Html->image('total_point.jpg',array('width'=>155,'height'=>27)); ?></p>
                                    <p class="total-earn-point">
                                    	<span><?php echo $this->Html->cInt($referral_points['TotalExperienceShared']['All']['wonderpoint'],false); ?></span>
                                    </p>
                                    <p class="a-center"><em><?php echo __l('Points earned this month:'); ?><span class="pink"> <?php echo $this->Html->cInt($referral_points['TotalExperienceShared']['Month']['wonderpoint'],false); ?> WP</span></em></p>
                                </div>
                          </div>
                        </div>
                        <div class="refer-text">
                        	<p><strong>What is WonderBoxPoints (WP)?</strong>
WonderPoints are reward points all WonderBox members can earn by sharing their experience and contributing to the enrichment of the WonderBox community </p>

<p><strong>How can i redeem?</strong>
You can redeem a complimentary WonderBox monthly subscription by navigating to the option "My Subscription" or you can redeem a wonderful gift sets by navigating to the option "Product Redemption"</p>

<p><strong>Will my WonderBox Point (WP) expired?</strong>
There is no expiry date for your WonderPoints. Awesome right? </p>

                        </div>
                        <div class="refer-copy">
                        	<p><strong>Terms & Conditions</strong></p>
                            <p></p>
                            <ol>
                                <li>WonderPoints are only valid for subscription and product gift redemption </li>
                                <li>WonderPoints earned in this programme have no cash or monetary value and cannot be exchanged for cash.</li>

                            </ol>
                        </div>
                    </div>
			<?php if(empty($this->request->params['isAjax']) ): ?>
			</div>
			<?php endif; ?>