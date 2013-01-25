<div class="productRedeems index">
<h2><?php echo __l('Product Redeems');?></h2>
            <?php echo $this->Form->create('ProductRedeem', array('type' => 'get', 'class' => 'normal1 search-form1 clearfix', 'action'=>'index')); ?>
			<?php $months = $this->Html->getMonthLists();
			$years = $this->Html->getYearLists();
			echo $this->Form->input('month', array('options'=>$months,'empty'=>__l('Please select'),'label'=> __l('Month'))); ?>
			<?php echo $this->Form->input('year', array('label'=> __l('Year'),'empty'=>__l('Please select'),'options'=> $years)); ?>
			<?php echo $this->Form->input('email', array('label'=> __l('Email'))); ?>
            <?php echo $this->Form->submit(__l('Search'));?>
            <?php echo $this->Form->end(); ?>

    <div> 
            <?php echo $this->element('paging_counter');?>
<table class="list">
       <tr>	 <th class="dl"><div class="js-pagination"><?php echo __l('Product Image');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Name');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Email');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Address');?></div></th>
			 <th><div class="js-pagination"><?php echo __l('Mobile No');?></div></th>
			 <th><div class="js-pagination"><?php echo __l('phone No');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Redeem Wonder point');?></div></th>
            </tr>
<?php
if (!empty($productRedeems)):

$i = 0;
foreach ($productRedeems as $productRedeem):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$address = $productRedeem['User']['UserShipping'][0]['address'].' '.$productRedeem['User']['UserShipping'][0]['zip_code'];
?>
	<tr<?php echo $class;?>>
		<td> <?php echo $this->Html->showImage('Product',  $productRedeem['Product']['Attachment'][0], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($productRedeem['Product']['name'], false)), 'title' => $this->Html->cText($productRedeem['Product']['name'], false)));?> <?php echo $this->Html->cText($productRedeem['Product']['name']);?></td>
		<td><?php echo $this->Html->cText($productRedeem['User']['UserProfile']['first_name'].' '.$productRedeem['User']['UserProfile']['last_name']);?></td>
		<td><?php echo $this->Html->cText($productRedeem['User']['email']);?></td>
		<td><?php echo $this->Html->cText($address);?></td>
        <td><?php echo $this->Html->cText($productRedeem['User']['UserShipping'][0]['contact_no']);?></td>
        <td><?php echo $this->Html->cText($productRedeem['User']['UserShipping'][0]['contact_no1']);?></td>
		<td><?php echo $this->Html->cInt($productRedeem['Product']['redeem_wonder_point']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="7"><p ><?php echo __l('No productRedeems available');?></p></td>
	</tr>
<?php
endif;
?>
</table></div>
</div>
