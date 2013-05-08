<div class="productVotes index">
<h2><?php echo __l('Product Votes');?></h2>
<?php echo $this->element('paging_counter');?>
<ol class="list" >
<?php
if (!empty($productVotes)):

$i = 0;
foreach ($productVotes as $productVote):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class;?>>
		<p><?php echo $this->Html->link($this->Html->cText($productVote['Product']['name']), array('controller'=> 'products', 'action' => 'view', $productVote['Product']['slug']), array('escape' => false));?></p>
		<p><?php echo $this->Html->link($this->Html->cText($productVote['User']['username']), array('controller'=> 'users', 'action' => 'view', $productVote['User']['username']), array('escape' => false));?></p>
		<p><?php echo $this->Html->link($this->Html->cText($productVote['ProductQuestion']['name']), array('controller'=> 'product_questions', 'action' => 'view', $productVote['ProductQuestion']['id']), array('escape' => false));?></p>
		<p><?php echo $this->Html->cBool($productVote['ProductVote']['answer']);?></p>
		
	</li>
<?php
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No Product Votes available');?></p>
	</li>
<?php
endif;
?>
</ol>

<?php
if (!empty($productVotes)) {
    echo $this->element('paging_links');
}
?>
</div>
