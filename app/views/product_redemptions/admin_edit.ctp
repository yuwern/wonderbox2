<?php /* SVN: $Id: $ */ ?>
<div class="productRedemptions form">
<?php echo $this->element('js_tiny_mce_setting', array('cache' => array('config' => 'site_element_cache')));?>
<?php echo $this->Form->create('ProductRedemption', array('class' => 'normal','enctype' => 'multipart/form-data'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Product Redemptions'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Edit Product Redemption');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('Master Image'),'class'=>'required','div'=>'input file required'));
		echo $this->Form->input('short_description');
		echo $this->Form->input('description', array('label' => __l('Description'),'type' =>'textarea', 'class' => 'js-editor'));
		echo $this->Form->input('quantity');
		echo $this->Form->input('redeem_wonder_point');
		echo $this->Form->input('is_purchase');
		echo $this->Form->input('purchase_amount',array('label'=>__l('Purchase price')));
		echo $this->Form->input('is_active');
	?>
	</fieldset>
	<?php echo $this->Html->link(__l('Add Product'), array('controller'=>'related_products','action'=>'add', $this->request->data['ProductRedemption']['id']), array('class' => 'add', 'title' => __l('Add Product')));?>
	<br/>
	<?php if(!empty($this->request->data['RelatedProduct'])): ?>
		<ul>
		<?php 	foreach($this->request->data['RelatedProduct'] as $relateProduct): ?>
			<li style="float:left;padding:5px;border:1px solid #DE006D;margin:3px;"><?php echo $this->Html->showImage('RelatedProduct',  $relateProduct['Attachment'][0], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($relateProduct['name'], false)), 'title' => $this->Html->cText($relateProduct['name'], false))); ?>
			<div style="padding-left:3px;"><?php echo $this->Html->cText($relateProduct['name'], false); ?></div>
			<div class="actions"><?php echo $this->Html->link(__l('Edit'), array('controller'=>'related_products','action'=>'edit', $relateProduct['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?><?php echo $this->Html->link(__l('Delete'), array('controller'=>'related_products','action'=>'delete',$relateProduct['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
			</li>
		<?php endforeach;  ?>
		</ul>
	<?php endif; ?>
	<div class="clearfix"></div>
	<div class="submit-block">
		<?php echo $this->Form->submit(__l('Update'));?>
	</div>
<?php echo $this->Form->end();?>
</div>