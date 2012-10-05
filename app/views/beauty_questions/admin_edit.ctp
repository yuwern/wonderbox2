<?php /* SVN: $Id: $ */ ?>
<div class="beautyQuestions form">
<?php echo $this->Form->create('BeautyQuestion', array('class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Beauty Questions'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Edit Beauty Question');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('beauty_category_id');
		echo $this->Form->input('name');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
	<div class="submit-block">
		<?php echo $this->Form->submit(__l('Update'));?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>