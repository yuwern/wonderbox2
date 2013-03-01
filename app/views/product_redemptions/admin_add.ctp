<?php /* SVN: $Id: $ */ ?>
<style>
	h1.p-left {
		padding-left:30px;
	}
	.productRedemptions .p-bor{
		border:1px solid #DE006D;margin:3px;
	}
</style>
<div class="productRedemptions form js-responses">
<?php echo $this->element('js_tiny_mce_setting', array('cache' => array('config' => 'site_element_cache')));?>
<?php echo $this->Form->create('ProductRedemption', array('class' => 'normal','enctype' => 'multipart/form-data'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Product Redemptions'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Add Product Redemption');?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('Master Image'),'class'=>'required','div'=>'input file required'));
		echo $this->Form->input('short_description');
		echo $this->Form->input('description', array('label' => __l('Description'),'type' =>'textarea', 'class' => 'js-editor'));
		echo $this->Form->input('redeem_wonder_point');?>
		<div class="js-product-content">
		<?php if(!empty($this->request->data['RelatedProduct'])): 
				foreach($this->request->data['RelatedProduct'] as $key => $relatedProduct): ?>
				<div class="p-bor round-10">
				<h1 class="p-left"><?php echo __l('Product'); ?>  <?php echo ($key +1); ?> </h1>
				<?php
				echo $this->Form->input('RelatedProduct.'.$key.'.name',array('label'=>__l('Name')));
				echo $this->Form->input('Attachment.'.$key.'.filename', array('type' => 'file', 'label' => __l('Product Image'),'class'=>'required','div'=>'input file required'));	
				echo $this->Form->input('RelatedProduct.'.$key.'.category_id',array('options'=>$categories));
				echo $this->Form->input('RelatedProduct.'.$key.'.brand_id',array('options'=>$brands));
				echo $this->Form->input('RelatedProduct.'.$key.'.description', array('label' => __l('Description'),'type' =>'textarea', 'class' => 'js-editor'));
				echo $this->Form->input('RelatedProduct.'.$key.'.price'); ?>
			</div>
			<?php endforeach;
				$count = count($this->request->data['RelatedProduct']);
			 else: ?>
			<div class="p-bor round-10">
			<h1 class="p-left"><?php echo __l('Product 1'); ?> </h1>
			<?php
			echo $this->Form->input('RelatedProduct.0.name',array('label'=>__l('Name')));
			echo $this->Form->input('Attachment.0.filename', array('type' => 'file', 'label' => __l('Product Image'),'class'=>'required','div'=>'input file required'));	
			echo $this->Form->input('RelatedProduct.0.category_id',array('options'=>$categories));
			echo $this->Form->input('RelatedProduct.0.brand_id',array('options'=>$brands));
			echo $this->Form->input('RelatedProduct.0.description', array('label' => __l('Description'),'type' =>'textarea', 'class' => 'js-editor'));
			echo $this->Form->input('RelatedProduct.0.price'); ?>
			</div>
			<div class="p-bor round-10">
			<h1 class="p-left"><?php echo __l('Product 2'); ?> </h1>
			<?php
				echo $this->Form->input('RelatedProduct.1.name',array('label'=>__l('Name')));
				echo $this->Form->input('Attachment.1.filename', array('type' => 'file', 'label' => __l('Product Image'),'class'=>'required','div'=>'input file required'));
				echo $this->Form->input('RelatedProduct.1.category_id',array('options'=>$categories));
				echo $this->Form->input('RelatedProduct.1.brand_id',array('options'=>$brands));
				echo $this->Form->input('RelatedProduct.1.description', array('label' => __l('Description'),'type' =>'textarea', 'class' => 'js-editor'));
				echo $this->Form->input('RelatedProduct.1.price');
				$count = 1;
				?>
			</div>
			<?php endif; ?>
		</div>
		<div class="f-right"><a href="#" class="add js-add-more-product" title="Add More">Add More</a><a href="#" class="delete js-product-delete" title="Delete">Delete</a></div>
		<div class="hide"><?php echo $this->Form->input('relatedproduct_count',array('value'=> $count,'type'=>'text','class'=>'js-product-count'));?> </div>
	
		<?php	echo $this->Form->input('is_active');
		?>
	</fieldset>
		<div class="submit-block">
		<?php echo $this->Form->submit(__l('Add'));?>
		</div>
<?php echo $this->Form->end();?>
</div>