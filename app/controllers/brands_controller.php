<?php
class BrandsController extends AppController
{
    public $name = 'Brands';
	public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment',
	    );
        parent::beforeFilter();
    }
    public function index()
    {
	     $this->pageTitle = __l('brands');
        $this->Brand->recursive = 0;
		$this->paginate = array(
			'conditions'=> array(
				'Brand.is_active'=> 1
			),
			'order' => array(
                'Brand.name' => 'asc'
            ),
			'limit'=> 200
        );
        $this->set('brands', $this->paginate());
    }
    public function view($slug = null)
    {
        $this->pageTitle = __l('Brand');
  		$brand = $this->Brand->find('first', array(
            'conditions' => array(
                'Brand.slug = ' => $slug
            ) ,
			'contain'=> array(
				'Attachment'
			),
            'fields' => array(
                'Brand.id',
                'Brand.name',
                'Brand.slug',
                'Brand.description',
                'Brand.location',
                'Brand.telephone_no',
                'Brand.fax_no',
                'Brand.email',
                'Brand.facebook_url',
                'Brand.web_url',
                'Brand.beauty_tip_url',
                'Brand.promotion_url',
		        'Brand.location1',
                'Brand.telephone_no1',
                'Brand.fax_no1',
                'Brand.email1',
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
  			 ),
            'order' => array(
                'Brand.id' => 'desc'
            )
        );
	     $this->set('brands', $this->paginate());
	 	$moreActions = $this->Brand->moreActions;
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
			$this->Brand->set($this->request->data);
			if($this->Brand->validates() && $ini_upload_error) {
            $this->Brand->create();
            if ($this->Brand->save($this->request->data)) {
				$id = $this->Brand->id;
				if(!empty($this->request->data['Attachment']['filename']['name'])){
						$this->Brand->Attachment->create();
						$this->request->data['Attachment']['foreign_id'] = $id;
						$this->request->data['Attachment']['class'] = 'Brand';
						$this->Brand->Attachment->save($this->request->data['Attachment']);
				 }
                $this->Session->setFlash(__l('brand has been added') , 'default', null, 'success');
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
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Brand->save($this->request->data)) {
				 if(!empty($this->request->data['Attachment']['filename']['name'])){
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
                $this->Session->setFlash(__l('brand has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('brand could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->Brand->read(null, $id);
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
	public function test(){
		if(!empty($this->request->data)){
			echo "<pre>";
			print_r($this->request->data);
			exit;

		}
	}
		public function test1(){
		if(!empty($this->request->data)){
			echo "<pre>";
			print_r($this->request->data);
			exit;

		}
	}

}
