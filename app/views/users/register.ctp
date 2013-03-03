			<div class="signup">
                	<div class="singup-left"> <?php echo $this->Html->image('signup_left_img.jpg',array('width'=>'228','height'=>'487')); ?></div>
                    <div class="singup-right">
                    	<div class="head mb40">
                        	<h1><?php echo __l('Create your').' '.Configure::read('site.name').' '.__l('Account'); ?></h1>
                            <p><?php echo __l('Your journey of discovery with us begins here.'); ?> <br>
                            <?php echo __l('We just need a few details from you so we can set up your account:'); ?></p>
                        </div>
                        <div class="signup-box-left">
							<?php $formClass = !empty($this->request->data['User']['is_requested']) ? 'js-ajax-login' : ''; ?>
                        	<?php echo $this->Form->create('User', array('action' => 'register', 'class' => 'normal'.$formClass)); ?>
                            	<?php echo $this->Form->input('email',array('label' => __l('Email'))); ?>
								<?php echo $this->Form->input('referred_by_user_id',array('type' => 'hidden')); ?>
								<?php echo $this->Form->input('passwd', array('label' => __l('Password'))); ?>
								<?php echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => __l('Re-Type Password'))); ?>
								<?php echo $this->Form->input('UserProfile.first_name', array( 'label' => __l('First Name')));?>
								<?php echo $this->Form->input('UserProfile.last_name', array( 'label' => __l('Last Name')));?>
								<div class="gender"><span><strong><?php echo __l('Gender'); ?></strong></span><?php echo $this->Form->input('UserProfile.gender_id', array('type'=>'radio', 'label' => __l('Gender'),'options'=> array(2=>__('Female')),'default'=>2)); ?></div>								
								<?php echo $this->Form->input('UserProfile.age_group_id', array('label' => __l('Age Group'),'empty' => __l('Please select'))); ?>
								<?php echo $this->Form->input('UserProfile.dob', array('label' => __l('Date of Birth'),'empty' => __l('--'), 'minYear' => date('Y') - 100, 'maxYear' => date('Y'), 'orderYear' => 'asc')); ?>
								 <?php
									echo $this->Form->input('type',array('type' => 'hidden', 'value' => ''));
									if(!empty($this->request->data['User']['openid_url'])):
									  echo $this->Form->input('openid_url',array('type' => 'hidden'));
									endif;
									if(!empty($this->request->data['User']['is_requested'])):
										echo $this->Form->input('is_requested', array('type' => 'hidden'));
									endif;
									if (!empty($this->request->data['User']['f'])):
										echo $this->Form->input('f', array('type' => 'hidden'));
									endif;
									if(!empty($refer)){
										if(isset($_GET['refer']) && ($_GET['refer']!='')) {
											$refer = $_GET['refer'];
										}
										echo $this->Form->input('referer_name', array('value' => $refer, 'label'=>__l('Reference Code')));
									}else{
										echo $this->Form->input('referer_name', array('type' => 'hidden'));
									}
								?>
							<!--	<div class="input captcha-block clearfix js-captcha-container">
									<div class="captcha-left">
									   <?php //echo $this->Html->image(Router::url(array('controller' => 'users', 'action' => 'show_captcha', md5(uniqid(time()))), true), array('alt' => __l('[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]'), 'title' => __l('CAPTCHA image'), 'class' => 'captcha-img'));?>
									</div>
									<div class="captcha-right">
										<?php echo $this->Html->link(__l('Reload CAPTCHA'), '#', array('class' => 'js-captcha-reload captcha-reload', 'title' => __l('Reload CAPTCHA')));?>
										<div>
										  <?php //echo $this->Html->link(__l('Click to play'), Router::url('/', true)."flash/securimage/play.swf?audio=". $this->Html->url(array('controller' => 'users', 'action'=>'captcha_play'), true) ."&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5&height=19&width=19&wmode=transparent", array('class' => 'js-captcha-play')); ?>
									  </div>
									</div>
								</div> -->
							 	<?php 
								/*	echo $this->Form->input('captcha', array('label' => __l('Security Code'), 'class' => 'js-captcha-input'));
									$terms = $this->Html->link(__l('terms and condition'), array('controller' => 'pages', 'action' => 'view', 'term-and-conditions'), array('target' => '_blank')); */
								?>
								<?php // echo $this->Form->input('is_agree_terms_conditions', array('label' => __l('I agree to the') .' ' . $terms)); ?>
								<?php
									if(!empty($this->request->data['User']['fb_user_id'])):
										echo $this->Form->input('fb_user_id', array('type' => 'hidden', 'value' => $this->request->data['User']['fb_user_id']));
									endif;
									if(!empty($this->request->data['User']['fb_access_token'])):
										echo $this->Form->input('fb_access_token', array('type' => 'hidden', 'value' => $this->request->data['User']['fb_access_token']));
									endif;
									if(!empty($this->request->data['User']['is_facebook_register'])) :
										echo $this->Form->input('is_facebook_register', array('type' => 'hidden', 'value' => $this->request->data['User']['is_facebook_register']));
									endif;
								?>
								<?php echo $this->Form->submit(__l('Register'),array('class'=>'btn1'));?>
								<?php  echo $this->Form->end();?>
                         </div>
						 <?php if(Configure::read('facebook.is_enabled_facebook_connect')):  ?>
                        <div class="signup-box-right"><?php echo $this->Html->link( $this->Html->image('facebook_join.jpg',array('width'=>'306','height'=>'68')), array('controller' => 'users', 'action' => 'login','type'=>'facebook'), array('title' => __l('Sign in with Facebook'), 'escape' => false)); ?></div>
			 		   <?php endif; ?>
					  </div>
                </div>