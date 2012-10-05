<?php
echo $this->requestAction(array('controller' => 'products', 'action' => 'index'), array('brand_id'=>$brand_id,'type'=>'product-lists', 'return'));
?>