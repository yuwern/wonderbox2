<?php /* SVN: $Id: $ */ ?>
<div class="homePageOrganizers form">
<?php echo $this->element('js_tiny_mce_setting', array('cache' => array('config' => 'site_element_cache')));?>
<?php echo $this->Form->create('HomePageOrganizer', array('class' => 'normal',  'enctype' => 'multipart/form-data'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Home Page Organizers'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Add Home Page Organizer');?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('Attachment.filename', array('type' => 'file','size' => '20', 'label' => __l('Upload Image'),'class' =>'browse-field','info'=>__('Image size should be 150 X 100')));
		echo $this->Form->input('short_description', array('label' => __l('Short Description'),'type' =>'textarea'));
		echo $this->Form->input('content', array('label' => __l('Description'),'type' =>'textarea', 'class' => 'js-editor'));
		echo $this->Form->input('edition_date', array( 'label' => __l('Wonder Edition'), 'dateFormat' => 'MY', 'minYear' => date('Y')-1, 'maxYear' => date('Y')+1));
		echo $this->Form->input('is_active',array('type'=>'checkbox'));
	?>
	</fieldset>
		<div class="submit-block">
		<?php echo $this->Form->submit(__l('Add'));?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>