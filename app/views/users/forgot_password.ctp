	<div class="signup">
                	<div class="singup-left"><?php echo $this->Html->image('login_bg.jpg'); ?></div>
                    <div class="singup-right">
                    	<div class="head mb40">
                        	<h1><?php echo __l('Forgot your password?');?></h1>
							<p><?php echo __l('Enter your Email, and we will send you instructions for resetting your password.'); ?></p> 
                        </div>
                        <div class="forget-box-left">
                        	<?php 
									echo $this->Form->create('User', array('action' => 'forgot_password', 'class' => 'normal'));
									echo $this->Form->input('email', array('type' => 'text','label' => __l('Email')));
									echo $this->Form->submit(__l('Send'),array('class'=>'btn1'));
									echo $this->Form->end();
									
									?>
                        </div>
             </div>
	</div>
            
		