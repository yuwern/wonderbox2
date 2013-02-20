<?php /* SVN: $Id: $ */ ?>
<div class="packageUsers form">
<?php echo $this->Form->create('GiftUser', array('action' => 'import' ,'class' => 'normal','enctype' => 'multipart/form-data'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('List of active users'), array('action' => 'index'));?> &raquo; <?php echo __l('Uploaded Tracking Number');?></legend>
		  <div><?php echo $this->Html->link(__l('Click here'), '/files/sample.csv', array('target' => '_blank')); ?> <?php echo __l('to download a sample tacking list. Import Tracking number can be uploaded in CSV  format.'); ?> </div>
	<?php
		echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('Upload Image'),'class'=>'required','div'=>'input file required'));

		?>
		<?php $months = $this->Html->getMonthLists();
			 $years = $this->Html->getYearLists();
			echo $this->Form->input('month', array('options'=>$months,'empty'=>__l('Please select'),'label'=> __l('Month'))); ?>
		<?php echo $this->Form->input('year', array('label'=> __l('Year'),'empty'=>__l('Please select'),'options'=> $years)); ?>
			
	</fieldset>
		<div class="submit-block">
		<?php echo $this->Form->submit(__l('Upload'));?>
		</div>
		<?php echo $this->Form->end(); ?>
</div>