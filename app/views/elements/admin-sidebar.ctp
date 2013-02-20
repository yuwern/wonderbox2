<ul class="admin-links">
	<li class="no-bor">
		<ul class="admin-sub-links">
		<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_stats') ? ' class="active"' : null; ?>
		<li <?php echo $class;?>><?php echo $this->Html->link(__l('Site Stats'), array('controller' => 'users', 'action' => 'stats'),array('title' => __l('Site Stats'))); ?></li>			<?php $class = (($this->request->params['controller'] == 'user_profiles' && $this->request->params['action'] != 'admin_chart' )||  ($this->request->params['controller'] == 'users'  && ($this->request->params['action'] == 'admin_index' || $this->request->params['action'] == 'change_password' || $this->request->params['action'] == 'admin_add' )) ) ? ' class="active"' : null; ?>            
		<li <?php echo $class;?>><?php echo $this->Html->link(__l('Users'), array('controller' => 'users', 'action' => 'index'),array('title' => __l('Users'))); ?></li>
		  <?php $class = ($this->request->params['controller'] == 'package_users' && ($this->request->params['action'] == 'admin_index' ||$this->request->params['action'] == 'admin_import' )) ? ' class="active"' : null; 
		  ?>
		<li <?php echo $class;?>><?php echo $this->Html->link(__l('List of active users'), array('controller' => 'package_users', 'action' => 'admin_index'),array('title' => __l('List of active users'))); ?></li>
		  <?php $class = ($this->request->params['controller'] == 'gift_users' && $this->request->params['action'] == 'admin_index') ? ' class="active"' : null; 
		  ?>
		<li <?php echo $class;?>><?php echo $this->Html->link(__l('Gift users'), array('controller' => 'gift_users', 'action' => 'admin_index'),array('title' => __l('Gift users'))); ?></li>
		  <?php $class = ($this->request->params['controller'] == 'subscriptions' && $this->request->params['action'] == 'index') ? ' class="active"' : null; ?>
		<li <?php echo $class;?>><?php echo $this->Html->link(__l('Subscriptions'), array('controller' => 'subscriptions', 'action' => 'index'),array('title' => __l('Subscriptions'))); ?></li>
			<?php $class = ($this->request->params['controller'] == 'categories') ? ' class="active"' : null; ?>
			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Categories'), array('controller' => 'categories', 'action' => 'index'),array('title' => __l('Categories'))); ?></li>
			<?php $class = ($this->request->params['controller'] == 'brands') ? ' class="active"' : null; ?>
			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Brands'), array('controller' => 'brands', 'action' => 'index'),array('title' => __l('Brands'))); ?></li>
			<?php $class = ($this->request->params['controller'] == 'products') ? ' class="active"' : null; ?>
			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Products'), array('controller' => 'products', 'action' => 'index'),array('title' => __l('Products'))); ?></li>
			<?php $class = ($this->request->params['controller'] == 'product_redeems') ? ' class="active"' : null; ?>
			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Product Redeems'), array('controller' => 'product_redeems', 'action' => 'index'),array('title' => __l('Product Redeems'))); ?></li>
			<?php $class = ($this->request->params['controller'] == 'beauty_categories' || $this->request->params['controller'] == 'user_profiles' && $this->request->params['action'] == 'admin_chart' || $this->request->params['controller'] == 'user_shippings' && $this->request->params['action'] == 'admin_chart' ) ? ' class="active"' : null;
			?>
			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Beauty and Demographic categories'), array('controller' => 'beauty_categories', 'action' => 'index'),array('title' => __l('Beauty and Demographic categories'))); ?></li>
			<?php $class = ($this->request->params['controller'] == 'settings') ? ' class="active"' : null; ?>
			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Settings'), array('controller' => 'settings', 'action' => 'index'),array('title' => __l('Settings'))); ?></li>
			<?php $class = ($this->request->params['controller'] == 'email_templates') ? ' class="active"' : null; ?>
			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Email Templates'), array('controller' => 'email_templates', 'action' => 'index'),array('title' => __l('Email Templates'))); ?></li>
			<?php $class = ($this->request->params['controller'] == 'pages') ? ' class="active"' : null; ?>
            <li <?php echo $class;?>><?php echo $this->Html->link(__l('Manage Static Pages'), array('controller' => 'pages', 'action' => 'index', 'plugin' => NULL),array('title' => __l('Manage Static Pages')));?></li>			
			<?php $class = ($this->request->params['controller'] == 'home_page_banners') ? ' class="active"' : null; ?>
            <li <?php echo $class;?>><?php echo $this->Html->link(__l('Home Page Banner'), array('controller' => 'home_page_banners', 'action' => 'index'),array('title' => __l('Home Page Banner')));?></li>
			<?php $class = ($this->request->params['controller'] == 'home_page_organizers') ? ' class="active"' : null; ?>
            <li <?php echo $class;?>><?php echo $this->Html->link(__l('Home Page Organizers'), array('controller' => 'home_page_organizers', 'action' => 'index'),array('title' => __l('Home Page Organizers')));?></li>
			<?php $class = ($this->request->params['controller'] == 'payment_gateways') ? ' class="active"' : null; ?>
            <li <?php echo $class;?>><?php echo $this->Html->link(__l('Payment Gateways'), array('controller' => 'payment_gateways', 'action' => 'index'),array('title' => __l('Payment Gateways')));?></li>
			<?php $class = ($this->request->params['controller'] == 'packages') ? ' class="active"' : null; ?>
            <li <?php echo $class;?>><?php echo $this->Html->link(__l('Subscription packages'), array('controller' => 'packages', 'action' => 'index'),array('title' => __l('Subscription packages')));?></li>
				<?php $class = ($this->request->params['controller'] == 'transactions') ? ' class="active"' : null; ?>
            <li <?php echo $class;?>><?php echo $this->Html->link(__l('Transactions'), array('controller' => 'transactions', 'action' => 'index'),array('title' => __l('Transactions')));?></li>
			<?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'update_cron') ? ' class="active"' : null; ?>
            <li <?php echo $class;?>><?php echo $this->Html->link(__l('Run Cron manually'), array('controller' => 'users', 'action' => 'update_cron'),array('title' => __l('Run Cron manually')));?></li>
			<?php $class = ($this->request->params['controller'] == 'languages') ? ' class="active"' : null; ?>
			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Languages'), array('controller' => 'languages', 'action' => 'index'),array('title' => __l('Languages'))); ?></li>
			<?php $class = ($this->request->params['controller'] == 'cities') ? ' class="active"' : null; ?>
			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Cities'), array('controller' => 'cities', 'action' => 'index'),array('title' => __l('Cities'))); ?></li>
			<?php $class = ($this->request->params['controller'] == 'states') ? ' class="active"' : null; ?>
			<li <?php echo $class;?>><?php echo $this->Html->link(__l('States'), array('controller' => 'states', 'action' => 'index'),array('title' => __l('States'))); ?></li>
			<?php $class = ($this->request->params['controller'] == 'countries') ? ' class="active"' : null; ?>
			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Countries'), array('controller' => 'countries', 'action' => 'index'),array('title' => __l('Countries'))); ?></li>
			<?php $class = ($this->request->params['controller'] == 'paypal_transaction_logs') ? ' class="active"' : null; ?>
			<li <?php echo $class;?>><?php echo $this->Html->link(__l('Paypal Transaction logs'), array('controller' => 'paypal_transaction_logs', 'action' => 'index'),array('title' => __l('Paypal Transaction logs'))); ?></li>
        </ul>
	</li>
   
</ul>
