<?php
class Product extends AppModel
{
    public $name = 'Product';
    public $displayField = 'name';
    public $actsAs = array(
        'Sluggable' => array(
            'label' => array(
                'name'
            )
        ) ,
    );
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ) ,
		'BeautyCategory' => array(
            'className' => 'BeautyCategory',
            'foreignKey' => 'beauty_category_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ) ,
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
                'Attachment.class' => 'Product',
            ) ,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
		'Attachment1' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_id',
            'dependent' => true,
            'conditions' => array(
                'Attachment1.class' => 'BuySiteLogo',
            ) ,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
	   'ProductSurvey' => array(
            'className' => 'ProductSurvey',
            'foreignKey' => 'product_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
	   'ProductRedeem' => array(
            'className' => 'ProductRedeem',
            'foreignKey' => 'product_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
	   'ProductView' => array(
            'className' => 'ProductView',
            'foreignKey' => 'product_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
    );
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'category_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'brand_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
	        'beauty_category_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'message' => __l('Required')
                )
            ) ,
            'wonder_point' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'redeem_wonder_point' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'name' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
			'end_date' => array(
			  'rule2' => array(
                    'rule' => '_isValidEndDate',
                    'message' => __l('End date should be greater than today date') ,
                    'allowEmpty' => false
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
			'price' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
           'buy_url' => array(
                'rule2' => array(
                    'rule' => array(
                        'url'
                    ) ,
				    'allowEmpty' => true,
                    'message' => __l('Must be a valid URL, starting with http://') ,
                ) ,
                'rule1' => array(
                    'rule' => array(
                        'custom',
                        '/^http:\/\//'
                    ) ,
				    'allowEmpty' => true,
                    'message' => __l('Must be a valid URL, starting with http://') ,
                )
            ) ,
        );
	    $this->moreActions = array(
            ConstMoreAction::Inactive => __l('Inactive') ,
            ConstMoreAction::Active => __l('Active') ,
            ConstMoreAction::Delete => __l('Delete') ,
        );
    }
	function _isValidEndDate()
    {
         if (strtotime($this->data[$this->name]['end_date']) >= strtotime(date('Y-m-d'))) {
            return true;
        }
        return false;
    }
}
