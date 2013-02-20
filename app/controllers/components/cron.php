<?php
class CronComponent extends Component
{
    var $controller;
    public function update_package()
    {
        App::import('Model', 'User');
        $this->User = new  User();
		App::import('Model', 'GiftUser');
        $this->GiftUser = new  GiftUser();
        App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        require_once (LIBS . 'router.php');
		/* Lock the user status */
       	$this->User->updateAll(array(
            'User.is_verified_user' => 0
        ) , array(
            'User.is_verified_user'=> 1,
			'User.subscription_expire_date <' => _formatDate('Y-m-d', date('Y-m-d') , true) 
        ));
		/* Send a remainder mail to user */
		$this->User->_sendReminderMail();
		$this->GiftUser->_sendWelcomeMailToGiftUser();
    }

}
?>