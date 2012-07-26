
<div class="reg">
                <div class="reg-left">
	   <h3><?php echo __l('Sign in with your').' '.Configure::read('site.name').' '.__l('Account'); ?> </h3>
	<?php
		$formClass = !empty($this->request->data['User']['is_requested']) ? 'js-ajax-login' : '';
		echo $this->Form->create('User', array('action' => 'login', 'class' => 'normal '.$formClass));?>
  <ul>
		   <li>
		<?php  	echo $this->Form->input(Configure::read('user.using_to_login'),array('label'=>ucwords(Configure::read('user.using_to_login')).'*')); ?>
			</li>
		<li>
		<?php 	echo $this->Form->input('passwd', array('label' => __l('Password*')));
		if(!empty($this->request->data['User']['is_requested'])) {
			echo $this->Form->input('is_requested', array('type' => 'hidden'));
		}
	?>
	</li>
	<li>
	<div style="padding-left:180px">
	<?php echo $this->Form->input('User.is_remember', array('type' => 'checkbox', 'label' => __l('Remember me on this computer.'),'class'=>'remember')); ?>
	</div>
	<div class="fromleft clear">
		<?php echo $this->Html->link(__l('Forgot your password?') , array('controller' => 'users', 'action' => 'forgot_password', 'admin' => false),array('title' => __l('Forgot your password?'))); ?>
		<?php if(!(!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') && empty($this->request->data['User']['is_requested'])): ?> |
			<?php  echo $this->Html->link(__l('Signup') , array('controller' => 'users',	'action' => 'register'),array('title' => __l('Signup'))); ?>
		<?php endif; ?>
	</div>

	<?php
		@$_GET['f'] = (!empty($this->request->data['User']['is_requested']) ? $_GET['url'] : $_GET['f']);  // Fix for gift card redeem redirect
		$f = (!empty($_GET['f'])) ? $_GET['f'] : ((!empty($this->request->data['User']['f'])) ? $this->request->data['User']['f'] : (($this->request->params['controller'] != 'users' && ($this->request->params['action'] != 'login' && $this->request->params['action'] != 'admin_login')) ? $this->request->url : ''));
			if (!empty($f)):
				echo $this->Form->input('f', array('type' => 'hidden', 'value' => $f));
			endif;
	?>
		</li>
	<li>
	<div class="submit-block clearfix">
		<?php echo $this->Form->submit(__l('Login')); ?>
		<?php if(!empty($this->request->data['User']['is_requested']) && $this->request->data['User']['is_requested']):  ?>
			<div class="cancel-block js-cancel-block">
				<?php echo $this->Html->link(__l('Cancel'), '#', array('title' => __l('Never Mind'),'class' => "cancel-button js-toggle-show {'container':'js-login-message', 'hide_container':'js-login-form'}"));?>
			</div>
		<?php endif; ?>
	</div>
		</li>
		</ul>
	<?php echo $this->Form->end(); ?>

	</div>
	 <div class="user-login">
                <span class="signf">or sign in with your Facebook Account</span>
				 <?php if(Configure::read('facebook.is_enabled_facebook_connect')):  ?>
						<?php echo $this->Html->link( $this->Html->image('joinfacebook.jpg'), array('controller' => 'users', 'action' => 'login','type'=>'facebook'), array('title' => __l('Sign in with Facebook'), 'escape' => false)); ?>
					 <?php endif; ?>
                     <span class="sign">Already a member? <?php echo $this->Html->link(__l('Sign up'), array('controller' => 'users', 'action' => 'register'), array('title' => __l('Sign in')));?></span>
                </div>
</div>