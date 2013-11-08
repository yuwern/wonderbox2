<?php echo "user listing";?>
<?php
      echo $this->requestAction(array('controller' => 'users', 'action' => 'listing', $conditions1), array('named'=>array('admin'=>true),'return'));
?>