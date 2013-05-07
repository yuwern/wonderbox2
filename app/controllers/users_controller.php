<?php
class UsersController extends AppController
{
    public $name = 'Users';
    public $components = array(
        'Email',
        'Openid',
        'OauthConsumer'
    );
    public $helpers = array(
        'Csv',
   );
    public $uses = array(
        'User',
        'Attachment'
    );
    public $permanentCacheAction = array(
        'register' => array(
            'is_public_url' => true
        ) ,
        'login' => array(
            'is_public_url' => true
        ) ,
        'view' => array(
            'is_public_url' => true,
            'is_admin_url' => true,
            'is_view_count_update' => true
        ) ,
        'my_stuff' => array(
            'is_user_specific_url' => true
        ) ,
        'change_password' => array(
            'is_public_url' => true
        ) ,
        'reset' => array(
            'is_public_url' => true
        ) ,
        'forgot_password' => array(
            'is_public_url' => true
        ) ,
    );

    public $disabledFields = array(
        'City.id',
        'City.name',
        'State.id',
        'State.name',
        'User.referer_name',
        'UserProfile.country_id',
        'UserProfile.state_id',
        'UserProfile.city_id',
        'User.geobyte_info',
        'User.maxmind_info',
        'User.referred_by_user_id',
        'User.type',
        'User.is_agree_terms_conditions',
        'User.country_iso_code',
        'User.is_requested',
        'User.is_remember',
        'User.f',
        'User.profile_image_id',
		'User.username',
		'User.passwd',
		'User.is_remember'
    );

