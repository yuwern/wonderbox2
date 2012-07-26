<div class="js-mystuff-tabs">
    <ul class="clearfix">
           <li><?php echo $this->Html->link(__l('My Account'), array('controller' => 'user_profiles', 'action' => 'my_account', $this->Auth->user('id')), array('title' => 'My Account', 'rel' => 'address:/' . __l('My_Account'))); ?></li>
		   
           <li><?php echo $this->Html->link(__l('My Profile Image'), array('controller' => 'users', 'action' => 'profile_image', $this->Auth->user('id')), array('title' => 'My Profile Image', 'rel' => 'profile_image:/' . __l('My Profile Image'))); ?></li>
     

    </ul>
</div>