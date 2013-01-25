<?php if(empty($this->request->params['isAjax']) ): ?>	<div class="my-account">
				<?php echo $this->element('user-sidebar'); ?>
            	<div class="my-account-right">
	<?php endif; ?> 
	<?php if(empty($this->request->params['named']['type']) && empty($this->request->params['named']['sort'])): ?>
	    <div class="js-tabs">
        <ul class="clearfix">
            <li><?php echo $this->Html->link(__l('Received'),array('controller'=> 'gift_users', 'action'=>'index', 'type' => 'received'),array('title' => 'Received Gift Wonderbox')); ?></li>
            <li><?php echo $this->Html->link(__l('Sent'),array('controller'=> 'gift_users', 'action'=>'index', 'type' => 'sent'), array('title' => 'Sent Gift Wonderbox')); ?></li>
        </ul>
    </div>
<?php else: ?>
<div class="giftUsers index">
<h2><?php echo __l('My Gift Subscriptions');?></h2>
<?php echo $this->element('paging_counter');?>
<table class="list">
    <tr>   
      <th class="left-cur"><?php echo __l('Purchased Date'); ?></th>
  	  <th><?php echo __l('Amount'); ?></th>
  	  <th><?php echo __l('Send To'); ?></th>
  	  <th><?php echo __l('Message'); ?></th>
    </tr>
<?php
if (!empty($giftUsers)):

$i = 0;
foreach ($giftUsers as $giftUser):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr <?php echo $class;?>>
		<td><?php echo $this->Html->cText($giftUser['GiftUser']['created']);?></td>
		<td><?php echo Configure::read('site.currency'). '  '. $this->Html->cText($giftUser['Package']['cost']);?></td>
		<td><?php echo $this->Html->cText($giftUser['GiftUser']['friend_name']);?></td>
		<td><?php echo $this->Html->cText($giftUser['GiftUser']['message']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr><td colspan="5"><?php echo __l('No Subscription available');?></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($giftUsers)) {
    echo $this->element('paging_links');
}
?>
</div>
<?php endif; ?>
<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>    
            </div>	
		<?php endif; ?>
	