<?php
class WonderSpreesController extends AppController
{
    public $name = 'WonderSprees';
	public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment',
		);
        parent::beforeFilter();
    }
    public $components = array(
        'Email',
 
    );	
	
	/*public function index()
    {
        $this->pageTitle = __l('wonderSprees');
        $this->WonderSpree->recursive = 0;
        $this->set('wonderSprees', $this->paginate());
    }*/
	
	public function index()
    {
        $this->pageTitle = __l('wonderSprees');
        $this->WonderSpree->recursive = 0;
		$this->paginate = array(
				'conditions' => array(
					'WonderSpree.user_id'=> $this->Auth->user('id')
				),
				
				'order' => array(
					'WonderSpree.id'=>'desc'
				)
		);
        $this->set('wonderSprees', $this->paginate());
    }
	
	
    public function view($id = null)
    {
        $this->pageTitle = __1('Wonder Spree');
        $this->WonderSpree->id = $id;
        if (!$this->WonderSpree->exists()) {
            throw new NotFoundException(__l('Invalid wonder spree'));
        }
        $wonderSpree = $this->WonderSpree->find('first', array(
            'conditions' => array(
                'WonderSpree.id = ' => $id
            ) ,
            'fields' => array(
                'WonderSpree.id',
                'WonderSpree.purchase_amt',
                'WonderSpree.discount',
                'WonderSpree.gift',
                'WonderSpree.brand',
                'WonderSpree.categories',
                'WonderSpree.location',
                'WonderSpree.purchase_date',
                'WonderSpree.upload_receipt',
            ) ,
            'recursive' => - 1,
        ));
        if (empty($wonderSpree)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $wonderSpree['WonderSpree']['id'];
        $this->set('wonderSpree', $wonderSpree);
    }
    public function add()
    
	{
	    $this->pageTitle = __l('Add Wonder Spree');
		//$brands = $this->WonderSpree->Brand->find('list');
	    //$categories = $this->WonderSpree->Category->find('list');
		$userId = $this->Auth->user('id');
        //$this->set('brands', $brands);
		//$this->set('categories', $categories);
		if ($this->request->is('post')) {
		    if (!empty($this->request->data['Attachment']['filename']['name'])) {
					$this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
					$this->WonderSpree->Attachment->Behaviors->attach('ImageUpload', Configure::read('image.file'));
			 }
			 if (!empty($this->request->data['Attachment']['filename']['name']) || (!Configure::read('image.file.allowEmpty') && empty($this->request->data['Attachment']['id']))) {
					$this->request->data['Attachment']['class'] = 'WonderSpree';
					$this->WonderSpree->Attachment->set($this->request->data);
			 }
			 $ini_upload_error = 1;
			 if ($this->request->data['Attachment']['filename']['error'] == 4) {
			 $ini_upload_error = 0;
  			 }
			$this->request->data['WonderSpree']['user_id'] = $this->Auth->user('id');
			 if (($this->request->data['Attachment']['filename']['type'] == 'image/jpeg') || ($this->request->data['Attachment']['filename']['type'] == 'image/jpg') || ($this->request->data['Attachment']['filename']['type'] == 'image/png') && ($this->request->data['Attachment']['filename']['size'] <= '500')){
			   if($this->WonderSpree->validates() && $ini_upload_error) {
			   $this->WonderSpree->create();
			   if ($this->WonderSpree->save($this->request->data)) {
			    $id = $this->WonderSpree->id;
				if(!empty($this->request->data['Attachment']['filename']['name'])){
				//if (($this->request->data['Attachment']['filename']['type'] == 'image/jpeg') || ($this->request->data['Attachment']['filename']['type'] == 'image/jpg') || ($this->request->data['Attachment']['filename']['type'] == 'image/png')||($this->request->data['Attachment']['filename']['type'] == 'application/pdf')){
						$this->WonderSpree->Attachment->create();
						$this->request->data['Attachment']['foreign_id'] = $id;
						$this->request->data['Attachment']['class'] = 'WonderSpree';
						$this->WonderSpree->Attachment->save($this->request->data['Attachment']);
				}
			    $this->Session->setFlash(__l('wonder spree has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'add'
                ));
				//}else{
				  // $this->Session->setFlash(__l('wonder spree could not be added. Please, try again.') , 'default', null, 'error');
				//}
            } else {
                $this->Session->setFlash(__l('wonder spree could not be added. Please, try again.') , 'default', null, 'error');
            }
			}
			else{
			if ($this->request->data['Attachment']['filename']['error'] == 4) {
					    $this->WonderSpree->Attachment->validationErrors['filename'] = __l('Please upload the image') ;
			}
		}
		} else {
			$this->Session->setFlash(__l('Invalid Image formate or size.') , 'default', null, 'error');
			}
        }
		$brands = $this->WonderSpree->Brand->find('list');
		$categories = $this->WonderSpree->Category->find('list');
		$this->set(compact('brands'));
		$this->set(compact('categories'));
   }
    
	
	public function edit($id = null)
    {
        $this->pageTitle = __1('Edit Wonder Spree');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->WonderSpree->id = $id;
        if (!$this->WonderSpree->exists()) {
            throw new NotFoundException(__l('Invalid wonder spree'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->WonderSpree->save($this->request->data)) {
                $this->Session->setFlash(__l('wonder spree has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('wonder spree could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->WonderSpree->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['WonderSpree']['id'];
    }
    
	public function delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->WonderSpree->id = $id;
        if (!$this->WonderSpree->exists()) {
            throw new NotFoundException(__l('Invalid wonder spree'));
        }
        if ($this->WonderSpree->delete()) {
            $this->Session->setFlash(__l('Wonder spree deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->Session->setFlash(__l('Wonder spree was not deleted') , 'default', null, 'error');
        $this->redirect(array(
            'action' => 'index'
        ));
    }
    
	public function admin_index()
    {
        $this->pageTitle = __l('wonderSprees');
        $this->WonderSpree->recursive = 0;
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
                'WonderSpree.id' => 'desc'
            )
        );
		
        $this->set('wonderSprees', $this->paginate());
		$moreActions = $this->WonderSpree->moreActions;
		if($this->Auth->user('user_type_id') != ConstUserTypes::Admin)
	    unset($moreActions[3]);
	    $this->set(compact('moreActions'));
    }
    
	
	public function admin_show($id = null)
    {
        $this->pageTitle = __l('Wonder Spree');
        $this->WonderSpree->id = $id;
        if (!$this->WonderSpree->exists()) {
            throw new NotFoundException(__l('Invalid wonder spree'));
        }
		
        $wonderSpree = $this->WonderSpree->find('first', array(
            'conditions' => array(
                'WonderSpree.id = ' => $id
            ) ,

            'recursive' => 1,
        ));
		
	    if (empty($wonderSpree)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $wonderSpree['WonderSpree']['id'];
        $this->set('wonderSpree', $wonderSpree);
	}
    
	public function admin_add()
    {
        $this->pageTitle = __1('Add Wonder Spree');
        if ($this->request->is('post')) {
            $this->WonderSpree->create();
            if ($this->WonderSpree->save($this->request->data)) {
                $this->Session->setFlash(__l('wonder spree has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('wonder spree could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
    }
    
	
	public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Wonder Spree');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->WonderSpree->id = $id;
        if (!$this->WonderSpree->exists()) {
            throw new NotFoundException(__l('Invalid wonder spree'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->WonderSpree->save($this->request->data)) {
                $this->Session->setFlash(__l('wonder spree has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('wonder spree could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->WonderSpree->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
				
		$brands = $this->WonderSpree->Brand->find('list');
		$categories = $this->WonderSpree->Category->find('list');
		$this->set(compact('brands'));
		$this->set(compact('categories'));
        $this->pageTitle.= ' - ' . $this->data['WonderSpree']['id'];
    }
	public function admin_add_wonderpoint($id = null)
    {
        $this->pageTitle = __l('Add WonderPoint');
		if (!empty($this->request->data['WonderSpree']['id'])) {
            $id = $this->request->data['WonderSpree']['id'];
        }
		if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $wonderspree = $this->WonderSpree->find('first', array(
            'conditions' => array(
                'WonderSpree.id' => $id
            ) ,
            'recursive' => 1
        ));
		if (empty($wonderspree)) {
           throw new NotFoundException(__l('Invalid request'));
        }
		if (!empty($this->request->data)) {
			$this->WonderSpree->set($this->request->data);
		    $this->loadModel('Transaction');
            $this->request->data['Transaction']['foreign_id'] = ConstUserIds::Admin;
		    $this->request->data['Transaction']['user_id'] = $wonderspree['WonderSpree']['user_id'];
            $this->request->data['Transaction']['class'] = 'SecondUser';
			$this->request->data['Transaction']['amount'] = $wonderspree['WonderSpree']['purchase_amt'];
			$this->request->data['Transaction']['wonder_points'] = $this->request->data['WonderSpree']['available_wonder_points'];
			$this->request->data['Transaction']['transaction_type_id'] = $this->request->data['WonderSpree']['transaction_type'];
			//'/^[0-9]+(\.?[0-9]+)?$/' 	
			//!preg_match('/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s.]{0,1}[0-9]{3}[-\s.]{0,1}[0-9]{4}$/', $phone_no)
			    if (!empty($this->request->data['WonderSpree']['available_wonder_points']) && $this->Transaction->save($this->request->data['Transaction'])) {
				    if(preg_match('/^[1-9][0-9]*$/' ,$this->request->data['WonderSpree']['available_wonder_points'])){ 
				    $this->loadModel('User');
				    $this->User->updateAll(array(
						'User.available_wonder_points' => 'User.available_wonder_points +' . $this->request->data['WonderSpree']['available_wonder_points'],
					) , array(
						'User.id' => $wonderspree['WonderSpree']['user_id']
					));
					$this->WonderSpree->updateAll(array(
						'WonderSpree.is_active' => true,
					) , array(
						'WonderSpree.id' => $id
					));
					$this->_sendWonderspreeMail($wonderspree['WonderSpree']['user_id'], $wonderspree['User']['email'], $wonderspree['User']['username']);
					$this->Session->setFlash(__l('WonderPoint has been added successfully') , 'default', null, 'success');
					$this->redirect(array(
						'controller' => 'wonder_sprees',
						'action' => 'index'
					));
					}else
					{
					    $this->Session->setFlash(__l('Enter Integer value') , 'default', null, 'error');
					}
					
                } else {
					$this->Session->setFlash(__l('WonderPoint could not be added. Please, try again.') , 'default', null, 'error');
				}
			} else {
            $this->request->data['User']['id'] = $id;
        }
        $this->set('user', $user);
		
    }
	
	public function _sendWonderspreeMail($user_id, $user_email, $username)
    {
        //$this->loadModel('EmailTemplate');
		$this->loadModel('EmailTemplate');
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.email' => $user_email
            ) ,
            'recursive' => 1
        ));
		$email = $this->EmailTemplate->selectTemplate('Wonderpoint add');
        $emailFindReplace = array(
            '##SITE_LINK##' => Router::url('/', true) ,
            '##SITE_NAME##' => Configure::read('site.name') ,
            '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']) ,
            '##USERNAME##' => $username,
            '##SITE_LOGO##' => Router::url(array(
                'controller' => 'img',
                'action' => 'blue-theme',
                'logo-email.png',
                'admin' => false
            ) , true) ,
        );
        $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
        $this->Email->replyTo = ($email['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $email['reply_to'];
        $this->Email->to = $user_email;
        $this->Email->subject = strtr($email['subject'], $emailFindReplace);
        $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
        $this->Email->send(strtr($email['email_content'], $emailFindReplace));
    }
	
	public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->WonderSpree->id = $id;
        if (!$this->WonderSpree->exists()) {
            throw new NotFoundException(__l('Invalid wonder spree'));
        }
        if ($this->WonderSpree->delete()) {
            $this->Session->setFlash(__l('Wonder spree deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->Session->setFlash(__l('Wonder spree was not deleted') , 'default', null, 'error');
        $this->redirect(array(
            'action' => 'index'
        ));
    }
}