    public function beforeFilter()
    {
        $this->Security->disabledFields = $this->disabledFields;
        parent::beforeFilter();
        $this->disableCache();
    }
    public function view($username = null)
    {
        $this->pageTitle = __l('User');
        if (is_null($username)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.username = ' => $username
            ) ,
            'contain' => array(
				'UserShipping',
                'UserProfile' => array(
                    'fields' => array(
                        'UserProfile.created',
                        'UserProfile.first_name',
                        'UserProfile.last_name',
                        'UserProfile.dob',
                        'UserProfile.address',
                        'UserProfile.zip_code',
                        'UserProfile.phone_number',
                      
                    ) ,
                    'Gender' => array(
                        'fields' => array(
                            'Gender.name'
                        )
                    ) ,
                  ) ,
                'UserAvatar' => array(
                    'fields' => array(
                        'UserAvatar.id',
                        'UserAvatar.dir',
                        'UserAvatar.filename',
                        'UserAvatar.width',
                        'UserAvatar.height'
                    )
                )
            ) ,
            'fields' => array(
                'User.id',
                'User.username',
                'User.email',
                'User.user_type_id',
                'User.fb_user_id',
                'User.created'
            ) ,
            'recursive' => 2
        ));
	     if (empty($user)) {
            throw new NotFoundException(__l('Invalid request'));
        }
  
        $this->User->UserView->create();
        $this->request->data['UserView']['user_id'] = $user['User']['id'];
        $this->request->data['UserView']['viewing_user_id'] = $this->Auth->user('id');
        $this->request->data['UserView']['ip'] = $this->RequestHandler->getClientIP();
        $this->request->data['UserView']['dns'] = gethostbyaddr($this->RequestHandler->getClientIP());
        $this->User->UserView->save($this->request->data);
        $this->pageTitle.= ' - ' . $username;
        $this->set('user', $user);
    }
    public function register($type = null)
    {
        $this->pageTitle = __l('User Registration');
        $this->loadModel('EmailTemplate');
        $fbuser = $this->Session->read('fbuser');
        $user_type_check = $this->Session->read('user_type');
        if (!empty($fbuser['fb_user_id'])) {
            $this->request->data['User']['username'] = $fbuser['username'];
            $this->request->data['User']['email'] = '';
            $this->request->data['User']['fb_user_id'] = $fbuser['fb_user_id'];
            $this->request->data['User']['fb_access_token'] = $fbuser['fb_access_token'];
            $this->request->data['User']['is_facebook_register'] = 1;
            if (!empty($user_type_check) && $user_type_check == '') {
                $type = '';
            }
            $this->Session->delete('fbuser');
        } else if (empty($this->request->data)) {
            $fb_sess_check = $this->Session->read('fbuser');
            //if (Configure::read('facebook.is_enabled_facebook_connect') && !$this->Auth->user() && $this->facebook->getSession()) {
            if (Configure::read('facebook.is_enabled_facebook_connect') && !$this->Auth->user() && !empty($fb_sess_check)) {
                // Quick fix for facebook issue //
                //if ($_GET['session']) {
                $this->_facebook_login();
                //}
                
            }
        }
        // Twitter modified registration: Comes for registration from oauth //
        $twuser = $this->Session->read('twuser');
        if (empty($this->request->data)) {
            if (!empty($twuser)) {
                $this->request->data['User']['username'] = $twuser['username'];
                $this->request->data['User']['email'] = '';
                $this->request->data['User']['twitter_user_id'] = $twuser['twitter_user_id'];
                $this->request->data['User']['twitter_access_token'] = $twuser['twitter_access_token'];
                $this->request->data['User']['twitter_access_key'] = $twuser['twitter_access_key'];
                $this->request->data['User']['twitter_avatar_url'] = $twuser['profile_image_url'];
                $this->request->data['User']['is_twitter_register'] = 1;
                if (Configure::read('invite.is_referral_system_enabled')) {
                    //user id will be set in cookie
                    $cookie_value = $this->Cookie->read('referrer');
                    if (!empty($cookie_value)) {
                        $this->request->data['User']['referred_by_user_id'] = $cookie_value['refer_id'];
                    }
                }
                if (!empty($user_type_check) && $user_type_check == '') {
                    $type = '';
                }
                $this->Session->delete('twuser');
            }
        }
        // Foursquare modified registration: Comes for registration from fs_oauth //
        $fsuser = $this->Session->read('fsuser');
        if (empty($this->request->data)) {
            if (!empty($fsuser)) {
                $this->request->data['User']['username'] = $fsuser['username'];
                $this->request->data['User']['email'] = $fsuser['email'];
                $this->request->data['User']['foursquare_user_id'] = $fsuser['foursquare_user_id'];
                $this->request->data['User']['foursquare_access_token'] = $fsuser['foursquare_access_token'];
                $this->request->data['User']['is_foursquare_register'] = 1;
                /*if (Configure::read('invite.is_referral_system_enabled')) {
                    //user id will be set in cookie
                    $cookie_value = $this->Cookie->read('referrer');
                    if (!empty($cookie_value)) {
                        $this->request->data['User']['referred_by_user_id'] = $cookie_value['refer_id'];
                    }
                }*/
                if (!empty($user_type_check) && $user_type_check == '') {
                    $type = '';
                }
                $this->Session->delete('fsuser');
            }
        }
        //open id component included
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Openid');
        $this->Openid = new OpenidComponent($collection);
        $openid = $this->Session->read('openid');
        if (!empty($openid['openid_url'])) {
            if (isset($openid['email'])) {
                $this->request->data['User']['email'] = $openid['email'];
                $this->request->data['User']['username'] = $openid['username'];
                $this->request->data['User']['openid_url'] = $openid['openid_url'];
                if (!empty($openid['is_gmail_register'])) {
                    $this->request->data['User']['is_gmail_register'] = $openid['is_gmail_register'];
                }
            
                if (!empty($user_type_check) && $user_type_check == '') {
                    $this->request->data['User']['type'] = $type = '';
                }
                $this->Session->delete('openid');
            }
        }
        // handle the fields return from openid
        if ((count($_GET) > 1) && !empty($_GET['openid_identity'])) {
            if (!empty($user_type_check) && $user_type_check == '') {
                $type = '';
            }
            $returnTo = Router::url(array(
                'controller' => 'users',
                'action' => 'register'
            ) , true);
            $response = $this->Openid->getResponse($returnTo);
            if ($response->status == Auth_OpenID_SUCCESS) {
                // Required Fields
                if ($user = $this->User->UserOpenid->find('first', array(
                    'conditions' => array(
                        'UserOpenid.openid' => $response->identity_url
                    )
                ))) {
                    //Already existing user need to do auto login
                    $this->request->data['User']['email'] = $user['User']['email'];
                    $this->request->data['User']['username'] = $user['User']['username'];
                    $this->request->data['User']['password'] = $user['User']['password'];
                    if ($this->Auth->login($this->request->data)) {
                        $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                        $this->redirect(array(
                            'controller' => 'users',
                            'action' => 'my_stuff'
                        ));
                    } else {
                        $this->Session->setFlash($this->Auth->loginError, 'default', null, 'error');
                        $this->redirect(array(
                            'controller' => 'users',
                            'action' => 'login'
                        ));
                    }
                } else {
                    if ((Configure::read('referral.referral_enabled_option') == ConstReferralOption::GrouponLikeRefer)) {
                        //user id will be set in cookie
                        $cookie_value = $this->Cookie->read('referrer');
                        if (!empty($cookie_value)) {
                            $this->request->data['User']['referred_by_user_id'] = $cookie_value['refer_id'];
                        }
                    }
                    $sregResponse = Auth_OpenID_SRegResponse::fromSuccessResponse($response);
                    $sreg = $sregResponse->contents();
                    $this->request->data['User']['username'] = isset($sreg['nickname']) ? $sreg['nickname'] : '';
                    $this->request->data['User']['email'] = isset($sreg['email']) ? $sreg['email'] : '';
                    $this->request->data['User']['openid_url'] = $response->identity_url;
                }
            } else {
                $this->Session->setFlash(__l('Authenticated failed or you may not have profile in your OpenID account'));
            }
        }
        if (!empty($user_type_check) && $user_type_check == '') {
            $this->request->data['']['name'] = '';
            $this->request->data['']['address1'] = '';
            $this->request->data['']['zip'] = '';
            $this->Session->delete('user_type');
        }
        // send to openid function with open id url and redirect page
        if (!empty($this->request->data['User']['openid']) && preg_match('/^http?:\/\/+[a-z]/', $this->request->data['User']['openid'])) {
            $this->User->set($this->request->data);
            unset($this->User->validate[Configure::read('user.using_to_login') ]);
            unset($this->User->validate['passwd']);
            unset($this->User->validate['email']);
            unset($this->User->validate['confirm_password']);
            if ($this->User->validates()) {
                $this->request->data['User']['redirect_page'] = 'register';
                $this->_openid();
            } else {
                $this->Session->setFlash(__l('Your registration process is not completed. Please, try again.') , 'default', null, 'error');
            }
        } else {
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['User']['type'])) {
                    $type = $this->request->data['User']['type'];
                }
               
              
                $this->User->set($this->request->data);
                $this->User->UserProfile->set($this->request->data);
                if ($this->User->validates() & $this->User->UserProfile->validates() ) {
                    $this->User->create();
                    if (!empty($this->request->data['User']['openid_url']) or !empty($this->request->data['User']['fb_user_id'])) {
                        $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['email'] . Configure::read('Security.salt'));
                        //For open id register no need for email confirm, this will override is_email_verification_for_register setting
                        $this->request->data['User']['is_agree_terms_conditions'] = 1;
                        $this->request->data['User']['is_email_confirmed'] = 1;
                     
                    } elseif (!empty($this->request->data['User']['twitter_user_id'])) { // Twitter modified registration: password  -> twitter user id and salt //
                        $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['twitter_user_id'] . Configure::read('Security.salt'));
                        $this->request->data['User']['is_email_confirmed'] = 1;
                    } else {
                        $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['passwd']);
					    $this->request->data['User']['is_email_confirmed'] = 1;
                    }
                    $this->request->data['User']['is_active'] = 1;
                    $this->request->data['User']['user_type_id'] = ConstUserTypes::User;
                    if ($this->Session->read('gift_user_id')) {
                        $this->request->data['User']['gift_user_id'] = $this->Session->read('gift_user_id');
                        $this->Session->delete('gift_user_id');
                    }
                    $this->request->data['User']['signup_ip'] = $this->RequestHandler->getClientIP();
                    $this->request->data['User']['dns'] = gethostbyaddr($this->RequestHandler->getClientIP());
                    if (!empty($type)) {
                        $this->request->data['User']['user_type_id'] = ConstUserTypes::Company;
                    }
                   $this->request->data['User']['username'] = $this->request->data['User']['email'];
					if ($this->User->save($this->request->data, false)) {
		
					   $this->request->data['UserProfile']['user_id'] = $this->User->getLastInsertId();
                        $this->User->UserProfile->create();
                        $this->User->UserProfile->save($this->request->data);
                        // send to admin mail if is_admin_mail_after_register is true
                        if (Configure::read('user.is_admin_mail_after_register')) {
                            $email = $this->EmailTemplate->selectTemplate('New User Join');
                            $emailFindReplace = array(
                                '##SITE_LINK##' => Router::url('/', true) ,
                                '##USERNAME##' => $this->request->data['User']['username'],
                                '##SITE_NAME##' => Configure::read('site.name') ,
                                '##SIGNUP_IP##' => $this->RequestHandler->getClientIP() ,
                                '##EMAIL##' => $this->request->data['User']['email'],
                                '##CONTACT_URL##' => Router::url(array(
                                    'controller' => 'contacts',
                                    'action' => 'add',
                                    'city' => $this->request->params['named']['city'],
                                    'admin' => false
                                ) , true) ,
                                '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']) ,
                                '##SITE_LOGO##' => Router::url(array(
                                    'controller' => 'img',
                                    'action' => 'blue-theme',
                                    'logo-email.png',
                                    'admin' => false
                                ) , true) ,
                            );
                            // Send e-mail to users
                            $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
                            $this->Email->replyTo = ($email['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $email['reply_to'];
                            $this->Email->to = Configure::read('site.contact_email');
                            $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                            $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                            $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                        }
                        $this->Session->setFlash(__l('You have successfully registered with our site.') , 'default', null, 'success');
                        if (!empty($this->request->data['User']['openid_url']) || !empty($this->request->data['User']['fb_user_id'])) {
                            // send welcome mail to user if is_welcome_mail_after_register is true
                            if (Configure::read('user.is_welcome_mail_after_register')) {
                                $this->_sendWelcomeMail($this->User->id, $this->request->data['User']['email'], $this->request->data['User']['username']);
                            }
                            if (empty($this->request->data['User']['fb_user_id'])) {
                                $this->request->data['UserOpenid']['openid'] = $this->request->data['User']['openid_url'];
                                $this->request->data['UserOpenid']['user_id'] = $this->User->id;
                                $this->User->UserOpenid->create();
                                $this->User->UserOpenid->save($this->request->data);
                            }
                            if ($this->Auth->login($this->request->data)) {
                                $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                              
                                    if ($redirectUrl = $this->Session->read('Auth.redirectUrl')) {
                                        $this->Session->delete('Auth.redirectUrl');
                                        $this->redirect(Router::url('/', true) . $redirectUrl);
                                    } else {
                                        $this->redirect(array(
                                            'controller' => 'pages',
                                            'action' => 'home'
                                        ));
                                    }
                           
                            }
                        } else {
                            //For openid register no need to send the activation mail, so this code placed in the else
                            if (Configure::read('user.is_email_verification_for_register')) {
								echo "email verification";
                                $this->Session->setFlash(__l('You have successfully registered with our site and your activation mail has been sent to your mail inbox.') , 'default', null, 'success');
                                $this->_sendActivationMail($this->request->data['User']['email'], $this->User->id, $this->User->getActivateHash($this->User->id));
                            }
                        }
                        // send welcome mail to user if is_welcome_mail_after_register is true
                       // if (!Configure::read('user.is_email_verification_for_register') and !Configure::read('user.is_admin_activate_after_register') and Configure::read('user.is_welcome_mail_after_register')) {
					    if (Configure::read('user.is_welcome_mail_after_register')) {
						         $this->_sendWelcomeMail($this->User->id, $this->request->data['User']['email'], $this->request->data['User']['username']);
                        }
                    //    if (!Configure::read('user.is_email_verification_for_register') and Configure::read('user.is_auto_login_after_register')) {
						    if (Configure::read('user.is_auto_login_after_register')) {
						   //   $this->Session->setFlash(__l('You have successfully registered with our site.') , 'default', null, 'success');
                            if ($this->Auth->login($this->request->data)) {

                                 $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                                if ($this->RequestHandler->isAjax()) {
									if($this->layoutPath == 'touch')
									{
										$this->redirect(array(
											'controller' => 'pages',
											'action' => 'home',
											'admin' => false
										));
									} else {
										echo 'redirect*' . Router::url('/', true) . $this->request->data['User']['f'];
										exit;
									}	
                                } else if (!empty($this->request->data['User']['f'])) {
                                    $this->redirect(Router::url('/', true) . $this->request->data['User']['f']);
                                }
                                 $this->redirect(array(
									 'controller' => 'beauty_profiles',
									 'action' => 'quiz'
								 ));
                                }
                          
                        }
					     if ($this->request->params['isAjax'] == 1) {
							if($this->layoutPath == 'touch')
							{
										$this->redirect(array(
											'controller' => 'pages',
											'action' => 'home',
											'admin' => false
										));
							} else {
								$ajax_url = Router::url('/', true) . 'users/login?f=' . $this->request->data['User']['f'];
								$success_msg = 'redirect*' . $ajax_url;
								echo $success_msg;
								exit;
							}	
                        }
                        $this->redirect(array(
                            'controller' => 'beauty_profiles',
                            'action' => 'quiz'
                        ));
                    }
                } else {
                    if (empty($this->request->data['User']['openid_url'])) {
                        $this->Session->setFlash(__l('Your registration process is not completed. Please, try again.') , 'default', null, 'error');
                    } else {
                        if (!empty($this->request->data['User']['is_gmail_register'])) {
                            $flash_verfy = 'Gmail';
                        }  else {
                            $flash_verfy = 'OpenID';
                        }
                        $this->Session->setFlash($flash_verfy . ' ' . __l('verification is completed successfully. But you have to fill the following required fields to complete our registration process.') , 'default', null, 'error');
                    }
                }
            }
        }
        if (!empty($this->request->params['named']['f'])) {
            $this->request->data['User']['f'] = $this->request->params['named']['f'];
        }
        if (!empty($this->request->params['requested'])) {
            $this->request->data['User']['is_requested'] = 1;
        }
        unset($this->request->data['User']['passwd']);
   
        // When already logged user trying to access the registration page we are redirecting to site home page
        if ($this->Auth->user()) {
            $this->redirect(array(
                'controller' => 'pages',
                'action' => 'home'
            ));
        }

        //for user referral system
        if (empty($this->request->data)) {
            //user id will be set in cookie
            $cookie_value = $this->Cookie->read('referrer');
            if (!empty($cookie_value)) {
                $this->request->data['User']['referred_by_user_id'] = $cookie_value['refer_id'];                 
            }
        }
        //end
        $countries = $this->User->UserProfile->Country->find('list');
		$ageGroups = $this->User->UserProfile->AgeGroup->find('list');   
        $this->set('type', $type);
        $this->set(compact('countries','ageGroups'));
        unset($this->request->data['User']['passwd']);
        unset($this->request->data['User']['confirm_password']);
        unset($this->request->data['User']['captcha']);
    }
	public function thanks(){

	}
    public function profile_image($id = null)
    {
        if (!empty($this->request->data['User']['id'])) {
            $id = $this->request->data['User']['id'];
        }
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $id
            ) ,
            'contain' => array(
                'UserAvatar' => array(
                    'fields' => array(
                        'UserAvatar.id',
                        'UserAvatar.filename',
                        'UserAvatar.dir',
                        'UserAvatar.width',
                        'UserAvatar.height'
                    )
                )
            ) ,
            'recursive' => 0
        ));
        if (empty($user)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle = $user['User']['username'] . ' - ' . __l('Profile Image');
        $this->User->UserAvatar->Behaviors->attach('ImageUpload', Configure::read('avatar.file'));
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['UserAvatar']['filename']['name'])) {
                $this->request->data['UserAvatar']['filename']['type'] = get_mime($this->request->data['UserAvatar']['filename']['tmp_name']);
            }
            if (!empty($this->request->data['UserAvatar']['filename']['name']) || (!Configure::read('avatar.file.allowEmpty') && empty($this->request->data['UserAvatar']['id']))) {
                $this->User->UserAvatar->set($this->request->data);
            }
            $ini_upload_error = 1;
			if(isset($this->request->data['UserAvatar']['filename'])) {
				if ($this->request->data['UserAvatar']['filename']['error'] == 1) {
					$ini_upload_error = 0;
				}
			}	
            if ($this->User->UserAvatar->validates() && $ini_upload_error) {
                if (!empty($this->request->data['UserAvatar']['filename']['name'])) {
                    $this->Attachment->delete($user['UserAvatar']['id']);
                    $this->Attachment->create();
                    $this->request->data['UserAvatar']['class'] = 'UserAvatar';
                    $this->request->data['UserAvatar']['foreign_id'] = $this->request->data['User']['id'];
                    $this->Attachment->save($this->request->data['UserAvatar']);
                    $this->request->data['User']['profile_image_id'] = ConstProfileImage::Upload;
                }
                $this->User->save($this->request->data, false);
				if(!empty($this->request->data['User']['profile_image_id'])) {
	                $this->Session->setFlash(__l('User Profile Image has been updated') , 'default', null, 'success');
				}
				
                    $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'profile_image',$this->Auth->user('id'),
                        'admin' => false,
                    ));
          
            }
        } else {
            $this->request->data = $user;
        }
        $profileimages = array(
            ConstProfileImage::Twitter => ConstProfileImage::Twitter,
            ConstProfileImage::Facebook => ConstProfileImage::Facebook,
            ConstProfileImage::Upload => ConstProfileImage::Upload
        );
        $this->set('profileimages', $profileimages);
        $fb_return_url = Router::url(array(
            'controller' => $this->request->params['named']['city'],
            'action' => 'users',
            'connect',
            $id,
            'admin' => false
        ) , true);
        $this->Session->write('fb_return_url', $fb_return_url);
        App::import('Vendor', 'facebook/facebook');
        $this->facebook = new Facebook(array(
            'appId' => Configure::read('facebook.app_id') ,
            'secret' => Configure::read('facebook.fb_secrect_key') ,
            'cookie' => true
        ));
        $this->set('fb_login_url', $this->facebook->getLoginUrl(array(
            'redirect_uri' => Router::url(array(
                'controller' => 'users',
                'action' => 'oauth_facebook',
                'admin' => false
            ) , true) ,
            'scope' => 'email,publish_stream'
        )));
        
    }
  
    public function admin_export($hash = null)
    {
        Configure::write('debug', 0);
        $conditions = array();
        if (isset($this->request->params['named']['from_date']) || isset($this->request->params['named']['to_date'])) {
            $conditions['DATE(User.created) BETWEEN ? AND ? '] = array(
                _formatDate('Y-m-d H:i:s', $this->request->params['named']['from_date'], true) ,
                _formatDate('Y-m-d H:i:s', $this->request->params['named']['to_date'], true)
            );
        }
        if (!empty($this->request->params['named']['main_filter_id'])) {
          if ($this->request->params['named']['main_filter_id'] == ConstMoreAction::FaceBook) {
                $conditions['User.fb_user_id != '] = NULL;
                $this->pageTitle.= __l(' - Registered through FaceBook ');
            }else if ($this->request->params['named']['main_filter_id'] == ConstUserTypes::Admin) {
                $conditions['User.user_type_id'] = ConstUserTypes::Admin;
                $this->pageTitle.= __l(' - Admin ');
            }
            $count_conditions = $conditions;
        }
        if (!empty($this->request->params['named']['filter_id'])) {
            if ($this->request->params['named']['filter_id'] == ConstMoreAction::Active) {
                $conditions['User.is_active'] = 1;
                $this->pageTitle.= __l(' - Active ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Inactive) {
                $conditions['User.is_active'] = 0;
                $this->pageTitle.= __l(' - Inactive ');
            }
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'day') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(User.created) <= '] = 0;
            $this->pageTitle.= __l(' - Registered today');
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'week') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(User.created) <= '] = 7;
            $this->pageTitle.= __l(' - Registered in this week');
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'month') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(User.created) <= '] = 30;
            $this->pageTitle.= __l(' - Registered in this month');
        }
        if (!empty($hash) && isset($_SESSION['user_export'][$hash])) {
            $user_ids = implode(',', $_SESSION['user_export'][$hash]);
            if ($this->User->isValidUserIdHash($user_ids, $hash)) {
                $conditions['User.id'] = $_SESSION['user_export'][$hash];
            } else {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        if (isset($this->request->params['named']['q']) && !empty($this->request->params['named']['q'])) {
            $conditions['User.username like'] = '%' . $this->request->params['named']['q'] . '%';
        }
        $users = $this->User->find('all', array(
            'conditions' => $conditions,
                   'recursive' => 1
        ));
        if (!empty($users)) {
            foreach($users as $user) {
                $data[]['User'] = array(
                    __l('Username') => $user['User']['username'],
                    __l('Email') => $user['User']['email'],
                    __l('Login count') => $user['User']['user_login_count'],
                    __l('Email Confirmed') => !empty($user['User']['is_email_confirmed']) ? __l('Yes') : __l('No') ,
                    __l('Signup IP') => $user['User']['signup_ip'],
                    __l('Created on') => $user['User']['created'],
                    __l('Available balance amount') => $user['User']['available_balance_amount'],
                );
            }
        }
        $this->set('data', $data);
    }
     public function _openid()
    {
        //open id component included
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Openid');
        $this->Openid = new OpenidComponent($collection);
        $returnTo = Router::url(array(
            'controller' => 'users',
            'action' => $this->request->data['User']['redirect_page']
        ) , true);
        $siteURL = Router::url('/', true);
        // send openid url and fields return to our server from openid
        if (!empty($this->request->data)) {
            try {
                $this->Openid->authenticate($this->request->data['User']['openid'], $returnTo, $siteURL, array(
                    'email',
                    'nickname'
                ) , array());
            }
            catch(InvalidArgumentException $e) {
                $this->Session->setFlash(__l('Invalid OpenID') , 'default', null, 'error');
				$this->redirect(array(
					'controller' => 'users',
					'action' => 'login'
				));
            }
            catch(Exception $e) {
                $this->Session->setFlash(__l($e->getMessage()));
				$this->redirect(array(
					'controller' => 'users',
					'action' => 'login'
				));
            }
        }
    }
    public function _sendActivationMail($user_email, $user_id, $hash)
    {
        $this->loadModel('EmailTemplate');
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.email' => $user_email
            ) ,
            'recursive' => - 1
        ));
        $email = $this->EmailTemplate->selectTemplate('Activation Request');
        $emailFindReplace = array(
            '##SITE_LINK##' => Router::url('/', true) ,
            '##USERNAME##' => $user['User']['username'],
            '##SITE_NAME##' => Configure::read('site.name') ,
            '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']) ,
            '##ACTIVATION_URL##' => Router::url(array(
                'controller' => 'users',
                'action' => 'activation',
                $user_id,
                $hash
            ) , true) ,
            '##CONTACT_URL##' => Router::url(array(
                'controller' => 'contacts',
                'action' => 'add',
                'city' => (!empty($this->request->params['named']['city'])) ? $this->request->params['named']['city'] : '',
                'admin' => false
            ) , true) ,
            '##SITE_LOGO##' => Router::url(array(
                'controller' => 'img',
                'action' => 'blue-theme',
                'logo-email.png',
                'admin' => false
            ) , true) ,
        );
        $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
        $this->Email->replyTo = ($email['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $email['reply_to'];
        $this->Email->to = $user_email;
        $this->Email->subject = strtr($email['subject'], $emailFindReplace);
        $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
        if ($this->Email->send(strtr($email['email_content'], $emailFindReplace))) {
            return true;
        }
    }
    public function _sendWelcomeMail($user_id, $user_email, $username)
    {
        $this->loadModel('EmailTemplate');
        $email = $this->EmailTemplate->selectTemplate('Welcome Email');
        $emailFindReplace = array(
            '##SITE_LINK##' => Router::url('/', true) ,
            '##SITE_NAME##' => Configure::read('site.name') ,
            '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']) ,
            '##USERNAME##' => $username,
            '##SUPPORT_EMAIL##' => Configure::read('site.contact_email') ,
            '##SITE_URL##' => Router::url('/', true) ,
            '##CONTACT_URL##' => Router::url(array(
                'controller' => 'contacts',
                'action' => 'add',
                'city' => $this->request->params['named']['city'],
                'admin' => false
            ) , true) ,
            '##SITE_LOGO##' => Router::url(array(
                'controller' => 'img',
                'action' => 'blue-theme',
                'logo-email.png',
                'admin' => false
            ) , true) ,
        );
        $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
        $this->Email->replyTo = ($email['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $email['reply_to'];
        $this->Email->to = $user_email;
        $this->Email->subject = strtr($email['subject'], $emailFindReplace);
        $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
        $this->Email->send(strtr($email['email_content'], $emailFindReplace));
    }
    public function activation($user_id = null, $hash = null)
    {
        $this->pageTitle = __l('Activate your account');
        if (is_null($user_id) or is_null($hash)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
                'User.is_email_confirmed' => 0,
            ) ,
            'recursive' => - 1
        ));
        if (empty($user)) {
            $this->Session->setFlash(__l('Invalid activation request, please register again'));
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'register'
            ));
        }
        if (!$this->User->isValidActivateHash($user_id, $hash)) {
            $hash = $this->User->getActivateHash($user_id);
            $this->Session->setFlash(__l('Invalid activation request'));
            $this->set('show_resend', 1);
            $resend_url = Router::url(array(
                'controller' => 'users',
                'action' => 'resend_activation',
                $user_id,
                $hash
            ) , true);
            $this->set('resend_url', $resend_url);
        } else {
            $this->request->data['User']['id'] = $user_id;
            $this->request->data['User']['is_email_confirmed'] = 1;
			$this->request->data['User']['is_verified_user'] = 1;
            // admin will activate the user condition check
            $this->request->data['User']['is_active'] = (Configure::read('user.is_admin_activate_after_register')) ? 0 : 1;
            $this->User->save($this->request->data);
            // active is false means redirect to home page with message
            if (!$this->request->data['User']['is_active']) {
                $this->Session->setFlash(__l('You have successfully activated your account. But you can login after admin activate your account.') , 'default', null, 'success');
                $this->redirect(Router::url('/', true));
            }
            // send welcome mail to user if is_welcome_mail_after_register is true
            if (Configure::read('user.is_welcome_mail_after_register')) {
                $this->_sendWelcomeMail($user['User']['id'], $user['User']['email'], $user['User']['username']);
            }
            // after the user activation check script check the auto login value. it is true then automatically logged in
            if (Configure::read('user.is_auto_login_after_register')) {
                $this->Session->setFlash(__l('You have successfully activated and logged in to your account.') , 'default', null, 'success');
                $this->request->data['User']['email'] = $user['User']['email'];
                $this->request->data['User']['username'] = $user['User']['username'];
                $this->request->data['User']['password'] = $user['User']['password'];
                if ($this->Auth->login($this->request->data)) {
                    $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                    if ($user['User']['user_type_id'] == ConstUserTypes::Company) {
                            $this->redirect(array(
                                'controller' => 'users',
                                'action' => 'my_stuff'
                            ));
                    } else {
                        $this->redirect(array(
                            'controller' => 'users',
                            'action' => 'my_stuff'
                        ));
                    }
                }
            }
            // user is active but auto login is false then the user will redirect to login page with message
            $this->Session->setFlash(sprintf(__l('You have successfully activated your account. Now you can login with your %s.') , Configure::read('user.using_to_login')) , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'login'
            ));
        }
    }
    public function resend_activation($user_id = null, $hash = null)
    {
        if (is_null($user_id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $hash = $this->User->getActivateHash($user_id);
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id
            ) ,
            'recursive' => - 1
        ));
        if ($this->_sendActivationMail($user['User']['email'], $user_id, $hash)) {
            if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
                $this->Session->setFlash(__l('Activation mail has been resent.') , 'default', null, 'success');
            } else {
                $this->Session->setFlash(__l('A Mail for activating your account has been sent.') , 'default', null, 'success');
            }
        } else {
            $this->Session->setFlash(__l('Try some time later as mail could not be dispatched due to some error in the server') , 'default', null, 'error');
        }
        if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
            $this->redirect(array(
                'controller' => (!empty($this->request->params['named']['type'])) ? 'companies' : 'users',
                'action' => 'index',
                'admin' => true
            ));
        } else {
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'login'
            ));
        }
    }
    public function _facebook_login($id = null)
    {
        $this->loadModel('EmailTemplate');
        $me = $this->Session->read('fbuser');
        if(empty($me) || empty($me['id'])) {
            $this->Session->setFlash(__l('Problem in Facebook connect. Please try again') , 'default', null, 'error');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'login'
            ));
        }
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.fb_user_id' => $me['id']
            ) ,
            'fields' => array(
                'User.id',
                'User.email',
                'User.username',
                'User.password',
                'User.fb_user_id',
                'User.is_active',
                'User.user_type_id'
            ) ,
        ));
        if (!empty($id) && !empty($me['id'])) {
            if (!empty($user) && $user['User']['id'] != $this->Auth->user('id')) {
                $this->Session->setFlash(__l('An account already exists with this Facebook Login.') , 'default', null, 'error');
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login'
                ));
            }
            $this->User->updateAll(array(
                //'User.fb_access_token' => '\'' . $me['access_token'] . '\'',
                'User.fb_user_id' => '\'' . $me['id'] . '\'',
            ) , array(
                'User.id' => $this->Auth->user('id') ,
            ));
            $this->Session->setFlash(__l('Your profile has been updated') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'my_stuff',
                'admin' => false
            ));
        }
        $this->Auth->fields['username'] = 'username';
        //create new user
        if (empty($user)) {
            $this->User->create();
            $this->request->data['UserProfile']['first_name'] = !empty($me['first_name']) ? $me['first_name'] : '';
            $this->request->data['UserProfile']['last_name'] = !empty($me['last_name']) ? $me['last_name'] : '';
            $this->request->data['UserProfile']['gender_id'] = 2;
            if (empty($this->request->data['User']['username']) && strlen($me['first_name']) > 2) {
                $this->request->data['User']['username'] = $this->User->checkUsernameAvailable(strtolower($me['first_name']));
            }
            if (empty($this->request->data['User']['username']) && strlen($me['first_name'] . $me['last_name']) > 2) {
                $this->request->data['User']['username'] = $this->User->checkUsernameAvailable(strtolower($me['first_name'] . $me['last_name']));
            }
            if (empty($this->request->data['User']['username']) && strlen($me['first_name'] . $me['middle_name'] . $me['last_name']) > 2) {
                $this->request->data['User']['username'] = $this->User->checkUsernameAvailable(strtolower($me['first_name'] . $me['middle_name'] . $me['last_name']));
            }
            $this->request->data['User']['username'] = str_replace(' ', '', $this->request->data['User']['username']);
            $this->request->data['User']['username'] = str_replace('.', '_', $this->request->data['User']['username']);
            // A condtion to avoid unavilability of user username in our sites
            if (strlen($this->request->data['User']['username']) <= 2) {
                $this->request->data['User']['username'] = !empty($me['first_name']) ? str_replace(' ', '', strtolower($me['first_name'])) : 'fbuser';
                $i = 1;
                $created_user_name = $this->request->data['User']['username'] . $i;
                while (!$this->User->checkUsernameAvailable($created_user_name)) {
                    $created_user_name = $this->request->data['User']['username'] . $i++;
                }
                $this->request->data['User']['username'] = $created_user_name;
            }
            $this->request->data['User']['email'] = !empty($me['email']) ? $me['email'] : '';
            if (!empty($this->request->data['User']['email'])) {
                $check_user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.email' => $this->request->data['User']['email']
                    ) ,
                    'recursive' => - 1
                ));
                $this->request->data['User']['id'] = $check_user['User']['id'];
            }	
			
		
            $this->request->data['User']['password'] = $this->Auth->password($me['id'] . Configure::read('Security.salt'));
            if (!empty($check_user['User']['email'])) {
                $this->request->data['User']['email'] = $check_user['User']['email'];
                $this->request->data['User']['username'] = $check_user['User']['username'];
                $this->request->data['User']['password'] = $check_user['User']['password'];
            }
			////////////////////////Admin section Begins//////////////////////////////////////
			if (!empty($check_user['User']['user_type_id']) && $check_user['User']['user_type_id'] == ConstUserTypes::Admin) {
				$this->request->data['User']['user_type_id'] = ConstUserTypes::Admin;
				$this->request->data['User']['fb_user_id'] = $me['id'];
				$this->request->data['User']['fb_access_token'] = $me['access_token'];
				$this->User->save($this->request->data, false);


				if ($this->Auth->login($this->request->data)) {
					if ($redirectUrl = $this->Session->read('Auth.redirectUrl')) {
						$this->Session->delete('Auth.redirectUrl');
						$this->redirect(Router::url('/', true) . $redirectUrl);
					} else {
						$this->redirect(array(
						   'controller' => 'beauty_profiles',
						   'action' => 'quiz'
						));
					}
				}
			}
			////////////////////////Admin section ends//////////////////////////////////////
			
            $this->request->data['User']['fb_user_id'] = $me['id'];
            $this->request->data['User']['fb_access_token'] = $me['access_token'];
            $this->request->data['User']['is_agree_terms_conditions'] = '1';
            $this->request->data['User']['is_facebook_register'] = 1;
            $this->request->data['User']['is_email_confirmed'] = 1;
			$this->request->data['User']['user_type_id'] = ConstUserTypes::User;
            $this->request->data['User']['is_active'] = 1;
            $this->request->data['User']['signup_ip'] = $this->RequestHandler->getClientIP();
            $this->request->data['User']['dns'] = gethostbyaddr($this->RequestHandler->getClientIP());
            // Redirect to registeration for company users to fill other details //
            $user_type_check = $this->Session->read('user_type');
            if (!empty($user_type_check) && $user_type_check == 'company') {
                $temp['first_name'] = $this->request->data['UserProfile']['first_name'];
                $temp['last_name'] = $this->request->data['UserProfile']['last_name'];
                $temp['username'] = $this->request->data['User']['username'];
                $temp['fb_user_id'] = $this->request->data['User']['fb_user_id'];
                $temp['fb_access_token'] = $this->request->data['User']['fb_access_token'];
                $this->Session->write('fbuser', $temp);
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'register'
                ));
            }	
            $this->User->save($this->request->data, false);
            $this->request->data['UserProfile']['user_id'] = $this->User->id;
            $this->User->UserProfile->save($this->request->data);
            if ($this->Auth->login($this->request->data)) {
                  $this->Session->setFlash(__l('You have successfully registered with our site.') , 'default', null, 'success');
			      $this->_sendWelcomeMail($this->User->id, $this->request->data['User']['email'], $this->request->data['User']['username']);
                // send to admin mail if is_admin_mail_after_register is true
                if (Configure::read('user.is_admin_mail_after_register')) {
                    $email = $this->EmailTemplate->selectTemplate('New User Join');
                    $emailFindReplace = array(
                        '##SITE_LINK##' => Router::url('/', true) ,
                        '##USERNAME##' => $this->request->data['User']['username'],
                        '##SITE_NAME##' => Configure::read('site.name') ,
                        '##SIGNUP_IP##' => $this->RequestHandler->getClientIP() ,
                        '##EMAIL##' => $this->request->data['User']['email'],
                        '##CONTACT_URL##' => Router::url(array(
                            'controller' => 'contacts',
                            'action' => 'add',
                            'city' => $this->request->params['named']['city'],
                            'admin' => false
                        ) , true) ,
                        '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']) ,
                        '##SITE_LOGO##' => Router::url(array(
                            'controller' => 'img',
                            'action' => 'blue-theme',
                            'logo-email.png',
                            'admin' => false
                        ) , true) ,
                    );
                    // Send e-mail to users
                    $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
                    $this->Email->replyTo = ($email['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $email['reply_to'];
                    $this->Email->to = Configure::read('site.contact_email');
                    $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                    $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                    $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                }
                if ($redirectUrl = $this->Session->read('Auth.redirectUrl')) {
                    $this->Session->delete('Auth.redirectUrl');
                    $this->redirect(Router::url('/', true) . $redirectUrl);
                } else {
                    $this->redirect(array(
                          'controller' => 'beauty_profiles',
						 'action' => 'quiz'
                    ));
                }
            }
        } else {
            if (!$user['User']['is_active']) {
                $this->Session->setFlash(__l('Sorry, login failed.  Your account has been blocked') , 'default', null, 'error');
                $this->redirect(Router::url('/', true));
            }
            $this->request->data['User']['fb_user_id'] = $me['id'];
            $this->User->updateAll(array(
                'User.fb_access_token' => '\'' . $me['access_token'] . '\'',
                'User.fb_user_id' => '\'' . $me['id'] . '\'',
            ) , array(
                'User.id' => $user['User']['id']
            ));
            $this->request->data['User']['email'] = $user['User']['email'];
            $this->request->data['User']['username'] = $user['User']['username'];
            $this->request->data['User']['password'] = $user['User']['password'];
            if ($this->Auth->login($this->request->data)) {
                $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                if ($redirectUrl = $this->Session->read('Auth.redirectUrl')) {
                    $this->Session->delete('Auth.redirectUrl');
                    $this->redirect(Router::url('/', true) . $redirectUrl);
                } else {
                    if (!empty($user['User']['user_type_id']) && ($user['User']['user_type_id'] == ConstUserTypes::Company)) {
                        $this->redirect(array(
                            'controller' => 'companies',
                            'action' => 'dashboard',
                        ));
                    } else {
                        $this->redirect(array(
                            'controller' => 'beauty_profiles',
						    'action' => 'quiz'
                        ));
                    }
                }
            }
        }
    }
    public function login($username = null)
    {
        if (!is_null($username)) {
            $this->set('username', $username);
        }
        isset($this->request->params['named']['qty']) ? $temp['User']['qty'] = $this->request->params['named']['qty'] : $temp['User']['qty'] = '';
        isset($this->request->params['named']['id']) ? $temp['User']['deal_id'] = $this->request->params['named']['id'] : $temp['User']['deal_id'] = '';
        if (isset($this->request->params['named']['id']) && isset($this->request->params['named']['id'])) {
            $temp['User']['thru_login'] = '1';
            $this->Session->write('fbuser_pymnt', $temp);
        }
        if (!empty($this->request->data) && isset($this->request->data['User']['user_type'])) {
            $this->request->params['named']['user_type'] = $this->request->data['User']['user_type'];
        }
        $fb_sess_check = $this->Session->read('fbuser');
        if (empty($this->request->data) and Configure::read('facebook.is_enabled_facebook_connect') && !$this->Auth->user() && !empty($fb_sess_check) && !$this->Session->check('is_fab_session_cleared')) {
            $this->_facebook_login();
        }
        $this->pageTitle = __l('Login');
        
		// Facebook Login //
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'facebook' && Configure::read('facebook.is_enabled_facebook_connect')) {
            $fb_return_url = Router::url(array(
                'controller' => $this->request->params['named']['city'],
                'action' => 'users',
                'register',
                'admin' => false
            ) , true);
            $this->Session->write('fb_return_url', $fb_return_url);
            $this->redirect($this->facebook->getLoginUrl(array(
                'redirect_uri' => Router::url(array(
                    'controller' => 'users',
                    'action' => 'oauth_facebook',
                    'admin' => false
                ) , true) ,
                'scope' => 'email,publish_stream'
            )));
        }
        // OpenID validation setting
        if (!empty($this->request->data) && (isset($this->request->data['User']['openid']))) {
            $openidSubmit = 1;
        }
        // yahoo Login //
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'yahoo' && Configure::read('user.is_enable_yahoo_openid')) {
            $this->request->data['User']['email'] = '';
            $this->request->data['User']['password'] = '';
            $this->request->data['User']['redirect_page'] = 'login';
            $this->request->data['User']['openid'] = 'http://yahoo.com/';
            $this->_openid();
        }
        // gmail Login //
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'gmail' && Configure::read('user.is_enable_gmail_openid')) {
            $this->request->data['User']['email'] = '';
            $this->request->data['User']['password'] = '';
            $this->request->data['User']['redirect_page'] = 'login';
            $this->request->data['User']['openid'] = 'https://www.google.com/accounts/o8/id';
            $this->_openid();
        }
        // handle the fields return from openid
        if (!empty($_GET['openid_identity']) && (Configure::read('user.is_enable_openid') || Configure::read('user.is_enable_gmail_openid') || Configure::read('user.is_enable_yahoo_openid'))) {
            $returnTo = Router::url(array(
                'controller' => 'users',
                'action' => 'login'
            ) , true);
            $response = $this->Openid->getResponse($returnTo);
            if ($response->status == Auth_OpenID_SUCCESS) {
                // Required Fields
                if ($user = $this->User->UserOpenid->find('first', array(
                    'conditions' => array(
                        'UserOpenid.openid' => $response->identity_url
                    )
                ))) {
                    //Already existing user need to do auto login
                    $this->request->data['User']['email'] = $user['User']['email'];
                    $this->request->data['User']['username'] = $user['User']['username'];
                    $this->request->data['User']['password'] = $user['User']['password'];
                    if ($this->Auth->login($this->request->data)) {
                        $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                        if ($redirectUrl = $this->Session->read('Auth.redirectUrl')) {
                            $this->Session->delete('Auth.redirectUrl');
                            $this->redirect(Router::url('/', true) . $redirectUrl);
                        } else {
                                $this->redirect(array(
                                    'controller' => 'pages',
                                    'action' => 'home'
                                ));
                        }
                    } else {
                        $this->Session->setFlash($this->Auth->loginError, 'default', null, 'error');
                        $this->redirect(array(
                            'controller' => 'users',
                            'action' => 'login'
                        ));
                    }
                } else {
                    $sregResponse = Auth_OpenID_SRegResponse::fromSuccessResponse($response);
                    $sreg = $sregResponse->contents();
                    $temp['username'] = isset($sreg['nickname']) ? $sreg['nickname'] : '';
                    $temp['email'] = isset($sreg['email']) ? $sreg['email'] : '';
                    $temp['openid_url'] = $response->identity_url;
                    $respone_url = $response->identity_url;
                    $respone_url = parse_url($respone_url);
                    if (!empty($respone_url['host']) && $respone_url['host'] == 'www.google.com') {
                        $temp['is_gmail_register'] = 1;
                    }
                    $this->Session->write('openid', $temp);
                    $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'register'
                    ));
                }
            } else {
                $this->Session->setFlash(__l('Authenticated failed or you may not have profile in your OpenID account'));
            }
        }
        // check open id is given or not
        if ((Configure::read('user.is_enable_openid') || Configure::read('user.is_enable_gmail_openid') || Configure::read('user.is_enable_yahoo_openid')) && isset($this->request->data['User']['openid'])) {
            // Fix for given both email and openid url in login page....@todo
            $this->Auth->logout();
            $this->request->data['User']['email'] = '';
            $this->request->data['User']['password'] = '';
            $this->request->data['User']['redirect_page'] = 'login';
            $this->_openid();
        } else {
            // remember me for user
            if (!empty($this->request->data)) {
                $this->request->data['User'][Configure::read('user.using_to_login') ] = trim($this->request->data['User'][Configure::read('user.using_to_login') ]);
                //Important: For login unique username or email check validation not necessary. Also in login method authentication done before validation.
                unset($this->User->validate[Configure::read('user.using_to_login') ]['rule3']);
                $this->User->set($this->request->data);
                if ($this->User->validates()) {
                    $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['passwd']);
                    if ($this->Auth->login($this->request->data)) {
                        $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                        if ($this->Auth->user()) {
                            $this->Session->write('is_normal_login', 1); // fix for user can login with facebook or normal with same account.
                            if (!empty($this->request->data['User']['is_remember']) and $this->request->data['User']['is_remember'] == 1) {
                                $this->Cookie->delete('User');
                                $cookie = array();
                                $remember_hash = md5($this->request->data['User'][Configure::read('user.using_to_login') ] . $this->request->data['User']['password'] . Configure::read('Security.salt'));
                                $cookie['cookie_hash'] = $remember_hash;
                                $this->Cookie->write('User', $cookie, true, $this->cookieTerm);
                                $this->User->updateAll(array(
                                    'User.cookie_hash' => '\'' . md5($remember_hash) . '\'',
                                    'User.cookie_time_modified' => '\'' . date('Y-m-d h:i:s') . '\'',
                                ) , array(
                                    'User.id' => $this->Auth->user('id')
                                ));
                            } else {
                                $this->Cookie->delete('User');
                            }
                            if ($this->RequestHandler->isAjax()) {
                                if (!empty($this->request->data['User']['f'])) {
                                    echo 'redirect*' . Router::url('/', true) . $this->request->data['User']['f'];
                                } else {
									if($this->layoutPath == 'touch')
									{
										$this->redirect(array(
											'controller' => 'pages',
											'action' => 'display',
											'main-menu',
											'admin' => false
										));
									} else {
                                    	echo 'success';
									}	
                                }
                                exit;
                            } else if (!empty($this->request->data['User']['f'])) {
                            
                                    $this->redirect(Router::url('/', true) . $this->request->data['User']['f']);
                             
                            } else if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin)  {
                                $this->redirect(array(
                                    'controller' => 'users',
                                    'action' => 'stats',
                                    'admin' => true
                                ));
                            } else if ($this->Auth->user('user_type_id') == ConstUserTypes::ContentAdmin)  {
                                $this->redirect(array(
                                    'controller' => 'brands',
                                    'action' => 'index',
                                    'admin' => true
                                ));
                            } elseif ($this->Auth->user('user_type_id') == ConstUserTypes::User) {
                                if($this->layoutPath == 'touch')
									{
										$this->redirect(array(
											'controller' => 'pages',
											'action' => 'display',
											'main-menu',
											'admin' => false
										));
									}else{
									$this->redirect(array(
										'controller' => 'pages',
										'action' => 'home',
										'admin' => false
									));
								}
                            } 
                        }
                    } else {
                        if (!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
                            $this->Session->setFlash(sprintf(__l('Sorry, login failed.  Your %s or password are incorrect') , Configure::read('user.using_to_login')) , 'default', null, 'error');
                        } else {
                            $this->Session->setFlash($this->Auth->loginError, 'default', null, 'error');
                        }
                    }
                } else {
                    $this->Session->setFlash($this->Auth->loginError, 'default', null, 'error');
                }
            } else {
                if (!empty($this->request->params['named']['f'])) {
                    $this->request->data['User']['f'] = $this->request->params['named']['f'];
                }
                
            }
        }
        //When already logged user trying to access the login page we are redirecting to site home page
        if ($this->Auth->user()) {
            $this->redirect(Router::url('/', true));
        }
        $this->request->data['User']['passwd'] = '';
		if ($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('login_popup');
		}
    }
	public function fs_oauth_callback()
    {
        $this->autoRender = false;
        // Fix to avoid the mail validtion for  Twitter
        $redirect_uri = Router::url(array(
                'controller' => 'users',
                'action' => 'fs_oauth_callback',               
                'admin' => false
         ) , true);	

		$client_key = Configure::read('foursquare.consumer_key');
		$client_secret = Configure::read('foursquare.consumer_secret');
		
		include APP.DS.'vendors'.DS.'foursquare'.DS.'FoursquareAPI.class.php';
		// Load the Foursquare API library
		$foursquare = new FoursquareAPI($client_key,$client_secret);
		if(array_key_exists("code",$_GET)){
			$token = $foursquare->GetToken($_GET['code'],$redirect_uri);
			$foursquare->SetAccessToken($token);
			$user =  $foursquare->GetMyDetail('users/self');
			$user = json_decode($user);	
			//print_r($user->response->user);	        	
			$fs_user_id  = $user->response->user->id;
			$fs_user_firstName  = $user->response->user->firstName;
			$fs_user_lastname  = $user->response->user->last;
			$fs_user_email  = $user->response->user->contact->email;
			
			$data['User']['name'] = $fs_user_firstName . $fs_user_lastname;

			$this->request->data['User']['foursquare_access_token'] = (isset($token)) ? $token : '';
			$this->request->data['User']['foursquare_user_id'] = (isset($fs_user_id)) ? $fs_user_id : '';
			// So this to check whether it is  admin login to get its foursquare acces tocken
			if ($this->Auth->user('id') and $this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
				App::import('Model', 'Setting');
				$setting = new Setting;
				$setting->updateAll(array(
					'Setting.value' => "'" . $this->request->data['User']['foursquare_access_token'] . "'",
				) , array(
					'Setting.name' => 'foursquare.site_user_access_token'
				));
				$setting->updateAll(array(
					'Setting.value' => "'" . $this->request->data['User']['foursquare_user_id'] . "'"
				) , array(
					'Setting.name' => 'foursquare.site_user_fs_id'
				));
				$this->Session->setFlash(__l('Your Foursquare credentials are updated') , 'default', null, 'success');
				$this->redirect(array(
					'controller' => 'settings',
					'admin' => true
				));
			}
			if ($this->Auth->user('id')) {
				$check_foursquare_user = $this->User->find('first', array(
					'conditions' => array(
						'User.foursquare_user_id' => $this->request->data['User']['foursquare_user_id']
					) ,
					'recursive' => - 1
				));
				if (!empty($check_foursquare_user) && $check_foursquare_user['User']['id'] != $this->Auth->user('id')) {
					$this->Session->setFlash(__l('An account already exists with this Foursquare Login.') , 'default', null, 'error');
					$this->redirect(array(
						'controller' => 'users',
						'action' => 'login'
					));
				}
				$this->User->updateAll(array(
					'User.foursquare_user_id' => "'" . $this->request->data['User']['foursquare_user_id'] . "'",
					'User.foursquare_access_token' => "'" . $this->request->data['User']['foursquare_access_token'] . "'",
				) , array(
					'User.id' => $this->Auth->user('id') ,
				));
				$this->Session->setFlash(__l('Your profile has been updated') , 'default', null, 'success');
				$this->redirect(array(
					'controller' => 'users',
					'action' => 'my_stuff',
					'admin' => false
				));
			}
			$user = $this->User->find('first', array(
				'conditions' => array(
					'User.foursquare_user_id =' => $this->request->data['User']['foursquare_user_id']
				) ,
				'fields' => array(
					'User.id',
					'UserProfile.id',
					'User.user_type_id',
					'User.username',
					'User.email',
				) ,
				'recursive' => 0
			));
			if (empty($user)) {
				// Foursquare modified registration: Prompts for email after regisration. Redirects to register method //
				$user_type_check = $this->Session->read('user_type');
				if (!empty($user_type_check) && $user_type_check == 'company') {
					$temp['first_name'] = !empty($fs_user_firstName) ? $fs_user_firstName : '';
					$temp['last_name'] = !empty($fs_user_lastName) ? $fs_user_lastName : '';
					$temp['username'] = $this->genreteFSName($data); // Foursquare modified registration: Generate autoname from this method //
					$temp['foursquare_user_id'] = !empty($fs_user_id) ? $fs_user_id : '';
					$temp['email'] = !empty($fs_user_email) ? $fs_user_email : '';
					$temp['foursquare_access_token'] = (isset($token)) ? $token : '';
					$this->Session->write('fsuser', $temp);
					$this->redirect(array(
						'controller' => 'users',
						'action' => 'register'
					));
				}
				$this->request->data['User']['email'] = $fs_user_email;
				$this->request->data['User']['is_foursquare_register'] = 1;
				$this->request->data['User']['is_email_confirmed'] = 1;
				$this->request->data['User']['is_active'] = 1;
				$this->request->data['User']['is_agree_terms_conditions'] = '1';
				$this->request->data['User']['user_type_id'] = ConstUserTypes::User;
				$this->request->data['User']['signup_ip'] = $this->RequestHandler->getClientIP();
				$this->request->data['User']['pin'] = ($fs_user_id + Configure::read('user.pin_formula')) % 10000;
				$this->request->data['User']['foursquare_user_id'] = $fs_user_id;
				$this->request->data['User']['foursquare_access_token'] = $token;
				$created_user_name = $this->User->checkUsernameAvailable($data['User']['name']);
				if (strlen($created_user_name) <= 2) {
					$this->request->data['User']['username'] = !empty($data['User']['name']) ? $data['User']['name'] : 'fsuser';
					$i = 1;
					$created_user_name = $this->request->data['User']['username'] . $i;
					while (!$this->User->checkUsernameAvailable($created_user_name)) {
						$created_user_name = $this->request->data['User']['username'] . $i++;
					}
				}
				$this->request->data['User']['username'] = $created_user_name;
				
				if (!empty($this->request->data['User']['email'])) {
					$check_user = $this->User->find('first', array(
						'conditions' => array(
							'User.email' => $this->request->data['User']['email']
						) ,
						'recursive' => - 1
					));
					$this->request->data['User']['id'] = $check_user['User']['id'];
				}
				if (!empty($check_user['User']['email'])) {
					$this->request->data['User']['email'] = $check_user['User']['email'];
					$this->request->data['User']['username'] = $check_user['User']['username'];
					$this->request->data['User']['password'] = $check_user['User']['password'];
				}
				////////////////////////Admin section Begins//////////////////////////////////////
				if (!empty($check_user['User']['user_type_id']) && $check_user['User']['user_type_id'] == ConstUserTypes::Admin) {
					$this->request->data['User']['user_type_id'] = ConstUserTypes::Admin;
					$this->request->data['User']['foursquare_user_id'] = $fs_user_id;
					$this->request->data['User']['foursquare_access_token'] = $token;
					$this->User->save($this->request->data, false);
					if ($this->Auth->login($this->request->data)) {
						if ($redirectUrl = $this->Session->read('Auth.redirectUrl')) {
							$this->Session->delete('Auth.redirectUrl');
							$this->redirect(Router::url('/', true) . $redirectUrl);
						} else {
							$this->redirect(array(
								'controller' => 'pages',
								'action' => 'home',
							));
						}
					}
				}
				////////////////////////Admin section ends//////////////////////////////////////
			} else {
				$this->request->data['User']['id'] = $user['User']['id'];
				$this->request->data['User']['username'] = $user['User']['username'];
			}
			unset($this->User->validate['username']['rule2']);
			unset($this->User->validate['username']['rule3']);
			$this->request->data['User']['password'] = $this->Auth->password($data['User']['id'] . Configure::read('Security.salt'));
			//$this->request->data['User']['twitter_url'] = (isset($data['User']['url'])) ? $data['User']['url'] : '';
			$this->request->data['User']['description'] = (isset($data['User']['description'])) ? $data['User']['description'] : '';
			$this->request->data['User']['location'] = (isset($data['User']['location'])) ? $data['User']['location'] : '';
			// Affiliate Changes ( //
			if ((Configure::read('referral.referral_enabled_option') == ConstReferralOption::GrouponLikeRefer)) {
				//user id will be set in cookie
				$cookie_value = $this->Cookie->read('referrer');
				if (!empty($cookie_value)) {
					$this->request->data['User']['referred_by_user_id'] = $cookie_value['refer_id'];
				}
			}
			// Affiliate Changes ) //
			if ($this->User->save($this->request->data, false)) {
				$cookie_value = $this->Cookie->read('referrer');
				if (!empty($cookie_value) && (!Configure::read('affiliate.is_enabled'))) {
					$this->Cookie->delete('referrer'); // Delete referer cookie
					
				}
				if ($this->Auth->login($this->request->data)) {
					$this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
					if (!empty($user['User']['user_type_id']) && ($user['User']['user_type_id'] == ConstUserTypes::Company)) {
						$this->redirect(array(
							'controller' => 'companies',
							'action' => 'dashboard',
						));
					} else {
						$this->redirect(array(
							'controller' => 'pages',
							'action' => 'home',
						));
					}
				}
			}
			$this->redirect(Router::url('/', true));
		}
	
    }
    public function oauth_callback()
    {
        App::import('Xml');
        $this->autoRender = false;
        // Fix to avoid the mail validtion for  Twitter
        $this->Auth->fields['username'] = 'username';
        $requestToken = $this->Session->read('requestToken');
        $requestToken = unserialize($requestToken);
        $accessToken = $this->OauthConsumer->getAccessToken('Twitter', 'https://api.twitter.com/oauth/access_token', $requestToken);
        $this->Session->write('accessToken', $accessToken);
        $oauth_xml = $this->OauthConsumer->get('Twitter', $accessToken->key, $accessToken->secret, 'https://twitter.com/account/verify_credentials.xml');
        $this->request->data['User']['twitter_access_token'] = (isset($accessToken->key)) ? $accessToken->key : '';
        $this->request->data['User']['twitter_access_key'] = (isset($accessToken->secret)) ? $accessToken->secret : '';
		$data = Xml::toArray(Xml::build($oauth_xml['body']));
		// Modifying array index for existing code //
		$data['User'] = $data['user'];
		unset($data['user']);
		if(empty($data['User']['id'])){
			$this->Session->setFlash(__l('Problem in Twitter connect. Please try again') , 'default', null, 'error');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'login'
            ));
		}
        // So this to check whether it is  admin login to get its twiiter acces tocken
        if ($this->Auth->user('id') and $this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
            App::import('Model', 'Setting');
            $setting = new Setting;
            $setting->updateAll(array(
                'Setting.value' => "'" . $this->request->data['User']['twitter_access_token'] . "'",
            ) , array(
                'Setting.name' => 'twitter.site_user_access_token'
            ));
            $setting->updateAll(array(
                'Setting.value' => "'" . $this->request->data['User']['twitter_access_key'] . "'"
            ) , array(
                'Setting.name' => 'twitter.site_user_access_key'
            ));
            $this->Session->setFlash(__l('Your Twitter credentials are updated') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'settings',
                'admin' => true
            ));
        }
		if ($this->Auth->user('id')) {
            $check_twitter_user = $this->User->find('first', array(
                'conditions' => array(
                    'User.twitter_user_id' => $data['User']['id']
                ) ,
                'recursive' => - 1
            ));
            if (!empty($check_twitter_user) && $check_twitter_user['User']['id'] != $this->Auth->user('id')) {
                $this->Session->setFlash(__l('An account already exists with this Twitter Login.') , 'default', null, 'error');
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login'
                ));
            }
            $this->User->updateAll(array(
                'User.twitter_user_id' => "'" . $data['User']['id'] . "'",
                'User.twitter_access_token' => "'" . $this->request->data['User']['twitter_access_token'] . "'",
                'User.twitter_access_key' => "'" . $this->request->data['User']['twitter_access_key'] . "'",
                'User.twitter_avatar_url' => "'" . $data['User']['profile_image_url'] . "'",
            ) , array(
                'User.id' => $this->Auth->user('id') ,
            ));
            $this->Session->setFlash(__l('Your profile has been updated') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'my_stuff',
                'admin' => false
            ));
        }
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.twitter_user_id =' => $data['User']['id']
            ) ,
            'fields' => array(
                'User.id',
                'UserProfile.id',
                'User.user_type_id',
                'User.username',
                'User.email',
            ) ,
            'recursive' => 0
        ));
        if (empty($user)) {
            // Twitter modified registration: Prompts for email after regisration. Redirects to register method //
            $user_type_check = $this->Session->read('user_type');
            if (!empty($user_type_check) && $user_type_check == 'company') {
                $temp['first_name'] = !empty($data['User']['name']) ? $data['User']['name'] : '';
                $temp['last_name'] = !empty($data['User']['name']) ? $data['User']['name'] : '';
                $temp['username'] = $this->genreteTWName($data); // Twitter modified registration: Generate autoname from this method //
                $temp['twitter_user_id'] = !empty($data['User']['id']) ? $data['User']['id'] : '';
                $temp['twitter_access_token'] = (isset($accessToken->key)) ? $accessToken->key : '';
                $temp['twitter_access_key'] = (isset($accessToken->secret)) ? $accessToken->secret : '';
                $temp['profile_image_url'] = $data['User']['profile_image_url'];
                $this->Session->write('twuser', $temp);
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'register'
                ));
            }
            if (Configure::read('twitter.prompt_for_email_after_register')) {
                $temp['first_name'] = !empty($data['User']['name']) ? $data['User']['name'] : '';
                $temp['last_name'] = !empty($data['User']['name']) ? $data['User']['name'] : '';
                $temp['username'] = $this->genreteTWName($data); // Twitter modified registration: Generate autoname from this method //
                $temp['twitter_user_id'] = !empty($data['User']['id']) ? $data['User']['id'] : '';
                $temp['twitter_access_token'] = (isset($accessToken->key)) ? $accessToken->key : '';
                $temp['twitter_access_key'] = (isset($accessToken->secret)) ? $accessToken->secret : '';
                $temp['profile_image_url'] = $data['User']['profile_image_url'];
				$this->Session->write('twuser', $temp);
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'register'
                ));
            } else {
                $this->request->data['User']['is_twitter_register'] = 1;
                $this->request->data['User']['is_email_confirmed'] = 1;
                $this->request->data['User']['is_active'] = 1;
                $this->request->data['User']['is_agree_terms_conditions'] = '1';
                $this->request->data['User']['user_type_id'] = ConstUserTypes::User;
                $this->request->data['User']['signup_ip'] = $this->RequestHandler->getClientIP();
                $this->request->data['User']['pin'] = ($data['User']['id'] + Configure::read('user.pin_formula')) % 10000;
                $this->request->data['User']['twitter_user_id'] = $data['User']['id'];
                $this->request->data['User']['twitter_avatar_url'] = $data['User']['profile_image_url'];
                $created_user_name = $this->User->checkUsernameAvailable($data['User']['screen_name']);
                if (strlen($created_user_name) <= 2) {
                    $this->request->data['User']['username'] = !empty($data['User']['screen_name']) ? $data['User']['screen_name'] : 'twuser';
                    $i = 1;
                    $created_user_name = $this->request->data['User']['username'] . $i;
                    while (!$this->User->checkUsernameAvailable($created_user_name)) {
                        $created_user_name = $this->request->data['User']['username'] . $i++;
                    }
                }
                $this->request->data['User']['username'] = $created_user_name;
            }
        } else {
            $this->request->data['User']['id'] = $user['User']['id'];
            $this->request->data['User']['username'] = $user['User']['username'];
        }
        unset($this->User->validate['username']['rule2']);
        unset($this->User->validate['username']['rule3']);
        $this->request->data['User']['password'] = $this->Auth->password($data['User']['id'] . Configure::read('Security.salt'));
        $this->request->data['User']['avatar_url'] = $data['User']['profile_image_url'];
        $this->request->data['User']['twitter_url'] = (isset($data['User']['url'])) ? $data['User']['url'] : '';
        $this->request->data['User']['description'] = (isset($data['User']['description'])) ? $data['User']['description'] : '';
        $this->request->data['User']['location'] = (isset($data['User']['location'])) ? $data['User']['location'] : '';
        // Affiliate Changes ( //
        if ((Configure::read('referral.referral_enabled_option') == ConstReferralOption::GrouponLikeRefer)) {
            //user id will be set in cookie
            $cookie_value = $this->Cookie->read('referrer');
            if (!empty($cookie_value)) {
                $this->request->data['User']['referred_by_user_id'] = $cookie_value['refer_id'];
            }
        }
        // Affiliate Changes ) //
        if ($this->User->save($this->request->data, false)) {
            $cookie_value = $this->Cookie->read('referrer');
            if (!empty($cookie_value) && (!Configure::read('affiliate.is_enabled'))) {
                $this->Cookie->delete('referrer'); // Delete referer cookie
                
            }
            if ($this->Auth->login($this->request->data)) {
                $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                if (!empty($user['User']['user_type_id']) && ($user['User']['user_type_id'] == ConstUserTypes::Company)) {
                    $this->redirect(array(
                        'controller' => 'companies',
                        'action' => 'dashboard',
                    ));
                } else {
                    $this->redirect(array(
                        'controller' => 'pages',
                        'action' => 'home',
                    ));
                }
            }
        }
        if (!empty($this->request->data['User']['f'])) {
            $this->redirect(Router::url('/', true) . $this->request->data['User']['f']);
        }
        $this->redirect(Router::url('/', true));
    }
    // Twitter modified registration: Generate autoname from this method //
    public function genreteTWName($data)
    {
        $created_user_name = $this->User->checkUsernameAvailable($data['User']['screen_name']);
        if (strlen($created_user_name) <= 2) {
            $this->request->data['User']['username'] = !empty($data['User']['screen_name']) ? $data['User']['screen_name'] : 'twuser';
            $i = 1;
            $created_user_name = $this->request->data['User']['username'] . $i;
            while (!$this->User->checkUsernameAvailable($created_user_name)) {
                $created_user_name = $this->request->data['User']['username'] . $i++;
            }
        }
        return $created_user_name;
    }
    public function genreteFSName($data)
    {
        $created_user_name = $this->User->checkUsernameAvailable($data['User']['name']);
        if (strlen($created_user_name) <= 2) {
            $this->request->data['User']['username'] = !empty($data['User']['name']) ? $data['User']['name'] : 'fsuser';
            $i = 1;
            $created_user_name = $this->request->data['User']['username'] . $i;
            while (!$this->User->checkUsernameAvailable($created_user_name)) {
                $created_user_name = $this->request->data['User']['username'] . $i++;
            }
        }
        return $created_user_name;
    }
	public function refer()
    {
        $cookie_value = $this->Cookie->read('referrer');
        $user_refername = '';
        if (!empty($this->request->params['named']['r'])) {
            $user_refername = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => $this->request->params['named']['r']
                ) ,
                'recursive' => - 1
            ));
            if (empty($user_refername)) {
                $this->Session->setFlash(__l('Referrer username does not exist.') , 'default', null, 'error');
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'register'
                ));
            }
        }
        //cookie value should be empty or same user id should not be over written
        if (!empty($user_refername) && (empty($cookie_value) || (!empty($cookie_value) && (!empty($user_refername)) && ($cookie_value['refer_id'] != $user_refername['User']['id'])))) {
		   $this->Cookie->delete('referrer');
            $referrer['refer_id'] = $user_refername['User']['id'];
             if (Configure::read('referral.is_referral_system_enabled')) {
                $this->Cookie->write('referrer', $referrer, false, sprintf('+%s hours', Configure::read('referral.referral_cookie_expire_time')));
            }
            $cookie_value = $this->Cookie->read('referrer');
        }
        $this->redirect(array(
            'controller' => 'users',
            'action' => 'register'
        ));
    }
    public function logout()
    {
        if ($this->Auth->user('fb_user_id')) {
            //$this->facebook->setSession(); // Quick fix for facebook redirect loop issue.
            $this->Session->write('is_fab_session_cleared', 1); // Quick fix for facebook redirect loop issue.
            $this->Session->delete('fbuser'); // Quick fix for facebook redirect loop issue.
            
        }
        $this->Session->delete('is_normal_login');
        $this->Auth->logout();
        $this->Cookie->delete('User');
        $this->Cookie->delete('user_language');
        $this->Session->setFlash(__l('You are now logged out of the site.') , 'default', null, 'success');
        $this->Session->delete('fbuser_pymnt');
        $redirect_url = array(
            'controller' => 'users',
            'action' => 'login'
        );
        if (!empty($this->request->params['named']['city'])) {
            $redirect_url['city'] = $this->request->params['named']['city'];
        }
        $this->redirect($redirect_url);
    }
	public function admin_member_index(){

        if ($this->RequestHandler->prefers('pdf')) {
		$users = $this->User->find('all',array(
			'conditions'=> array(
				'User.is_verified_user'=> 1,
				'User.subscription_expire_date >' => _formatDate('Y-m-d', date('Y-m-d') , true) ,
				//'User.user_type_id <>' =>ConstUserTypes::Admin
			),
			'contain'=> array(
				'UserProfile'=> array(
					'fields'=> array(
						'UserProfile.first_name',
					)
				),
			   'UserShipping'=> array(
					'State'=> array(
						'fields'=> array(
							'State.name'
						)
					),
					'Country'=> array(
						'fields'=> array(
							'Country.name'
						)
					)
				),
			),
			'fields'=> array(
				'User.email',
				'User.is_verified_user',
				'User.subscription_expire_date',
			)
		));
		} else {
	      $this->paginate = array(
			'conditions'=> array(
				'User.is_verified_user'=> 1,
				'User.subscription_expire_date >' => _formatDate('Y-m-d', date('Y-m-d') , true) ,
			//	'User.user_type_id <>' =>ConstUserTypes::Admin
			),
			'contain'=> array(
				'UserProfile'=> array(
					'fields'=> array(
						'UserProfile.first_name',
					)
				),
			   'UserShipping'=> array(
					'State'=> array(
						'fields'=> array(
							'State.name'
						)
					),
					'Country'=> array(
						'fields'=> array(
							'Country.name'
						)
					)
				),
			),
			'fields'=> array(
				'User.email',
				'User.is_verified_user',
				'User.subscription_expire_date',
			)
        );
	 $users = $this->paginate();
	}
	 $this->set('users',$users);
	}
    public function forgot_password()
    {
        $this->pageTitle = __l('Forgot Password');
        $this->loadModel('EmailTemplate');
        if ($this->Auth->user('id')) {
            $this->redirect(Router::url('/', true));
        }
        if (!empty($this->request->data)) {
            $this->User->set($this->request->data);
            //Important: For forgot password unique email id check validation not necessary.
            unset($this->User->validate['email']['rule3']);
            if ($this->User->validates()) {
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.email =' => $this->request->data['User']['email'],
                        'User.is_active' => 1
                    ) ,
                    'fields' => array(
                        'User.id',
                        'User.email'
                    ) ,
                    'contain' => array(
                        'UserProfile'
                    ) ,
                    'recursive' => 1
                ));
                if (!empty($user['User']['email'])) {
                    $user = $this->User->find('first', array(
                        'conditions' => array(
                            'User.email' => $user['User']['email']
                        ) ,
                        'recursive' => - 1
                    ));
                    $language_code = $this->User->getUserLanguageIso($user['User']['id']);
                    $email = $this->EmailTemplate->selectTemplate('Forgot Password', $language_code);
                    $emailFindReplace = array(
                        '##SITE_LINK##' => Router::url('/', true) ,
                        '##USERNAME##' => (isset($user['User']['username'])) ? $user['User']['username'] : '',
                        '##SITE_NAME##' => Configure::read('site.name') ,
                        '##SUPPORT_EMAIL##' => Configure::read('site.contact_email') ,
                        '##RESET_URL##' => Router::url(array(
                            'controller' => 'users',
                            'action' => 'reset',
                            $user['User']['id'],
                            $this->User->getResetPasswordHash($user['User']['id'])
                        ) , true) ,
                        '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']) ,
                        '##CONTACT_URL##' => Router::url(array(
                            'controller' => 'contacts',
                            'action' => 'add',
                            'city' => $this->request->params['named']['city'],
                            'admin' => false
                        ) , true) ,
                        '##SITE_LOGO##' => Router::url(array(
                            'controller' => 'img',
                            'action' => 'blue-theme',
                            'logo-email.png',
                            'admin' => false
                        ) , true) ,
                    );
                    $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
                    $this->Email->replyTo = ($email['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $email['reply_to'];
                    $this->Email->to = $this->User->formatToAddress($user);
                    $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                    $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                    $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                    $this->Session->setFlash(__l('An email has been sent with a link where you can change your password') , 'default', null, 'success');
                    $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'login'
                    ));
                } else {
                    $this->Session->setFlash(sprintf(__l('There is no user registered with the email %s or admin deactivated your account. If you spelled the address incorrectly or entered the wrong address, please try again.') , $this->request->data['User']['email']) , 'default', null, 'error');
                }
            } else {
                $this->Session->setFlash(__l('Please Enter valid Email id') , 'default', null, 'error');
            }
        }
    }
    public function reset($user_id = null, $hash = null)
    {
        $this->pageTitle = __l('Reset Password');
        if (!empty($this->request->data)) {
            if ($this->User->isValidResetPasswordHash($this->request->data['User']['user_id'], $this->request->data['User']['hash'])) {
                $this->User->set($this->request->data);
                if ($this->User->validates()) {
                    $this->User->updateAll(array(
                        'User.password' => '\'' . $this->Auth->password($this->request->data['User']['passwd']) . '\'',
                    ) , array(
                        'User.id' => $this->request->data['User']['user_id']
                    ));
                    $this->Session->setFlash(__l('Your password changed successfully, Please login now') , 'default', null, 'success');
                    $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'login'
                    ));
                }
                $this->Session->setFlash(__l('Could not update your password, please enter password.') , 'default', null, 'error');
                $this->request->data['User']['passwd'] = '';
                $this->request->data['User']['confirm_password'] = '';
            } else {
                $this->Session->setFlash(__l('Invalid change password request'));
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login'
                ));
            }
        } else {
            if (is_null($user_id) or is_null($hash)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $user_id,
                    'User.is_active' => 1,
                ) ,
                'recursive' => - 1
            ));
            if (empty($user)) {
                $this->Session->setFlash(__l('User cannot be found in server or admin deactivated your account, please register again'));
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'register'
                ));
            }
            if (!$this->User->isValidResetPasswordHash($user_id, $hash)) {
                $this->Session->setFlash(__l('Invalid change password request'));
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login'
                ));
            }
            $this->request->data['User']['user_id'] = $user_id;
            $this->request->data['User']['hash'] = $hash;
        }
    }
	public function redemption(){
			 if (!Configure::read('wonderpoint.is_system_enabled')) {
				throw new NotFoundException(__l('Invalid request'));
			 }
			$user = $this->User->find('first',array(
								'conditions'=> array(
									'User.id'=>$this->Auth->user('id')
								),
								'fields'=> array(
									'User.available_wonder_points',
								),
								'recursive'=> -1	
					)
				);
			$available_wonderpoint =  $user['User']['available_wonder_points'];
		 	$this->loadModel('Package');
			 if (!empty($this->request->data)) {
					$package = $this->Package->find('first',array(
									'conditions'=> array(
										'Package.id'=> $this->request->data['User']['package_type_id'],

									),
									'contain'=> array(
										'PackageType' => array(
											'fields'=> array(
												'PackageType.no_of_months'
											)
										)
									),									
									'recursive'=> 1
						));
					
					$wonderpoint = Configure::read('wonderpoint.no_of_wonderpoints')* $package['PackageType']['no_of_months']; 
					$this->loadModel('Transaction');
					$amount = $package['Package']['cost'];
					$user_id = $this->Auth->user('id');
					$data['Transaction']['user_id'] = $user_id;
					$data['Transaction']['foreign_id'] = $package['Package']['id'];
					$data['Transaction']['class'] = 'Package';
					$data['Transaction']['amount'] = $package['Package']['cost'];
					$data['Transaction']['payment_gateway_id'] = ConstPaymentGateways::WonderPoint;
					$data['Transaction']['description'] = 'Payment Success';
					$data['Transaction']['gateway_fees'] = 0;
					$data['Transaction']['transaction_type_id'] = ConstTransactionTypes::PaidlAmountToCompany;
					$transaction_id = $this->Transaction->log($data);
					$duration = $this->getDurationPeriod($package['PackageType']['no_of_months'],$user_id);
					$this->Package->PackageUser->savePackageUser($package['PackageType']['no_of_months'],$user_id,$package['Package']['id'],0);
						
			        $this->User->updateAll(array(
										'User.is_verified_user' => 1,
										'User.available_wonder_points' => 'User.available_wonder_points - '. $wonderpoint,
										'User.subscription_expire_date' => $duration['end_date'],
									) , array(
										'User.id' => $user_id
					));
					$this->loadModel('EmailTemplate');
					$email_message = $this->EmailTemplate->selectTemplate('Subscription Package');
					$emailFindReplace = array(
										'##FROM_EMAIL##' => ($email_message['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email_message['from'] ,
										'##SITE_NAME##' => Configure::read('site.name') ,
										'##USERNAME##' => $user['User']['username'],
										'##PACKAGE_NAME##' => $package['Package']['name']  ,
										'##PACKAGE_AMOUNT##' => Configure::read('site.currency') . $amount ,
										'##SITE_LINK##' => Router::url('/', true) ,
										'##PURCHASE_ON##' => strftime(Configure::read('site.datetime.format')) ,
										'##PURCHASE_EXPIRY##' => $duration['end_date'] ,
										'##WONDER_POINT##' => 'None' ,
										'##CONTACT_URL##' => Router::url(array(
											'controller' => 'contacts',
											'action' => 'add',
											'city' => $this->request->params['named']['city'],
											'admin' => false
										) , true) ,
										'##SITE_LOGO##' => Router::url(array(
											'controller' => 'img',
											'action' => 'blue-theme',
											'logo-email.png',
											'admin' => false
										) , true) ,
									);
					$this->_sendMail($emailFindReplace, $email_message, $user['User']['email']);
					$this->redirect(array(
										'controller' => 'transactions',
										'action' => 'index',
										'admin' => false
					));
				
			 } 
			$packages = array();
			if(!empty($available_wonderpoint) && $available_wonderpoint >= Configure::read('wonderpoint.no_of_wonderpoints'))
			{
					$package_months  = $user['User']['available_wonder_points']/Configure::read('wonderpoint.no_of_wonderpoints');
					$packages = $this->Package->find('all',array(
									'conditions'=> array(
										'Package.is_active'=> 1,
										'Package.package_category_id' => ConstPaymentCategory::WalletPackage,
										'PackageType.no_of_months <='=> $package_months
									),
									'fields'=> array(
										'Package.id',
										'PackageType.name',
										'PackageType.no_of_months',
									),
									'recursive'=> 0
						));
			}
			$this->set('packages',$packages);
	}
	public function _sendMail($email_content_array, $template, $to, $sendAs = 'text')
    {
        $this->loadModel('EmailTemplate');
        $this->Email->from = ($template['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $template['from'];
        $this->Email->replyTo = ($template['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $template['reply_to'];
        $this->Email->to = $to;
        $this->Email->subject = strtr($template['subject'], $email_content_array);
        $this->Email->content = strtr($template['email_content'], $email_content_array);
        $this->Email->sendAs = ($template['is_html']) ? 'html' : 'text';
	    $this->Email->send($this->Email->content);
    }
	public function admin_add_wonderpoint($id = null)
    {
        $this->pageTitle = __l('Add WonderPoint');
		if (!empty($this->request->data['User']['id'])) {
            $id = $this->request->data['User']['id'];
        }
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $id
            ) ,
            'recursive' => - 1
        ));
	    if (empty($user)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $user['User']['username'];
        if (!empty($this->request->data)) {
			$this->User->set($this->request->data);
            if ($this->User->validates()) {
			$this->loadModel('Transaction');
            $this->request->data['Transaction']['foreign_id'] = ConstUserIds::Admin;
		    $this->request->data['Transaction']['user_id'] = $this->request->data['User']['id'];
            $this->request->data['Transaction']['class'] = 'SecondUser';
	        $this->request->data['Transaction']['amount'] = 0 ;
			$this->request->data['Transaction']['wonder_points'] = $this->request->data['User']['available_wonder_points'];
            $this->request->data['Transaction']['transaction_type_id'] = $this->request->data['User']['transaction_type'];
				if ($this->Transaction->save($this->request->data['Transaction'])) {
					$this->User->updateAll(array(
						'User.available_wonder_points' => 'User.available_wonder_points +' . $this->request->data['User']['available_wonder_points'],
					) , array(
						'User.id' => $this->request->data['User']['id']
					));
					$this->Session->setFlash(__l('WonderPoint has been added successfully') , 'default', null, 'success');
					$this->redirect(array(
						'controller' => 'users',
						'action' => 'index'
					));
				} else {
					$this->Session->setFlash(__l('WonderPoint could not be added. Please, try again.') , 'default', null, 'error');
				}
			} else {
				$this->Session->setFlash(__l('WonderPoint could not be added. Please, try again.') , 'default', null, 'error');
			}

        } else {
            $this->request->data['User']['id'] = $id;
        }
        $this->set('user', $user);
    }
    public function change_password($user_id = null)
    {
        $this->pageTitle = __l('Change Password');
        $this->loadModel('EmailTemplate');
        if (($this->Auth->user('user_type_id') == ConstUserTypes::Company) || ($this->Auth->user('user_type_id') == ConstUserTypes::User)) {
            if ($this->Auth->User('id') != $user_id && !is_null($user_id)) {
                throw new NotFoundException(__l('Invalid request'));
            }
          
        }
        if (!empty($this->request->data)) {
            if (Configure::read('site.is_admin_settings_enabled')) {
                $this->User->set($this->request->data);
                if ($this->User->validates()) {
                    if ($this->User->updateAll(array(
                        'User.password' => '\'' . $this->Auth->password($this->request->data['User']['passwd']) . '\'',
                    ) , array(
                        'User.id' => $this->request->data['User']['user_id']
                    ))) {
                        if ($this->Auth->user('user_type_id') != ConstUserTypes::Admin && Configure::read('user.is_logout_after_change_password')) {
                            $this->Auth->logout();
                            $this->Session->setFlash(__l('Your password changed successfully. Please login now') , 'default', null, 'success');
                            if ($this->RequestHandler->isAjax()) {
                                echo 'redirect*' . Router::url(array(
                                    'controller' => 'users',
                                    'action' => 'login',
                                ) , true);
                                exit;
                            } else {
                                $this->redirect(array(
                                    'controller' => 'users',
                                    'action' => 'login'
                                ));
                            }
                        } elseif ($this->Auth->user('user_type_id') == ConstUserTypes::Admin && $this->Auth->user('id') != $this->request->data['User']['user_id']) {
                            $user = $this->User->find('first', array(
                                'conditions' => array(
                                    'User.id' => $this->request->data['User']['user_id']
                                ) ,
                                'fields' => array(
                                    'User.username',
                                    'User.email',
                                    'User.id'
                                ) ,
                                'contain' => array(
                                    'UserProfile'
                                ) ,
                                'recursive' => 1
                            ));
                            $language_code = $this->User->getUserLanguageIso($user['User']['id']);
                            $email = $this->EmailTemplate->selectTemplate('Admin Change Password', $language_code);
                            $emailFindReplace = array(
                                '##SITE_LINK##' => Router::url('/', true) ,
                                '##PASSWORD##' => $this->request->data['User']['passwd'],
                                '##USERNAME##' => $user['User']['username'],
                                '##SITE_NAME##' => Configure::read('site.name') ,
                                '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']) ,
                                '##CONTACT_URL##' => Router::url(array(
                                    'controller' => 'contacts',
                                    'action' => 'add',
                                    'city' => $this->request->params['named']['city'],
                                    'admin' => false
                                ) , true) ,
                                '##SITE_LOGO##' => Router::url(array(
                                    'controller' => 'img',
                                    'action' => 'blue-theme',
                                    'logo-email.png',
                                    'admin' => false
                                ) , true) ,
                            );
                            // Send e-mail to users
                            $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
                            $this->Email->replyTo = ($email['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $email['reply_to'];
                            $this->Email->to = $this->User->formatToAddress($user);
                            $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                            $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                            $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                        }
                        if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin && $this->Auth->user('id') != $this->request->data['User']['user_id']) {
                            $this->Session->setFlash(sprintf(__l('%s \'s password changed successfully.') , $user['User']['username']) , 'default', null, 'success');
                        } else {
                            $this->Session->setFlash(__l('Your password changed successfully') , 'default', null, 'success');
                        }
                    } else {
                        $this->Session->setFlash(__l('Password could not be changed') , 'default', null, 'error');
                    }
                } else {
                    $this->Session->setFlash(__l('Password could not be changed') , 'default', null, 'error');
                }
                unset($this->request->data['User']['old_password']);
                unset($this->request->data['User']['passwd']);
                unset($this->request->data['User']['confirm_password']);
            } else {
                $this->Session->setFlash(__l('Sorry. You Cannot Update the password in Demo Mode') , 'default', null, 'error');
            }
        } else {
            if (empty($user_id)) {
                $user_id = $this->Auth->user('id');
            }
        }
        if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
            $users = $this->User->find('list', array(
                'conditions' => array(
                    'OR' => array(
                        array(
                            'User.fb_user_id =' => NULL,
                
                            'User.user_type_id' => 2,
                        ) ,
                        array(
                            'User.user_type_id' => 3,
                                   ) ,
                        array(
                            'User.user_type_id' => 1,
                        ) ,
                    )
                ) ,
             
                'recursive' => 1
            ));
            $this->set(compact('users'));
        }
        $this->request->data['User']['user_id'] = (!empty($this->request->data['User']['user_id'])) ? $this->request->data['User']['user_id'] : $user_id;
    }
    public function admin_index()
    {
        $count_conditions = array();
        $this->_redirectGET2Named(array(
            'company_type',
            'q',
        ));
        $this->pageTitle = __l('Users');
        $conditions = array();
        if (!empty($this->request->data['User']['main_filter_id'])) {
            $this->request->params['named']['main_filter_id'] = $this->request->data['User']['main_filter_id'];
        }
        if (!empty($this->request->data['User']['filter_id'])) {
            $this->request->params['named']['filter_id'] = $this->request->data['User']['filter_id'];
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'day') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(User.created) <= '] = 0;
            $this->pageTitle.= __l(' - Registered today');
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'week') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(User.created) <= '] = 7;
            $this->pageTitle.= __l(' - Registered in this week');
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'month') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(User.created) <= '] = 30;
            $this->pageTitle.= __l(' - Registered in this month');
        }
 
        $param_string = "";
        $param_string.= !empty($this->request->params['named']['filter_id']) ? '/filter_id:' . $this->request->params['named']['filter_id'] : $param_string;
        $param_string.= !empty($this->request->params['named']['main_filter_id']) ? '/main_filter_id:' . $this->request->params['named']['main_filter_id'] : $param_string;
        if (!empty($this->request->params['named']['stat'])) {
            $param_string.= !empty($this->request->params['named']['stat']) ? '/stat:' . $this->request->params['named']['stat'] : $param_string;
        }
        if (!empty($this->request->params['named']['main_filter_id'])) {
			 if ($this->request->params['named']['main_filter_id'] == ConstMoreAction::FaceBook) {
                $conditions['User.is_facebook_register'] = 1;
                $this->pageTitle.= __l(' - Registered through Facebook ');
            } else	 if ($this->request->params['named']['main_filter_id'] ==  ConstUserTypes::User) {
               $conditions['User.user_type_id'] = ConstUserTypes::User;
                $this->pageTitle.= __l(' - User');
            }	
			else if ($this->request->params['named']['main_filter_id'] == ConstMoreAction::VerifiedUser) {
                $conditions['User.is_verified_user'] = 1;
				$conditions['User.user_type_id !='] = ConstUserTypes::Admin;
				$conditions['User.subscription_expire_date >'] = _formatDate('Y-m-d', date('Y-m-d') , true) ;
                $this->pageTitle.= __l(' - Paid User ');
            }
			else if ($this->request->params['named']['main_filter_id'] == ConstUserTypes::ContentAdmin) {
                $conditions['User.user_type_id'] = ConstUserTypes::ContentAdmin;
                $this->pageTitle.= __l(' - ContentAdmin ');
            }
			else if ($this->request->params['named']['main_filter_id'] == ConstUserTypes::Admin) {
                $conditions['User.user_type_id'] = ConstUserTypes::Admin;
                $this->pageTitle.= __l(' - Admin ');
            }
        }
        $count_conditions = $conditions;
        if (!empty($this->request->params['named']['filter_id'])) {
            if ($this->request->params['named']['filter_id'] == ConstMoreAction::Active) {
                $conditions['User.is_active'] = 1;
                $this->pageTitle.= __l(' - Active ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Inactive) {
                $conditions['User.is_active'] = 0;
                $this->pageTitle.= __l(' - Inactive ');
            }
        }
        if (isset($this->request->data['User']['q']) && !empty($this->request->data['User']['q'])) {
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->data['User']['q']);
            $param_string.= '/q:' . $this->request->data['User']['q'];
            $this->request->params['named']['q'] = $this->request->data['User']['q'];
        } else if (isset($this->request->params['named']['q'])) {
            $this->request->data['User']['q'] = $this->request->params['named']['q'];
        }
    
        if (!Configure::read('facebook.is_enabled_facebook_connect')) {
            $conditions['User.fb_user_id'] = null;
            $count_conditions['User.fb_user_id'] = null;
        }
        if ($this->RequestHandler->prefers('csv')) {
            Configure::write('debug', 0);
            $this->set('user', $this);
            $this->set('conditions', $conditions);
            if (isset($this->request->data['User']['q'])) {
                $this->set('q', $this->request->data['User']['q']);
            }
            $this->set('contain', $contain);
        } else {
            $this->User->recursive = 2;
            $this->paginate = array(
                'conditions' => $conditions,
                'contain' => array(
                      'UserAvatar' => array(
                        'fields' => array(
                            'UserAvatar.id',
                            'UserAvatar.dir',
                            'UserAvatar.filename',
                            'UserAvatar.width',
                            'UserAvatar.height'
                        )
                    ) ,

                ) ,
                'order' => array(
                    'User.id' => 'desc'
                )
            );
            $export_users = $this->User->find('all', array(
                'conditions' => $conditions,
                'recursive' => - 1
            ));
            if (!empty($export_users)) {
                $ids = array();
                foreach($export_users as $export_user) {
                    $ids[] = $export_user['User']['id'];
                }
                $hash = $this->User->getIdHash(implode(',', $ids));
                $_SESSION['export_users'][$hash] = $ids;
                $this->set('export_hash', $hash);
            }
            if (isset($this->request->data['User']['q']) && !empty($this->request->data['User']['q'])) {
                $this->paginate = array_merge($this->paginate, array(
                    'search' => $this->request->params['named']['q']
                ));
            }
            $this->set('param_string', $param_string);
            $this->set('users', $this->paginate());
            $this->set('pageTitle', $this->pageTitle);
            if (!empty($this->request->params['named']['main_filter_id']) && $this->request->params['named']['main_filter_id'] == ConstUserTypes::Admin) {
                $moreActions = $this->User->adminMoreActions;
            } else {
                $moreActions = $this->User->moreActions;
            }
            $this->set(compact('moreActions'));
            // total approved users list
            $this->set('active', $this->User->find('count', array(
                'conditions' => array(
                    'User.is_active' => 1,
                    $count_conditions
                ) ,
                'recursive' => - 1
            )));
            // total approved users list
            $this->set('inactive', $this->User->find('count', array(
                'conditions' => array(
                    'User.is_active' => 0,
                    $count_conditions
                ) ,
                'recursive' => - 1
            )));
        }
    }

    public function admin_add()
    {
        $this->pageTitle = __l('Add New User/Admin');
        $this->loadModel('EmailTemplate');
        if (!empty($this->request->data)) {
            $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['passwd']);
            $this->request->data['User']['is_agree_terms_conditions'] = '1';
            $this->request->data['User']['is_email_confirmed'] = 1;
            $this->request->data['User']['is_active'] = 1;
            $this->request->data['User']['signup_ip'] = $this->RequestHandler->getClientIP();
            $this->request->data['User']['dns'] = gethostbyaddr($this->RequestHandler->getClientIP());
            $this->User->create();
            $this->User->UserProfile->set($this->request->data);
            if ($this->User->save($this->request->data) & $this->User->UserProfile->validates()) {
                $this->request->data['UserProfile']['user_id'] = $this->User->getLastInsertId();
                $this->User->UserProfile->create();
                $this->User->UserProfile->save($this->request->data);
                // Send mail to user to activate the account and send account details
                $email = $this->EmailTemplate->selectTemplate('Admin User Add');
                $emailFindReplace = array(
                    '##SITE_LINK##' => Router::url('/', true) ,
                    '##USERNAME##' => $this->request->data['User']['username'],
                    '##LOGINLABEL##' => ucfirst(Configure::read('user.using_to_login')) ,
                    '##USEDTOLOGIN##' => $this->request->data['User'][Configure::read('user.using_to_login') ],
                    '##SITE_NAME##' => Configure::read('site.name') ,
                    '##PASSWORD##' => $this->request->data['User']['passwd'],
                    '##CONTACT_URL##' => Router::url(array(
                        'controller' => 'contacts',
                        'action' => 'add',
                        'city' => $this->request->params['named']['city'],
                        'admin' => false
                    ) , true) ,
                    '##SITE_LOGO##' => Router::url(array(
                        'controller' => 'img',
                        'action' => 'blue-theme',
                        'logo-email.png',
                        'admin' => false
                    ) , true) ,
                    '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']) ,
                );
                $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
                $this->Email->replyTo = ($email['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $email['reply_to'];
                $this->Email->to = $this->request->data['User']['email'];
                $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                $this->Session->setFlash(__l('User has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                unset($this->request->data['User']['passwd']);
                $this->Session->setFlash(__l('User could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $userTypes = $this->User->UserType->find('list', array(
            'conditions' => array(
                'UserType.id !=' => ConstUserTypes::Company
            )
        ));
        $this->set(compact('userTypes'));
        if (!isset($this->request->data['User']['user_type_id'])) {
            $this->request->data['User']['user_type_id'] = ConstUserTypes::User;
        }
        $cities = $this->User->UserProfile->City->find('list', array(
            'conditions' => array(
                'City.is_approved =' => 1
            ) ,
            'order' => array(
                'City.name' => 'asc'
            )
        ));
        $states = $this->User->UserProfile->State->find('list');
        $this->set(compact('cities', 'states'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id) && $id == ConstUserTypes::Admin) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->_sendAdminActionMail($id, 'Admin User Delete');
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__l('User deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function admin_update()
    {
        $this->autoRender = false;
        if (!empty($this->request->data['User'])) {
            $r = $this->request->data[$this->modelClass]['r'];
            $actionid = $this->request->data[$this->modelClass]['more_action_id'];
            unset($this->request->data[$this->modelClass]['r']);
            unset($this->request->data[$this->modelClass]['more_action_id']);
            $userIds = array();
            foreach($this->request->data['User'] as $user_id => $is_checked) {
                if ($is_checked['id']) {
                    $userIds[] = $user_id;
                }
            }
            if ($actionid && !empty($userIds)) {
                if ($actionid == ConstMoreAction::Inactive) {
                    $this->User->updateAll(array(
                        'User.is_active' => 0,
                    ) , array(
                        'User.id' => $userIds
                    ));
                    foreach($userIds as $key => $user_id) {
                        $this->_sendAdminActionMail($user_id, 'Admin User Deactivate');
                    }
                    $this->Session->setFlash(__l('Checked users has been inactivated') , 'default', null, 'success');
                } else if ($actionid == ConstMoreAction::Active) {
                    $this->User->updateAll(array(
                        'User.is_active' => 1
                    ) , array(
                        'User.id' => $userIds
                    ));
                    foreach($userIds as $key => $user_id) {
                        $this->_sendAdminActionMail($user_id, 'Admin User Active');
                    }
                    $this->Session->setFlash(__l('Checked users has been activated') , 'default', null, 'success');
                } else if ($actionid == ConstMoreAction::Delete) {
                    foreach($userIds as $key => $user_id) {
                        $this->_sendAdminActionMail($user_id, 'Admin User Delete');
                    }
                    $this->User->deleteAll(array(
                        'User.id' => $userIds
                    ));
                    $this->Session->setFlash(__l('Checked users has been deleted') , 'default', null, 'success');
                } else if ($actionid == ConstMoreAction::Export) {
                    $user_ids = implode(',', $userIds);
                    $hash = $this->User->getUserIdHash($user_ids);
                    $_SESSION['user_export'][$hash] = $userIds;
                    echo 'redirect*' . Router::url(array(
                        'controller' => 'users',
                        'action' => 'export',
                        'ext' => 'csv',
                        $hash,
                        'admin' => true
                    ) , true);
                    exit;
                } 
            }
        }
        if (!$this->RequestHandler->isAjax()) {
            $this->redirect(Router::url('/', true) . $r);
        } else {
            $this->redirect($r);
        }
    }
    public function _sendAdminActionMail($user_id, $email_template)
    {
        $this->loadModel('EmailTemplate');
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id
            ) ,
            'fields' => array(
                'User.username',
                'User.id',
                'User.email'
            ) ,
            'contain' => array(
                'UserProfile'
            ) ,
            'recursive' => 1
        ));
        $language_code = $this->User->getUserLanguageIso($user['User']['id']);
        $email = $this->EmailTemplate->selectTemplate($email_template, $language_code);
        $emailFindReplace = array(
            '##SITE_LINK##' => Router::url('/', true) ,
            '##USERNAME##' => $user['User']['username'],
            '##SITE_NAME##' => Configure::read('site.name') ,
            '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']) ,
            '##CONTACT_URL##' => Router::url(array(
                'controller' => 'contacts',
                'action' => 'add',
                'city' => $this->request->params['named']['city'],
                'admin' => false
            ) , true) ,
            '##SITE_LOGO##' => Router::url(array(
                'controller' => 'img',
                'action' => 'blue-theme',
                'logo-email.png',
                'admin' => false
            ) , true) ,
        );
        $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
        $this->Email->replyTo = ($email['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $email['reply_to'];
        $this->Email->to = $this->User->formatToAddress($user);
        $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
        $this->Email->subject = strtr($email['subject'], $emailFindReplace);
        $this->Email->send(strtr($email['email_content'], $emailFindReplace));
    }
    public function admin_stats()
    {
        $this->pageTitle = __l('Site Stats');
        $periods = array(
            'day' => array(
                'display' => __l('Today') ,
                'conditions' => array(
                    'TO_DAYS(NOW()) - TO_DAYS(created) <= ' => 0,
                )
            ) ,
            'week' => array(
                'display' => __l('This week') ,
                'conditions' => array(
                    'TO_DAYS(NOW()) - TO_DAYS(created) <= ' => 7,
                )
            ) ,
            'month' => array(
                'display' => __l('This month') ,
                'conditions' => array(
                    'TO_DAYS(NOW()) - TO_DAYS(created) <= ' => 30,
                )
            ) ,
            'total' => array(
                'display' => __l('Total') ,
                'conditions' => array()
            )
        );
        $rowspan_ct = 0;
       
        $models[] = array(
            'User' => array(
                'display' => __l('Users') ,
                'link' => array(
                    'controller' => 'users',
                    'action' => 'index'
                ) ,
            )
        );
        if (Configure::read('facebook.is_enabled_facebook_connect')) {
            $models[] = array(
                'User' => array(
                    'display' => __l('Facebook') ,
                    'link' => array(
                        'controller' => 'users',
                        'action' => 'index',
                        'main_filter_id' => ConstMoreAction::FaceBook
                    ) ,
                    'conditions' => array(
                        'User.is_facebook_register' => 1,
                        'User.user_type_id' => ConstUserTypes::User,
                    ) ,
                    'alias' => 'UserFacebook',
                    'isSub' => 'User'
                )
            );
        }

        
        foreach($models as $unique_model) {
            foreach($unique_model as $model => $fields) {
                foreach($periods as $key => $period) {
                    $conditions = $period['conditions'];
                    if (!empty($fields['conditions'])) {
                        $conditions = array_merge($periods[$key]['conditions'], $fields['conditions']);
                    }
                    $aliasName = !empty($fields['alias']) ? $fields['alias'] : $model;
             
                        $this->set($aliasName . $key, $this->{$model}->find('count', array(
                            'conditions' => $conditions,
                            'recursive' => - 1
                        )));
                
                }
            }
        }
        //recently registered users
        $recentUsers = $this->User->find('all', array(
            'conditions' => array(
                'User.is_active' => 1,
                'User.user_type_id != ' => ConstUserTypes::Admin
            ) ,
            'fields' => array(
                'User.user_type_id',
                'User.username',
                'User.id',
            ) ,
            'recursive' => - 1,
            'limit' => 10,
            'order' => array(
                'User.id' => 'desc'
            )
        ));
        //recently logged in users
        $loggedUsers = $this->User->find('all', array(
            'conditions' => array(
                'User.is_active' => 1,
                'User.user_type_id != ' => ConstUserTypes::Admin
            ) ,
            'fields' => array(
                'User.user_type_id',
                'User.username',
                'User.id',
            ) ,
            'recursive' => - 1,
            'limit' => 10,
            'order' => array(
                'User.last_logged_in_time' => 'desc'
            )
        ));
        //online users
        $onlineUsers = $this->User->find('all', array(
            'conditions' => array(
                'User.is_active' => 1,
                'CkSession.user_id != ' => 0,
                'User.user_type_id != ' => ConstUserTypes::Admin
            ) ,
            'contain' => array(
                'CkSession' => array(
                    'fields' => array(
                        'CkSession.user_id'
                    )
                )
            ) ,
            'fields' => array(
                'DISTINCT User.username',
                'User.user_type_id',
                'User.id',
            ) ,
            'recursive' => 0,
            'limit' => 10,
            'order' => array(
                'User.last_logged_in_time' => 'desc'
            )
        ));
        // Cache file read
        $error_log_path = APP . '/tmp/logs/error.log';
        $error_log = $debug_log = '';
        if (file_exists($error_log_path)) {
            $handle = fopen($error_log_path, "r");
            fseek($handle, -10240, SEEK_END);
            $error_log = fread($handle, 10240);
            fclose($handle);
        }
        $debug_log_path = APP . '/tmp/logs/debug.log';
        if (file_exists($debug_log_path)) {
            $handle = fopen($debug_log_path, "r");
            fseek($handle, -10240, SEEK_END);
            $debug_log = fread($handle, 10240);
            fclose($handle);
        }
        $this->set('error_log', $error_log);
        $this->set('debug_log', $debug_log);
        $this->set('tmpCacheFileSize', bytes_to_higher(dskspace(TMP . 'cache')));
        $this->set('tmpLogsFileSize', bytes_to_higher(dskspace(TMP . 'logs')));
        $this->set(compact('loggedUsers', 'recentUsers', 'onlineUsers', 'periods', 'models'));
    }
    public function admin_change_password($user_id = null)
    {
        $this->setAction('change_password', $user_id);
    }
    public function admin_login()
    {
        $this->setAction('login');
    }
    public function admin_logout()
    {
        $this->setAction('logout');
    }
	    //run cron manually from admin side
    public function admin_update_cron()
    {
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'cron');
        $this->Cron = new CronComponent($collection);
        $this->Cron->update_package();
	    $this->Session->setFlash(__l('Cron is run successfully..') , 'default', null, 'success');
        $this->redirect(array(
            'controller' => 'users',
            'action' => 'index'
        ));
    }
    public function resend_activemail($username = NUll, $status = NULL)
    {
        if (!empty($username) && !empty($status)) {
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.username' => $username,
                )
            ));
            $this->_sendActivationMail($user['User']['email'], $user['User']['id'], $this->User->getActivateHash($user['User']['id']));
        }
        $this->set('username', $username);
    }
    public function my_stuff()
    {
        if (!$this->User->isAllowed($this->Auth->user('user_type_id'))) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle = __l('My Stuff');
    }
    
    public function whois($ip = null)
    {
        if (!empty($ip)) {
            $this->redirect(Configure::read('site.look_up_url') . $ip);
        }
    }
    public function admin_clear_logs()
    {
        if (!empty($this->request->params['named']['type'])) {
            if ($this->request->params['named']['type'] == 'error_log') {
                $error_log_path = APP . '/tmp/logs/error.log';
                if (file_exists($error_log_path)) {
                    unlink(APP . '/tmp/logs/error.log');
                }
                $this->Session->setFlash(__l('Error log has been cleared') , 'default', null, 'success');
            } elseif ($this->request->params['named']['type'] == 'debug_log') {
                $debug_log_path = APP . '/tmp/logs/debug.log';
                if (file_exists($debug_log_path)) {
                    unlink(APP . '/tmp/logs/debug.log');
                }
                $this->Session->setFlash(__l('Debug log has been cleared') , 'default', null, 'success');
            }
        }
        $this->redirect(array(
            'controller' => 'users',
            'action' => 'logs'
        ));
    }
    public function admin_clear_cache()
    {
        App::import('Folder');
        $folder = new Folder();
        $folder->delete(CACHE . DS . 'models');
        $folder->delete(CACHE . DS . 'persistent');
        $folder->delete(CACHE . DS . 'views');
        $this->Session->setFlash(__l('Cache Files has been cleared') , 'default', null, 'success');
        $this->redirect(array(
            'controller' => 'users',
            'action' => 'logs'
        ));
    }
    // <-- For iPhone App code
    public function validate_user()
    {
		if ((Configure::read('user.using_to_login') == 'email') && isset($this->request->data['User']['username'])) {
            $this->request->data['User']['email'] = $this->request->data['User']['username'];
            unset($this->request->data['User']['username']);
        }
        $this->request->data['User'][Configure::read('user.using_to_login')] = trim($this->request->data['User'][Configure::read('user.using_to_login')]);
        $this->request->data['User']['password'] = $_GET['data']['User']['password'];			 
		$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']); 
        if ($this->Auth->login($this->request->data)) {
            $resonse = array(
                'status' => 0,
                'message' => __l('Success')
            );
        } else {
            $resonse = array(
                'status' => 1,
                'message' => sprintf(__l('Sorry, login failed.  Your %s or password are incorrect') , Configure::read('user.using_to_login'))
            );
        }
        if ($this->RequestHandler->prefers('json')) {
            $this->view = 'Json';
            $this->set('json', (empty($this->viewVars['iphone_response'])) ? $resonse : $this->viewVars['iphone_response']);
        }
    }
	// For iPhone App code -->
    function oauth_facebook()
    {
        App::import('Vendor', 'facebook/facebook');
        $this->facebook = new Facebook(array(
            'appId' => Configure::read('facebook.app_id') ,
            'secret' => Configure::read('facebook.fb_secrect_key') ,
            'cookie' => true
        ));
        $this->autoRender = false;
        if (!empty($_REQUEST['code'])) {
            $tokens = $this->facebook->setAccessToken(array(
                'redirect_uri' => Router::url(array(
                    'controller' => 'users',
                    'action' => 'oauth_facebook',
                    'admin' => false
                ) , true) ,
                'code' => $_REQUEST['code']
            ));
            $fb_return_url = $this->Session->read('fb_return_url');
            $this->redirect($fb_return_url);
        } else {
            $this->Session->setFlash(__l('Invalid Facebook Connection.') , 'default', null, 'error');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'login'
            ));
        }
        exit;
    }   
    public function admin_logs()
    {
        $error_log_path = APP . '/tmp/logs/error.log';
        $error_log = $debug_log = '';
        if (file_exists($error_log_path)) {
            $handle = fopen($error_log_path, "r");
            fseek($handle, -10240, SEEK_END);
            $error_log = fread($handle, 10240);
            fclose($handle);
        }
        $debug_log_path = APP . '/tmp/logs/debug.log';
        if (file_exists($debug_log_path)) {
            $handle = fopen($debug_log_path, "r");
            fseek($handle, -10240, SEEK_END);
            $debug_log = fread($handle, 10240);
            fclose($handle);
        }
        $this->set('error_log', $error_log);
        $this->set('debug_log', $debug_log);
        $this->set('tmpCacheFileSize', bytes_to_higher(dskspace(TMP . 'cache')));
        $this->set('tmpLogsFileSize', bytes_to_higher(dskspace(TMP . 'logs')));
    }
	public function share_friend()
    {
	   $this->pageTitle = __l('Refer a Friend');
        if (!empty($this->request->data)) {

            $this->User->set($this->request->data);
            if ($this->User->validates()) {
				$friend_email = explode(',', $this->request->data['User']['friends_email']);
                foreach($friend_email as $to_email) {
                    $this->_sendShareFriendMail($to_email);
                }
                $this->Session->setFlash(__l('Your friend has been invited.') , 'default', null, 'success');
                $this->request->data = array();
            } else {
                $this->Session->setFlash(__l('Problem in inviting.') , 'default', null, 'error');
            }
        }
    }
	public function _sendShareFriendMail($contact_email)
    {
        $this->pageTitle = __l('Share Friend');
        $this->loadModel('EmailTemplate');
        $email_message = $this->EmailTemplate->selectTemplate('Share Friend User');
        $email_replace = array(
            '##FROM_EMAIL##' => ($email_message['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email_message['from'],
            '##USERNAME##' => $contact_email ,
            '##SITE_NAME##' => Configure::read('site.name') ,
            '##MESSAGE##' => !empty($this->request->data['User']['message'])?$this->request->data['User']['message']:'' ,
            '##SITE_LINK##' => Router::url(array(
                'controller' => 'users',
                'action' => 'register',
                'admin' => false
            ) , true) ,
			'##GET_START_URL##' => Router::url(array(
                'controller' => 'users',
                'action' => 'refer',
				'r'=>$this->Auth->user('email'),
                'admin' => false
            ) , true) ,
            '##SUPPORT_EMAIL##' => Router::url(array(
                'controller' => 'contacts',
                'action' => 'add',
                'city' => $this->request->params['named']['city'],
                'admin' => false
            ) , true) ,
            '##CONTACT_URL##' => Router::url(array(
                'controller' => 'contacts',
                'action' => 'add',
                'city' => $this->request->params['named']['city'],
                'admin' => false
            ) , true) ,
            '##SITE_LOGO##' => Router::url(array(
                'controller' => 'img',
                'action' => 'blue-theme',
                'logo-email.png',
                'admin' => false
            ) , true) ,
        );
        $this->Email->from = ($email_message['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email_message['from'];
        $this->Email->replyTo = ($email_message['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $email_message['reply_to'];
        $this->Email->to = $contact_email;
        $this->Email->subject = strtr($email_message['subject'], $email_replace);
        $this->Email->sendAs = ($email_message['is_html']) ? 'html' : 'text';
        $this->Email->send(strtr($email_message['email_content'], $email_replace));
    }
   public function test(){

   }
 }
?>
