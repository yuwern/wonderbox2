<?php /* SVN: $Id: view.ctp 59962 2011-07-12 05:23:36Z boopathi_026ac09 $ */ ?>
<div class="users view">
    <h2><?php echo ucfirst($this->Html->cText($user['UserProfile']['first_name'], false)); ?></h2>

	 <div class="clearfix viewpage-content">
	 <div class="clearfix">
	 <div class="user-avatar user-view-image">
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
    <?php if(!empty($user['UserProfile']['about_me'])){ ?>
     <div class="about-content round-5">
	    <?php if(!empty($user['UserProfile']['about_me'])): ?>
			<h3><?php echo __l('About Me');?></h3>
			<p><?php echo nl2br($this->Html->cText($user['UserProfile']['about_me']));?></p>
		<?php endif; ?>
    </div>
    <?php } ?>
		<dl class="list company-list clearfix round-5">
        <?php if($user['UserProfile']['created'] != '0000-00-00 00:00:00'){ ?>
			<dt><?php echo __l('Member Since');?></dt>
			<dd><?php echo $this->Html->cDate($user['User']['created']);?></dd>
		<?php } ?>
	      <?php if(!empty($user['UserProfile']['first_name'])){ ?>
			<dt><?php echo __l('First name');?></dt>
			<dd><?php echo $this->Html->cText($user['UserProfile']['first_name']);?></dd>
		<?php } ?>
      
    
	      <?php if(!empty($user['UserProfile']['last_name'])){ ?>
			<dt><?php echo __l('Last name');?></dt>
			<dd><?php echo $this->Html->cText($user['UserProfile']['last_name']);?></dd>
		<?php } ?>
		
	      <?php if(!empty($user['UserShipping'][0]['address'])){ ?>
			<dt><?php echo __l('Address');?></dt>
			<dd><?php echo $this->Html->cText($user['UserShipping'][0]['address']);?></dd>
		<?php } ?>
		 <?php if(!empty($user['UserShipping'][0]['zip_code'])){ ?>
			<dt><?php echo __l('Postal Code');?></dt>
			<dd><?php echo $this->Html->cText($user['UserShipping'][0]['zip_code']);?></dd>
		<?php } ?>
		<?php if(!empty($user['UserShipping'][0]['phone_number'])){ ?>
			<dt><?php echo __l('Contact No.');?></dt>
			<dd><?php echo $this->Html->cText($user['UserShipping'][0]['contact_no']);?></dd>
		<?php } ?>
	</dl>


	 </div>

<?php }?>
	 </div>

		</div>
	
</div>