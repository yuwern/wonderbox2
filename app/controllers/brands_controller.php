<?php
class BrandsController extends AppController
{
    public $name = 'Brands';
	public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment',
			'BrandAddress',
			'Brand.brandaddress_count',
	    );
        parent::beforeFilter();
    }
    public function index()
    {
	    $this->pageTitle = __l('brands');
		$this->paginate = array(
			'conditions'=> array(
				'Brand.is_active'=> 1
			),
			'contain' => array(
				'Attachment'
			),
			'fields'=> array(
				'Brand.id',
				'Brand.name',
				'Brand.slug',
			),
			'order' => array(
                'Brand.name' => 'asc'
            ),
			'limit'=> 200,
			'recursive' => 2
        );
	     $this->set('brands', $this->paginate());
    }
	public function listing(){

	}
	public function benefits(){

		$facebook_fans = file_get_contents('https://graph.facebook.com/WonderBoxMalaysia');
		$result = json_decode($facebook_fans);
		$this->set('total_fan_count',$result->likes);
		$this->loadModel('User');
		$total_no_of_users = $this->User->find('count',array(
			'recursive'=> -1
		));
		$this->set('total_no_of_users',$total_no_of_users);

	}
    public function view($slug = null)
    {
        $this->pageTitle = __l('Brand');
  		$brand = $this->Brand->find('first', array(
            'conditions' => array(
                'Brand.slug = ' => $slug
            ) ,
			'contain'=> array(
				'Attachment',
				'BrandAddress' => array(
					'Attachment',
				),
			),
            'fields' => array(
                'Brand.id',
                'Brand.name',
                'Brand.slug',
                'Brand.short_description',
                'Brand.description',
                'Brand.location',
                'Brand.telephone_no',
                'Brand.fax_no',
                'Brand.email',
                'Brand.facebook_url',
                'Brand.web_url',
                'Brand.beauty_tip_url',
                'Brand.promotion_url',
                'Brand.youtube_url',
            ) ,
            'recursive' =>  2,
        ));
		if (empty($brand)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $brand['Brand']['name'];
        $this->set('brand', $brand);
    }
    public function admin_index()
    {
        $this->pageTitle = __l('brands');
        $this->Brand->recursive = 0;
		 $this->paginate = array(
			'contain'=> array(
				'Attachment',
				'User'=> array(
					'fields'=> array(
						'User.email'
					)
				)
  			 ),
            'order' => array(
                'Brand.id' => 'desc'
            )
        );
	     $this->set('brands', $this->paginate());
	 	$moreActions = $this->Brand->moreActions;
		if($this->Auth->user('user_type_id') != ConstUserTypes::Admin)
			unset($moreActions[3]);
	    $this->set(compact('moreActions'));   
    }
    public function admin_view($slug = null)
    {
        $this->pageTitle = __l('Brand');
        $this->Brand->slug = $slug;
        if (!$this->Brand->exists()) {
            throw new NotFoundException(__l('Invalid brand'));
        }
        $brand = $this->Brand->find('first', array(
            'conditions' => array(
                'Brand.slug = ' => $slug
            ) ,
            'fields' => array(
                'Brand.id',
                'Brand.created',
                'Brand.modified',
                'Brand.name',
                'Brand.slug',
                'Brand.description',
                'Brand.location',
                'Brand.facebook_url',
                'Brand.web_url',
                'Brand.beauty_tip_url',
                'Brand.promotion_url',
                'Brand.is_active',
            ) ,
            'recursive' => - 1,
        ));
        if (empty($brand)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $brand['Brand']['name'];
        $this->set('brand', $brand);
    }
    public function admin_add()
    {

        $this->pageTitle = __l('Add Brand');
		if (!empty($this->request->data)) {
			if (!empty($this->request->data['Attachment']['filename']['name'])) {
					$this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
					$this->Brand->Attachment->Behaviors->attach('ImageUpload', Configure::read('image.file'));
			 }
			 if (!empty($this->request->data['Attachment']['filename']['name']) || (!Configure::read('image.file.allowEmpty') && empty($this->request->data['Attachment']['id']))) {
					$this->request->data['Attachment']['class'] = 'Brand';
					$this->Brand->Attachment->set($this->request->data);
			 }
			 $ini_upload_error = 1;
			 if ($this->request->data['Attachment']['filename']['error'] == 4) {
					$ini_upload_error = 0;
  			 }
			 $this->request->data['Brand']['user_id'] = $this->Auth->user('id');
			 $is_brand_valid = true;
			 if(!empty($this->request->data['BrandAddress'])){
					 foreach($this->request->data['BrandAddress'] as $key => $brandAddress) {
						 if (!empty($brandAddress)) {
								$data['BrandAddress']['location'] = $brandAddress['location'];
								$data['BrandAddress']['telephone_no'] = $brandAddress['telephone_no'];
								$data['BrandAddress']['fax_no'] = $brandAddress['fax_no'];
								$data['BrandAddress']['email']= $brandAddress['email'];
								$data['BrandAddress']['website_url']= $brandAddress['website_url'];
								$this->Brand->BrandAddress->set($data);
								if (!$this->Brand->BrandAddress->validates()) {
									$brandValidationError[$key] = $this->Brand->BrandAddress->validationErrors;
									$is_brand_valid = false;
								}
						 }
					 }
					 //unset($this->Event->Ticket->validationErrors);
					if (!empty($brandValidationError)) {
						foreach($brandValidationError as $key => $error) {
									$this->Brand->BrandAddress->validationErrors[$key] = $error;
						}
					}
			}
			$this->Brand->set($this->request->data);
			if($this->Brand->validates() && $is_brand_valid && $ini_upload_error) {
            $this->Brand->create();
            if ($this->Brand->save($this->request->data)) {
				$id = $this->Brand->id;
				if(!empty($this->request->data['Attachment']['filename']['name'])){
						$this->Brand->Attachment->create();
						$this->request->data['Attachment']['foreign_id'] = $id;
						$this->request->data['Attachment']['class'] = 'Brand';
						$this->Brand->Attachment->save($this->request->data['Attachment']);
				}
				if(!empty($this->request->data['BrandAddress'])){
					 foreach($this->request->data['BrandAddress'] as $key => $brandAddress) {
						$this->Brand->BrandAddress->create();
						$BrandAddress['BrandAddress']['location'] = $brandAddress['location'];
						$BrandAddress['BrandAddress']['telephone_no'] = $brandAddress['telephone_no'];
						$BrandAddress['BrandAddress']['fax_no'] = $brandAddress['fax_no'];
						$BrandAddress['BrandAddress']['email']= $brandAddress['email'];
						$BrandAddress['BrandAddress']['brand_id']= $id;
						$BrandAddress['BrandAddress']['website_url']= $brandAddress['website_url'];
						$this->Brand->BrandAddress->save($BrandAddress,false);
						$companylogoAttachment = array();
						$brandaddress_id = $this->Brand->BrandAddress->id;
						if(!empty($this->request->data['Attachment'][$key]['filename']['name'])){
										$this->Brand->BrandAddress->Attachment->create();
										$this->request->data['Attachment'][$key]['foreign_id'] = $brandaddress_id;
										$this->request->data['Attachment'][$key]['class'] = 'BrandAddress';
										$this->Brand->BrandAddress->Attachment->save($this->request->data['Attachment'][$key],false);
						}
					 }
				}
                $this->Session->setFlash(__l('Brand has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
		            $this->Session->setFlash(__l('Brand could not be added. Please, try again.') , 'default', null, 'error');
            }
	       }else{
					  if ($this->request->data['Attachment']['filename']['error'] == 4) {
					    $this->Brand->Attachment->validationErrors['filename'] = __l('Please upload the image') ;
				  }
                $this->Session->setFlash(__l('Brand could not be added. Please, try again.') , 'default', null, 'error');
			}
		}
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Brand');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->Brand->id = $id;
        if (!$this->Brand->exists()) {
            throw new NotFoundException(__l('Invalid brand'));
        }
        if (!empty($this->request->data)) {
			$is_brand_valid = true;
			 if(!empty($this->request->data['BrandAddress'])){
					 foreach($this->request->data['BrandAddress'] as $key => $brandAddress) {
						 if (!empty($brandAddress)) {
								$data['BrandAddress']['location'] = $brandAddress['location'];
								$data['BrandAddress']['telephone_no'] = $brandAddress['telephone_no'];
								$data['BrandAddress']['fax_no'] = $brandAddress['fax_no'];
								$data['BrandAddress']['email']= $brandAddress['email'];
								$data['BrandAddress']['website_url']= $brandAddress['website_url'];
								$this->Brand->BrandAddress->set($data);
								if (!$this->Brand->BrandAddress->validates()) {
									$brandValidationError[$key] = $this->Brand->BrandAddress->validationErrors;
									$is_brand_valid = false;
								}
						 }
					 }
					 //unset($this->Event->Ticket->validationErrors);
					if (!empty($brandValidationError)) {
						foreach($brandValidationError as $key => $error) {
									$this->Brand->BrandAddress->validationErrors[$key] = $error;
						}
					}
			}
			$this->Brand->set($this->request->data);
			if($this->Brand->validates() && $is_brand_valid ) {
				 if ($this->Brand->save($this->request->data)) {
				 /*if(!empty($this->request->data['Attachment']['filename']['name'])){
						$attachment1=$this->Brand->Attachment->find('first', array('conditions'=>array('Attachment.foreign_id'=>$this->request->data['Brand']['id'], 'Attachment.class'=>'Brand'), 'recursive'=>-1));
						if(!empty($attachment1)){
							$this->request->data['Attachment']['id'] = $attachment1['Attachment']['id'];
						}else{
							$this->Brand->Attachment->create();
						}
						$this->request->data['Attachment']['foreign_id'] = $this->request->data['Brand']['id'];
						$this->request->data['Attachment']['class'] = 'Brand';
						$this->Brand->Attachment->save($this->request->data['Attachment']);
				}
				if(!empty($this->request->data['BrandAddress'])){
					$this->Brand->BrandAddress->deleteAll(array(
							'BrandAddress.brand_id' =>  $this->request->data['Brand']['id']
					));	
					 foreach($this->request->data['BrandAddress'] as $key => $brandAddress) {
						$BrandAddress = array();
						$this->Brand->BrandAddress->create();
						$BrandAddress['BrandAddress']['location'] = $brandAddress['location'];
						$BrandAddress['BrandAddress']['telephone_no'] = $brandAddress['telephone_no'];
						$BrandAddress['BrandAddress']['fax_no'] = $brandAddress['fax_no'];
						$BrandAddress['BrandAddress']['email']= $brandAddress['email'];
						$BrandAddress['BrandAddress']['website_url']= $brandAddress['website_url'];
						$BrandAddress['BrandAddress']['brand_id']= $id;
						$this->Brand->BrandAddress->save($BrandAddress,false);
						$brandaddress_id = $this->Brand->BrandAddress->id;
						if(!empty($this->request->data['Attachment'][$key]['filename']['name'])){
										$this->Brand->BrandAddress->Attachment->create();
										$this->request->data['Attachment'][$key]['foreign_id'] = $brandaddress_id;
										$this->request->data['Attachment'][$key]['class'] = 'BrandAddress';
										$this->Brand->BrandAddress->Attachment->save($this->request->data['Attachment'][$key],false);
						}
					 }
				} */
                $this->Session->setFlash(__l('Brand has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Brand could not be updated. Please, try again.') , 'default', null, 'error');
            }
			}
        } else {
           // $this->data = $this->Brand->read(null, $id);
		    $this->data = $this->Brand->find('first', array(
										'contain'=> array(
											'Attachment',
											'BrandAddress' => array(
												'Attachment'
											)
										),
										'conditions'=> array(
											'Brand.id'=>$id
										)
									)
									);
		     if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['Brand']['name'];
    }
	public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Brand->delete($id)) {
            $this->Session->setFlash(__l('Brand deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
	function addbrandaddress_more($id = null)
    {
		$this->set('i',$id);
    }

}
