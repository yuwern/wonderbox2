<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="beautyTipViews index">
<h2><?php echo __l('Beauty Tip Views');?></h2>
<?php echo $this->element('paging_counter');?>
<ol class="list">
<?php
if (!empty($beautyTipViews)):

$i = 0;
foreach ($beautyTipViews as $beautyTipView):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class;?>>
		<p><?php echo $this->Html->cDateTime($beautyTipView['BeautyTipView']['created']);?></p>
		<p><?php echo $this->Html->cDateTime($beautyTipView['BeautyTipView']['modified']);?></p>
		<p><?php echo $this->Html->link($this->Html->cText($beautyTipView['User']['username']), array('controller'=> 'users', 'action' => 'view', $beautyTipView['User']['username']), array('escape' => false));?></p>
		<p><?php echo $this->Html->link($this->Html->cText($beautyTipView['BeautyTip']['name']), array('controller'=> 'beauty_tips', 'action' => 'view', $beautyTipView['BeautyTip']['slug']), array('escape' => false));?></p>
		<p><?php echo $this->Html->cText($beautyTipView['BeautyTipView']['ip']);?></p>
		<div class="actions"><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $beautyTipView['BeautyTipView']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
	</li>
<?php
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No Beauty Tip Views available');?></p>
	</li>
<?php
endif;
?>
</ol>

<?php
if (!empty($beautyTipViews)) {
    echo $this->element('paging_links');
}
?>
</div>
