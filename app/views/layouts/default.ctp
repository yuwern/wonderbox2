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
	// For other than Facebook (facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)), wrap it in comments for XHTML validation...
if (strpos(env('HTTP_USER_AGENT'), 'facebookexternalhit')===false):
    echo '<!--', "\n";
endif;
    ?>
	<meta content="<?php echo Configure::read('facebook.app_id');?>" property="og:app_id" />
	<meta content="<?php echo Configure::read('facebook.app_id');?>" property="fb:app_id" />
		<meta property="og:site_name" content="<?php echo Configure::read('site.name'); ?>"/>
		<meta property="og:image" content="<?php echo Router::url(array(
				'controller' => 'img',
				'action' => 'blue-theme',
				'logo-email.png',
				'admin' => false
			) , true);?>"/>
	<?php
if (strpos(env('HTTP_USER_AGENT'), 'facebookexternalhit')===false):
    echo '-->', "\n";
endif;
// <--
?>
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
			  	<div class="c1"><strong><?php echo __l('Available units for'); ?> <?php echo $months[Configure::read('header.month')];  ?> :</strong> <span><strong><?php echo
				$this->Html->checkPackageAvialable();?> <?php echo __l('units'); ?></strong></span> <i><?php echo __l('Running out Fast'); ?></i></div>
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
					<div class="c2">&nbsp;<fb:like href="<?php echo Router::url('/', true);?>" layout="button_count" font="tahoma"></fb:like></div>
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
							<li><?php echo $this->Html->link(__l('Referral Points'), array('controller' => 'users', 'action' => 'referral_points'), array('title' => __l('Referral Points')));?></li>
							<li><?php echo $this->Html->link(__l('My Beauty Profile'), array('controller' => 'beauty_profiles', 'action' => 'my_beauty_profile'), array('title' => __l('My Beauty Profile')));?></li>
							<?php if($this->Html->checkUserActive($this->Auth->user('id'))): ?>
							<li><?php echo $this->Html->link(__l('My Product Survey'), array('controller' => 'products', 'action' => 'survey'), array('title' => __l('My Product Survey')));?></li>		
							<?php endif; ?>
							<li><?php echo $this->Html->link(__l('Product Redemption'), array('controller' => 'product_redemptions', 'action' => 'index'), array('title' => __l('Product Redemption')));?></li>
							<li><?php echo $this->Html->link(__l('Product Redemption List'), array('controller' => 'product_redemption_users', 'action' => 'index'), array('title' => __l('Product Redemption List')));?></li>
							
							</ul>
							<?php endif; ?>
						</div>
						<?php if ($this->Auth->sessionValid()): ?>	
                        <script type="text/javascript">cssdropdown.startchrome("chromemenu")</script>
						<?php endif; ?>
                    </div>
					<div class="c4"> 
					<?php echo __l('WonderPoints :'); ?> <span><?php echo $this->Html->getWonderPointAvialable($current_user_details['id']);?></span></div>
					<?php if($this->Auth->sessionValid() && $this->Auth->user('user_type_id') == ConstUserTypes::Admin): ?>
					<div class="c5"><?php echo $this->Html->link(__l('Admin panel'), array('controller' => 'users' , 'action' => 'stats' , 'admin' => true), array('title' => __l('Admin panel'), 'escape' => false)); ?></div> 
					<?php endif; ?>
					<?php if($this->Auth->sessionValid() && $this->Auth->user('user_type_id') == ConstUserTypes::ContentAdmin): ?>
					<div class="c5"><?php echo $this->Html->link(__l('Admin panel'), array('controller' => 'brands' , 'action' => 'index' , 'admin' => true), array('title' => __l('Admin panel'), 'escape' => false)); ?></div> 
					<?php endif; ?>
					<?php else: ?>
					<div class="c2">&nbsp;<fb:like href="<?php echo Router::url('/', true);?>" layout="button_count" font="tahoma"></fb:like></div>
                 	   <div class="c3"><?php echo $this->Html->link('<strong>'.__l('Login').'</strong>', array('controller' => 'users', 'action' => 'login'), array('title' => __l('Login'),'escape'=>false,'class'=>'js-sign-pop-up'));?>&nbsp;&nbsp; |&nbsp;&nbsp; <?php echo $this->Html->link('<strong>'.__l('Register').'</strong>', array('controller' => 'users', 'action' => 'register', 'admin' => false), array('title' => __l('Register'),'escape'=>false));?>  </div>
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
                            <li <?php echo $active_class; ?>><?php echo $this->Html->link(__l('How it Works'), array('controller' => 'pages', 'action' => 'view', 'how_it_works', 'admin' => false), array('title' => __l('How it Works'),'class'=> 'howit'));?></li>
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
				<?php $beautyTips = $this->Html->getBeautyTips(); ?>
				<ul>
				 <?php if(!empty($beautyTips)): 
				 		 foreach($beautyTips as $beautyTip): ?>
							<?php $active_class = ($this->request->params['controller'] == 'beauty_tips' && $this->request->params['action'] == 'view'  && $this->request->params['pass'][0] == $beautyTip['BeautyTip']['slug'] ) ?  'active': null; ?>
						   <li><?php echo $this->Html->link($beautyTip['BeautyTip']['name'], array('controller' => 'beauty_tips', 'action' => 'view', $beautyTip['BeautyTip']['slug'], 'admin' => false), array('title' =>$beautyTip['BeautyTip']['name'],'class'=>$active_class));?></li>
					<?php 
						  endforeach; 	
					   else: ?>
					   <li><?php echo __l('No Beauty Tips is avialable'); ?></li>
					<?php endif?>
				</ul>
            </div>
            <div class="f-c2">
            	<h3><?php echo __l('Customer Service'); ?></h3>
                <ul>	

					<?php $active_class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view'  && $this->request->params['pass'][0] == 'help_faq') ?  'active': null; ?>
                    <li><?php echo $this->Html->link(__l('Help / FAQ'), array('controller' => 'pages', 'action' => 'view', 'help_faq', 'admin' => false), array('title' => __l('Help / FAQ'),'class'=>$active_class));?></li>
					<?php $active_class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view'  && $this->request->params['pass'][0] == 'shipping-return') ?  'active': null; ?>
                    <li><?php echo $this->Html->link(__l('Shipping & Returns'), array('controller' => 'pages', 'action' => 'view', 'shipping-return', 'admin' => false), array('title' => __l('Shipping & Returns'),'class'=>$active_class));?></li>
					<?php $active_class = ($this->request->params['controller'] == 'contacts' && $this->request->params['action'] == 'add' ) ?  'active': null; ?>
                    <li><?php echo $this->Html->link(__l('Contact Us'), array('controller' => 'contacts', 'action' => 'add', 'admin' => false), array('title' => __l('Contact Us'),'class'=>$active_class));?></li>
					<?php $active_class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view'  && $this->request->params['pass'][0] == 'term-and-conditions' ) ?  'active': null; ?>
                   <li><?php echo $this->Html->link(__l('Terms and Conditions'), array('controller' => 'pages', 'action' => 'view', 'term-and-conditions', 'admin' => false), array('title' => __l('Terms and Conditions'),'class'=>$active_class));?></li>
				  <?php $active_class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view'  && $this->request->params['pass'][0] == 'privacy_policy' ) ?  'active': null; ?>
                    <li><?php echo $this->Html->link(__l('Privacy Policy'), array('controller' => 'pages', 'action' => 'view', 'privacy_policy', 'admin' => false), array('title' => __l('Privacy Policy'),'class'=>$active_class));?></li>
                </ul>
                <h3><?php echo __l('Browse'); ?></h3>
                <p><?php if (!$this->Auth->sessionValid()): echo $this->Html->link(__l('Join'), array('controller' => 'users', 'action' => 'register', 'admin' => false), array('title' => __l('Join'),'class'=>'join'));?> /
				<?php endif; ?>		
				<?php $active_class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view'  && $this->request->params['pass'][0] == 'about') ?  'active': null; ?>
				<?php echo $this->Html->link(__l('ABOUT'), array('controller' => 'pages', 'action' => 'view', 'about', 'admin' => false), array('title' =>__l('ABOUT'),'class'=>$active_class));?> /
				<?php $active_class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view'  && $this->request->params['pass'][0] == 'how_it_works') ?  'active': null; ?>
				<?php echo $this->Html->link(__l('HOW IT WORKS'), array('controller' => 'pages', 'action' => 'view', 'how_it_works', 'admin' => false), array('title' => __l('HOW IT WORKS'),'class'=> 'howit '.$active_class));?> / 
				<?php $active_class = ($this->request->params['controller'] == 'gift_users' && $this->request->params['action'] == 'add' ) ?  'active': null; ?>
				<?php echo $this->Html->link(__l('GIFT A WONDERBOX'), array('controller' => 'gift_users', 'action' => 'add', 'admin' => false), array('title' =>__l('GIFT A WONDERBOX'),'class'=> 'gift '.$active_class));?></p>
                <h3><?php echo __l('Partners'); ?></h3>
				<ul>
				<li><?php $active_class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view'  && $this->request->params['pass'][0] == 'affiliatepartners') ?  'active': null; ?>
                           <?php echo $this->Html->link(__l('Affiliate Partners'), array('controller' => 'pages', 'action' => 'view', 'affiliatepartners', 'admin' => false), array('title' => __l('Affiliate Partners'),'class'=>$active_class));?></li>
                           <li><?php $active_class = ($this->request->params['controller'] == 'brands' && $this->request->params['action'] == 'listing' ) ?  'active': null; ?>
                           <?php echo $this->Html->link(__l('Brand Partners'), array('controller' => 'brands', 'action' => 'listing', 'admin' => false), array('title' => __l('Brand Partners'),'class'=>$active_class));?></li>
				</ul>
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
  <?php  if ($this->Auth->sessionValid() && !  $this->Html->checkBeautySurveyComplete($this->Auth->user('id')) && $this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'home'): 
  ?>
  <script type="text/javascript">
	  $(document).ready(function(){
		 $.colorbox({inline:true, href:"#beauty-pop"});
	  });
  </script>
  <div class="hide">
	<div class="beauty-popup" id="beauty-pop" >
		<div class="head"><h1>New title</h1></div>
		<div class="descripition" style="padding:10px"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
		<br/>
		<p><?php echo $this->Html->link(__l('Beauty Profile'), array('controller' => 'beauty_profiles', 'action' => 'my_beauty_profile', 'admin' => false), array('title' => __l('Beauty Profile'),'class'=>'btn1'));?></p>
		</div>
	</div>
  </div>
  <?php endif; ?>
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
