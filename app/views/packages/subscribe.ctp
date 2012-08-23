<div class="subscribe">
				<h1><?php echo __l('subscribe'); ?></h1>
                <h2><?php echo __l('And Treat Yourself to Wonderbox Box Each Month'); ?></h2>
                <div class="subs-left">
                	<h2><?php echo __l('Why should you Subscribe to WONDERBOX?'); ?></h2>
                   <p> <?php echo __l('Aenean dapibus mauris id est faucibus congue. Mauris arcu libero, fringilla egestas commodo quis, porta nec urna. Donec consequat imperdiet mi id dapibus. Nulla aliquam iaculis euismod. Cras ut enim eu lorem molestie aliquam. Suspendisse eu luctus nisi.'); ?></p> <p> <?php echo __l('Vestibulum non nunc quis magna adipiscing feugiat at commodo mauris. Curabitur eget felis lorem, consectetur fringilla dui. Morbi vestibulum ipsum a nulla pulvinar ac consequat nisi vestibulum. Sed non ante quis nibh ultrices commodo. Donec in arcu eget velit porta ultrices vitae varius nunc.'); ?></p> <p> <?php echo __l('Sed scelerisque purus et mi eleifend nec sagittis nunc eleifend. Suspendisse dictum placerat volutpat. Vivamus porttitor cursus arcu, at faucibus lacus posuere quis.'); ?></p> 
                   <h3> <?php echo __l('Earn Wonderbox Points:'); ?></h3>
                   <ul>
                   		<li> <?php echo __l('Curabitur non dolor enim. Nulla eu sem ipsum, id mattis eros.'); ?></li>
                        <li> <?php echo __l('Aenean laoreet blandit ipsum, eu euismod elit vehicula ut.'); ?> </li>
                        <li> <?php echo __l('Duis pellentesque ornare nisi non pellentesque. Vivamus sit amet justo libero. Duis eget mi quis sapien semper eleifend. Proin bibendum tortor in magna pretium commodo.'); ?></li>
                   </ul>
                </div>
                <div class="subs-right">
       	    <div class="subs-box">
				<?php echo $this->Form->create('Package', array('action'=>'paypal','class' => 'normal-form'));?>				    
                    	<ul>
							<?php foreach($packages as $package):
						//	echo "<pre>";
							//	print_r($package);
								if($count == 1){
								$default_value = $package['Package']['id'];
								$count++;
							}
							?>
                        	<li>
							<?php	echo $this->Form->input('id',array('options'=>array($package['Package']['id']=>'<strong>'.$package['PackageType']['name'].'</strong>'),'type'=>'radio','default'=>$default_value,'legend' => false)); ?>				    
							<label for="month"><?php echo Configure::read('site.currency').'  '.$package['Package']['cost']; ?> WonderPoint for <?php echo $package['Package']['no_of_wonderpoints']; ?></label></li>
							<?php endforeach; ?>
                             </ul>
                        <div class="clear"></div>
                        <h3><?php echo __l('Payment Method'); ?></h3>
                      <div class="paypal">  	<?php	
					$paymentOptions = array(ConstPaymentGateways::PayPal=>__l('Paypal'));
					echo $this->Form->input('package_type_id',array('options'=>$paymentOptions,'type'=>'radio','default'=>3,'legend' => false)); ?></div>
				           <div class="subs-btn a-right"><?php echo 
						   $this->Html->image('pay-logo.jpg',array('class'=>'f-left')); ?><?php echo $this->Form->submit(__l('Next'),array('class'=>'but6 f-right','div'=>'next-btn'));?></div>
					  <?php echo $this->Form->end();?>
                  </div>
                </div>
                </div>
			