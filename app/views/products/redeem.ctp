<?php if(empty($this->request->params['isAjax']) ): ?>	<div class="my-account">
				<?php echo $this->element('user-sidebar'); ?>
            	<div class="my-account-right">
	<?php endif; ?> 
	<div class="packageUsers index">
<h1><?php echo __l('My Product Redemption');?></h1>
<?php echo $this->element('paging_counter');?>
<table class="list">
    <tr>   
      <th class="left-cur"><?php echo __l('Brand'); ?>  </th>
      <th><?php echo __l('Product'); ?> </th>
  	  <th><?php echo __l('Reedeem WonderPoints'); ?></th>
      <th><?php echo __l('Reedeem'); ?></th>
    </tr>
<?php
if (!empty($products)):

$i = 0;
foreach ($products as $product):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr <?php echo $class;?>>
   	  <td><?php echo $this->Html->cText($product['Brand']['name']); ?></td>
      <td><?php echo $this->Html->truncate($product['Product']['name'],25, array('ending' => '...')); ?> </td>
	  <td><?php echo $this->Html->cInt($product['Product']['redeem_wonder_point']); ?></td>
  	  <td><?php echo $this->Html->link(__l('Redeem'), array('action'=>'redeem', $product['Product']['slug']), array('title' => __l('Redeem')));?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr><td colspan="5"><?php echo __l('No Product Redemption');?></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($products)) {
    echo $this->element('paging_links');
}
?>
</div>
<?php if(empty($this->request->params['isAjax']) ): ?>	
                </div>    
            </div>	
		<?php endif; ?>
