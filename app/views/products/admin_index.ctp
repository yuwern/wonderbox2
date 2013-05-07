	<?php 
		if(!empty($this->request->params['isAjax'])):
			echo $this->element('flash_message');
		endif;
	?>
	<div class="products index ">
<?php	if(empty($this->request->params['isAjax'])): ?>
<h2><?php echo __l('Products');?></h2>
  <div class="add-block">
      <?php echo $this->Html->link(__l('Add'),array('controller'=>'products','action'=>'add'),array('class' => 'add', 'title' => __l('Add New Category')));?>
   </div>
   <?php endif; ?>
	    <div class="js-response"> 
            <?php echo $this->Form->create('Product' , array('action' => 'update','class'=>'normal'));?>
            <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
            <?php echo $this->element('paging_counter');?>
<table class="list">
       <tr>	   <th class="dl"><?php echo __l('Select'); ?></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Action');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Name');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Category Name');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Brand Name');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Wonder point');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Active');?></div></th>
			 <th class="dl"><div class="js-pagination"><?php echo __l('Product clicked count');?></div></th>	
            </tr>
<?php
if (!empty($products)):

$i = 0;
foreach ($products as $product):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	if($product['Product']['is_active']):
           $status_class = 'js-checkbox-active';
     else:
           $status_class = 'js-checkbox-inactive';
	 endif;
?>
	<tr<?php echo $class;?>>
		    <td><?php  echo $this->Form->input('Product.'. $product['Product']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_". $product['Product']['id'],'label' => false , 'class' =>  $status_class.' js-checkbox-list'));   ?></td>
		<td><div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $product['Product']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $product['Product']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div><div class="actions"><?php echo $this->Html->link(__l('Chart'), array('action'=>'chart', $product['Product']['slug']), array('class' => 'chart js-edit', 'title' => __l('Chart')));?></div></td>
		<td> <?php echo $this->Html->showImage('Product',  $product['Attachment'][0], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['name'], false)), 'title' => $this->Html->cText($product['Product']['name'], false)));?> <?php echo $this->Html->cText($product['Product']['name']);?></td>
		<td><?php echo $this->Html->cText($product['Category']['name']);?></td>
		<td><?php echo $this->Html->cText($product['Brand']['name']);?></td>
		<td><?php echo $this->Html->cInt($product['Product']['wonder_point']);?></td>
		<td><?php echo $this->Html->cBool($product['Product']['is_active']);?></td>
		<td><?php echo $this->Html->cInt($product['Product']['product_view_count']);?></td>

	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="7"><p ><?php echo __l('No Products available');?></p></td>
	</tr>
<?php
endif;
?>
</table>
<?php if (!empty($products)): ?>
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
