<div class="subscriptions form clearfix thanks">	
 <h3><?php echo __l('Subscription'); ?> </h3>
 <p>Not ready to join the WonderBox community yet?
You can still subscribe to our regular e-mail newsletter to get access to the latest trend and development in the world of fashion and beauty. Just leave us your e-mail and we will be sending your regular updates. </p>
				<?php echo $this->Form->create('Subscription', array('class' => 'subscription clearfix', 'id' => 'SubscriptionAddForm'));?>
					<?php echo $this->Form->input('email',array('label' => __l('Email'), 'class' => 'emailsubscription', 'id' => 'SubscriptionEmail')); ?>
						<div class="clearfix">
						<?php echo $this->Form->submit(__l('Subscribe'));?>
					</div>
				<?php echo $this->Form->end();?>
</div>
