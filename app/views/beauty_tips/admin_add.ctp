<?php /* SVN: $Id: $ */ ?>
<?php echo $this->element('js_tiny_mce_setting', array('cache' => array('config' => 'site_element_cache')));?>
<div class="beautyTips form">
<?php echo $this->Form->create('BeautyTip', array('class' => 'normal','enctype' => 'multipart/form-data'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Beauty Content Page'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Add Beauty Content Page');?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('Upload Image'),'class'=>'required','div'=>'input file required','info'=>__('Beauty Tip thumb Image size should be 300 X 188')));
		echo $this->Form->input('Attachment1.filename', array('type' => 'file','size' => '20', 'label' => __l('Upload Slider Image'),'class' =>'browse-field','info'=>__('Beauty Tip Slider Image size should be 664 X 267')));
		echo $this->Form->input('brand_id');
		echo $this->Form->input('beauty_category_id',array('options'=>$beautycategories));
		echo $this->Form->input('Category');
		echo $this->Form->input('description', array('label' => __l('Description'),'type' =>'textarea', 'class' => 'js-editor','div'=>'input text required'));
		echo $this->Form->input('about_us', array('label' => __l('About us'),'type' =>'textarea', 'class' => 'js-editor','div'=>'input text required'));
		echo $this->Form->input('video_url');
		echo $this->Form->input('is_main_page_footer');
		echo $this->Form->input('is_active');
		
	?>
	</fieldset>
			<div class="submit-block">
		<?php echo $this->Form->submit(__l('Add'));?>
		</div>
<?php echo $this->Form->end();?>
</div>