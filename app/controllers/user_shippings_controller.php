<?php
class UserShippingsController extends AppController
{
    public $name = 'UserShippings';
    public function index()
    {
		$this->pageTitle = __l('userShippings');
        $this->UserShipping->recursive = 1;
        $this->paginate = array(
                'conditions' => array(
					'UserShipping.user_id' => $this->Auth->user('id')
				),
				'fields' => array(
					'UserShipping.id',
					'UserShipping.address',
					'UserShipping.address2',
					'UserShipping.address3',
					'UserShipping.zip_code',
					'Country.name',
					'State.name',
				),
				'order' => array(
                    'UserShipping.id' => 'desc'
                )
            );
        $this->set('userShippings', $this->paginate());
    }
    public function add()
    {
        $this->pageTitle = __l('Add User Shipping');
        if ($this->request->is('post')) {
			$this->request->data['UserShipping']['user_id'] = $this->Auth->user('id');
            $this->UserShipping->create();
            if ($this->UserShipping->save($this->request->data)) {
                $this->Session->setFlash(__l('Shipping Information has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Shipping Information could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
      	$states = $this->UserShipping->State->find('list',array(
							'conditions'=> array(
								'State.is_approved'=> 1
							)
		));
        $countries = $this->UserShipping->Country->find('list');
        $this->set(compact('states', 'countries'));
    }
    public function edit($id = null)
    {
        $this->pageTitle = __l('Edit User Shipping');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->UserShipping->id = $id;
        if (!$this->UserShipping->exists()) {
            throw new NotFoundException(__l('Invalid user shipping'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['UserShipping']['user_id'] = $this->Auth->user('id');
            if ($this->UserShipping->save($this->request->data)) {
			    $this->Session->setFlash(__l('Shipping Information has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Shipping Information could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->UserShipping->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['UserShipping']['address'];
       	$states = $this->UserShipping->State->find('list',array(
							'conditions'=> array(
								'State.is_approved'=> 1
							)
		));
        $countries = $this->UserShipping->Country->find('list');
        $this->set(compact('states', 'countries'));
    }
	
	public function admin_chart(){
		$states = $this->UserShipping->State->find('list',array(
							'conditions'=> array(
								'State.is_approved'=> 1
							)
		));
        $this->set(compact('states'));
	}
  }
