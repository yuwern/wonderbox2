<?php $i  = $i + 1; ?>
<div class="p-bor round-10"  id="js-product-<?php echo $i; ?>">
			<h1 class="p-left"><?php echo __l('Product').' '.($i + 1) ; ?> </h1>
			<?php
				echo $this->Form->input('RelatedProduct.'.$i.'.name',array('label'=>__l('Name')));
				echo $this->Form->input('Attachment.'.$i.'.filename', array('type' => 'file', 'label' => __l('Product Image'),'class'=>'required','div'=>'input file required'));
				echo $this->Form->input('RelatedProduct.'.$i.'.category_id',array('options'=>$categories));
				echo $this->Form->input('RelatedProduct.'.$i.'.brand_id',array('options'=>$brands));
				echo $this->Form->input('RelatedProduct.'.$i.'.description', array('label' => __l('Description'),'type' =>'textarea', 'class' => 'js-editor'));
				echo $this->Form->input('RelatedProduct.'.$i.'.price'); ?>
</div>
		
		