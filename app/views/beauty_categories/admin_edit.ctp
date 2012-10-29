<?php /* SVN: $Id: $ */ ?>
<div class="beautyCategories form">
<?php echo $this->Form->create('BeautyCategory', array('class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Beauty Categories'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Edit Beauty Category');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
		<div class="submit-block">
<?php echo $this->Form->end(__l('Update'));?></div>
</div>