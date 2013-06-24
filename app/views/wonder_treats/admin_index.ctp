<?php 
	if(!empty($this->request->params['isAjax'])):
		echo $this->element('flash_message');
	endif;
?>
<div class="wonderTreats index js-response">
<h2><?php echo __l('Wonder Treats');?></h2>
<?php echo $this->element('paging_counter');?>
<table class="list">
    <tr> 
	    <th><div class="js-pagination"><?php echo __l('Purchase date');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Email');?></div></th>
        <th><div class="js-pagination"><?php echo __l('BeautyTip Name');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Price');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Redemption Start Date');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Redemption End Date');?></div></th>
	 </tr>
<?php
if (!empty($wonderTreats)):

$i = 0;
foreach ($wonderTreats as $wonderTreat):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
	      <td>  <?php  echo  date("d F Y",strtotime($wonderTreat['WonderTreat']['purchase_date']));  ?></td>
	      <td>  <?php echo $this->Html->cText($wonderTreat['User']['email']);?></td>
	      <td> <?php  echo  $this->Html->cText($wonderTreat['BeautyTip']['name']);  ?></td>
	      <td> <?php  echo  $this->Html->cFloat($wonderTreat['BeautyTip']['purchase_amount']);  ?></td>
	      <td> <?php  echo  $this->Html->cDate($wonderTreat['BeautyTip']['redemption_start_date']);  ?></td>
	      <td> <?php  echo  $this->Html->cDate($wonderTreat['BeautyTip']['redemption_end_date']);  ?></td>
          </tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="9" class="notice"><?php echo __l('No Wonder Treats available');?></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($wonderTreats)) {    ?>
		<div class="js-pagination">
                        <?php echo $this->element('paging_links'); ?>
                    </div>
<?php } ?>
</div>
