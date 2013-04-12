<?php
class ProductRedemptionsController extends AppController
{
    public $name = 'ProductRedemptions';
	public $components = array(
        'Email',
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment',
			'RelatedProduct',
  			'ProductRedemption.relatedproduct_count'
	    );
        parent::beforeFilter();
    }
    public function index()
    {
        $this->pageTitle = __l('productRedemptions');
        $this->ProductRedemption->recursive = 2;
		$this->paginate = array(
					'conditions'=> array(
						'ProductRedemption.is_active' => 1
					),
					'contain'=> array(
						'Attachment',
						'RelatedProduct' => array(
							'fields' => array(
								'RelatedProduct.id',
								'RelatedProduct.name',
								'RelatedProduct.slug',
							)
						)
					),
					'fields' => array(
						'ProductRedemption.id',
						'ProductRedemption.name',
						'ProductRedemption.slug',
						'ProductRedemption.redeem_wonder_point',
						'ProductRedemption.quantity'
					),
					'order' => array(
						'ProductRedemption.id'=>'desc'
					)
				);
        $this->set('productRedemptions', $this->paginate());
    }
    public function view($slug = null)
    {
        $this->pageTitle = __l('Product Redemption');
        $productRedemption = $this->ProductRedemption->find('first', array(
					'conditions' => array(
						'ProductRedemption.slug = ' => $slug
					) ,
					'contain'=> array(
						'Attachment',
						'RelatedProduct' => array(
							'order'=> array(
								'RelatedProduct.id'=>'desc'
							),
							'Attachment',
							'fields' => array(
								'RelatedProduct.id',
								'RelatedProduct.name',
								'RelatedProduct.price',
								'RelatedProduct.slug',
							)
						)
					),
					'fields' => array(
						'ProductRedemption.id',
						'ProductRedemption.name',
						'ProductRedemption.short_description',
						'ProductRedemption.description',
						'ProductRedemption.slug',
				),
				'recursive' => 2,
			));
        if (empty($productRedemption)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $productRedemption['ProductRedemption']['name'];
        $this->set('productRedemption', $productRedemption);
    }
    public function redeem($slug)
	{
		$this->autoRender = false;
		$productRedemption = $this->ProductRedemption->find('first', array(
            'conditions' => array(
                'ProductRedemption.slug = ' => $slug
            ) ,
			'fields'=> array(
					'ProductRedemption.id',
					'ProductRedemption.name',
					'ProductRedemption.redeem_wonder_point',
					),
             'recursive' => -1,
        ));
		if (empty($productRedemption)) {
            throw new NotFoundException(__l('Invalid request'));
        }

		$this->loadModel('User');
		$user = $this->User->find('first',array(
				'conditions'=> array(
					'User.id'=> $this->Auth->user('id')
				),
				'contain'=> array(
					'UserShipping'
				),
				'fields'=> array(
					'User.id',
					'User.username',
					'User.email',
					'User.available_wonder_points'
				),
				'recursive' => 2,
			));
		if(empty($user['UserShipping'])){
			 $this->Session->setFlash(__l('Please updated Shipping Information before Product Redemption') , 'default', null, 'success');
             $this->redirect(array(
					'controller'=>'user_shippings',
                    'action' => 'index'
                ));
		}
		if (!empty($user)){
			if ($user['User']['available_wonder_points'] >= $productRedemption['ProductRedemption']['redeem_wonder_point']){
				$this->ProductRedemption->ProductRedemptionUser->create();
				$productredeem['ProductRedemptionUser']['user_id'] = $this->Auth->user('id');
				$productredeem['ProductRedemptionUser']['product_redemption_id'] = $productRedemption['ProductRedemption']['id'];
				$this->ProductRedemption->ProductRedemptionUser->save($productredeem,false);
				$this->User->updateAll(array(
						'User.available_wonder_points' => 'User.available_wonder_points -' . $productRedemption['ProductRedemption']['redeem_wonder_point'],
					) , array(
						'User.id' => $user['User']['id']
			    ));
				$this->loadModel('EmailTemplate');
				$email = $this->EmailTemplate->selectTemplate('Product Redemption Confirm');
                $emailFindReplace = array(
                        '##SITE_LINK##' => Router::url('/', true) ,
                        '##USERNAME##' => $user['User']['username'],
                        '##SITE_NAME##' => Configure::read('site.name') ,
                        '##SIGNUP_IP##' => $this->RequestHandler->getClientIP() ,
                        '##PRODUCT_NAME##' => $productRedemption['ProductRedemption']['name'],
                        '##WONDER_POINT##' => $productRedemption['ProductRedemption']['redeem_wonder_point'],
                        '##EMAIL##' => $user['User']['email'],
						'##CONTACT_URL##' => Router::url(array(
							'controller' => 'contacts',
							'action' => 'add',
							'city' => $this->request->params['named']['city'],
							'admin' => false
						) , true) ,
						'##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']) ,
						'##SITE_LOGO##' => Router::url(array(
							'controller' => 'img',
							'action' => 'blue-theme',
							'logo-email.png',
							'admin' => false
						) , true) ,
					);
					// Send e-mail to users
					$this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
					$this->Email->replyTo = ($email['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $email['reply_to'];
					$this->Email->to = $user['User']['email'];
					$this->Email->subject = strtr($email['subject'], $emailFindReplace);
					$this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
					$this->Email->send(strtr($email['email_content'], $emailFindReplace));	
					 $this->Session->setFlash(__l('Your product redemption completed successfully...') , 'default', null, 'success');
			} else {
				 $this->Session->setFlash(__l('Sorry, but you do not have enough WonderPoints to redeem this product.') , 'default', null, 'error');
			}
		}
		$this->redirect(array(
				'controller' => 'product_redemptions',
				'action' => 'index'
		));
	}
    public function admin_index()
    {
        $this->pageTitle = __l('productRedemptions');
        $this->ProductRedemption->recursive = 2;
		$this->paginate = array(
				'contain'=> array(
					'Attachment'
				),
			  'fields'=> array(
				'ProductRedemption.id',
				'ProductRedemption.slug',
				'ProductRedemption.name',
				'ProductRedemption.redeem_wonder_point',
				'ProductRedemption.is_active'
			   ),
				'order' => array(
					'ProductRedemption.id' => 'desc'
				)
			);	
		$moreActions = $this->ProductRedemption->moreActions;
	    $this->set(compact('moreActions'));   
        $this->set('productRedemptions', $this->paginate());
    }
	public function admin_add()
    {
        $this->pageTitle = __l('Add Product Redemption');
       if (!empty($this->request->data)) {
		   	 if (!empty($this->request->data['Attachment']['filename']['name'])) {
					$this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
					$this->ProductRedemption->Attachment->Behaviors->attach('ImageUpload', Configure::read('image.file'));
			 }
			 if (!empty($this->request->data['Attachment']['filename']['name']) || (!Configure::read('image.file.allowEmpty') && empty($this->request->data['Attachment']['id']))) {
					$this->request->data['Attachment']['class'] = 'Product';
					$this->ProductRedemption->Attachment->set($this->request->data);
			 }
			 $ini_upload_error = 1;
			 if ($this->request->data['Attachment']['filename']['error'] == 4) {
					$ini_upload_error = 0;
  			 }
			 $is_relatedProduct_valid = true;
			 if(!empty($this->request->data['RelatedProduct'])){
					 foreach($this->request->data['RelatedProduct'] as $key => $relatedProduct) {
						 if (!empty($relatedProduct)) {
								$data['RelatedProduct']['name'] = $relatedProduct['name'];
								$data['RelatedProduct']['category_id'] = $relatedProduct['category_id'];
								$data['RelatedProduct']['brand_id'] = $relatedProduct['brand_id'];
								$data['RelatedProduct']['description']= $relatedProduct['description'];
								$data['RelatedProduct']['price']= $relatedProduct['price'];
								$this->ProductRedemption->RelatedProduct->set($data);
								if (!$this->ProductRedemption->RelatedProduct->validates()) {
									$relatedProductValidationError[$key] = $this->ProductRedemption->RelatedProduct->validationErrors;
									$is_relatedProduct_valid = false;
								}
						 }
					 }
					if (!empty($relatedProductValidationError)) {
						foreach($relatedProductValidationError as $key => $error) {
									$this->ProductRedemption->RelatedProduct->validationErrors[$key] = $error;
						}
					}
			}
			$this->ProductRedemption->set($this->request->data);
		   if($this->ProductRedemption->validates() && $ini_upload_error & $is_relatedProduct_valid) {
            $this->ProductRedemption->create();
            if ($this->ProductRedemption->save($this->request->data)) {
				$id = $this->ProductRedemption->id;
				if(!empty($this->request->data['Attachment']['filename']['name'])){
						$this->ProductRedemption->Attachment->create();
						$this->request->data['Attachment']['foreign_id'] = $id;
						$this->request->data['Attachment']['class'] = 'ProductRedemption';
						$this->ProductRedemption->Attachment->save($this->request->data['Attachment']);
				}
				if(!empty($this->request->data['RelatedProduct'])){
					 foreach($this->request->data['RelatedProduct'] as $key => $relatedProduct) {
						 		$this->ProductRedemption->RelatedProduct->create();
								$relatedProductdata = array();
								$relatedProductdata['RelatedProduct']['name'] = $relatedProduct['name'];
								$relatedProductdata['RelatedProduct']['category_id'] = $relatedProduct['category_id'];
								$relatedProductdata['RelatedProduct']['brand_id'] = $relatedProduct['brand_id'];
								$relatedProductdata['RelatedProduct']['description']= $relatedProduct['description'];
								$relatedProductdata['RelatedProduct']['product_redemption_id']= $id;
								$relatedProductdata['RelatedProduct']['price']= $relatedProduct['price'];
								$this->ProductRedemption->RelatedProduct->save($relatedProductdata,false);
								$relatedProductAttachment = array();
								$related_id = $this->ProductRedemption->RelatedProduct->id;
								if(!empty($this->request->data['Attachment'][$key]['filename']['name'])){
										$this->ProductRedemption->RelatedProduct->Attachment->create();
										$this->request->data['Attachment'][$key]['foreign_id'] = $related_id;
										$this->request->data['Attachment'][$key]['class'] = 'RelatedProduct';
										$this->ProductRedemption->RelatedProduct->Attachment->save($this->request->data['Attachment'][$key],false);
								}
					 }
				}
                $this->Session->setFlash(__l('Product redemption has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
				if ($this->request->data['Attachment']['filename']['error'] == 4) {
					    $this->ProductRedemption->Attachment->validationErrors['filename'] = __l('Please upload the image') ;
				}
                $this->Session->setFlash(__l('Product redemption could not be added. Please, try again.') , 'default', null, 'error');
            }
        } else{
				 if ($this->request->data['Attachment']['filename']['error'] == 4) {
					    $this->ProductRedemption->Attachment->validationErrors['filename'] = __l('Please upload the image') ;
				 }
                $this->Session->setFlash(__l('Product redemption  could not be added. Please, try again.') , 'default', null, 'error');
		}
	    }
	    $categories = $this->ProductRedemption->RelatedProduct->Category->find('list');
       $brands = $this->ProductRedemption->RelatedProduct->Brand->find('list');
        $this->set(compact('categories',  'brands'));
	}
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Product Redemption');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->ProductRedemption->id = $id;
        if (!$this->ProductRedemption->exists()) {
            throw new NotFoundException(__l('Invalid product redemption'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ProductRedemption->save($this->request->data)) {
				if(!empty($this->request->data['Attachment']['filename']['name'])){
						$attachment1=$this->ProductRedemption->Attachment->find('first', array('conditions'=>array('Attachment.foreign_id'=>$this->request->data['ProductRedemption']['id'], 'Attachment.class'=>'ProductRedemption'), 'recursive'=>-1));
						if(!empty($attachment1)){
							$this->request->data['Attachment']['id'] = $attachment1['Attachment']['id'];
						}else{
							$this->ProductRedemption->Attachment->create();
						}
						$this->request->data['Attachment']['foreign_id'] = $this->request->data['ProductRedemption']['id'];
						$this->request->data['Attachment']['class'] = 'ProductRedemption';
						$this->ProductRedemption->Attachment->save($this->request->data['Attachment']);
				}
                $this->Session->setFlash(__l('product redemption has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('product redemption could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->ProductRedemption->find('first',array(
												'conditions'=> array(
													'ProductRedemption.id'=> $id
												),
												'contain'=> array(
													'Attachment',
													'RelatedProduct'=> array(
														'Attachment',
														'fields'=> array(
															'RelatedProduct.id',
															'RelatedProduct.slug',
															'RelatedProduct.name',
														)
													 )													 
												),
												'recursive'=> 2
										));
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['ProductRedemption']['name'];
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->ProductRedemption->delete($id)) {
            $this->Session->setFlash(__l('Product Redemption deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
	function addproduct_more($id = null)
    {
		$this->set('i',$id);
	    $categories = $this->ProductRedemption->RelatedProduct->Category->find('list');
        $brands = $this->ProductRedemption->RelatedProduct->Brand->find('list');
        $this->set(compact('categories',  'brands'));
    }
}
