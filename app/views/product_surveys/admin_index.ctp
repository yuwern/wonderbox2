<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="productSurveys index">
<h2><?php echo __l('Product Surveys');?></h2>
<?php echo $this->element('paging_counter');?>
<ol class="list" start="<?php echo $paginator->counter(array(
    'format' => '%start%'
));?>">
<?php
if (!empty($productSurveys)):

$i = 0;
foreach ($productSurveys as $productSurvey):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class;?>>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['id']);?></p>
		<p><?php echo $this->Html->cDateTime($productSurvey['ProductSurvey']['created']);?></p>
		<p><?php echo $this->Html->cDateTime($productSurvey['ProductSurvey']['modified']);?></p>
		<p><?php echo $this->Html->link($this->Html->cText($productSurvey['BeautyQuestion']['name']), array('controller'=> 'beauty_questions', 'action' => 'view', $productSurvey['BeautyQuestion']['slug']), array('escape' => false));?></p>
		<p><?php echo $this->Html->link($this->Html->cText($productSurvey['Product']['name']), array('controller'=> 'products', 'action' => 'view', $productSurvey['Product']['slug']), array('escape' => false));?></p>
		<p><?php echo $this->Html->link($this->Html->cText($productSurvey['User']['username']), array('controller'=> 'users', 'action' => 'view', $productSurvey['User']['username']), array('escape' => false));?></p>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['answer1']);?></p>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['answer2']);?></p>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['answer3']);?></p>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['answer4']);?></p>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['answer5']);?></p>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['answer6']);?></p>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['answer7']);?></p>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['answer8']);?></p>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['answer9']);?></p>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['answer10']);?></p>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['answer11']);?></p>
		<p><?php echo $this->Html->cInt($productSurvey['ProductSurvey']['answer12']);?></p>
		<p><?php echo $this->Html->cText($productSurvey['ProductSurvey']['other_answer']);?></p>
		<div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $productSurvey['ProductSurvey']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $productSurvey['ProductSurvey']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
	</li>
<?php
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No Product Surveys available');?></p>
	</li>
<?php
endif;
?>
</ol>

<?php
if (!empty($productSurveys)) {
    echo $this->element('paging_links');
}
?>
</div>
