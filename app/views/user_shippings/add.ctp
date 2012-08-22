<?php if(empty($this->request->params['isAjax']) ): ?>	
			<div class="my-account">
				<?php echo $this->element('user-sidebar'); ?>
            	<div class="my-account-right">
				<?php endif; ?>
				<div class="userProfiles form js-responses">
					<h1><?php echo __l('Shipping Information'); ?></h1>

						<?php echo $this->Form->create('UserShipping', array('class' => 'normal-form js-ajax-form', 'enctype' => 'multipart/form-data'));?>
							  <ul>
                        		<li>
								<?php
									echo $this->Form->input('id');
									echo $this->Form->input('address',array('label' => __l('Address'),'type'=>'textarea'));
								?>
								  </li>		
								  <li><?php echo $this->Form->input('state_id',array('label' => __l('State'),'div'=>'required')); ?> </li>
								  <li><?php echo $this->Form->input('country_id',array('label' => __l('Country'),'default'=>143)); ?> </li>
							  	  <li><?php echo $this->Form->input('zip_code',array('label' => __l('Postal Code'))); ?> </li>
							  	  <li><?php echo $this->Form->input('contact_no',array('label' => __l('Mobile Number'))); ?> </li>
							  	  <li><?php echo $this->Form->input('contact_no1',array('label' => __l('Home Number'))); ?> </li>
							
								   <li>
                            	<span><label>&nbsp;</label></span>
                                <?php echo $this->Form->submit(__l('Update Shipping Info'),array('class'=>'btn5')); ?>
                            </li>
								 </ul>	
								 <?php 	echo $this->Form->end(); ?>
			 </div>
		<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>    
            </div>	
		<?php endif; ?>