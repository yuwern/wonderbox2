<?php /* SVN: $Id: $ */ ?>
<div class="giftUsers form">
<?php echo $this->Form->create('GiftUser', array('class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Gift Users'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Edit Gift User');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('amount');
		echo $this->Form->input('from');
		echo $this->Form->input('friend_name');
		echo $this->Form->input('friend_mail');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__l('Update'));?>
</div>