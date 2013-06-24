<?php
class WonderTreatsController extends AppController
{
    public $name = 'WonderTreats';
    public function index()
    {
        $this->pageTitle = __l('wonderTreats');
        $this->WonderTreat->recursive = 0;
		$this->paginate = array(
				'conditions' => array(
					'WonderTreat.user_id'=> $this->Auth->user('id')
				),
				'fields' => array(
					'BeautyTip.id',
					'BeautyTip.name',
					'BeautyTip.redemption_start_date',
					'BeautyTip.redemption_end_date',
					'BeautyTip.purchase_amount',
					'WonderTreat.purchase_date',
				)
		);
        $this->set('wonderTreats', $this->paginate());
    }
    public function admin_index()
    {
        $this->pageTitle = __l('wonderTreats');
        $this->WonderTreat->recursive = 0;
		$this->paginate = array(
				'fields' => array(
					'BeautyTip.id',
					'BeautyTip.name',
					'BeautyTip.redemption_start_date',
					'BeautyTip.redemption_end_date',
					'BeautyTip.purchase_amount',
					'WonderTreat.purchase_date',
					'User.email',
				)
		);
        $this->set('wonderTreats', $this->paginate());
    }
  
}
