				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                    <div class="acc-right">
                     	<h3><?php echo __l('My Gift Subscriptions'); ?></h3>
					<div class="js-tabs">
						<ul class="clearfix">
							<li><?php echo $this->Html->link(__l('Received'),array('controller'=> 'gift_users', 'action'=>'index', 'type' => 'received'),array('title' => 'Received Gift Wonderbox')); ?></li>
							<li><?php echo $this->Html->link(__l('Sent'),array('controller'=> 'gift_users', 'action'=>'index', 'type' => 'sent'), array('title' => 'Sent Gift Wonderbox')); ?></li>
						</ul>
						</div>
						</div>
                </div>
