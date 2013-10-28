<?php
class BeautyTip extends AppModel
{
    public $name = 'BeautyTip';
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
        'Brand' => array(
            'className' => 'Brand',
            'foreignKey' => 'brand_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ),
		'BeautyCategory' => array(
            'className' => 'BeautyCategory',
            'foreignKey' => 'beauty_category_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ) ,
		'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ),
    );
   public $hasMany = array(
        'BeautyTipView' => array(
            'className' => 'BeautyTipView',
            'foreignKey' => 'beauty_tip_id',
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
        'WonderTreat' => array(
            'className' => 'WonderTreat',
            'foreignKey' => 'beauty_tip_id',
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
    public $hasAndBelongsToMany = array(
        'Category' => array(
            'className' => 'Category',
            'joinTable' => 'beauty_tips_categories',
            'foreignKey' => 'beauty_tip_id',
            'associationForeignKey' => 'category_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        )
    );
	public $hasOne = array(
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_id',
            'dependent' => true,
            'conditions' => array(
                'Attachment.class' => 'BeautyTip',
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
            'dependent' => false,
            'conditions' => array(
                'Attachment1.class' => 'BeautyTipSlider',
            ) ,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
		'Attachment2' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_id',
            'dependent' => false,
            'conditions' => array(
                'Attachment2.class' => 'ContributorImage',
            ) ,
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
            'brand_id' => array(
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
		  'description' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
			'purchase_amount' => array(
                'rule2' => array(
                    'rule' => array(
                        'comparison',
                        '>',
                        0
                    ) ,
                    'allowEmpty' => true,
                    'message' => __l('Should be greater than 0')
                ),
				'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ),
			'quantity' => array(
                 'rule2' => array(
                    'rule' => array(
                        'comparison',
                        '>',
                        0
                    ) ,
                    'allowEmpty' => true,
                    'message' => __l('Should be greater than 0')
                ),
				'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ),
			'voucher_code' => array(
			      'rule2' => array(
                    'rule' => 'isUnique',
                    'message' => __l('Voucher Code is already exist')
				  ) ,
                  'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ),
			'redemption_start_date' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
            'redemption_end_date' => array(
                'rule2' => array(
                    'rule' => '_isValidEndDate',
                    'message' => __l('End date should be greater than start date') ,
                    'allowEmpty' => false
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
	      );
		$this->moreActions = array(
			ConstMoreAction::Inactive => __l('Inactive') ,
            ConstMoreAction::Active => __l('Active') ,
            ConstMoreAction::Delete => __l('Delete') ,
        );
    }
	  //beauty Tip add page validation
    function _isValidStartDate()
    {
        if (strtotime($this->data[$this->name]['redemption_start_date']) >= strtotime(date('Y-m-d'))) {
            return true;
        }
        return false;
    }
    //Beauty tip add page validation
    function _isValidEndDate()
    {
        if (strtotime($this->data[$this->name]['redemption_end_date']) > strtotime($this->data[$this->name]['redemption_start_date'])) {
            return true;
        }
        return false;
    }
}
