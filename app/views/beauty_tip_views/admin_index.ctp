<div class="beautyTipViews index">
<h2><?php echo __l('Beauty Tip Views');?></h2>
<?php echo $this->element('paging_counter');?>
    <table class="list">
        <tr>
		    <th class="dl"><?php echo __l('Created Dated');?></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Email');?></div></th>	
			 <th class="dl"><div class="js-pagination"><?php echo __l('Beauty Tip name');?></div></th>	
			 <th class="dl"><div class="js-pagination"><?php echo __l('Brand name');?></div></th>	
			 <th class="dl"><div class="js-pagination"><?php echo __l('BeautyCategory name');?></div></th>	
			 <th class="dl"><div class="js-pagination"><?php echo __l('Category name');?></div></th>	
			 <th class="dl"><div class="js-pagination"><?php echo __l('User IP');?></div></th>	
            </tr>
<?php
if (!empty($beautyTipViews)):

$i = 0;
foreach ($beautyTipViews as $beautyTipView):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	 <tr<?php echo $class;?>>
		<td><?php echo $this->Html->cDateTime($beautyTipView['BeautyTipView']['created']);?></td>
		<td><?php echo $this->Html->cText($beautyTipView['User']['email']);?></td>
		<td><?php echo $this->Html->cText($beautyTipView['BeautyTip']['name']);?></td>
		<td><?php echo $this->Html->cText($beautyTipView['BeautyTip']['Brand']['name']);?></td>
		<td><?php echo $this->Html->cText($beautyTipView['BeautyTip']['BeautyCategory']['name']);?></td>
		<td><?php foreach($beautyTipView['BeautyTip']['Category'] as $category):
						echo $this->Html->cText($category['name']);
						echo ",";						
				   endforeach;	?></td>
		<td><?php echo $this->Html->cText($beautyTipView['BeautyTipView']['ip']);?></td>
		
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td><p class="notice"><?php echo __l('No Beauty Tip Views available');?></p></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($beautyTipViews)) {
    echo $this->element('paging_links');
}
?>
</div>
