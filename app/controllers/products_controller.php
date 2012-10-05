<?php
class ProductsController extends AppController
{
    public $name = 'Products';
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
			$limit = 10;
        }
		if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'product') {
			$conditions['Product.brand_id'] = $this->params['named']['brand_id'];
			$order['Product.id'] = 'desc';
        }
		$this->paginate = array(
            'conditions' => $conditions,
            'recursive' => 1,
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
        $brands = $this->Product->Brand->find('list',array(
						'conditions'=> array(
							'Brand.is_active'=> 1
						)
					));
        $this->set(compact('categories', 'brands'));
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
					));;
        $this->set(compact('categories', 'brands'));
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
}
