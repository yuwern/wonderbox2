<?php /* SVN: $Id: $ */ ?>

<div class="wonderSprees view">
<h2><?php echo __l('Wonder Spree');?></h2>
	<table>
		<tr>
		<td><?php echo __('User name'); ?></td>
		<td><?php echo $wonderSpree['User']['email']; ?></td>
		</tr>
		<tr>
		<td><?php echo __('Purchase Amount'); ?>&nbsp;&nbsp;</td>
		<td><?php echo $wonderSpree['WonderSpree']['purchase_amt']; ?></td>
		</tr>
		<tr>
		<td><?php echo __('Type'); ?></td>
		<td><?php echo $wonderSpree['WonderSpree']['type']; ?></td>
		</tr>
		<tr>
		<td><?php echo __('Brands'); ?>&nbsp;&nbsp;</td>
		<?php $brand_names= array();
		   foreach ($wonderSpree['Brand'] as $brand){
		   $brand_names[]=$brand['name'];
		   }
		?>
		<td><?php echo implode(",", $brand_names);?></td>
		</tr>
		<tr>
		<td><?php echo __('Categories'); ?>&nbsp;&nbsp;</td>
		<?php $category_names= array();
		   foreach ($wonderSpree['Category'] as $category){
		   $category_names[]=$category['name'];
		   }
		?>
		<td><?php echo implode(",", $category_names);?></td>
		</tr>
		<tr>
		<td><?php echo __('Location'); ?>&nbsp;&nbsp;</td>
		<td><?php echo $wonderSpree['WonderSpree']['location']; ?></td>
		</tr>
		<tr>
		<td><?php echo __('Image'); ?></td>
						<?php $image_options = array(
					'dimension' => 'original',
					'width'=>'auto',
					'height'=>'auto',
				);
		 $large_image_url = $this->Html->url($this->Html->getImageUrl('Event', empty($wonderSpree['Attachment']['filename'])?'':$wonderSpree['Attachment'], $image_options));?>
		 <td><a href='<?php echo $large_image_url;?>' class="js-thickbox">
		 <?php echo $this->Html->showImage('WonderSpree',  empty($wonderSpree['Attachment']['filename'])?'':$wonderSpree['Attachment'], array('dimension' => 'medium_thumb'));?></a></td>
		</tr>
		
		
		<tr>
		<td><?php 
		if ($wonderSpree['WonderSpree']['is_active']== false)
		{
		echo $this->Html->link(__l('Approve'), array('controller' => 'wonder_sprees', 'action'=>'add_wonderpoint', $wonderSpree['WonderSpree']['id']), array('class' => 'add-fund'));
		}
		?></td>
		</tr>
		
	</table>
</div>



