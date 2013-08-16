<?php
class WonderSpree extends AppModel
{


    public $name = 'WonderSpree';
    //$validate set in __construct for multi-language support
	public $displayField = 'name';
	
	public $belongsTo = array(
		'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
	);
	
	public $hasOne = array(
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_id',
            'dependent' => true,
            'conditions' => array(
                'Attachment.class' => 'WonderSpree',
            )
    ));
    public $hasAndBelongsToMany = array(
        'Brand' => array(
            'className' => 'Brand',
            'joinTable' => 'brands_wonder_sprees',
            'foreignKey' => 'wonder_spree_id',
            'associationForeignKey' => 'brand_id',
            'unique' => 'keepExisting'
        ),       
		'Category' => array(
            'className' => 'Category',
            'joinTable' => 'categories_wonder_sprees',
            'foreignKey' => 'wonder_spree_id',
            'associationForeignKey' => 'category_id',
            'unique' => 'keepExisting'
        )
    );
	function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'purchase_amt' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
				'rule2'=>array(
				'rule'=>'numeric',
				'message'=>__l('Enter Numeric values'),
				)
			),
			'type' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
			'gift' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'location' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
			
			'previous_discount' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => true,
                    'message' => __l('Enter numeric value') ,
                ) ,
            ) ,
			
			
			'purchase_date' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
			),
				
             
            'upload_receipt' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
        );
		
		$this->moreActions = array(
			ConstMoreAction::Active => __l('Approve') ,
            ConstMoreAction::Inactive => __l('Unapprove') ,
        );
    }
	public function beforeSave($options = array()){
    foreach (array_keys($this->hasAndBelongsToMany) as $model){
      if(isset($this->data[$this->name][$model])){
        $this->data[$model][$model] = $this->data[$this->name][$model];
        unset($this->data[$this->name][$model]);
      }
    }
    return true;
  }
}
