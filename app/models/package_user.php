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
	/*public $hasOne = array(
        'PaypalTransactionLog' => array(
            'className' => 'PaypalTransactionLog',
            'foreignKey' => 'package_user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
     );*/
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
    }
	function savePackageUser($no_of_months,$user_id,$package_id,$referred_by_user_id = 0){			
				  $box_month = Configure::read('header.month') ;
				  $user = $this->User->find('first', array(
										'conditions'=> array(
											'User.id'=> $user_id,
											'User.is_verified_user'=>1,
										)
						)
				  );
				  $box_date = 15;
				  $box_year = date('Y');
				  if(!empty($user)){
					$date_array = explode('-',$user['User']['subscription_expire_date']);	
					$box_month = $date_array[1];	
					$box_year = $date_array[0];
				 }
	
				 for($i = 1; $i <= $no_of_months; $i++){
					$packageBox = array();
							$this->create();
							$start_date = $box_date.'-'.$box_month.'-'.$box_year;
							$end_box_month = $box_month;
							$end_box_year = $box_year;
							if($box_month == 12){
									$end_box_month = 0	;	
									$end_box_year = date('Y') + 1 ;
 							}
							$end_date = $box_date.'-'.($end_box_month+1).'-'.$end_box_year;		
							$packageBox['PackageUser']['start_date'] = $start_date;
							$packageBox['PackageUser']['user_id'] = $user_id;
							$packageBox['PackageUser']['package_id'] = $package_id;
							$packageBox['PackageUser']['referred_by_user_id'] = !empty($referred_by_user_id)?$referred_by_user_id:0;
							$packageBox['PackageUser']['is_paid'] = 1;
							$packageBox['PackageUser']['end_date'] = $end_date;
							date_default_timezone_set('UTC');
							$this->save($packageBox,false);
							if($box_month == 12){
								$box_year = date('Y') + 1 ;
								$box_month = 1;
							}
							else 
							$box_month++;
				}
			}
}
