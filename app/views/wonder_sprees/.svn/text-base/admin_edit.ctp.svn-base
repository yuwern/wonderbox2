<html lang="en">
<head>
<meta charset="utf-8" />
<title>jQuery UI Datepicker - Default functionality</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script>
$(function() {
$( ".datepicker" ).datepicker();
});
</script>
</head>
</html>




<?php /* SVN: $Id: $ */ ?>
<div class="wonderSprees form">
<?php echo $this->Form->create('WonderSpree', array('class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Wonder Sprees'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Edit Wonder Spree');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('purchase_amt');
		echo $this->Form->input('type');
		//echo $this->Form->input('gift');
		echo $this->Form->input('brand', array('multiple'=>true));
		echo $this->Form->input('categories', array('multiple'=>true));
		echo $this->Form->input('location');
		?>
		<?php echo $this->Form->input('purchase_date', array('type'=>'text', 'class'=>'datepicker'));
		echo $this->Form->input('attachment');
	?>
	</fieldset>
<?php echo $this->Form->end(__l('Update'));?>
</div>