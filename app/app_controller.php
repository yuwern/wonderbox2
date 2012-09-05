<?php
/* SVN FILE: $Id: app_controller.php 59781 2011-07-11 05:04:21Z arovindhan_144at11 $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7805 $
 * @modifiedby    $LastChangedBy: AD7six $
 * @lastmodified  $Date: 2008-10-30 23:00:26 +0530 (Thu, 30 Oct 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller
{
    public $components = array(
        'RequestHandler','Session',
        'Security',
        'Auth',
        'XAjax',
        'DebugKit.Toolbar',
        'Cookie',
        'Pdf'
    );
    public $helpers = array(
        'Html','Session',
        'Javascript',
        'AutoLoadPageSpecific',
        'Form',
        'Asset',
        'Auth',
        'Time',
        'RestXml',
        'RestJson',
       );
  
    var $cookieTerm = '+4 weeks';
    //    var $view = 'Theme';
    //    var $theme = 'default';
    function beforeRender()
    { 

        $this->set('meta_for_layout', Configure::read('meta'));
        $this->set('js_vars_for_layout', (isset($this->js_vars)) ? $this->js_vars : '');
		if (Configure::read('site.is_api_enabled')) {
            if (!empty($this->request->query['api_key']) && !empty($this->request->query['api_token'])) {
                if (!empty($this->viewVars['api_response'])) {
                    $this->set('response', $this->viewVars['api_response']);
                } else {
                    $this->set('response', array(
                        'status' => 404,
                        'message' => __l('Unknown Error') ,
                        'deals' => array()
                    ));
                }
            }
        }
        parent::beforeRender();
    }
    function __construct($request = null)
    {
        parent::__construct($request);
		//Setting cache related code
         App::import('Model', 'Setting');
        $setting_model_obj = new Setting();
        $settings = $setting_model_obj->getKeyValuePairs();
        Configure::write($settings);
        // languages are set in globals
        $current_city_slug = Configure::read('site.city');
        if (!empty($_GET['url'])) {
            $city_slug = explode('/', $_GET['url']);
            $current_city_slug = (!empty($city_slug[0])) ? $city_slug[0] : Configure::read('site.city');
        }
        $lang_code = Configure::read('site.language');
        if (!empty($_COOKIE['CakeCookie']['user_language'])) {
            $lang_code = $_COOKIE['CakeCookie']['user_language'];
        } else if (!empty($current_city_slug)) {
            $cookie_city_slug = !empty($_COOKIE['CakeCookie']['city_slug']) ? $_COOKIE['CakeCookie']['city_slug'] : '';
            if (empty($cookie_city_slug) || ($current_city_slug != $cookie_city_slug)) {
                // This cache file will delete, in city model after save
                $city = Cache::read('site_cities_languages_'.$current_city_slug);
                if(empty($city)) {
    			    $this->loadModel('City');
                    $city = $this->City->find('first', array(
                        'conditions' => array(
                            'City.slug' => $current_city_slug,
                            'City.is_approved' => 1
                        ) ,
                        'contain' => array(
                            'Language' => array(
                                'fields' => array(
                                    'Language.iso2'
                                )
                            )
                        ) ,
                        'fields' => array(
                            'City.language_id'
                        ) ,
                        'recursive' => 1
                    ));
                    // This cache file will delete, in city model after save
                    Cache::write('site_cities_languages_'.$current_city_slug, $city);
                }
                if (!empty($city['Language']['iso2'])) {
                    setcookie('CakeCookie[city_language]', $city['Language']['iso2']);
                    $lang_code = $city['Language']['iso2'];
                } else {
                    setcookie('CakeCookie[city_language]', $lang_code);
                }
            } elseif (!empty($_COOKIE['CakeCookie']['city_language'])) {
                $lang_code = $_COOKIE['CakeCookie']['city_language'];
            }
        }
        Configure::write('lang_code', $lang_code);
        Cache::set(array(
            'duration' => '+100 days'
        ));

		$this->js_vars = array();
        $js_trans_array = array(
            'Are you sure you want to ',
            'Please select atleast one record!',
            'Are you sure you want to do this action?',
            'Please enter valid original price.',
            'Discount percentage should be less than 100.',
            'Discount amount should be less than original price.',
            'Are you sure do you want to change the status? Once the status is changed you cannot undo the status.',
            'By clicking this button you are confirming your purchase. Once you confirmed amount will be deducted from your wallet and you can not undo this process. Are you sure you want to confirm this purchase?',
            'Since you don\'t have sufficent amount in wallet, your purchase process will be proceeded to PayPal. Are you sure you want to confirm this purchase?',
            'Google map could not find your location, please enter known location to google',
            'Invalid extension, Only csv, txt are allowed',
        );
        foreach($js_trans_array as $trans) {
            if (!empty($GLOBALS['_langs'][$lang_code][$trans])) {
                $this->js_vars['cfg']['lang'][$trans] = $GLOBALS['_langs'][$lang_code][$trans];
            }
        }			
		// Writing Currency in cache
	//	$this->_cacheWriteCurrency();
		// affiliate type write cache 
	//	$this->_cacheWriteAffiliateType();
		// Writing site name in cache, required for getting sitename retrieving in routes
        Cache::write('site.name', strtolower(Inflector::slug(Configure::read('site.name'))) , 'long');
        if (!(Cache::read('site_url_for_shell', 'long'))) {
            Cache::write('site_url_for_shell', Router::url('/', true) , 'long');
        }
        // Writing city routing url in cache
        if (($city_url = Cache::read('site.city_url', 'long')) === false) {
            Cache::write('site.city_url', Configure::read('site.city_url') , 'long');
        }
        // Writing default city name in cache
        $default_city = Cache::read('site.default_city', 'long');
        if (($default_city = Cache::read('site.default_city', 'long')) === false) {
            Cache::write('site.default_city', Configure::read('site.city') , 'long');
            $this->redirect(Router::url('/', true));
        }
    }
    function beforeFilter()
    {
        // Coding done to disallow demo user to change the admin settings
		if ($this->request->params['action'] != 'flashupload') {
			$cur_page = $this->request->params['controller'] . '/' . $this->request->params['action'];
			$admin_demomode_updation_not_allowed_array = Configure::read('site.admin_demomode_updation_not_allowed_array');
			if ($this->Auth->user('user_type_id') && $this->Auth->user('user_type_id') == ConstUserTypes::Admin && !Configure::read('site.is_admin_settings_enabled') && (!empty($this->request->data) || $this->request->params['action'] == 'admin_delete' || $this->request->params['action'] == 'admin_update') && in_array($cur_page, $admin_demomode_updation_not_allowed_array)) {
				$this->Session->setFlash(__l('Sorry. You cannot update or delete in demo mode') , 'default', null, 'error');
                if($cur_page == 'subscriptions/admin_subscription_customise')
				{
					$this->redirect(array(
						'controller' => 'subscriptions',
						'action' => 'admin_subscription_customise',
					));
				} else {
					$this->redirect(array(
						'controller' => $this->request->params['controller'],
						'action' => 'index',
					));
				}
			}
		}
        // End of Code
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'geocity') {
		    $this->loadModel('City');
            $city =  $this->City->find('first', array(
                'conditions' => array(
                    'City.name' => $_COOKIE['city_name'],
                    'City.is_approved' => 1
                ) ,
                'contain' => array(
                    'Language' => array(
                        'fields' => array(
                            'Language.iso2'
                        )
                    )
                ) ,
                'fields' => array(
                    'City.language_id',
                    'City.slug'
                ) ,
                'recursive' => 1
            ));
            if (!empty($city)) {
                $this->request->params['named']['city'] = $city['City']['slug'];
                if (!empty($city['Language']['iso2'])) {
                    Configure::write('lang_code', $city['Language']['iso2']);
                }
            } else {
                $this->request->params['named']['city'] = Configure::read('site.city');
                //$this->redirect(Router::url('/', true));

            }
        }
        $timezone_code = Configure::read('site.timezone_offset');
        if (!empty($timezone_code)) {
            date_default_timezone_set($timezone_code);
        }
        if (Configure::read('site.is_ssl_for_deal_buy_enabled')) {
            $secure_array = array(
                'users/login',
                'users/admin_login',
                'users/register',
                'users/show_captcha',
            );
            $cur_page = $this->request->params['controller'] . '/' . $this->request->params['action'];
            if (in_array($cur_page, $secure_array) && $this->request->params['action'] != 'flashupload') {
                $this->Security->blackHoleCallback = 'forceSSL';
                $this->Security->requireSecure($this->request->params['action']);
            } else if (env('HTTPS') && !$this->RequestHandler->isAjax()) {
                $this->_unforceSSL();
            }
        }
        if ($this->request->params['controller'] != 'images' && $this->request->params['action'] != 'flashupload') {
            $_SESSION['city_attachment'] = '';
            $city_slug = !empty($this->request->params['named']['city']) ? $this->request->params['named']['city'] : Configure::read('site.city');
            // This cache file will delete, in city model after save
            $city = Cache::read('site_city_detail_'.$city_slug);
            if(empty($city)) {
    			$this->loadModel('City');
                $city = $this->City->find('first', array(
                    'conditions' => array(
                        'City.slug' => !empty($this->request->params['named']['city']) ? $this->request->params['named']['city'] : Configure::read('site.city') ,
                        'City.is_approved' => 1
                    ) ,
                    'contain' => array(
                        'Attachment'
                    ) ,
					'recursive' => 0
                ));
				// city based background image width and height set
				//$dir = WWW_ROOT . 'img' . DS . 'city_background_thumb' . DS . 'City';
                //$this->_traverse_directory($dir, 0);

                // This cache file will delete, in city model after save
				if(!empty($city)){
					Cache::write('site_city_detail_'.$city['City']['slug'], $city);
				}
            }
			// setting table to update current city thumb size
			if( (!empty($city['City']['thumb_width']) &&  (Configure::read('thumb_size.city_background_thumb.width') != $city['City']['thumb_width'])) || ( !empty($city['City']['thumb_height']) && (Configure::read('thumb_size.city_background_thumb.height') != $city['City']['thumb_height'] ))){
				$this->loadModel('Setting');	
				$background =  $this->Setting->find('all', array( 
				   'conditions' => array('Setting.setting_category_id' => array(7)),
					  'recursive' => -1
				
				));
				foreach($background as $value){	
					if($value['Setting']['name'] == 'thumb_size.city_background_thumb.width'){
						$_data['Setting']['id'] = $value['Setting']['id'];
						$_data['Setting']['value'] = $city['City']['thumb_width'];
						$this->Setting->save($_data);	
						Configure::write('thumb_size.city_background_thumb.width', $city['City']['thumb_width']);
					}	
					elseif($value['Setting']['name'] == 'thumb_size.city_background_thumb.height'){
						$_data['Setting']['id'] = $value['Setting']['id'];
						$_data['Setting']['value'] = $city['City']['thumb_height'];
						$this->Setting->save($_data);	
						Configure::write('thumb_size.city_background_thumb.height', $city['City']['thumb_height']);
					}				
						
				}
			}	

            $this->set('city_id', $city['City']['id']);
            $this->set('city_name', $city['City']['name']);
            $this->set('city_slug', $city['City']['slug']);
            $this->set('city_attachment', $city['Attachment']);
		   // user avail balance
            if ($this->Auth->user('id')) {
			    $this->loadModel('User');
                $this->set('user_available_balance', $this->User->checkUserBalance($this->Auth->user('id')));
            }
        }
		if(isset($this->request->data['Subscription']['city_id'])){
            $this->loadModel('City');
			$city_info = $this->City->find('first', array(
                'conditions' => array(
                    'City.id' => $this->request->data['Subscription']['city_id'] ,
                    'City.is_approved' => 1
                ) ,
                'recursive' => -1
            ));
			setcookie('CakeCookie[city_slug]',$city_info['City']['slug']);
		}else if (!empty($this->request->params['named']['city']) && empty($this->request->params['isAjax']) && empty($this->request->params['requested'])) {
			setcookie('CakeCookie[city_slug]', $this->request->params['named']['city']);
            setcookie('CakeCookie[city_slug]', $this->request->params['named']['city'],time()+60*60*24*30,'/');
        }
        if (!empty($this->request->params['named']['city'])) {
            setcookie('CakeCookie[city_slug]', $this->request->params['named']['city']);
        }        
   

        $cur_page = $this->request->params['controller'] . '/' . $this->request->params['action'];
        // check site is under maintenance mode or not. admin can set in settings page and then we will display maintenance message, but admin side will work.
        if (empty($this->request->params['requested']) and $cur_page != 'images/view' and $cur_page != 'devs/robots' and Configure::read('site.maintenance_mode') && (($this->Auth->user('user_type_id') && $this->Auth->user('user_type_id') != ConstUserTypes::Admin) or (empty($this->request->params['prefix']) or ($this->request->params['prefix'] != 'admin' and $cur_page != 'users/admin_login')))) {
            throw new InternalErrorException(__l('Invalid request'));
        }
        //Fix to upload the file through the flash multiple uploader
        if ((isset($_SERVER['HTTP_USER_AGENT']) and ((strtolower($_SERVER['HTTP_USER_AGENT']) == 'shockwave flash') or (strpos(strtolower($_SERVER['HTTP_USER_AGENT']) , 'adobe flash player') !== false))) and isset($this->request->params['pass'][0]) and ($this->action == 'flashupload')) {
            session_id($this->request->params['pass'][0]);
            session_start();
        }
		if ($this->Auth->user('fb_user_id') || (!$this->Auth->user() && Configure::read('facebook.is_enabled_facebook_connect')) || ($this->request->params['controller'] == 'cities' && ($this->request->params['action'] == 'admin_index' || $this->request->params['action'] == 'admin_edit' || $this->request->params['action'] == 'fb_update')) || $this->request->params['controller'] == 'settings') {
            App::import('Vendor', 'facebook/facebook');
            // Prevent the 'Undefined index: facebook_config' notice from being thrown.
            $GLOBALS['facebook_config']['debug'] = NULL;
            // Create a Facebook client API object.
            $this->facebook = new Facebook(array(
                'appId' => Configure::read('facebook.app_id') ,
                'secret' => Configure::read('facebook.fb_secrect_key') ,
                'cookie' => true
            ));
            $this->set('facebookObj', $this->facebook);
            if ($this->Auth->user('id')) {
				if (!empty($this->request->params['named']['city'])) {
					$this->set('fb_logout_url', $this->facebook->getLogoutUrl(array(
						'next' => (Router::url(array(
							'controller' => $this->request->params['named']['city'],
							'action' => 'users',
							'logout',
							'admin' => false
						) , true))
					)));
				} else {
					$this->set('fb_logout_url', $this->facebook->getLogoutUrl(array(
						'next' => (Router::url(array(
							'controller' => 'users',
							'action' => 'logout',
							'admin' => false
						) , true))
					)));
				}	
            } else {
                if (!empty($this->request->params['named']['city'])) {
                    $this->set('fb_login_url', $this->facebook->getLoginUrl(array(
                        'cancel_url' => Router::url(array(
                            'controller' => $this->request->params['named']['city'],
                            'action' => 'users',
                            'register',
                            'admin' => false
                        ) , true) ,
                        'next' => Router::url(array(
                            'controller' => $this->request->params['named']['city'],
                            'action' => 'users',
                            'register',
                            'admin' => false
                        ) , true) ,
                        'req_perms' => 'email,publish_stream'
                    )));
                } else {
                    $this->set('fb_login_url', $this->facebook->getLoginUrl(array(
                        'cancel_url' => Router::url(array(
                            'controller' => 'users',
                            'action' => 'register',
                            'admin' => false
                        ) , true) ,
                        'next' => Router::url(array(
                            'controller' => 'users',
                            'action' => 'register',
                            'admin' => false
                        ) , true) ,
                        'req_perms' => 'email,publish_stream'
                    )));
                }
            }
        }
        if (strpos($this->here, '/view/') !== false) {
            trigger_error('*** dev1framework: Do not view page through /view/; use singular/slug', E_USER_ERROR);
        }
        // check the method is exist or not in the controller
        $methods = array_flip($this->methods);
        if (!isset($methods[strtolower($this->request->params['action']) ])) {
		   throw new NotFoundException(__l('Invalid request'));
        }

 
		$this->Auth->fields = array(
            'username' => Configure::read('user.using_to_login') ,
            'password' => 'password'
        );
        // For iPhone App code -->
        $this->_checkAuth();
        $this->js_vars = array();
        $this->js_vars['cfg']['icm'] = $GLOBALS['_city']['icm'];
		$this->js_vars['cfg']['path_relative'] = Router::url('/');
        $this->js_vars['cfg']['path_absolute'] = Router::url('/', true);
        $this->js_vars['cfg']['date_format'] = 'M d, Y';
        $this->js_vars['cfg']['today_date'] = date('Y-m-d');
        $this->js_vars['cfg']['site_name'] = strtolower(Inflector::slug(Configure::read('site.name')));
		$this->js_vars['cfg']['small_big_thumb.width'] = Configure::read('thumb_size.small_big_thumb.width');
		$this->js_vars['cfg']['small_big_thumb.height'] = Configure::read('thumb_size.small_big_thumb.height');
		$this->js_vars['cfg']['medium_big_thumb.width'] = Configure::read('thumb_size.medium_big_thumb.width');
		$this->js_vars['cfg']['medium_big_thumb.height'] = Configure::read('thumb_size.medium_big_thumb.height');
		$this->js_vars['cfg']['user_type_id'] = $this->Auth->user('user_type_id');
		
        parent::beforeFilter();
    }
    function _checkAuth()
    {        
        $exception_array = array(
            'cities/check_city',
            'countries/index',
            'countries/change_country',
            'pages/view',
            'pages/display',
            'pages/home',
            'subscriptions/add',
            'cities/index',
            'contacts/show_captcha',
            'users/register',
            'users/login',
            'users/logout',
            'users/reset',
            'users/forgot_password',
            'users/openid',
            'users/activation',
            'users/resend_activation',
            'users/view',
            'users/show_captcha',
            'users/oauth_callback',
            'users/captcha_play',
            'users/oauth_facebook',
            'users/thanks',
			'users/fs_oauth_callback',
            'images/view',
            'devs/robots',
            'contacts/add',
            'contacts/show_captcha',
            'contacts/captcha_play',
            'images/view',
            'cities/autocomplete',
            'states/autocomplete',
            'users/admin_login',
            'users/admin_logout',
            'languages/change_language',
            'subscriptions/add',
			'subscriptions/thanks',
            'subscriptions/index',
            'subscriptions/unsubscribe',
            'users/resend_activemail',
            'cities/twitter_facebook',
            'devs/sitemap',
            'devs/robotos',
            'users/validate_user',
            'users/refer',
            'home_page_banners/index',
            'home_page_organizers/index',
			'crons/update_package',
			'packages/payment_success',
			'packages/payment_cancel',
			'packages/express_checkout',
			'packages/index',
			'packages/subscribe',
        );
        $cur_page = $this->request->params['controller'] . '/' . $this->request->params['action'];
        if (!in_array($cur_page, $exception_array) && $this->request->params['action'] != 'flashupload') {
            if (!$this->Auth->user('id')) {
                // check cookie is present and it will auto login to account when session expires
                $cookie_hash = $this->Cookie->read('User.cookie_hash');
                if (!empty($cookie_hash)) {
                    if (is_integer($this->cookieTerm) || is_numeric($this->cookieTerm)) {
                        $expires = time() +intval($this->cookieTerm);
                    } else {
                        $expires = strtotime($this->cookieTerm, time());
                    }
					$this->loadModel('User');
                    $this->request->data = $this->User->find('first', array(
                        'conditions' => array(
                            'User.cookie_hash =' => md5($cookie_hash) ,
                            'User.cookie_time_modified <= ' => date('Y-m-d h:i:s', $expires) ,
                        ) ,
                        'fields' => array(
                            'User.' . Configure::read('user.using_to_login') ,
                            'User.password'
                        ) ,
                        'recursive' => -1
                    ));
                    // auto login if cookie is present
                    if ($this->Auth->login($this->request->data)) {
						$this->loadModel('User');
                        $user_model_obj->UserLogin->insertUserLogin($this->Auth->user('id'));
                        $this->redirect(Router::url('/', true) . $this->request->url);
                    }
                }
                $this->Session->setFlash(__l('You need to Log-In or Sign-Up to do that!'));
                $is_admin = false;
                if (isset($this->request->params['prefix']) and $this->request->params['prefix'] == 'admin') {
                    $is_admin = true;
                }
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login',
                    'admin' => $is_admin,
                    '?f=' . $this->request->url
                ));
            }
            if (isset($this->request->params['prefix']) and $this->request->params['prefix'] == 'admin' and $this->Auth->user('user_type_id') != ConstUserTypes::Admin) {
                $this->redirect(Router::url('/', true));
            }
        } else {
            $this->Auth->allow('*');
        }
        $this->Auth->autoRedirect = false;
        $this->Auth->userScope = array(
            'User.is_active' => 1,
            'User.is_email_confirmed' => 1
        );
        if (isset($this->Auth)) {
            $this->Auth->loginError = __l(sprintf('Sorry, login failed.  Either your %s or password are incorrect or admin deactivated your account.', Configure::read('user.using_to_login')));
        }
        $this->layout = 'default';
	
        if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin && (isset($this->request->params['prefix']) and $this->request->params['prefix'] == 'admin')) {
            $this->layout = 'admin';
        }
        if (!empty($this->request->query['api_key']) && !empty($this->request->query['api_token'])) {
            $this->layout = false;
            $this->viewPath = 'api';
        }
        // if the site is accessed with m.domain; e.g., m.videomyne.com
        if (Configure::read('site.is_mobile_app') and stripos(getenv('HTTP_HOST') , 'm.') === 0) {
            // different layout and view for mobile application
            $this->layoutPath = 'mobile';
            //If mobile views folder and necessary .ctp file exist then using that, otherwise using the normal view folder ctp
            if (file_exists(VIEWS . $this->viewPath . DS . 'mobile' . DS . $this->request->params['action'] . $this->ext)) {
                $this->viewPath.= DS . 'mobile';
            }
        }
        // if the site is accessed with touch.domain; e.g., touch.videomyne.com
        if (stripos(getenv('HTTP_HOST') , 'touch.') === 0) {
            // different layout and view for touch application
            $this->layoutPath = 'touch';
            //If touch views folder and necessary .ctp file exist then using that, otherwise using the normal view folder ctp
            if (file_exists(VIEWS . $this->viewPath . DS . 'touch' . DS . $this->request->params['action'] . $this->ext) || ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'display')) {
                $this->viewPath.= DS . 'touch';
            }
        }
        // Layout Changes for API
        if (Configure::read('site.is_api_enabled')) {
            if (!empty($this->request->query['api_key']) && !empty($this->request->query['api_token'])) {
                $this->layout = false;
                $this->viewPath = 'api';
            }
        }
    }
    function autocomplete($param_encode = null, $param_hash = null)
    {
        $modelClass = Inflector::singularize($this->name);
        $conditions = false;
        if (isset($this->{$modelClass}->_schema['is_approved'])) {
            $conditions['is_approved = '] = '1';
        }
        $this->XAjax->autocomplete($param_encode, $param_hash, $conditions);
    }
    function show_captcha()
    {
        include_once VENDORS . DS . 'securimage' . DS . 'securimage.php';
        $img = new securimage();
        $img->show(); // alternate use:  $img->show('/path/to/background.jpg');
        $this->autoRender = false;
    }
    function captcha_play()
    {
        App::import('Vendor', 'securimage/securimage');
        $img = new Securimage();
        $this->disableCache();
        $this->RequestHandler->respondAs('mp3', array(
            'attachment' => 'captcha.mp3'
        ));
        $img->audio_format = 'mp3';
        echo $img->getAudibleCode('mp3');
    }
    function _uuid()
    {
        return sprintf('%07x%1x', mt_rand(0, 0xffff) , mt_rand(0, 0x000f));
    }
	function getDurationPeriod($no_of_month,$user_id){
		$this->loadModel('User');	
		$user =  $this->User->find('first', array( 
				   'conditions' => array(
						'User.id' => $user_id,
						'User.is_verified_user' => 1,
						
					),
				   'fields' => array(
						'User.subscription_expire_date'
					),
					'recursive' => -1
		));
		if(!empty($user['User']['subscription_expire_date'])){
			$date_array = explode('-',$user['User']['subscription_expire_date']);
			$year = $date_array[0];
			$month = $date_array[1];
		} else {
			$month = Configure::read('header.month');
			$year = date("Y");
		}
		date_default_timezone_set('UTC');
		$result_details['start_date'] = date('Y-m-d',mktime(0, 0, 0, $month , 15, $year));
		$dateMonthAdded = strtotime(date("Y-m-d", strtotime($result_details['start_date'])) . "+".$no_of_month." month");
		$result_details['end_date'] = date('Y-m-d', $dateMonthAdded);
		return $result_details;
	}
    function _unum()
    {
        $acceptedChars = '0123456789';
        $max = strlen($acceptedChars) -1;
        $unique_code = '';
        for ($i = 0; $i < 8; $i++) {
            $unique_code.= $acceptedChars{mt_rand(0, $max) };
        }
        return $unique_code;
    }
    function _redirectGET2Named($whitelist_param_names = null)
    {
        $query_strings = array();
        $ajax_query_strings = '';
        if (is_array($whitelist_param_names)) {
            foreach($whitelist_param_names as $param_name) {
                if (!empty($this->request->query[$param_name])) { // querystring
                    if ($this->request->params['isAjax']) {
                        $ajax_query_strings.= $param_name . ':' . $this->request->query[$param_name] . '/';
                    } else {
                        $query_strings[$param_name] = $this->request->query[$param_name];
                    }
                }
            }
        } else {
            $query_strings = $this->request->query;
            unset($query_strings['url']); // Can't use ?url=foo

        }
        if (!empty($query_strings) || !empty($ajax_query_strings)) {
            if ($this->request->params['isAjax']) {
                $this->redirect(array(
                    'controller' => $this->request->params['controller'],
                    'action' => $this->request->params['action'],
                    $ajax_query_strings
                ) , null, true);
            } else {
                $query_strings = array_merge($this->request->params['named'], $query_strings);
                $this->redirect($query_strings, null, true);
            }
        }
    }
    public function redirect($url, $status = null, $exit = true)
    {
        if (Cache::read('site.city_url', 'long') == 'prefix') {
            parent::redirect(router_url_city($url, $this->request->params['named']) , $status, $exit);
        }
        parent::redirect($url, $status, $exit);
    }
    public function flash($message, $url, $pause = 1, $layout = 'flash')
    {
        if (Cache::read('site.city_url', 'long') == 'prefix') {
            parent::flash($message, router_url_city($url, $this->request->params['named']) , $pause);
        }
        parent::redirect($message, $url, $pause);
    }
    //Force a secure connection
    function forceSSL()
    {
        if (!env('HTTPS')) {
            $this->redirect('https://' . env('SERVER_NAME') . $this->here);
        }
    }
    function _unforceSSL()
    {
        if (empty($this->request->params['requested'])) $this->redirect('http://' . $_SERVER['SERVER_NAME'] . $this->here);
    }

	
    function _traverse_directory($dir, $dir_count)
    {
        @$handle = opendir($dir);
        while (false !== ($readdir = @readdir($handle))) {
            if ($readdir != '.' && $readdir != '..') {
                $path = $dir . '/' . $readdir;
                if (is_dir($path)) {
                    @chmod($path, 0777);
                    ++$dir_count;
                    $this->_traverse_directory($path, $dir_count);
                }
                if (is_file($path)) {
                    @chmod($path, 0777);
                    @unlink($path);
                    //so that page wouldn't hang
                    flush();
                }
            }
        }
        @closedir($handle);
        @rmdir($dir);
        return true;
    }
		
}
?>
