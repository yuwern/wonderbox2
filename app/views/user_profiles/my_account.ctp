<div class="js-tabs">
	<ul class="clearfix">
		<li><?php echo $this->Html->link(__l('My Profile'), array('controller' => 'user_profiles', 'action' => 'edit', $user_id, 'admin' => true), array('title' => 'My Profile', 'rel'=> '#Request_API_Key')); ?></li>


			<li><?php  echo $this->Html->link(__l('Change Password'),array('controller'=> 'users', 'action'=>'change_password'),array('title' => 'Change Password', 'rel' => '#Change_Password')); ?></li>

	</ul>
</div>