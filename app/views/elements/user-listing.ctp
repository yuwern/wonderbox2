<?php
echo $this->requestAction(array('controller' => 'users', 'action' => 'listing',$userIdbase64decode), array('named'=>array('admin'=>true),'return'));
?>