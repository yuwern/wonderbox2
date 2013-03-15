<?php 
	if(!empty($this->request->params['isAjax'])):
		echo $this->element('flash_message');
	endif;
?>
<div class="packageusers index js-response">
<h2><?php echo __l('List of active users');?></h2>
            <?php echo $this->Form->create('PackageUser', array('type' => 'get', 'class' => 'normal1 search-form1 clearfix', 'action'=>'index')); ?>
			<?php $months = $this->Html->getMonthLists();
			$years = $this->Html->getYearLists();
			echo $this->Form->input('month', array('options'=>$months,'empty'=>__l('Please select'),'label'=> __l('Month'))); ?>
			<?php echo $this->Form->input('year', array('label'=> __l('Year'),'empty'=>__l('Please select'),'options'=> $years)); ?>
			<?php echo $this->Form->input('email', array('label'=> __l('Email'))); ?>
            <?php echo $this->Form->submit(__l('Search'));?>
            <?php echo $this->Form->end(); ?>

     <div class="clearfix add-block1"><?php 
	if (!empty($packageUsers)):
	 echo $this->Html->link(__l('Import Tracking Number'),array('controller' => 'package_users', 'action' => 'import', 'admin' => true), array('title' => __l('Import Tracking Number'), 'class' => 'import'));
	 echo $this->Html->link(__l('PDF'), array_merge(array('controller' => 'package_users', 'action' => 'index', 'ext' => 'pdf', 'admin' => true), $this->request->params['named']), array('title' => __l('PDF'), 'class' => 'pdf'));
     echo $this->Html->link(__l('CSV'), array_merge(array('controller' => 'package_users', 'action' => 'index', 'ext' => 'csv', 'admin' => true), $this->request->params['named']), array('title' => __l('CSV'), 'class' => 'export'));
	 endif; 
	 ?></div>
<?php echo $this->element('paging_counter');?>
<table class="list">
    <tr> 
	    <th class="dl"><div><?php echo __l('Action');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Name');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Package Type');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Email');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Address');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Mobile No');?></div></th>
        <th><div class="js-pagination"><?php echo __l('phone No');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Status');?></div></th>
		<th><div class="js-pagination"><?php echo __l('Tracking Number');?></div></th>
		<th><div class="js-pagination"><?php echo __l('Go');?></div></th>
     </tr>
<?php
if (!empty($packageUsers)):

$i = 0;
foreach ($packageUsers as $packageUser):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$address  = ' <p> ';
	if(!empty($packageUser['User']['UserShipping'][0]['address'])):
	$address  .= $packageUser['User']['UserShipping'][0]['address'].', ';
	endif; 	
	if(!empty($packageUser['User']['UserShipping'][0]['address2'])):
	$address  .= $packageUser['User']['UserShipping'][0]['address2'].', ';
	endif; 		
	if(!empty($packageUser['User']['UserShipping'][0]['address3'])):
	$address  .= $packageUser['User']['UserShipping'][0]['address3'].', ';
	endif; 
	if(!empty($packageUser['User']['UserShipping'][0]['State']['name'])):
	$address  .= $packageUser['User']['UserShipping'][0]['State']['name'] .', ';
	endif; 
	if(!empty($packageUser['User']['UserShipping'][0]['Country']['name'])):
	$address  .= $packageUser['User']['UserShipping'][0]['Country']['name'] .', ';
	endif; 	
	if(!empty($packageUser['User']['UserShipping'][0]['zip_code'])):
	$address  .= $packageUser['User']['UserShipping'][0]['zip_code'] ;
	endif; 
	$address .= "</p>";
?>
	<tr<?php echo $class;?>>
		 <td><div class="actions"><span><?php echo $this->Html->link(__l('Tracking No'), array('action'=>'edit',$packageUser['PackageUser']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span></div></td>
	      <td>  <?php echo $this->Html->cText($packageUser['User']['UserProfile']['first_name'].' '.$packageUser['User']['UserProfile']['last_name']);?></td>
          <td>  <?php echo $this->Html->cText($packageUser['Package']['PackageCategory']['name']);?></td>
          <td>  <?php echo $this->Html->cText($packageUser['User']['email']);?></td>
          <td>  <?php echo $this->Html->cHtml($address);?></td>
          <td>  <?php if(!empty($packageUser['User']['UserShipping'][0]['contact_no'])):
						echo $this->Html->cText($packageUser['User']['UserShipping'][0]['contact_no']);
					  endif; ?></td>
          <td>  <?php if(!empty($packageUser['User']['UserShipping'][0]['contact_no1'])):
						echo $this->Html->cText($packageUser['User']['UserShipping'][0]['contact_no1']);
					  endif; ?></td>
          <td>  <?php echo date("F Y",strtotime($packageUser['PackageUser']['start_date']));?></td>
          <td>  <?php echo !empty($packageUser['PackageUser']['tracking_number'])?$this->Html->cText($packageUser['PackageUser']['tracking_number']):__('Nil');?></td>
		   <td><?php if(!empty($packageUser['PackageUser']['tracking_number'])): 
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
		<td colspan="9" class="notice"><?php echo __l('No active users list available');?></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($packageUsers)) { ?>
     <div class="js-pagination">
                        <?php echo $this->element('paging_links'); ?>
                    </div>
<?php } ?>
</div>
