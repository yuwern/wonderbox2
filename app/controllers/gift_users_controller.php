<?php
class GiftUsersController extends AppController
{
    public $name = 'GiftUsers';
	public $helpers = array(
        'Gateway',
	);
	public $components = array(
        'Email',
    );
	public $disabledFields = array(
        'UserShipping',
		'GiftUser',
		'User'
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = $this->disabledFields;
        parent::beforeFilter();
    }
    public function index()
    {
		$this->pageTitle = __l('My Gift a Wonderbox');
        $conditions = array();
		$conditions['GiftUser.is_paid'] = 1;
		if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'sent') {
            $conditions['GiftUser.user_id'] = $this->Auth->user('id');
        } elseif (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'received') {
            $conditions['GiftUser.gifted_to_user_id'] = $this->Auth->user('id') ;
        } elseif (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'all') {
            $conditions['or'] = array(
                'GiftUser.user_id = ' => $this->Auth->user('id') ,
                'GiftUser.friend_mail = ' => $this->Auth->user('email') ,
            );
        }
        $this->GiftUser->recursive = 1;
	    $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
			   'User' => array(
					'fields'=> array(
						'User.id',
						'User.username'
					)
                ) ,
                'GiftedToUser' => array(
					'fields'=> array(
						'User.id',
						'User.username'
					)
                ),
				'Package' => array(
					'fields'=> array(
						'Package.id',
						'Package.cost'
					)
				)
            ) ,
            'order' => array(
                'GiftUser.id' => 'desc'
            )
        );
        $this->set('giftUsers', $this->paginate());
    }
    public function add()
    {							
	    $this->pageTitle = __l('Add Gift User');
        if ($this->request->is('post')) {
            $this->GiftUser->create();
			$this->request->data['GiftUser']['user_id'] = $this->Auth->user('id');
			$this->GiftUser->set($this->request->data);
		    if ($this->GiftUser->validates()) {
				$package = $this->GiftUser->Package->find('first', array(
					'conditions' => array(
					'Package.id = ' => $this->request->data['GiftUser']['package_id']
				) ,
				'recursive' => -1,
				));
				if (empty($package)) {
					 throw new NotFoundException(__l('Invalid request'));
				}
				$this->loadModel('PaymentGateway');
				$paymentGateway = $this->PaymentGateway->find('first',array(
						'conditions'=> array(
							'PaymentGateway.id'=> ConstPaymentGateways::MOLPay
						)
				));
				if (empty($paymentGateway)) {
					 throw new NotFoundException(__l('Invalid request'));
				}
				$this->pageTitle.= sprintf(__l('Buy %s Subcribed') , $package['Package']['name']);
				$action = strtolower(str_replace(' ', '', $paymentGateway['PaymentGateway']['name']));
			 if ($paymentGateway['PaymentGateway']['name'] == 'MolPAY') {
					 Configure::write('molpay.is_testmode', $paymentGateway['PaymentGateway']['is_test_mode']);
					  if (!empty($paymentGateway['PaymentGatewaySetting'])) {
								foreach($paymentGateway['PaymentGatewaySetting'] as $paymentGatewaySetting) {
									if ($paymentGatewaySetting['key'] == 'merchant_id') {
										Configure::write('molpay.merchant_id', $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value']);
									}
									if ($paymentGatewaySetting['key'] == 'verify_key') {
										Configure::write('molpay.verify_key', $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value']);
									}
								}
					  }

				}
				
				$orderID = time();
				$amount = number_format($package['Package']['cost'],2);
				$vcode = md5($amount.Configure::read('molpay.merchant_id').$orderID.Configure::read('molpay.verify_key'));
				$country = 'MY';
				$gateway_options = array(
					'is_testmode'=> Configure::read('molpay.is_testmode'),
					'orderID'=> $orderID,
					'description'=> $package['Package']['name'] ,
					'amount'=> $amount,
					'cur'=>'RM',
					'returnUrl'=>  Router::url(array(
										'controller' => 'gift_users',
										'action' => 'processpayment','molpay',
										'city' => $this->request->params['named']['city'],
										'admin' => false
									) , true),
					'country'=> $country,
					'vcode'=> $vcode

				);
				$personal_data = array();
				$personal_data['personal_data']['contact_no'] = $this->request->data['GiftUser']['contact_no'];
				$personal_data['personal_data']['contact_no1'] = $this->request->data['GiftUser']['contact_no1'];
				$personal_data['shipping_data']['address'] = $this->request->data['GiftUser']['address'];
				$personal_data['shipping_data']['zip_code'] = $this->request->data['GiftUser']['zip_code'];
				$personal_data['shipping_data']['state_id'] = $this->request->data['GiftUser']['state_id'];
				$personal_data['shipping_data']['country_id'] = $this->request->data['GiftUser']['country_id'];
				$personal_data = serialize($personal_data);
				$this->loadModel('TempPaymentLog');
				$transaction_data['TempPaymentLog'] = array(
								'order_id' => $orderID,
								'payment_type' => 'Gift Package',
								'user_id' => $this->Auth->user('id') ,
								'package_id' => $package['Package']['id'],
								'is_gift' => 1,
								'gift_to' => $this->request->data['GiftUser']['friend_name'], //
								'gift_from' => $this->request->data['GiftUser']['from'],
								'gift_email' =>  $this->request->data['GiftUser']['friend_mail'],
								'message' =>  $this->request->data['GiftUser']['message'],
								'quantity' => 1,
								'payment_gateway_id' => $paymentGateway['PaymentGateway']['id'],
								'ip' => $this->RequestHandler->getClientIP() ,
								'amount_needed' => $amount,
								'personal_data' => $personal_data
								//'message' => $package['Package']['name'],
				);
				$this->TempPaymentLog->save($transaction_data);
				$this->set('gateway_options', $gateway_options);
				 $this->set('package', $package);
				$this->set('action', $action);
				$this->render('purchase');
	          } else {
                $this->Session->setFlash(__l('Gift user could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $users = $this->GiftUser->User->find('list');
        $packages = $this->GiftUser->Package->find('list');
		$states = $this->GiftUser->User->UserShipping->State->find('list');	
		$countries = $this->GiftUser->User->UserShipping->Country->find('list');	
        $this->set(compact('users', 'packages','states','countries'));
    }
    public function processpayment($gateway_name){
		$gateway = array(
            'paypal' => ConstPaymentGateways::PayPal,
            'molpay' => ConstPaymentGateways::MOLPay
        );
	   $gateway_id = (!empty($gateway[$gateway_name])) ? $gateway[$gateway_name] : 0;
	   $this->loadModel('PaymentGateway');
       $paymentGateway = $this->PaymentGateway->find('first', array(
            'conditions' => array(
                'PaymentGateway.id' => $gateway_id
            ) ,
            'contain' => array(
                'PaymentGatewaySetting' => array(
                    'fields' => array(
                        'PaymentGatewaySetting.key',
                        'PaymentGatewaySetting.test_mode_value',
                        'PaymentGatewaySetting.live_mode_value',
                    )
                )
            ) ,
            'recursive' => 1
        ));
	    switch ($gateway_name) {
			case 'molpay':
				$molpay_is_testmode = $paymentGateway['PaymentGateway']['is_test_mode'];
				if (!empty($paymentGateway['PaymentGatewaySetting'])) {
                            foreach($paymentGateway['PaymentGatewaySetting'] as $paymentGatewaySetting) {
                                if ($paymentGatewaySetting['key'] == 'merchant_id') {
                                    $molpay_merchant_id  =  $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
                                }
                                if ($paymentGatewaySetting['key'] == 'verify_key') {
                                    $molpay_verify_key = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
                                }
                            }
                  }
				 $tranID =$_POST['tranID'];
 				 $orderid =$_POST['orderid'];
				 $status =$_POST['status'];
				 $domain =$_POST['domain'];
				 $amount =$_POST['amount'];
				 $currency =$_POST['currency'];
				 $appcode =$_POST['appcode'];
				 $paydate =$_POST['paydate'];
				 $skey =$_POST['skey'];
				 $key0 = md5( $tranID.$orderid.$status.$domain.$amount.$currency );
				 $key1 = md5( $paydate.$domain.$key0.$appcode.$molpay_verify_key );
				if( $skey != $key1 ) $status= -1; // invalid transaction
				if($status == -1)
				{
   				 $this->Session->setFlash(__l('Invalid transaction.') , 'default', null, 'error');
                 $this->redirect(array(
                    'controller' => 'pages',
                    'action' => 'home',
                    'admin' => false
                 ));
				}
				if ( $status == "00" ) {					
				    $this->loadModel('TempPaymentLog');
						$tempPaymentLog = $this->TempPaymentLog->find('first',array(
								'conditions' => array(
									'TempPaymentLog.order_id'=> $orderid,
									'TempPaymentLog.is_paid'=> 0
								)
							));
						if(!empty($tempPaymentLog)){
							$personal_data = unserialize($tempPaymentLog['TempPaymentLog']['personal_data']);
							$data['GiftUser']['user_id'] =  $this->Auth->user('id');
							$data['GiftUser']['package_id'] = $tempPaymentLog['TempPaymentLog']['package_id'] ;
							$data['GiftUser']['friend_name'] = $tempPaymentLog['TempPaymentLog']['gift_to'] ;
							$data['GiftUser']['from'] = $tempPaymentLog['TempPaymentLog']['gift_from'] ;
							$data['GiftUser']['friend_mail'] = $tempPaymentLog['TempPaymentLog']['gift_email'] ;
							$data['GiftUser']['message'] = $tempPaymentLog['TempPaymentLog']['message'] ;
							$data['GiftUser']['is_paid'] = 1 ;
							if ($this->GiftUser->save($data)) {							
								$gift_user_id = $this->GiftUser->id;
								$this->loadModel('Transaction');
							    $user_id  = $tempPaymentLog['TempPaymentLog']['user_id'];
								$data['Transaction']['user_id'] = $user_id;
								$data['Transaction']['foreign_id'] = $gift_user_id;
								$data['Transaction']['class'] = 'GiftUser';
								$data['Transaction']['amount'] = $amount;
								$data['Transaction']['payment_gateway_id'] = $paymentGateway['PaymentGateway']['id'];
								$data['Transaction']['description'] = 'Payment Success';
								$data['Transaction']['gateway_fees'] = 0;
								$data['Transaction']['transaction_type_id'] = ConstTransactionTypes::GiftSent;
								$transaction_id = $this->Transaction->log($data);
								$user = $this->GiftUser->User->find('first', array(
													'conditions'=>  array(
														'User.email'=> $data['GiftUser']['friend_mail']
													)
											)
										);
									if(empty($user)) {
										$this->request->data['User']['passwd'] = Configure::read('gift.login_password');
										$this->request->data['User']['email'] = $data['GiftUser']['friend_mail'];
										$this->request->data['User']['username'] = str_replace(' ','',$data['GiftUser']['friend_name']);
										$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['passwd']);
										$this->request->data['User']['is_agree_terms_conditions'] = '1';
										$this->request->data['User']['is_email_confirmed'] = 1;
										$this->request->data['User']['user_type_id'] = ConstUserTypes::User;
										$this->request->data['User']['is_active'] = 1;
										$this->request->data['User']['signup_ip'] = $this->RequestHandler->getClientIP();
										$this->request->data['User']['dns'] = gethostbyaddr($this->RequestHandler->getClientIP());
										$this->GiftUser->User->create();
										$this->GiftUser->User->save($this->request->data);
										$create_user_id = $this->GiftUser->User->getLastInsertId();
										$this->request->data['UserProfile']['user_id'] = $create_user_id;
										$this->request->data['UserProfile']['first_name'] = $data['GiftUser']['friend_name'];
										$this->GiftUser->User->UserProfile->create();
										$this->GiftUser->User->UserProfile->save($this->request->data['UserProfile'],false);
										$this->request->data['UserShipping']['user_id'] = $create_user_id;
										$this->request->data['UserShipping']['address'] = $personal_data['shipping_data']['address'];
										$this->request->data['UserShipping']['zip_code'] = $personal_data['shipping_data']['zip_code'];
										$this->request->data['UserShipping']['state_id'] = $personal_data['shipping_data']['state_id'];
										$this->request->data['UserShipping']['country_id'] = $personal_data['shipping_data']['country_id'];
										$this->request->data['UserShipping']['contact_no'] = $personal_data['personal_data']['contact_no'];
										$this->request->data['UserShipping']['contact_no1'] = $personal_data['personal_data']['contact_no1'];
										$this->GiftUser->User->UserShipping->create();
										$this->GiftUser->User->UserShipping->save($this->request->data['UserShipping'],false);
								} else {
									 $create_user_id = $user['User']['id'];
								}
								$data['Transaction']['user_id'] = $create_user_id;
								$data['Transaction']['foreign_id'] = $tempPaymentLog['TempPaymentLog']['package_id'];
								$data['Transaction']['class'] = 'Package';
								$data['Transaction']['amount'] = $amount;
								$data['Transaction']['payment_gateway_id'] = $paymentGateway['PaymentGateway']['id'];
								$data['Transaction']['description'] = 'Payment Success';
								$data['Transaction']['gateway_fees'] = 0;
								$data['Transaction']['transaction_type_id'] = ConstTransactionTypes::GiftReceived;
								$transaction_id1 = $this->Transaction->log($data);
								if (!empty($transaction_id1)) {
										$package=$this->GiftUser->Package->find('first',array(
											'conditions'=> array(
												'Package.id'=> $tempPaymentLog['TempPaymentLog']['package_id']
											),
											'contain'=> array(
												'PackageType'=> array(
													'fields' => array(
														'PackageType.no_of_months'
													)
												)
											),
											'recursive' => 1
										));
										$referred_by_user_id = 0;
										$duration = $this->getDurationPeriod($package['PackageType']['no_of_months'],$create_user_id);
										$this->GiftUser->Package->PackageUser->savePackageUser($package['PackageType']['no_of_months'],$create_user_id,$package['Package']['id'],	$referred_by_user_id);
										$start_date = $duration['start_date'];	
										$end_date =  $duration['end_date'];	
										$this->GiftUser->User->updateAll(array(
											'User.is_verified_user' => 1,
											'User.available_wonder_points' => 'User.available_wonder_points + '. $package['Package']['no_of_wonderpoints'],
											'User.subscription_expire_date' => $end_date,
										) , array(
											'User.id' => $create_user_id
										));
										$this->GiftUser->updateAll(array(
											'GiftUser.gifted_to_user_id' => $create_user_id,
											'GiftUser.start_date' => $start_date,
											'GiftUser.end_date' => $end_date,
										) , array(
											'GiftUser.user_id' => $user_id
										));
										$user = $this->GiftUser->User->find('first', array(
											'conditions'=> array(
												'User.id'=> $user_id
											),
											'contain'=> array(
												'UserProfile'=> array(
													'fields'=> array(
														'UserProfile.first_name'
													)
												)
											),
											'fields'=> array(
												'User.id',
												'User.created',
												'User.username',
												'User.referred_by_user_id',
												'User.email',
											)
										  )
										);
									$this->loadModel('EmailTemplate');
									$email_message = $this->EmailTemplate->selectTemplate('Gift Purchase Confirmation');
									$emailFindReplace = array(
										'##FROM_EMAIL##' => ($email_message['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email_message['from'] ,
										'##SITE_NAME##' => Configure::read('site.name') ,
										'##USERNAME##' => $user['User']['username'],
										'##PACKAGE_NAME##' => $package['Package']['name']  ,
										'##PACKAGE_AMOUNT##' => Configure::read('site.currency') . $amount ,
										'##SITE_LINK##' => Router::url('/', true) ,
										'##PURCHASE_ON##' => strftime(Configure::read('site.datetime.format')) ,
										'##PURCHASE_EXPIRY##' => $end_date ,
										'##WONDER_POINT##' => !empty($package['Package']['no_of_wonderpoints'])? $package['Package']['no_of_wonderpoints']: 'None' ,
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
							        $this->TempPaymentLog->updateAll(array(
										'TempPaymentLog.is_paid' => 1
									) , array(
										'TempPaymentLog.order_id' => $orderid 
									));
            					    $this->redirect(array(
										'controller' => 'transactions',
										'action' => 'index',
										'admin' => false
									));
								}

						} else{
							 $this->redirect(array(
										'controller' => 'transactions',
										'action' => 'index',
										'admin' => false
								));
						}
						} else {
							 $this->Session->setFlash(__l('Gift could not be send. Please, try again.') , 'default', null, 'error');
						}
						
					
				} else {
				// failure action
				  $this->Session->setFlash(__l('Failure transaction.') , 'default', null, 'error');
				  $this->redirect(array(
						'controller' => 'pages',
						'action' => 'home',
						'admin' => false
					));

				}			
			break;
			case 'paypal':


			break;
	
		 }
	     $this->autoRender = false;
	
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
    public function admin_index()
    {
        $this->pageTitle = __l('giftUsers');
        $this->GiftUser->recursive = 0;
		$this->paginate = array(

			);
		 $this->paginate = array(
				'contain'=> array(
					'User' => array(
						'fields' => array(
							'User.id',
							'User.email',
							'User.username',
						)					
					),
					'Package' => array(
						'fields' => array(
							'Package.id',
							'Package.cost'
						)	
					),
					'GiftedToUser' => array(
						'fields' => array(
							'GiftedToUser.id',
							'GiftedToUser.email',
							'GiftedToUser.username'
						)	
					)
				),
				'order'=> array(
					'GiftUser.id'=> 'desc'
				)
		);
        $this->set('giftUsers', $this->paginate());
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Gift User');
        if ($this->request->is('post')) {
            $this->GiftUser->create();
            if ($this->GiftUser->save($this->request->data)) {
                $this->Session->setFlash(__l('gift user has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('gift user could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $users = $this->GiftUser->User->find('list');
        $packages = $this->GiftUser->Package->find('list');
        $this->set(compact('users', 'packages'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Gift User');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->GiftUser->id = $id;
        if (!$this->GiftUser->exists()) {
            throw new NotFoundException(__l('Invalid gift user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->GiftUser->save($this->request->data)) {
                $this->Session->setFlash(__l('gift user has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('gift user could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->GiftUser->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['GiftUser']['id'];
        $users = $this->GiftUser->User->find('list');
        $packages = $this->GiftUser->Package->find('list');
        $this->set(compact('users', 'packages'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->GiftUser->id = $id;
        if (!$this->GiftUser->exists()) {
            throw new NotFoundException(__l('Invalid gift user'));
        }
        if ($this->GiftUser->delete()) {
            $this->Session->setFlash(__l('Gift user deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->Session->setFlash(__l('Gift user was not deleted') , 'default', null, 'error');
        $this->redirect(array(
            'action' => 'index'
        ));
    }
}
