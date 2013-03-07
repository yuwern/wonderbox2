<?php
if (!empty($homePageOrganizer)):
	 echo $this->Html->link($this->Html->showImage('HomePageOrganizer', (!empty($homePageOrganizer['Attachment']) ? $homePageOrganizer['Attachment'] : ''), array('dimension' => 'small_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($homePageOrganizer['HomePageOrganizer']['title'], false)), 'title' => $this->Html->cText($homePageOrganizer['HomePageOrganizer']['title'], false))), array('controller' => 'home_page_organizers', 'action' => 'previous_month','admin'=>false),array('title' =>sprintf(__l('%s'),$homePageOrganizer['HomePageOrganizer']['title']), 'escape' => false));
else:
 echo __l('No Home Page Organizers available');	
endif;
?>