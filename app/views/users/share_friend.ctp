			<div class="refer-sys">
				<div class="refer-sys-pad">
                    <h1><?php echo __l('Refer Friends, Earn WonderBox Points!'); ?></h1>
                    <p><?php echo __l('Quisque facilisis nisi et dolor ultricies rhoncus. Morbi nisi sem, tincidunt at gravida ac, eleifend quis tellus. Pellentesque vel sodales mauris. Maecenas in enim risus. Mauris condimentum dolor in ante pulvinar quis tristique leo dictum. Ut hendrerit ipsum in ante facilisis euismod. Mauris in est elit.'); ?> </p>
                    <div class="share-box">
                    	<div class="share-box-left">
                        	<h2><?php echo __l('Invite Friends from Facebook'); ?></h2>
                       		<?php
							$share_url = Router::url('/', true).'users/refer/r:'.$this->Auth->user('email');
							?>
							<?php echo $this->Html->link(__l('Share it on Facebook'), 'http://www.facebook.com/share.php?u='.Router::url(array('controller' => 'users', 'action' => 'refer', 'r' =>$this->Auth->user('email')), true), array('class' => 'face','target' => 'blank'));?>
                        </div>
                        <div class="share-box-right">
                        	<h2><?php echo __l('Share this link anywhere'); ?></h2>
							<input type='text' value='<?php echo $share_url; ?>' readonly="true" class="refer-url-code" />
                        </div>
                    </div>
                    <h2><?php echo __l('Or Invite by Email'); ?></h2>
					<?php	echo $this->Form->create('User', array('action' => 'share_friend', 'class' => 'refer-form')); ?>
                     <ul>
              				<li>
                            	<?php echo $this->Form->input('friends_email',array('type' => 'textarea', 'label' => __l('Email Addresses:'), 'info' => __l('Comma separated Email Addresses'))); ?>
                             </li>
							 <li>
                            	<?php echo $this->Form->input('message',array('type' => 'textarea', 'label' => __l('Message:')));?>
                             </li>
                            	
                             <li>
                            	<span><label for="msg">&nbsp;</label></span>
                                <span><?php  echo $this->Form->submit(__l('Send'),array('class'=>'but6','div'=> false)); ?></span>
								
                            </li>
                     </ul>
					<?php echo $this->Form->end(); ?>
				</div>
		</div>	
