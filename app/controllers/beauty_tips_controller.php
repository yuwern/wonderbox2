<?php
class BeautyTipsController extends AppController
{
    public $name = 'BeautyTips';
	public $helpers = array(
        'Gateway',
    );
	public $components = array(
        'Email',
    );
    public function index()
    {
		  $this->_redirectGET2Named(array(
            'q',
	    ));
        $this->pageTitle = __l('BeautyTips');
        $this->BeautyTip->recursive = 1;
		$conditions = array();
		$conditions['BeautyTip.is_active'] = 1; 
		if(!empty($this->params['named']['q'])){
			$conditions['BeautyTip.name LIKE '] = '%' .$this->params['named']['q'] .'%';
			$this->request->data['BeautyTip']['q'] = $this->params['named']['q'];
		}
		if(!empty($this->params['named']['slug'])){
		$category = $this->BeautyTip->Category->find('first',array(
							'conditions' => array(
								'Category.slug'=> $this->params['named']['slug']
							),
							'fields'=> array(
								'Category.id'
							),
							'recursive'=> -1
					)
				);
		  if(!empty($category)){
	 	    $beautytipcategories = $this->BeautyTip->BeautyTipsCategory->find('all',array(
									'conditions' => array(
										'BeautyTipsCategory.category_id'=> $category['Category']['id']
									),
									'fields' => array(
										'BeautyTipsCategory.beauty_tip_id'
									)
								)
			 );
			$conditions['BeautyTip.id'] = Set::extract('/BeautyTipsCategory/beauty_tip_id', $beautytipcategories);
		  }
		}
		$this->paginate = array(
				'contain'=> array(
					'Attachment',
					'Category' => array(
						'fields' => array(
							'Category.name',
							'Category.slug',
						)
					)
				),
				'limit' => 10,
				'conditions'=> $conditions,
				'order'=> array(
					'BeautyTip.id'=>'desc'
				)
		);
		$beautyTipsCount = $this->BeautyTip->find('count',array(
					'conditions' => $conditions
				)
		);
	   $this->set('beautyTipsCount',$beautyTipsCount);
       $beautyTipSliders = $this->BeautyTip->find('all', array(
            'conditions' => array(
                'BeautyTip.is_active = ' => 1
            ) ,
			'contain'=> array(
				'Attachment1',
				'Category' => array(
						'fields' => array(
							'Category.name',
							'Category.slug',
						)
					)
			),
            'fields' => array(
                'BeautyTip.id',
                'BeautyTip.brand_id',
                'BeautyTip.name',
                'BeautyTip.slug',
            ) ,
		    'limit'=> 3,
		    'order'=> array(
				'BeautyTip.id'=>'desc'
			),
            'recursive' => 2,
        ));

	    $this->set('beautyTipSliders',$beautyTipSliders);
		$this->set('beautyTips', $this->paginate());
    }
    public function view($slug = null)
    {
        $this->pageTitle = __l('Beauty Tip');
        $beautyTip = $this->BeautyTip->find('first', array(
            'conditions' => array(
                'BeautyTip.slug = ' => $slug
            ) ,
			'contain'=> array(
				'Attachment1',
				'Attachment2',
				'Category' => array(
						'fields' => array(
							'Category.name',
							'Category.slug',
						)
					)
			),
            'fields' => array(
                'BeautyTip.id',
                'BeautyTip.created',
                'BeautyTip.modified',
                'BeautyTip.user_id',
                'BeautyTip.brand_id',
                'BeautyTip.name',
                'BeautyTip.slug',
                'BeautyTip.description',
                'BeautyTip.about_us',
				'BeautyTip.video_url',
				'BeautyTip.is_purchase',
				'BeautyTip.purchase_amount',
				'BeautyTip.quantity',
				'BeautyTip.redemption_start_date',
				'BeautyTip.redemption_end_date',
                'BeautyTip.is_active',
                ) ,
            'recursive' => 2,
        ));
		$wonder_treat_count = $this->BeautyTip->WonderTreat->find('count', array(
								'conditions' => array(
									'WonderTreat.beauty_tip_id'=> $beautyTip['BeautyTip']['id']
								)
					)
				);
		$remaining_quantity = $beautyTip['BeautyTip']['quantity'] - $wonder_treat_count;
		$this->set('remaining_quantity',$remaining_quantity);
	    if (empty($beautyTip)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->BeautyTip->BeautyTipView->create();
        $this->request->data['BeautyTipView']['user_id'] = $this->Auth->user('id');
        $this->request->data['BeautyTipView']['beauty_tip_id'] = $beautyTip['BeautyTip']['id'];
        $this->request->data['BeautyTipView']['ip'] = $this->RequestHandler->getClientIP();
        $this->BeautyTip->BeautyTipView->save($this->request->data);
        $this->pageTitle.= ' - ' . $beautyTip['BeautyTip']['name'];
        $this->set('beautyTip', $beautyTip);
    }
	public function buy($slug = null ){
		$this->pageTitle = __l('Beauty Tip');
        $beautyTip = $this->BeautyTip->find('first', array(
            'conditions' => array(
                'BeautyTip.slug = ' => $slug
            ) ,
			'fields' => array(
                'BeautyTip.id',
                'BeautyTip.user_id',
                'BeautyTip.brand_id',
                'BeautyTip.name',
                'BeautyTip.slug',
				'BeautyTip.purchase_amount',
				'BeautyTip.is_delivery',
				'BeautyTip.quantity',
				'BeautyTip.redemption_start_date',
				'BeautyTip.redemption_end_date',
                'BeautyTip.is_active',
                ) ,
            'recursive' => -1,
        ));
	    if (empty($beautyTip)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		$wonder_treat_count = $this->BeautyTip->WonderTreat->find('count', array(
								'conditions' => array(
									'WonderTreat.beauty_tip_id'=> $beautyTip['BeautyTip']['id']
								)
					)
				);
		$remaining_quantity = $beautyTip['BeautyTip']['quantity'] - $wonder_treat_count;
		if($remaining_quantity == 0 )
		{
			 $this->Session->setFlash( __l('Beautiy Tips is not avialable'), 'default', null, 'error');
			 $this->redirect(array(
										'controller' => 'beauty_tips',
										'action' => 'index',
										'admin' => false
							));

		}
		/* If check box not check – do not need to show shipping address page in the payment work */
		if(empty($beautyTip['BeautyTip']['is_delivery'])){
		  	$this->loadModel('PaymentGateway');
				$paymentGateway = $this->PaymentGateway->find('first',array(
						'conditions'=> array(
							'PaymentGateway.id'=> ConstPaymentGateways::MOLPay
						)
				));
				if (empty($paymentGateway)) {
					 throw new NotFoundException(__l('Invalid request'));
				}
				$this->pageTitle.= sprintf(__l('Buy %s Subcribed') , $beautyTip['BeautyTip']['name']);
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
			 	$orderID = $this->Auth->user('id').time();
				$amount = number_format($beautyTip['BeautyTip']['purchase_amount'],2);
				$vcode = md5($amount.Configure::read('molpay.merchant_id').$orderID.Configure::read('molpay.verify_key'));
				$country = 'MY';
				$gateway_options = array(
						'is_testmode'=> Configure::read('molpay.is_testmode'),
						'orderID'=> $orderID,
						'description'=> $beautyTip['BeautyTip']['name'] ,
						'amount'=> $amount,
						'cur'=>'RM',
						'returnUrl'=>  Router::url(array(
											'controller' => 'beauty_tips',
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
								'payment_type' => 'BeautyTip',
								'user_id' => $this->Auth->user('id') ,
								'beauty_tip_id' => $beautyTip['BeautyTip']['id'],
								'quantity' => 1,
								'payment_gateway_id' => ConstPaymentGateways::MOLPay,
								'ip' => $this->RequestHandler->getClientIP() ,
								'amount_needed' => $amount,
								'message' => $beautyTip['BeautyTip']['name'],
				); 
				$this->TempPaymentLog->save($transaction_data);
	            $this->set('gateway_options', $gateway_options);
				$this->set('beautyTip', $beautyTip);
				$this->set('action', $action);
			    $this->render('checkout');
		}
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
		$states = $this->UserShipping->State->find('list');	
		$countries = $this->UserShipping->Country->find('list');	
		$this->set(compact('countries', 'states'));
		$this->request->data = $usershipping;
	    $this->set('beautyTip', $beautyTip);
	}
	public function checkout(){
		if(!empty($this->request->data)){
			$this->BeautyTip->User->UserShipping->set($this->request->data['UserShipping']);
			$this->BeautyTip->User->UserProfile->set($this->request->data['UserProfile']);
			if($this->BeautyTip->User->UserShipping->validates()&$this->BeautyTip->User->UserProfile->validates()){
			     $beautyTip = $this->BeautyTip->find('first', array(
					'conditions' => array(
						'BeautyTip.slug = ' => $this->request->data['BeautyTip']['slug']
					) ,
					'fields' => array(
						'BeautyTip.id',
						'BeautyTip.name',
						'BeautyTip.slug',
					 	'BeautyTip.is_delivery',
						'BeautyTip.purchase_amount',
						) ,
					'recursive' => -1,
				));
				$this->request->data['UserShipping']['user_id']= $this->Auth->user('id');
				if(empty($this->request->data['UserShipping']['id']))
				$this->BeautyTip->User->UserShipping->create();
				$this->BeautyTip->User->UserShipping->save($this->request->data,false);
				if (empty($beautyTip)) {
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
				$this->pageTitle.= sprintf(__l('Buy %s Subcribed') , $beautyTip['BeautyTip']['name']);
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
			 	$orderID = $this->Auth->user('id').time();
				$amount = number_format($beautyTip['BeautyTip']['purchase_amount'],2);
				$vcode = md5($amount.Configure::read('molpay.merchant_id').$orderID.Configure::read('molpay.verify_key'));
				$country = 'MY';
				$gateway_options = array(
						'is_testmode'=> Configure::read('molpay.is_testmode'),
						'orderID'=> $orderID,
						'description'=> $beautyTip['BeautyTip']['name'] ,
						'amount'=> $amount,
						'cur'=>'RM',
						'returnUrl'=>  Router::url(array(
											'controller' => 'beauty_tips',
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
								'payment_type' => 'BeautyTip',
								'user_id' => $this->Auth->user('id') ,
								'beauty_tip_id' => $beautyTip['BeautyTip']['id'],
								'quantity' => 1,
								'payment_gateway_id' => ConstPaymentGateways::MOLPay,
								'ip' => $this->RequestHandler->getClientIP() ,
								'amount_needed' => $amount,
								'message' => $beautyTip['BeautyTip']['name'],
				); 
				$this->TempPaymentLog->save($transaction_data);
	            $this->set('gateway_options', $gateway_options);
				$this->set('beautyTip', $beautyTip);
				$this->set('action', $action);
			} else {
					$err_message  = ' ';
				$err_message  .= "<div  style='text-align:left;padding-left:300px;'>";
				if(!empty($this->BeautyTip->User->UserProfile->validationErrors)){
						foreach($this->BeautyTip->User->UserProfile->validationErrors as $key => $uservalidation){
							if($key == 'first_name'){
								if($uservalidation == 'Required')
								$err_message .= '<br/>Please enter the First number';
								else
								$err_message .= '<br/>First number - '.$uservalidation;
							}
							if($key == 'last_name'){
								if($uservalidation == 'Required')
								$err_message .= '<br/>Please enter the Last number';
								else
								$err_message .= '<br/>Last number - '.$uservalidation;
							}
						}
				}
				if(!empty($this->BeautyTip->User->UserShipping->validationErrors)){
						foreach($this->BeautyTip->User->UserShipping->validationErrors as $key => $uservalidation){
							if($key == 'contact_no'){
								if($uservalidation == 'Required')
								$err_message .= '<br/>Please enter the Mobile number';
								else
								$err_message .= '<br/>Mobile Number - '.$uservalidation;
							}
							if($key == 'contact_no1'){
								if($uservalidation == 'Required')
								$err_message .= '<br/>Please enter the Home number';
								else
								$err_message .= '<br/>Home Number - '.$uservalidation;
							}
							if($key == 'address'){
								if($uservalidation == 'Required')
								$err_message .= '<br/>Please enter the Unit/House Number Address';
								else
								$err_message .= '<br/>Address - '.$uservalidation;
							}
							if($key == 'address2'){
								if($uservalidation == 'Required')
								$err_message .= '<br/>Please enter the Street Name/Residential Name Address';
								else
								$err_message .= '<br/>Address - '.$uservalidation;
							}
							if($key == 'zip_code'){
								if($uservalidation == 'Required')
									$err_message .= '<br/>Please enter the zipcode';
								else
								$err_message .= '<br/>Zipcode - '.$uservalidation;
						
							}
					
						}
				}
				$err_message  .=  "</div>";
				$this->Session->setFlash( $err_message, 'default', null, 'error');
				$this->redirect(array(
							'controller' => 'beauty_tips',
							'action' => 'buy',
							$this->request->data['BeautyTip']['slug'],
				));
			}
		}
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
								$beautyTip = $this->BeautyTip->find('first',array(
											'conditions'=> array(
												'BeautyTip.id'=> $tempPaymentLog['TempPaymentLog']['beauty_tip_id']
											),
											'fields'=> array(
												'BeautyTip.id',
												'BeautyTip.name',
												'BeautyTip.slug',
												'BeautyTip.redemption_start_date',
												'BeautyTip.redemption_end_date',
												'BeautyTip.voucher_code',
											),
											'recursive' => -1
								));
								$this->loadModel('Transaction');					
							    $user_id  = $tempPaymentLog['TempPaymentLog']['user_id'];
								$data['Transaction']['user_id'] = $user_id;
								$data['Transaction']['foreign_id'] = $tempPaymentLog['TempPaymentLog']['beauty_tip_id'];
								$data['Transaction']['class'] = 'BeautyTip';
								$data['Transaction']['amount'] = $amount;
								$data['Transaction']['wonder_points'] = 0;
								$data['Transaction']['payment_gateway_id'] = $paymentGateway['PaymentGateway']['id'];
								$data['Transaction']['description'] = 'Payment Success';
								$data['Transaction']['gateway_fees'] = 0;
								$data['Transaction']['transaction_type_id'] = ConstTransactionTypes::BeautyTipAmountPaid;
								$transaction_id = $this->Transaction->log($data);
								if (!empty($transaction_id)) {
									$this->loadModel('EmailTemplate');
									$email_message = $this->EmailTemplate->selectTemplate('Subscription BeautyTip Package');
									$user = $this->BeautyTip->User->find('first', array(
										'conditions'=> array(
											'User.id'=> $user_id
										),
										'contain'=> array(
											'UserProfile'=> array(
												'fields'=> array(
													'UserProfile.first_name',
													'UserProfile.last_name',
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
									$this->BeautyTip->WonderTreat->create();
									$purchase_date = date('Y-m-d H:i:s');
									$wonderTreat['WonderTreat']['purchase_date'] = $purchase_date;
									$wonderTreat['WonderTreat']['user_id'] = $user_id;
									$wonderTreat['WonderTreat']['beauty_tip_id'] = $beautyTip['BeautyTip']['id'];
									$this->BeautyTip->WonderTreat->save($wonderTreat,false);
									$wonder_treat_id = $this->BeautyTip->WonderTreat->id;
									$emailFindReplace = array(
										'##FROM_EMAIL##' => ($email_message['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email_message['from'] ,
										'##SITE_NAME##' => Configure::read('site.name') ,
										'##USERNAME##' => $user['UserProfile']['first_name'].' '.$user['UserProfile']['last_name'],
										'##BEAUTYTIP_NAME##' => $beautyTip['BeautyTip']['name']  ,
										'##BEAUTYTIP_AMOUNT##' => Configure::read('site.currency') . $amount ,
										'##SITE_LINK##' => Router::url('/', true) ,
										'##PURCHASE_ON##' => $purchase_date ,
										'##REDEMPTION_STARTDATE##' => $beautyTip['BeautyTip']['redemption_start_date'] ,
										'##REDEMPTION_ENDDATE##' => $beautyTip['BeautyTip']['redemption_end_date'] ,
										'##VOUCHER_CODE##' => $beautyTip['BeautyTip']['voucher_code'] ,
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
									$file_path = APP . 'media' . DS . 'BeautyContent' . DS . $beautyTip['BeautyTip']['id'] . DS;
									App::import('Core', 'Folder');
									$folder = new Folder($file_path,true,0777);
									$image_name = md5($beautyTip['BeautyTip']['slug'].$wonder_treat_id.time());
									$attachments = $image_name . '.pdf';
									$file_name = $file_path . DS . $attachments;
									chmod($file_name, 0777);
									$username =  $user['UserProfile']['first_name'].' '.$user['UserProfile']['last_name'];
									include APP.DS.'vendors'.DS.'fpdf'.DS.'fpdf.php'; 
									$fpdf = new PDF();
									$fpdf->AddPage();
									$fpdf->Image( WWW_ROOT . DS . 'img' . DS . 'logo.jpg', 10, 10, 50);
									$fpdf->SetFont( 'Arial', 'B', 14 );
									$fpdf->Text( 25, 42, 'Voucher Coupon' );
									$fpdf->ln( 40 );
									$fpdf->SetFont( 'Arial', 'B', 11 );
									$fpdf->Text( 25, 52, 'Beauty Tip' );
									$fpdf->Text( 80, 52, ': '.$beautyTip['BeautyTip']['name']);
									$fpdf->Text( 25, 62, 'User Name' );
									$fpdf->Text( 80, 62, ': '.$username );
									$fpdf->Text( 25, 72, 'Date & Time Purchase');
									$fpdf->Text( 80, 72, ': '.$purchase_date);
									$fpdf->Text( 25, 82, 'Redemption Start Date');
									$fpdf->Text( 80, 82, ': '.$beautyTip['BeautyTip']['redemption_start_date']);
									$fpdf->Text( 25, 92, 'Redemption Start Date');
									$fpdf->Text( 80, 92, ': '.$beautyTip['BeautyTip']['redemption_start_date']);
									$fpdf->Text( 25, 102, 'Price');
									$fpdf->Text( 80, 102, ': RM '.$amount);
									$fpdf->Text( 25, 112, 'Voucher code');
									$fpdf->Text( 80, 112, ': '.$beautyTip['BeautyTip']['voucher_code']);
									$fpdf->SetFont( 'Arial', '', 10 );
									$fpdf->Output($file_name, 'F');
									$this->_sendMail($emailFindReplace, $email_message, $user['User']['email'],'html',$file_path,$attachments);
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
    public function admin_index()
    {
        $this->pageTitle = __l('beautyTips');
		  $this->_redirectGET2Named(array(
            'q',
			'year',
			'month',
        ));
		$conditions = array();
		date_default_timezone_set('UTC');
		if(!empty($this->request->params['named']['month']) &&!empty($this->request->params['named']['year']))
		{
		    $start_date = date('Y-m-d',strtotime($this->request->params['named']['year'].'-'.$this->request->params['named']['month'].'-1'));
			$end_date = date('Y-m-t',strtotime($this->request->params['named']['year'].'-'.$this->request->params['named']['month'].'-1'));
			$conditions['BeautyTip.created >= '] = $start_date;
			$conditions['BeautyTip.created <= '] = $end_date;
			$this->request->data['BeautyTip']['year'] = $this->request->params['named']['year'];
			$this->request->data['BeautyTip']['month'] = $this->request->params['named']['month'];

		}
        $this->BeautyTip->recursive = 2;
		$this->paginate = array(
				'conditions'=> $conditions,
				'contain' => array(
					'Attachment',
					'User'=> array(
						'fields' => array(
							'User.email',
						)
					)
				),
				'order'=> array(
					'BeautyTip.id'=>'desc'
				),
		);
		$moreActions = $this->BeautyTip->moreActions;
		if($this->Auth->user('user_type_id') != ConstUserTypes::Admin)
			unset($moreActions[3]);
		$this->set(compact('moreActions')); 
        $this->set('beautyTips', $this->paginate());
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Beauty Tip');
		 $this->BeautyTip->Attachment->Behaviors->attach('ImageUpload', Configure::read('avatar.file'));
        if (!empty($this->request->data)) {
			 if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
            }
            if (!empty($this->request->data['Attachment']['filename']['name'])) {
                  $this->BeautyTip->Attachment->set($this->request->data);
            }
			$this->request->data['BeautyTip']['voucher_code'] = $this->generateCouponCode();
			$this->BeautyTip->set($this->request->data);
		    $this->BeautyTip->Category->set($this->request->data);
			 $ini_upload_error = 1;
            if ((!empty($this->request->data['Attachment']['filename']) && $this->request->data['Attachment']['filename']['error'] == 1) || (!empty($this->request->data['Attachment1']['filename']) && $this->request->data['Attachment1']['filename']['error'] == 1) ) {
                $ini_upload_error = 0;
            }
			if (empty($this->request->data['Attachment']['filename']['name'])) {
			        $ini_upload_error = 0;
					$this->BeautyTip->Attachment->validationErrors['filename'] = __l('Required');
            }
			if (empty($this->request->data['Attachment1']['filename']['name'])) {
			        $ini_upload_error = 0;
					$this->BeautyTip->Attachment1->validationErrors['filename'] = __l('Required');
            }
			$this->request->data['BeautyTip']['user_id'] = $this->Auth->user('id');
			if(empty($this->request->data['BeautyTip']['is_purchase'])){
				unset($this->BeautyTip->validate['purchase_amount']);
				unset($this->BeautyTip->validate['quantity']);
				unset($this->BeautyTip->validate['voucher_code']);
				unset($this->BeautyTip->validate['quantity']);
				unset($this->BeautyTip->validate['redemption_start_date']);
				unset($this->BeautyTip->validate['redemption_end_date']);
			}
			if($this->BeautyTip->validates()& $this->BeautyTip->Category->validates() && $ini_upload_error){
           	$this->BeautyTip->create();
            if ($this->BeautyTip->save($this->request->data)) {
				  if (!empty($this->request->data['Attachment']['filename']['name'])) {
                        $this->BeautyTip->Attachment->create();
                        $this->request->data['Attachment']['class'] = 'BeautyTip';
                        $this->request->data['Attachment']['foreign_id'] = $this->BeautyTip->id;
                        $this->BeautyTip->Attachment->save($this->request->data['Attachment']);
                }
				if (!empty($this->request->data['Attachment1']['filename']['name'])) {
                        $this->BeautyTip->Attachment->create();
                        $this->request->data['Attachment1']['class'] = 'BeautyTipSlider';
                        $this->request->data['Attachment1']['foreign_id'] = $this->BeautyTip->id;
                        $this->BeautyTip->Attachment->save($this->request->data['Attachment1']);
                }
				if (!empty($this->request->data['Attachment2']['filename']['name'])) {
                        $this->BeautyTip->Attachment->create();
                        $this->request->data['Attachment2']['class'] = 'ContributorImage';
                        $this->request->data['Attachment2']['foreign_id'] = $this->BeautyTip->id;
                        $this->BeautyTip->Attachment->save($this->request->data['Attachment2']);
                }
                $this->Session->setFlash(__l('Beauty Content Page has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Beauty Content Page could not be added. Please, try again.') , 'default', null, 'error');
            }
        }else {
			    if (!empty($this->request->data['Attachment']['filename']) && $this->request->data['Attachment']['filename']['error'] == 1) {
                    $this->BeautyTip->Attachment->validationErrors['filename'] = sprintf(__l('The file uploaded is too big, only files less than %s permitted') , ini_get('upload_max_filesize'));
                }
				if (!empty($this->request->data['Attachment1']['filename']) && $this->request->data['Attachment1']['filename']['error'] == 1) {
                    $this->BeautyTip->Attachment1->validationErrors['filename'] = sprintf(__l('The file uploaded is too big, only files less than %s permitted') , ini_get('upload_max_filesize'));
                }
            
                $this->Session->setFlash(__l('Beauty Content Page  could not be added. Please, try again.') , 'default', null, 'error');
            }
		}
        $brands = $this->BeautyTip->Brand->find('list');
        $categories = $this->BeautyTip->Category->find('list');
		$beautycategories = $this->BeautyTip->BeautyCategory->find('list',array(
						'conditions'=> array(
							'BeautyCategory.is_active'=> 1
						)
					));
        $this->set(compact('brands', 'categories','beautycategories'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Beauty Tip');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->BeautyTip->id = $id;
        if (!$this->BeautyTip->exists()) {
            throw new NotFoundException(__l('Invalid beauty tip'));
        }
		if(empty($this->request->data['BeautyTip']['is_purchase'])){
				unset($this->BeautyTip->validate['purchase_amount']);
				unset($this->BeautyTip->validate['quantity']);
				unset($this->BeautyTip->validate['voucher_code']);
				unset($this->BeautyTip->validate['quantity']);
				unset($this->BeautyTip->validate['redemption_start_date']);
				unset($this->BeautyTip->validate['redemption_end_date']);
		}
        if ($this->request->is('post') || $this->request->is('put')) {
			$this->BeautyTip->set($this->request->data);
		    $this->BeautyTip->Category->set($this->request->data);
			if($this->BeautyTip->validates()& $this->BeautyTip->Category->validates()){
            if ($this->BeautyTip->save($this->request->data)) {
				  $id = $foreign_id = $this->request->data['BeautyTip']['id'];
				   if (!(empty($this->request->data['Attachment']['filename']['name']))) {
					$attach = $this->BeautyTip->Attachment->find('first', array(
						'conditions' => array(
							'Attachment.foreign_id = ' => $foreign_id,
							'Attachment.class = ' => 'BeautyTip'
						) ,
						'fields' => array(
							'Attachment.id'
						) ,
						'recursive' => - 1,
					));
					if(!empty($attach['Attachment']['id']))
			        $this->BeautyTip->Attachment->delete($attach['Attachment']['id']);
				    $this->BeautyTip->Attachment->create();
                    $this->request->data['Attachment']['class'] = 'BeautyTip';
                    $this->request->data['Attachment']['description'] = 'BeautyTip Image';
                    $this->request->data['Attachment']['foreign_id'] = $this->request->data['BeautyTip']['id'];
                    $data['Attachment']['filename'] = $this->request->data['Attachment']['filename'];
                    $this->BeautyTip->Attachment->save($this->request->data['Attachment']);
                  }
				    if (!(empty($this->request->data['Attachment1']['filename']['name']))) {
				  	$attach1 = $this->BeautyTip->Attachment1->find('first', array(
						'conditions' => array(
							'Attachment1.foreign_id = ' => $foreign_id,
							'Attachment1.class = ' => 'BeautyTipSlider'
						) ,
						'fields' => array(
							'Attachment1.id'
						) ,
						'recursive' => - 1,
					));
					if(!empty($attach1['Attachment1']['id']))
			        $this->BeautyTip->Attachment->delete($attach1['Attachment1']['id']);
				    $this->BeautyTip->Attachment->create();
                    $this->request->data['Attachment1']['class'] = 'BeautyTipSlider';
                    $this->request->data['Attachment1']['description'] = 'BeautyTipSlider Image thumb';
                    $this->request->data['Attachment1']['foreign_id'] = $this->request->data['BeautyTip']['id'];
                    $this->BeautyTip->Attachment->save($this->request->data['Attachment1']);
                  }
			    if (!(empty($this->request->data['Attachment2']['filename']['name']))) {
				  	$attach1 = $this->BeautyTip->Attachment2->find('first', array(
						'conditions' => array(
							'Attachment2.foreign_id = ' => $foreign_id,
							'Attachment2.class = ' => 'ContributorImage'
						) ,
						'fields' => array(
							'Attachment2.id'
						) ,
						'recursive' => - 1,
					));
					if(!empty($attach1['Attachment2']['id']))
			        $this->BeautyTip->Attachment->delete($attach1['Attachment2']['id']);
				    $this->BeautyTip->Attachment->create();
                    $this->request->data['Attachment2']['class'] = 'ContributorImage';
                    $this->request->data['Attachment2']['description'] = 'ContributorImage Image thumb';
                    $this->request->data['Attachment2']['foreign_id'] = $this->request->data['BeautyTip']['id'];
                    $this->BeautyTip->Attachment->save($this->request->data['Attachment2']);
                  }
                $this->Session->setFlash(__l('Beauty Content Page has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Beauty Content Page could not be updated. Please, try again.') , 'default', null, 'error');
            }
			}  else {
                $this->Session->setFlash(__l('Beauty Content Page could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->BeautyTip->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['BeautyTip']['name'];
        $brands = $this->BeautyTip->Brand->find('list');
        $categories = $this->BeautyTip->Category->find('list');
        $beautycategories = $this->BeautyTip->BeautyCategory->find('list',array(
						'conditions'=> array(
							'BeautyCategory.is_active'=> 1
						)
					));
		$this->set(compact('brands', 'categories','beautycategories'));
    }
    public function admin_delete($id = null)
    {
	    if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->BeautyTip->delete($id)) {
            $this->Session->setFlash(__l('Beauty Content Page deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
	public function test(){
			$this->layout = false;
			$this->autoRender = false;
			$beautyTip = $this->BeautyTip->find('first',array(
		 						'conditions'=> array(
										'BeautyTip.slug'=> 'beauty-content-1'
								),
								'fields'=> array(
									'BeautyTip.id',
									'BeautyTip.name',
									'BeautyTip.slug',
									'BeautyTip.redemption_start_date',
									'BeautyTip.redemption_end_date',
									'BeautyTip.voucher_code',
									'BeautyTip.team_description',
									'BeautyTip.purchase_amount',
								),
							   'recursive' => -1
						  ));
			$file_path = APP . 'media' . DS . 'BeautyContent' . DS . $beautyTip['BeautyTip']['id'] . DS;
            $Folder =& new Folder($file_path);
            $Folder->create($file_path);
            $Folder->chmod($file_path, 0777);
			$image_name = md5($beautyTip['BeautyTip']['slug'].time());
            $attachments = $image_name . '.pdf';
            $file_name = $file_path . DS . $attachments;
			$username = 'Suresh';
			$purchase_date = '2013-12-09';
			include APP.DS.'vendors'.DS.'fpdf'.DS.'fpdf.php'; 
			$fpdf = new PDF();
			$fpdf->AddPage();
			$fpdf->Image( WWW_ROOT . DS . 'img' . DS . 'logo.jpg', 10, 10, 50);
			$fpdf->SetFont( 'Arial', 'B', 14 );
		    $fpdf->Text( 25, 42, 'Voucher Coupon' );
            $fpdf->ln( 40 );
            $fpdf->SetFont( 'Arial', 'B', 11 );
		    $fpdf->Text( 25, 52, 'Beauty Tip' );
		    $fpdf->Text( 80, 52, ': '.$beautyTip['BeautyTip']['name']);
		    $fpdf->Text( 25, 62, 'User Name' );
		    $fpdf->Text( 80, 62, ': '.$username );
            $fpdf->Text( 25, 72, 'Date & Time Purchase');
            $fpdf->Text( 80, 72, ': '.$purchase_date);
            $fpdf->Text( 25, 82, 'Redemption Start Date');
            $fpdf->Text( 80, 82, ': '.$beautyTip['BeautyTip']['redemption_start_date']);
		    $fpdf->Text( 25, 92, 'Redemption Start Date');
            $fpdf->Text( 80, 92, ': '.$beautyTip['BeautyTip']['redemption_start_date']);
            $fpdf->Text( 25, 102, 'Price');
            $fpdf->Text( 80, 102, ': '.$beautyTip['BeautyTip']['purchase_amount']);
            $fpdf->Text( 25, 112, 'Voucher code');
            $fpdf->Text( 80, 112, ': '.$beautyTip['BeautyTip']['voucher_code']);
			$fpdf->SetFont( 'Arial', '', 10 );
		    $fpdf->Output($file_name, 'F');
			$this->loadModel('EmailTemplate');
			$email_message = $this->EmailTemplate->selectTemplate('Subscription Package');
			$emailFindReplace = array(
					'##FROM_EMAIL##' => ($email_message['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email_message['from'] ,
										'##SITE_NAME##' => Configure::read('site.name') ,
										'##USERNAME##' => $user['UserProfile']['first_name'].'-'.$user['UserProfile']['last_name'],
										'##BEAUTYTIP_NAME##' => $beautyTip['BeautyTip']['name']  ,
										'##BEAUTYTIP_AMOUNT##' => Configure::read('site.currency') . $amount ,
										'##SITE_LINK##' => Router::url('/', true) ,
										'##PURCHASE_ON##' => strftime(Configure::read('site.datetime.format')) ,
										'##REDEMPTION_STARTDATE##' => $beautyTip['BeautyTip']['redemption_start_date'] ,
										'##REDEMPTION_ENDDATE##' => $beautyTip['BeautyTip']['redemption_end_date'] ,
										'##VOUCHER_CODE##' => $beautyTip['BeautyTip']['voucher_code'] ,
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
							
		    $this->_sendMail($emailFindReplace, $email_message, 'suresh.sopenwave@gmail.com',$file_path,$attachments);
		exit;
	}
	public function _sendMail($email_content_array, $template, $to, $sendAs = 'text',$file_path,$attachments)
    {
        $this->loadModel('EmailTemplate');
        $this->Email->from = ($template['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $template['from'];
        $this->Email->replyTo = ($template['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $template['reply_to'];
        $this->Email->to = $to;
        $this->Email->subject = strtr($template['subject'], $email_content_array);
        $this->Email->content = strtr($template['email_content'], $email_content_array);
        $this->Email->sendAs = ($template['is_html']) ? 'html' : 'text';
		$this->Email->filePaths = array(
            $file_path
        );
		$this->Email->attachments = array(
            $attachments
        );
	    $this->Email->send($this->Email->content);
    }
	public function test1(){
	 $this->autoRender = false;
		   $this->loadModel('PaymentGateway');
       $paymentGateway = $this->PaymentGateway->find('first', array(
            'conditions' => array(
                'PaymentGateway.id' => 2
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
			 $orderid = 1364219760;
			 echo $molpay_merchant_id;
			 echo "<br/>";
			 $skey = md5( $orderid.$molpay_merchant_id.$molpay_verify_key );
			 echo $skey;
			 echo "<br/>";
			 echo "https://www.onlinepayment.com.my/MOLPay/q_by_tid.php?amount=3899&txID=1372220620&domain=shopA&skey= e1c4c60c99116fffc3ce77bd5fd0f7b1";
			 echo "https://www.onlinepayment.com.my/MOLPay/query/q_oid_batch.php?oID=$orderid&domain=$molpay_merchant_id&skey=$skey";
	echo "tesT";
	exit;
	}
}
