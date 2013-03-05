<?php
class UserShipping extends AppModel
{
    public $name = 'UserShipping';
    public $displayField = 'address';
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ) ,
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ),
	    'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
    );
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
		 'first_name' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
          ) ,	
		'last_name' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
          ) ,	
         'contact_no' => array(
                'rule2' => array(
                    'rule' => 'numeric',
                    'message' => __l('Must be a valid number')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
			'contact_no1' => array(
                'rule2' => array(
                    'rule' => 'numeric',
                    'message' => __l('Must be a valid number')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
           'address' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,			
           'address2' => array(
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
            'state_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'country_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,

        );
    }
	function afterSave($created){
		if(!empty($this->data['UserShipping']['user_id'])){
			if(!empty($this->data['UserProfile']['first_name'])) {
				$this->User->UserProfile->updateAll(array(
					'UserProfile.first_name' => '\'' . $this->data['UserProfile']['first_name'] . '\'',
				) , array(
					'UserProfile.user_id' => $this->data['UserShipping']['user_id']
				));
			}
			if(!empty($this->data['UserProfile']['last_name'])) {
				$this->User->UserProfile->updateAll(array(
					'UserProfile.last_name' => '\'' . $this->data['UserProfile']['last_name'] . '\'',
				) , array(
					'UserProfile.user_id' => $this->data['UserShipping']['user_id']
				));
			}
		}
	}
}
