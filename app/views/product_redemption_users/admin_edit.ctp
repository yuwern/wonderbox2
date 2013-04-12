<?php /* SVN: $Id: $ */ ?>
<div class="productRedemptionUsers form">
<?php echo $this->Form->create('ProductRedemptionUser', array('class' => 'normal'));?>
	<fieldset>
		<legend> <?php echo __l('Product Redemption Tracking Number');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tracking_number');
	?>
	</fieldset>
		<div class="submit-block">
<?php echo $this->Form->end(__l('Update'));?>
</div>
</div>