<?php /* SVN: $Id: $ */ ?>
<div class="productRedemptionUsers form">
<?php echo $this->Form->create('ProductRedemptionUser', array('class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Product Redemption Users'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Add Product Redemption User');?></legend>
	<?php
		echo $this->Form->input('product_redemption_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('is_redeem');
	?>
	</fieldset>
<?php echo $this->Form->end(__l('Update'));?>
</div>