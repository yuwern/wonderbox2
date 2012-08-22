<?php
class PackagesController extends AppController
{
    public $name = 'Packages';
	var $uses = array(
        'Package',
    	'Transaction',
	 );
	public $components = array(
        'Email',
        'Paypal',
	);
	public $helpers = array(
        'Gateway',
    );
	public $disabledFields = array(
        'Package.token',
        'UserProfile.address',
        'UserProfile.zipcode',
        'UserProfile.id',
        'UserShipping',
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = $this->disabledFields;
        parent::beforeFilter();
    }
    public function index()
    {
       $this->pageTitle = __l('packages');
        $this->Package->recursive = 0;
		$this->paginate = array(
			'conditions'=> array(
			'Package.is_active'=> 1
		  )
		);

	    $this->set('packages', $this->paginate());
    }
	public function subscribe(){
       $this->pageTitle = __l('packages');
        $this->Package->recursive = 0;
		$this->paginate = array(
			'conditions'=> array(
			'Package.is_active'=> 1
		  )
		);
		$this->loadModel('PaymentGateway');
		$paymentgateways = $this->PaymentGateway->find('list',array(
					'conditions'=> array(
						'PaymentGateway.is_active'=> 1
					)
		));
		$this->set('paymentgateways',$paymentgateways);
	    $this->set('packages', $this->paginate());
	}
	public function view($slug = null)
    {
        $this->pageTitle = __l('Subscription');
        $package = $this->Package->find('first', array(
            'conditions' => array(
                'Package.slug = ' => $slug
            ) ,
            'fields' => array(
                'Package.id',
                'Package.created',
                'Package.modified',
                'Package.name',
                'Package.slug',
                'Package.description',
                'Package.package_type_id',
                'Package.cost',
                'Package.no_of_wonderpoints',
                'Package.is_active',
                'PackageType.id',
                'PackageType.created',
                'PackageType.modified',
                'PackageType.name',
                'PackageType.is_active',
            ) ,
            'recursive' => 0,
        ));
        if (empty($package)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		$this->loadModel('PaymentGateway');
		$paymentgateways = $this->PaymentGateway->find('list',array(
					'conditions'=> array(
						'PaymentGateway.is_active'=> 1
					)
		));
		$this->set('paymentgateways',$paymentgateways);
		$user_id = $this->Auth->user('id');
		$this->loadModel('UserShipping');
		$usershipping = $this->UserShipping->find('first',array(
					'conditions'=> array(
						'UserShipping.user_id'=> $user_id
					),
					'contain'=> array(
						'User'=> array(
							'UserProfile'=> array(
								'fields'=> array(
									'UserProfile.first_name',
									'UserProfile.last_name',
								)
							),
							'fields'=> array(
									'User.email',
									'User.id'
								)
						),
						'Country'=> array(
								'fields'=> array(
									'Country.name',
									'Country.id'
								)
						),
						'State'=> array(
								'fields'=> array(
									'State.id',
									'State.name'
								)
						)
					)
			 )
		 );
		$states = $this->Package->PackageUser->User->UserShipping->State->find('list');	
		$countries = $this->Package->PackageUser->User->UserShipping->Country->find('list');	
		 $this->set(compact('countries', 'states'));
		/* echo "<pre>";
		 print_r($usershipping);
		 exit;
		 $user = $this->Package->PackageUser->User->find('first', array(
							'conditions'=> array(
								'User.id'=> $user_id
							),
							'contain'=> array(
								'UserProfile'
							),
							'recursive'=> 1
							)
						);
		*/
		
		$this->request->data = $usershipping;
        $this->pageTitle.= ' - ' . $package['Package']['name'];
        $this->set('package', $package);
    }
	public function purchase(){
	if(!empty($this->request->data)){
		$this->Package->PackageUser->User->UserShipping->set($this->request->data['UserShipping']);
		if($this->Package->PackageUser->User->UserShipping->validates()){
			$package = $this->Package->find('first', array(
            'conditions' => array(
                'Package.slug = ' => $this->request->data['Package']['slug']
            ) ,
            'fields' => array(
                'Package.id',
                'Package.name',
                'Package.slug',
                'Package.description',
                'Package.package_type_id',
                'Package.cost',
                'Package.no_of_wonderpoints',
                'Package.is_active',
                'PackageType.id',
                'PackageType.name',
            ) ,
            'recursive' => 0,
			));
			$this->request->data['UserShipping']['user_id']= $this->Auth->user('id');
			if(empty($this->request->data['UserShipping']['id']))
			$this->Package->PackageUser->User->UserShipping->create();

			$this->Package->PackageUser->User->UserShipping->save($this->request->data['UserShipping'],false);
			if (empty($package)) {
				 throw new NotFoundException(__l('Invalid request'));
			}
			$this->loadModel('PaymentGateway');
			$paymentGateway = $this->PaymentGateway->find('first',array(
					'conditions'=> array(
						'PaymentGateway.id'=> $this->request->data['Package']['package_type_id']
					)
			));
			if (empty($paymentGateway)) {
				 throw new NotFoundException(__l('Invalid request'));
			}
	        $this->pageTitle.= sprintf(__l('Buy %s Subcribed') , $package['Package']['name']);
			$action = strtolower(str_replace(' ', '', $paymentGateway['PaymentGateway']['name']));
            if ($paymentGateway['PaymentGateway']['name'] == 'PayPal') {
				  $this->Paypal->initialize($this);
				  $sender_info['is_testmode'] = $paymentGateway['PaymentGateway']['is_test_mode'];
		          if (!empty($paymentGateway['PaymentGatewaySetting'])) {
                            foreach($paymentGateway['PaymentGatewaySetting'] as $paymentGatewaySetting) {
                                if ($paymentGatewaySetting['key'] == 'API_UserName') {
                                     $sender_info['API_UserName']  = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
                                }
                                if ($paymentGatewaySetting['key'] == 'API_Password') {
                                    $sender_info['API_Password']  = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
                                }								
                                if ($paymentGatewaySetting['key'] == 'API_Signature') {
                                     $sender_info['API_Signature']  =  $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
                                }
                            }
                  }
				  $gateway_options = array(
						 'name'=>   Configure::read('site.name').' '.__l('Subscription'),
						 'description'=> $package['Package']['name'],	
					     'cancelUrl' => Router::url('/', true) . 'packages/payment_cancel',
                         'returnUrl' => Router::url('/', true) . 'packages/express_checkout/'. $package['Package']['slug'],
						 'invnum'=> $package['Package']['id'],	
					     'amount'=> number_format($package['Package']['cost'],2),
                    );
				 $payment_response = $this->Paypal->doSetExpressCheckout($gateway_options, $sender_info);
				 if (!empty($payment_response) && strtoupper($payment_response['ACK']) != 'SUCCESS') {
                    $this->Session->setFlash(sprintf(__l('%s') , $payment_response['L_LONGMESSAGE0']) , 'default', null, 'error');
                    return;
                 }
				  else {
					// send user to paypal
					$token = urldecode($payment_response["TOKEN"]);
					$this->Paypal->RedirectToPayPal($token, $sender_info['is_testmode']);
				 } 
				 exit;
				 
			}else if ($paymentGateway['PaymentGateway']['name'] == 'MolPAY') {
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
				'cur'=>'USD',
				'returnUrl'=>  Router::url(array(
                                    'controller' => 'packages',
                                    'action' => 'processpayment','molpay',
                                    'city' => $this->request->params['named']['city'],
                                    'admin' => false
                                ) , true),
				'country'=> $country,
				'vcode'=> $vcode

			);
	 	    $this->loadModel('TempPaymentLog');
		    $transaction_data['TempPaymentLog'] = array(
                            'order_id' => $orderID,
                            'payment_type' => 'Buy Package',
                            'user_id' => $this->Auth->user('id') ,
                            'package_id' => $package['Package']['id'],
                            'quantity' => 1,
                            'payment_gateway_id' => $this->request->data['Package']['package_type_id'],
                            'ip' => $this->RequestHandler->getClientIP() ,
                            'amount_needed' => $amount,
                            'message' => $package['Package']['name'],
            );
			$cookie_value = $this->Cookie->read('referrer');
            $refer_id = (!empty($cookie_value)) ? $cookie_value['refer_id'] : null;
            if (!empty($refer_id)) {
                            $transaction_data['TempPaymentLog']['referred_user_id'] = $refer_id;
            }
			$this->TempPaymentLog->save($transaction_data);
            $this->set('gateway_options', $gateway_options);
		 }
		 else {
				 $this->Session->setFlash(__l('Please enter shipping information before purchase.') , 'default', null, 'error');
				 $this->redirect(array(
							'controller' => 'packages',
							'action' => 'view',
							$this->request->data['Package']['slug']
					));	
			}
		 }
		 $this->set('package', $package);
		 $this->set('action', $action);
	}
	public function paypal(){
		$this->autoRender = false;
		if(!empty($this->request->data)){
		$this->loadModel('PaymentGateway');
			$paymentGateway = $this->PaymentGateway->find('first',array(
					'conditions'=> array(
						'PaymentGateway.id'=> $this->request->data['Package']['package_type_id']
					)
			));
		 $package = $this->Package->find('first', array(
            'conditions' => array(
                'Package.id = ' => $this->request->data['Package']['id']
            ) ,
            'fields' => array(
                'Package.id',
                'Package.name',
                'Package.slug',
                'Package.description',
                'Package.package_type_id',
                'Package.cost',
                'Package.no_of_wonderpoints',
                'Package.is_active',
                'PackageType.id',
                'PackageType.name',
            ) ,
            'recursive' => 0,
			));
			if (empty($package)) {
				 throw new NotFoundException(__l('Invalid request'));
			}
			 $this->pageTitle.= sprintf(__l('Buy %s Subcribed') , $package['Package']['name']);
			$action = strtolower(str_replace(' ', '', $paymentGateway['PaymentGateway']['name']));
            if ($paymentGateway['PaymentGateway']['name'] == 'PayPal') {
				  $this->Paypal->initialize($this);
				  $sender_info['is_testmode'] = $paymentGateway['PaymentGateway']['is_test_mode'];
		          if (!empty($paymentGateway['PaymentGatewaySetting'])) {
                            foreach($paymentGateway['PaymentGatewaySetting'] as $paymentGatewaySetting) {
                                if ($paymentGatewaySetting['key'] == 'API_UserName') {
                                     $sender_info['API_UserName']  = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
                                }
                                if ($paymentGatewaySetting['key'] == 'API_Password') {
                                    $sender_info['API_Password']  = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
                                }								
                                if ($paymentGatewaySetting['key'] == 'API_Signature') {
                                     $sender_info['API_Signature']  =  $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
                                }
                            }
                  }
				  $gateway_options = array(
						 'name'=>   Configure::read('site.name').' '.__l('Subscription'),
						 'description'=> $package['Package']['name'],	
					     'cancelUrl' => Router::url('/', true) . 'packages/payment_cancel',
                         'returnUrl' => Router::url('/', true) . 'packages/express_checkout/'. $package['Package']['slug'],
						 'invnum'=> $package['Package']['id'],	
					     'amount'=> number_format($package['Package']['cost'],2),
                    );
				 $payment_response = $this->Paypal->doSetExpressCheckout($gateway_options, $sender_info);
				 if (!empty($payment_response) && strtoupper($payment_response['ACK']) != 'SUCCESS') {
                    $this->Session->setFlash(sprintf(__l('%s') , $payment_response['L_LONGMESSAGE0']) , 'default', null, 'error');
                    return;
                 }
				  else {
					// send user to paypal
					$token = urldecode($payment_response["TOKEN"]);
					$this->Paypal->RedirectToPayPal($token, $sender_info['is_testmode']);
				 } 
				 exit;
				 
			}
		}
	}
	public function express_checkout($slug = null){
		$package = $this->Package->find('first',array(
					'conditions'=> array(
						'Package.slug'=> $slug
					),
					'recursive'=> -1
		));
		if(empty($package)){
		    throw new NotFoundException(__l('Invalid request'));
        }
		$this->loadModel('PaymentGateway');
		$paymentGateway = $this->PaymentGateway->find('first',array(
					'conditions'=> array(
						'PaymentGateway.id'=> ConstPaymentGateways::PayPal
					)
		));
		 $sender_info['is_testmode'] = $paymentGateway['PaymentGateway']['is_test_mode'];
		  if (!empty($paymentGateway['PaymentGatewaySetting'])) {
					foreach($paymentGateway['PaymentGatewaySetting'] as $paymentGatewaySetting) {
						if ($paymentGatewaySetting['key'] == 'API_UserName') {
							 $sender_info['API_UserName']  = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
						}
						if ($paymentGatewaySetting['key'] == 'API_Password') {
							$sender_info['API_Password']  = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
						}								
						if ($paymentGatewaySetting['key'] == 'API_Signature') {
							 $sender_info['API_Signature']  =  $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
						}
					}
		  }
		$payment_response = $this->Paypal->doGetExpressCheckoutDetails($_REQUEST['token'],$sender_info);
		$post_data['TOKEN'] = $_REQUEST['token'];
		$post_data['PAYERID'] = $_REQUEST['PayerID'];
		$post_data['Amount'] = $package['Package']['cost'];
		$this->set('payment_response',$payment_response);
		$this->set('slug',$slug);
		$this->set('post_data',$post_data);
	}
	public function confirm_checkout(){
		$this->loadModel('PaymentGateway');
		$paymentGateway = $this->PaymentGateway->find('first',array(
					'conditions'=> array(
						'PaymentGateway.id'=> ConstPaymentGateways::PayPal
					)
		));
		$sender_info['is_testmode'] = $paymentGateway['PaymentGateway']['is_test_mode'];
		if (!empty($paymentGateway['PaymentGatewaySetting'])) {
					foreach($paymentGateway['PaymentGatewaySetting'] as $paymentGatewaySetting) {
						if ($paymentGatewaySetting['key'] == 'API_UserName') {
							 $sender_info['API_UserName']  = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
						}
						if ($paymentGatewaySetting['key'] == 'API_Password') {
							$sender_info['API_Password']  = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
						}								
						if ($paymentGatewaySetting['key'] == 'API_Signature') {
							 $sender_info['API_Signature']  =  $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
						}
					}
		}
		if(!empty($this->request->data['Package'])){
			$package = $this->Package->find('first',array(
					'conditions'=> array(
						'Package.slug'=> $this->request->data['Package']['slug']
					),
					'recursive'=> -1
			));
			if(empty($package)){
			    throw new NotFoundException(__l('Invalid request'));
			}
			$user_id = $this->Auth->user('id');
			$post_data['TOKEN'] = $this->request->data['Package']['token'];
			$post_data['PAYERID'] = $this->request->data['Package']['payid'];
			$post_data['Amount'] = $package['Package']['cost'];
			$payment_response = $this->Paypal->doExpressCheckoutPayment($post_data,$sender_info);
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_token'] = $payment_response['TOKEN'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_timestamp'] = $payment_response['TIMESTAMP'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_correlation_id'] = $payment_response['CORRELATIONID'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_ack'] = $payment_response['ACK'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_build'] = $payment_response['BUILD'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_transaction_id'] = $payment_response['TRANSACTIONID'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_transaction_type'] = $payment_response['TRANSACTIONTYPE'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_payment_type'] = $payment_response['PAYMENTTYPE'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_order_time'] = $payment_response['ORDERTIME'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_amt'] = $payment_response['AMT'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_fee_amt'] = $payment_response['FEEAMT'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_tax_amt'] = $payment_response['TAXAMT'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_currency_code'] = $payment_response['CURRENCYCODE'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_payment_status'] = $payment_response['PAYMENTSTATUS'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_pending_reason'] = $payment_response['PENDINGREASON'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_reason_code'] = $payment_response['REASONCODE'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_insurance_option_selected'] = $payment_response['INSURANCEOPTIONSELECTED'];
			$paypal_transaction_logs['PaypalTransactionLog']['doexpresscheckout_shipping_option_isdefault'] = $payment_response['SHIPPINGOPTIONISDEFAULT'];
			$this->set('payment_response',$payment_response);
			if(!empty($payment_response['ACK']) && strtoupper($payment_response['ACK']) =='SUCCESS'){
				$amount = $payment_response['AMT'];
				$data['Transaction']['user_id'] = $user_id;
				$data['Transaction']['foreign_id'] = $package['Package']['id'];
				$data['Transaction']['class'] = 'Package';
				$data['Transaction']['amount'] = $amount ;
				$data['Transaction']['payment_gateway_id'] = ConstPaymentGateways::PayPal;
				$data['Transaction']['description'] = 'Payment Success';
				$data['Transaction']['gateway_fees'] = 0;
				$data['Transaction']['transaction_type_id'] = ConstTransactionTypes::PaidlAmountToCompany;
				$transaction_id = $this->Transaction->log($data);
				if (!empty($transaction_id)) {
						$package=$this->Package->find('first',array(
								'conditions'=> array(
									'Package.id'=>  $package['Package']['id']
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
						$start_date = date('Y-m-d');
						$user = $this->Package->PackageUser->User->find('first', array(
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
						// Referral friend code 
						if (!empty($user['User']['referred_by_user_id'])) { 
							$packageUser['PackageUser']['referred_by_user_id'] = $user['User']['referred_by_user_id'];
						} else {
							$cookie_value = $this->Cookie->read('referrer');
							$refer_id = (!empty($cookie_value)) ? $cookie_value['refer_id'] : null;
							if (!empty($refer_id)) {
								$packageUser['PackageUser']['referred_by_user_id']  = $refer_id;
							}
						}
						// end Referral friend code 
						$dateMonthAdded = strtotime(date("Y-m-d", strtotime($start_date)) . "+".$package['PackageType']['no_of_months']." month");
						$end_date = date('Y-m-d', $dateMonthAdded);
						$this->Package->PackageUser->create();
						$packageUser['PackageUser']['package_id'] = $package['Package']['id'];
						$packageUser['PackageUser']['user_id'] = $user_id;
						$packageUser['PackageUser']['start_date'] = $start_date;
						$packageUser['PackageUser']['end_date'] = $end_date;
						$packageUser['PackageUser']['is_paid'] = 1;
						$this->Package->PackageUser->save($packageUser);
						$this->Package->PackageUser->User->updateAll(array(
							'User.is_verified_user' => 1,
							'User.available_wonder_points' => 'User.available_wonder_points + '. $package['Package']['no_of_wonderpoints'],
							'User.subscription_expire_date' => $end_date,
						) , array(
							'User.id' => $user_id
						));
			
						$cookie_value = $this->Cookie->read('referrer');
						if(!empty($user['User']['referred_by_user_id'])){
							$this->_pay_to_referrer($user);
						}	
						if (!empty($cookie_value)) {
							$this->Cookie->delete('referrer'); // Delete referer cookie
							
						}
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
							'##PURCHASE_EXPIRY##' => $end_date ,
							'##WONDER_POINT##' => $package['Package']['no_of_wonderpoints'] ,
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
			
				}
				$paypal_transaction_logs['PaypalTransactionLog']['transaction_id'] = $transaction_id;
				$paypal_transaction_logs['PaypalTransactionLog']['user_id'] = $user_id;
				$paypal_transaction_logs['PaypalTransactionLog']['package_user_id'] =  $package['Package']['id'];
				$payment_response = array_merge($payment_response,array('no_of_months'=> $package['PackageType']['no_of_months']));
				$profile_response = $this->Paypal->CreateRecurringPaymentsProfile($payment_response,$sender_info);
				if(!empty($profile_response['ACK']) && strtoupper($profile_response['ACK']) == 'SUCCESS'){
					$paypal_transaction_logs['PaypalTransactionLog']['docreaterecurringpaymentsprofile_profileid'] = $profile_response['PROFILEID'];
					$paypal_transaction_logs['PaypalTransactionLog']['docreaterecurringpaymentsprofile_profilestatus'] = $profile_response['PROFILESTATUS'];
					$paypal_transaction_logs['PaypalTransactionLog']['docreaterecurringpaymentsprofile_timestamp'] = $profile_response['TIMESTAMP'];
					$paypal_transaction_logs['PaypalTransactionLog']['docreaterecurringpaymentsprofile_correlationid'] = $profile_response['CORRELATIONID'];
					$paypal_transaction_logs['PaypalTransactionLog']['docreaterecurringpaymentsprofile_ack'] = $profile_response['ACK'];
					$paypal_transaction_logs['PaypalTransactionLog']['docreaterecurringpaymentsprofile_version'] = $profile_response['VERSION'];
					$paypal_transaction_logs['PaypalTransactionLog']['docreaterecurringpaymentsprofile_build'] = $profile_response['BUILD'];
				}
				$this->Package->PackageUser->PaypalTransactionLog->create();
				$this->Package->PackageUser->PaypalTransactionLog->save($paypal_transaction_logs,false);
				$this->Session->setFlash(__l('Payment is done successfully..') , 'default', null, 'success');
				$this->redirect(array(
					'controller' => 'transactions',
					'action' => 'index',
				));
			} else {
				$this->pageTitle = __l('Payment Cancel');
				$this->Session->setFlash(__l('Transaction failure. Please try once again.') , 'default', null, 'error');
				$this->redirect(array(
					'controller' => 'transactions',
					'action' => 'index',
				));
			}
		}

 	}
	public function payment_cancel()
    {
        $this->pageTitle = __l('Payment Cancel');
        $this->Session->setFlash(__l('Transaction failure. Please try once again.') , 'default', null, 'error');
        $this->redirect(array(
    	'controller' => 'transactions',
		'action' => 'index',
        ));
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
									'TempPaymentLog.order_id'=> $orderid
								)
							));
						if(!empty($tempPaymentLog)){		
							    $user_id  = $tempPaymentLog['TempPaymentLog']['user_id'];
								$data['Transaction']['user_id'] = $user_id;
								$data['Transaction']['foreign_id'] = $tempPaymentLog['TempPaymentLog']['package_id'];
								$data['Transaction']['class'] = 'Package';
								$data['Transaction']['amount'] = $amount;
								$data['Transaction']['payment_gateway_id'] = $paymentGateway['PaymentGateway']['id'];
								$data['Transaction']['description'] = 'Payment Success';
								$data['Transaction']['gateway_fees'] = 0;
								$data['Transaction']['transaction_type_id'] = ConstTransactionTypes::PaidlAmountToCompany;
								$transaction_id = $this->Transaction->log($data);
									if (!empty($transaction_id)) {
										$package=$this->Package->find('first',array(
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
									$start_date = date('Y-m-d');
									// Referral friend code 
					                if (!empty($tempPaymentLog['TempPaymentLog']['referred_by_user_id'])) { 
										$packageUser['PackageUser']['referred_by_user_id'] = $tempPaymentLog['TempPaymentLog']['referred_by_user_id'];
									} else {
										$cookie_value = $this->Cookie->read('referrer');
										$refer_id = (!empty($cookie_value)) ? $cookie_value['refer_id'] : null;
										if (!empty($refer_id)) {
											$packageUser['PackageUser']['referred_by_user_id']  = $refer_id;
										}
									}
									// end Referral friend code 
									$dateMonthAdded = strtotime(date("Y-m-d", strtotime($start_date)) . "+".$package['PackageType']['no_of_months']." month");
									$end_date = date('Y-m-d', $dateMonthAdded);
									$this->Package->PackageUser->create();
									$packageUser['PackageUser']['package_id'] = $package['Package']['id'];
									$packageUser['PackageUser']['user_id'] = $user_id;
									$packageUser['PackageUser']['start_date'] = $start_date;
									$packageUser['PackageUser']['end_date'] = $end_date;
									$packageUser['PackageUser']['is_paid'] = 1;
									$this->Package->PackageUser->save($packageUser);
							        $this->Package->PackageUser->User->updateAll(array(
										'User.is_verified_user' => 1,
										'User.available_wonder_points' => 'User.available_wonder_points + '. $package['Package']['no_of_wonderpoints'],
										'User.subscription_expire_date' => $end_date,
									) , array(
										'User.id' => $user_id
									));
									$user = $this->Package->PackageUser->User->find('first', array(
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
									$cookie_value = $this->Cookie->read('referrer');
									if(!empty($user['User']['referred_by_user_id'])){
										$this->_pay_to_referrer($user);
									}	
									if (!empty($cookie_value)) {
                                        $this->Cookie->delete('referrer'); // Delete referer cookie
                                        
                                    }
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
										'##PURCHASE_EXPIRY##' => $end_date ,
										'##WONDER_POINT##' => $package['Package']['no_of_wonderpoints'] ,
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
	    //pay referal amount to user when the new user buy his first deal
    public function _pay_to_referrer($package_user_data)
    {
        $today = strtotime(date('Y-m-d H:i:s'));
        $registered_date = strtotime(_formatDate('Y-m-d H:i:s', strtotime($package_user_data['User']['created'])));
        $hours_diff = intval(($today - $registered_date) / 60 / 60);
	   //check whether this is user's first deal and bought with in correct limit
        if ($hours_diff <= Configure::read('referral.referral_cookie_expire_time')) {
            //add wonder points to referred user
            $transaction['Transaction']['user_id'] = $package_user_data['User']['referred_by_user_id'];
            $transaction['Transaction']['foreign_id'] = ConstUserIds::Admin;
            $transaction['Transaction']['class'] = 'SecondUser';
            $transaction['Transaction']['amount'] = 0;
            $transaction['Transaction']['wonder_points'] = Configure::read('referral.referral_wonder_points');
            $transaction['Transaction']['transaction_type_id'] = ConstTransactionTypes::ReferralWonderPoint;
            $this->Transaction->log($transaction);
            $transaction = array();
            //admin record for referral amount
            $transaction['Transaction']['user_id'] = ConstUserIds::Admin;
            $transaction['Transaction']['foreign_id'] =  $package_user_data['User']['referred_by_user_id'];
            $transaction['Transaction']['class'] = 'SecondUser';
            $transaction['Transaction']['amount'] = 0;
            $transaction['Transaction']['wonder_points'] = Configure::read('referral.referral_wonder_points');
            $transaction['Transaction']['transaction_type_id'] = ConstTransactionTypes::ReferralWonderPointAdd;
            $this->Transaction->log($transaction);
            $this->Package->PackageUser->User->updateAll(array(
                'User.available_wonder_points' => 'User.available_wonder_points +' . Configure::read('referral.referral_wonder_points')
            ) , array(
                'User.id' => $package_user_data['User']['referred_by_user_id']
            ));
        }
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
        $this->pageTitle = __l('packages');
        $this->Package->recursive = 0;
        $this->set('packages', $this->paginate());
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Package');
        if ($this->request->is('post')) {
            $this->Package->create();
            if ($this->Package->save($this->request->data)) {
                $this->Session->setFlash(__l('package has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('package could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $packageTypes = $this->Package->PackageType->find('list');
        $this->set(compact('packageTypes'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Package');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->Package->id = $id;
        if (!$this->Package->exists()) {
            throw new NotFoundException(__l('Invalid package'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Package->save($this->request->data)) {
                $this->Session->setFlash(__l('package has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('package could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->Package->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['Package']['name'];
        $packageTypes = $this->Package->PackageType->find('list');
        $this->set(compact('packageTypes'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Package->id = $id;
        if (!$this->Package->exists()) {
            throw new NotFoundException(__l('Invalid package'));
        }
        if ($this->Package->delete()) {
            $this->Session->setFlash(__l('Package deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->Session->setFlash(__l('Package was not deleted') , 'default', null, 'error');
        $this->redirect(array(
            'action' => 'index'
        ));
    }
}
