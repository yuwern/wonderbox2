<?php /* SVN: $Id: $ */ ?>
<?php echo $this->element('js_tiny_mce_setting', array('cache' => array('config' => 'site_element_cache')));?>
<div class="brands form">
<?php echo $this->Form->create('Brand', array('class' => 'normal','enctype' => 'multipart/form-data'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Brands'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Edit Brand');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('div'=>'input text required'));
		echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('Upload Image'),'class'=>'required','div'=>'input file' ,'info'=>__('Image size for ex. 150 X 150, 200 X 200')));
		echo $this->Form->input('short_description', array('label' => __l('Short Description'),'type' =>'textarea', 'class' => 'js-editor','div'=>'input text required'));
		echo $this->Form->input('description', array('label' => __l('Description'),'type' =>'textarea', 'class' => 'js-editor' ,'div'=>'input text required'));
		?>
		<?php echo $this->Html->link(__l('Add Retail Address'), array('controller'=>'brand_addresses','action'=>'add', $this->request->data['Brand']['id']), array('class' => 'add', 'title' => __l('Add Product')));?>
	<br/>
	<?php if(!empty($this->request->data['BrandAddress'])): ?>
		<ul>
		<?php 	foreach($this->request->data['BrandAddress'] as $brandAddress): ?>
			<li style="float:left;padding:5px;border:1px solid #DE006D;margin:3px;">
			<?php if(!empty($brandAddress['Attachment'][0])):
			      echo $this->Html->showImage('BrandAddress',  $brandAddress['Attachment'][0], array('dimension' => 'retaillogo_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($brandAddress['location'], false)), 'title' => $this->Html->cText($brandAddress['location'], false))); 
				  else:
					echo $this->Html->image('retail_img4.jpg');
				  endif;
			   
			   ?>
			<div style="padding-left:3px;">	<?php echo $this->Html->truncate($brandAddress['location'],20, array('ending' => '...')); ?></div>
			<div class="actions"><?php echo $this->Html->link(__l('Edit'), array('controller'=>'brand_addresses','action'=>'edit', $brandAddress['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?><?php echo $this->Html->link(__l('Delete'), array('controller'=>'brand_addresses','action'=>'delete',$brandAddress['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
			</li>
		<?php endforeach;  ?>
		</ul>
	<?php endif; ?>
	<div class="clearfix"></div>
		<?php 
		echo $this->Form->input('facebook_url',array('label'=>__l('Facebook URL'),'div'=>'input text required'));
		echo $this->Form->input('web_url',array('label'=>__l('Website URL'),'div'=>'input text required'));
		echo $this->Form->input('beauty_tip_url',array('label'=>__l('Beauty Tip URL'),'div'=>'input text required'));
		echo $this->Form->input('promotion_url',array('label'=>__l('Promotion URL'),'div'=>'input text required'));
		echo $this->Form->input('youtube_url',array('label'=>__l('Youtube URL'),'div'=>'input text required'));
		echo $this->Form->input('is_active',array('type'=>'checkbox'));
	?>
	</fieldset>
	<div class="submit-block">
		<?php echo $this->Form->submit(__l('Update'));?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>