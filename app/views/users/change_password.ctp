		<?php if(empty($this->request->params['isAjax']) ): ?>	<div class="my-account">
				<?php echo $this->element('user-sidebar'); ?>
            	<div class="my-account-right">
				<?php endif; ?><div class="js-password-responses">
<h1><?php echo __l('Change Password'); ?></h1>
<div class="js-response js-responses">
<?php echo $this->Form->create('User', array('action' => 'change_password' ,'class' => 'normal-form js-ajax-form {"container" : "js-password-responses"}')); ?>
      <ul>
                      	<li>
<?//php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
	<?php
		if($this->Auth->user('user_type_id') == ConstUserTypes::Admin) :
			echo $this->Form->input('user_id', array('label' => __l('User *'),'empty' => __l('Please Select')));
		endif;
		if($this->Auth->user('user_type_id') != ConstUserTypes::Admin) :
			echo $this->Form->input('user_id', array('type' => 'hidden','label' => __l('User *'),'readonly' => 'readonly'));
			echo $this->Form->input('old_password', array('type' => 'password','label' => __l('Old Password *') ,'id' => 'old-password'));
		endif; ?>	</li>
		<li><?php echo $this->Form->input('passwd', array('type' => 'password','label' => __l('Enter a new Password *') , 'id' => 'new-password'));?>	</li>
		<li><?php  echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => __l('Confirm Password *')));      ?>	</li>
		<li><span><label>&nbsp;</label></span><?php echo $this->Form->submit(__l('Change Password'),array('class'=>'btn5'));   ?>	<li>
    </ul>
        <?php
        	echo $this->Form->end();
        ?>
    </div>
</div>
		<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>    
            </div>	
		<?php endif; ?>