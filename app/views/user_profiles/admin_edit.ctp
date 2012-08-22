	 <div class="js-responses">
                	<h1><?php echo __l('Account Information'); ?></h1>
					<?php echo $this->Form->create('UserProfile', array('action' => 'edit', 'class' => 'normal js-ajax-form', 'enctype' => 'multipart/form-data'));?>
                        <ul>
                        	<li>
							<?php
								if($this->Auth->user('user_type_id') == ConstUserTypes::Admin):
									echo $this->Form->input('User.id',array('label' => __l('User')));
								endif;
								?>
	                           	<?php echo $this->Form->input('User.email',array('label' => __l('Email'),'readonly'=>'readonly')); ?>
	                         </li>
								<li>
                            	<?php echo $this->Form->input('first_name',array('label' => __l('First Name'))); ?>
	                         </li>							
							<li>
                            	<?php echo $this->Form->input('last_name',array('label' => __l('Last Name'))); ?>
	                         </li>
							 <li>
                            	<?php   echo $this->Form->input('UserProfile.dob', array('label' => __l('Date of Birth'),'empty' => __l('Select'), 'minYear' => date('Y') - 100, 'maxYear' => date('Y'), 'orderYear' => 'asc')); ?>
	                         </li>
							<li>
                            	<?php echo $this->Form->input('country_id',array('options'=>$countries,'default'=>143,'label'=>__l('Country')));?>


	                         </li>
							<li>
                            	<?php  echo $this->Form->input('UserProfile.state_id',array('label'=>'State')); ?>
	                         </li>
							 	<li><span><label>&nbsp;</label></span>
								<div class="submit-block clearfix">
                            	<?php  echo $this->Form->submit(__l('Update Account Info'),array('class'=>'btn5')); ?> </div>
	                         </li>
					   </ul>
                <?php
                	echo $this->Form->end();
                ?>
                </div>
