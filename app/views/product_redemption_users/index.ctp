<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="productRedemptionUsers index">
<h2><?php echo __l('Product Redemption Users');?></h2>
<?php echo $this->element('paging_counter');?>
<ol class="list" start="<?php echo $paginator->counter(array(
    'format' => '%start%'
));?>">
<?php
if (!empty($productRedemptionUsers)):

$i = 0;
foreach ($productRedemptionUsers as $productRedemptionUser):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class;?>>
		<p><?php echo $this->Html->cInt($productRedemptionUser['ProductRedemptionUser']['id']);?></p>
		<p><?php echo $this->Html->cDateTime($productRedemptionUser['ProductRedemptionUser']['created']);?></p>
		<p><?php echo $this->Html->cDateTime($productRedemptionUser['ProductRedemptionUser']['modified']);?></p>
		<p><?php echo $this->Html->link($this->Html->cText($productRedemptionUser['ProductRedemption']['name']), array('controller'=> 'product_redemptions', 'action' => 'view', $productRedemptionUser['ProductRedemption']['slug']), array('escape' => false));?></p>
		<p><?php echo $this->Html->link($this->Html->cText($productRedemptionUser['User']['username']), array('controller'=> 'users', 'action' => 'view', $productRedemptionUser['User']['username']), array('escape' => false));?></p>
		<p><?php echo $this->Html->cBool($productRedemptionUser['ProductRedemptionUser']['is_redeem']);?></p>
		<div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $productRedemptionUser['ProductRedemptionUser']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $productRedemptionUser['ProductRedemptionUser']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
	</li>
<?php
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No Product Redemption Users available');?></p>
	</li>
<?php
endif;
?>
</ol>

<?php
if (!empty($productRedemptionUsers)) {
    echo $this->element('paging_links');
}
?>
</div>
