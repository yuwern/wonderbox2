<?php
class ProductRedeemsController extends AppController
{
    public $name = 'ProductRedeems';
    public function admin_index($product_id = null)
    {
		 $this->_redirectGET2Named(array(
            'q',
			'month',
			'year',
			'email',
        ));
        $this->pageTitle = __l('productRedeems');
        $this->ProductRedeem->recursive = 2;
		$conditions = array();
		if(!empty($product_id)) {
			$conditions['ProductRedeem.product_id'] = $product_id;
		} 
		$conditions = array();
		if(!empty($this->request->params['named']['month']) &&!empty($this->request->params['named']['year']))
		{
			$start_date = $this->request->params['named']['year'].'-'.$this->request->params['named']['month'].'-1';
			$conditions['ProductRedeem.created >= '] = date('Y-m-d',strtotime($start_date));
			$conditions['ProductRedeem.created <= '] =  date('Y-m-t',strtotime($start_date));
			$this->request->data['ProductRedeem']['year'] = $this->request->params['named']['year'];
			$this->request->data['ProductRedeem']['month'] = $this->request->params['named']['month'];
		}
		if(!empty($this->request->params['named']['email']))
		{
			$this->request->data['ProductRedeem']['email'] = $this->request->params['named']['email'];
			$conditions['User.email'] = $this->request->params['named']['email'];
		}
		$this->paginate = array(
				'conditions'=> $conditions,
				'contain' => array(
					'Product'=> array(
						'Attachment',
						'fields' => array(
							'Product.id',
							'Product.name',
							'Product.slug',
							'Product.redeem_wonder_point'
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
				)
		);
        $this->set('productRedeems', $this->paginate());
    }

}
