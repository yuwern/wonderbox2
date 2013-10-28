<?php
class RelatedProductsController extends AppController
{
    public $name = 'RelatedProducts';
    public function index($slug = null)
    {
		$conditions = array();
		if(!empty($slug)){
			$productRedemption = $this->RelatedProduct->ProductRedemption->find('first', array(
				'conditions'=> array(
					'ProductRedemption.slug' => $slug
				),
				'fields'=> array(
					'ProductRedemption.id' ,
					'ProductRedemption.name', 
					'ProductRedemption.slug', 
					'ProductRedemption.short_description' 
				),
				'recursive'=> -1
				)
			);				
			if (empty($productRedemption)) {
				throw new NotFoundException(__l('Invalid request'));
			}
			$this->set('productRedemption',$productRedemption);
			$conditions['RelatedProduct.product_redemption_id'] = $productRedemption['ProductRedemption']['id'];
		}
		$this->paginate = array(
				'conditions'=> $conditions,
				'contain' =>  array(
					'Attachment',
				),
			);
        $this->pageTitle = __l('relatedProducts');
        $this->RelatedProduct->recursive = 2;
        $this->set('relatedProducts', $this->paginate());
    }
    public function view($slug = null)
    {
        $this->pageTitle = __l('Related Product');
        $relatedProduct = $this->RelatedProduct->find('first', array(
            'conditions' => array(
                'RelatedProduct.slug = ' => $slug
            ) ,
			'contain'=> array(
				'Attachment',
				'ProductRedemption' => array(
					'fields' => array(
					     'ProductRedemption.id',
						 'ProductRedemption.name',
						 'ProductRedemption.slug',
						 'ProductRedemption.short_description',
					)
				)
			),
            'fields' => array(
                'RelatedProduct.id',
                'RelatedProduct.name',
                'RelatedProduct.brand_id',
                'RelatedProduct.product_redemption_id',
                'RelatedProduct.description',
                'RelatedProduct.price',
           
            ) ,
            'recursive' => 2
        ));
        if (empty($relatedProduct)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $relatedProduct['RelatedProduct']['name'];
        $this->set('relatedProduct', $relatedProduct);
    }
    public function admin_add($productredemption_id = null)
    {
		if(!empty($productredemption_id))
			$this->request->data['RelatedProduct']['product_redemption_id'] = $productredemption_id;
		$this->pageTitle = __l('Add Related Product');
        if ($this->request->is('post')) {
            $this->RelatedProduct->create();
            if ($this->RelatedProduct->save($this->request->data)) {
				$id = $this->RelatedProduct->id;
				if(!empty($this->request->data['Attachment']['filename']['name'])){
						$this->RelatedProduct->Attachment->create();
						$this->request->data['Attachment']['foreign_id'] = $id;
						$this->request->data['Attachment']['class'] = 'RelatedProduct';
						$this->RelatedProduct->Attachment->save($this->request->data['Attachment']);
				}
				
                $this->Session->setFlash(__l('Related product has been added') , 'default', null, 'success');
                $this->redirect(array(
					'controller'=>'product_redemptions',
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Related product could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $brands = $this->RelatedProduct->Brand->find('list');
        $productRedemptions = $this->RelatedProduct->ProductRedemption->find('list');
        $this->set(compact('brands', 'productRedemptions'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Related Product');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->RelatedProduct->id = $id;
        if (!$this->RelatedProduct->exists()) {
            throw new NotFoundException(__l('Invalid related product'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->RelatedProduct->save($this->request->data)) {
				if(!empty($this->request->data['Attachment']['filename']['name'])){
						$attachment1=$this->RelatedProduct->Attachment->find('first', array('conditions'=>array('Attachment.foreign_id'=>$this->request->data['RelatedProduct']['id'], 'Attachment.class'=>'RelatedProduct'), 'recursive'=>-1));
						if(!empty($attachment1)){
							$this->request->data['Attachment']['id'] = $attachment1['Attachment']['id'];
						}else{
							$this->RelatedProduct->Attachment->create();
						}
						$this->request->data['Attachment']['foreign_id'] = $this->request->data['RelatedProduct']['id'];
						$this->request->data['Attachment']['class'] = 'RelatedProduct';
						$this->RelatedProduct->Attachment->save($this->request->data['Attachment']);
				}
				$this->Session->setFlash(__l('Related product has been updated') , 'default', null, 'success');
                $this->redirect(array(
					'controller'=>'product_redemptions',
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Related product could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->RelatedProduct->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['RelatedProduct']['name'];
        $brands = $this->RelatedProduct->Brand->find('list');
        $productRedemptions = $this->RelatedProduct->ProductRedemption->find('list');
        $this->set(compact('brands', 'productRedemptions'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->RelatedProduct->delete($id)) {
            $this->Session->setFlash(__l('Related Product deleted') , 'default', null, 'success');
            $this->redirect(array(
				'controller'=>'product_redemptions',
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
