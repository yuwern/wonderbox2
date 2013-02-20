	<div class="signup">
                	<div class="singup-left"><?php echo $this->Html->image('login_bg.jpg'); ?></div>
                    <div class="singup-right">
                    	<div class="head mb40">
                        	<h1><?php echo __l('Sign in with your').' '.Configure::read('site.name').' '.__l('Account'); ?></h1>
                           <!-- <p>Contact copywriting text, temporary text, layout format, copywriting text, temporary text, layout format, copywriting text.</p> -->
                        </div>
                        <div class="signup-box-left">
                        	<?php $formClass = !empty($this->request->data['User']['is_requested']) ? 'js-ajax-login' : '';
								echo $this->Form->create('User', array('action' => 'login', 'class' => 'normal '.$formClass));?>
							<?php echo $this->Form->input(Configure::read('user.using_to_login'),array('label'=>ucwords(Configure::read('user.using_to_login')))); ?>
							<?php 	echo $this->Form->input('passwd', array('label' => __l('Password')));
									if(!empty($this->request->data['User']['is_requested'])) {
										echo $this->Form->input('is_requested', array('type' => 'hidden'));
									}
							?>	
							<?php echo $this->Form->input('User.is_remember', array('type' => 'checkbox', 'label' =>' '. __l(' Remember me on this computer.'),'class'=>'remember')); ?>
							<?php
							@$_GET['f'] = (!empty($this->request->data['User']['is_requested']) ? $_GET['url'] : $_GET['f']);  // Fix for gift card redeem redirect
							$f = (!empty($_GET['f'])) ? $_GET['f'] : ((!empty($this->request->data['User']['f'])) ? $this->request->data['User']['f'] : (($this->request->params['controller'] != 'users' && ($this->request->params['action'] != 'login' && $this->request->params['action'] != 'admin_login')) ? $this->request->url : ''));
								if(!empty($f)){
								$new_f = explode('/',$f);
								if(!empty($new_f) && $new_f[1]=='packages' && $new_f[2]=='paypal' )
									$f='packages/subscribe';
								}
								if (!empty($f)):
									echo $this->Form->input('f', array('type' => 'hidden', 'value' => $f));
								endif;
							?>
							<div class="input login-link no-pad">
                                	<label>&nbsp;</label><?php echo $this->Html->link(__l('Forgot your password?') , array('controller' => 'users', 'action' => 'forgot_password', 'admin' => false),array('title' => __l('Forgot your password?'))); ?> 
									<?php if(!(!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') && empty($this->request->data['User']['is_requested'])): ?> |
									<?php  echo $this->Html->link(__l('Signup') , array('controller' => 'users',	'action' => 'register'),array('title' => __l('Signup'))); ?>
								<?php endif; ?>
                              </div>
							  <?php echo $this->Form->submit(__l('Login'),array('class'=>'btn1')); ?>
						      <?php echo $this->Form->end(); ?>
                        </div>
		   			 <?php if(Configure::read('facebook.is_enabled_facebook_connect')):  ?>
                        <div class="signup-box-right login-r-img"><?php echo $this->Html->link( $this->Html->image('facebook_join.jpg',array('width'=>'306','height'=>'68')), array('controller' => 'users', 'action' => 'login','type'=>'facebook'), array('title' => __l('Sign in with Facebook'), 'escape' => false)); ?></div>
						 <?php endif; ?>
             </div>
	</div>
            