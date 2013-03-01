<div class="productRedemptionUsers index">
 <h2><?php echo __l('Product Redemption Users');?></h2>
            <?php echo $this->Form->create('ProductRedemptionUser', array('type' => 'get', 'class' => 'normal1 search-form1 clearfix', 'action'=>'index')); ?>
			<?php $months = $this->Html->getMonthLists();
			$years = $this->Html->getYearLists();
			echo $this->Form->input('month', array('options'=>$months,'empty'=>__l('Please select'),'label'=> __l('Month'))); ?>
			<?php echo $this->Form->input('year', array('label'=> __l('Year'),'empty'=>__l('Please select'),'options'=> $years)); ?>
			<?php echo $this->Form->input('email', array('label'=> __l('Email'))); ?>
            <?php echo $this->Form->submit(__l('Search'));?>
            <?php echo $this->Form->end(); ?>
        <?php echo $this->element('paging_counter');?>
		<table class="list">
		<tr>
			<th class="dl"><div class="js-pagination"><?php echo __l('Image');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Name');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Email');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Address');?></div></th>
			 <th><div class="js-pagination"><?php echo __l('Mobile No');?></div></th>
			 <th><div class="js-pagination"><?php echo __l('phone No');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Redeem Wonder point');?></div></th>
            </tr>
<?php
if (!empty($productRedemptionUsers)):

$i = 0;
foreach ($productRedemptionUsers as $productRedemptionUser):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$address  = '' ;
	if(!empty($productRedemptionUser['User']['UserShipping'][0]['address']))
	 $address .= $productRedemptionUser['User']['UserShipping'][0]['address'];
	if(!empty($productRedemptionUser['User']['UserShipping'][0]['zip_code']))
	 $address .= $productRedemptionUser['User']['UserShipping'][0]['zip_code'];
	?>
	<tr<?php echo $class;?>>
		<td> <?php echo $this->Html->showImage('ProductRedemption',  $productRedemptionUser['ProductRedemption']['Attachment'][0], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($productRedemptionUser['ProductRedemption']['name'], false)), 'title' => $this->Html->cText($productRedemptionUser['ProductRedemption']['name'], false)));?> <?php echo $this->Html->cText($productRedemptionUser['ProductRedemption']['name']);?></td>
		<td><?php echo $this->Html->cText($productRedemptionUser['User']['UserProfile']['first_name'].' '.$productRedemptionUser['User']['UserProfile']['last_name']);?></td>
		<td><?php echo $this->Html->cText($productRedemptionUser['User']['email']);?></td>
		<td><?php echo $this->Html->cText($address);?></td>
        <td><?php if(!empty($productRedemptionUser['User']['UserShipping'][0]['contact_no']))
				   echo $this->Html->cText($productRedemptionUser['User']['UserShipping'][0]['contact_no']);
				  else
	  			   echo "--";
				?></td>
        <td><?php if(!empty($productRedemptionUser['User']['UserShipping'][0]['contact_no1']))
					echo $this->Html->cText($productRedemptionUser['User']['UserShipping'][0]['contact_no1']);
				  else 
					  echo "--";
					?></td>
		<td><?php echo $this->Html->cInt($productRedemptionUser['ProductRedemption']['redeem_wonder_point']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="7"><p ><?php echo __l('No Product Redemption Users available');?></p></td>
	</tr>
<?php
endif;
?>
</table>
<?php
if (!empty($productRedemptionUsers)) {
    echo $this->element('paging_links');
}
?>
</div>