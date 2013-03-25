<?php
class TransactionsController extends AppController
{
    public $name = 'Transactions';
    public $permanentCacheAction = array(
        'index' => array(
            'is_user_specific_url' => true
        )
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Transaction.from_date',
            'Transaction.user_id',
            'Transaction.to_date'
        );
        parent::beforeFilter();
    }
    public function index()
    {
        $this->disableCache();
        $this->pageTitle = __l('Transactions');
        $conditions['Transaction.user_id'] = $this->Auth->user('id');
		$this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'TransactionType'=>array(
					'fields'=> array(
						'TransactionType.name',
						'TransactionType.message',
					)
				),
			   'Package'=> array(
					 'fields'=> array(
						'Package.name',
						'Package.description',
						'Package.cost',
						'Package.no_of_wonderpoints',
					)
				),
                'User' => array(
                    'UserAvatar',
                    'fields' => array(
                        'User.id',
                        'User.username',
                        'User.user_type_id',
                        'User.fb_user_id',
                    )
                ) ,
            ) ,
            'order' => array(
                'Transaction.id' => 'desc'
            ) ,
            'recursive' => 2
        );
	    $this->set('transactions', $this->paginate());
    }
    public function admin_index()
    {
        if ($this->RequestHandler->prefers('csv')) {
            Configure::write('debug', 0);
            $conditions = array();
            if (!empty($this->request->params['named']['hash'])) {
                $hash = $this->request->params['named']['hash'];
            }
            if (!empty($hash) && isset($_SESSION['export_transactions'][$hash])) {
                $ids = implode(',', $_SESSION['export_transactions'][$hash]);
                if ($this->Transaction->isValidIdHash($ids, $hash)) {
                    $conditions['Transaction.id'] = $_SESSION['export_transactions'][$hash];
                } else {
                    throw new NotFoundException(__l('Invalid request'));
                }
            }
            $this->set('TransactionObj', $this);
            $this->set('conditions', $conditions);
        } else {
            $this->pageTitle = __l('Transactions');
            if (!empty($this->request->params['named']['user_id'])) {
                $this->request->data['Transaction']['user_id'] = $this->request->params['named']['user_id'];
            }
            $conditions = array();
            if (empty($this->request->data['Transaction']['user_id']) && !empty($this->request->data['User']['username'])) {
                $user = $this->Transaction->User->find('first', array(
                    'conditions' => array(
                        'User.username' => $this->request->data['User']['username']
                    ) ,
                    'fields' => array(
                        'User.id'
                    ) ,
                    'recursive' => - 1
                ));
                if (!empty($user)) {
                    $this->request->data['Transaction']['user_id'] = $user['User']['id'];
                } else {
                    $this->request->data['Transaction']['user_id'] = null;
                }
            }
            if (!empty($this->request->data['Transaction']['user_id'])) {
                $this->request->params['named']['user_id'] = $this->request->data['Transaction']['user_id'];
                $users_info = $this->Transaction->User->find('first', array(
                    'conditions' => array(
                        'User.id' => $this->request->data['Transaction']['user_id']
                    ) ,
                    'fields' => array(
                        'User.username'
                    ) ,
                    'recursive' => - 1
                ));
                $this->request->data['Transaction']['user_id'] = $this->request->data['Transaction']['user_id'];
                $this->set('selected_user_info', !empty($users_info['User']['username']) ? ' - ' . $users_info['User']['username'] : '');
            }
            if (!empty($this->request->data['Transaction']['from_date']['year']) && !empty($this->request->data['Transaction']['from_date']['month']) && !empty($this->request->data['Transaction']['from_date']['day'])) {
                $this->request->params['named']['from_date'] = $this->request->data['Transaction']['from_date']['year'] . '-' . $this->request->data['Transaction']['from_date']['month'] . '-' . $this->request->data['Transaction']['from_date']['day'] . ' 00:00:00';
            }
            if (!empty($this->request->data['Transaction']['to_date']['year']) && !empty($this->request->data['Transaction']['to_date']['month']) && !empty($this->request->data['Transaction']['to_date']['day'])) {
                $this->request->params['named']['to_date'] = $this->request->data['Transaction']['to_date']['year'] . '-' . $this->request->data['Transaction']['to_date']['month'] . '-' . $this->request->data['Transaction']['to_date']['day'] . ' 23:59:59';
            }
            $param_string = '';
            $param_string.= !empty($this->request->params['named']['user_id']) ? '/user_id:' . $this->request->params['named']['user_id'] : $param_string;
            $param_string.= !empty($this->request->params['named']['from_date']) ? '/from_date:' . $this->request->params['named']['from_date'] : $param_string;
            $param_string.= !empty($this->request->params['named']['to_date']) ? '/to_date:' . $this->request->params['named']['to_date'] : $param_string;
            if (!empty($this->request->params['named']['user_id'])) {
                $conditions['Transaction.user_id'] = $this->request->params['named']['user_id'];
                $this->request->data['Transaction']['user_id'] = $this->request->params['named']['user_id'];
            }
            if (!empty($this->request->params['named']['type'])) {
                $conditions['Transaction.transaction_type_id'] = $this->request->params['named']['type'];
                $transaction_type = $this->Transaction->TransactionType->find('first', array(
                    'conditions' => array(
                        'TransactionType.id' => $this->request->params['named']['type']
                    ) ,
                    'fields' => array(
                        'TransactionType.name'
                    ) ,
                    'recursive' => - 1
                ));
                $this->pageTitle.= ' - ' . $transaction_type['TransactionType']['name'];
            }
            $this->paginate = array(
                'conditions' => $conditions,
                'contain' => array(
                    'TransactionType',
                    'User' => array(
                        'UserAvatar',
                        'fields' => array(
                            'User.id',
                            'User.username',
                            'User.user_type_id',
                            'User.fb_user_id',
                        )
                    ) ,
					'Package' => array(
						'PackageType'=> array(
							'fields'=> array(
								'PackageType.name'
							)
					 ),
					 'fields'=> array(
						'Package.name',
						'Package.description',
						'Package.cost',
						'Package.no_of_wonderpoints',
						'Package.package_type_id',
					)
				)   
                ) ,
                'order' => array(
                    'Transaction.id' => 'desc'
                ) ,
                'recursive' => 2
            );
         
        }
		$this->set('transactions', $this->paginate());
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Transaction->delete($id)) {
            $this->Session->setFlash(__l('Transaction deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>