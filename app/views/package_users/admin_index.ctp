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
	  echo $this->Html->link(__l('PDF'), array_merge(array('controller' => 'package_users', 'action' => 'index', 'ext' => 'pdf', 'admin' => true), $this->request->params['named']), array('title' => __l('PDF'), 'class' => 'pdf'));
     echo $this->Html->link(__l('CSV'), array_merge(array('controller' => 'package_users', 'action' => 'index', 'ext' => 'csv', 'admin' => true), $this->request->params['named']), array('title' => __l('CSV'), 'class' => 'export'));
	 endif; 
	 ?></div>
<?php echo $this->element('paging_counter');?>
<table class="list">
    <tr> 
        <th><div class="js-pagination"><?php echo __l('Name');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Email');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Address');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Mobile No');?></div></th>
        <th><div class="js-pagination"><?php echo __l('phone No');?></div></th>
        <th><div class="js-pagination"><?php echo __l('Status');?></div></th>
     </tr>
<?php
if (!empty($packageUsers)):

$i = 0;
foreach ($packageUsers as $packageUser):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$address = $packageUser['User']['UserShipping'][0]['address'].','.$packageUser['User']['UserShipping'][0]['State']['name'].','.$packageUser['User']['UserShipping'][0]['Country']['name'].','.$packageUser['User']['UserShipping'][0]['zip_code'];
?>
	<tr<?php echo $class;?>>
	      <td>  <?php echo $this->Html->cText($packageUser['User']['UserProfile']['first_name']);?></td>
          <td>  <?php echo $this->Html->cText($packageUser['User']['email']);?></td>
          <td>  <?php echo $this->Html->cText($address);?></td>
          <td>  <?php echo $this->Html->cText($packageUser['User']['UserShipping'][0]['contact_no']);?></td>
          <td>  <?php echo $this->Html->cText($packageUser['User']['UserShipping'][0]['contact_no1']);?></td>
          <td>  <?php echo date("F Y",strtotime($packageUser['PackageUser']['start_date']));?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="7" class="notice"><?php echo __l('No active users list available');?></td>
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
