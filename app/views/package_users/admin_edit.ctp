<?php /* SVN: $Id: $ */ ?>
<div class="packageUsers form">
<?php echo $this->Form->create('PackageUser', array('class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Package Users'), array('action' => 'index'));?> &raquo; <?php echo __l('Edit Tracking Number');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tracking_number');
	?>
	</fieldset>
	<div class="submit-block clearfix">
<?php echo $this->Form->end(__l('Update'));?>
    </div>
</div>