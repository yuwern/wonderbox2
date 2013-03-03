				<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('Password Change'); ?></h1>
                            <p> <?php echo __l(''); ?></p>
                        </div>
                       	<div class="acc-fm-box">
                        	<h3><?php echo __l('Change Password'); ?></h3>
                        	<?php
								echo $this->Form->create('User', array('action' => 'change_password' ,'class' => 'normal-form js-ajax-form')); 
								if($this->Auth->user('user_type_id') == ConstUserTypes::Admin) :
									echo $this->Form->input('user_id', array('label' => __l('User'),'empty' => __l('Please Select')));
								endif;
								if($this->Auth->user('user_type_id') != ConstUserTypes::Admin) :
									echo $this->Form->input('user_id', array('type' => 'hidden','label' => __l('User'),'readonly' => 'readonly'));
									echo $this->Form->input('old_password', array('type' => 'password','label' => __l('Old Password') ,'id' => 'old-password'));
								endif;
								echo $this->Form->input('passwd', array('type' => 'password','label' => __l('New Password') , 'id' => 'new-password'));
								echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => __l('Confirm Password'))); 
								echo $this->Form->submit(__l('Update'),array('class'=>'btn1'));
								echo $this->Form->end();
							?>
                        </div>
                    </div>
				<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>