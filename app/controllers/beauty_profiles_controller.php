<?php
class BeautyProfilesController extends AppController
{
    public $name = 'BeautyProfiles';
	public $disabledFields = array(
        'OtherVariable',
    );
    public function beforeFilter()
    {
        $this->Security->enabled = false; 
		$this->Security->validatePost = false; 	
        parent::beforeFilter();
    }
    public function index()
    {
        $this->pageTitle = __l('beautyProfiles');
        $this->BeautyProfile->recursive = 0;
        $this->set('beautyProfiles', $this->paginate());
    }

	public function my_beauty_profile(){

	}
    public function add()
    {
        $this->pageTitle = __l('Add Beauty Profile');
        if ($this->request->is('post')) {
			if(!empty($this->request->data['BeautyProfile'])){
			   $user_id = $this->Auth->user('id');
			   $this->BeautyProfile->deleteAll(array(
                        'BeautyProfile.user_id' => $user_id
                    ));
			  	foreach($this->request->data['BeautyProfile'] as $key =>$beautyProfile){
						if(($beautyProfile['beauty_question_id'] == 27 && $this->request->data['BeautyProfile'][25]['answer2'] == 1) || ($beautyProfile['beauty_question_id'] == 26 && $this->request->data['BeautyProfile'][25]['answer2'] == 1) || ($beautyProfile['beauty_question_id'] == 29 && $this->request->data['BeautyProfile'][28]['answer2'] == 1) || ($beautyProfile['beauty_question_id'] == 30 && $this->request->data['BeautyProfile'][28]['answer2'] == 1) || ($beautyProfile['beauty_question_id'] == 24 && ($this->request->data['BeautyProfile'][15]['answer3'] == 1||$this->request->data['BeautyProfile'][15]['answer4'] == 1||$this->request->data['BeautyProfile'][15]['answer5'] == 1))||($beautyProfile['beauty_question_id'] == 31 && ($this->request->data['BeautyProfile'][15]['answer3'] == 1||$this->request->data['BeautyProfile'][15]['answer4'] == 1||$this->request->data['BeautyProfile'][15]['answer5'] == 1))) {
							
						}else{
							$this->BeautyProfile->create();
							$beautyResult = array();
							$beautyResult['BeautyProfile']['user_id'] = $user_id;
							foreach($beautyProfile as $keyAnswer=>$beautyAnswer){
								$beautyResult['BeautyProfile'][$keyAnswer] = $beautyAnswer;
							}
							$this->BeautyProfile->save($beautyResult,false);
					
						}
				}
			}
			$this->BeautyProfile->User->updateAll(array(
                'User.is_beauty_survery' => 1,
            ) , array(
                'User.id' => $this->Auth->user('id') ,
            ));
			echo "Success";
			exit;
        }
        $beautyQuestions = $this->BeautyProfile->BeautyQuestion->find('list');
        $this->set(compact('beautyQuestions'));
    }
  
	public function quiz(){

	}
	
}
