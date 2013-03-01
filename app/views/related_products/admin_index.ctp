<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="relatedProducts index">
<h2><?php echo __l('Related Products');?></h2>
<?php echo $this->element('paging_counter');?>
<ol class="list" start="<?php echo $paginator->counter(array(
    'format' => '%start%'
));?>">
<?php
if (!empty($relatedProducts)):

$i = 0;
foreach ($relatedProducts as $relatedProduct):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class;?>>
		<p><?php echo $this->Html->cInt($relatedProduct['RelatedProduct']['id']);?></p>
		<p><?php echo $this->Html->cDateTime($relatedProduct['RelatedProduct']['created']);?></p>
		<p><?php echo $this->Html->cDateTime($relatedProduct['RelatedProduct']['modified']);?></p>
		<p><?php echo $this->Html->cText($relatedProduct['RelatedProduct']['name']);?></p>
		<p><?php echo $this->Html->cText($relatedProduct['RelatedProduct']['slug']);?></p>
		<p><?php echo $this->Html->link($this->Html->cText($relatedProduct['BeautyCategory']['name']), array('controller'=> 'beauty_categories', 'action' => 'view', $relatedProduct['BeautyCategory']['slug']), array('escape' => false));?></p>
		<p><?php echo $this->Html->link($this->Html->cText($relatedProduct['Brand']['name']), array('controller'=> 'brands', 'action' => 'view', $relatedProduct['Brand']['slug']), array('escape' => false));?></p>
		<p><?php echo $this->Html->link($this->Html->cText($relatedProduct['ProductRedemption']['name']), array('controller'=> 'product_redemptions', 'action' => 'view', $relatedProduct['ProductRedemption']['slug']), array('escape' => false));?></p>
		<p><?php echo $this->Html->cText($relatedProduct['RelatedProduct']['description']);?></p>
		<p><?php echo $this->Html->cCurrency($relatedProduct['RelatedProduct']['price']);?></p>
		<div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $relatedProduct['RelatedProduct']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $relatedProduct['RelatedProduct']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
	</li>
<?php
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No Related Products available');?></p>
	</li>
<?php
endif;
?>
</ol>

<?php
if (!empty($relatedProducts)) {
    echo $this->element('paging_links');
}
?>
</div>
