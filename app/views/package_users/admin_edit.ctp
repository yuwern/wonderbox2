<?php /* SVN: $Id: $ */ ?>
<div class="packageUsers form">
<?php echo $this->Form->create('PackageUser', array('class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Package Users'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Edit Package User');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('package_id');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('is_paid');
	?>
	</fieldset>
<?php echo $this->Form->end(__l('Update'));?>
</div>