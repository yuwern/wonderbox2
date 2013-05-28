<div class="acc-left">
 	<div class="photo">
							<?php	
							$current_user_details = array(
								'username' => $this->Auth->user('username'),
								'user_type_id' =>  $this->Auth->user('user_type_id'),
								'id' =>  $this->Auth->user('id'),
								'fb_user_id' =>  $this->Auth->user('fb_user_id')
							); 
							$current_user_details['UserAvatar'] = $this->Html->getUserAvatar($this->Auth->user('id'));
							echo $this->Html->getUserAvatarLink($current_user_details, 'normal_thumb'); ?>
						</div>
                        <ul>
                       	<?php $class = ($this->request->params['controller'] == 'user_profiles' && $this->request->params['action'] == 'edit') ? ' class="active"' : null; ?>
						<li <?php echo $class;?>><?php echo $this->Html->link(__l('Account Info'), array('controller' => 'user_profiles', 'action' => 'edit',$this->Auth->user('id')),array('title' => __l('Account Info'))); ?></li>
						<?php $class = ($this->request->params['controller'] == 'user_shippings') ? ' class="active"' : null; ?>
						<li <?php echo $class;?>><?php echo $this->Html->link(__l('Shipping Info'), array('controller' => 'user_shippings', 'action' => 'index'),array('title' => __l('Shipping Info'))); ?></li>
						<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'profile_image') ? ' class="active"' : null; ?>
						 <li  <?php echo $class;?>><?php echo $this->Html->link(__l('Profile Image'), array('controller' => 'users', 'action' => 'profile_image', $this->Auth->user('id')), array('title' => 'My Profile Image')); ?></li>
						<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'change_password') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('Change Password'), array('controller' => 'users', 'action' => 'change_password'), array('title' => __l('Change password')));?></li>
						 <li class="bor"></li>
                      	<?php $class = ($this->request->params['controller'] == 'package_users' && $this->request->params['action'] == 'index') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('My Subscription'), array('controller' => 'package_users', 'action' => 'index'), array('title' => __l('My Subscription')));?></li>
	                  	<?php $class = ($this->request->params['controller'] == 'gift_users' && $this->request->params['action'] == 'mygift') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('My Gift Subscription'), array('controller' => 'gift_users', 'action' => 'mygift'), array('title' => __l('My Gift Subscription')));?></li>
						<?php $class = ($this->request->params['controller'] == 'transactions' && $this->request->params['action'] == 'index') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('My Transaction'), array('controller' => 'transactions', 'action' => 'index'), array('title' => __l('My Transaction')));?></li>
						<?php if(Configure::read('wonderpoint.is_system_enabled') && $this->Html->checkPackageAvialable()): ?>
						<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'redemption') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('My Subscription Redemption'), array('controller' => 'users', 'action' => 'redemption'), array('title' => __l('My Redemption')));?></li>
						<?php endif; ?>
						 <li class="bor"></li>
						  <?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'referral_points') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('My Referral Points'), array('controller' => 'users', 'action' => 'referral_points'), array('title' => __l('Referral Points')));?></li>
						 <?php $class = ($this->request->params['controller'] == 'beauty_profiles' && $this->request->params['action'] == 'my_beauty_profile') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('My Beauty Profile'), array('controller' => 'beauty_profiles', 'action' => 'my_beauty_profile'), array('title' => __l('My Beauty Profile')));?></li>
						<?php if($this->Html->checkUserActive($this->Auth->user('id'))): ?>			
						 <?php $class = ($this->request->params['controller'] == 'products' && ($this->request->params['action'] == 'survey' || $this->request->params['action'] == 'quiz')) ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('My Product Survey'), array('controller' => 'products', 'action' => 'survey'), array('title' => __l('My Product Survey')));?></li>
						<?php endif; ?>
						<?php $class = ($this->request->params['controller'] == 'product_redemptions' && ($this->request->params['action'] == 'index')) ? ' class="active"' : null; ?>
					    <li <?php echo $class;?>><?php echo $this->Html->link(__l('Products Redemption'), array('controller' => 'product_redemptions', 'action' => 'index'), array('title' => __l('Product Redemption')));?></li>
						<?php $class = ($this->request->params['controller'] == 'product_redemption_users' && ($this->request->params['action'] == 'index')) ? ' class="active"' : null; ?>
						<li  <?php echo $class;?>><?php echo $this->Html->link(__l('My Product Redemption'), array('controller' => 'product_redemption_users', 'action' => 'index'), array('title' => __l('Product Redemption List')));?></li>
					   </ul>
                  </div>