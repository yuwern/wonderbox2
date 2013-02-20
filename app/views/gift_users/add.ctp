<?php /* SVN: $Id: $ */ ?>
<div class="giftUsers form">
<?php echo $this->Form->create('GiftUser', array('action'=>'add','class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Gift Users'), array('action' => 'index'));?> &raquo; <?php echo __l('Add Gift User');?></legend>
	<?php
		echo $this->Form->input('package_id',array('label'=>__l('Choose Subscription options')));
		echo $this->Form->input('from',array('label'=>__l('Your name')));
		echo $this->Form->input('friend_name',array('label'=>__l('Receiver name')));
		echo $this->Form->input('friend_mail',array('label'=>__l('Receiver e-mail address:')));
		echo $this->Form->input('message',array('label'=>__l('Your message:')));
	?>
	</fieldset>
  	<h2>Friend Contact Information</h2>
	<?php echo $this->Form->input('contact_no',array('label' => __l('Mobile Number'))); ?>
	<?php echo $this->Form->input('contact_no1',array('label' => __l('Home Number'))); ?>
  <h2> Friend Shipping Information</h2>
    <?php	echo $this->Form->input('address',array('type'=>'textarea'));?>
   	<?php	echo $this->Form->input('zip_code');?>
     <?php	echo $this->Form->input('state_id');?>
      <?php	echo $this->Form->input('country_id',array('default'=>143)); ?>
<?php echo $this->Form->end(__l('Next'));?>
</div>