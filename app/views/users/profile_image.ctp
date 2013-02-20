			<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('Beauty Account'); ?></h1>
                            <p> <?php echo __l('Account copywriting text, temporary text, layout format, copywriting text, temporary text, layout format.'); ?></p>
                        </div>
                       	<div class="acc-fm-box">
                        	<h3><?php echo __l('My Profile Image'); ?></h3>
								<div class="pro-img"><?php
								$current_user_details = array(
								'username' => $this->Auth->user('username'),
								'user_type_id' =>  $this->Auth->user('user_type_id'),
								'id' =>  $this->Auth->user('id'),
								'fb_user_id' =>  $this->Auth->user('fb_user_id')
							);                         
                    		$current_user_details['UserAvatar'] = $this->Html->getUserAvatar($this->Auth->user('id'));
							echo $this->Html->getUserAvatarLink($current_user_details, 'big_thumb'); ?>
							</div>
					
							 <div class="pro-upload">
                            	<span><?php echo __l('Upload Image'); ?></span>
                               	<?php echo $this->Form->create('User', array('action' => 'profile_image', 'class' => 'normal-form',  'enctype' => 'multipart/form-data'));
								echo $this->Form->input('User.id', array('type' => 'hidden'));
								echo $this->Form->input('User.profile_image_id', array('type'=>'hidden','value'=> 3)); 
								echo $this->Form->input('UserAvatar.filename', array('type' => 'file','size' => '20', 'label' => false,'class' =>'browse-field'));
								echo $this->Form->submit(__l('Update'),array('class'=>'btn1','div'=>'input'));
								echo $this->Form->end();
							?>
                            </div>
                        </div>
                    </div>
				<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>