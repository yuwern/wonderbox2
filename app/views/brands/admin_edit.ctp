<?php /* SVN: $Id: $ */ ?>
<?php echo $this->element('js_tiny_mce_setting', array('cache' => array('config' => 'site_element_cache')));?>
<div class="brands form">
<?php echo $this->Form->create('Brand', array('class' => 'normal','enctype' => 'multipart/form-data'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Brands'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Edit Brand');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('div'=>'input text required'));
		echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('Upload Image'),'class'=>'required','div'=>'input file required'));
		echo $this->Form->input('description', array('label' => __l('Description'),'type' =>'textarea', 'class' => 'js-editor' ,'div'=>'input text required'));
		?>
		<?php 
		echo $this->Form->input('location',array('type'=>'textarea','label'=>__('Retail Outlet'),'div'=>'input textarea required'));
		echo $this->Form->input('telephone_no',array('label'=>__l('Telephone Number')));
		echo $this->Form->input('fax_no',array('label'=>__l('Fax Number')));
		echo $this->Form->input('email',array('label'=>__l('Email')));
		echo $this->Form->input('location1',array('type'=>'textarea','label'=>__('Other Retail Outlet')));
		echo $this->Form->input('telephone_no1',array('label'=>__l('Telephone Number')));
		echo $this->Form->input('fax_no1',array('label'=>__l('Fax Number')));
		echo $this->Form->input('email1',array('label'=>__l('Email')));
		echo $this->Form->input('facebook_url',array('label'=>__l('Facebook URL'),'div'=>'input text required'));
		echo $this->Form->input('web_url',array('label'=>__l('Website URL'),'div'=>'input text required'));
		echo $this->Form->input('beauty_tip_url',array('label'=>__l('Beauty Tip URL'),'div'=>'input text required'));
		echo $this->Form->input('promotion_url',array('label'=>__l('Promotion URL'),'div'=>'input text required'));
		echo $this->Form->input('is_active',array('type'=>'checkbox'));
	?>
	</fieldset>
	<div class="submit-block">
		<?php echo $this->Form->submit(__l('Update'));?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>