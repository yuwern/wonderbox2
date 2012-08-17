<div class="subscriptions form clearfix thanks">	
 <h3><?php echo __l('Subscription'); ?> </h3>
 <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi commodo, ipsum sed pharetra gravida, orci magna rhoncus neque, id pulvinar odio lorem non turpis. Nullam sit amet enim. </p>
				<?php echo $this->Form->create('Subscription', array('class' => 'subscription clearfix', 'id' => 'SubscriptionAddForm'));?>
					<?php echo $this->Form->input('email',array('label' => __l('Email'), 'class' => 'emailsubscription', 'id' => 'SubscriptionEmail')); ?>
						<div class="clearfix">
						<?php echo $this->Form->submit(__l('Subscribe'));?>
					</div>
				<?php echo $this->Form->end();?>
</div>
