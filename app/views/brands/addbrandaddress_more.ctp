<div id="js-brand-<?php echo $i+1; ?>">
	<h3 style="padding-left:10px;"> <?php echo __l('Retail Outlet'); ?> <?php echo $i+1; ?> </h3>
	<?php
				echo $this->Form->input('BrandAddress.'.$i.'.location',array('type'=> 'textarea','label'=>__l('Retail Outlet'),'div'=>'input textarea required'));
				echo $this->Form->input('Attachment.'.$i.'.filename', array('type' => 'file', 'label' => __l('Company Image'),'class'=>'required','div'=>'input file required','info'=>__('Image size for ex. 166 X 37')));		
				echo $this->Form->input('BrandAddress.'.$i.'.telephone_no', array('label'=>__l('Telephone Number')));
				echo $this->Form->input('BrandAddress.'.$i.'.fax_no', array('label'=> __l('Fax Number')));
				echo $this->Form->input('BrandAddress.'.$i.'.email', array('label'=> __l('Email')));
				echo $this->Form->input('BrandAddress.'.$i.'.website_url', array('label'=> __l('Website URL')));
		?>
</div>
