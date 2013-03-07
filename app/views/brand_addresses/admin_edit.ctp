<?php /* SVN: $Id: $ */ ?>
<div class="brandAddresses form">
<h1> Retail Address details </h1>
<?php echo $this->Form->create('BrandAddress', array('class' => 'normal','enctype' => 'multipart/form-data'));?>
	<fieldset>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('location',array('type'=> 'textarea','label'=>__l('Retail Outlet')));
		echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('Company Image'),'class'=>'required','div'=>'input file required','info'=>__('Image size for ex. 166 X 37')));
		echo $this->Form->input('telephone_no', array('label'=>__l( __l('Telephone Number'))));
		echo $this->Form->input('fax_no', array('label'=>__l( __l('Fax Number'))));
		echo $this->Form->input('email', array('label'=> __l('Email')));
		echo $this->Form->input('website_url', array('label'=> __l('Retail Website URL')));
	?>
	</fieldset>
			<div class="submit-block">
		<?php echo $this->Form->submit(__l('Update'));?>
		</div>
<?php echo $this->Form->end();?> 
</div>