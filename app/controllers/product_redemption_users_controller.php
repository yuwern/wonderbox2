<?php
class ProductRedemptionUsersController extends AppController
{
    public $name = 'ProductRedemptionUsers';
    public function admin_index($product_redemption_id = null)
    {   
		 $this->_redirectGET2Named(array(
            'q',
			'month',
			'year',
			'email',
        ));
        $this->pageTitle = __l('productRedemptionUsers');
        $this->ProductRedemptionUser->recursive = 2;
		$conditions = array();
		if(!empty($product_redemption_id)) {
			$conditions['ProductRedemptionUser.product_redemption_id'] = $product_redemption_id ;
		} 
		$conditions = array();
		if(!empty($this->request->params['named']['month']) &&!empty($this->request->params['named']['year']))
		{
			$start_date = $this->request->params['named']['year'].'-'.$this->request->params['named']['month'].'-1';
			$conditions['ProductRedemptionUser.created >= '] = date('Y-m-d',strtotime($start_date));
			$conditions['ProductRedemptionUser.created <= '] =  date('Y-m-t',strtotime($start_date));
		///	$startdate = date('Y-m-d',strtotime($start_date));
			//$enddate = date('Y-m-t',strtotime($start_date));
		//	$conditions['ProductRedemptionUser.created BETWEEN ? and ?'] = array($startdate, $enddate);
			$this->request->data['ProductRedemptionUser']['year'] = $this->request->params['named']['year'];
			$this->request->data['ProductRedemptionUser']['month'] = $this->request->params['named']['month'];
		}
		if(!empty($this->request->params['named']['email']))
		{
			$this->request->data['ProductRedemptionUser']['email'] = $this->request->params['named']['email'];
			$conditions['User.email'] = $this->request->params['named']['email'];
		}
		$this->paginate = array(
				'conditions'=> $conditions,
				'contain' => array(
					'ProductRedemption'=> array(
						'Attachment',
						'fields' => array(
							'ProductRedemption.id',
							'ProductRedemption.name',
							'ProductRedemption.slug',
							'ProductRedemption.redeem_wonder_point'
						)		
					),
					'User' => array(
						'UserProfile' => array(
							'fields' => array(
							'UserProfile.id',
							'UserProfile.first_name',
							'UserProfile.last_name'
							)
						),
						'UserShipping',
						'fields' => array(
							'User.id',
							'User.username',
							'User.email'
						)
					)
				),
				'order'=> array(
					'ProductRedemptionUser.id' => 'desc'
				)
		);
        $this->set('productRedemptionUsers', $this->paginate());
    }
}
