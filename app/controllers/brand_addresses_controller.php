<?php
class BrandAddressesController extends AppController
{
    public $name = 'BrandAddresses';
    public function admin_add($brandAddress_id = null)
    {
		if(!empty($brandAddress_id))
		$this->request->data['BrandAddress']['brand_id'] = $brandAddress_id;
        $this->pageTitle = __l('Add Brand Address');
        if ($this->request->is('post')) {
            $this->BrandAddress->create();
            if ($this->BrandAddress->save($this->request->data)) {
				$id = $this->BrandAddress->id;
				if(!empty($this->request->data['Attachment']['filename']['name'])){
						$this->BrandAddress->Attachment->create();
						$this->request->data['Attachment']['foreign_id'] = $id;
						$this->request->data['Attachment']['class'] = 'BrandAddress';
						$this->BrandAddress->Attachment->save($this->request->data['Attachment']);
				}
				$this->Session->setFlash(__l('Brand address has been added') , 'default', null, 'success');
                $this->redirect(array(
					'controller'=>'brands',
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Brand address could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $brands = $this->BrandAddress->Brand->find('list');
        $this->set(compact('brands'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Brand Address');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->BrandAddress->id = $id;
        if (!$this->BrandAddress->exists()) {
            throw new NotFoundException(__l('Invalid brand address'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->BrandAddress->save($this->request->data)) {
				if(!empty($this->request->data['Attachment']['filename']['name'])){
						$attachment1=$this->BrandAddress->Attachment->find('first', array('conditions'=>array('Attachment.foreign_id'=>$this->request->data['BrandAddress']['id'], 'Attachment.class'=>'BrandAddress'), 'recursive'=>-1));
						if(!empty($attachment1)){
							$this->request->data['Attachment']['id'] = $attachment1['Attachment']['id'];
						}else{
							$this->BrandAddress->Attachment->create();
						}
						$this->request->data['Attachment']['foreign_id'] = $this->request->data['BrandAddress']['id'];
						$this->request->data['Attachment']['class'] = 'BrandAddress';
						$this->BrandAddress->Attachment->save($this->request->data['Attachment']);
				}
                $this->Session->setFlash(__l('Brand address has been updated') , 'default', null, 'success');
                $this->redirect(array(
					'controller'=>'brands',
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Brand address could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->BrandAddress->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['BrandAddress']['id'];
        $brands = $this->BrandAddress->Brand->find('list');
        $this->set(compact('brands'));
    }
	public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->BrandAddress->delete($id)) {
            $this->Session->setFlash(__l('Brand address deleted') , 'default', null, 'success');
            $this->redirect(array(
				'controller'=> 'brands',
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
