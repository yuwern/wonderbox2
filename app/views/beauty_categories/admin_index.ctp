<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="beautyCategories index">
<h2><?php echo __l('Beauty Categories');?></h2>
<?php echo $this->element('paging_counter');?>
<ol class="list">
<?php
if (!empty($beautyCategories)):

$i = 0;
foreach ($beautyCategories as $beautyCategory):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class;?>>
		<p><?php echo $this->Html->cText($beautyCategory['BeautyCategory']['name']);?></p>
		<p><?php echo $this->Html->cBool($beautyCategory['BeautyCategory']['is_active']);?></p>
		<div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $beautyCategory['BeautyCategory']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $beautyCategory['BeautyCategory']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
	</li>
<?php
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No Beauty Categories available');?></p>
	</li>
<?php
endif;
?>
</ol>

<?php
if (!empty($beautyCategories)) {
    echo $this->element('paging_links');
}
?>
</div>
