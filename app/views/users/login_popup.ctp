<script type="text/javascript">
 $('form.js-ajax-login').livequery('submit', function(e) {
            var $this = $(this);
			$this.block();
	        $this.ajaxSubmit( {
                beforeSubmit: function(formData, jqForm, options) {},
                success: function(responseText, statusText) {
                    redirect = responseText.split('*');
                    if (redirect[0] == 'redirect') {
                        location.href = redirect[1];
                    } else if (responseText == 'success') {
                        window.location.reload();
                    } else {
						 $this.parents('div.js-responses').html(responseText);
						$('div.js-responses').colorbox.resize();
			        }
				  $this.unblock();
                }
            });
            return false;
        });
</script>
<?php if(empty($this->request->data['User']['is_requested'])):?>
<div class="signin js-responses">
<?php endif; ?>
			 <div class="head">
							<h1><?php echo __l('Login to have a better experience!');?></h1>
							<h2><?php  echo __l('Your Beauty Discovery Journey Begins Here');?></h2>
						</div>
              
               <div class="signin-box-left">
			            	<?php echo $this->Form->create('User', array('action' => 'login', 'class' => 'normal js-ajax-login'));?>
							<?php echo $this->Form->input(Configure::read('user.using_to_login'),array('label'=>ucwords(Configure::read('user.using_to_login')))); ?>
							<?php 	echo $this->Form->input('passwd', array('label' => __l('Password')));
								echo $this->Form->input('is_requested', array('type' => 'hidden','value'=> 1));
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
							  <?php if(Configure::read('facebook.is_enabled_facebook_connect')):  ?>
							  <div class="fb">
								<?php echo $this->Html->link( $this->Html->image('facebook_join.jpg',array('width'=>'306','height'=>'68')), array('controller' => 'users', 'action' => 'login','type'=>'facebook'), array('title' => __l('Sign in with Facebook'), 'escape' => false)); ?>
								</div>
						 <?php endif; ?>
                        </div>
		   			 <div class="signin-box-right">
						
						<?php echo $this->Html->image('pop1.jpg'); ?>
						<?php echo $this->Html->image('pop2.jpg'); ?>
						<h4>Member's Update</h4>
                                                         <p><?php echo __l('Your May Edition WonderBox will ship on the 22nd of May');  ?> </p>
						         <p><?php echo __l('WonderBox Malaysia has released a new subscription reward structure in conjunction with our latest price update.');  ?> </p>
					 </div>
<?php if(empty($this->request->data['User']['is_requested'])):?>
</div>
<?php endif; ?>