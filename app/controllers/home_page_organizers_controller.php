<?php
class HomePageOrganizersController extends AppController
{
    public $name = 'HomePageOrganizers';
	public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment.filename',
        );
        parent::beforeFilter();
    }
    public function index()
    {
        $this->pageTitle = __l('homePageOrganizers');
        $this->HomePageOrganizer->recursive = 0;
		       $this->paginate = array(
			 'conditions' => array(
                'HomePageOrganizer.is_active' => 1
			  ),
            'limit' => 1,
        );
        $this->set('homePageOrganizers', $this->paginate());
    }
    public function admin_index()
    {
        $this->pageTitle = __l('homePageOrganizers');
        $this->HomePageOrganizer->recursive = 0;
		$this->paginate = array(
            'order' => array(
                'HomePageOrganizer.id' => 'desc'
            )
        );
        $this->set('homePageOrganizers', $this->paginate());
    }
    
    public function admin_add()
    {
        $this->pageTitle = __l('Add Home page organizer');
	    $this->HomePageOrganizer->Attachment->Behaviors->attach('ImageUpload', Configure::read('avatar.file'));
        if (!empty($this->request->data)) {
			 if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
            }
            if (!empty($this->request->data['Attachment']['filename']['name'])) {
                  $this->HomePageOrganizer->Attachment->set($this->request->data);
            }
		    $this->HomePageOrganizer->set($this->request->data);
			 $ini_upload_error = 1;
            if (!empty($this->request->data['Attachment']['filename']) && $this->request->data['Attachment']['filename']['error'] == 1) {
                $ini_upload_error = 0;
            }
			if (empty($this->request->data['Attachment']['filename']['name'])) {
			        $ini_upload_error = 0;
					$this->HomePageOrganizer->Attachment->validationErrors['filename'] = __l('Required');
            }
			if($this->HomePageOrganizer->validates()&& $ini_upload_error){
            $this->HomePageOrganizer->create();
            if ($this->HomePageOrganizer->save($this->request->data)) {
				  if (!empty($this->request->data['Attachment']['filename']['name'])) {
                        $this->HomePageOrganizer->Attachment->create();
                        $this->request->data['Attachment']['class'] = 'HomePageOrganizer';
                        $this->request->data['Attachment']['foreign_id'] = $this->HomePageOrganizer->id;
                        $this->HomePageOrganizer->Attachment->save($this->request->data['Attachment']);
                }
				$this->Session->setFlash(__l('Home page organizer has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
			}
			 else {
                if (!empty($this->request->data['Attachment']['filename']) && $this->request->data['Attachment']['filename']['error'] == 1) {
                    $this->HomePageOrganizer->Attachment->validationErrors['filename'] = sprintf(__l('The file uploaded is too big, only files less than %s permitted') , ini_get('upload_max_filesize'));
                }
                $this->Session->setFlash(__l('Home page organizer could not be updated. Please, try again.') , 'default', null, 'error');
            }
			
            } else {
                $this->Session->setFlash(__l('Home page organizer could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
		
    }	
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Home Page organizer');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->HomePageOrganizer->id = $id;
        if (!$this->HomePageOrganizer->exists()) {
            throw new NotFoundException(__l('Invalid home page organizer'));
        }
         if (!empty($this->request->data)) {
			 if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->HomePageOrganizer->Attachment->Behaviors->attach('ImageUpload', Configure::read('image.file'));
            }
            if (!empty($this->request->data['Attachment']['id'])) {
                $this->HomePageOrganizer->Attachment->delete($this->request->data['Attachment']['id']);
            }
            if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
            }
            if (!empty($this->request->data['Attachment']['filename']['name']) || (!Configure::read('image.file.allowEmpty') && empty($this->request->data['Attachment']['id']))) {
                $this->request->data['Attachment']['class'] = 'HomePageOrganizer';
                $this->HomePageOrganizer->Attachment->create();
                $this->HomePageOrganizer->Attachment->set($this->request->data);
            }
            $this->HomePageOrganizer->set($this->request->data);
			 $ini_upload_error = 1;
            if ($this->request->data['Attachment']['filename']['error'] == 1) {
                $ini_upload_error = 0;
            }
			if ($this->HomePageOrganizer->validates() && (empty($this->request->data['Attachment']['filename']['name']) || $this->HomePageOrganizer->Attachment->validates()) && $ini_upload_error) {
	        if ($this->HomePageOrganizer->save($this->request->data)) {
				  $id = $foreign_id = $this->request->data['HomePageOrganizer']['id'];
					$attach = $this->HomePageOrganizer->Attachment->find('first', array(
						'conditions' => array(
							'Attachment.foreign_id = ' => $foreign_id,
							'Attachment.class = ' => 'HomePageOrganizer'
						) ,
						'fields' => array(
							'Attachment.id'
						) ,
						'recursive' => - 1,
					));
				    if (!(empty($this->request->data['Attachment']['filename']['name']))) {
			        $this->HomePageOrganizer->Attachment->delete($attach['Attachment']['id']);
				    $this->HomePageOrganizer->Attachment->create();
                    $this->request->data['Attachment']['class'] = 'HomePageOrganizer';
                    $this->request->data['Attachment']['description'] = 'Home page organizer Image';
                    $this->request->data['Attachment']['foreign_id'] = $this->request->data['HomePageOrganizer']['id'];
                    $data['Attachment']['filename'] = $this->request->data['Attachment']['filename'];
                    $this->HomePageOrganizer->Attachment->Behaviors->attach('ImageUpload', Configure::read('image.file'));
                    $this->HomePageOrganizer->Attachment->save($this->request->data['Attachment']);
                  }
                $this->Session->setFlash(__l('Home page organizer has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Home page organizer could not be updated. Please, try again.') , 'default', null, 'error');
            }
			}
        } else {
            $this->data = $this->HomePageOrganizer->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }  
		 $this->pageTitle.= ' - ' . $this->data['HomePageOrganizer']['title'];
    }
   public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->HomePageOrganizer->delete($id)) {
            $this->Session->setFlash(__l('Home page organizer deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
