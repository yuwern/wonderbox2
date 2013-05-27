
<div class="beautyTips index js-response">
<h2><?php echo __l('Beauty Content Page');?></h2>
           <?php echo $this->Form->create('BeautyTip', array('type' => 'get', 'class' => 'normal1 search-form1 clearfix', 'action'=>'index')); ?>
			<?php $months = $this->Html->getMonthLists();
			$years = $this->Html->getYearLists();
			echo $this->Form->input('month', array('options'=>$months,'empty'=>__l('Please select'),'label'=> __l('Month'))); ?>
			<?php echo $this->Form->input('year', array('label'=> __l('Year'),'empty'=>__l('Please select'),'options'=> $years)); ?>
            <?php echo $this->Form->submit(__l('Search'));?>
            <?php echo $this->Form->end(); ?>
     <div class="add-block">
                <?php echo $this->Html->link(__l('Add'),array('controller'=>'beauty_tips','action'=>'add'),array('class' => 'add', 'title' => __l('Add New Beauty Tip')));?>
            </div>
			    <div> 
            <?php echo $this->Form->create('BeautyTip' , array('action' => 'update','class'=>'normal'));?>
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
			 <th class="dl"><div class="js-pagination"><?php echo __l('User view count');?></div></th>	
            </tr>
<?php
if (!empty($beautyTips)):

$i = 0;
foreach ($beautyTips as $beautyTip):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	    if($beautyTip['BeautyTip']['is_active']):
           $status_class = 'js-checkbox-active';
     else:
              $status_class = 'js-checkbox-inactive';
       endif;
?>
	  <tr<?php echo $class;?>>
	    <td><?php  echo $this->Form->input('BeautyTip.'.$beautyTip['BeautyTip']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_".$beautyTip['BeautyTip']['id'],'label' => false , 'class' =>  $status_class.' js-checkbox-list'));
                                ?></td>
	  	<td><div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $beautyTip['BeautyTip']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?>
		<?php if($this->Auth->user('user_type_id') == ConstUserTypes::Admin): ?>
		<?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $beautyTip['BeautyTip']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?>
		<?php endif; ?>
		</div></td>
		<td><?php echo $this->Html->cDateTime($beautyTip['BeautyTip']['created']);?></td>
		<td><?php echo $this->Html->cDateTime($beautyTip['BeautyTip']['modified']);?></td>
		<td><?php echo $this->Html->cText($beautyTip['User']['email']);?></td>
		 <td><?php    echo $this->Html->link($this->Html->showImage('BeautyTip',  $beautyTip['Attachment'], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($beautyTip['BeautyTip']['name'], false)), 'title' => $this->Html->cText($beautyTip['BeautyTip']['name'], false))), array('controller' => 'beauty_tips', 'action' => 'view', $beautyTip['BeautyTip']['slug'],'admin'=>false),array('title' =>sprintf(__l('%s'),$beautyTip['BeautyTip']['name']), 'escape' => false));?>  <?php echo $this->Html->link($this->Html->cText($beautyTip['BeautyTip']['name']), array('controller' => 'beauty_tips', 'action' => 'view', $beautyTip['BeautyTip']['slug'],'admin'=>false),array('title' =>sprintf(__l('%s'),$beautyTip['BeautyTip']['name']), 'escape' => false));?></td>
		<td><?php echo $this->Html->cBool($beautyTip['BeautyTip']['is_active']);?></td>
		<td><?php echo $this->Html->link($this->Html->cInt($beautyTip['BeautyTip']['beauty_tip_view_count']), array('controller' => 'beauty_tip_views', 'action' => 'index', $beautyTip['BeautyTip']['slug']),array('title' =>$beautyTip['BeautyTip']['beauty_tip_view_count'], 'escape' => false));?></td>
	
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="5"><p><?php echo __l('No Beauty Content Page available');?></p></td>
	</tr>
<?php
endif;
?>
</table>
 <?php if (!empty($beautyTips)): ?>
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
