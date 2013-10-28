<?php /* SVN: $Id: $ */ ?>
<div class="wonderSprees form">
<?php echo $this->Form->create('WonderSpree', array('class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('WonderSpree'), array('action' => 'index'));?> &raquo; <?php echo __l('Edit WonderSpree');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('purchase_amt');
		echo $this->Form->input('discount');
		echo $this->Form->input('gift');
		echo $this->Form->input('brand');
		echo $this->Form->input('categories');
		echo $this->Form->input('location');
		echo $this->Form->input('purchase_date');
		echo $this->Form->input('upload_receipt');
	?>
	</fieldset>
<?php echo $this->Form->end(__l('Update'));?>
</div>