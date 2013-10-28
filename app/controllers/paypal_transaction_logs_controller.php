<?php
class PaypalTransactionLogsController extends AppController
{
    public $name = 'PaypalTransactionLogs';
    public function admin_index()
    {
        $this->pageTitle = __l('Paypal Transaction Logs');
		$this->PaypalTransactionLog->recursive = 0;
        $this->paginate = array(
            'order' => array(
                'PaypalTransactionLog.id' => 'DESC'
            )
        );
        $this->set('paypalTransactionLogs', $this->paginate());
    }
    public function admin_view($id = null)
    {
        $this->pageTitle = __l('Paypal Transaction Log');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $paypalTransactionLog = $this->PaypalTransactionLog->find('first', array(
            'conditions' => array(
                'PaypalTransactionLog.id = ' => $id
            ) ,
            'recursive' => 0,
        ));
        if (empty($paypalTransactionLog)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $paypalTransactionLog['PaypalTransactionLog']['id'];
        $this->set('paypalTransactionLog', $paypalTransactionLog);
    }
}
?>