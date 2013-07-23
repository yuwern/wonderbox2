<?php
echo $this->requestAction(array('controller' => 'users', 'action' => 'listing',$conditions1, $conditions2), array('named'=>array('admin'=>true),'return'));
?>