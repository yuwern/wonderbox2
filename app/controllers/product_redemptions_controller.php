<<<<<<< HEAD
<?php
class ProductRedemptionsController extends AppController
{
    public $name = 'ProductRedemptions';
    public $components = array(
        'Email',
    );
    public $helpers = array(
        'Gateway',
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment',
            'RelatedProduct',
            'ProductRedemption.relatedproduct_count'
        );
        parent::beforeFilter();
    }
    public function index()
    {
        $this->pageTitle = __l('productRedemptions');
        $this->ProductRedemption->recursive = 2;
        $this->paginate = array(
            'conditions'=> array(
                'ProductRedemption.is_active' => 1
            ),
            'contain'=> array(
                'Attachment',
                'RelatedProduct' => array(
                    'fields' => array(
                        'RelatedProduct.id',
                        'RelatedProduct.name',
                        'RelatedProduct.slug',
                    )
                )
            ),
            'fields' => array(
                'ProductRedemption.id',
                'ProductRedemption.name',
                'ProductRedemption.slug',
                'ProductRedemption.redeem_wonder_point',
                'ProductRedemption.is_purchase',
                'ProductRedemption.purchase_amount',
                'ProductRedemption.quantity'
            ),
            'order' => array(
                'ProductRedemption.id'=>'desc'
            )
        );
        $this->set('productRedemptions', $this->paginate());
    }
    public function view($slug = null)
    {
        $this->pageTitle = __l('Product Redemption');
        $productRedemption = $this->ProductRedemption->find('first', array(
            'conditions' => array(
                'ProductRedemption.slug = ' => $slug
            ) ,
            'contain'=> array(
                'Attachment',
                'RelatedProduct' => array(
                    'order'=> array(
                        'RelatedProduct.id'=>'desc'
                    ),
                    'Attachment',
                    'fields' => array(
                        'RelatedProduct.id',
                        'RelatedProduct.name',
                        'RelatedProduct.price',
                        'RelatedProduct.slug',
                    )
                )
            ),
            'fields' => array(
                'ProductRedemption.id',
                'ProductRedemption.name',
                'ProductRedemption.short_description',
                'ProductRedemption.description',
                'ProductRedemption.slug',
                'ProductRedemption.is_purchase',
            ),
            'recursive' => 2,
        ));
        if (empty($productRedemption)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $productRedemption['ProductRedemption']['name'];
        $this->set('productRedemption', $productRedemption);
    }
    public function buy($slug = null ){
        $this->pageTitle = __l('Product Redemption & Sales');
        $productRedemption = $this->ProductRedemption->find('first', array(
            'conditions' => array(
                'ProductRedemption.slug = ' => $slug
            ) ,
            'fields' => array(
                'ProductRedemption.id',
                'ProductRedemption.name',
                'ProductRedemption.slug',
                'ProductRedemption.purchase_amount',
                'ProductRedemption.quantity',
                'ProductRedemption.is_delivery',
            ) ,
            'recursive' => -1,
        ));
        $productRedemptionUserCount = $this->ProductRedemption->ProductRedemptionUser->find('count', array(
            'conditions' => array(
                'ProductRedemptionUser.product_redemption_id'=> $productRedemption['ProductRedemption']['id']
            ),
            'recursive' => -1
        ));
        $remaining_quantity = $productRedemption['ProductRedemption']['quantity'] - $productRedemptionUserCount;
        if($remaining_quantity <= 0 )
        {
            $this->Session->setFlash( __l('Beautiy Tips is not avialable'), 'default', null, 'error');
            $this->redirect(array(
                'controller' => 'beauty_tips',
                'action' => 'index',
                'admin' => false
            ));

        }
        if (empty($productRedemption)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        /* If check box not check � do not need to show shipping address page in the payment work */
        if(empty($productRedemption['ProductRedemption']['is_delivery'])){
            $this->loadModel('PaymentGateway');
            $paymentGateway = $this->PaymentGateway->find('first',array(
                'conditions'=> array(
                    'PaymentGateway.id'=> ConstPaymentGateways::MOLPay
                )
            ));
            if (empty($paymentGateway)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $this->pageTitle.= sprintf(__l('Buy %s Subcribed') , $productRedemption['ProductRedemption']['name']);
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
            $amount = number_format($productRedemption['ProductRedemption']['purchase_amount'],2);
            $vcode = md5($amount.Configure::read('molpay.merchant_id').$orderID.Configure::read('molpay.verify_key'));
            $country = 'MY';
            $gateway_options = array(
                'is_testmode'=> Configure::read('molpay.is_testmode'),
                'orderID'=> $orderID,
                'description'=> $productRedemption['ProductRedemption']['name'] ,
                'amount'=> $amount,
                'cur'=>'RM',
                'returnUrl'=>  Router::url(array(
                    'controller' => 'little_black_boxs',
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
                'payment_type' => 'ProductRedemption',
                'user_id' => $this->Auth->user('id') ,
                'product_redemption_id' => $productRedemption['ProductRedemption']['id'],
                'quantity' => 1,
                'payment_gateway_id' => ConstPaymentGateways::MOLPay,
                'ip' => $this->RequestHandler->getClientIP() ,
                'amount_needed' => $amount,
                'message' => $productRedemption['ProductRedemption']['name'],
            );
            $this->TempPaymentLog->save($transaction_data);
            $this->set('gateway_options', $gateway_options);
            $this->set('productRedemption', $productRedemption);
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
        $this->set('productRedemption', $productRedemption);
    }
    public function checkout(){
        if(!empty($this->request->data)){
            $this->loadModel('UserShipping');
            $this->UserShipping->set($this->request->data['UserShipping']);
            $this->UserShipping->User->UserProfile->set($this->request->data['UserProfile']);
            if($this->UserShipping->validates()&$this->UserShipping->User->UserProfile->validates()){
                $productRedemption = $this->ProductRedemption->find('first', array(
                    'conditions' => array(
                        'ProductRedemption.slug = ' => $this->request->data['ProductRedemption']['slug']
                    ) ,
                    'fields' => array(
                        'ProductRedemption.id',
                        'ProductRedemption.name',
                        'ProductRedemption.slug',
                        'ProductRedemption.purchase_amount',
                    ) ,
                    'recursive' => -1,
                ));
                $this->request->data['UserShipping']['user_id']= $this->Auth->user('id');
                if(empty($this->request->data['UserShipping']['id']))
                    $this->UserShipping->create();
                $this->UserShipping->save($this->request->data,false);
                if (empty($productRedemption)) {
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
                $this->pageTitle.= sprintf(__l('Buy %s Subcribed') , $productRedemption['ProductRedemption']['name']);
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
                $amount = number_format($productRedemption['ProductRedemption']['purchase_amount'],2);
                $vcode = md5($amount.Configure::read('molpay.merchant_id').$orderID.Configure::read('molpay.verify_key'));
                $country = 'MY';
                $gateway_options = array(
                    'is_testmode'=> Configure::read('molpay.is_testmode'),
                    'orderID'=> $orderID,
                    'description'=> $productRedemption['ProductRedemption']['name'] ,
                    'amount'=> $amount,
                    'cur'=>'RM',
                    'returnUrl'=>  Router::url(array(
                        'controller' => 'little_black_boxs',
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
                    'payment_type' => 'ProductRedemption',
                    'user_id' => $this->Auth->user('id') ,
                    'product_redemption_id' => $productRedemption['ProductRedemption']['id'],
                    'quantity' => 1,
                    'payment_gateway_id' => ConstPaymentGateways::MOLPay,
                    'ip' => $this->RequestHandler->getClientIP() ,
                    'amount_needed' => $amount,
                    'message' => $productRedemption['ProductRedemption']['name'],
                );
                $this->TempPaymentLog->save($transaction_data);
                $this->set('gateway_options', $gateway_options);
                $this->set('productRedemption', $productRedemption);
                $this->set('action', $action);
            } else {
                $err_message  = ' ';
                $err_message  .= "<div  style='text-align:left;padding-left:300px;'>";
                if(!empty($this->UserShipping->User->UserProfile->validationErrors)){
                    foreach($this->UserShipping->User->UserProfile->validationErrors as $key => $uservalidation){
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
                if(!empty($this->UserShipping->validationErrors)){
                    foreach($this->UserShipping->validationErrors as $key => $uservalidation){
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
                    'controller' => 'little_black_boxs',
                    'action' => 'buy',
                    $this->request->data['ProductRedemption']['slug'],
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
                        $productRedemption = $this->ProductRedemption->find('first', array(
                            'conditions' => array(
                                'ProductRedemption.id = ' => $tempPaymentLog['TempPaymentLog']['product_redemption_id']
                            ) ,
                            'fields' => array(
                                'ProductRedemption.id',
                                'ProductRedemption.name',
                                'ProductRedemption.slug',
                                'ProductRedemption.purchase_amount',
                            ) ,
                            'recursive' => -1,
                        ));
                        $this->loadModel('Transaction');
                        $user_id  = $tempPaymentLog['TempPaymentLog']['user_id'];
                        $data['Transaction']['user_id'] = $user_id;
                        $data['Transaction']['foreign_id'] = $tempPaymentLog['TempPaymentLog']['product_redemption_id'];
                        $data['Transaction']['class'] = 'ProductRedemption';
                        $data['Transaction']['amount'] = $amount;
                        $data['Transaction']['wonder_points'] = 0;
                        $data['Transaction']['payment_gateway_id'] = $paymentGateway['PaymentGateway']['id'];
                        $data['Transaction']['description'] = 'Payment Success';
                        $data['Transaction']['gateway_fees'] = 0;
                        $data['Transaction']['transaction_type_id'] = ConstTransactionTypes::ProductRedemptionAmountPaid;
                        $transaction_id = $this->Transaction->log($data);
                        if (!empty($transaction_id)) {
                            $this->ProductRedemption->ProductRedemptionUser->create();
                            $productredeem['ProductRedemptionUser']['user_id'] = $this->Auth->user('id');
                            $productredeem['ProductRedemptionUser']['is_paid'] = 1;
                            $productredeem['ProductRedemptionUser']['product_redemption_id'] = $productRedemption['ProductRedemption']['id'];
                            $this->ProductRedemption->ProductRedemptionUser->save($productredeem,false);
                            $user = $this->ProductRedemption->ProductRedemptionUser->User->find('first', array(
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
                            $this->loadModel('EmailTemplate');
                            $email = $this->EmailTemplate->selectTemplate('Product Redemption Subscription');
                            $emailFindReplace = array(
                                '##SITE_LINK##' => Router::url('/', true) ,
                                '##USERNAME##' => $user['UserProfile']['first_name'].' '.$user['UserProfile']['last_name'],
                                '##SITE_NAME##' => Configure::read('site.name') ,
                                '##SIGNUP_IP##' => $this->RequestHandler->getClientIP() ,
                                '##PRODUCT_NAME##' => $productRedemption['ProductRedemption']['name'],
                                '##AMOUNT##' => $amount,
                                '##EMAIL##' => $user['User']['email'],
                                '##CONTACT_URL##' => Router::url(array(
                                    'controller' => 'contacts',
                                    'action' => 'add',
                                    'city' => $this->request->params['named']['city'],
                                    'admin' => false
                                ) , true) ,
                                '##FROM_EMAIL##' => $this->ProductRedemption->ProductRedemptionUser->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']) ,
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
                            $this->Email->to = $user['User']['email'];
                            $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                            $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                            $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                            $this->Session->setFlash(__l('Your product redemption completed successfully...') , 'default', null, 'success');
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
    public function redeem($slug)
    {
        $this->autoRender = false;
        $productRedemption = $this->ProductRedemption->find('first', array(
            'conditions' => array(
                'ProductRedemption.slug = ' => $slug
            ) ,
            'fields'=> array(
                'ProductRedemption.id',
                'ProductRedemption.name',
                'ProductRedemption.redeem_wonder_point',
            ),
            'recursive' => -1,
        ));
        if (empty($productRedemption)) {
            throw new NotFoundException(__l('Invalid request'));
        }

        $this->loadModel('User');
        $user = $this->User->find('first',array(
            'conditions'=> array(
                'User.id'=> $this->Auth->user('id')
            ),
            'contain'=> array(
                'UserShipping'
            ),
            'fields'=> array(
                'User.id',
                'User.username',
                'User.email',
                'User.available_wonder_points'
            ),
            'recursive' => 2,
        ));
        if(empty($user['UserShipping'])){
            $this->Session->setFlash(__l('Please updated Shipping Information before Product Redemption') , 'default', null, 'success');
            $this->redirect(array(
                'controller'=>'user_shippings',
                'action' => 'index'
            ));
        }
        if (!empty($user)){
            if ($user['User']['available_wonder_points'] >= $productRedemption['ProductRedemption']['redeem_wonder_point']){
                $this->ProductRedemption->ProductRedemptionUser->create();
                $productredeem['ProductRedemptionUser']['user_id'] = $this->Auth->user('id');
                $productredeem['ProductRedemptionUser']['product_redemption_id'] = $productRedemption['ProductRedemption']['id'];
                $this->ProductRedemption->ProductRedemptionUser->save($productredeem,false);
                $this->User->updateAll(array(
                    'User.available_wonder_points' => 'User.available_wonder_points -' . $productRedemption['ProductRedemption']['redeem_wonder_point'],
                ) , array(
                    'User.id' => $user['User']['id']
                ));
                $this->loadModel('EmailTemplate');
                $email = $this->EmailTemplate->selectTemplate('Product Redemption Confirm');
                $emailFindReplace = array(
                    '##SITE_LINK##' => Router::url('/', true) ,
                    '##USERNAME##' => $user['User']['username'],
                    '##SITE_NAME##' => Configure::read('site.name') ,
                    '##SIGNUP_IP##' => $this->RequestHandler->getClientIP() ,
                    '##PRODUCT_NAME##' => $productRedemption['ProductRedemption']['name'],
                    '##WONDER_POINT##' => $productRedemption['ProductRedemption']['redeem_wonder_point'],
                    '##EMAIL##' => $user['User']['email'],
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
                $this->Email->to = $user['User']['email'];
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                $this->Session->setFlash(__l('Your product redemption completed successfully...') , 'default', null, 'success');
            } else {
                $this->Session->setFlash(__l('Sorry, but you do not have enough WonderPoints to redeem this product.') , 'default', null, 'error');
            }
        }
        $this->redirect(array(
            'controller' => 'little_black_boxs',
            'action' => 'index'
        ));
    }
    public function admin_index()
    {
        $this->pageTitle = __l('productRedemptions');
        $this->ProductRedemption->recursive = 2;
        $this->paginate = array(
            'contain'=> array(
                'Attachment'
            ),
            'fields'=> array(
                'ProductRedemption.id',
                'ProductRedemption.slug',
                'ProductRedemption.name',
                'ProductRedemption.redeem_wonder_point',
                'ProductRedemption.is_active'
            ),
            'order' => array(
                'ProductRedemption.id' => 'desc'
            )
        );
        $moreActions = $this->ProductRedemption->moreActions;
        $this->set(compact('moreActions'));
        $this->set('productRedemptions', $this->paginate());
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Product Redemption');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
                $this->ProductRedemption->Attachment->Behaviors->attach('ImageUpload', Configure::read('image.file'));
            }
            if (!empty($this->request->data['Attachment']['filename']['name']) || (!Configure::read('image.file.allowEmpty') && empty($this->request->data['Attachment']['id']))) {
                $this->request->data['Attachment']['class'] = 'Product';
                $this->ProductRedemption->Attachment->set($this->request->data);
            }
            if(empty($this->request->data['ProductRedemption']['is_purchase'])){
                unset($this->ProductRedemption->validate['purchase_amount']);
            }
            $ini_upload_error = 1;
            if ($this->request->data['Attachment']['filename']['error'] == 4) {
                $ini_upload_error = 0;
            }
            $is_relatedProduct_valid = true;
            if(!empty($this->request->data['RelatedProduct'])){
                foreach($this->request->data['RelatedProduct'] as $key => $relatedProduct) {
                    if (!empty($relatedProduct)) {
                        $data['RelatedProduct']['name'] = $relatedProduct['name'];
                        $data['RelatedProduct']['category_id'] = $relatedProduct['category_id'];
                        $data['RelatedProduct']['brand_id'] = $relatedProduct['brand_id'];
                        $data['RelatedProduct']['description']= $relatedProduct['description'];
                        $data['RelatedProduct']['price']= $relatedProduct['price'];
                        $this->ProductRedemption->RelatedProduct->set($data);
                        if (!$this->ProductRedemption->RelatedProduct->validates()) {
                            $relatedProductValidationError[$key] = $this->ProductRedemption->RelatedProduct->validationErrors;
                            $is_relatedProduct_valid = false;
                        }
                    }
                }
                if (!empty($relatedProductValidationError)) {
                    foreach($relatedProductValidationError as $key => $error) {
                        $this->ProductRedemption->RelatedProduct->validationErrors[$key] = $error;
                    }
                }
            }
            $this->ProductRedemption->set($this->request->data);
            if($this->ProductRedemption->validates() && $ini_upload_error & $is_relatedProduct_valid) {
                $this->ProductRedemption->create();
                if ($this->ProductRedemption->save($this->request->data)) {
                    $id = $this->ProductRedemption->id;
                    if(!empty($this->request->data['Attachment']['filename']['name'])){
                        $this->ProductRedemption->Attachment->create();
                        $this->request->data['Attachment']['foreign_id'] = $id;
                        $this->request->data['Attachment']['class'] = 'ProductRedemption';
                        $this->ProductRedemption->Attachment->save($this->request->data['Attachment']);
                    }
                    if(!empty($this->request->data['RelatedProduct'])){
                        foreach($this->request->data['RelatedProduct'] as $key => $relatedProduct) {
                            $this->ProductRedemption->RelatedProduct->create();
                            $relatedProductdata = array();
                            $relatedProductdata['RelatedProduct']['name'] = $relatedProduct['name'];
                            $relatedProductdata['RelatedProduct']['category_id'] = $relatedProduct['category_id'];
                            $relatedProductdata['RelatedProduct']['brand_id'] = $relatedProduct['brand_id'];
                            $relatedProductdata['RelatedProduct']['description']= $relatedProduct['description'];
                            $relatedProductdata['RelatedProduct']['product_redemption_id']= $id;
                            $relatedProductdata['RelatedProduct']['price']= $relatedProduct['price'];
                            $this->ProductRedemption->RelatedProduct->save($relatedProductdata,false);
                            $relatedProductAttachment = array();
                            $related_id = $this->ProductRedemption->RelatedProduct->id;
                            if(!empty($this->request->data['Attachment'][$key]['filename']['name'])){
                                $this->ProductRedemption->RelatedProduct->Attachment->create();
                                $this->request->data['Attachment'][$key]['foreign_id'] = $related_id;
                                $this->request->data['Attachment'][$key]['class'] = 'RelatedProduct';
                                $this->ProductRedemption->RelatedProduct->Attachment->save($this->request->data['Attachment'][$key],false);
                            }
                        }
                    }
                    $this->Session->setFlash(__l('Product redemption has been added') , 'default', null, 'success');
                    $this->redirect(array(
                        'action' => 'index'
                    ));
                } else {
                    if ($this->request->data['Attachment']['filename']['error'] == 4) {
                        $this->ProductRedemption->Attachment->validationErrors['filename'] = __l('Please upload the image') ;
                    }
                    $this->Session->setFlash(__l('Product redemption could not be added. Please, try again.') , 'default', null, 'error');
                }
            } else{
                if ($this->request->data['Attachment']['filename']['error'] == 4) {
                    $this->ProductRedemption->Attachment->validationErrors['filename'] = __l('Please upload the image') ;
                }
                $this->Session->setFlash(__l('Product redemption  could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $categories = $this->ProductRedemption->RelatedProduct->Category->find('list');
        $brands = $this->ProductRedemption->RelatedProduct->Brand->find('list');
        $this->set(compact('categories',  'brands'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Product Redemption');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->ProductRedemption->id = $id;
        if (!$this->ProductRedemption->exists()) {
            throw new NotFoundException(__l('Invalid product redemption'));
        }
        if(empty($this->request->data['ProductRedemption']['is_purchase'])){
            unset($this->ProductRedemption->validate['purchase_amount']);
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ProductRedemption->save($this->request->data)) {
                if(!empty($this->request->data['Attachment']['filename']['name'])){
                    $attachment1=$this->ProductRedemption->Attachment->find('first', array('conditions'=>array('Attachment.foreign_id'=>$this->request->data['ProductRedemption']['id'], 'Attachment.class'=>'ProductRedemption'), 'recursive'=>-1));
                    if(!empty($attachment1)){
                        $this->request->data['Attachment']['id'] = $attachment1['Attachment']['id'];
                    }else{
                        $this->ProductRedemption->Attachment->create();
                    }
                    $this->request->data['Attachment']['foreign_id'] = $this->request->data['ProductRedemption']['id'];
                    $this->request->data['Attachment']['class'] = 'ProductRedemption';
                    $this->ProductRedemption->Attachment->save($this->request->data['Attachment']);
                }
                $this->Session->setFlash(__l('product redemption has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('product redemption could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->ProductRedemption->find('first',array(
                'conditions'=> array(
                    'ProductRedemption.id'=> $id
                ),
                'contain'=> array(
                    'Attachment',
                    'RelatedProduct'=> array(
                        'Attachment',
                        'fields'=> array(
                            'RelatedProduct.id',
                            'RelatedProduct.slug',
                            'RelatedProduct.name',
                        )
                    )
                ),
                'recursive'=> 2
            ));
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['ProductRedemption']['name'];
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->ProductRedemption->delete($id)) {
            $this->Session->setFlash(__l('Product Redemption deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    function addproduct_more($id = null)
    {
        $this->set('i',$id);
        $categories = $this->ProductRedemption->RelatedProduct->Category->find('list');
        $brands = $this->ProductRedemption->RelatedProduct->Brand->find('list');
        $this->set(compact('categories',  'brands'));
    }
}
=======
<?php
class ProductRedemptionsController extends AppController
{
    public $name = 'ProductRedemptions';
    public $components = array(
        'Email',
    );
    public $helpers = array(
        'Gateway',
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment',
            'RelatedProduct',
            'ProductRedemption.relatedproduct_count'
        );
        parent::beforeFilter();
    }
    public function index()
    {
        $this->pageTitle = __l('productRedemptions');
        $this->ProductRedemption->recursive = 2;
        $this->paginate = array(
            'conditions'=> array(
                'ProductRedemption.is_active' => 1
            ),
            'contain'=> array(
                'Attachment',
                'RelatedProduct' => array(
                    'fields' => array(
                        'RelatedProduct.id',
                        'RelatedProduct.name',
                        'RelatedProduct.slug',
                    )
                )
            ),
            'fields' => array(
                'ProductRedemption.id',
                'ProductRedemption.name',
                'ProductRedemption.slug',
                'ProductRedemption.redeem_wonder_point',
                'ProductRedemption.is_purchase',
                'ProductRedemption.purchase_amount',
                'ProductRedemption.quantity'
            ),
            'order' => array(
                'ProductRedemption.id'=>'desc'
            )
        );
        $this->set('productRedemptions', $this->paginate());
    }
    public function view($slug = null)
    {
        $this->pageTitle = __l('Product Redemption');
        $productRedemption = $this->ProductRedemption->find('first', array(
            'conditions' => array(
                'ProductRedemption.slug = ' => $slug
            ) ,
            'contain'=> array(
                'Attachment',
                'RelatedProduct' => array(
                    'order'=> array(
                        'RelatedProduct.id'=>'desc'
                    ),
                    'Attachment',
                    'fields' => array(
                        'RelatedProduct.id',
                        'RelatedProduct.name',
                        'RelatedProduct.price',
                        'RelatedProduct.slug',
                    )
                )
            ),
            'fields' => array(
                'ProductRedemption.id',
                'ProductRedemption.name',
                'ProductRedemption.short_description',
                'ProductRedemption.description',
                'ProductRedemption.slug',
                'ProductRedemption.is_purchase',
            ),
            'recursive' => 2,
        ));
        if (empty($productRedemption)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $productRedemption['ProductRedemption']['name'];
        $this->set('productRedemption', $productRedemption);
    }
    public function buy($slug = null ){
        $this->pageTitle = __l('Product Redemption & Sales');
        $productRedemption = $this->ProductRedemption->find('first', array(
            'conditions' => array(
                'ProductRedemption.slug = ' => $slug
            ) ,
            'fields' => array(
                'ProductRedemption.id',
                'ProductRedemption.name',
                'ProductRedemption.slug',
                'ProductRedemption.purchase_amount',
                'ProductRedemption.quantity',
                'ProductRedemption.is_delivery',
            ) ,
            'recursive' => -1,
        ));
        $productRedemptionUserCount = $this->ProductRedemption->ProductRedemptionUser->find('count', array(
            'conditions' => array(
                'ProductRedemptionUser.product_redemption_id'=> $productRedemption['ProductRedemption']['id']
            ),
            'recursive' => -1
        ));
        $remaining_quantity = $productRedemption['ProductRedemption']['quantity'] - $productRedemptionUserCount;
        if($remaining_quantity <= 0 )
        {
            $this->Session->setFlash( __l('Beautiy Tips is not avialable'), 'default', null, 'error');
            $this->redirect(array(
                'controller' => 'beauty_tips',
                'action' => 'index',
                'admin' => false
            ));

        }
        if (empty($productRedemption)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        /* If check box not check � do not need to show shipping address page in the payment work */
        if(empty($productRedemption['ProductRedemption']['is_delivery'])){
            $this->loadModel('PaymentGateway');
            $paymentGateway = $this->PaymentGateway->find('first',array(
                'conditions'=> array(
                    'PaymentGateway.id'=> ConstPaymentGateways::MOLPay
                )
            ));
            if (empty($paymentGateway)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $this->pageTitle.= sprintf(__l('Buy %s Subcribed') , $productRedemption['ProductRedemption']['name']);
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
            $amount = number_format($productRedemption['ProductRedemption']['purchase_amount'],2);
            $vcode = md5($amount.Configure::read('molpay.merchant_id').$orderID.Configure::read('molpay.verify_key'));
            $country = 'MY';
            $gateway_options = array(
                'is_testmode'=> Configure::read('molpay.is_testmode'),
                'orderID'=> $orderID,
                'description'=> $productRedemption['ProductRedemption']['name'] ,
                'amount'=> $amount,
                'cur'=>'RM',
                'returnUrl'=>  Router::url(array(
                    'controller' => 'little_black_boxs',
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
                'payment_type' => 'ProductRedemption',
                'user_id' => $this->Auth->user('id') ,
                'product_redemption_id' => $productRedemption['ProductRedemption']['id'],
                'quantity' => 1,
                'payment_gateway_id' => ConstPaymentGateways::MOLPay,
                'ip' => $this->RequestHandler->getClientIP() ,
                'amount_needed' => $amount,
                'message' => $productRedemption['ProductRedemption']['name'],
            );
            $this->TempPaymentLog->save($transaction_data);
            $this->set('gateway_options', $gateway_options);
            $this->set('productRedemption', $productRedemption);
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
        $this->set('productRedemption', $productRedemption);
    }
    public function checkout(){
        if(!empty($this->request->data)){
            $this->loadModel('UserShipping');
            $this->UserShipping->set($this->request->data['UserShipping']);
            $this->UserShipping->User->UserProfile->set($this->request->data['UserProfile']);
            if($this->UserShipping->validates()&$this->UserShipping->User->UserProfile->validates()){
                $productRedemption = $this->ProductRedemption->find('first', array(
                    'conditions' => array(
                        'ProductRedemption.slug = ' => $this->request->data['ProductRedemption']['slug']
                    ) ,
                    'fields' => array(
                        'ProductRedemption.id',
                        'ProductRedemption.name',
                        'ProductRedemption.slug',
                        'ProductRedemption.purchase_amount',
                    ) ,
                    'recursive' => -1,
                ));
                $this->request->data['UserShipping']['user_id']= $this->Auth->user('id');
                if(empty($this->request->data['UserShipping']['id']))
                    $this->UserShipping->create();
                $this->UserShipping->save($this->request->data,false);
                if (empty($productRedemption)) {
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
                $this->pageTitle.= sprintf(__l('Buy %s Subcribed') , $productRedemption['ProductRedemption']['name']);
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
                $amount = number_format($productRedemption['ProductRedemption']['purchase_amount'],2);
                $vcode = md5($amount.Configure::read('molpay.merchant_id').$orderID.Configure::read('molpay.verify_key'));
                $country = 'MY';
                $gateway_options = array(
                    'is_testmode'=> Configure::read('molpay.is_testmode'),
                    'orderID'=> $orderID,
                    'description'=> $productRedemption['ProductRedemption']['name'] ,
                    'amount'=> $amount,
                    'cur'=>'RM',
                    'returnUrl'=>  Router::url(array(
                        'controller' => 'little_black_boxs',
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
                    'payment_type' => 'ProductRedemption',
                    'user_id' => $this->Auth->user('id') ,
                    'product_redemption_id' => $productRedemption['ProductRedemption']['id'],
                    'quantity' => 1,
                    'payment_gateway_id' => ConstPaymentGateways::MOLPay,
                    'ip' => $this->RequestHandler->getClientIP() ,
                    'amount_needed' => $amount,
                    'message' => $productRedemption['ProductRedemption']['name'],
                );
                $this->TempPaymentLog->save($transaction_data);
                $this->set('gateway_options', $gateway_options);
                $this->set('productRedemption', $productRedemption);
                $this->set('action', $action);
            } else {
                $err_message  = ' ';
                $err_message  .= "<div  style='text-align:left;padding-left:300px;'>";
                if(!empty($this->UserShipping->User->UserProfile->validationErrors)){
                    foreach($this->UserShipping->User->UserProfile->validationErrors as $key => $uservalidation){
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
                if(!empty($this->UserShipping->validationErrors)){
                    foreach($this->UserShipping->validationErrors as $key => $uservalidation){
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
                    'controller' => 'little_black_boxs',
                    'action' => 'buy',
                    $this->request->data['ProductRedemption']['slug'],
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
                        $productRedemption = $this->ProductRedemption->find('first', array(
                            'conditions' => array(
                                'ProductRedemption.id = ' => $tempPaymentLog['TempPaymentLog']['product_redemption_id']
                            ) ,
                            'fields' => array(
                                'ProductRedemption.id',
                                'ProductRedemption.name',
                                'ProductRedemption.slug',
                                'ProductRedemption.purchase_amount',
                            ) ,
                            'recursive' => -1,
                        ));
                        $this->loadModel('Transaction');
                        $user_id  = $tempPaymentLog['TempPaymentLog']['user_id'];
                        $data['Transaction']['user_id'] = $user_id;
                        $data['Transaction']['foreign_id'] = $tempPaymentLog['TempPaymentLog']['product_redemption_id'];
                        $data['Transaction']['class'] = 'ProductRedemption';
                        $data['Transaction']['amount'] = $amount;
                        $data['Transaction']['wonder_points'] = 0;
                        $data['Transaction']['payment_gateway_id'] = $paymentGateway['PaymentGateway']['id'];
                        $data['Transaction']['description'] = 'Payment Success';
                        $data['Transaction']['gateway_fees'] = 0;
                        $data['Transaction']['transaction_type_id'] = ConstTransactionTypes::ProductRedemptionAmountPaid;
                        $transaction_id = $this->Transaction->log($data);
                        if (!empty($transaction_id)) {
                            $this->ProductRedemption->ProductRedemptionUser->create();
                            $productredeem['ProductRedemptionUser']['user_id'] = $this->Auth->user('id');
                            $productredeem['ProductRedemptionUser']['is_paid'] = 1;
                            $productredeem['ProductRedemptionUser']['product_redemption_id'] = $productRedemption['ProductRedemption']['id'];
                            $this->ProductRedemption->ProductRedemptionUser->save($productredeem,false);
                            $user = $this->ProductRedemption->ProductRedemptionUser->User->find('first', array(
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
                            $this->loadModel('EmailTemplate');
                            $email = $this->EmailTemplate->selectTemplate('Product Redemption Subscription');
                            $emailFindReplace = array(
                                '##SITE_LINK##' => Router::url('/', true) ,
                                '##USERNAME##' => $user['UserProfile']['first_name'].' '.$user['UserProfile']['last_name'],
                                '##SITE_NAME##' => Configure::read('site.name') ,
                                '##SIGNUP_IP##' => $this->RequestHandler->getClientIP() ,
                                '##PRODUCT_NAME##' => $productRedemption['ProductRedemption']['name'],
                                '##AMOUNT##' => $amount,
                                '##EMAIL##' => $user['User']['email'],
                                '##CONTACT_URL##' => Router::url(array(
                                    'controller' => 'contacts',
                                    'action' => 'add',
                                    'city' => $this->request->params['named']['city'],
                                    'admin' => false
                                ) , true) ,
                                '##FROM_EMAIL##' => $this->ProductRedemption->ProductRedemptionUser->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']) ,
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
                            $this->Email->to = $user['User']['email'];
                            $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                            $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                            $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                            $this->Session->setFlash(__l('Your product redemption completed successfully...') , 'default', null, 'success');
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
    public function redeem($slug)
    {
        $this->autoRender = false;
        $productRedemption = $this->ProductRedemption->find('first', array(
            'conditions' => array(
                'ProductRedemption.slug = ' => $slug
            ) ,
            'fields'=> array(
                'ProductRedemption.id',
                'ProductRedemption.name',
                'ProductRedemption.redeem_wonder_point',
            ),
            'recursive' => -1,
        ));
        if (empty($productRedemption)) {
            throw new NotFoundException(__l('Invalid request'));
        }

        $this->loadModel('User');
        $user = $this->User->find('first',array(
            'conditions'=> array(
                'User.id'=> $this->Auth->user('id')
            ),
            'contain'=> array(
                'UserShipping'
            ),
            'fields'=> array(
                'User.id',
                'User.username',
                'User.email',
                'User.available_wonder_points'
            ),
            'recursive' => 2,
        ));
        if(empty($user['UserShipping'])){
            $this->Session->setFlash(__l('Please updated Shipping Information before Product Redemption') , 'default', null, 'success');
            $this->redirect(array(
                'controller'=>'user_shippings',
                'action' => 'index'
            ));
        }
        if (!empty($user)){
            if ($user['User']['available_wonder_points'] >= $productRedemption['ProductRedemption']['redeem_wonder_point']){
                $this->ProductRedemption->ProductRedemptionUser->create();
                $productredeem['ProductRedemptionUser']['user_id'] = $this->Auth->user('id');
                $productredeem['ProductRedemptionUser']['product_redemption_id'] = $productRedemption['ProductRedemption']['id'];
                $this->ProductRedemption->ProductRedemptionUser->save($productredeem,false);
                $this->User->updateAll(array(
                    'User.available_wonder_points' => 'User.available_wonder_points -' . $productRedemption['ProductRedemption']['redeem_wonder_point'],
                ) , array(
                    'User.id' => $user['User']['id']
                ));
                $this->loadModel('EmailTemplate');
                $email = $this->EmailTemplate->selectTemplate('Product Redemption Confirm');
                $emailFindReplace = array(
                    '##SITE_LINK##' => Router::url('/', true) ,
                    '##USERNAME##' => $user['User']['username'],
                    '##SITE_NAME##' => Configure::read('site.name') ,
                    '##SIGNUP_IP##' => $this->RequestHandler->getClientIP() ,
                    '##PRODUCT_NAME##' => $productRedemption['ProductRedemption']['name'],
                    '##WONDER_POINT##' => $productRedemption['ProductRedemption']['redeem_wonder_point'],
                    '##EMAIL##' => $user['User']['email'],
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
                $this->Email->to = $user['User']['email'];
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                $this->Session->setFlash(__l('Your product redemption completed successfully...') , 'default', null, 'success');
            } else {
                $this->Session->setFlash(__l('Sorry, but you do not have enough WonderPoints to redeem this product.') , 'default', null, 'error');
            }
        }
        $this->redirect(array(
            'controller' => 'little_black_boxs',
            'action' => 'index'
        ));
    }
    public function admin_index()
    {
        $this->pageTitle = __l('productRedemptions');
        $this->ProductRedemption->recursive = 2;
        $this->paginate = array(
            'contain'=> array(
                'Attachment'
            ),
            'fields'=> array(
                'ProductRedemption.id',
                'ProductRedemption.slug',
                'ProductRedemption.name',
                'ProductRedemption.redeem_wonder_point',
                'ProductRedemption.is_active'
            ),
            'order' => array(
                'ProductRedemption.id' => 'desc'
            )
        );
        $moreActions = $this->ProductRedemption->moreActions;
        $this->set(compact('moreActions'));
        $this->set('productRedemptions', $this->paginate());
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Product Redemption');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
                $this->ProductRedemption->Attachment->Behaviors->attach('ImageUpload', Configure::read('image.file'));
            }
            if (!empty($this->request->data['Attachment']['filename']['name']) || (!Configure::read('image.file.allowEmpty') && empty($this->request->data['Attachment']['id']))) {
                $this->request->data['Attachment']['class'] = 'Product';
                $this->ProductRedemption->Attachment->set($this->request->data);
            }
            if(empty($this->request->data['ProductRedemption']['is_purchase'])){
                unset($this->ProductRedemption->validate['purchase_amount']);
            }
            $ini_upload_error = 1;
            if ($this->request->data['Attachment']['filename']['error'] == 4) {
                $ini_upload_error = 0;
            }
            $is_relatedProduct_valid = true;
            if(!empty($this->request->data['RelatedProduct'])){
                foreach($this->request->data['RelatedProduct'] as $key => $relatedProduct) {
                    if (!empty($relatedProduct)) {
                        $data['RelatedProduct']['name'] = $relatedProduct['name'];
                        $data['RelatedProduct']['category_id'] = $relatedProduct['category_id'];
                        $data['RelatedProduct']['brand_id'] = $relatedProduct['brand_id'];
                        $data['RelatedProduct']['description']= $relatedProduct['description'];
                        $data['RelatedProduct']['price']= $relatedProduct['price'];
                        $this->ProductRedemption->RelatedProduct->set($data);
                        if (!$this->ProductRedemption->RelatedProduct->validates()) {
                            $relatedProductValidationError[$key] = $this->ProductRedemption->RelatedProduct->validationErrors;
                            $is_relatedProduct_valid = false;
                        }
                    }
                }
                if (!empty($relatedProductValidationError)) {
                    foreach($relatedProductValidationError as $key => $error) {
                        $this->ProductRedemption->RelatedProduct->validationErrors[$key] = $error;
                    }
                }
            }
            $this->ProductRedemption->set($this->request->data);
            if($this->ProductRedemption->validates() && $ini_upload_error & $is_relatedProduct_valid) {
                $this->ProductRedemption->create();
                if ($this->ProductRedemption->save($this->request->data)) {
                    $id = $this->ProductRedemption->id;
                    if(!empty($this->request->data['Attachment']['filename']['name'])){
                        $this->ProductRedemption->Attachment->create();
                        $this->request->data['Attachment']['foreign_id'] = $id;
                        $this->request->data['Attachment']['class'] = 'ProductRedemption';
                        $this->ProductRedemption->Attachment->save($this->request->data['Attachment']);
                    }
                    if(!empty($this->request->data['RelatedProduct'])){
                        foreach($this->request->data['RelatedProduct'] as $key => $relatedProduct) {
                            $this->ProductRedemption->RelatedProduct->create();
                            $relatedProductdata = array();
                            $relatedProductdata['RelatedProduct']['name'] = $relatedProduct['name'];
                            $relatedProductdata['RelatedProduct']['category_id'] = $relatedProduct['category_id'];
                            $relatedProductdata['RelatedProduct']['brand_id'] = $relatedProduct['brand_id'];
                            $relatedProductdata['RelatedProduct']['description']= $relatedProduct['description'];
                            $relatedProductdata['RelatedProduct']['product_redemption_id']= $id;
                            $relatedProductdata['RelatedProduct']['price']= $relatedProduct['price'];
                            $this->ProductRedemption->RelatedProduct->save($relatedProductdata,false);
                            $relatedProductAttachment = array();
                            $related_id = $this->ProductRedemption->RelatedProduct->id;
                            if(!empty($this->request->data['Attachment'][$key]['filename']['name'])){
                                $this->ProductRedemption->RelatedProduct->Attachment->create();
                                $this->request->data['Attachment'][$key]['foreign_id'] = $related_id;
                                $this->request->data['Attachment'][$key]['class'] = 'RelatedProduct';
                                $this->ProductRedemption->RelatedProduct->Attachment->save($this->request->data['Attachment'][$key],false);
                            }
                        }
                    }
                    $this->Session->setFlash(__l('Product redemption has been added') , 'default', null, 'success');
                    $this->redirect(array(
                        'action' => 'index'
                    ));
                } else {
                    if ($this->request->data['Attachment']['filename']['error'] == 4) {
                        $this->ProductRedemption->Attachment->validationErrors['filename'] = __l('Please upload the image') ;
                    }
                    $this->Session->setFlash(__l('Product redemption could not be added. Please, try again.') , 'default', null, 'error');
                }
            } else{
                if ($this->request->data['Attachment']['filename']['error'] == 4) {
                    $this->ProductRedemption->Attachment->validationErrors['filename'] = __l('Please upload the image') ;
                }
                $this->Session->setFlash(__l('Product redemption  could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $categories = $this->ProductRedemption->RelatedProduct->Category->find('list');
        $brands = $this->ProductRedemption->RelatedProduct->Brand->find('list');
        $this->set(compact('categories',  'brands'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Product Redemption');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->ProductRedemption->id = $id;
        if (!$this->ProductRedemption->exists()) {
            throw new NotFoundException(__l('Invalid product redemption'));
        }
        if(empty($this->request->data['ProductRedemption']['is_purchase'])){
            unset($this->ProductRedemption->validate['purchase_amount']);
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ProductRedemption->save($this->request->data)) {
                if(!empty($this->request->data['Attachment']['filename']['name'])){
                    $attachment1=$this->ProductRedemption->Attachment->find('first', array('conditions'=>array('Attachment.foreign_id'=>$this->request->data['ProductRedemption']['id'], 'Attachment.class'=>'ProductRedemption'), 'recursive'=>-1));
                    if(!empty($attachment1)){
                        $this->request->data['Attachment']['id'] = $attachment1['Attachment']['id'];
                    }else{
                        $this->ProductRedemption->Attachment->create();
                    }
                    $this->request->data['Attachment']['foreign_id'] = $this->request->data['ProductRedemption']['id'];
                    $this->request->data['Attachment']['class'] = 'ProductRedemption';
                    $this->ProductRedemption->Attachment->save($this->request->data['Attachment']);
                }
                $this->Session->setFlash(__l('product redemption has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('product redemption could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->ProductRedemption->find('first',array(
                'conditions'=> array(
                    'ProductRedemption.id'=> $id
                ),
                'contain'=> array(
                    'Attachment',
                    'RelatedProduct'=> array(
                        'Attachment',
                        'fields'=> array(
                            'RelatedProduct.id',
                            'RelatedProduct.slug',
                            'RelatedProduct.name',
                        )
                    )
                ),
                'recursive'=> 2
            ));
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['ProductRedemption']['name'];
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->ProductRedemption->delete($id)) {
            $this->Session->setFlash(__l('Product Redemption deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    function addproduct_more($id = null)
    {
        $this->set('i',$id);
        $categories = $this->ProductRedemption->RelatedProduct->Category->find('list');
        $brands = $this->ProductRedemption->RelatedProduct->Brand->find('list');
        $this->set(compact('categories',  'brands'));
    }
}
>>>>>>> upstream/master
