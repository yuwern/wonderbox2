<html lang="en">
<head>
<script type="text/javascript">
var fb_param = {};
fb_param.pixel_id = '6008183028698';
fb_param.value = '0.00';
fb_param.currency = 'MYR';
(function(){
  var fpw = document.createElement('script');
  fpw.async = true;
  fpw.src = '//connect.facebook.net/en_US/fp.js';
  var ref = document.getElementsByTagName('script')[0];
  ref.parentNode.insertBefore(fpw, ref);
})();
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6008183028698&amp;value=0&amp;currency=MYR" /></noscript>
<meta charset="utf-8" />
<title>jQuery UI Datepicker - Default functionality</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script>
$(function() {
$( ".datepicker" ).datepicker({maxDate:new Date});
});
</script>
</head>
</html>
<div class="gift-wonder">

		 <div class="giftw-left"><?php echo $this->Html->image('gift_wonder.jpg',array('width'=>'228','height'=>'487')); ?></div>
			<!--<div class="giftw-left"><img src="images/gift_wonder.jpg" alt="img" /></div>-->
			<div class="giftw-right">
				<div class="head">
					<h1><?php echo 'WonderSpree'?></h1>
					<p><?php echo 'We would like to get to know you better. By sharing your retail history with us, we promise that you will be the first in line for any upcoming event or sales from the brands that you love most. Share and be rewarded, received up to 20% of your purchase amount in WonderPoints for every receipt you choose to share with us.  '?></p>
				</div>
			
				<div class="clear"></div>
				<div class="acc-fm-box">
					<?php $formClass = !empty($this->request->data['WonderSpree']['is_requested']) ? 'js-ajax-login' : ''; ?>
					<?php echo $this->Form->create('WonderSpree', array('action' => 'add', 'class' => 'normal'.$formClass,'enctype' => 'multipart/form-data')); ?> 
					  
					<div class="input">
					<?php echo $this->Form->input('purchase_amt',array('label' => __l('Purchase amount'))); ?>
					</div>
				   
				<div class="input">
				<?php
					$options = array(
					'discount' => ' Enjoyed a Sale Discount ',
                                        'retail' => ' No Discount '
					);

					$attributes = array(
					'legend' => false,
					'value' => 'discount',
					);

					echo $this->Form->radio('type', $options, $attributes);
				?>
					</div>
					<div class="input" id="pre_dis" >
					<?php echo $this->Form->input('previous_discount',array('label' => __l('Discount Percentage'))); ?>
					</div>
					<div class="input">
							
							<?php echo $this->Form->input('WonderSpree.Brand', array('label' => __l('Brand'),'empty' => __l('Please select'),'multiple'=>true)); ?>
							
					</div>
					<div class="input">
							<?php echo $this->Form->input('WonderSpree.Category', array('label' => __l('Category'),'empty' => __l('Please select'), 'multiple'=>true)); ?>
							
					</div>
					<div class="input">
					
							<?php echo $this->Form->input('location',array('label' => __l('Location: (example: Tesco, Watsons, Parkson etc)'))); ?>
							
					</div>
				    <div  class="input">
							<?php echo $this->Form->input('purchase_date', array('label'=>__('Purchase Date'), 'type'=>'text', 'class'=>'datepicker'));?>
							<!-- <a href="#" class="date-spree" >Date</a>    -->
				    </div>
				    <div class="input">
					     <? echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('Upload Receipt'),'class'=>'required','div'=>'input file required','info'=>__('(Image size should be less then 500kb in the following file format .jpeg, .png, .jpg)')));?>
					     <?php // echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('Upload Receipt')));?>
                                             <?php // echo $this->Form->input('Attachment',array( 'type' => 'file')); ?>
					</div>
					   <?php echo $this->Form->end(__l('Submit'),array('class'=>'btn1'));?>
				</div>
			<div class="clear"></div> 
			</div>
		</div>
	</div>
</div>