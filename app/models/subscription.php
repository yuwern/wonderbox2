<?php
class Subscription extends AppModel
{
    public $name = 'Subscription';
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
        ) ,
  
    );
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
           'email' => array(
                'rule2' => array(
                    'rule' => 'email',
                    'allowEmpty' => false,
                    'message' => __l('Please enter valid email address')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required')
                )
            ) ,
            'width' => array(
                'rule' => 'numeric',
                'allowEmpty' => true,
                'message' => __l('Required')
            ) ,
            'height' => array(
                'rule' => 'numeric',
                'allowEmpty' => true,
                'message' => __l('Required')
            ) ,
        );
        $this->moreActions = array(
            ConstMoreAction::Delete => __l('Delete') ,
            ConstMoreAction::UnSubscripe => __l('Unsubscribe') ,
        );
    }
}
?>