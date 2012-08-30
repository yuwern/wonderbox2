<div class="subscribe">
				<h1><?php echo __l('Subscribe Now'); ?></h1>
                <h2><?php echo __l('And Treat Yourself to Wonderbox Box Each Month'); ?></h2>
                <div class="subs-left">
                <h2><?php echo __l("Don't miss out! Only limited boxes available every month."); ?></h2>
                   <p> <?php echo __l('Every subscription entitles you to receive your very own WonderBox that will be delivered to you via courier every month. '); ?></p> 
                   <p> <?php echo __l('As only a limited number of WonderBoxes will be produced every month, WonderBoxes will be allocated on a first come first serve basis. Members who have pre-booked their monthly WonderBoxes with quarterly, bi-annual or annual subscriptions will be the first in line to receive these limited edition WonderBoxes.'); ?></p> 
                   
                   <h3> <?php echo __l('Earn more WonderPoints with longer subscriptions:'); ?></h3>
                   <ul>
                   	<li> <?php echo __l('Be rewarded with WonderPoints with quarterly, bi-annual or annual subscriptions.'); ?></li>
                        <li> <?php echo __l('Receive your WonderPoints immediately upon completing your subsciription.'); ?> </li>
                        <li> <?php echo __l('Use WonderPoints to extend your WonderBox subscription by 1 month for 800 WonderPoints.'); ?></li>
                        <li> <?php echo __l('Redeem a WonderBox as a giftbox to your friend by using WonderPoints.'); ?></li>
                   </ul>
                </div>
                <div class="subs-right">
       	    <div class="subs-box">
				<?php echo $this->Form->create('Package', array('action'=>'paypal','class' => 'normal-form'));?>				    
                    	<ul>
							<?php $count = 1;
							foreach($packages as $package):
						//	echo "<pre>";
							//	print_r($package);
							?>
                        	<li>
							<?php
							if($count == 1){
								$default_value = $package['Package']['id'];
								$count++;
							}
							echo $this->Form->input('id',array('options'=>array($package['Package']['id']=>'<strong>'.$package['PackageType']['name'].'</strong>'),'type'=>'radio','default'=>$default_value,'class'=>'js-payment-type','legend' => false));
							echo $this->Form->input('cost',array('type'=>'hidden','value'=>$package['Package']['cost'],'id'=>'js-payment-cost'.$package['Package']['id'],'legend' => false));
							echo $this->Form->input('month',array('type'=>'hidden','value'=>$package['PackageType']['no_of_months'],'id'=>'js-payment-month'.$package['Package']['id'],'legend' => false));
							
							?>	
							
							<label for="month"><?php echo Configure::read('site.currency').'  '.$package['Package']['cost']; ?> to earn <?php echo $package['Package']['no_of_wonderpoints']; ?> WonderPoints </label></li>
							<?php endforeach; ?>
                             </ul>
                        <div class="clear"></div>
                        <h3><?php echo __l('Payment Method'); ?></h3>
                      <div class="paypal">  	<?php	
					//$paymentOptions = array(ConstPaymentGateways::PayPal=>__l('Paypal'));
					echo $this->Form->input('package_type_id',array('options'=>$paymentgateways,'type'=>'radio','default'=>3,'class'=>'js-payment-options','legend' => false)); 
					?></div>
							<div class="js-paypal payment-details ">
									<?php echo $this->Html->image('pay-logo.jpg',array('class'=>'f-left')); ?>
									<div class="payment-content">
									You will be billed <?php echo Configure::read('site.currency'); ?> <span class="js-payment-amount"><?php echo($packages[0]['Package']['cost']); ?></span> every <span class="js-payment-month-display"><?php echo($packages[0]['PackageType']['no_of_months']); ?></span> month(s)


								</div>

							</div>
							<div class="js-molpay payment-details hide">
								<?php echo $this->Html->image('logo_visa.gif',array('width'=>65,'height'=>21)); ?><?php echo $this->Html->image('logo_mastercard.gif',array('width'=>51,'height'=>30)); ?><?php echo $this->Html->image('logo_7eleven.gif',array('width'=>42,'height'=>38)); ?><?php echo $this->Html->image('logo_myclear.gif',array('width'=>100,'height'=>38)); ?><?php echo $this->Html->image('logo_maybank2u.gif',array('width'=>130,'height'=>20)); ?><?php echo $this->Html->image('logo_pbebank.gif',array('width'=>84,'height'=>22)); ?><?php echo $this->Html->image('logo_cimbclick.gif',array('width'=>88,'height'=>15)); ?><?php echo $this->Html->image('logo_bankislam.gif',array('width'=>123,'height'=>24)); ?>
							<?php echo $this->Html->image('logo_hongleongonline.gif',array('width'=>123,'height'=>24)); ?><?php echo $this->Html->image('logo_allianceonline.gif',array('width'=>108,'height'=>20)); ?><?php echo $this->Html->image('logo_amonline.gif',array('width'=>68,'height'=>13)); ?><?php echo $this->Html->image('logo_eonbank.gif',array('width'=>90,'height'=>13)); ?>
								<div class="payment-content">
									You will be billed <?php echo Configure::read('site.currency'); ?> <span class="js-payment-amount"> <?php echo($packages[0]['Package']['cost']); ?></span>  for <span class="js-payment-month-display"><?php echo($packages[0]['PackageType']['no_of_months']); ?></span>  month(s) subscription. If you would like to not have the hassle for renewal, kindly select Paypal as your payment option
								</div>
							</div>
					
				        <div class="a-right subs-btn">
						<?php echo $this->Form->submit(__l('Next'),array('class'=>'but6 f-right','div'=>'next-btn'));?></div>
					  <?php echo $this->Form->end();?>
                  </div>
                </div>
                </div>
			