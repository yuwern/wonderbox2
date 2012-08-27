<?php /* SVN: $Id: $ */ ?>
<?php 
	if(!empty($this->request->params['isAjax'])):
		echo $this->element('flash_message');
	endif;
?>
<div class="genders index js-response">
<h2><?php echo __l('List of active users');?></h2>
     <div class="clearfix add-block1"><?php    echo $this->Html->link(__l('PDF'), array('controller' => 'users', 'action' => 'member_index', 'ext' => 'pdf', 'admin' => true), array('title' => __l('PDF'), 'class' => 'pdf','target'=>'__blank')); ?></div>
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
if (!empty($users)):

$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$address = $user['UserShipping'][0]['address'].','.$user['UserShipping'][0]['State']['name'].','.$user['UserShipping'][0]['Country']['name'].','.$user['UserShipping'][0]['zip_code'];
?>
	<tr<?php echo $class;?>>
	      <td>  <?php echo $this->Html->cText($user['UserProfile']['first_name']);?></td>
          <td>  <?php echo $this->Html->cText($user['User']['email']);?></td>
          <td>  <?php echo $this->Html->cText($address);?></td>
          <td>  <?php echo $this->Html->cText($user['UserShipping'][0]['contact_no']);?></td>
          <td>  <?php echo $this->Html->cText($user['UserShipping'][0]['contact_no1']);?></td>
          <td>  <?php echo $this->Html->cBool($user['User']['is_verified_user']);?></td>
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
if (!empty($genders)) { ?>
     <div class="js-pagination">
                        <?php echo $this->element('paging_links'); ?>
                    </div>
<?php } ?>
</div>
