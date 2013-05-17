<?php
class BeautyTipsController extends AppController
{
    public $name = 'BeautyTips';
    public function index()
    {
		  $this->_redirectGET2Named(array(
            'q',
	    ));
        $this->pageTitle = __l('BeautyTips');
        $this->BeautyTip->recursive = 1;
		$conditions = array();
		$conditions['BeautyTip.is_active'] = 1; 
		if(!empty($this->params['named']['q'])){
			$conditions['BeautyTip.name LIKE '] = '%' .$this->params['named']['q'] .'%';
			$this->request->data['BeautyTip']['q'] = $this->params['named']['q'];
		}
		if(!empty($this->params['named']['slug'])){
		$category = $this->BeautyTip->Category->find('first',array(
							'conditions' => array(
								'Category.slug'=> $this->params['named']['slug']
							),
							'fields'=> array(
								'Category.id'
							),
							'recursive'=> -1
					)
				);
		  if(!empty($category)){
	 	    $beautytipcategories = $this->BeautyTip->BeautyTipsCategory->find('all',array(
									'conditions' => array(
										'BeautyTipsCategory.category_id'=> $category['Category']['id']
									),
									'fields' => array(
										'BeautyTipsCategory.beauty_tip_id'
									)
								)
			 );
			$conditions['BeautyTip.id'] = Set::extract('/BeautyTipsCategory/beauty_tip_id', $beautytipcategories);
		  }
		}
		$this->paginate = array(
				'contain'=> array(
					'Attachment',
					'Category' => array(
						'fields' => array(
							'Category.name',
							'Category.slug',
						)
					)
				),
				'limit' => 10,
				'conditions'=> $conditions,
				'order'=> array(
					'BeautyTip.id'=>'desc'
				)
		);
		$beautyTipsCount = $this->BeautyTip->find('count',array(
					'conditions' => $conditions
				)
		);
	   $this->set('beautyTipsCount',$beautyTipsCount);
       $beautyTipSliders = $this->BeautyTip->find('all', array(
            'conditions' => array(
                'BeautyTip.is_active = ' => 1
            ) ,
			'contain'=> array(
				'Attachment1',
				'Category' => array(
						'fields' => array(
							'Category.name',
							'Category.slug',
						)
					)
			),
            'fields' => array(
                'BeautyTip.id',
                'BeautyTip.brand_id',
                'BeautyTip.name',
                'BeautyTip.slug',
            ) ,
		    'limit'=> 3,
		    'order'=> array(
				'BeautyTip.id'=>'desc'
			),
            'recursive' => 2,
        ));

	    $this->set('beautyTipSliders',$beautyTipSliders);
		$this->set('beautyTips', $this->paginate());
    }
    public function view($slug = null)
    {
        $this->pageTitle = __l('Beauty Tip');
        $beautyTip = $this->BeautyTip->find('first', array(
            'conditions' => array(
                'BeautyTip.slug = ' => $slug
            ) ,
			'contain'=> array(
				'Attachment1',
				'Attachment2',
				'Category' => array(
						'fields' => array(
							'Category.name',
							'Category.slug',
						)
					)
			),
            'fields' => array(
                'BeautyTip.id',
                'BeautyTip.created',
                'BeautyTip.modified',
                'BeautyTip.user_id',
                'BeautyTip.brand_id',
                'BeautyTip.name',
                'BeautyTip.slug',
                'BeautyTip.description',
                'BeautyTip.about_us',
				'BeautyTip.video_url',
                'BeautyTip.is_active',
                ) ,
            'recursive' => 2,
        ));
	    if (empty($beautyTip)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->BeautyTip->BeautyTipView->create();
        $this->request->data['BeautyTipView']['user_id'] = $this->Auth->user('id');
        $this->request->data['BeautyTipView']['beauty_tip_id'] = $beautyTip['BeautyTip']['id'];
        $this->request->data['BeautyTipView']['ip'] = $this->RequestHandler->getClientIP();
        $this->BeautyTip->BeautyTipView->save($this->request->data);
        $this->pageTitle.= ' - ' . $beautyTip['BeautyTip']['name'];
        $this->set('beautyTip', $beautyTip);
    }
    public function admin_index()
    {
        $this->pageTitle = __l('beautyTips');
		  $this->_redirectGET2Named(array(
            'q',
			'year',
			'month',
        ));
		$conditions = array();
		date_default_timezone_set('UTC');
		if(!empty($this->request->params['named']['month']) &&!empty($this->request->params['named']['year']))
		{
		    $start_date = date('Y-m-d',strtotime($this->request->params['named']['year'].'-'.$this->request->params['named']['month'].'-1'));
			$end_date = date('Y-m-t',strtotime($this->request->params['named']['year'].'-'.$this->request->params['named']['month'].'-1'));
			$conditions['BeautyTip.created >= '] = $start_date;
			$conditions['BeautyTip.created <= '] = $end_date;
			$this->request->data['BeautyTip']['year'] = $this->request->params['named']['year'];
			$this->request->data['BeautyTip']['month'] = $this->request->params['named']['month'];

		}
        $this->BeautyTip->recursive = 2;
		$this->paginate = array(
				'conditions'=> $conditions,
				'contain' => array(
					'Attachment',
					'User'=> array(
						'fields' => array(
							'User.email',
						)
					)
				),
				'order'=> array(
					'BeautyTip.id'=>'desc'
				),
		);
		$moreActions = $this->BeautyTip->moreActions;
		$this->set(compact('moreActions')); 
        $this->set('beautyTips', $this->paginate());
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Beauty Tip');
		 $this->BeautyTip->Attachment->Behaviors->attach('ImageUpload', Configure::read('avatar.file'));
        if (!empty($this->request->data)) {
			 if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
            }
            if (!empty($this->request->data['Attachment']['filename']['name'])) {
                  $this->BeautyTip->Attachment->set($this->request->data);
            }
		    $this->BeautyTip->set($this->request->data);
		    $this->BeautyTip->Category->set($this->request->data);
			 $ini_upload_error = 1;
            if ((!empty($this->request->data['Attachment']['filename']) && $this->request->data['Attachment']['filename']['error'] == 1) || (!empty($this->request->data['Attachment1']['filename']) && $this->request->data['Attachment1']['filename']['error'] == 1) ) {
                $ini_upload_error = 0;
            }
			if (empty($this->request->data['Attachment']['filename']['name'])) {
			        $ini_upload_error = 0;
					$this->BeautyTip->Attachment->validationErrors['filename'] = __l('Required');
            }
			if (empty($this->request->data['Attachment1']['filename']['name'])) {
			        $ini_upload_error = 0;
					$this->BeautyTip->Attachment1->validationErrors['filename'] = __l('Required');
            }
			$this->request->data['BeautyTip']['user_id'] = $this->Auth->user('id');

			if($this->BeautyTip->validates()& $this->BeautyTip->Category->validates() && $ini_upload_error){
           	$this->BeautyTip->create();
            if ($this->BeautyTip->save($this->request->data)) {
				  if (!empty($this->request->data['Attachment']['filename']['name'])) {
                        $this->BeautyTip->Attachment->create();
                        $this->request->data['Attachment']['class'] = 'BeautyTip';
                        $this->request->data['Attachment']['foreign_id'] = $this->BeautyTip->id;
                        $this->BeautyTip->Attachment->save($this->request->data['Attachment']);
                }
				if (!empty($this->request->data['Attachment1']['filename']['name'])) {
                        $this->BeautyTip->Attachment->create();
                        $this->request->data['Attachment1']['class'] = 'BeautyTipSlider';
                        $this->request->data['Attachment1']['foreign_id'] = $this->BeautyTip->id;
                        $this->BeautyTip->Attachment->save($this->request->data['Attachment1']);
                }
				if (!empty($this->request->data['Attachment2']['filename']['name'])) {
                        $this->BeautyTip->Attachment->create();
                        $this->request->data['Attachment2']['class'] = 'ContributorImage';
                        $this->request->data['Attachment2']['foreign_id'] = $this->BeautyTip->id;
                        $this->BeautyTip->Attachment->save($this->request->data['Attachment2']);
                }
                $this->Session->setFlash(__l('Beauty Content Page has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Beauty Content Page could not be added. Please, try again.') , 'default', null, 'error');
            }
        }else {
			    if (!empty($this->request->data['Attachment']['filename']) && $this->request->data['Attachment']['filename']['error'] == 1) {
                    $this->BeautyTip->Attachment->validationErrors['filename'] = sprintf(__l('The file uploaded is too big, only files less than %s permitted') , ini_get('upload_max_filesize'));
                }
				if (!empty($this->request->data['Attachment1']['filename']) && $this->request->data['Attachment1']['filename']['error'] == 1) {
                    $this->BeautyTip->Attachment1->validationErrors['filename'] = sprintf(__l('The file uploaded is too big, only files less than %s permitted') , ini_get('upload_max_filesize'));
                }
            
                $this->Session->setFlash(__l('Beauty Content Page  could not be added. Please, try again.') , 'default', null, 'error');
            }
		}
        $brands = $this->BeautyTip->Brand->find('list');
        $categories = $this->BeautyTip->Category->find('list');
		$beautycategories = $this->BeautyTip->BeautyCategory->find('list',array(
						'conditions'=> array(
							'BeautyCategory.is_active'=> 1
						)
					));
        $this->set(compact('brands', 'categories','beautycategories'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Beauty Tip');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->BeautyTip->id = $id;
        if (!$this->BeautyTip->exists()) {
            throw new NotFoundException(__l('Invalid beauty tip'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
			$this->BeautyTip->set($this->request->data);
		    $this->BeautyTip->Category->set($this->request->data);
			if($this->BeautyTip->validates()& $this->BeautyTip->Category->validates()){
            if ($this->BeautyTip->save($this->request->data)) {
				  $id = $foreign_id = $this->request->data['BeautyTip']['id'];
				   if (!(empty($this->request->data['Attachment']['filename']['name']))) {
					$attach = $this->BeautyTip->Attachment->find('first', array(
						'conditions' => array(
							'Attachment.foreign_id = ' => $foreign_id,
							'Attachment.class = ' => 'BeautyTip'
						) ,
						'fields' => array(
							'Attachment.id'
						) ,
						'recursive' => - 1,
					));
					if(!empty($attach['Attachment']['id']))
			        $this->BeautyTip->Attachment->delete($attach['Attachment']['id']);
				    $this->BeautyTip->Attachment->create();
                    $this->request->data['Attachment']['class'] = 'BeautyTip';
                    $this->request->data['Attachment']['description'] = 'BeautyTip Image';
                    $this->request->data['Attachment']['foreign_id'] = $this->request->data['BeautyTip']['id'];
                    $data['Attachment']['filename'] = $this->request->data['Attachment']['filename'];
                    $this->BeautyTip->Attachment->save($this->request->data['Attachment']);
                  }
				    if (!(empty($this->request->data['Attachment1']['filename']['name']))) {
				  	$attach1 = $this->BeautyTip->Attachment1->find('first', array(
						'conditions' => array(
							'Attachment1.foreign_id = ' => $foreign_id,
							'Attachment1.class = ' => 'BeautyTipSlider'
						) ,
						'fields' => array(
							'Attachment1.id'
						) ,
						'recursive' => - 1,
					));
					if(!empty($attach1['Attachment1']['id']))
			        $this->BeautyTip->Attachment->delete($attach1['Attachment1']['id']);
				    $this->BeautyTip->Attachment->create();
                    $this->request->data['Attachment1']['class'] = 'BeautyTipSlider';
                    $this->request->data['Attachment1']['description'] = 'BeautyTipSlider Image thumb';
                    $this->request->data['Attachment1']['foreign_id'] = $this->request->data['BeautyTip']['id'];
                    $this->BeautyTip->Attachment->save($this->request->data['Attachment1']);
                  }
			    if (!(empty($this->request->data['Attachment2']['filename']['name']))) {
				  	$attach1 = $this->BeautyTip->Attachment2->find('first', array(
						'conditions' => array(
							'Attachment2.foreign_id = ' => $foreign_id,
							'Attachment2.class = ' => 'ContributorImage'
						) ,
						'fields' => array(
							'Attachment2.id'
						) ,
						'recursive' => - 1,
					));
					if(!empty($attach1['Attachment2']['id']))
			        $this->BeautyTip->Attachment->delete($attach1['Attachment2']['id']);
				    $this->BeautyTip->Attachment->create();
                    $this->request->data['Attachment2']['class'] = 'ContributorImage';
                    $this->request->data['Attachment2']['description'] = 'ContributorImage Image thumb';
                    $this->request->data['Attachment2']['foreign_id'] = $this->request->data['BeautyTip']['id'];
                    $this->BeautyTip->Attachment->save($this->request->data['Attachment2']);
                  }
                $this->Session->setFlash(__l('Beauty Content Page has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Beauty Content Page could not be updated. Please, try again.') , 'default', null, 'error');
            }
			}  else {
                $this->Session->setFlash(__l('Beauty Content Page could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->BeautyTip->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['BeautyTip']['name'];
        $brands = $this->BeautyTip->Brand->find('list');
        $categories = $this->BeautyTip->Category->find('list');
        $beautycategories = $this->BeautyTip->BeautyCategory->find('list',array(
						'conditions'=> array(
							'BeautyCategory.is_active'=> 1
						)
					));
		$this->set(compact('brands', 'categories','beautycategories'));
    }
    public function admin_delete($id = null)
    {
	    if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->BeautyTip->delete($id)) {
            $this->Session->setFlash(__l('Beauty Content Page deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
