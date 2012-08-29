<div class="subscribe">
				<h1><?php echo __l('subscribe'); ?></h1>
                <h2><?php echo __l('And Treat Yourself to Wonderbox Box Each Month'); ?></h2>
                <div class="subs-left">
                	<h2><?php echo __l('Don't miss out! Only limited boxes available every month.'); ?></h2>
                   <p> <?php echo __l('Aenean dapibus mauris id est faucibus congue. Mauris arcu libero, fringilla egestas commodo quis, porta nec urna. Donec consequat imperdiet mi id dapibus. Nulla aliquam iaculis euismod. Cras ut enim eu lorem molestie aliquam. Suspendisse eu luctus nisi.'); ?></p> <p> <?php echo __l('Vestibulum non nunc quis magna adipiscing feugiat at commodo mauris. Curabitur eget felis lorem, consectetur fringilla dui. Morbi vestibulum ipsum a nulla pulvinar ac consequat nisi vestibulum. Sed non ante quis nibh ultrices commodo. Donec in arcu eget velit porta ultrices vitae varius nunc.'); ?></p> <p> <?php echo __l('Sed scelerisque purus et mi eleifend nec sagittis nunc eleifend. Suspendisse dictum placerat volutpat. Vivamus porttitor cursus arcu, at faucibus lacus posuere quis.'); ?></p> 
                   <h3> <?php echo __l('Earn Wonderbox Points:'); ?></h3>
                   <ul>
                   		<li> <?php echo __l('Don't miss out! Only limited boxes available every month.'); ?></li>
                        <li> <?php echo __l('Aenean laoreet blandit ipsum, eu euismod elit vehicula ut.'); ?> </li>
                        <li> <?php echo __l('Duis pellentesque ornare nisi non pellentesque. Vivamus sit amet justo libero. Duis eget mi quis sapien semper eleifend. Proin bibendum tortor in magna pretium commodo.'); ?></li>
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
							
							<label for="month"><?php echo Configure::read('site.currency').'  '.$package['Package']['cost']; ?> WonderPoint for <?php echo $package['Package']['no_of_wonderpoints']; ?></label></li>
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
									You will be billed <?php echo Configure::read('site.currency'); ?> <span class="js-payment-amount"><?php echo($packages[0]['Package']['cost']); ?></span> every <span class="js-payment-month-display"><?php echo($packages[0]['PackageType']['no_of_months']); ?></span> month
								</div>

							</div>
							<div class="js-molpay payment-details hide">
								<?php echo $this->Html->image('logo_visa.gif',array('width'=>65,'height'=>21)); ?><?php echo $this->Html->image('logo_mastercard.gif',array('width'=>51,'height'=>30)); ?><?php echo $this->Html->image('logo_7eleven.gif',array('width'=>42,'height'=>38)); ?><?php echo $this->Html->image('logo_myclear.gif',array('width'=>100,'height'=>38)); ?><?php echo $this->Html->image('logo_maybank2u.gif',array('width'=>130,'height'=>20)); ?><?php echo $this->Html->image('logo_pbebank.gif',array('width'=>84,'height'=>22)); ?><?php echo $this->Html->image('logo_cimbclick.gif',array('width'=>88,'height'=>15)); ?><?php echo $this->Html->image('logo_bankislam.gif',array('width'=>123,'height'=>24)); ?>
							<?php echo $this->Html->image('logo_hongleongonline.gif',array('width'=>123,'height'=>24)); ?><?php echo $this->Html->image('logo_allianceonline.gif',array('width'=>108,'height'=>20)); ?><?php echo $this->Html->image('logo_amonline.gif',array('width'=>68,'height'=>13)); ?><?php echo $this->Html->image('logo_eonbank.gif',array('width'=>90,'height'=>13)); ?>
								<div class="payment-content">
									You will be billed <?php echo Configure::read('site.currency'); ?> <span class="js-payment-amount"> <?php echo($packages[0]['Package']['cost']); ?></span>  for <span class="js-payment-month-display"><?php echo($packages[0]['PackageType']['no_of_months']); ?></span>  months subscription. If you would like to not have the hassle for renewal, kindly select Paypal as your payment option
								</div>
							</div>
					
				        <div class="a-right subs-btn">
						<?php echo $this->Form->submit(__l('Next'),array('class'=>'but6 f-right','div'=>'next-btn'));?></div>
					  <?php echo $this->Form->end();?>
                  </div>
                </div>
                </div>
			