<h2><?php echo __l('Subscription Packages');?></h2>
 <?php echo $this->element('paging_counter'); ?>
  <table class="list">
    <tr>
      <th><?php echo __l('Select'); ?></th>
      <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Billing Cycle'),'name'); ?></div></th>
      <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Subscription Type'),'PackageType.name'); ?></div></th>
	  <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Billing Amount'),'cost'); ?></div></th>
  	  <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Wonder Points'),'no_of_wonderpoints'); ?></div></th>
	  <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Active'),'is_active'); ?></div></th>
    </tr>
    <?php
if (!empty($packages)):

$i = 0;
foreach ($packages as $package):
	$class = null;
	if ($i++ % 2 == 0):
		$class = ' class="altrow"';
	endif;
    if($package['Package']['is_active']):
        $status_class = 'js-checkbox-active';
    else:
        $status_class = 'js-checkbox-inactive';
    endif;
?>
    <tr<?php echo $class;?>>
      <td>
		<div class="actions-block">
			<div class="actions round-5-left">
	  		<?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $package['Package']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?>
			<?php // echo $this->Html->link(__l('Delete'), array('action'=>'delete', $package['Package']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?>
			</div>
		</div>
	  <?php echo $this->Form->input('Package.'.$package['Package']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$package['Package']['id'], 'label' => false, 'class' =>$status_class.' js-Package-list js-checkbox-list')); ?></td>
      <td><?php echo $this->Html->cText($package['Package']['name']);?></td>
      <td class="dl"><?php echo $this->Html->cText($package['PackageType']['name']);?></td>
      <td class="dl"><?php echo $this->Html->cText($package['Package']['cost']);?></td>
      <td class="dl"><?php echo ($package['Package']['no_of_wonderpoints'])?$this->Html->cText($package['Package']['no_of_wonderpoints']) :'--';?></td>
      <td class="dl"><?php echo $this->Html->cBool($package['Package']['is_active']);?></td>
      </tr>
    <?php
    endforeach;
else:
?>
    <tr>
      <td colspan="14" class="notice"><?php echo __l('No Subscription packages available');?></td>
    </tr>
    <?php
endif;
?>
  </table>