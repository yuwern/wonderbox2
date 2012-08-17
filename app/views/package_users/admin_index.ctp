<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="packageUsers index">
<h2><?php echo __l('Package Users');?></h2>
<?php echo $this->element('paging_counter');?>
<ol class="list" start="<?php echo $paginator->counter(array(
    'format' => '%start%'
));?>">
<?php
if (!empty($packageUsers)):

$i = 0;
foreach ($packageUsers as $packageUser):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class;?>>
		<p><?php echo $this->Html->cInt($packageUser['PackageUser']['id']);?></p>
		<p><?php echo $this->Html->cDateTime($packageUser['PackageUser']['created']);?></p>
		<p><?php echo $this->Html->cDateTime($packageUser['PackageUser']['modified']);?></p>
		<p><?php echo $this->Html->link($this->Html->cText($packageUser['User']['username']), array('controller'=> 'users', 'action' => 'view', $packageUser['User']['username']), array('escape' => false));?></p>
		<p><?php echo $this->Html->link($this->Html->cText($packageUser['Package']['name']), array('controller'=> 'packages', 'action' => 'view', $packageUser['Package']['slug']), array('escape' => false));?></p>
		<p><?php echo $this->Html->cDate($packageUser['PackageUser']['start_date']);?></p>
		<p><?php echo $this->Html->cDate($packageUser['PackageUser']['end_date']);?></p>
		<p><?php echo $this->Html->cBool($packageUser['PackageUser']['is_paid']);?></p>
		<div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $packageUser['PackageUser']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $packageUser['PackageUser']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
	</li>
<?php
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No Package Users available');?></p>
	</li>
<?php
endif;
?>
</ol>

<?php
if (!empty($packageUsers)) {
    echo $this->element('paging_links');
}
?>
</div>
