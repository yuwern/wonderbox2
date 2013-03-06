<?php
class ProductsController extends AppController
{
    public $name = 'Products';
    public $helpers = array(
        'Csv',
    );
    public $components = array(
        'Email',
    );
	public function index()
    {
        $this->pageTitle = __l('Products');
        $this->Product->recursive = 0;
		$conditions = array();
		$conditions['Product.is_active'] = 1;
		$limit = 20;
		$order['Product.id'] = 'desc';
		if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'product-lists') {
			$conditions['Product.brand_id'] = $this->params['named']['brand_id'];
			$order['Product.id'] = 'desc';
			$limit = 3;
        }
		if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'product') {
			$conditions['Product.brand_id'] = $this->params['named']['brand_id'];
			$order['Product.id'] = 'desc';
        }
		$this->paginate = array(
            'conditions' => $conditions,
			'contain'=> array(
				'Attachment',
				'Brand' => array(
					'fields'=> array(
						'Brand.id',
						'Brand.name',
						'Brand.slug',
						'Brand.short_description',
					)
				)
			),
            'recursive' => 2,
            'order' => $order,
            'limit' => $limit
        );
		$this->set('products', $this->paginate());
		if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'product-lists') {
                $this->render('index-product-lists');
         }
		 
    }
    public function view($slug = null)
    {
        $this->pageTitle = __l('Product');
        $product = $this->Product->find('first', array(
            'conditions' => array(
                'Product.slug = ' => $slug
            ) ,
            'fields' => array(
                'Product.id',
                'Product.category_id',
                'Product.brand_id',
                'Product.wonder_point',
                'Product.slug',
                'Product.name',
                'Product.description',
                'Product.price',
                'Product.is_active',
                'Category.id',
                'Category.name',
                'Brand.id',
                'Brand.name',
                'Brand.short_description',
                'Brand.slug',
              ) ,
            'recursive' => 1,
        ));
        if (empty($product)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $product['Product']['name'];
        $this->set('product', $product);
    }
    public function admin_index()
    {
        $this->pageTitle = __l('Products');
        $this->Product->recursive = 1;
		$this->paginate = array(
		  'contain'=> array(
			'Attachment',
			'Category'=> array(
				'fields' => array(
					'Category.name'
				)
			),
			'BeautyCategory'=> array(
				'fields' => array(
					'Category.name'
				)
			),
			'Brand'=> array(
				'fields' => array(
					'Brand.id',
					'Brand.name'
				)
			)
		  ),
		  'fields'=> array(
			'Product.id',
			'Product.slug',
			'Product.name',
			'Product.wonder_point',
			'Product.product_redeem_count',
			'Product.is_active'
		   ),
		  'order' => array(
                'Product.id' => 'desc'
            )
        );
		$moreActions = $this->Product->moreActions;
	    $this->set(compact('moreActions'));   
        $this->set('products', $this->paginate());
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Product');
       if (!empty($this->request->data)) {
		   $this->request->data['Product']['edition_date']['day'] = 15;
		   	 if (!empty($this->request->data['Attachment']['filename']['name'])) {
					$this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
					$this->Product->Attachment->Behaviors->attach('ImageUpload', Configure::read('image.file'));
			 }
			 if (!empty($this->request->data['Attachment']['filename']['name']) || (!Configure::read('image.file.allowEmpty') && empty($this->request->data['Attachment']['id']))) {
					$this->request->data['Attachment']['class'] = 'Product';
					$this->Product->Attachment->set($this->request->data);
			 }
			 $ini_upload_error = 1;
			 if ($this->request->data['Attachment']['filename']['error'] == 4) {
					$ini_upload_error = 0;
  			 }
		   date_default_timezone_set('UTC');
		   $this->Product->set($this->request->data);
		   if($this->Product->validates() && $ini_upload_error) {
				$this->Product->create();
				if ($this->Product->save($this->request->data)) {
					$id = $this->Product->id;
					if(!empty($this->request->data['Attachment']['filename']['name'])){
						$this->Product->Attachment->create();
						$this->request->data['Attachment']['foreign_id'] = $id;
						$this->request->data['Attachment']['class'] = 'Product';
						$this->Product->Attachment->save($this->request->data['Attachment']);
					}
					$this->Session->setFlash(__l('Product has been added') , 'default', null, 'success');
					$this->redirect(array(
						'action' => 'index'
					));
				} else {
					$this->Session->setFlash(__l('Product could not be added. Please, try again.') , 'default', null, 'error');
				}
		   }else{
				 if ($this->request->data['Attachment']['filename']['error'] == 4) {
					    $this->Product->Attachment->validationErrors['filename'] = __l('Please upload the image') ;
				 }
                $this->Session->setFlash(__l('Product could not be added. Please, try again.') , 'default', null, 'error');
			}
        }
        $categories = $this->Product->Category->find('list',array(
						'conditions'=> array(
							'Category.is_active'=> 1
						)
					));
       $beautycategories = $this->Product->BeautyCategory->find('list',array(
						'conditions'=> array(
							'BeautyCategory.is_active'=> 1
						)
					));
        $brands = $this->Product->Brand->find('list',array(
						'conditions'=> array(
							'Brand.is_active'=> 1
						)
					));
		$this->set(compact('categories', 'brands','beautycategories'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Product');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__l('Invalid product'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
		   $this->request->data['Product']['edition_date']['month'] = $this->request->data['Product']['edition_date']['month'];
		   ;
		   $this->request->data['Product']['edition_date']['day'] = 15;
		   $this->request->data['Product']['edition_date']['year'] = $this->request->data['Product']['edition_date']['year'];
		   date_default_timezone_set('UTC');
		   if ($this->Product->save($this->request->data)) {
				 if(!empty($this->request->data['Attachment']['filename']['name'])){
						$attachment1=$this->Product->Attachment->find('first', array('conditions'=>array('Attachment.foreign_id'=>$this->request->data['Product']['id'], 'Attachment.class'=>'Product'), 'recursive'=>-1));
						if(!empty($attachment1)){
							$this->request->data['Attachment']['id'] = $attachment1['Attachment']['id'];
						}else{
							$this->Product->Attachment->create();
						}
						$this->request->data['Attachment']['foreign_id'] = $this->request->data['Product']['id'];
						$this->request->data['Attachment']['class'] = 'Product';
						$this->Product->Attachment->save($this->request->data['Attachment']);
				}
                $this->Session->setFlash(__l('Product has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Product could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->Product->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['Product']['name'];
        $categories = $this->Product->Category->find('list',array(
						'conditions'=> array(
							'Category.is_active'=> 1
						)
					));
        $brands = $this->Product->Brand->find('list',array(
						'conditions'=> array(
							'Brand.is_active'=> 1
						)
					));
	    $beautycategories = $this->Product->BeautyCategory->find('list',array(
						'conditions'=> array(
							'BeautyCategory.is_active'=> 1
						)
				));
        $this->set(compact('categories', 'brands','beautycategories'));
    }
	public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Product->delete($id)) {
            $this->Session->setFlash(__l('Product deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
	public function survey()
	{
		$this->_redirectGET2Named(array(
            'month',
        ));
		$conditions = array();
		$this->loadModel('PackageUser');
		/* $packageUser = $this->PackageUser->find('first', array(
            'conditions' => array(
                'PackageUser.user_id' =>$this->Auth->user('id')
            ) ,
			'fields' => array(
                'PackageUser.start_date',
                'PackageUser.end_date',
            ) ,
 		    'order'=> array(
			     'PackageUser.id'=>'desc'
			  ),
            'recursive' => -1,
        ));
	  $startpackageUser = $this->PackageUser->find('first', array(
            'conditions' => array(
				'PackageUser.start_date >='=> date('Y-m-1'),
                'PackageUser.user_id' => $this->Auth->user('id')
            ) ,
			'fields' => array(
                'PackageUser.start_date'
            ) ,
 		    'order'=> array(
			     'PackageUser.id'=>'asc'
			  ),
            'recursive' => -1,
        ));
	    */
	 	$months = array();
		$packageUserMonths = $this->PackageUser->find('all', array(
            'conditions' => array(
                'PackageUser.user_id' =>$this->Auth->user('id')
            ) ,
			'fields' => array(
                'PackageUser.start_date',
                'PackageUser.end_date',
            ) ,
 		    'order'=> array(
			     'PackageUser.id'=>'asc'
			  ),
            'recursive' => -1,
        ));
		$months = array();
		if(!empty($packageUserMonths)) {
			$conditions['Product.edition_date ='] = $packageUserMonths[0]['PackageUser']['start_date'];
			foreach($packageUserMonths as $packageUserMonth) {
				$months[$packageUserMonth['PackageUser']['start_date']] = date('F Y', strtotime($packageUserMonth['PackageUser']['start_date']));
				$months[$packageUserMonth['PackageUser']['end_date']] = date('F Y', strtotime($packageUserMonth['PackageUser']['end_date']));
			}
		}
		if(!empty($this->request->data['Product']['month'])){
			$conditions['Product.edition_date ='] = $this->request->data['Product']['month'];
		}
		$conditions['Product.is_active'] = 1;
		$this->paginate = array(
			'contain'=>array(
				'Brand'=> array(
					'fields'=> array(
						'Brand.name',
					)
				)
			),
            'conditions' => $conditions,
			'fields'=> array(
				'Product.id',
				'Product.brand_id',
				'Product.wonder_point',
				'Product.name',
	            'Product.slug',
				'Product.price',
				'Product.end_date',
			),
            'recursive' => 1,
        );
		$this->set('months',$months);
	    $this->set('products', $this->paginate());
	}
	public function product_redeem()
	{
		$conditions = array();
		$conditions['Product.edition_date >='] =  date('Y-m-d',mktime(0, 0, 0, date("m")-1  , 15 , date("Y")));;
		$conditions['Product.is_active'] = 1;
		$conditions['Product.redeem_wonder_point !='] = 0;
		$this->paginate = array(
			'contain'=>array(
				'Brand'=> array(
					'fields'=> array(
						'Brand.name',
					)
				)
			),
            'conditions' => $conditions,
			'fields'=> array(
				'Product.id',
				'Product.brand_id',
				'Product.redeem_wonder_point',
				'Product.name',
	            'Product.slug',
				'Product.price',
				'Product.end_date',
			),
            'recursive' => 1,
        );
	    $this->set('products', $this->paginate());
	}
	function get_months($date1, $date2) {
		$timezone_code = Configure::read('site.timezone_offset');
        if (!empty($timezone_code)) {
            date_default_timezone_set($timezone_code);
        }
		$time1 = strtotime($date1);
		$time2 = strtotime($date2);
		$my = date('mY', $time2);
		$months = array(date('F Y', $time1));
		$newmonths = array();
		$newmonths[date('Y-m-15',$time1)] = date('F Y', $time1);
		$f = '';
		while($time1 < $time2) {
		$time1 = strtotime((date('Y-m-d', $time1).' +15days'));

		if(date('F', $time1) != $f) {
		$f = date('F', $time1);
		if(date('mY', $time1) != $my && ($time1 < $time2))
			$months[] = date('F Y', $time1);
			$newmonths[date('Y-m-15',$time1)] = date('F Y', $time1);
		}
		}
		$months[] = date('F Y', $time2);
		$newmonths[date('Y-m-15',$time2)] = date('F Y', $time2);
		return $newmonths;
	}
    public function quiz($slug = null)
    {
        $this->pageTitle = __l('Product');
        $product = $this->Product->find('first', array(
            'conditions' => array(
                'Product.slug = ' => $slug
            ) ,
            'fields' => array(
                'Product.id',
                'Product.category_id',
                'Product.brand_id',
                'Product.slug',
                'Product.wonder_point',
                'Product.slug',
                'Product.name',
                'Product.description',
                'Product.price',
                'Product.is_active',
                'Category.id',
                'Category.name',
                'Brand.id',
                'Brand.name',
              ) ,
            'recursive' => 1,
        ));        
        if (empty($product)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		$checkSurveyCompleteOrNot = $this->Product->ProductSurvey->find('count', array(
											'conditions'=> array(
												'ProductSurvey.user_id'=> $this->Auth->user('id'),
												'ProductSurvey.product_id'=> $product['Product']['id'],
											)
									)
						);
		if(!empty($checkSurveyCompleteOrNot)){
			$this->redirect(array(
						'action' => 'survey'
			));
		}
        $this->pageTitle.= ' - ' . $product['Product']['name'];
        $this->set('product', $product);
    }
/*	public function admin_chart($slug = null){
	$product = $this->Product->find('first', array(
            'conditions' => array(
                'Product.slug = ' => $slug
            ) ,
            'fields' => array(
                'Product.id',
                'Product.category_id',
                'Product.beauty_category_id',
                'Product.brand_id',
                'Product.slug',
                'Product.wonder_point',
                'Product.slug',
                'Product.name',
                'Product.description',
                'Product.end_date',
                'Product.price',
                'Product.is_active',
                'Category.id',
                'Category.name',
                'Brand.id',
                'Brand.name',
				'BeautyCategory.name'
		      ) ,
            'recursive' => 0,
        ));
		if(!empty($this->request->params['named']['type'])&& $this->request->params['named']['type'] =='print'){
			$this->layout = 'pdf';
		}
        if (empty($product)) {
            throw new NotFoundException(__l('Invalid request'));
        }	
		$productQuestions = $this->Product->BeautyCategory->BeautyQuestion->find('all',array(
						'conditions' => array(
								'BeautyQuestion.id BETWEEN ? AND ?' => array(
						            16,
									23,
							),
						),
						'contain'=> array(
							'BeautyCategory'=> array(
								'fields'=> array(
									'BeautyCategory.name',
								)
							),
							'BeautyAnswer'=> array(
								'fields'=> array(
									'BeautyAnswer.answer',
								)
							)
						),
						'fields'=> array(
							'BeautyQuestion.id',
							'BeautyQuestion.beauty_category_id',
							'BeautyQuestion.name',
						)
		));
		$beautyQuestions = $this->Product->BeautyCategory->BeautyQuestion->find('all',array(
						'conditions' => array(
							'BeautyQuestion.beauty_category_id'=> $product['Product']['beauty_category_id'],
							'BeautyQuestion.id BETWEEN ? AND ?' => array(
						            1,
									15,
							),
						),
						'contain'=> array(
							'BeautyCategory'=> array(
								'fields'=> array(
									'BeautyCategory.name',
								)
							),
							'BeautyAnswer'=> array(
								'fields'=> array(
									'BeautyAnswer.answer',
								)
							)
						),
						'fields'=> array(
							'BeautyQuestion.id',
							'BeautyQuestion.beauty_category_id',
							'BeautyQuestion.name',
						)
		));
		$participants  = $this->Product->ProductSurvey->find('all', array(
			'conditions'=> array(
				'ProductSurvey.product_id'=> $product['Product']['id']
			),
			'contain'=> array(
				'User'=> array(
					'fields'=> array(
						'User.email'
					)
				)
			),
			'fields'=> array(
				'Distinct(ProductSurvey.user_id)'
			),
            'recursive' => 1,
        ));
	   if ($this->RequestHandler->prefers('csv')) {
            Configure::write('debug', 0);
			$this->set('participants',$participants);
      } else {
	    $participantUserIds = Set::extract('/ProductSurvey/user_id', $participants);
	    $this->set('participantUserIds',$participantUserIds);
		$this->set('totalparticipants',count($participants));
		$this->set('participants',$participants);
		$this->set('product', $product);
		$this->set('beautyQuestions', $beautyQuestions);
		$this->set('productQuestions', $productQuestions);
	  }
	}*/
	public function admin_chart($slug = null){
	$product = $this->Product->find('first', array(
            'conditions' => array(
                'Product.slug = ' => $slug
            ) ,
            'fields' => array(
                'Product.id',
                'Product.category_id',
                'Product.beauty_category_id',
                'Product.brand_id',
                'Product.slug',
                'Product.wonder_point',
                'Product.slug',
                'Product.name',
                'Product.description',
                'Product.end_date',
                'Product.price',
                'Product.is_active',
                'Category.id',
                'Category.name',
                'Brand.id',
                'Brand.name',
				'BeautyCategory.name'
		      ) ,
            'recursive' => 0,
        ));
		if(!empty($this->request->params['named']['type'])&& $this->request->params['named']['type'] =='print'){
			$this->layout = 'pdf';
		}
        if (empty($product)) {
            throw new NotFoundException(__l('Invalid request'));
        }	
		$productQuestions = $this->Product->BeautyCategory->BeautyQuestion->find('all',array(
						'conditions' => array(
								'BeautyQuestion.id BETWEEN ? AND ?' => array(
						            16,
									23,
							),
						),
						'contain'=> array(
							'BeautyCategory'=> array(
								'fields'=> array(
									'BeautyCategory.name',
								)
							),
							'BeautyAnswer'=> array(
								'fields'=> array(
									'BeautyAnswer.answer',
								)
							)
						),
						'fields'=> array(
							'BeautyQuestion.id',
							'BeautyQuestion.beauty_category_id',
							'BeautyQuestion.name',
						)
		));
		$beautyQuestions = $this->Product->BeautyCategory->BeautyQuestion->find('all',array(
						'conditions' => array(
							'BeautyQuestion.beauty_category_id'=> $product['Product']['beauty_category_id'],
							'BeautyQuestion.id BETWEEN ? AND ?' => array(
						            1,
									15,
							),
						),
						'contain'=> array(
							'BeautyCategory'=> array(
								'fields'=> array(
									'BeautyCategory.name',
								)
							),
							'BeautyAnswer'=> array(
								'fields'=> array(
									'BeautyAnswer.answer',
								)
							)
						),
						'fields'=> array(
							'BeautyQuestion.id',
							'BeautyQuestion.beauty_category_id',
							'BeautyQuestion.name',
						)
		));
		$beautyQuestionProductCategorys = $this->Product->BeautyCategory->BeautyQuestion->find('all',array(
						'conditions' => array(
							'BeautyQuestion.beauty_category_id'=> 3,
							'BeautyQuestion.id BETWEEN ? AND ? ' => array(
						            1,
									15,
							),
						),
						'contain'=> array(
							'BeautyCategory'=> array(
								'fields'=> array(
									'BeautyCategory.name',
								)
							),
							'BeautyAnswer'=> array(
								'fields'=> array(
									'BeautyAnswer.answer',
								)
							)
						),
						'fields'=> array(
							'BeautyQuestion.id',
							'BeautyQuestion.beauty_category_id',
							'BeautyQuestion.name',
						)
		));
		$productQuestionCategorys = $this->Product->BeautyCategory->BeautyQuestion->find('all',array(
						'conditions' => array(
								'BeautyQuestion.id BETWEEN ? AND ?' => array(
						            21,
									22,
							),
						),
						'contain'=> array(
							'BeautyCategory'=> array(
								'fields'=> array(
									'BeautyCategory.name',
								)
							),
							'BeautyAnswer'=> array(
								'fields'=> array(
									'BeautyAnswer.answer',
								)
							)
						),
						'fields'=> array(
							'BeautyQuestion.id',
							'BeautyQuestion.beauty_category_id',
							'BeautyQuestion.name',
						)
		));
		$participants  = $this->Product->ProductSurvey->find('all', array(
			'conditions'=> array(
				'ProductSurvey.product_id'=> $product['Product']['id']
			),
			'contain'=> array(
				'User'=> array(
					'fields'=> array(
						'User.email'
					)
				)
			),
			'fields'=> array(
				'Distinct(ProductSurvey.user_id)'
			),
            'recursive' => 1,
        ));
	   if ($this->RequestHandler->prefers('csv')) {
            Configure::write('debug', 0);
			$this->set('participants',$participants);
      } else {
	    $participantUserIds = Set::extract('/ProductSurvey/user_id', $participants);
	    $this->set('participantUserIds',$participantUserIds);
		$this->set('totalparticipants',count($participants));
		$this->set('participants',$participants);
		$this->set('product', $product);
		$this->set('beautyQuestions', $beautyQuestions);
		$this->set('productQuestions', $productQuestions);
		$this->set('beautyQuestionProductCategorys', $beautyQuestionProductCategorys);
		$this->set('productQuestionCategorys', $productQuestionCategorys);
	  }
	}
}
?>