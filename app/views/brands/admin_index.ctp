<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="brands index js-response">
<h2><?php echo __l('Brands');?></h2>
     <div class="add-block">
                <?php echo $this->Html->link(__l('Add'),array('controller'=>'brands','action'=>'add'),array('class' => 'add', 'title' => __l('Add New Brand')));?>
            </div>
			    <div> 
            <?php echo $this->Form->create('Brand' , array('action' => 'update','class'=>'normal'));?>
            <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
            <?php echo $this->element('paging_counter');?>
    <table class="list">
        <tr>
		   <th class="dl"><?php echo __l('Select'); ?></th>
			 <th class="dl"><?php echo __l('Action');?></th>
			 <th class="dl"><?php echo __l('Created');?></th>
			 <th class="dl"><?php echo __l('Modified');?></th>
			 <th class="dl"><?php echo __l('Created by');?></th>
			 <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Name'),'name');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Active');?></div></th>	
            </tr>
<?php
if (!empty($brands)):

$i = 0;
foreach ($brands as $brand):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	    if($brand['Brand']['is_active']):
           $status_class = 'js-checkbox-active';
     else:
              $status_class = 'js-checkbox-inactive';
       endif;
?>
	  <tr<?php echo $class;?>>
	    <td><?php  echo $this->Form->input('Brand.'.$brand['Brand']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_".$brand['Brand']['id'],'label' => false , 'class' =>  $status_class.' js-checkbox-list'));
                                ?></td>
	  	<td><div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $brand['Brand']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?>
		<?php if($this->Auth->user('user_type_id') == ConstUserTypes::Admin): ?>
		<?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $brand['Brand']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?>
		<?php endif; ?>
		</div></td>
		<td><?php echo $this->Html->cDateTime($brand['Brand']['created']);?></td>
		<td><?php echo $this->Html->cBool($brand['Brand']['modified']);?></td>
		<td><?php echo $this->Html->cBool($brand['User']['email']);?></td>
		 <td><?php    echo $this->Html->link($this->Html->showImage('Brand',  $brand['Attachment'], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($brand['Brand']['name'], false)), 'title' => $this->Html->cText($brand['Brand']['name'], false))), array('controller' => 'brands', 'action' => 'view', $brand['Brand']['slug'],'admin'=>false),array('title' =>sprintf(__l('%s'),$brand['Brand']['name']), 'escape' => false));?>  <?php echo $this->Html->link($this->Html->cText($brand['Brand']['name']), array('controller' => 'brands', 'action' => 'view', $brand['Brand']['slug'],'admin'=>false),array('title' =>sprintf(__l('%s'),$brand['Brand']['name']), 'escape' => false));?></td>
		<td><?php echo $this->Html->cBool($brand['Brand']['is_active']);?></td>
	
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="4"><p><?php echo __l('No Brands available');?></p></td>
	</tr>
<?php
endif;
?>
</table>
 <?php if (!empty($brands)): ?>
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
