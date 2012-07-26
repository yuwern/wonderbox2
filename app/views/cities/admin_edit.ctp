<?php /* SVN: $Id: admin_edit.ctp 59862 2011-07-11 09:47:46Z arovindhan_144at11 $ */ ?>
<div class="cities form">
	<div>
		<h2><?php echo __l('Edit City - ').$this->Html->cText($this->request->data['City']['name'], false); ?></h2>
	</div>
	<div>
	<?php
		echo $this->Form->create('City', array('class' => 'normal','action'=>'edit','enctype' => 'multipart/form-data'));
		echo $this->Form->input('id');
   ?>
   <?php
		if (!empty($id_default_city)) {
			echo $this->Form->input('name',array('label' => __l('Name'), 'readonly' => true, 'info' => __l('You can not change default city name.')));
		} else {
			echo $this->Form->input('name',array('label' => __l('Name')));
		}
		echo $this->Form->input('country_id', array('label' => __l('Country'), 'empty' => __l('Please Select')));
		echo $this->Form->input('state_id', array('label' => __l('State'), 'empty' => __l('Please Select')));
		echo $this->Form->input('language_id', array('label' => __l('Default Language'),'empty'=> __l('Please Select'),'info' => __l('select the default language for this city. If not selected, Site default language will be set.')));
		echo $this->Form->input('latitude',array('label' => __l('Latitude')));
		echo $this->Form->input('longitude',array('label' => __l('Longitude')));
		echo $this->Form->input('code',array('label' => __l('Code')));
		echo $this->Form->input('slug', array('type' => 'hidden'));
	?>
	  
	   	</div>
	<div class="submit-block">
		<?php echo $this->Form->submit(__l('Update'));	?>
	</div>
	<?php echo $this->Form->end(); ?>
	</div>
</div>
