<?php
class BrandAddress extends AppModel
{
    public $name = 'BrandAddress';
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'Brand' => array(
            'className' => 'Brand',
            'foreignKey' => 'brand_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        )
    );
	 public $hasMany = array(
		 'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_id',
            'dependent' => true,
            'conditions' => array(
                'Attachment.class' => 'BrandAddress',
            ) ,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
         'location' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
       	    'email' => array(
                'rule1' => array(
                    'rule' => 'email',
					'allowEmpty' => true,
                     'message' => __l('Must be a valid email')
                ) ,
            ) ,
         'website_url' => array(
                'rule3' => array(
                    'rule' => array(
                        'url'
                    ) ,
                    'message' => __l('Must be a valid URL, starting with http://') ,
                ) ,
                'rule2' => array(
                    'rule' => array(
                        'custom',
                        '/^http:\/\//'
                    ) ,
                    'message' => __l('Must be a valid URL, starting with http://') ,
                ),
				 'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
        );
    }
}
