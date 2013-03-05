		<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                    	<div class="head">
                        	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('Account Details'); ?></h1>
                        </div>
                       	<div class="acc-fm-box">
                        	<h3> <?php echo __l('Account Information'); ?></h3>
                        		<?php echo $this->Form->create('UserProfile', array('action' => 'edit', 'class' => 'normal-form js-ajax-form', 'enctype' => 'multipart/form-data'));?>
							    <?php
								if($this->Auth->user('user_type_id') == ConstUserTypes::Admin):
									echo $this->Form->input('User.id',array('label' => __l('User')));
								endif;
								echo $this->Form->input('User.email',array('label' => __l('Email'),'readonly'=>'readonly'));
								echo $this->Form->input('first_name',array('label' => __l('First Name')));
								echo $this->Form->input('last_name',array('label' => __l('Last Name'))); 
								?>
								<div class="gender">
                                	<span><strong><?php echo __l('Gender'); ?></strong></span>
									<?php echo $this->Form->input('UserProfile.gender_id', array('type'=>'radio','label'=>false,'legend'=>false,'options'=>  array(2=>__('Female')))); ?>
                                </div>
								<?php 
								echo $this->Form->input('UserProfile.age_group_id', array('label' => __l('Age Group'),'empty' => __l('Please select')));
								echo $this->Form->input('UserProfile.dob', array('label' => __l('Date of Birth'),'empty' => __l('Select'), 'minYear' => date('Y') - 100, 'maxYear' => date('Y'), 'orderYear' => 'asc')); 
								echo $this->Form->input('country_id',array('options'=>$countries,'default'=>143,'label'=>__l('Country')));
								echo $this->Form->input('UserProfile.state_id',array('label'=>'State'));
								echo $this->Form->submit(__l('Update'),array('class'=>'btn1'));
								echo $this->Form->end();
							?>
                        </div>
                    </div>
				<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>