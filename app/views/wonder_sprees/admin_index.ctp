<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="brands index js-response">
<h2><?php echo __l('WonderSprees');?></h2>
     <div class="add-block">
                <?php //echo $this->Html->link(__l('Add'),array('controller'=>'wonder_sprees','action'=>'add'),array('class' => 'add', 'title' => __l('Add New Brand')));?>
            </div>
			    <div> 
            <?php echo $this->Form->create('WonderSpree' , array('action' => 'update','class'=>'normal'));?>
            <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
            <?php echo $this->element('paging_counter');?>
    <table class="list">
        <tr>
		<!--<th><?php// echo __l('Select');?></th>-->
		<th class="dl"><div><?php echo __l('Action');?></div></th>
       <th><?php echo __l('User name');?></th>
       <th><?php echo __l('Image');?></th>
	   <th><?php echo __l('Purchase amount');?></th>
       <th><?php echo __l('Type');?></th>
       <th><?php echo __l('Previous Discount');?></th>
       <th><?php echo __l('Location');?></th>
       <th><?php echo __l('Purchase Date');?></th>
	   <th><?php echo __l('Approved Status');?></th>
       
            </tr>
<?php
    if (!empty($wonderSprees)):

    $i = 0;
    foreach ($wonderSprees as $wonderSpree):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	    if($wonderSpree['WonderSpree']['is_active']):
           $status_class = 'js-checkbox-active';
     else:
              $status_class = 'js-checkbox-inactive';
       endif;
?>
	  <tr<?php echo $class;?>>
	   <!-- <td><?php  //echo $this->Form->input('WonderSpree.'.$wonderSpree['WonderSpree']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_".$wonderSpree['WonderSpree']['id'],'label' => false , 'class' =>  $status_class.' js-checkbox-list'));?></td>-->
	  	<td><div class="actions"><?php echo $this->Html->link(__l('View'), array('action'=>'show', $wonderSpree['WonderSpree']['id']), array('class' => 'edit js-view', 'title' => __l('View')));?></div></td>
		<td><?php echo $this->Html->cText($wonderSpree['User']['email']);?></td>
		<td><?php    echo $this->Html->showImage('WonderSpree',  empty($wonderSpree['Attachment']['filename'])?'':$wonderSpree['Attachment'], array('dimension' => 'medium_thumb'));?>  </td>
		<td><?php echo $this->Html->cFloat($wonderSpree['WonderSpree']['purchase_amt']);?></td>
		<td><?php echo $this->Html->cText($wonderSpree['WonderSpree']['type']);?></td>
		<td><?php echo $this->Html->cText($wonderSpree['WonderSpree']['previous_discount']);?></td>
		<td><?php echo $this->Html->cText($wonderSpree['WonderSpree']['location']);?></td>
		<td><?php echo $this->Html->cDate($wonderSpree['WonderSpree']['purchase_date']);?></td>
		<td><?php echo $this->Html->cBool($wonderSpree['WonderSpree']['is_active']);?></td>
		
		
	
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
 <?php if (!empty($wonderSprees)): ?>
                <!--<div class="admin-select-block">
                    <div>
                        <?php //echo __l('Select:'); ?>
                        <?php //echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
                       <?php //echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
						<?php //echo $this->Html->link(__l('Approve'), '#', array('class' => 'js-admin-select-pending','title' => __l('Approve'))); ?>
                     <?php //echo $this->Html->link(__l('UnApprove'), '#', array('class' => 'js-admin-select-approved','title' => __l('UnApprove'))); ?>
                    </div>
                     <div>
                        <?php //echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
                    </div>
                </div>-->
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

