<?php /* SVN: $Id: $ */ ?>
<div class="relatedProducts form">
<?php echo $this->element('js_tiny_mce_setting', array('cache' => array('config' => 'site_element_cache')));?>
<?php echo $this->Form->create('RelatedProduct', array('class' => 'normal','enctype' => 'multipart/form-data'));?>
	<fieldset>
	<?php echo __l('Add Product');?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('Product Image'),'class'=>'required','div'=>'input file required'));
		echo $this->Form->input('product_redemption_id',array('type'=>'hidden'));
		echo $this->Form->input('brand_id');
		echo $this->Form->input('description', array('label' => __l('Description'),'type' =>'textarea', 'class' => 'js-editor'));
		echo $this->Form->input('price');
	?>
	</fieldset>
	<div class="submit-block">
		<?php echo $this->Form->submit(__l('Add'));?>
	</div>
<?php echo $this->Form->end();?>
</div>