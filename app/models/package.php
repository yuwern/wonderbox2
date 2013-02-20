<?php
class Package extends AppModel
{
    public $name = 'Package';
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
        'PackageType' => array(
            'className' => 'PackageType',
            'foreignKey' => 'package_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ),
	    'PackageCategory' => array(
            'className' => 'PackageCategory',
            'foreignKey' => 'package_category_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        )
    );
    public $hasMany = array(
        'PackageUser' => array(
            'className' => 'PackageUser',
            'foreignKey' => 'package_id',
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
            'name' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
         /*   'slug' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'package_type_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
           */ 'cost' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'no_of_wonderpoints' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'is_active' => array(
                'rule1' => array(
                    'rule' => 'boolean',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
        );
    }
}
