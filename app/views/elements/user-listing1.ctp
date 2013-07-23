<?php
echo $this->requestAction(array('controller' => 'users', 'action' => 'listing1',$userIdbase64decode), array('named'=>array('admin'=>true),'return'));
?>