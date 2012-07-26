<?php /* SVN: $Id: $ */ ?>
<div class="homePageBanners form">
<?php echo $this->Form->create('HomePageBanner', array('class' => 'normal',  'enctype' => 'multipart/form-data'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Home Page Banners'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Add Home Page Banner');?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('Attachment.filename', array('type' => 'file','size' => '20', 'label' => __l('Upload Image'),'class' =>'browse-field')); 
		echo $this->Form->input('is_active',array('type'=>'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__l('Update'));?>
</div>