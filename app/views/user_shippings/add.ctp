			<?php if(empty($this->request->params['isAjax']) ): ?>
				<div class="account">
				<?php echo $this->element('user-sidebar'); ?>
                 <?php endif; ?>
                    <div class="acc-right">
                    	<div class="head">
                         	<h1><?php echo Configure::read('site.name'); ?> <?php echo __l('Shipping Address'); ?></h1>
                           </div>
                       	<div class="acc-fm-box">
                        	<h3><?php echo __l('Shipping Information'); ?></h3>
                        	<?php echo $this->Form->create('UserShipping', array('class' => 'normal-form js-ajax-form', 'enctype' => 'multipart/form-data'));  
								echo $this->Form->input('address',array('label' => __l('Address 1'),'info'=>__l('Unit/House Number')));
								echo $this->Form->input('address2',array('label' => __l('Address 2'),'info'=>__l('Street Name/Residential Name')));
								echo $this->Form->input('address3',array('label' => __l('Address 3'),'info'=>__l('Residential Name')));
								echo $this->Form->input('contact_no',array('label' => __l('Mobile Number'))); 
								echo $this->Form->input('contact_no1',array('label' => __l('Home Number'))); 
								echo $this->Form->input('zip_code',array('label' => __l('Postal Code'))); 
								echo $this->Form->input('state_id',array('label' => __l('State')));
								echo $this->Form->input('country_id',array('label' => __l('Country'),'default'=>143)); 
								echo $this->Form->submit(__l('Update Shipping Info'),array('class'=>'btn1'));
								echo $this->Form->end();
							?>
                        </div>
                    </div>
				<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>
				<?php endif; ?>