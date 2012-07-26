<?php
class HomePageBannersController extends AppController
{
    public $name = 'HomePageBanners';
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment.filename',
        );
        parent::beforeFilter();
    }

    public function index()
    {
        $this->pageTitle = __l('homePageBanners');
        $this->HomePageBanner->recursive = 0;
		$this->paginate = array(
            'conditions' => array(
                'HomePageBanner.is_active' => 1
            )
        );
        $this->set('homePageBanners', $this->paginate());
    }
    public function admin_index()
    {
        $this->pageTitle = __l('homePageBanners');
        $this->HomePageBanner->recursive = 0;
		$this->paginate = array(
            'order' => array(
                'HomePageBanner.id' => 'desc'
            )
        );
        $this->set('homePageBanners', $this->paginate());
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Home Page Banner');
	    $this->HomePageBanner->Attachment->Behaviors->attach('ImageUpload', Configure::read('avatar.file'));
        if (!empty($this->request->data)) {
			 if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
            }
            if (!empty($this->request->data['Attachment']['filename']['name'])) {
                  $this->HomePageBanner->Attachment->set($this->request->data);
            }
		    $this->HomePageBanner->set($this->request->data);
			 $ini_upload_error = 1;
            if (!empty($this->request->data['Attachment']['filename']) && $this->request->data['Attachment']['filename']['error'] == 1) {
                $ini_upload_error = 0;
            }
			if (empty($this->request->data['Attachment']['filename']['name'])) {
			        $ini_upload_error = 0;
					$this->HomePageBanner->Attachment->validationErrors['filename'] = __l('Required');
            }
			if($this->HomePageBanner->validates()&& $ini_upload_error){
            $this->HomePageBanner->create();
            if ($this->HomePageBanner->save($this->request->data)) {
				  if (!empty($this->request->data['Attachment']['filename']['name'])) {
                        $this->HomePageBanner->Attachment->create();
                        $this->request->data['Attachment']['class'] = 'HomePageBanner';
                        $this->request->data['Attachment']['foreign_id'] = $this->HomePageBanner->id;
                        $this->HomePageBanner->Attachment->save($this->request->data['Attachment']);
                }
				$this->Session->setFlash(__l('Home page banner has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
			}
			 else {
                if (!empty($this->request->data['Attachment']['filename']) && $this->request->data['Attachment']['filename']['error'] == 1) {
                    $this->HomePageBanner->Attachment->validationErrors['filename'] = sprintf(__l('The file uploaded is too big, only files less than %s permitted') , ini_get('upload_max_filesize'));
                }
                $this->Session->setFlash(__l('Home page banner could not be updated. Please, try again.') , 'default', null, 'error');
            }
			
            } else {
                $this->Session->setFlash(__l('Home page banner could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
		
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Home Page Banner');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->HomePageBanner->id = $id;
        if (!$this->HomePageBanner->exists()) {
            throw new NotFoundException(__l('Invalid home page banner'));
        }
         if (!empty($this->request->data)) {
			 if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->HomePageBanner->Attachment->Behaviors->attach('ImageUpload', Configure::read('image.file'));
            }
            if (!empty($this->request->data['Attachment']['id'])) {
                $this->HomePageBanner->Attachment->delete($this->request->data['Attachment']['id']);
            }
            if (!empty($this->request->data['Attachment']['filename']['name'])) {
                $this->request->data['Attachment']['filename']['type'] = get_mime($this->request->data['Attachment']['filename']['tmp_name']);
            }
            if (!empty($this->request->data['Attachment']['filename']['name']) || (!Configure::read('image.file.allowEmpty') && empty($this->request->data['Attachment']['id']))) {
                $this->request->data['Attachment']['class'] = 'HomePageBanner';
                $this->HomePageBanner->Attachment->create();
                $this->HomePageBanner->Attachment->set($this->request->data);
            }
            $this->HomePageBanner->set($this->request->data);
			 $ini_upload_error = 1;
            if ($this->request->data['Attachment']['filename']['error'] == 1) {
                $ini_upload_error = 0;
            }
			if ($this->HomePageBanner->validates() && (empty($this->request->data['Attachment']['filename']['name']) || $this->HomePageBanner->Attachment->validates()) && $ini_upload_error) {
	        if ($this->HomePageBanner->save($this->request->data)) {
				  $id = $foreign_id = $this->request->data['HomePageBanner']['id'];
					$attach = $this->HomePageBanner->Attachment->find('first', array(
						'conditions' => array(
							'Attachment.foreign_id = ' => $foreign_id,
							'Attachment.class = ' => 'HomePageBanner'
						) ,
						'fields' => array(
							'Attachment.id'
						) ,
						'recursive' => - 1,
					));
				    if (!(empty($this->request->data['Attachment']['filename']['name']))) {
			        $this->HomePageBanner->Attachment->delete($attach['Attachment']['id']);
				    $this->HomePageBanner->Attachment->create();
                    $this->request->data['Attachment']['class'] = 'HomePageBanner';
                    $this->request->data['Attachment']['description'] = 'Home page banner Image';
                    $this->request->data['Attachment']['foreign_id'] = $this->request->data['HomePageBanner']['id'];
                    $data['Attachment']['filename'] = $this->request->data['Attachment']['filename'];
                    $this->HomePageBanner->Attachment->Behaviors->attach('ImageUpload', Configure::read('image.file'));
                    $this->HomePageBanner->Attachment->save($this->request->data['Attachment']);
                  }
                $this->Session->setFlash(__l('Home page banner has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Home page banner could not be updated. Please, try again.') , 'default', null, 'error');
            }
			}
        } else {
            $this->data = $this->HomePageBanner->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }  
		 $this->pageTitle.= ' - ' . $this->data['HomePageBanner']['title'];
    }
   public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->HomePageBanner->delete($id)) {
            $this->Session->setFlash(__l('Home page banner deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
