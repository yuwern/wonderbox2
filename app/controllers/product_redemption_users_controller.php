<?php
class ProductRedemptionUsersController extends AppController
{
    public $name = 'ProductRedemptionUsers';
	public function index(){
	   $conditions = array();
	   $conditions['ProductRedemptionUser.user_id'] = $this->Auth->user('id');
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
				),
				'order'=> array(
					'ProductRedemptionUser.id' => 'desc'
				)
		);
		 $this->set('productRedemptionUsers', $this->paginate());
	}
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
		if ($this->RequestHandler->prefers('pdf') || $this->RequestHandler->prefers('csv')) {
			$productRedemptionUsers = $this->ProductRedemptionUser->find('all',array(
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
			));
			$this->set('productRedemptionUsers', $productRedemptionUsers);
		} else {
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
	 public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Product Redemption User');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->ProductRedemptionUser->id = $id;
        if (!$this->ProductRedemptionUser->exists()) {
            throw new NotFoundException(__l('Invalid product redemption user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ProductRedemptionUser->save($this->request->data)) {
                $this->Session->setFlash(__l('product redemption user has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('product redemption user could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->ProductRedemptionUser->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['ProductRedemptionUser']['id'];
        $productRedemptions = $this->ProductRedemptionUser->ProductRedemption->find('list');
        $users = $this->ProductRedemptionUser->User->find('list');
        $this->set(compact('productRedemptions', 'users'));
    }
	public function admin_import(){
		if(!empty($this->request->data)){
			if(!empty($this->request->data['Attachment']['filename']['name']) && !empty($this->request->data['ProductRedemptionUser']['year']) &&  !empty($this->request->data['ProductRedemptionUser']['month'])){
				$file_ext = array_pop(explode('.', $this->request->data['Attachment']['filename']['name']));
				if ($file_ext == "csv") {
					$start_date = date($this->request->data['ProductRedemptionUser']['year'].'-'.$this->request->data['ProductRedemptionUser']['month'].'-1');
					$end_date = date($this->request->data['ProductRedemptionUser']['year'].'-'.$this->request->data['ProductRedemptionUser']['month'].'-t');
					$handle = fopen($this->request->data['Attachment']['filename']['tmp_name'], "r");
				  // read the 1st row as headings
					$header = fgetcsv($handle);
					while (($row = fgetcsv($handle)) !== FALSE) {
						$user = $this->ProductRedemptionUser->User->find('first', array(
											'conditions' => array(
												'User.email'=>$row[0]
											),
											'fields'=> array(
												'User.id',
												'User.email'
											),
											'recursive'=> -1
								));
								
						 if(!empty($user)&& !empty($row[1])){
							$tracking_number = $row[1];
							$productRedemptionUsers = $this->ProductRedemptionUser->find('all', array(
											'conditions' => array(
												'ProductRedemptionUser.user_id' => $user['User']['id'],
												'ProductRedemptionUser.created >= ' => $start_date,
												'ProductRedemptionUser.created <= ' => $end_date,
											),
											'fields'=> array(
												'ProductRedemptionUser.user_id',
												'ProductRedemptionUser.id',
											),
											'recursive'=> -1
								));
								$tracking_number = explode('||',$tracking_number);
								if(!empty($productRedemptionUsers)){
								  foreach($productRedemptionUsers as $pkey => $productRedemptionUser) {
									  if(!empty($tracking_number[$pkey])) {
										  $this->ProductRedemptionUser->updateAll(array(
												'ProductRedemptionUser.tracking_number' => '\'' .$tracking_number[$pkey] . '\'',
											) , array(
												'ProductRedemptionUser.id' => $productRedemptionUser['ProductRedemptionUser']['id'] ,
											));
									  }
								  }
							  }
							 // echo $row[1];
						 }
					 }
					 fclose($handle);
					$this->Session->setFlash(__l('Tracking Number is uploaded successfully..') , 'default', null, 'success');
					$this->redirect(array(
						'action' => 'index'
					));
				}
				else {
					$this->Session->setFlash(__l('Please uploaded csv file') , 'default', null, 'error');
				}
				
			}else{
				$this->Session->setFlash(__l('Please uploaded csv file ,month and year') , 'default', null, 'error');
			
			}
		}
	}
   
}
