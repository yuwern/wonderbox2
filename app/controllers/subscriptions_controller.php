<?php
class SubscriptionsController extends AppController
{
    public $name = 'Subscriptions';
    public $uses = array(
        'Subscription',
        'User',
    );
    public $permanentCacheAction = array(
        'add' => array(
            'is_public_url' => true,
            'is_user_specific_url' => true,
        )
    );
    public function beforeFilter()
    {
        if (!$this->User->isAllowed($this->Auth->user('user_type_id'))) {
            throw new NotFoundException(__l('Invalid request'));
        }
        parent::beforeFilter();
    }
    public function add()
    {        
		$this->pageTitle = __l('Add Subscription');
       
        if (!empty($this->request->data)) {
            $subscription = $this->Subscription->find('first', array(
                'conditions' => array(
                    'Subscription.email' => $this->request->data['Subscription']['email'],
                    ) ,
                'fields' => array(
                    'Subscription.id',
                    'Subscription.is_subscribed'
                ) ,
                'recursive' => - 1
            ));
            $this->request->data['Subscription']['user_id'] = $this->Auth->user('id');
            if (empty($subscription)) {
                $this->Subscription->create();
                if ($this->Subscription->save($this->request->data)) { 
                    $this->loadModel('EmailTemplate');
                    $this->EmailTemplate = new EmailTemplate();
                    App::import('Core', 'ComponentCollection');
                    $collection = new ComponentCollection();
                    App::import('Component', 'Email');
                    $this->Email = new EmailComponent($collection);
                    $language_code = $this->Subscription->getUserLanguageIso($this->Auth->user('id'));
                    $template = $this->EmailTemplate->selectTemplate('Subscription Welcome Mail', $language_code);
                    $emailFindReplace = array(
                        '##FROM_EMAIL##' => $this->Subscription->changeFromEmail(Configure::read('EmailTemplate.from_email')) ,
                        '##SITE_LINK##' => Router::url('/', true) ,
                        '##SITE_NAME##' => Configure::read('site.name') ,
                        '##FROM_EMAIL##' => ($template['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $template['from'],
                        '##LEARN_HOW_LINK##' => Router::url(array(
                            'controller' => 'pages',
                            'action' => 'view',
                            'whitelist'
                        ) , true) ,
                        '##CONTACT_US_LINK##' => Router::url(array(
                            'controller' => 'contacts',
                            'action' => 'add',
                            'admin' => false
                        ) , true) ,
                        '##SITE_LOGO##' => Router::url(array(
                            'controller' => 'img',
                            'action' => 'blue-theme',
                            'logo-email.png',
                            'admin' => false
                        ) , true) ,
                        '##UNSUBSCRIBE_LINK##' => Router::url(array(
                            'controller' => 'subscriptions',
                            'action' => 'unsubscribe',
							 $this->Subscription->getLastInsertId() ,
                            'admin' => false
                        ) , true) ,
                        '##CONTACT_URL##' => Router::url(array(
                            'controller' => 'contacts',
                            'action' => 'add',
                            'admin' => false
                        ) , true) ,
                    );
                    $this->Email->from = ($template['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $template['from'];
                    $this->Email->replyTo = ($template['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to_email') : $template['reply_to'];
                    $this->Email->to = $this->request->data['Subscription']['email'];
                    $this->Email->subject = strtr($template['subject'], $emailFindReplace);
                    $this->Email->content = strtr($template['email_content'], $emailFindReplace);
                    $this->Email->sendAs = ($template['is_html']) ? 'html' : 'text';
                    $this->Email->send($this->Email->content);
                    $this->Session->setFlash(__l('You are now subscribed to') . ' ' . Configure::read('site.name') . '.', 'default', null, 'success');
					$this->redirect(array(
							  'action' => 'thanks'
					));
                } else {
                        $this->Session->setFlash(__l('Could not be subscribed. Please, try again.') , 'default', null, 'error');
                               }
            } else {
                $this->Session->setFlash(__l('You\'ll start receiving your emails soon.') , 'default', null, 'success');
            }
        } 
    }

 
    public function admin_index()
    {
        $this->_redirectGET2Named(array(
            'q'
        ));
        $this->pageTitle = __l('Subscriptions');
        $conditions = array();
        $param_string = '';
        $param_string.= !empty($this->request->params['named']['type']) ? '/type:' . $this->request->params['named']['type'] : $param_string;
        if (!empty($this->request->data['Subscription']['type'])) {
            $this->request->params['named']['type'] = $this->request->data['Subscription']['type'];
        }
        if (empty($this->request->data['Subscription']['q']) && !empty($this->request->params['named']['q'])) {
            $this->request->data['Subscription']['q'] = $this->request->params['named']['q'];
        }
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'subscribed') {
            $this->request->data['Subscription']['type'] = $this->request->params['named']['type'];
            $conditions['Subscription.is_subscribed'] = 1;
            $this->pageTitle = __l('Subscribed Users');
        } elseif (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'unsubscribed') {
            $this->request->data['Subscription']['type'] = $this->request->params['named']['type'];
            $conditions['Subscription.is_subscribed'] = 0;
            $this->pageTitle = __l('Unsubscribed Users');
        }
        if (isset($this->request->data['Subscription']['q']) && !empty($this->request->data['Subscription']['q'])) {
            $this->request->params['named']['q'] = $this->request->data['Subscription']['q'];
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->data['Subscription']['q']);
        }
      
        if ($this->RequestHandler->prefers('csv')) {
            Configure::write('debug', 0);
            $this->set('SubscriptionObj', $this);
            $this->set('conditions', $conditions);
            if (isset($this->request->params['named']['q'])) {
                $this->set('q', $this->request->params['named']['q']);
            }
            $this->set('contain', $contain);
        } else {
            $this->Subscription->recursive = 0;
            $this->paginate = array(
                'conditions' => $conditions,
                'contain' => array(
                    'User' => array(
                        'fields' => array(
                            'User.email',
                            'User.id',
                            'User.username',
                        ) ,
                    ) ,
                  
                ) ,
                'recursive' => 1,
                'order' => array(
                    'Subscription.id' => 'desc'
                ) ,
            );
            $export_subscriptions = $this->Subscription->find('all', array(
                'conditions' => $conditions,
                'recursive' => - 1
            ));
            if (!empty($export_subscriptions)) {
                $ids = array();
                foreach($export_subscriptions as $export_subscription) {
                    $ids[] = $export_subscription['Subscription']['id'];
                }
                $hash = $this->Subscription->getIdHash(implode(',', $ids));
                $_SESSION['export_subscriptions'][$hash] = $ids;
                $this->set('export_hash', $hash);
            }
            if (!empty($this->request->data['Subscription']['q'])) {
                $this->paginate = array_merge($this->paginate, array(
                    'search' => $this->request->params['named']['q']
                ));
            }
            $this->set('subscriptions', $this->paginate());
            // Citywise admin filter //
           
            $this->set('subscribed', $this->Subscription->find('count', array(
                'conditions' => array(
                    'Subscription.is_subscribed' => 1,
                )  ,
                'recursive' => 0
            )));
            $this->set('unsubscribed', $this->Subscription->find('count', array(
                'conditions' => array(
                    'Subscription.is_subscribed' => 0,
                )  ,
                'recursive' => 0
            )));
            $this->set('pageTitle', $this->pageTitle);
            $moreActions = $this->Subscription->moreActions;
            if (!empty($this->request->params['named']['type']) && ($this->request->params['named']['type'] == 'unsubscribed')) {
                unset($moreActions[ConstMoreAction::UnSubscripe]);
            }
            $this->set(compact('moreActions'));
            $this->set('param_string', $param_string);
        }
    }
    public function admin_update()
    {
        $this->autoRender = false;
        if (!empty($this->request->data['Subscription'])) {
            $r = $this->request->data[$this->modelClass]['r'];
            $actionid = $this->request->data[$this->modelClass]['more_action_id'];
            unset($this->request->data[$this->modelClass]['r']);
            unset($this->request->data[$this->modelClass]['more_action_id']);
            $userIds = array();
            foreach($this->request->data['Subscription'] as $subscription_id => $is_checked) {
                if ($is_checked['id']) {
                    $subscriptionIds[] = $subscription_id;
                }
            }
            if ($actionid && !empty($subscriptionIds)) {
                if ($actionid == ConstMoreAction::Delete) {
                    $this->Subscription->deleteAll(array(
                        'Subscription.id' => $subscriptionIds
                    ));
                    $this->Session->setFlash(__l('Checked subscriptions has been deleted') , 'default', null, 'success');
                } else if ($actionid == ConstMoreAction::UnSubscripe) {
                    $this->Subscription->updateAll(array(
                        'Subscription.is_subscribed' => 0,
                    ) , array(
                        'Subscription.id' => $subscriptionIds
                    ));
                    $this->Session->setFlash(__l('Checked subscriptions has been un subscribed') , 'default', null, 'success');
                }
            }
        }
        if (!$this->RequestHandler->isAjax()) {
            $this->redirect(Router::url('/', true) . $r);
        } else {
            $this->redirect($r);
        }
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Subscription->delete($id)) {
            $this->Session->setFlash(__l('Subscription deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function how_it_work(){
        $this->layout='littleblackbox';
    }
    public function littleblackbox(){
        $this->layout='littleblackbox';
        
    }
}
?>
