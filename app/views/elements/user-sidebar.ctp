<div class="my-account-left">
                	<ul class="my-account-Rnav">
						<?php $class = ($this->request->params['controller'] == 'user_profiles' && $this->request->params['action'] == 'edit') ? ' class="active"' : null; ?>
						<li <?php echo $class;?>><?php echo $this->Html->link(__l('Account Info'), array('controller' => 'user_profiles', 'action' => 'edit',$this->Auth->user('id')),array('title' => __l('Account Info'))); ?></li>
						<?php $class = ($this->request->params['controller'] == 'user_shippings') ? ' class="active"' : null; ?>
						<li <?php echo $class;?>><?php echo $this->Html->link(__l('Shipping Info'), array('controller' => 'user_shippings', 'action' => 'index'),array('title' => __l('Shipping Info'))); ?></li>
						<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'profile_image') ? ' class="active"' : null; ?>
						 <li  <?php echo $class;?>><?php echo $this->Html->link(__l('My Profile Image'), array('controller' => 'users', 'action' => 'profile_image', $this->Auth->user('id')), array('title' => 'My Profile Image')); ?></li>
						<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'change_password') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('Change Password'), array('controller' => 'users', 'action' => 'change_password'), array('title' => __l('Change password')));?></li>
						 <li class="bor"></li>
                      	<?php $class = ($this->request->params['controller'] == 'package_users' && $this->request->params['action'] == 'index') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('My Subscription'), array('controller' => 'package_users', 'action' => 'index'), array('title' => __l('My Subscription')));?></li>
						<?php $class = ($this->request->params['controller'] == 'transactions' && $this->request->params['action'] == 'index') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('My Transaction'), array('controller' => 'transactions', 'action' => 'index'), array('title' => __l('My Transaction')));?></li>
						<?php if(Configure::read('wonderpoint.is_system_enabled')): ?>
						<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'redemption') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('My Redemption'), array('controller' => 'users', 'action' => 'redemption'), array('title' => __l('My Redemption')));?></li>
						<?php endif; ?>
						 <li class="bor"></li>
						 <?php $class = ($this->request->params['controller'] == 'beauty_profiles' && $this->request->params['action'] == 'my_beauty_profile') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('My Beauty Profile'), array('controller' => 'beauty_profiles', 'action' => 'my_beauty_profile'), array('title' => __l('My Beauty Profile')));?></li>
                    </ul>
 </div>
            	