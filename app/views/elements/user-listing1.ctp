
<?php
echo $this->requestAction(array('controller' => 'users', 'action' => 'listing1',$conditions1), array('named'=>array('admin'=>true),'return'));
?>