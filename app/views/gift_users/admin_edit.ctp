<?php /* SVN: $Id: $ */ ?>
<div class="giftUsers form">
<?php echo $this->Form->create('GiftUser', array('class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Gift Users'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Edit Gift User');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tracking_number');
	?>
	</fieldset>
   	<div class="submit-block clearfix">
<?php echo $this->Form->end(__l('Update'));?>
    </div>
</div>