<div class="userProfiles form js-responses">
		 <div id='my-profile'>
			<h2><?php echo __l('Account Information'); ?></h2>
			<div class="form-blocks  js-corner round-5">
				<?php echo $this->Form->create('UserProfile', array('action' => 'edit', 'class' => 'normal js-ajax-form', 'enctype' => 'multipart/form-data'));?>

						<?php
							if($this->Auth->user('user_type_id') == ConstUserTypes::Admin):
								echo $this->Form->input('User.id',array('label' => __l('User')));
							endif;
						//	echo  "<label> Email ".$this->data['User']['email']."</label>";
							echo $this->Form->input('phone_number',array('label' => __l('Contact No')));
							echo $this->Form->input('first_name',array('label' => __l('First Name')));
							echo $this->Form->input('last_name',array('label' => __l('Last Name')));

							//echo $this->Form->input('gender_id', array('empty' => __l('Please Select'),'label' => __l('Gender')));


						?>
						<div class="date-time-block clearfix">
						<div class="input date-time clearfix required">
							<div class="js-datetime">
								<?php echo $this->Form->input('dob', array('label' => __l('Date of Birth'),'empty' => __l('Please Select'), 'div' => false, 'minYear' => date('Y') - 100, 'maxYear' => date('Y'), 'orderYear' => 'asc')); ?>
							</div>
						</div>
                        </div>
				  <div class="submit-block clearfix">
                    <?php
                    	echo $this->Form->submit(__l('Update Account Info'));
                    ?>
                    </div>
                <?php
                	echo $this->Form->end();
                ?>
		</div>
	</div>
</div>