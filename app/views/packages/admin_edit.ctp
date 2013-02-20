<?php /* SVN: $Id: $ */ ?>
<div class="packages form">
<?php echo $this->Form->create('Package', array('class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Packages'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Edit Package');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		//echo $this->Form->input('package_type_id');
		//echo $this->Form->input('package_category_id');
		echo $this->Form->input('cost');
		echo $this->Form->input('no_of_wonderpoints');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
	<div class="submit-block clearfix">
    <?php echo $this->Form->submit(__l('Update'));?>
    </div>
    <?php echo $this->Form->end();?>
</div>