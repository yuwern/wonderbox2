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
    
	
		<?php
			if (!empty($user['UserProfile']['language_id'])):
		?>
				<dt><?php echo __l('Language');?></dt>
					<dd><?php echo $this->Html->cText($user['UserProfile']['Language']['name']);?></dd>
		<?php
			endif;
		?>
	</dl>


	 </div>

<?php }?>
	 </div>

		</div>
	
</div>