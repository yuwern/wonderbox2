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

<div id="container">
  
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
  
  

<!-- WRAPPER -->
	<div id="wrapper">
	
	<!-- HEADER WRAPPER -->
	<div id="header-wrapper">
	
	<!-- BODY CONTENT --> 	
	<div id="<?php echo $this->Html->getUniquePageId();?>" class="content">


	<!-- HEADER BEGINS -->
   	<div id="header">
    <div id="header-content">
            
      <div class="clearfix">
        <h1>
        	<?php echo $this->Html->link(Configure::read('site.name'), array('controller' => 'pages', 'action' => 'home', 'admin' => false), array('title' => Configure::read('site.name'))); ?>
		</h1>
        <p class="hidden-info"><?php echo __l('Collective Buying Power');?></p>
        
        
        <?php if($this->Auth->sessionValid() && $this->Auth->user('user_type_id') == ConstUserTypes::Admin): ?>
            <div class="admin-bar">
                <h3><?php echo __l('You are logged in as '); ?><?php echo $this->Html->link(__l('Admin'), array('controller' => 'users' , 'action' => 'stats' , 'admin' => true), array('title' => __l('Admin'))); ?></h3>
                <div><?php echo $this->Html->link(__l('Logout'), array('controller' => 'users' , 'action' => 'logout', 'admin' => true), array('title' => __l('Logout'))); ?></div>
            </div>
     <?php endif; ?>
      </div>
              
      <div class="menu-block clearfix">
        <ul class="menu clearfix" id='ddmenu'>
				<li <?php if($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'home') { echo 'class="active"'; } ?>><?php echo $this->Html->link(sprintf(__l('Home')), array('controller' => 'pages', 'action' => 'home', 'admin' => false), array('title' => sprintf(__l('Home'))));?></li>
				<li <?php if($this->request->params['controller'] == 'subscriptions' && $this->request->params['action'] == 'add') { echo 'class="active"'; } ?>><?php echo $this->Html->link(sprintf(__l('Subscription')), array('controller' => 'subscriptions', 'action' => 'add', 'admin' => false), array('title' => sprintf(__l('Subscription'))));?></li>
			    <?php if($this->Auth->sessionValid()): ?>
          			<?php if($this->Auth->sessionValid()):?>
					<?php if($this->Auth->user('user_type_id') != ConstUserTypes::Company):?>
						<li <?php if($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'my_stuff') { echo 'class="active"'; } ?>>
							<?php  echo $this->Html->link(__l('My Stuff'), array('controller' => 'users', 'action' => 'my_stuff'), array('title' => __l('My Stuff')));?>
						</li>
		
					<?php endif; ?>
				<?php endif; ?>

            <?php endif; ?>
        </ul>
        <div class="menu-right">
        	<?php
				$reg_type_class='normal';
			
          if (!$this->Auth->sessionValid()): ?>

			  <div class="openid-block clearfix">

              <!-- <h5><?php echo __l('Sign In using: '); ?></h5> -->

              <ul class="open-id-list">
                <li class="face-book">
				<?php if(Configure::read('facebook.is_enabled_facebook_connect') && !empty($fb_login_url)):  ?>
						<?php echo $this->Html->link(__l('Sign in with Facebook'), array('controller' => 'users', 'action' => 'login','type'=>'facebook'), array('title' => __l('Sign in with Facebook'), 'escape' => false)); ?>
					 <?php endif; ?>
				</li>
	
              </ul>
              
			  </div>


              <ul class="menu-link clearfix">
                <li <?php if($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'register') { echo 'class="active"'; } ?> ><?php echo $this->Html->link(__l('Join us'), array('controller' => 'users', 'action' => 'register', 'admin' => false), array('title' => __l('Join us'),'class'=>'login-link'));?></li>
                <li <?php if($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'login') { echo 'class="active"'; } ?>><?php echo $this->Html->link(__l('Sign in'), array('controller' => 'users', 'action' => 'login'), array('title' => __l('Sign in'),'class'=>'login-link'));?></li>
              </ul>
			  

			  
			  
               <?php endif; ?>
            <?php if ($this->Auth->sessionValid()): ?>
              <p class="user-login-info">
                    <?php
            			if($this->Auth->user('is_openid_register')):
        							$reg_type_class='open-id';
        						endif;
        						if($this->Auth->user('fb_user_id')):
        							$reg_type_class='facebook';
        						endif;
        						?>
        					<?php
							$current_user_details = array(
								'username' => $this->Auth->user('username'),
								'user_type_id' =>  $this->Auth->user('user_type_id'),
								'id' =>  $this->Auth->user('id'),
								'fb_user_id' =>  $this->Auth->user('fb_user_id')
							);
                         
                            echo __l('Hi, '); ?>
    							<span class="<?php echo $reg_type_class; ?>">
    								<?php echo $this->Html->getUserLink($current_user_details);?>
    							</span>
    						<?php
    						$current_user_details['UserAvatar'] = $this->Html->getUserAvatar($this->Auth->user('id'));
    						echo $this->Html->getUserAvatarLink($current_user_details, 'small_thumb'); ?>

                            <?php
						
                        endif;
                    ?>

				<?php if($this->Auth->sessionValid()): ?>
                    <?php echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'logout-link', 'title' => __l('Logout'))); ?>
                </p>
			   <?php endif; ?>
        </div>
      </div>

    </div>
  </div>  
  	<!-- HEADER -->

  
        <div id="main" class="clearfix">
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
				<div class="side1">
    			    <div class="side1-tl">
                        <div class="side1-tr">
                          <div class="side1-tm"> </div>
                        </div>
                     </div>
                     <div class="side1-cl">
                        <div class="side1-cr">
                            <div class="block1-inner">
                
                    			<!-- 2-col layout: main deals + sidebar -->
                    			<?php echo $content_for_layout;?>
                    			
            				</div>
            				</div>
        				</div>
        				
                        <div class="side1-bl">
                            <div class="side1-br">
                              <div class="side1-bm"> </div>
                            </div>
                      </div>
				</div>

			
				
				
				</div>

