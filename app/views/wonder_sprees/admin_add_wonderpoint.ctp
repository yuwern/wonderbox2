<?php /* SVN: $Id: admin_add.ctp 54285 2011-05-23 10:16:38Z aravindan_111act10 $ */ ?>
<div class="users form">
	<h2> <?php echo __l('Add WonderPoint');?></h2>
<?php echo $this->Form->create('WonderSpree', array('action'=>'add_wonderpoint/'.$this->params['pass'][0],'class' => 'normal'));?>
	<fieldset>
 	<?php
        echo $this->Form->input('id');
		echo $this->Form->input('transaction_type',array('label' => __l('Transaction Type'),'empty'=>__l('Please Select'),'options'=> array(
			//ConstTransactionTypes::ShareExperience  => __l('Experience shared'),
			//ConstTransactionTypes::ProductDamage  => __l('Product damage'),
			//ConstTransactionTypes::Refund  => 'Refund',
			//ConstTransactionTypes::ExperiencePhoto  => 'Experienced shared Picture',
			//ConstTransactionTypes::ExperienceBlog  => 'Experienced shared Blog',
			//ConstTransactionTypes::ExperienceVideo  =>'Experienced shared video'
			ConstTransactionTypes::ExperienceRetail  =>__l('Experienc share Retail')
		)));
		echo $this->Form->input('available_wonder_points',array('label' => __l('Wonder Point')));

	?>
	</fieldset>
<div class="submit-block clearfix">
    <?php echo $this->Form->submit(__l('Add'));?>
    </div>
    <?php echo $this->Form->end();?>
</div>