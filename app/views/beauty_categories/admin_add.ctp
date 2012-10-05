<?php /* SVN: $Id: $ */ ?>
<div class="beautyCategories form">
<?php echo $this->Form->create('BeautyCategory', array('class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Beauty Categories'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Add Beauty Category');?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('is_active',array('type'=>'checkbox'));
	?>
	</fieldset>
	<div class="submit-block">
		<?php echo $this->Form->submit(__l('Add'));?>
		</div>
		<?php echo $this->Form->end(); ?>
</div>