<?php 
	$action = "register";
	$type = '';
?>
<div class="reg">
                <div class="reg-left">
<?php
  		$formClass = !empty($this->request->data['User']['is_requested']) ? 'js-ajax-login' : '';
?>

<?php echo $this->Form->create('User', array('action' => $action, 'class' => 'normal js-company-map js-register-form '.$formClass)); ?>
	   <h3><?php echo __l('Create your').' '.Configure::read('site.name').' '.__l('Account'); ?> </h3>
	       <p>Your journey of discovery with us begins here. We just need a few details from you so that we can get in touch once we've ironed out the details and are ready to begin delivery. <br>
Signing up now ensures that you will be one of the first people to know when the first WonderBox is ready! you don't have to pay anything until we begin delivery! </p>
		   <ul>
		   <li>
	<?php
		echo $this->Form->input('email',array('label' => __l('Email*'))); ?>
		</li>
	<?php	echo $this->Form->input('referred_by_user_id',array('type' => 'hidden',));
		if(empty($this->request->data['User']['openid_url']) && empty($this->request->data['User']['fb_user_id']) && empty($this->request->data['User']['twitter_user_id'])):
		?>
		<li>
		<?php 		echo $this->Form->input('passwd', array('label' => __l('Password*'))); ?></li>
		<li>
		<?php 	echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => __l('Re-Type Password*'))); ?>

<li><?php			echo $this->Form->input('UserProfile.first_name', array( 'label' => __l('First Name*')));?></li>
	<li>	<?php	echo $this->Form->input('UserProfile.last_name', array( 'label' => __l('Last Name*')));?></li>
	<li><?php   echo $this->Form->input('UserProfile.age_group_id', array('label' => __l('Age Group'),'empty' => __l('Please select'))); ?></li>
	<li>	<div  style="padding-bottom:20px">
			<label for="UserProfileGender" style="padding-left:10px"><?php echo __l('Gender*'); ?></label>
		
		<?php echo $this->Form->input('UserProfile.gender_id', array('type'=>'radio','options'=> array(2=>__('Female')),'legend' =>false,'default'=>2)); ?>
			
			</div></li>
				<li>	<?php		
			 echo $this->Form->input('UserProfile.dob', array('label' => __l('Date of Birth*'),'empty' => __l('Select'), 'minYear' => date('Y') - 100, 'maxYear' => date('Y'), 'orderYear' => 'asc')); ?>
	</li>	
			<li>	 <?php
			echo $this->Form->input('type',array('type' => 'hidden', 'value' => $type));
		endif;
		if(!empty($this->request->data['User']['openid_url'])):
			  echo $this->Form->input('openid_url',array('type' => 'hidden'));
		endif;
        if(!empty($this->request->data['User']['is_requested'])):
			echo $this->Form->input('is_requested', array('type' => 'hidden'));
		endif;
		if (!empty($this->request->data['User']['f'])):
			echo $this->Form->input('f', array('type' => 'hidden'));
		endif;
		?>
			
        <?php

			echo $this->Form->input('country_iso_code', array('type' => 'hidden','id' => 'country_iso_code'));
			echo $this->Form->input('State.name', array('type' => 'hidden'));
			echo $this->Form->input('City.name', array('type' => 'hidden'));

		if(!empty($refer)){
    		if(isset($_GET['refer']) && ($_GET['refer']!='')) {
    			$refer = $_GET['refer'];
    		}
    		echo $this->Form->input('referer_name', array('value' => $refer, 'label'=>__l('Reference Code')));
    	}else{
    		echo $this->Form->input('referer_name', array('type' => 'hidden'));
    	}
		?>
		</li>
    	<?php if(!empty($type)): ?>
    		   </fieldset>
        <?php endif; ?>

<li>

		<?php
		if(empty($this->request->data['User']['openid_url'])): ?>
    		<div class="input captcha-block clearfix js-captcha-container">
    			<div class="captcha-left">
    	           <?php echo $this->Html->image(Router::url(array('controller' => 'users', 'action' => 'show_captcha', md5(uniqid(time()))), true), array('alt' => __l('[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]'), 'title' => __l('CAPTCHA image'), 'class' => 'captcha-img'));?>
    	        </div>
    	        <div class="captcha-right">
        	        <?php echo $this->Html->link(__l('Reload CAPTCHA'), '#', array('class' => 'js-captcha-reload captcha-reload', 'title' => __l('Reload CAPTCHA')));?>
        			<div>
		              <?php echo $this->Html->link(__l('Click to play'), Router::url('/', true)."flash/securimage/play.swf?audio=". $this->Html->url(array('controller' => 'users', 'action'=>'captcha_play'), true) ."&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5&height=19&width=19&wmode=transparent", array('class' => 'js-captcha-play')); ?>
			      </div>
    	        </div>
            </div>
        	<?php 
				echo $this->Form->input('captcha', array('label' => __l('Security Code*'), 'class' => 'js-captcha-input'));
				$terms = $this->Html->link(__l('terms and condition'), array('controller' => 'pages', 'action' => 'view', 'term-and-conditions'), array('target' => '_blank'));
			?>
			</li>
			<li>
			<div class="term clear" style="padding-left:180px">
    		<?php echo $this->Form->input('is_agree_terms_conditions', array('label' => __l('I agree to the') .' ' . $terms)); ?>
			</div>
			</li>
		<?php endif; ?>
			<li>
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
		?></li>
   	<div class="submit-block clear">
		<?php
		echo $this->Form->submit(__l('Register'));?>
    </div>
 <?php  echo $this->Form->end();?>
    </ul>
 </div>
 <div class="reg-login">
                <span class="signf">or sign in with your Facebook Account</span>
				 <?php if(Configure::read('facebook.is_enabled_facebook_connect')):  ?>
						<?php echo $this->Html->link( $this->Html->image('joinfacebook.jpg'), array('controller' => 'users', 'action' => 'login','type'=>'facebook'), array('title' => __l('Sign in with Facebook'), 'escape' => false)); ?>
					 <?php endif; ?>
                     <span class="sign">Already a member? <?php echo $this->Html->link(__l('Sign in'), array('controller' => 'users', 'action' => 'login'), array('title' => __l('Sign in')));?></span>
                </div>    
</div>
