<?php
class PackageUser extends AppModel
{
    public $name = 'PackageUser';
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

    );
	public $hasOne = array(
        'PaypalTransactionLog' => array(
            'className' => 'PaypalTransactionLog',
            'foreignKey' => 'package_user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
     );
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
    }
}
