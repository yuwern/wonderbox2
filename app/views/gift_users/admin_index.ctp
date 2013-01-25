<?php /* SVN: $Id: $ */ ?>
<?php 
	if(!empty($this->request->params['isAjax'])):
		echo $this->element('flash_message');
	endif;
?>
<div class="giftUsers index js-response">
<h2><?php echo __l('Gift Users');?></h2>
<?php echo $this->element('paging_counter');?>
<table class="list">
    <tr> 
       <th><?php echo __l('User name');?></th>
	   <th><?php echo __l('From Email');?></th>
       <th><?php echo __l('Friend name');?></th>
       <th><?php echo __l('Friend Email');?></th>
       <th><?php echo __l('Message');?></th>
	   <th><?php echo __l('Package Cost');?></th>
     </tr>
<?php
if (!empty($giftUsers)):

$i = 0;
foreach ($giftUsers as $giftUser):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>	<tr<?php echo $class;?>>
		<td><?php echo $this->Html->cText($giftUser['GiftUser']['from']);?></td>		
		<td><?php echo $this->Html->cText($giftUser['User']['email']);?></p>
		<td><?php echo $this->Html->cText($giftUser['GiftUser']['friend_name']);?></td>
		<td><?php echo $this->Html->cText($giftUser['GiftUser']['friend_mail']);?></td>
		<td><?php echo $this->Html->cText($giftUser['GiftUser']['message']);?></td>
		<td><?php echo $this->Html->cCurrency($giftUser['Package']['cost']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="7" class="notice"><p class="notice"><?php echo __l('No Gift Users available');?></p></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($giftUsers)) {?>
     <div class="js-pagination">
                        <?php echo $this->element('paging_links'); ?>
                    </div>
<?php } ?>
</div>