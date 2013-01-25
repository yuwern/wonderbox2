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
<!--[if IE 7]>
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo Router::url('/', true);?>css/ie7.css" />
<![endif]-->
<!--[if IE 8]>
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo Router::url('/', true);?>css/ie8.css" />
<![endif]-->
</head>
<head>
	<?php echo $this->Html->charset(), "\n";?>
	<title><?php echo Configure::read('site.name');?> | <?php echo $this->Html->cText($title_for_layout, false);?></title>
	<?php
		echo $this->Html->meta('icon'), "\n";
		echo $this->Html->meta('keywords', $meta_for_layout['keywords']), "\n";
		echo $this->Html->meta('description', $meta_for_layout['description']), "\n";
	?>
	<link href="<?php echo Router::url('/', true)  .'.rss';?>" type="application/rss+xml" rel="alternate" title="RSS Feeds" target="_blank" />
	<?php
		require_once('_head.inc.ctp');
		echo $this->Asset->scripts_for_layout();
	// For other than Facebook (facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)), wrap it in comments for XHTML validation...
if (strpos(env('HTTP_USER_AGENT'), 'facebookexternalhit')===false):
    echo '<!--', "\n";
endif;
    ?>
	<meta content="<?php echo Configure::read('facebook.app_id');?>" property="og:app_id" />
	<meta content="<?php echo Configure::read('facebook.app_id');?>" property="fb:app_id" />
	<?php if(!empty($meta_for_layout['deal_name'])):?>
		<meta property="og:site_name" content="<?php echo Configure::read('site.name'); ?>"/>
		<meta property='og:title' content='<?php echo $meta_for_layout['deal_name'];?>'/>
	<?php endif;?>
	<?php if(!empty($meta_for_layout['deal_image'])):?>
		<meta property="og:image" content="<?php echo $meta_for_layout['deal_image'];?>"/>
	<?php else:?>
		<meta property="og:image" content="<?php echo Router::url(array(
				'controller' => 'img',
				'action' => 'blue-theme',
				'logo-email.png',
				'admin' => false
			) , true);?>"/>
	<?php endif;?>
	<?php
if (strpos(env('HTTP_USER_AGENT'), 'facebookexternalhit')===false):
    echo '-->', "\n";
endif;
// <--
?>

</head>
<body>
  <!-- FACEBOOK PLUGIN -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=147267432014750";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <!-- FACEBOOK PLUGIN -->  
  
