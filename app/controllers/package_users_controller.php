<?php
class PackageUsersController extends AppController
{
    public $name = 'PackageUsers';
    public function index()
    {
        $this->pageTitle = __l('packageUsers');
		$this->paginate = array(
			'conditions'=> array(
				'PackageUser.user_id'=> $this->Auth->user('id')
			 ),
			'contain'=> array(
				'Package' => array(
					'PackageType' => array(
						'fields'=> array(
							'PackageType.name'
						)
					),
					'fields'=> array(
						'Package.name',
						'Package.package_type_id',
						'Package.cost'
					)
				)
			),
			'order'=>array(
				'PackageUser.id'=>'desc'
			)
		);
        $this->PackageUser->recursive = 0;
        $this->set('packageUsers', $this->paginate());
    }
    public function view($id = null)
    {
        $this->pageTitle = __1('Package User');
        $this->PackageUser->id = $id;
        if (!$this->PackageUser->exists()) {
            throw new NotFoundException(__l('Invalid package user'));
        }
        $packageUser = $this->PackageUser->find('first', array(
            'conditions' => array(
                'PackageUser.id = ' => $id
            ) ,
            'fields' => array(
                'PackageUser.id',
                'PackageUser.created',
                'PackageUser.modified',
                'PackageUser.user_id',
                'PackageUser.package_id',
                'PackageUser.start_date',
                'PackageUser.end_date',
                'PackageUser.is_paid',
                'User.id',
                'User.profile_image_id',
                'User.created',
                'User.modified',
                'User.user_type_id',
                'User.username',
                'User.email',
                'User.password',
                'User.referred_by_user_id',
                'User.fb_user_id',
                'User.user_login_count',
                'User.user_view_count',
                'User.cookie_hash',
                'User.cookie_time_modified',
                'User.is_agree_terms_conditions',
                'User.is_active',
                'User.is_email_confirmed',
                'User.is_verified_user',
                'User.signup_ip',
                'User.last_login_ip',
                'User.last_logged_in_time',
                'User.available_balance_amount',
                'User.blocked_amount',
                'User.is_facebook_register',
                'User.api_key',
                'User.api_token',
                'User.fb_access_token',
                'User.dns',
                'Package.id',
                'Package.created',
                'Package.modified',
                'Package.name',
                'Package.slug',
                'Package.description',
                'Package.package_type_id',
                'Package.cost',
                'Package.no_of_wonderpoints',
                'Package.is_active',
            ) ,
            'recursive' => 0,
        ));
        if (empty($packageUser)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $packageUser['PackageUser']['id'];
        $this->set('packageUser', $packageUser);
    }
    public function add()
    {
        $this->pageTitle = __1('Add Package User');
        if ($this->request->is('post')) {
            $this->PackageUser->create();
            if ($this->PackageUser->save($this->request->data)) {
                $this->Session->setFlash(__l('package user has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('package user could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $users = $this->PackageUser->User->find('list');
        $packages = $this->PackageUser->Package->find('list');
        $this->set(compact('users', 'packages'));
    }
    public function edit($id = null)
    {
        $this->pageTitle = __1('Edit Package User');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->PackageUser->id = $id;
        if (!$this->PackageUser->exists()) {
            throw new NotFoundException(__l('Invalid package user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->PackageUser->save($this->request->data)) {
                $this->Session->setFlash(__l('package user has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('package user could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->PackageUser->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['PackageUser']['id'];
        $users = $this->PackageUser->User->find('list');
        $packages = $this->PackageUser->Package->find('list');
        $this->set(compact('users', 'packages'));
    }
    public function delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->PackageUser->id = $id;
        if (!$this->PackageUser->exists()) {
            throw new NotFoundException(__l('Invalid package user'));
        }
        if ($this->PackageUser->delete()) {
            $this->Session->setFlash(__l('Package user deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->Session->setFlash(__l('Package user was not deleted') , 'default', null, 'error');
        $this->redirect(array(
            'action' => 'index'
        ));
    }
    public function admin_index()
    {
        $this->pageTitle = __l('packageUsers');
        $this->PackageUser->recursive = 0;
        $this->set('packageUsers', $this->paginate());
    }
    public function admin_view($id = null)
    {
        $this->pageTitle = __1('Package User');
        $this->PackageUser->id = $id;
        if (!$this->PackageUser->exists()) {
            throw new NotFoundException(__l('Invalid package user'));
        }
        $packageUser = $this->PackageUser->find('first', array(
            'conditions' => array(
                'PackageUser.id = ' => $id
            ) ,
            'fields' => array(
                'PackageUser.id',
                'PackageUser.created',
                'PackageUser.modified',
                'PackageUser.user_id',
                'PackageUser.package_id',
                'PackageUser.start_date',
                'PackageUser.end_date',
                'PackageUser.is_paid',
                'User.id',
                'User.profile_image_id',
                'User.created',
                'User.modified',
                'User.user_type_id',
                'User.username',
                'User.email',
                'User.password',
                'User.referred_by_user_id',
                'User.fb_user_id',
                'User.user_login_count',
                'User.user_view_count',
                'User.cookie_hash',
                'User.cookie_time_modified',
                'User.is_agree_terms_conditions',
                'User.is_active',
                'User.is_email_confirmed',
                'User.is_verified_user',
                'User.signup_ip',
                'User.last_login_ip',
                'User.last_logged_in_time',
                'User.available_balance_amount',
                'User.blocked_amount',
                'User.is_facebook_register',
                'User.api_key',
                'User.api_token',
                'User.fb_access_token',
                'User.dns',
                'Package.id',
                'Package.created',
                'Package.modified',
                'Package.name',
                'Package.slug',
                'Package.description',
                'Package.package_type_id',
                'Package.cost',
                'Package.no_of_wonderpoints',
                'Package.is_active',
            ) ,
            'recursive' => 0,
        ));
        if (empty($packageUser)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $packageUser['PackageUser']['id'];
        $this->set('packageUser', $packageUser);
    }
    public function admin_add()
    {
        $this->pageTitle = __1('Add Package User');
        if ($this->request->is('post')) {
            $this->PackageUser->create();
            if ($this->PackageUser->save($this->request->data)) {
                $this->Session->setFlash(__l('package user has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('package user could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $users = $this->PackageUser->User->find('list');
        $packages = $this->PackageUser->Package->find('list');
        $this->set(compact('users', 'packages'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __1('Edit Package User');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->PackageUser->id = $id;
        if (!$this->PackageUser->exists()) {
            throw new NotFoundException(__l('Invalid package user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->PackageUser->save($this->request->data)) {
                $this->Session->setFlash(__l('package user has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('package user could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->PackageUser->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['PackageUser']['id'];
        $users = $this->PackageUser->User->find('list');
        $packages = $this->PackageUser->Package->find('list');
        $this->set(compact('users', 'packages'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->PackageUser->id = $id;
        if (!$this->PackageUser->exists()) {
            throw new NotFoundException(__l('Invalid package user'));
        }
        if ($this->PackageUser->delete()) {
            $this->Session->setFlash(__l('Package user deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->Session->setFlash(__l('Package user was not deleted') , 'default', null, 'error');
        $this->redirect(array(
            'action' => 'index'
        ));
    }
}
