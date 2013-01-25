		<?php if(empty($this->request->params['isAjax']) ): ?>	<div class="my-account">
				<?php echo $this->element('user-sidebar'); ?>
            	<div class="my-account-right">
				<?php endif; ?> <div class="js-responses">
                	<h1><?php echo __l('Account Information'); ?></h1>
					<?php echo $this->Form->create('UserProfile', array('action' => 'edit', 'class' => 'normal-form js-ajax-form', 'enctype' => 'multipart/form-data'));?>
                        <ul>
                        	<li>
							<?php
								if($this->Auth->user('user_type_id') == ConstUserTypes::Admin):
									echo $this->Form->input('User.id',array('label' => __l('User')));
								endif;
								?>
	                           	<?php echo $this->Form->input('User.email',array('label' => __l('Email'),'readonly'=>'readonly')); ?>
	                         </li>
							<!--<li>
                            	<?php //echo $this->Form->input('mobile_number',array('label' => __l('Mobile Number'),'info'=>__l('Primary Contact Number'))); ?>
	                         </li>
							<li>
                            	<?php //echo $this->Form->input('phone_number',array('label' => __l('Home Number'),'info'=>__l('Secondary Contact Number'))); ?>
	                         </li>-->
							<li>
                            	<?php echo $this->Form->input('first_name',array('label' => __l('First Name'))); ?>
	                         </li>							
							<li>
                            	<?php echo $this->Form->input('last_name',array('label' => __l('Last Name'))); ?>
	                         </li>
							<li>     	<label class="required-field">Gender </label><?php echo $this->Form->input('UserProfile.gender_id', array('type'=>'radio','label'=>false,'legend'=>false,'options'=>  array(2=>__('Female')))); ?>
	                         </li>
							 <li>
                            	<?php   echo $this->Form->input('UserProfile.dob', array('label' => __l('Date of Birth'),'empty' => __l('Select'), 'minYear' => date('Y') - 100, 'maxYear' => date('Y'), 'orderYear' => 'asc')); ?>
	                         </li>
							 	<li>
                            	<?php   echo $this->Form->input('UserProfile.age_group_id', array('label' => __l('Age Group'),'empty' => __l('Please select'))); ?>
	                         </li>
							<li>
                            	<?php echo $this->Form->input('country_id',array('options'=>$countries,'default'=>143,'label'=>__l('Country')));?>


	                         </li>
							<li>
                            	<?php  echo $this->Form->input('UserProfile.state_id',array('label'=>'State','div'=>'required')); ?>
	                         </li>
							 	<li><span><label>&nbsp;</label></span>
                            	<?php  echo $this->Form->submit(__l('Update Account Info'),array('class'=>'btn5')); ?>
	                         </li>
					   </ul>
                <?php
                	echo $this->Form->end();
                ?>
                </div>
		<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>    
            </div>	
		<?php endif; ?>