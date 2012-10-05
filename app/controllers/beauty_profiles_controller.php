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
						$this->BeautyProfile->create();
						$beautyResult = array();
						$beautyResult['BeautyProfile']['user_id'] = $user_id;
						foreach($beautyProfile as $keyAnswer=>$beautyAnswer){
							$beautyResult['BeautyProfile'][$keyAnswer] = $beautyAnswer;
						}
					$this->BeautyProfile->save($beautyResult,false);
				}
			}
			echo "Success";
			exit;
        }
        $beautyQuestions = $this->BeautyProfile->BeautyQuestion->find('list');
        $this->set(compact('beautyQuestions'));
    }
  
	function quiz(){

	}
}