<div class="mbg">
	<div class="top_line"></div>
	<div class="mcont">
		<!--header-->
		<div class="header">
			<div class="logo">	<?php echo $this->Html->link(Configure::read('site.name'), array('controller' => 'pages', 'action' => 'home', 'admin' => false), array('title' => Configure::read('site.name'))); ?>
			
			</div>
			        
			<div class="login_sec">
			    <?php if (!$this->Auth->sessionValid()): ?>
				<span><?php if(Configure::read('facebook.is_enabled_facebook_connect') && !empty($fb_login_url)):  ?>
						<?php echo $this->Html->link($this->Html->image('f_login.jpg'), array('controller' => 'users', 'action' => 'login','type'=>'facebook'), array('title' => __l('Facebook Login'), 'escape' => false)); ?>
					 <?php endif; ?></span>
				<span><?php echo $this->Html->link(__l('Login'), array('controller' => 'users', 'action' => 'login'), array('title' => __l('Login'),'class'=>'but2'));?></span>
				<span><?php echo $this->Html->link(__l('Create an Account'), array('controller' => 'users', 'action' => 'register', 'admin' => false), array('title' => __l('Create an Account'),'class'=>'but1'));?></span>
				 <?php endif;?>
				         <?php if($this->Auth->sessionValid() && $this->Auth->user('user_type_id') == ConstUserTypes::Admin): ?>
            <div class="admin-bar">
                <h3><?php echo __l('You are logged in as '); ?><?php echo $this->Html->link(__l('Admin'), array('controller' => 'users' , 'action' => 'stats' , 'admin' => true), array('title' => __l('Admin'))); ?></h3>
                <div><?php echo $this->Html->link(__l('Logout'), array('controller' => 'users' , 'action' => 'logout', 'admin' => false), array('title' => __l('Logout'))); ?></div>
            </div>
     <?php endif; ?>
		 <?php if ($this->Auth->sessionValid()): ?>
						 <p class="clear" style="float:right">
				
				    <span><?php echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'but2', 'title' => __l('Logout'))); ?>      	   			   </span>                     <?php
						$reg_type_class='normal';
            			if($this->Auth->user('is_openid_register')):
        							$reg_type_class='open-id';
        						endif;
        						if($this->Auth->user('fb_user_id')):
        							//$reg_type_class='facebook';
        						endif;
        						?>
        					<?php
							$current_user_details = array(
								'username' => $this->Auth->user('username'),
								'user_type_id' =>  $this->Auth->user('user_type_id'),
								'id' =>  $this->Auth->user('id'),
								'fb_user_id' =>  $this->Auth->user('fb_user_id')
							);                         
                           ?>	<span> 	<?php echo $this->Html->getUserLink($current_user_details);?></span>	<span>	<?php
    						$current_user_details['UserAvatar'] = $this->Html->getUserAvatar($this->Auth->user('id'));
    						echo $this->Html->getUserAvatarLink($current_user_details, 'small_thumb'); ?></span>
    					
    					 <span> Hi, </span>
						 <span class="js-currentWonderpoint"> <?php echo __l('WonderPoints'); ?> : <?php echo $this->Html->getWonderPointAvialable($current_user_details['id']);?></span>
                             </p>
                            <?php
						
                        endif;
                    ?>
			<!--	<p class="number">Sales + 603 456 1234</p> -->
			</div>
		  <div class="head-subs">
		  		<?php 
				$date_left = $this->Html->dateDiff(date('y-m-d',strtotime('now')),date('y-m-d',mktime(0, 0, 0,Configure::read('header.month'), 15,  Configure::read('header.year')))); ?>
	            <p><?php echo __l('Next surprise:'); ?><span class="f16"> <?php echo $date_left; ?> days</span> left for <span class="f16">  <?php  
				$current_month = date('m',strtotime('now'));
				$current_date = date('d',strtotime('now'));
				$current_year = date('Y',strtotime('now'));
				$total_days_month = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year );

				if($current_date>=15)
					$duration_month = 2;
				else
					$duration_month = 1;
				$months = $this->Html->getMonthLists();
				echo $months[Configure::read('header.month')]; 
				?>'s</span> subscription closes <?php if($this->Html->checkPackageAvialable()):
						echo $this->Html->link(__l('Subscribe'), array('controller' => 'packages', 'action' => 'subscribe', 'admin' => false), array('class'=>'but2 f-rightbtn','title' =>__l('Subscribe')));
						endif; 
						?></p>
                <p>Get Your <span class="f16"><?php echo $months[Configure::read('header.month')];  ?> </span> Edition Wonderbox today as there are only <span class="f16"><?php echo
				$this->Html->checkPackageAvialable();?> left </span></p>
				<p><?php echo $this->Html->link(__l('Gift a WonderBox'), array('controller' => 'gift_users', 'action' => 'add', 'admin' => false), array('title' =>__l('Gift a WonderBox')));?></p>
            </div>
		</div>
		<!--menu-->
		<div class="menu">
			<ul>
			<?php $active_class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'home' ) ?  'act': null; ?>
			<li> <?php echo $this->Html->link(__l('Home'), array('controller' => 'pages', 'action' => 'home', 'admin' => false), array('title' => __l('Home'),'class'=> $active_class)); ?></li>
		      <?php $class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view' && $this->request->params['pass'][0] == 'about') ? ' class="active"' : null; ?>
	  			<?php $active_class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view' && $this->request->params['pass'][0] == 'about') ?  'act': null; ?>
               	<li><?php echo $this->Html->link(__l('About').' '.Configure::read('site.name'), array('controller' => 'pages', 'action' => 'view', 'about', 'admin' => false), array('title' =>__l('About').' '.Configure::read('site.name'),'class'=> $active_class));?> </li>
				</li>
				<?php $active_class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view'  && $this->request->params['pass'][0] == 'how_it_works') ?  'act': null; ?>
				<li><?php echo $this->Html->link(sprintf(__l('How it Works?')), array('controller' => 'pages', 'action' => 'view', 'how_it_works', 'admin' => false), array('title' => sprintf(__l('How it Works?')),'class'=> $active_class));?></li>
				<?php if($this->Html->checkPackageAvialable()): ?>
				<?php  $active_class = ($this->request->params['controller'] == 'packages' && $this->request->params['action'] == 'subscribe' ) ?  'act': null; ?>
				<li><?php echo $this->Html->link(sprintf(__l('Subscribe')), array('controller' => 'packages', 'action' => 'subscribe', 'admin' => false), array('title' => __l('Subscribe'),'class'=> $active_class));?></li>
				<?php endif; ?>
				<?php if ($this->Auth->sessionValid()): ?>
				  <?php $active_class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'share_friend') ? 'act' : null; ?> 
				<li><?php echo $this->Html->link(__l('Refer a Friend'), array('controller' => 'users', 'action' => 'share_friend', 'admin' => false), array('title' => __l('Refer a Friend'),'class'=> $active_class));?></li>
				<?php endif; ?>
				<?php $active_class = ($this->request->params['controller'] == 'contacts' && $this->request->params['action'] == 'add' ) ?  'act': null; ?>
				<li><?php echo $this->Html->link(sprintf(__l('Contact Us')), array('controller' => 'contacts', 'action' => 'add', 'admin' => false), array('title' => sprintf(__l('Contact Us')),'class'=> $active_class));?></li>	
				<?php $active_class = ($this->request->params['controller'] == 'brands' && $this->request->params['action'] == 'index' ) ?  'act': null; ?>
				<li><?php echo $this->Html->link(sprintf(__l('Brands')), array('controller' => 'brands', 'action' => 'index', 'admin' => false), array('title' => sprintf(__l('Brands')),'class'=> $active_class));?></li>
				<?php $active_class = (($this->request->params['controller'] == 'user_profiles' && $this->request->params['action'] == 'edit' || $this->request->params['action'] == 'profile_image'  )|| ($this->request->params['controller'] == 'user_shippings') ||($this->request->params['controller'] == 'package_users') ||($this->request->params['controller'] == 'transactions') || ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'change_password') || ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'redemption') || ($this->request->params['controller'] == 'beauty_profiles' && $this->request->params['action'] == 'my_beauty_profile')|| ($this->request->params['controller'] == 'products' && $this->request->params['action'] == 'survey')) ?  'act': null; ?>
				  <?php if ($this->Auth->sessionValid()): ?>
				<li><?php echo $this->Html->link(sprintf(__l('My Account')), array('controller' => 'user_profiles', 'action' => 'edit',$this->Auth->user('id'), 'admin' => false), array('title' => sprintf(__l('My Account')),'class'=> $active_class));?></li>
				<?php endif; ?>
	
			</ul>
		</div>
		<div class="warper" id="<?php echo $this->Html->getUniquePageId();?>">
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
			
                                        			<?php echo $content_for_layout;?>
			<!--banner-->
			<div class="bot_sec">
				<div class="featured borderimg">
					<h2><?php echo __l('WonderBox December Edition'); ?></h2>
					<?php echo $this->element('home-page-organizers-index'); ?>
				</div>
				<div class="borderimg3 f-left"  align="center">	<?php echo Configure::read('facebook.like_box'); ?></div>
				<div class="about borderimg4">
					<h2><?php echo __l('About').' '.Configure::read('site.name'); ?></h2>
					<p>WonderBox is all about discovery, it is about discovering your true beauty and about discovery of products that will help bring out the best in you. Each monthly WonderBox is filled with up to 5 samples of premium cosmetics and beauty products. <?php echo $this->Html->link(__l('Read More'), array('controller' => 'pages', 'action' => 'view', 'about', 'admin' => false), array('title' =>__l('Read More')));?></p>
					<span class="nadrs"><b>Address:</b></span> 
					<span><?php echo Configure::read('site.address'); ?></span>
					<span class="cont">
						<!-- <b>Telephone:</b> +603 232 2323<br/> -->
						<!-- <b>Fax:</b> +603 232 2323<br/> -->
						<b>Email:</b> <a href="mailto: info@wonderbox.com.my" title="info@wonderbox.com.my">info@wonderbox.com.my</a>
					</span>
				</div>
			</div>
			<div id="footer">
				&copy; 2012 <?php echo Configure::read('site.name'); ?> | All Rights Reserved | <?php $class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view' && $this->request->params['pass'][0] == 'term-and-conditions') ? ' class="active"' : null; ?>
				<?php echo $this->Html->link(__l('Terms of use'), array('controller' => 'pages', 'action' => 'view', 'term-and-conditions', 'admin' => false), array('title' => __l('Terms of use')));?> |               <?php $class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view' && $this->request->params['pass'][0] == 'privacy_policy') ? ' class="active"' : null; ?> <?php echo $this->Html->link(__l('Privacy Policies'), array('controller' => 'pages', 'action' => 'view', 'privacy_policy', 'admin' => false), array('title' => __l('Privacy Policies')));?>  
			</div>
		</div>		
	</div>
</div>

	<?php echo $this->element('site_tracker', array('cache' => array('config' => 'site_element_cache'), 'plugin' => 'site_tracker')); ?>
	<?php echo $this->element('sql_dump'); ?>

</body>
</html>
