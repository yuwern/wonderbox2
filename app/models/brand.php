<?php
class Brand extends AppModel
{
    public $name = 'Brand';
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
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
 	
     );
    public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'brand_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
       'BrandAddress' => array(
            'className' => 'BrandAddress',
            'foreignKey' => 'brand_id',
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
	public $hasOne = array(
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_id',
            'dependent' => true,
            'conditions' => array(
                'Attachment.class' => 'Brand',
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
			'name' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                     'message' => __l('Required') ,
                ) ,
            ) ,
	      'description' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'location' => array(
                'rule1' => array(
                    'rule' => 'notempty',
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
			'email1' => array(
                'rule2' => array(
                    'rule' => 'email',
					'allowEmpty' => true,
                    'message' => __l('Must be a valid email')
                ) 
            ) ,
            'facebook_url' => array(
               'rule2' => array(
					'allowEmpty' => true,
                    'rule' => array(
                        'url'
                    ) ,
                    'message' => __l('Must be a valid URL, starting with http://') ,
                ) ,
                'rule1' => array(
					'allowEmpty' => true,
                    'rule' => array(
                        'custom',
                        '/^http:\/\//'
                    ) ,
                    'message' => __l('Must be a valid URL, starting with http://') ,
                )
            ) ,
            'web_url' => array(
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
            'beauty_tip_url' => array(
               'rule2' => array(
					'allowEmpty' => true,
                    'rule' => array(
                        'url'
                    ) ,
                    'message' => __l('Must be a valid URL, starting with http://') ,
                ) ,
                'rule1' => array(
					'allowEmpty' => true,
                    'rule' => array(
                        'custom',
                        '/^http:\/\//'
                    ) ,
                    'message' => __l('Must be a valid URL, starting with http://') ,
                )
            ) ,
            'promotion_url' => array(
               'rule3' => array(
					'allowEmpty' => true,
                    'rule' => array(
                        'url'
                    ) ,
                    'message' => __l('Must be a valid URL, starting with http://') ,
                ) ,
                'rule2' => array(
					'allowEmpty' => true,
                    'rule' => array(
                        'custom',
                        '/^http:\/\//'
                    ) ,
                    'message' => __l('Must be a valid URL, starting with http://') ,
                ),
            ) ,
            'youtube_url' => array(
               'rule3' => array(
					'allowEmpty' => true,
                    'rule' => array(
                        'url'
                    ) ,
                    'message' => __l('Must be a valid URL, starting with http://') ,
                ) ,
                'rule2' => array(
					'allowEmpty' => true,
                    'rule' => array(
                        'custom',
                        '/^http:\/\//'
                    ) ,
                    'message' => __l('Must be a valid URL, starting with http://') ,
                ),
            ) ,
         );
	    $this->moreActions = array(
			ConstMoreAction::Inactive => __l('Inactive') ,
            ConstMoreAction::Active => __l('Active') ,
            ConstMoreAction::Delete => __l('Delete') ,
        );
    }
}
