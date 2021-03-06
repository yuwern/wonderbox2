<?php
class Category extends AppModel
{
    public $name = 'Category';
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
    public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'category_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
	 public $hasAndBelongsToMany = array(
        'BeautyTip' => array(
            'className' => 'BeautyTip',
            'joinTable' => 'beauty_tips_categories',
            'foreignKey' => 'category_id',
            'associationForeignKey' => 'beauty_tip_id',
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
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'name' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
	        'Category' => array(
                'rule' => 'is_check',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
         );
		 $this->moreActions = array(
            ConstMoreAction::Inactive => __l('Inactive') ,
            ConstMoreAction::Active => __l('Active') ,
            ConstMoreAction::Delete => __l('Delete') ,
        );
    }
	function is_check()
    {
	     if (empty($this->data['Category']['Category'])) {
            return false;
        }
        return true;
    }
}
