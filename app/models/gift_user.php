<?php
class GiftUser extends AppModel
{
    public $name = 'GiftUser';
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ) ,
        'Package' => array(
            'className' => 'Package',
            'foreignKey' => 'package_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ),
		'GiftedToUser' => array(
            'className' => 'User',
            'foreignKey' => 'gifted_to_user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
        ),
		'State' => array(
            'className' => 'State',
            'foreignKey' => 'state_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
       
    );
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'user_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'package_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
		  'from' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'friend_name' => array(
			   'rule4' => array(
                    'rule' => array(
                        'between',
                        3,
                        20
                    ) ,
                    'message' => __l('Must be between of 3 to 20 characters')
                ) ,
                'rule3' => array(
                    'rule' => 'alphaNumeric',
                    'message' => __l('Must be a valid character and without space')
                ) ,
				'rule2' => array(
                    'rule' => array(
                        'custom',
                        '/^[a-zA-Z]/'
                    ) ,
                    'message' => __l('Must be start with an alphabets')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,     
			'coupon_code' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'friend_mail' => array(
		       'rule3' => array(
                    'rule' => array(
                        '_checkEmailExistOrNot',
                    ) ,
                    'message' => __l('You could don\'t use the same email')
                ) ,
                'rule2' => array(
                    'rule' => 'email',
                    'message' => __l('Must be a valid email')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ),
			'contact_no' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
			'address' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,						
			'address1' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,						
			'zip_code' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
           'country_id' => array(
                'rule' => 'numeric',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
			'state_id' => array(
                'rule' => 'numeric',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
        );
    }
	
    function _checkEmailExistOrNot()
    {
	   if(trim($_SESSION['Auth']['User']['email']) == trim($this->data['GiftUser']['friend_mail']) )
		  return false;
	   else
		  return true;
    }
	// Send welcome mail to User how purchase the Gift Package
	function _sendWelcomeMailToGiftUser(){
		App::import('Model', 'EmailTemplate');
		$this->EmailTemplate = new EmailTemplate();
		App::import('Core',	'ComponentCollection');
		$collection	= new ComponentCollection();
		App::import('Component', 'Email');
		$this->Email = new EmailComponent($collection);	
		date_default_timezone_set('UTC');
		$start_date	= date('Y-m-15');
		$giftUsers = $this->find('all',	array(
				'conditions'=> array(
					'GiftUser.start_date' => $start_date,
					'GiftUser.is_paid'=> 1 ,
					'GiftUser.is_send'=> 0
					),
				'contain'=>	array(
					'GiftedToUser' => array(
						'fields'=> array(
							'GiftedToUser.username',
							'GiftedToUser.email',
						)
					)
				),
				'recursive'=> 1
				)
		);
		if(!empty($giftUsers)){	
			$email = $this->EmailTemplate->selectTemplate('Welcome Email to Gift User');
			foreach($giftUsers as $user){
				$user_email	=  $user['GiftedToUser']['email'];
				$emailFindReplace =	array(
					'##SITE_LINK##'	=> Router::url('/',	true) ,
					'##SITE_NAME##'	=> Configure::read('site.name')	,
					'##FROM_EMAIL##' =>	$this->changeFromEmail(($email['from'] == '##FROM_EMAIL##')	? Configure::read('EmailTemplate.from_email') :	$email['from'])	,
					'##USERNAME##' => $user['GiftedToUser']['username'],
					'##SUPPORT_EMAIL##'	=> Configure::read('site.contact_email') ,
					'##LOGIN_EMAIL##' => $user_email,
					'##PASSWORD##' => Configure::read('gift.login_password'),
					'##SITE_URL##' => Router::url('/', true) ,
					'##CONTACT_URL##' => Router::url(array(
						'controller' =>	'contacts',
						'action' =>	'add',
						'admin'	=> false
					) ,	true) ,
					'##LOGIN_LINK##' =>	Router::url(array(
						'controller' =>	'users',
						'action' =>	'login',
						'admin'	=> false
					) ,	true),
					'##SITE_LOGO##'	=> Router::url(array(
						'controller' =>	'img',
						'action' =>	'blue-theme',
						'logo-email.png',
						'admin'	=> false
					) ,	true) ,
				);
				$this->Email->from = ($email['from'] ==	'##FROM_EMAIL##') ?	Configure::read('EmailTemplate.from_email')	: $email['from'];
				$this->Email->replyTo =	($email['reply_to']	== '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $email['reply_to'];
				$this->Email->to = $user_email;
				$this->Email->subject =	strtr($email['subject'], $emailFindReplace);
				$this->Email->sendAs = ($email['is_html']) ? 'html'	: 'text';
				$this->Email->send(strtr($email['email_content'], $emailFindReplace));
			    $this->updateAll(array(
                                    'GiftUser.is_send' => 1
                                  ) , array(
                                    'GiftUser.id' => $user['GiftUser']['id']
                                 )); 

			}
		}
	}
}
