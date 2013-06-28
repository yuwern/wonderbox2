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
						<li <?php echo $class;?>><?php echo $this->Html->link(__l('MY ACCOUNT'), array('controller' => 'user_profiles', 'action' => 'edit',$this->Auth->user('id')),array('title' => __l('MY ACCOUNT'))); ?></li>
						<?php $class = ($this->request->params['controller'] == 'user_shippings') ? ' class="active"' : null; ?>
						<li <?php echo $class;?>><?php echo $this->Html->link(__l('SHIPPING INFO'), array('controller' => 'user_shippings', 'action' => 'index'),array('title' => __l('SHIPPING INFO'))); ?></li>
						<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'profile_image') ? ' class="active"' : null; ?>
						 <li  <?php echo $class;?>><?php echo $this->Html->link(__l('PROFILE IMAGE'), array('controller' => 'users', 'action' => 'profile_image', $this->Auth->user('id')), array('title' => 'PROFILE IMAGE')); ?></li>
						<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'change_password') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('CHANGE PASSWORD'), array('controller' => 'users', 'action' => 'change_password'), array('title' => __l('CHANGE PASSWORD')));?></li>
						 <li class="bor"></li>
                      	<?php $class = ($this->request->params['controller'] == 'package_users' && $this->request->params['action'] == 'index') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('MY SUBSCRIPTION'), array('controller' => 'package_users', 'action' => 'index'), array('title' => __l('MY SUBSCRIPTION')));?></li>
	                  	<?php $class = ($this->request->params['controller'] == 'gift_users' && $this->request->params['action'] == 'mygift') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('MY GIFT SUBSCRIPTION'), array('controller' => 'gift_users', 'action' => 'mygift'), array('title' => __l('MY GIFT SUBSCRIPTION')));?></li>
						<?php $class = ($this->request->params['controller'] == 'transactions' && $this->request->params['action'] == 'index') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('MY TRANSACTION'), array('controller' => 'transactions', 'action' => 'index'), array('title' => __l('MY TRANSACTION')));?></li>
						<?php if(Configure::read('wonderpoint.is_system_enabled') && $this->Html->checkPackageAvialable()): ?>
						<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'redemption') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('WONDERPOINTS SUBSCRIPTION REDEMPTION'), array('controller' => 'users', 'action' => 'redemption'), array('title' => __l('WONDERPOINTS SUBSCRIPTION REDEMPTION')));?></li>
						<?php endif; ?>
						 <li class="bor"></li>
						  <?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'referral_points') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('MY WONDERPOINTS'), array('controller' => 'users', 'action' => 'referral_points'), array('title' => __l('MY WONDERPOINTS')));?></li>
						 <?php $class = ($this->request->params['controller'] == 'beauty_profiles' && $this->request->params['action'] == 'my_beauty_profile') ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('MY BEAUTY PROFILE'), array('controller' => 'beauty_profiles', 'action' => 'my_beauty_profile'), array('title' => __l('MY BEAUTY PROFILE')));?></li>
						<?php if($this->Html->checkUserActive($this->Auth->user('id'))): ?>			
						 <?php $class = ($this->request->params['controller'] == 'products' && ($this->request->params['action'] == 'survey' || $this->request->params['action'] == 'quiz')) ? ' class="active"' : null; ?>
                        <li <?php echo $class;?>><?php echo $this->Html->link(__l('MY PRODUCT SURVEY'), array('controller' => 'products', 'action' => 'survey'), array('title' => __l('MY PRODUCT SURVEY')));?></li>
						<?php endif; ?>
						<?php $class = ($this->request->params['controller'] == 'product_redemptions' && ($this->request->params['action'] == 'index')) ? ' class="active"' : null; ?>
					    <li <?php echo $class;?>><?php echo $this->Html->link(__l('WONDERSHOP'), array('controller' => 'product_redemptions', 'action' => 'index'), array('title' => __l('WONDERSHOP')));?></li>
						<?php $class = ($this->request->params['controller'] == 'product_redemption_users' && ($this->request->params['action'] == 'index')) ? ' class="active"' : null; ?>
						<li  <?php echo $class;?>><?php echo $this->Html->link(__l('WONDERSHOP PURCHASED LIST'), array('controller' => 'product_redemption_users', 'action' => 'index'), array('title' => __l('WONDERSHOP PURCHASED LIST')));?></li>
						<?php $class = ($this->request->params['controller'] == 'wonder_treats' && ($this->request->params['action'] == 'index')) ? ' class="active"' : null; ?>
						<li  <?php echo $class;?>><?php echo $this->Html->link(__l('MY WONDERTREATS'), array('controller' => 'wonder_treats', 'action' => 'index'), array('title' => __l('MY WONDERTREATS')));?></li>
					   </ul>
                  </div>