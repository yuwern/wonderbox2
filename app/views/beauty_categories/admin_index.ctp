<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="beautyCategories index">
<h2><?php echo __l('Beauty Categories');?></h2>
<?php echo $this->element('paging_counter');?>
    <table class="list">
        <tr>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Action');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Name');?></div></th>
       </tr>
<?php
if (!empty($beautyCategories)):

$i = 0;
foreach ($beautyCategories as $beautyCategory):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
			<td><div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $beautyCategory['BeautyCategory']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></div><div class="actions"><?php echo $this->Html->link(__l('Chart'), array('action'=>'chart', $beautyCategory['BeautyCategory']['slug']), array('class' => 'chart js-edit', 'title' => __l('Chart')));?></div></td>
		<td><?php echo $this->Html->cText($beautyCategory['BeautyCategory']['name']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td  colspan="4"><p class="notice"><?php echo __l('No Beauty Categories available');?></p></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($beautyCategories)) {
    echo $this->element('paging_links');
}
?>
</div>

