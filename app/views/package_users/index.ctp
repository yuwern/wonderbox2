<?php if(empty($this->request->params['isAjax']) ): ?>	<div class="my-account">
				<?php echo $this->element('user-sidebar'); ?>
            	<div class="my-account-right">
	<?php endif; ?> 
	<div class="packageUsers index">
<h1><?php echo __l('My Subscriptions');?></h1>
<?php echo $this->element('paging_counter');?>
<table class="list">
    <tr>   
      <th class="left-cur"><?php echo __l('Package Name'); ?></th>
      <th><?php echo __l('Start Date'); ?></th>
  	  <th><?php echo __l('Till Date'); ?></th>
      <th class="right-cur"><?php echo __l('Status'); ?></th>
    </tr>
<?php
if (!empty($packageUsers)):

$i = 0;
foreach ($packageUsers as $packageUser):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr <?php echo $class;?>>
   	  <td><?php echo $this->Html->cText($packageUser['Package']['PackageType']['name']); ?></td>
      <td><?php  echo  date("F Y",strtotime($packageUser['PackageUser']['start_date']));  ?></td>
	  <td><?php  echo  date("F Y",strtotime($packageUser['PackageUser']['end_date']));  ?></td>
      <td><?php  echo  date("F Y",strtotime($packageUser['PackageUser']['start_date']));  ?></td>
    </tr>
<?php
    endforeach;
else:
?>
	<tr><td colspan="5"><?php echo __l('No Subscription available');?></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($packageUsers)) {
    echo $this->element('paging_links');
}
?>
</div>
<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>    
            </div>	
		<?php endif; ?>
