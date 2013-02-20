<?php
/* SVN FILE: $Id: default.ctp 59854 2011-07-11 09:23:11Z mohanraj_109at09 $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7805 $
 * @modifiedby    $LastChangedBy: AD7six $
 * @lastmodified  $Date: 2008-10-30 23:00:26 +0530 (Thu, 30 Oct 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<?php echo $this->Html->charset(), "\n";?>
	<title><?php echo Configure::read('site.name');?> | <?php echo $this->Html->cText($title_for_layout, false);?></title>
	<?php
		echo $this->Html->meta('icon'), "\n";
		echo $this->Html->meta('keywords', $meta_for_layout['keywords']), "\n";
		echo $this->Html->meta('description', $meta_for_layout['description']), "\n";
	?>
	<?php 	require_once('_head.inc.ctp');
    		echo $this->Asset->scripts_for_layout();

	?><!--
	<meta content="111586242311802" property="og:app_id" />
	<meta content="111586242311802" property="fb:app_id" />
	<meta property="og:image" content="http://192.9.200.11/wonderbox/img/blue-theme/logo-email.png"/>
	-->
</head>
<body>
    <!-- Header & Body Div -->
	<div class="main">
    	<div class="container" >
        	<div class="header">
				<div class="global_link">
				<?php $date_left = $this->Html->dateDiff(date('y-m-d',strtotime('now')),date('y-m-d',mktime(0, 0, 0,Configure::read('header.month'), 15,  Configure::read('header.year'))));
				$current_month = date('m',strtotime('now'));
				$current_date = date('d',strtotime('now'));
				$current_year = date('Y',strtotime('now'));
				$total_days_month = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year );
				if($current_date>=15)
					$duration_month = 2;
				else
					$duration_month = 1;
				$months = $this->Html->getMonthLists();
				?>
			  	<div class="c1"><strong><?php echo __l('Available units on'); ?> <?php echo $months[Configure::read('header.month')];  ?> :</strong> <span><strong><?php echo
				$this->Html->checkPackageAvialable();?> <?php echo __l('units'); ?></strong></span> <i><?php echo __l('Running Fast'); ?></i></div>
				<?php
					if ($this->Auth->sessionValid()):
						$current_user_details = array(
								'username' => $this->Auth->user('username'),
								'user_type_id' =>  $this->Auth->user('user_type_id'),
								'id' =>  $this->Auth->user('id'),
								'fb_user_id' =>  $this->Auth->user('fb_user_id')
							);                         
                    		$current_user_details['UserAvatar'] = $this->Html->getUserAvatar($this->Auth->user('id'));
    				?>
					<div class="c2">&nbsp;<?php //echo $this->Html->image('facebook_like.jpg',array('width'=>'95','height'=>'20')); ?></div>
					<!--<div class="c2"><div class="fb-like" data-href="<?php echo Router::url('/',true); ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div></div> -->
                   <div class="c3" id="chromemenu"><span class="f-left"><strong><?php echo __l('Hi'); ?></strong> </span><span class="f-left"><?php echo $this->Html->getUserAvatarLink($current_user_details, 'micro_thumb'); ?></span> <span class="f-left"><?php echo $this->Html->getUserLink($current_user_details,true); ?>&nbsp;| &nbsp; <?php echo $this->Html->link('<strong>'.__l('Logout').'</strong>', array('controller' => 'users', 'action' => 'logout'), array( 'title' => __l('Logout'),'escape'=>false)); ?>   </span>
					<div id="dropmenu1" class="dropmenudiv">
					
						  <?php if ($this->Auth->sessionValid()): ?>	<ul>
							<li><?php echo $this->Html->link(__l('My Account'), array('controller' => 'user_profiles', 'action' => 'edit',$this->Auth->user('id'), 'admin' => false), array('title' => __l('My Account')));?></li>
							<li><?php echo $this->Html->link(__l('Shipping Info'), array('controller' => 'user_shippings', 'action' => 'index'),array('title' => __l('Shipping Info'))); ?></li>
						    <li><?php echo $this->Html->link(__l('My Profile Image'), array('controller' => 'users', 'action' => 'profile_image', $this->Auth->user('id')), array('title' => 'My Profile Image')); ?></li>
				             <li><?php echo $this->Html->link(__l('Change Password'), array('controller' => 'users', 'action' => 'change_password'), array('title' => __l('Change password')));?></li>
							 <li><?php echo $this->Html->link(__l('My Subscription'), array('controller' => 'package_users', 'action' => 'index'), array('title' => __l('My Subscription')));?></li>
							 <li><?php echo $this->Html->link(__l('My Gift Subscription'), array('controller' => 'gift_users', 'action' => 'mygift'), array('title' => __l('My Gift Subscription')));?></li>
							 <li><?php echo $this->Html->link(__l('My Transaction'), array('controller' => 'transactions', 'action' => 'index'), array('title' => __l('My Transaction')));?></li>
							 <?php if(Configure::read('wonderpoint.is_system_enabled') && $this->Html->checkPackageAvialable()): ?>
							 <li><?php echo $this->Html->link(__l('My Redemption'), array('controller' => 'users', 'action' => 'redemption'), array('title' => __l('My Redemption')));?></li>
							<?php endif; ?>
							<li><?php echo $this->Html->link(__l('My Beauty Profile'), array('controller' => 'beauty_profiles', 'action' => 'my_beauty_profile'), array('title' => __l('My Beauty Profile')));?></li>
							<?php if($this->Html->checkUserActive($this->Auth->user('id'))): ?>
							<li><?php echo $this->Html->link(__l('My Product Survey'), array('controller' => 'products', 'action' => 'survey'), array('title' => __l('My Product Survey')));?></li>		
							<li><?php echo $this->Html->link(__l('Product Redemption'), array('controller' => 'products', 'action' => 'product_redeem'), array('title' => __l('Product Redemption')));?></li>
							<?php endif; ?></ul>
							<?php endif; ?>
						</div>
                        <script type="text/javascript">cssdropdown.startchrome("chromemenu")</script>
                    </div>
					<div class="c4"> 
					<?php echo __l('WonderPoints :'); ?> <span><?php echo $this->Html->getWonderPointAvialable($current_user_details['id']);?></span></div>
					<?php if($this->Auth->sessionValid() && $this->Auth->user('user_type_id') == ConstUserTypes::Admin): ?>
					<div class="c5"><?php echo $this->Html->link(__l('Admin panel'), array('controller' => 'users' , 'action' => 'stats' , 'admin' => true), array('title' => __l('Admin panel'), 'escape' => false)); ?></div> 
					<?php endif; ?>
					<?php else: ?>
					   <div class="c3"><?php echo $this->Html->link('<strong>'.__l('Login').'</strong>', array('controller' => 'users', 'action' => 'login'), array('title' => __l('Login'),'escape'=>false));?> | <?php echo $this->Html->link('<strong>'.__l('Register').'</strong>', array('controller' => 'users', 'action' => 'register', 'admin' => false), array('title' => __l('Register'),'escape'=>false));?>  <?php if(Configure::read('facebook.is_enabled_facebook_connect') && !empty($fb_login_url)):  ?> |
						<?php echo $this->Html->link(__l('Facebook Login'), array('controller' => 'users', 'action' => 'login','type'=>'facebook'), array('title' => __l('Facebook Login'),'class'=>'f-login', 'escape' => false)); ?>
					 <?php endif; ?></div>

					<?php endif; ?>
					<div class="clear"></div>
                </div>
				
                <!-- Logo & Nav Sec  -->
   		    	<div class="logo_sec">
				<div class="logo">	
					<?php echo $this->Html->link($this->Html->image('logo.jpg'), array('controller' => 'pages', 'action' => 'home', 'admin' => false), array('title' => Configure::read('site.name'),'escape'=>false)); ?>
					</div>
			      <div class="nav">
                    	<ul>
						    <?php $active_class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'home' ) ?  'class="active"': null; ?>
                        	<li <?php echo $active_class; ?>> <?php echo $this->Html->link(__l('Home'), array('controller' => 'pages', 'action' => 'home', 'admin' => false), array('title' => __l('Home'),'class'=> 'home')); ?></li>
							<?php if (!$this->Auth->sessionValid()): ?>
                        	<?php $active_class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'register' ) ?  'class="active"': null; ?>
							<li <?php echo $active_class; ?>><?php echo $this->Html->link(__l('Join'), array('controller' => 'users', 'action' => 'register', 'admin' => false), array('title' => __l('Join'),'class'=>'join'));?></li>
							<?php endif; ?>
							<?php $active_class = ($this->request->params['controller'] == 'brands' && $this->request->params['action'] == 'index' ) ?  'class="active"': null; ?>
				            <li <?php echo $active_class; ?>><?php echo $this->Html->link(__l('Brands'), array('controller' => 'brands', 'action' => 'index', 'admin' => false), array('title' => __l('Brands'),'class'=> 'brands'));?></li>
							<?php $active_class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view'  && $this->request->params['pass'][0] == 'how_it_works') ?  'class="active"': null; ?>
                            <li <?php echo $active_class; ?>><?php echo $this->Html->link(__l('How it Works?'), array('controller' => 'pages', 'action' => 'view', 'how_it_works', 'admin' => false), array('title' => __l('How it Works?'),'class'=> 'howit'));?></li>
							<?php if ($this->Auth->sessionValid()): ?>
							 <?php $active_class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'share_friend') ? 'class="active"' : null; ?> 
							<li <?php echo $active_class; ?>><?php echo $this->Html->link(__l('Refer a Friend'), array('controller' => 'users', 'action' => 'share_friend', 'admin' => false), array('class'=>'refer_icon','title' => __l('Refer a Friend')));?></li>
							<?php endif; ?>
							<?php $active_class = ($this->request->params['controller'] == 'gift_users' && $this->request->params['action'] == 'add' ) ?  'class="active"': null; ?>
				            <li <?php echo $active_class; ?>><?php echo $this->Html->link(__l('Gift'), array('controller' => 'gift_users', 'action' => 'add', 'admin' => false), array('title' =>__l('Gift'),'class'=> 'gift'));?></li>
                        </ul>
                    </div>
              </div>
            </div>
			<!-- Start Main Div -->  
            <div class="body"  id="<?php echo $this->Html->getUniquePageId();?>">		
			<?php
					if ($this->Session->check('Message.error')):
							echo $this->Session->flash('error');
					endif;
					if ($this->Session->check('Message.success')):
							echo $this->Session->flash('success');
					endif;
					if ($this->Session->check('Message.flash')):
							echo $this->Session->flash();
					endif;
			?>
			<?php  if ($this->Session->check('Message.TransactionSuccessMessage')):?>
					<div class="transaction-message info-details ">
							<?php echo $this->Session->read('Message.TransactionSuccessMessage');
								$this->Session->delete('Message.TransactionSuccessMessage');
							?>
					</div>
			<?php  endif; ?>
			<?php if ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'home' ): ?>
            <div class="showcase" id="slides">
			 	  <?php if($this->Html->checkPackageAvialable() > 0): ?>
                	 <div class="banner_sub"> 
					 <?php echo $this->Html->link(' ', array('controller' => 'packages', 'action' => 'subscribe', 'admin' => false), array('escape'=>false,'title' =>__l('Subscribe'),'class'=>'banner-sub-now')); ?>
					 </div>
					 <?php endif; ?>
					<div class="slides_container">
						<?php echo $this->element('home-page-banners-index',array('cache' => array('config' => 'site_element_cache', 'key' => 'banner-slider')));?>
					</div>
                </div>
			<?php endif; ?>
			
					<?php echo $content_for_layout;?>
			</div>
        </div>
    </div>
	<!-- End Main Div -->
    
    <!-- Footer Div -->
    <div id="footer">
    	<div class="footer">
        	<div class="f-c1">
            	<h3><?php echo __l('BeauTy Tips'); ?></h3>
                <ul>
   			        <li><?php echo $this->Html->link(__l('3 Make up tips every girl should know.'), array('controller' => 'pages', 'action' => 'view', '3-make-up-tips-every-girl-should-know', 'admin' => false), array('title' => __l('3 Make up tips every girl should know.')));?></li>
					<li><?php echo $this->Html->link(__l('Latest Spring 2013 Colour of the Season'), array('controller' => 'pages', 'action' => 'view', 'latest-spring-2013-colour-of-the-season', 'admin' => false), array('title' => __l('Latest Spring 2013 Colour of the Season')));?></li>
					<li><?php echo $this->Html->link(__l('10-Step Beauty tips from Bobbi Brown'), array('controller' => 'pages', 'action' => 'view', '10-step-beauty-tips-from-bobbi-brown', 'admin' => false), array('title' => __l('10-Step Beauty tips from Bobbi Brown')));?></li>
					<li><?php echo $this->Html->link(__l('3 Make up tips every girl should know'), array('controller' => 'pages', 'action' => 'view', '3-make-up-tips-every-girl-should-know', 'admin' => false), array('title' => __l('3 Make up tips every girl should know')));?></li>
					<li><?php echo $this->Html->link(__l('Latest Spring 2013 Colour of the Seaso'), array('controller' => 'pages', 'action' => 'view', 'latest-spring-2013-colour-of-the-season', 'admin' => false), array('title' => __l('Latest Spring 2013 Colour of the Seaso')));?></li>
				</ul>
            </div>
            <div class="f-c2">
            	<h3><?php echo __l('Customer Service'); ?></h3>
                <ul>
                	<li><?php echo $this->Html->link(__l('Help / FAQ'), array('controller' => 'pages', 'action' => 'view', 'help_faq', 'admin' => false), array('title' => __l('Help / FAQ')));?></li>
                    <li><?php echo $this->Html->link(__l('Shipping & Returns'), array('controller' => 'pages', 'action' => 'view', 'shipping-return', 'admin' => false), array('title' => __l('Shipping & Returns')));?></li>
                    <li><?php echo $this->Html->link(__l('Contact Us'), array('controller' => 'contacts', 'action' => 'add', 'admin' => false), array('title' => __l('Contact Us')));?></li>
                </ul>
                <h3><?php echo __l('Browse'); ?></h3>
                <p><?php if (!$this->Auth->sessionValid()): echo $this->Html->link(__l('Join'), array('controller' => 'users', 'action' => 'register', 'admin' => false), array('title' => __l('Join'),'class'=>'join'));?> /
				<?php endif; ?>				
				<?php echo $this->Html->link(__l('ABOUT'), array('controller' => 'pages', 'action' => 'view', 'about', 'admin' => false), array('title' =>__l('ABOUT')));?> /<?php echo $this->Html->link(__l('HOW IT WORKS'), array('controller' => 'pages', 'action' => 'view', 'how_it_works', 'admin' => false), array('title' => __l('HOW IT WORKS'),'class'=> 'howit'));?> / <?php echo $this->Html->link(__l('GIFT A WONDERBOX'), array('controller' => 'gift_users', 'action' => 'add', 'admin' => false), array('title' =>__l('GIFT A WONDERBOX'),'class'=> 'gift'));?></p>
            </div>
            <div class="f-c3">
	           	<h3><?php echo __l('Wonderbox'); ?></h3>
              <span class="pink"><?php echo Configure::read('site.address'); ?></span>
			  <p><?php echo __l('Email:'); ?> <a href="mailto: info@wonderbox.com.my" title="info@wonderbox.com.my">info@wonderbox.com.my</a></p>
                <ul>
                	<li><a href="https://www.facebook.com/WonderBoxMalaysia?ref=hl" title="Facebook" target="_blank"><?php echo $this->Html->image('f.jpg',array('width'=>'28','height'=>'31')); ?></a></li>
                    <li><a href="https://www.youtube.com/user/wonderboxmy" title="Youtube" target="_blank"><?php echo $this->Html->image('y.jpg',array('width'=>'28','height'=>'31')); ?></a></li>
                    <li><a href="http://wonderboxmalaysia.tumblr.com/" title="Tumbler" target="_blank"><?php echo $this->Html->image('t.jpg',array('width'=>'28','height'=>'31')); ?></a></li>
					
                </ul>
            </div>
			<div class="clear"></div>
            <div class="copy"><?php echo __l('Copyright'); ?> &copy <?php echo date('Y'); ?>  <?php echo Configure::read('site.name'); ?>. <?php echo 
			__l('All Rights Reserved'); ?>.</div>
        </div>
    </div>
	  <!-- FACEBOOK PLUGIN -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=<?php echo Configure::read('facebook.app_id');?>";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <!-- FACEBOOK PLUGIN -->  
	<?php echo $this->element('site_tracker', array('cache' => array('config' => 'site_element_cache'), 'plugin' => 'site_tracker')); ?>
	<?php echo $this->element('sql_dump'); ?>

</body>
</html>
