<?php /* SVN: $Id: $ */ ?>
<?php echo $this->element('js_tiny_mce_setting', array('cache' => array('config' => 'site_element_cache')));?>
<div class="brands form">
<?php echo $this->Form->create('Brand', array('class' => 'normal','enctype' => 'multipart/form-data'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Brands'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Add Brand');?></legend>
	<?php
		echo $this->Form->input('name',array('div'=>'input text required'));
		echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('Upload Image'),'class'=>'required','div'=>'input file required','info'=>__('Image size should be 100 X 100')));
		echo $this->Form->input('short_description', array('label' => __l('Short Description'),'type' =>'textarea', 'class' => 'js-editor','div'=>'input text required'));
		echo $this->Form->input('description', array('label' => __l('Description'),'type' =>'textarea', 'class' => 'js-editor','div'=>'input text required'));
		?>
		<div class="js-brand-content">
		<?php if(!empty($this->request->data['BrandAddress'])):
				foreach($this->request->data['BrandAddress'] as $key => $address):?>
				<h3 style="padding-left:10px;"> <?php echo __l('Retail Outlet'); ?> <?php echo ($key +1); ?> </h3>
				<?php echo $this->Form->input('BrandAddress.'.$key.'.location',array('type'=> 'textarea','label'=>__l('Retail Outlet'),'div'=>'input textarea required'));
				 echo $this->Form->input('BrandAddress.'.$key.'.telephone_no', array('label'=> __l('Telephone Number')));
				 echo $this->Form->input('BrandAddress.'.$key.'.fax_no', array('label'=> __l('Fax Number')));
				 echo $this->Form->input('BrandAddress.'.$key.'.email', array('label'=> __l('Email'),'div'=>'input text required'));
				endforeach;
					$count = count($this->request->data['BrandAddress']);
			else:?>
			<h3 style="padding-left:10px;"> <?php echo __l('Retail Outlet'); ?> <?php echo 1; ?> </h3>
			<?php	echo $this->Form->input('BrandAddress.0.location',array('type'=> 'textarea','label'=>__l('Retail Outlet'),'div'=>'input textarea required'));
				echo $this->Form->input('BrandAddress.0.telephone_no', array('label'=>__l('Telephone Number')));
				echo $this->Form->input('BrandAddress.0.fax_no', array('label'=> __l('Fax Number')));
				echo $this->Form->input('BrandAddress.0.email', array('label'=>__l('Email')));
				$count = 1;
		endif; 
		?>
		</div>
		<div class="f-right"><a href="#" class="add js-add-more-brand" title="Add More">Add More</a><a href="#" class="delete js-brand-delete" title="Delete">Delete</a></div>
		<div class="hide"><?php echo $this->Form->input('brandaddress_count',array('value'=> $count,'type'=>'text','class'=>'js-brand-count'));?> </div>
		<?php 
		echo $this->Form->input('facebook_url',array('label'=>__l('Facebook URL'),'div'=>'input text required'));
		echo $this->Form->input('web_url',array('label'=>__l('Website URL'),'div'=>'input text required'));
		echo $this->Form->input('beauty_tip_url',array('label'=>__l('Beauty Tip URL'),'div'=>'input text required'));
		echo $this->Form->input('promotion_url',array('label'=>__l('Promotion URL'),'div'=>'input text required'));
		echo $this->Form->input('is_active',array('type'=>'checkbox'));
	?>
	</fieldset>
		<div class="submit-block">
		<?php echo $this->Form->submit(__l('Add'));?>
		</div>
		<?php echo $this->Form->end(); ?>
</div>