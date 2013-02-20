<div  class="user-view" >
		<div class="head"><h1><?php echo ucfirst($this->Html->cText($user['UserProfile']['first_name'], false)); ?></h1></div>
		<div class="user-avatar">
		  <?php
							$current_user_details = array(
								'username' => $user['User']['username'],
								'user_type_id' =>  $user['User']['user_type_id'] ,
								'id' =>  $user['User']['id'],
								'fb_user_id' => $user['User']['fb_user_id']
							);
    						$current_user_details['UserAvatar'] = $this->Html->getUserAvatar($user['User']['id']);
    						echo $this->Html->getUserAvatarLink($current_user_details, 'big_thumb'); 
						?>
		</div>
		<?php if(!empty($user['UserProfile'])){ ?>
		 <div class="user-view-content">
				 <?php if(!empty($user['UserProfile']['about_me'])): ?>
				<h3><?php echo __l('About Me');?></h3><p><?php echo nl2br($this->Html->cText($user['UserProfile']['about_me']));?></p><br/>
				<?php endif; ?>
				<?php if($user['UserProfile']['created'] != '0000-00-00 00:00:00'): ?>
					<h3> <?php echo __l('Member Since');?> :</h3> <p><?php echo $this->Html->cDate($user['User']['created']);?></p><br/>
				<?php endif; ?>
				<?php if(!empty($user['UserProfile']['first_name'])): ?>
				<h3><?php echo __l('First name');?> :</h3> <p> <?php echo $this->Html->cDate($user['UserProfile']['first_name']);?></p><br/>
				<?php endif; ?>
				<?php if(!empty($user['UserProfile']['last_name'])): ?>
				<h3> <?php echo __l('Last name');?> :</h3> <p> <?php echo $this->Html->cDate($user['UserProfile']['last_name']);?></p><br/>
				<?php endif; ?>
				  <?php if(!empty($user['UserShipping'][0]['address'])){ ?>
					<h3><?php echo __l('Address');?>: </h3> <p> <?php echo $this->Html->cText($user['UserShipping'][0]['address']);?></p><br/>
				<?php } ?>
				 <?php if(!empty($user['UserShipping'][0]['zip_code'])){ ?>
					<h3><?php echo __l('Postal Code');?>:</h3> <p><?php echo $this->Html->cText($user['UserShipping'][0]['zip_code']);?></p><br/>
				<?php } ?>
				<?php if(!empty($user['UserShipping'][0]['phone_number'])){ ?>
					<h3><?php echo __l('Contact No.');?> :	</h3> <p><?php echo $this->Html->cText($user['UserShipping'][0]['contact_no']);?></p><br/>
				<?php } ?>
		</div>
		<?php } ?>
</div>