<div id="footer">

      
        <div class="footer-inner clearfix">
          <div class="footer-wrapper-inner clearfix">

            <div class="footer-section4"></div>          
            <div class="footer-section1">
              <!-- <div class="footer-left">
                <div class="footer-right"> -->
                 <h6><?php echo __l('Company'); ?></h6>
                <!-- </div>
              </div> -->
              <ul class="footer-nav">
                <?php $class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view' && $this->request->params['pass'][0] == 'about') ? ' class="active"' : null; ?>
               	<li <?php echo $class;?>><?php echo $this->Html->link(__l('About'), array('controller' => 'pages', 'action' => 'view', 'about', 'admin' => false), array('title' => __l('About')));?> </li>
              <li <?php if($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view'  && $this->request->params['pass'][0] == 'how_it_works') { echo 'class="active"'; } ?>><?php echo $this->Html->link(sprintf(__l('How It Works')), array('controller' => 'pages', 'action' => 'view', 'how_it_works', 'admin' => false), array('title' => sprintf(__l('How It Works'))));?></li>
                <?php $class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view' && $this->request->params['pass'][0] == 'term-and-conditions') ? ' class="active"' : null; ?>
				<li <?php echo $class;?>><?php echo $this->Html->link(__l('Terms & Conditions'), array('controller' => 'pages', 'action' => 'view', 'term-and-conditions', 'admin' => false), array('title' => __l('Terms & Conditions')));?></li>
                 <?php $class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view' && $this->request->params['pass'][0] == 'privacy_policy') ? ' class="active"' : null; ?>
				<li <?php echo $class;?>><?php echo $this->Html->link(__l('Privacy Policy'), array('controller' => 'pages', 'action' => 'view', 'privacy_policy', 'admin' => false), array('title' => __l('Privacy Policy')));?></li>
				<?php if(Configure::read('facebook.site_facebook_url')): ?>
				<li <?php echo $class;?>><?php echo $this->Html->link(__l('Facebook'), Configure::read('facebook.site_facebook_url'), array('title' => __l('Facebook'), 'escape' => false));?></li>
						<?php endif; ?>
				   <?php $class = ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'view' && $this->request->params['pass'][0] == 'faq') ? ' class="active"' : null; ?>
    				<li <?php echo $class;?>><?php echo $this->Html->link(__l('FAQ'), array('controller' => 'pages', 'action' => 'view', 'faq', 'admin' => false), array('title' => __l('FAQ')));?></li>
              </ul>
            </div>
            

			
          </div>
          <div id="openwave" class="clearfix">
			<p class="copy">&copy; 2012 All Rights Reserved | Designed and developed by <a href="http://www.openwavecomp.com/">Openwave Computing</a>.</p>          
            </div>
        </div>
      
    <!--  </div>
    </div>
    footer-cl -->
    
  </div>
<!-- footer ends --> 
  
</div>
	<!-- BODY CONTENT ENDS -->

	</div>
	<!-- HEADER WRAPPER ENDS -->

	</div>
	<!-- WRAPPER ENDS -->

</div>
<!-- CONTAINER ENDS -->

	<?php echo $this->element('site_tracker', array('cache' => array('config' => 'site_element_cache'), 'plugin' => 'site_tracker')); ?>
	<?php echo $this->element('sql_dump'); ?>

</body>
</html>
