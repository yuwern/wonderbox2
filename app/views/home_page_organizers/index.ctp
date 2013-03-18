<?php
if (!empty($homePageOrganizer)):
	 echo $this->Html->link($this->Html->image('ad.jpg'), array('controller' => 'home_page_organizers', 'action' => 'previous_month','admin'=>false),array('title' =>sprintf(__l('%s'),$homePageOrganizer['HomePageOrganizer']['title']), 'escape' => false));
else:
 echo __l('No Home Page Organizers available');	
endif;
?>