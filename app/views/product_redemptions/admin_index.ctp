<div class="productRedemptions index">
<h2><?php echo __l('Product Redemptions');?></h2>
  <div class="add-block">
      <?php echo $this->Html->link(__l('Add'),array('controller'=>'product_redemptions','action'=>'add'),array('class' => 'add', 'title' => __l('Add')));?>
   </div>
	    <div> 
            <?php echo $this->Form->create('ProductRedemption' , array('action' => 'update','class'=>'normal'));?>
            <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
            <?php echo $this->element('paging_counter');?>
<table class="list">
       <tr>	   <th class="dl"><?php echo __l('Select'); ?></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Action');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Name');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Redeem Wonder point');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Active');?></div></th>	
            </tr>
<?php
if (!empty($productRedemptions)):

$i = 0;
foreach ($productRedemptions as $productRedemption):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	if($productRedemption['ProductRedemption']['is_active']):
           $status_class = 'js-checkbox-active';
     else:
           $status_class = 'js-checkbox-inactive';
	 endif;
?>
	<tr<?php echo $class;?>>
		    <td><?php  echo $this->Form->input('ProductRedemption.'. $productRedemption['ProductRedemption']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_". $productRedemption['ProductRedemption']['id'],'label' => false , 'class' =>  $status_class.' js-checkbox-list'));   ?></td>
		<td><div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $productRedemption['ProductRedemption']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $productRedemption['ProductRedemption']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div></td>
		<td> <?php echo $this->Html->showImage('ProductRedemption',  $productRedemption['Attachment'][0], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($productRedemption['ProductRedemption']['name'], false)), 'title' => $this->Html->cText($productRedemption['ProductRedemption']['name'], false)));?><?php echo $this->Html->cText($productRedemption['ProductRedemption']['name']);?></td>
		<td><?php echo $this->Html->cInt($productRedemption['ProductRedemption']['redeem_wonder_point']);?></td>
		<td><?php echo $this->Html->cBool($productRedemption['ProductRedemption']['is_active']);?></td>

	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="7"><p ><?php echo __l('No Product Redemptions available');?></p></td>
	</tr>
<?php
endif;
?>
</table>
<?php if (!empty($productRedemptions)): ?>
                <div class="admin-select-block">
                    <div>
                        <?php echo __l('Select:'); ?>
                        <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
                       <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
						<?php echo $this->Html->link(__l('Inactive'), '#', array('class' => 'js-admin-select-pending','title' => __l('Inactive'))); ?>
                     <?php echo $this->Html->link(__l('Active'), '#', array('class' => 'js-admin-select-approved','title' => __l('Active'))); ?>
                    </div>
                     <div>
                        <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
                    </div>
                </div>
                 <div class="js-pagination">
                    <?php echo $this->element('paging_links');  ?>
                </div>
                <div class="hide">
                    <?php echo $this->Form->submit('Submit');  ?>
                </div>
                <?
            endif;
            echo $this->Form->end();
            ?>
        </div>
</div>