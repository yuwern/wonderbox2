<?php /* SVN: $Id: $ */ ?>
<?php 
	if(!empty($this->request->params['isAjax'])):
		echo $this->element('flash_message');
	endif;
?>
<div class="giftUsers index js-response">
<h2><?php echo __l('Gift Users');?></h2>
            <?php echo $this->Form->create('GiftUser', array('type' => 'get', 'class' => 'normal1 search-form1 clearfix', 'action'=>'index')); ?>
			<?php $months = $this->Html->getMonthLists();
			$years = $this->Html->getYearLists();
			echo $this->Form->input('month', array('options'=>$months,'empty'=>__l('Please select'),'label'=> __l('Month'))); ?>
			<?php echo $this->Form->input('year', array('label'=> __l('Year'),'empty'=>__l('Please select'),'options'=> $years)); ?>
			<?php echo $this->Form->input('email', array('label'=> __l('From Email'))); ?>
            <?php echo $this->Form->submit(__l('Search'));?>
            <?php echo $this->Form->end(); ?>
<?php echo $this->element('paging_counter');?>
   <div class="clearfix add-block1"><?php 
	if (!empty($giftUsers)):
	 echo $this->Html->link(__l('Import Tracking Number'),array('controller' => 'gift_users', 'action' => 'import', 'admin' => true), array('title' => __l('Import Tracking Number'), 'class' => 'import'));
 	 echo $this->Html->link(__l('PDF'), array_merge(array('controller' => 'gift_users', 'action' => 'index', 'ext' => 'pdf', 'admin' => true), $this->request->params['named']), array('title' => __l('PDF'), 'class' => 'pdf'));
     echo $this->Html->link(__l('CSV'), array_merge(array('controller' => 'gift_users', 'action' => 'export', 'ext' => 'csv', 'admin' => true), $this->request->params['named']), array('title' => __l('CSV'), 'class' => 'export'));

	 
	 endif; 
	 ?></div>
<table class="list">
    <tr> 
	   <th class="dl"><div><?php echo __l('Action');?></div></th>
       <th><?php echo __l('User name');?></th>
	   <th><?php echo __l('From Email');?></th>
       <th><?php echo __l('Friend name');?></th>
       <th><?php echo __l('Friend Email');?></th>
       <th><?php echo __l('Package Name');?></th>
       <th><?php echo __l('Address');?></th>
       <th><?php echo __l('Message');?></th>
	   <th><?php echo __l('Status');?></th>
	   <th><?php echo __l('Tracking Number');?></th>
	   <th><?php echo __l('Go');?></th>
     </tr>
<?php
if (!empty($giftUsers)):

$i = 0;
foreach ($giftUsers as $giftUser):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>	<tr<?php echo $class;?>>
		 <td><div class="actions"><span><?php echo $this->Html->link(__l('Tracking No'), array('action'=>'edit',$giftUser['GiftUser']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span></div>	  </td>
		<td><?php echo $this->Html->cText($giftUser['GiftUser']['from']);?></td>		
		<td><?php echo $this->Html->cText($giftUser['User']['email']);?></p>
		<td><?php echo $this->Html->cText($giftUser['GiftUser']['friend_name']);?></td>
		<td><?php echo $this->Html->cText($giftUser['GiftUser']['friend_mail']);?></td>
		<td><?php echo $this->Html->cText($giftUser['Package']['name']);?></td>
		<td><?php
		        if(!empty($giftUser['GiftUser']['address'])):
					echo $this->Html->cText($giftUser['GiftUser']['address']);
				else: 
					echo !empty($giftUser['User']['UserShipping'][0]['address'])?$this->Html->cText($giftUser['User']['UserShipping'][0]['address']):'';
				endif;
				if(!empty($giftUser['GiftUser']['address1'])):
					echo "<br/>";
					echo $this->Html->cText($giftUser['GiftUser']['address1']);
				else: 
					echo "<br/>";
					echo !empty($giftUser['User']['UserShipping'][0]['address2'])?$this->Html->cText($giftUser['User']['UserShipping'][0]['address2']):'';
				endif;				
				if(!empty($giftUser['GiftUser']['address2'])):
					echo "<br/>";
					echo !empty($giftUser['User']['UserShipping'][0]['address2'])? $this->Html->cText($giftUser['GiftUser']['address2']):'';
				else:
					echo "<br/>";
					echo !empty($giftUser['User']['UserShipping'][0]['address3'])? $this->Html->cText($giftUser['User']['UserShipping'][0]['address3']):'';
				endif;
				?></td>
		<td><?php echo $this->Html->cText($giftUser['GiftUser']['message']);?></td>
		<td><?php echo date("F Y",strtotime($giftUser['GiftUser']['start_date']));?></td>
        <td><?php echo !empty($giftUser['GiftUser']['tracking_number'])?$this->Html->cText($giftUser['GiftUser']['tracking_number']):__('Nil');?></td>
		<td><?php if(!empty($giftUser['GiftUser']['tracking_number'])): 
				echo $this->Html->link(__l('Go'),'http://203.106.236.200/official/etracking.php', array( 'title' => __l('Go'),'target'=>'_blank'));
			 else:
				echo '---';
		     endif; ?>
	  </td>

	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="9" class="notice"><p><?php echo __l('No Gift Users available');?></p></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($giftUsers)) {?>
     <div class="js-pagination">
                        <?php echo $this->element('paging_links'); ?>
                    </div>
<?php } ?>
</div>