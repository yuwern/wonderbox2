<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="beautyQuestions index">
<h2><?php echo __l('Beauty Questions');?></h2>
    <?php echo $this->element('paging_counter');?>
    <table class="list">
        <tr>
		<!--	 <th class="dl"><?php echo __l('Action');?></th> -->
			 <th class="dl"><div class="js-pagination"><?php echo __l('Category');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Name'),'name');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Active');?></div></th>	
       </tr>
<?php
if (!empty($beautyQuestions)):

$i = 0;
foreach ($beautyQuestions as $beautyQuestion):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<!--<td><div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $beautyQuestion['BeautyQuestion']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></div></td> -->
		<td><?php echo $this->Html->cText($beautyQuestion['BeautyCategory']['name']);?></td>
		<td><?php echo $this->Html->link($this->Html->cText($beautyQuestion['BeautyQuestion']['name'],false), array('controller'=>'beauty_profiles','action'=>'chart', $beautyQuestion['BeautyQuestion']['id']), array( 'title' => __l('Edit')));?></td>
		<td><?php echo $this->Html->cBool($beautyQuestion['BeautyQuestion']['is_active']);?></td>

	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td><p class="notice"><?php echo __l('No Beauty Questions available');?></p></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($beautyQuestions)) {
    echo $this->element('paging_links');
}
?>
</div>
