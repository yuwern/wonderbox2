<?php
if (!empty($homePageOrganizer)):
	 echo $this->Html->showImage('HomePageOrganizer', (!empty($homePageOrganizer['Attachment']) ? $homePageOrganizer['Attachment'] : ''), array('dimension' => 'small_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($homePageOrganizer['HomePageOrganizer']['title'], false)), 'title' => $this->Html->cText($homePageOrganizer['HomePageOrganizer']['title'], false)));
else:
 echo __l('No Home Page Organizers available');	
endif;
?>