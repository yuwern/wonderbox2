<?php
class BeautyQuestionsController extends AppController

{
    public $name = 'BeautyQuestions';
	 public $disabledFields = array(
        'BeautyQuestion.question_id1',
		'BeautyQuestion.sub_question_id1',
		'BeautyQuestion.answer1',
    );

    public function beforeFilter()
    {
        $this->Security->disabledFields = $this->disabledFields;
        parent::beforeFilter();
		$this->Security->validatePost = false; 
        $this->disableCache();
    }
    public function admin_index()
    {
        $this->pageTitle = __l('beautyQuestions');
        $this->BeautyQuestion->recursive = 0;
        $this->set('beautyQuestions', $this->paginate());
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Beauty Question');
        if ($this->request->is('post')) {
            $this->BeautyQuestion->create();
            if ($this->BeautyQuestion->save($this->request->data)) {
                $this->Session->setFlash(__l('beauty question has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('beauty question could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $beautyCategories = $this->BeautyQuestion->BeautyCategory->find('list');
        $this->set(compact('beautyCategories'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Beauty Question');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->BeautyQuestion->id = $id;
        if (!$this->BeautyQuestion->exists()) {
            throw new NotFoundException(__l('Invalid beauty question'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->BeautyQuestion->save($this->request->data)) {
                $this->Session->setFlash(__l('beauty question has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('beauty question could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->BeautyQuestion->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['BeautyQuestion']['name'];
        $beautyCategories = $this->BeautyQuestion->BeautyCategory->find('list');
        $this->set(compact('beautyCategories'));
    }
	public function admin_chart()
    {
        $this->pageTitle = __l('beautyProfiles');
        $this->BeautyQuestion->recursive = 0;
		$this->paginate = array(
					'fields'=> array(
						'BeautyQuestion.id',
						'BeautyQuestion.name',
					)
			);
	    $this->set('beautyQuestions', $this->paginate());
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->BeautyQuestion->id = $id;
        if (!$this->BeautyQuestion->exists()) {
            throw new NotFoundException(__l('Invalid beauty question'));
        }
        if ($this->BeautyQuestion->delete()) {
            $this->Session->setFlash(__l('Beauty question deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->Session->setFlash(__l('Beauty question was not deleted') , 'default', null, 'error');
        $this->redirect(array(
            'action' => 'index'
        ));
    }
	public function lists($suvery_type_id = ''){
		$conditions['BeautyQuestion.survey_type_id'] = $suvery_type_id;
		$this->set('beautyQuestions',$this->BeautyQuestion->find('list',array(
												'conditions' => $conditions
		)));
	}
	public function answers($question_id = 1,$answer_no = 0){
	    $conditions['BeautyAnswer.beauty_question_id'] = $question_id;
		$responses[0] = __l('All');
		$answers = $this->BeautyQuestion->BeautyAnswer->find('list',array(
												'conditions' => $conditions,
												'fields' => array(
													'BeautyAnswer.id',
													'BeautyAnswer.answer',
												)
		));
		$i = 1;
		foreach($answers as $key => $value){
				$responses[$i.'-'.$key] = $value;
				$i++;
		}
		
		//$this->set('sub_question',$responses);
		$this->set('answers',$responses);
		$this->set('answer_no',$answer_no);
		$this->set('question_id',$question_id);
	}
	
	
	/*public function answers1($sub_question_id = 1,$answer_no = 0){
	     
		/*$conditions['BeautyAnswer.beauty_question_id'] = $question_id;
		$responses[0] = __l('All');
		$answers = $this->BeautyQuestion->BeautyAnswer->find('list',array(
												'conditions' => $conditions,
												'fields' => array(
													'BeautyAnswer.id',
													'BeautyAnswer.answer',
												)
		));
		$i = 1;
		foreach($answers as $key => $value){
				$responses[$i.'-'.$key] = $value;
				$i++;
		}*/
		/*$sub_answer = array('aaa','bbb','ccc');
		$j = 1;
		foreach($sub_answer as $key => $value){
				$responses[$j.'-'.$key] = $value;
				$j++;
		}
	    $this->set('answers',$responses);
		$this->set('answer_no',$answer_no);
	}*/
	public function product_answers($question_id = 1){
		$conditions['BeautyAnswer.beauty_question_id'] = $question_id;
		$responses[0] = __l('All');
		$answers = $this->BeautyQuestion->BeautyAnswer->find('list',array(
												'conditions' => $conditions,
												'fields' => array(
													'BeautyAnswer.id',
													'BeautyAnswer.answer',
												)
		));
		$i = 1;
		foreach($answers as $key => $value){
				$responses[$i.'-'.$key] = $value;
				$i++;
		}
		//$this->set('answers',$responses);
	}
	public function admin_reports(){
		$answers  = array();
		$beautyAnswers = array();
		if(!empty($this->request->data)){

		if(!empty($this->request->data['BeautyQuestion']['product_question_id'])) {
			$productAnswerConditions = array();
			$productuserCountConditions = array();
			if(!empty($this->request->data['BeautyQuestion']['product_answer'][0])){
					$data = explode('-',$this->request->data['BeautyQuestion']['product_answer']);
					$answer_no_order = $data[0];
					$productAnswerConditions['BeautyAnswer.id'] = $data[1];
					$productuserCountConditions['ProductSurvey.beauty_question_id'] = $this->request->data['BeautyQuestion']['product_question_id'];
					$productuserCountConditions["ProductSurvey.answer$answer_no_order"] = 1;
//					$this->set('answer_no_order',$answer_no_order);
			}else{
					$productuserCountConditions['ProductSurvey.beauty_question_id'] = $this->request->data['BeautyQuestion']['product_question_id'];
//					$this->set('answer_no_order',0);
			}
			$beautyAnswerConditions = array();
			$userCountConditions = array();
				if(!empty($this->request->data['BeautyQuestion']['answer'][0])){
					$data = array();
					foreach($this->request->data['BeautyQuestion']['answer'] as $answer){
						$choiceanswers = explode('-',$answer);
						$data[] = $choiceanswers[0];
						$userCountConditions['OR']["BeautyProfile.answer$choiceanswers[0]"] = 1;
					}
					$answer_no_order = $data;
					$beautyAnswerConditions['BeautyAnswer.id'] = $data;
					$userCountConditions['BeautyProfile.beauty_question_id'] = $this->request->data['BeautyQuestion']['question_id'];
				//	$userCountConditions["BeautyProfile.answer$answer_no_order"] = 1;
					$this->set('answer_no_order',$answer_no_order);
				}else{
					$userCountConditions['BeautyProfile.beauty_question_id'] = $this->request->data['BeautyQuestion']['question_id'];
					$this->set('answer_no_order',0);
			}
				$beautyQuestion = $this->BeautyQuestion->find('first', array(
					   'conditions' => array(
							'BeautyQuestion.id'=> $this->request->data['BeautyQuestion']['question_id']
						),
						'contain' => array(
							'BeautyAnswer' => array(
								'conditions' => $beautyAnswerConditions,
								'fields' => array(
									'BeautyAnswer.id',	
									'BeautyAnswer.answer'	
								)
							)
						),
						'fields' => array(
							'BeautyQuestion.id',
							'BeautyQuestion.name',
						),
					)
				);
				$beautyAnswers = $this->BeautyQuestion->BeautyAnswer->find('list', array(
					   'conditions' => array(
							'BeautyAnswer.beauty_question_id'=> $this->request->data['BeautyQuestion']['question_id']
						),
						'fields' => array(
									'BeautyAnswer.id',
									'BeautyAnswer.answer',
						)
					)
				);
				$i = 1;
				$answers[0] = __l('All');
				foreach($beautyAnswers as $key => $value){
						$answers[$i.'-'.$key] = $value;
					$i++;
				}
				$productQuestion = $this->BeautyQuestion->find('first', array(
					   'conditions' => array(
							'BeautyQuestion.id'=> $this->request->data['BeautyQuestion']['product_question_id']
						),
						'contain' => array(
							'BeautyAnswer' => array(
								'conditions' => $productAnswerConditions,
								'fields' => array(
									'BeautyAnswer.id',	
									'BeautyAnswer.answer'	
								)
							)
						),
						'fields' => array(
							'BeautyQuestion.id',
							'BeautyQuestion.name',
						),
					)
				);
				$productQuestionAnswers = $this->BeautyQuestion->BeautyAnswer->find('list', array(
					   'conditions' => array(
							'BeautyAnswer.beauty_question_id'=> $this->request->data['BeautyQuestion']['product_question_id']
						),
						'fields' => array(
									'BeautyAnswer.id',
									'BeautyAnswer.answer',
						)
					)
				);
				$i = 1;
				$product_answers[0] = __l('All');
				foreach($productQuestionAnswers as $key=> $answer){
						$product_answers[$i.'-'.$key] = $answer;
						$i++;
				}
				$this->set(compact('answers','product_answers'));
				$user_count = $this->BeautyQuestion->BeautyProfile->find('count', array(
						   'conditions' => $userCountConditions)
				);
				$this->set('user_count',$user_count);
				$users = $this->BeautyQuestion->BeautyProfile->find('all', array(
						   'conditions' => $userCountConditions,
							'fields' => array(
								'BeautyProfile.user_id'
							),
							'recursive' => -1
						)
				);
				$userIds = Set::extract('/BeautyProfile/user_id',$users);
				$this->set('userIds',$userIds);
				$this->set('productQuestion',$productQuestion);
				$this->set('beautyQuestion',$beautyQuestion);
			} else {
				$beautyAnswerConditions = array();
				$userCountConditions = array();
				if(!empty($this->request->data['BeautyQuestion']['answer'][0])){
					$data = array();
					foreach($this->request->data['BeautyQuestion']['answer'] as $answer){
						$choiceanswers = explode('-',$answer);
						$data[] = $choiceanswers[0];
						$userCountConditions['OR']["BeautyProfile.answer$choiceanswers[0]"] = 1;
					}
					$answer_no_order = $data;
					$beautyAnswerConditions['BeautyAnswer.id'] = $data;
					$userCountConditions['BeautyProfile.beauty_question_id'] = $this->request->data['BeautyQuestion']['question_id'];
				//	$userCountConditions["BeautyProfile.answer$answer_no_order"] = 1;
					$this->set('answer_no_order',$answer_no_order);
				}else{
					$userCountConditions['BeautyProfile.beauty_question_id'] = $this->request->data['BeautyQuestion']['question_id'];
					$this->set('answer_no_order',0);
				}
				$beautyQuestion = $this->BeautyQuestion->find('first', array(
					   'conditions' => array(
							'BeautyQuestion.id'=> $this->request->data['BeautyQuestion']['question_id']
						),
						'contain' => array(
							'BeautyAnswer' => array(
								'conditions' => $beautyAnswerConditions,
								'fields' => array(
									'BeautyAnswer.id',	
									'BeautyAnswer.answer'	
								)
							)
						),
						'fields' => array(
							'BeautyQuestion.id',
							'BeautyQuestion.name',
						),
					)
				);
				$beautyAnswers = $this->BeautyQuestion->BeautyAnswer->find('list', array(
					   'conditions' => array(
							'BeautyAnswer.beauty_question_id'=> $this->request->data['BeautyQuestion']['question_id']
						),
						'fields' => array(
									'BeautyAnswer.id',
									'BeautyAnswer.answer',
						)
					)
				);
				$i = 1;
				$answers[0] = __l('All');
				foreach($beautyAnswers as $key => $value){
						$answers[$i.'-'.$key] = $value;
					$i++;
				}
				$this->set(compact('answers','beautyAnswers'));
				if($this->request->data['BeautyQuestion']['count'] == 1){
					$user_count = $this->BeautyQuestion->BeautyProfile->find('count', array(
						   'conditions' => $userCountConditions)
					);
					$this->set('user_count',$user_count);
				} else {
					$users = $this->BeautyQuestion->BeautyProfile->find('all', array(
						   'conditions' => $userCountConditions,
							'fields' => array(
								'Distinct(BeautyProfile.user_id)'
							),
							'recursive' => -1
						)
					);
					$userIds = Set::extract('/BeautyProfile/user_id',$users);
					$this->set('userIds',$userIds);
				}
				$this->set('beautyQuestion',$beautyQuestion);
			}
		}
		$beautyQuestions = $this->BeautyQuestion->find('list', array(
					   'conditions' => array(
							'BeautyQuestion.survey_type_id'=> ConstSurveyType::BeautySurvey
						),
					)
				);
		$productQuestions = $this->BeautyQuestion->find('list', array(
					   'conditions' => array(
							'BeautyQuestion.survey_type_id'=> ConstSurveyType::ProductSurvey
						),
					)
				);
		if(empty($this->request->data)){
			$this->request->data['BeautyQuestion']['count'] = 1;
			$this->request->data['BeautyQuestion']['list'] = 0;
		}
		$this->set(compact('beautyQuestions','productQuestions'));
		
	}
	
	
	
	
	
	
	
	
	public function admin_beauty_report(){
		$answers  = array();
		$beautyAnswers = array();
		if(!empty($this->request->data)){
		//print_r($this->request->data);	
		   $beautyAnswerConditions = array();
			$userCountConditions = array();
			$userCount1Conditions = array();
				if(!empty($this->request->data['BeautyQuestion']['answer'][0])){
					$data = array();
					foreach($this->request->data['BeautyQuestion']['answer'] as $answer){
						$choiceanswers = explode('-',$answer);
						$data[] = $choiceanswers[0];
						$userCountConditions['OR']["BeautyProfile.answer$choiceanswers[0]"] = 1;
					}
					$answer_no_order = $data;
					$beautyAnswerConditions['BeautyAnswer.id'] = $data;
					$userCountConditions['BeautyProfile.beauty_question_id'] = $this->request->data['BeautyQuestion']['question_id'];
						
					$this->set('answer_no_order',$answer_no_order);
				}else{
					$userCountConditions['BeautyProfile.beauty_question_id'] = $this->request->data['BeautyQuestion']['question_id'];
					$this->set('answer_no_order',0);
				}
				$beautyQuestion = $this->BeautyQuestion->find('first', array(
					   'conditions' => array(
							'BeautyQuestion.id'=> $this->request->data['BeautyQuestion']['question_id']
						),
						'contain' => array(
							'BeautyAnswer' => array(
								'conditions' => $beautyAnswerConditions,
								'fields' => array(
									'BeautyAnswer.id',	
									'BeautyAnswer.answer'	
								)
							)
						),
						'fields' => array(
							'BeautyQuestion.id',
							'BeautyQuestion.name',
						),
					)
				);
				$beautyAnswers = $this->BeautyQuestion->BeautyAnswer->find('list', array(
					   'conditions' => array(
							'BeautyAnswer.beauty_question_id'=> $this->request->data['BeautyQuestion']['question_id']
						),
						'fields' => array(
									'BeautyAnswer.id',
									'BeautyAnswer.answer',
						)
					)
				);
				$i = 1;
				$answers[0] = __l('All');
				foreach($beautyAnswers as $key => $value){
						$answers[$i.'-'.$key] = $value;
					$i++;
				}
				$this->set(compact('answers','beautyAnswers'));
				if(!empty( $this->request->data['BeautyQuestion']['question_id1'])) {
					$beautyAnswer1Conditions = array();
					if(!empty($this->request->data['BeautyQuestion']['answer1'][0])){
						$data1 = array();
						foreach($this->request->data['BeautyQuestion']['answer1'] as $answer){
							$choiceanswer1s = explode('-',$answer);
							//pr($choiceanswer1s);
							//exit;
							$data1[] = $choiceanswer1s[0];
							$userCount1Conditions['OR']["BeautyProfile.answer$choiceanswer1s[0]"] = 1;
						}
						$answer_no_order1 = $data1;
						$beautyAnswer1Conditions['BeautyAnswer.id'] = $data1;
						$userCount1Conditions['BeautyProfile.beauty_question_id'] = $this->request->data['BeautyQuestion']['question_id1'];
						$this->set('answer_no_order1',$answer_no_order1);
					}else{
						$userCount1Conditions['BeautyProfile.beauty_question_id'] = $this->request->data['BeautyQuestion']['question_id1'];
						$this->set('answer_no_order1',0);
					}
					$beautyQuestion1 = $this->BeautyQuestion->find('first', array(
						   'conditions' => array(
								'BeautyQuestion.id'=> $this->request->data['BeautyQuestion']['question_id1']
							),
							'contain' => array(
								'BeautyAnswer' => array(
									'conditions' => $beautyAnswer1Conditions,
									'fields' => array(
										'BeautyAnswer.id',	
										'BeautyAnswer.answer'	
									)
								)
							),
							'fields' => array(
								'BeautyQuestion.id',
								'BeautyQuestion.name',
							),
						)
					);
					$beautyAnswer1s = $this->BeautyQuestion->BeautyAnswer->find('list', array(
						   'conditions' => array(
								'BeautyAnswer.beauty_question_id'=> $this->request->data['BeautyQuestion']['question_id1']
							),
							'fields' => array(
										'BeautyAnswer.id',
										'BeautyAnswer.answer',
							)
						)
					);
					$i1 = 1;
					$answer1s[0] = __l('All');
					foreach($beautyAnswer1s as $key => $value){
						$answer1s[$i1.'-'.$key] = $value;
						$i1++;
					}
					$this->set(compact('answer1s','beautyAnswer1s'));
					$this->set('beautyQuestion1',$beautyQuestion1);
				}
				$this->set('beautyQuestion',$beautyQuestion);
				if($this->request->data['BeautyQuestion']['count'] == 1){
					$user_count = $this->BeautyQuestion->BeautyProfile->find('count', array(
						   'conditions' => $userCountConditions)
					);
					$this->set('user_count',$user_count);
				} else {
				      if(!empty($this->request->data['BeautyQuestion']['age_group_id']) && empty($this->request->data['BeautyQuestion']['state_id'])){
					   $userCountConditions['UserProfile.age_group_id']=$this->request->data['BeautyQuestion']['age_group_id'];
					   
					}
					elseif(!empty($this->request->data['BeautyQuestion']['state_id']) && empty($this->request->data['BeautyQuestion']['age_group_id'])){
					$userCountConditions['UserProfile.state_id']=$this->request->data['BeautyQuestion']['state_id'];
					}elseif(!empty($this->request->data['BeautyQuestion']['state_id']) && !empty($this->request->data['BeautyQuestion']['age_group_id'])){
					$state_ids = $this->request->data['BeautyQuestion']['state_id'];
					$age_group_id = $this->request->data['BeautyQuestion']['age_group_id'];
					$user_Ids =  array(
					'conditions'=> array('and'=>array('UserProfile.age_group_id'=>$age_group_id, 'UserProfile.state_id'=> $state_ids),
					  )
					);
					//pr($user_Ids);
					$some = $this->BeautyQuestion->BeautyProfile->UserProfile->find('all',$user_Ids);
					$data = array();
						foreach($some as $answer){
							$data[]  = ($answer['UserProfile']['user_id']);
							
						}
						
						$userCountConditions['UserProfile.user_id'] = $data;
						//pr($userCountConditions);
					
				}
				    
					if(!empty($this->request->data['BeautyQuestion']['age_group_id1']) && empty($this->request->data['BeautyQuestion']['state_id1'])){
					$userCount1Conditions['UserProfile.age_group_id']=$this->request->data['BeautyQuestion']['age_group_id1'];
					
					}
					elseif(!empty($this->request->data['BeautyQuestion']['state_id1']) && empty($this->request->data['BeautyQuestion']['age_group_id1'])){
					$userCount1Conditions['UserProfile.state_id']=$this->request->data['BeautyQuestion']['state_id1'];
					}elseif(!empty($this->request->data['BeautyQuestion']['state_id1']) && !empty($this->request->data['BeautyQuestion']['age_group_id1'])){
					$state_ids = $this->request->data['BeautyQuestion']['state_id1'];
					$age_group_id = $this->request->data['BeautyQuestion']['age_group_id1'];
					$user_Ids =  array(
					'conditions'=> array('and'=>array('UserProfile.age_group_id'=>$age_group_id, 'UserProfile.state_id'=> $state_ids),
					  )
					 );
					 //pr($user_Ids);
					 //exit;
					$some = $this->BeautyQuestion->BeautyProfile->UserProfile->find('all',$user_Ids);
					$data = array();
						foreach($some as $answer){
							$data[]  = ($answer['UserProfile']['user_id']);
							
						}
						$userCount1Conditions['UserProfile.user_id'] = $data;
						//pr($userCount1Conditions);exit;
					}
					$_SESSION['userCountConditions']=$userCountConditions;
					$_SESSION['userCount1Conditions']=$userCount1Conditions;
					$this->set('userCountConditions',$userCountConditions);
					$this->set('userCount1Conditions',$userCount1Conditions);
					
				}
				
				
				$this->set('beautyQuestion',$beautyQuestion);
		}
		      $beautyQuestions = $this->BeautyQuestion->find('list', array(
					   'conditions' => array(
							'BeautyQuestion.survey_type_id'=> ConstSurveyType::BeautySurvey
						),
					)
				);
				
				
		$beautyQuestion1s = $beautyQuestions;
		$ageGroups = $this->BeautyQuestion->BeautyProfile->User->UserProfile->AgeGroup->find('list',array(
						'order' => array(
							'AgeGroup.name' =>'asc'
					)
			)	
		);
        //$ageGroup1s= $ageGroups;		
		$states = $this->BeautyQuestion->BeautyProfile->User->UserProfile->State->find('list',array(
						'order' => array(
							'State.name' =>'asc'
					)
			)	
		);
		//$state1s = $states;
		

		if(empty($this->request->data)){
			$this->request->data['BeautyQuestion']['count'] = 1;
			$this->request->data['BeautyQuestion']['list'] = 0;
		}
		$this->set(compact('beautyQuestions','beautyQuestion1s', 'ageGroups', 'states'));
		
	}
	
	
	
	public function admin_product_report_old(){
	
	//pr('comes here');
	//Configure::write('debug', 2); 
	if(!empty($this->request->data)){
	   if($this->request->data['BeautyQuestion']['question_id1'] == '20'){
	   
	   }else{
		   /** Product Survery code **/
					$productAnswerConditions = array();
					$productQuestionConditions = array();
					$productsUser = array();
					$data = array();
					//pr($this->request->data['BeautyQuestion']['answer1'][0]);
					//pr($this->request->data['BeautyQuestion']['question_id1']);
					if($this->request->data['BeautyQuestion']['question_id1'] == '20'){
					if(!empty($this->request->data['BeautyQuestion']['answer1'][0])){
					$productsUser = $this->BeautyQuestion->ProductSurvey->find('list',array(
									'conditions' => array(
										'ProductSurvey.question_no' => $this->request->data['BeautyQuestion']['answer1'][0]
									),
									'fields' => array(
									'ProductSurvey.id',
									'ProductSurvey.user_id',
								),
							  )	
							);
					}
					
					/*if(!empty($this->request->data['BeautyQuestion']['answer1'][0])){
					
							$data = array();
							foreach($this->request->data['BeautyQuestion']['answer1'][0] as $answer){
								$choiceanswers = explode('-',$answer);
								$data[] = $choiceanswers[1];
							}
							//pr($choiceanswers);
							$productAnswerConditions['BeautyAnswer.id'] = $data;
					 }
					 pr($data);*/
					 
					/* if(!empty($this->request->data['BeautyQuestion']['brand_id'])){
							//pr($this->request->data['BeautyQuestion']['brand_id']);
							$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
									'conditions' => array(
										'Product.brand_id' => $this->request->data['BeautyQuestion']['brand_id']
									),
									'fields'=> array(
										'Product.id',
										'Product.id'
									)
								)	
							);
					
					}*/
					//pr($productsUser);
					//pr($products);
					/*$prodUserBrand = $this -> BeautyQuestion->ProductSurvey->find('list', array(
					'condistions'=>array('and'=>array('ProductSurvey.user_id'=>$productsUser, 'ProductSurvey.product_id'=>$products),
					  ),
					  'fields'=>array(
									   'ProductSurvey.id',
									   'ProductSurvey.user_id'),
					));*/
					//exit;
					}else{
					if(!empty($this->request->data['BeautyQuestion']['answer1'][0])){
					
							$data = array();
							foreach($this->request->data['BeautyQuestion']['answer1'] as $answer){
								$choiceanswers = explode('-',$answer);
								$data[] = $choiceanswers[1];
							}
							//pr($choiceanswers);
							$productAnswerConditions['BeautyAnswer.id'] = $data;
					 }
					}
					$productQuestion = $this->BeautyQuestion->find('first', array(
							   'conditions' => array(
									'BeautyQuestion.id'=> $this->request->data['BeautyQuestion']['question_id1']
								),
								'contain' => array(
									'BeautyAnswer' => array(
										'conditions' => $productAnswerConditions,
										'fields' => array(
											'BeautyAnswer.id',	
											'BeautyAnswer.answer'	
										)
									)
								),
								'fields' => array(
									'BeautyQuestion.id',
									'BeautyQuestion.name',
								),
							)
					);
					if($this->request->data['BeautyQuestion']['question_id1'] == 20){
					$productAnswers = $this->BeautyQuestion->ProductSurvey->find('list',array(
					'conditions'=>array('ProductSurvey.question_no'=>$this->request->data['sub_question_id1'][0])
					));
					} else {
					$productAnswers = $this->BeautyQuestion->BeautyAnswer->find('list', array(
							   'conditions' => array(
									'BeautyAnswer.beauty_question_id'=> $this->request->data['BeautyQuestion']['question_id1']
								),
								'fields' => array(
											'BeautyAnswer.id',
											'BeautyAnswer.answer',
								)
							)
					);
					}
					$i = 1;
					$answers[0] = __l('All');
					foreach($productAnswers as $key => $value){
							$answers[$i.'-'.$key] = $value;
						$i++;
					}
					$fields  = array(
						'ProductSurvey.beauty_question_id',
						'BeautyQuestion.name',
					);
					
					$i = 1; 
					$answer_fields = array();
					$userIds = array();
					$productUserIds = array();
					if(!empty($productAnswers) && !empty($data)){
						foreach($productAnswers as $key => $answer){
						$productUserIdsConditions = array();
						 if (in_array($key, $data)) {
							$answer_fields['answer'.$i] = $answer;
							$fields[] = "SUM(ProductSurvey.answer$i) as Answer$i";
							$productUserIdsConditions['BeautyQuestion.id'] = $this->request->data['BeautyQuestion']['question_id1'];
							$productUserIdsConditions["ProductSurvey.answer$i"] = 1;
							if(!empty($this->request->data['BeautyQuestion']['product_id']))
							$productUserIdsConditions['ProductSurvey.product_id']= $this->request->data['BeautyQuestion']['product_id'];
							if(!empty($this->request->data['BeautyQuestion']['brand_id'])){
							$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
									'conditions' => array(
										'Product.brand_id' => $this->request->data['BeautyQuestion']['brand_id']
									),
									'fields'=> array(
										'Product.id',
										'Product.id'
									)
								)	
							);	
							if(!empty($products))
							$productUserIdsConditions['ProductSurvey.product_id']= $products;
						   }
							$userIds  = $this->BeautyQuestion->ProductSurvey->find('all', array(
							'conditions' => $productUserIdsConditions,
							'recursive' => 1,
							));
						  
							if(!empty($userIds))
							$productUserIds["answer$i"] = Set::extract('/ProductSurvey/user_id', $userIds);
						 }
						 $i++;
						}					
					}  else {
							if(!empty($this->request->data['BeautyQuestion']['sub_question_id1']))
							{
								foreach($this->request->data['BeautyQuestion']['answer1'] as $answer){
								 
							$productUserIdsConditions = array();
							$answer_fields['answer'.$i] = $answer;
							$fields[] = "SUM(ProductSurvey.answer$i) as Answer$i";
							$productUserIdsConditions['BeautyQuestion.id'] = $this->request->data['BeautyQuestion']['question_id1'];
							$productUserIdsConditions['BeautyQuestion.question_no']=$this->request->data['BeautyQuestion']['answer1'];
							$productUserIdsConditions["ProductSurvey.answer$i"] = 1;
							if(!empty($this->request->data['BeautyQuestion']['product_id']))
							$productUserIdsConditions['ProductSurvey.product_id']= $this->request->data['BeautyQuestion']['product_id'];
							if(!empty($this->request->data['BeautyQuestion']['brand_id'])){
							$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
									'conditions' => array(
										'Product.brand_id' => $this->request->data['BeautyQuestion']['brand_id']
									),
									'fields'=> array(
										'Product.id',
										'Product.id'
									)
								)	
							);
							if(!empty($products))
							 $productUserIdsConditions['ProductSurvey.product_id']= $products;
							}
							$userIds  =  $this->BeautyQuestion->ProductSurvey->find('all', array(
							'conditions' => $productUserIdsConditions ,
							'recursive' => 1,
							));
							if(!empty($userIds))
								$productUserIds["answer$i"] = Set::extract('/ProductSurvey/user_id', $userIds);
							$i++;
								
								}
							} else {
							foreach($productAnswers as $key => $answer) {
							$productUserIdsConditions = array();
							$answer_fields['answer'.$i] = $answer;
							$fields[] = "SUM(ProductSurvey.answer$i) as Answer$i";
							$productUserIdsConditions['BeautyQuestion.id'] = $this->request->data['BeautyQuestion']['question_id1'];
							$productUserIdsConditions["ProductSurvey.answer$i"] = 1;
							if(!empty($this->request->data['BeautyQuestion']['product_id']))
							$productUserIdsConditions['ProductSurvey.product_id']= $this->request->data['BeautyQuestion']['product_id'];
							if(!empty($this->request->data['BeautyQuestion']['brand_id'])){
							$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
									'conditions' => array(
										'Product.brand_id' => $this->request->data['BeautyQuestion']['brand_id']
									),
									'fields'=> array(
										'Product.id',
										'Product.id'
									)
								)	
							);
							if(!empty($products))
							 $productUserIdsConditions['ProductSurvey.product_id']= $products;
							}
							$userIds  =  $this->BeautyQuestion->ProductSurvey->find('all', array(
							'conditions' => $productUserIdsConditions ,
							'recursive' => 1,
							));
							if(!empty($userIds))
								$productUserIds["answer$i"] = Set::extract('/ProductSurvey/user_id', $userIds);
							$i++;
							}
						}
					}
					$fields  = implode(',',$fields);
					$productSurveysConditions = array();
					$productSurveysConditions['ProductSurvey.beauty_question_id']= $this->request->data['BeautyQuestion']['question_id1'];
					if(!empty($this->request->data['BeautyQuestion']['product_id']))
					$productSurveysConditions['ProductSurvey.product_id']= $this->request->data['BeautyQuestion']['product_id'];
					if(!empty($this->request->data['BeautyQuestion']['brand_id'])){
						$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
								'conditions' => array(
									'Product.brand_id' => $this->request->data['BeautyQuestion']['brand_id']
								),
								'fields'=> array(
									'Product.id',
									'Product.id'
								)
							)	
						);
						 if(!empty($products))
						$productSurveysConditions['ProductSurvey.product_id']= $products;
					}
					$productSurveys = $this->BeautyQuestion->ProductSurvey->find('all',array(
						'conditions'=> $productSurveysConditions,
						'fields'=> $fields,
					));
					$productResults = array();
					if(!empty($productSurveys[0][0])){
						foreach($productSurveys[0][0] as $key => $value){
						  if(empty($value))
						  $productResults[$key] = 0;
						  else
						  $productResults[$key] = $value;	
						}
					}
					$responses = array_combine($answer_fields,$productResults);
					$this->set('responses',$responses);
					$this->set('productSurveys',$productSurveys[0]);
					//pr($productSurveys); exit;
					$product_answer_fields = array();
					foreach($answer_fields as $key => $answer_field)
					$product_answer_fields[$key] = $answer_field;
					$this->set('product_answer_fields',$product_answer_fields);
					
					/** Bar chart Beauty Question Survey Questions **/
					if(!empty($this->request->data['BeautyQuestion']['question_id']))
					{
						$beautyAnswerConditions = array();
						$beautyQuestionConditions = array();
						$bdata = array();
						$bchoiceanswers = array();
						if(!empty($this->request->data['BeautyQuestion']['answer'][0])){
								$data = array();
								foreach($this->request->data['BeautyQuestion']['answer'] as $answer){
									$bchoiceanswers = explode('-',$answer);
									$bdata[] = $bchoiceanswers[1];
								}
								$beautyAnswerConditions['BeautyAnswer.id'] = $bdata;
						}
						$beautyQuestion = $this->BeautyQuestion->find('first', array(
								   'conditions' => array(
										'BeautyQuestion.id'=> $this->request->data['BeautyQuestion']['question_id']
									),
									'contain' => array(
										'BeautyAnswer' => array(
											'conditions' => $beautyAnswerConditions,
											'fields' => array(
												'BeautyAnswer.id',	
												'BeautyAnswer.answer'	
											)
										)
									),
									'fields' => array(
										'BeautyQuestion.id',
										'BeautyQuestion.name',
									),
								)
						);
						$beautyQuestionAnswers = $this->BeautyQuestion->BeautyAnswer->find('list', array(
							   'conditions' => array(
									'BeautyAnswer.beauty_question_id'=> $this->request->data['BeautyQuestion']['question_id']
								),
								'fields' => array(
											'BeautyAnswer.id',
											'BeautyAnswer.answer',
								)
							)
						);
						$i = 1;
						$answer2s[0] = __l('All');
						foreach($beautyQuestionAnswers as $key => $value){
									$answer2s[$i.'-'.$key] = $value;
								$i++;
							}
						$participants  = $this->BeautyQuestion->ProductSurvey->find('all', array(
							'conditions'=> $productSurveysConditions,
							'fields'=> array(
								'Distinct(ProductSurvey.user_id)'
							),
							'recursive' => -1,
						));
						//pr($participants);
						//exit;
						$participantUserIds = Set::extract('/ProductSurvey/user_id', $participants);
						$totalparticipants = count($participantUserIds);
						$beautyQuestionConditions['BeautyProfile.user_id'] = $participantUserIds;
						$beautyQuestionConditions['BeautyProfile.beauty_question_id'] = $this->request->data['BeautyQuestion']['question_id'];
						$ki = 1;
						$bfields = array();
						$beautyanswer_fields = array();
						$bfields  = array();
						if(!empty($beautyQuestionAnswers) && !empty($bdata)){
							foreach($beautyQuestionAnswers as $key => $answer){
							 if (in_array($key, $bdata)) {
								$beautyanswer_fields[] = $answer;
								$bfields[] = "(SUM(BeautyProfile.answer$ki)/$totalparticipants)*100 as Answer$ki";
							 }
							 $ki++;
							}					
						} else {
							foreach($beautyQuestionAnswers as $key => $answer) {
								 $beautyanswer_fields[] = $answer;
								 $bfields[] = "(SUM(BeautyProfile.answer$ki)/$totalparticipants)*100 as Answer$ki";
								 $ki++;
							}
						}
						$bfields  = implode(',',$bfields);
						$beauty_responses = array();
						if(!empty($productUserIds)){
							foreach($productUserIds as $key => $userIDList) {
								unset($beautyQuestionConditions['BeautyProfile.user_id']);
								$beautyQuestionConditions['BeautyProfile.user_id'] =  $userIDList;
								$beauty_responses[$key] = $this->BeautyQuestion->BeautyProfile->find('first',array(
									'conditions' => $beautyQuestionConditions,
									'fields' => $bfields,
									'recursive'=> -1
								));
							}
						}
						//pr($beauty_responses);
						//exit;
						$this->set('beauty_responses',$beauty_responses);
						$userIds = array_unique(array_merge($participantUserIds,$productUserIds));
						$this->set('userIds',$participantUserIds);
					}
					$this->set(compact('productAnswers','answers','beautyQuestion','answer2s'));
				//	$this->set('productanswer_fields',$answer_fields);

			}
		}
		$beautyQuestions = $this->BeautyQuestion->find('list', array(
					   'conditions' => array(
							'BeautyQuestion.survey_type_id'=> ConstSurveyType::BeautySurvey
						),
					)
				);
		$productQuestions = $this->BeautyQuestion->find('list', array(
					   'conditions' => array(
							'BeautyQuestion.survey_type_id'=> ConstSurveyType::ProductSurvey
						),
					)
				);
		$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
						'order' => array(
							'Product.id' =>'desc'
					)
			)	
		);	

//pr($products);

		$ageGroups = $this->BeautyQuestion->BeautyProfile->User->UserProfile->AgeGroup->find('list',array(
						'order' => array(
							'AgeGroup.name' =>'asc'
					)
			)	
		);		
		$states = $this->BeautyQuestion->BeautyProfile->User->UserProfile->State->find('list',array(
						'order' => array(
							'State.name' =>'asc'
					)
			)	
		);
		$brands = $this->BeautyQuestion->ProductSurvey->Product->Brand->find('list',array(
						'order' => array(
							'Brand.name' =>'asc'
					)
			)	
		);
		if(empty($this->request->data)){
			$this->request->data['BeautyQuestion']['count'] = 1;
			$this->request->data['BeautyQuestion']['list'] = 0;
		}
		$this->set(compact('beautyQuestions','productQuestions','products','brands','ageGroups','states'));
	}
	
	public function admin_product_report(){
		//Configure::write('debug', 2); 
		//pr($this->request->data);
		if(!empty($this->request->data)){
			if($this->request->data['BeautyQuestion']['question_id1']==20){
				$productAnswerConditions = array();
				$productQuestionConditions = array();
				$data = array();
				if(!empty($this->request->data['BeautyQuestion']['answer1'][0])){
						$data = array();
						foreach($this->request->data['BeautyQuestion']['answer1'] as $answer){
							$data[] = $answer;
						}
						$productAnswerConditions['BeautyAnswer.id'] = $data;
				}

				
				$productAnswers = $this->BeautyQuestion->BeautyAnswer->find('list', array(
						   'conditions' => array(
								'BeautyAnswer.beauty_question_id'=> $this->request->data['BeautyQuestion']['question_id1']
							),
							'fields' => array(
										'BeautyAnswer.id',
										'BeautyAnswer.answer',
							)
						)
				);
				
				$i = 1;
				$answers[0] = __l('All');
				foreach($productAnswers as $key => $value){
						$answers[$i.'-'.$key] = $value;
					$i++;
				}
				$fields  = array(
					'ProductSurvey.beauty_question_id',
					'BeautyQuestion.name',
				);
				$Constfileds=array(
					1=>'Very Dissatisfied',
					2=>'Somewhat Dissatisfied',
					3=>'Neutral',
					4=>'Somewhat Satisfied',
					5=>'Very Satisfied',
				);
				$i = 1; 
				$answer_fields = array();
				$userIds = array();
				$userlist = array();
				$participants = array();
				$productUserIds = array();
				if(!empty($productAnswers) && !empty($data)){
				foreach($this->request->data['BeautyQuestion']['answer1'] as $ans_field){
					$answer_fields[]=$Constfileds[$ans_field];
					$i=$ans_field;
				    $productUserIdsConditions = array();
                     $fields[] = "SUM(ProductSurvey.answer$i) as Answer$i";
						$productUserIdsConditions['BeautyQuestion.id'] = $this->request->data['BeautyQuestion']['question_id1'];
						$productUserIdsConditions["ProductSurvey.answer$i"] = 1;
						$productUserIdsConditions['ProductSurvey.question_no'] = $this->request->data['BeautyQuestion']['sub_question_id1'][0];
						if(!empty($this->request->data['BeautyQuestion']['product_id']))
						$productUserIdsConditions['ProductSurvey.product_id']= $this->request->data['BeautyQuestion']['product_id'];
						if(!empty($this->request->data['BeautyQuestion']['brand_id'])){
						$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
								'conditions' => array(
									'Product.brand_id' => $this->request->data['BeautyQuestion']['brand_id']
								),
								'fields'=> array(
									'Product.id',
									'Product.id'
								)
							)	
						);	
						if(!empty($products))
						$productUserIdsConditions['ProductSurvey.product_id']= $products;
					}
					
					
					/*Age and location based*/
					if(!empty($this->request->data['BeautyQuestion']['age_group_id1']) && empty($this->request->data['BeautyQuestion']['state_id1'])){
					$productUserIdsConditions['UserProfile.age_group_id']=$this->request->data['BeautyQuestion']['age_group_id1'];
					
					}
					elseif(!empty($this->request->data['BeautyQuestion']['state_id1']) && empty($this->request->data['BeautyQuestion']['age_group_id1'])){
					$productUserIdsConditions['UserProfile.state_id']=$this->request->data['BeautyQuestion']['state_id1'];
					}elseif(!empty($this->request->data['BeautyQuestion']['state_id1']) && !empty($this->request->data['BeautyQuestion']['age_group_id1'])){
					$state_ids = $this->request->data['BeautyQuestion']['state_id1'];
					$age_group_id = $this->request->data['BeautyQuestion']['age_group_id1'];
					$user_Ids =  array(
					'conditions'=> array('and'=>array('UserProfile.age_group_id'=>$age_group_id, 'UserProfile.state_id'=> $state_ids),
					  )
					 );
					 
					$some = $this->BeautyQuestion->ProductSurvey->UserProfile->find('all',$user_Ids);
					
					$data = array();
						foreach($some as $answer){
							$data[]  = ($answer['UserProfile']['user_id']);
							
						}
						
						
						$productUserIdsConditions['UserProfile.user_id'] = $data;
						
					}
				/*Ends here*/
					   $participants  = $this->BeautyQuestion->ProductSurvey->find('all', array(
						'conditions' => $productUserIdsConditions,
						'recursive' => 1,
						));
						
						
						foreach($participants as $key =>$participant){
				           $userlist[] = $participant['ProductSurvey']['user_id'];
				        }
					   
						
						if(!empty($userlist))
						$productUserIds["answer$i"] = Set::extract('/ProductSurvey/user_id', $userlist);
					 
					 $i++;
					}
				} else {
				        foreach($productAnswers as $answer) {
						$productUserIdsConditions = array();
						$answer_fields[$i];
						$fields[] = "SUM(ProductSurvey.answer$i) as Answer$i";
                        $productUserIdsConditions['BeautyQuestion.id'] = $this->request->data['BeautyQuestion']['question_id1'];
						$productUserIdsConditions['BeautyQuestion.question_no'] = $this->request->data['BeautyQuestion']['sub_question_id1'];
						$productUserIdsConditions["ProductSurvey.answer$i"] = 1;
					    if(!empty($this->request->data['BeautyQuestion']['product_id']))
						$productUserIdsConditions['ProductSurvey.product_id']= $this->request->data['BeautyQuestion']['product_id'];
						if(!empty($this->request->data['BeautyQuestion']['brand_id'])){
						$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
								'conditions' => array(
									'Product.brand_id' => $this->request->data['BeautyQuestion']['brand_id']
								),
								'fields'=> array(
									'Product.id',
									'Product.id'
								)
							)	
						);	
						if(!empty($products))
						 $productUserIdsConditions['ProductSurvey.product_id']= $products;
					}
					   
					   $participants  = $this->BeautyQuestion->ProductSurvey->find('all', array(
						'conditions' => $productUserIdsConditions,
						'recursive' => 1,
						));
						
						foreach($participants as $key =>$participant){
				           $userlist[] = $participant['ProductSurvey']['user_id'];
				    }
						
						if(!empty($userlist))
						    $productUserIds["answer$i"] = Set::extract('/ProductSurvey/user_id', $userlist);
						$i++;
					}
					
				}
				
				$_SESSION['userlist']=$userlist;
        		$this->set('userlist',$userlist);
				
				$productSurveysConditions = array();
				if($this->request->data['BeautyQuestion']['question_id1'] == 20){
					$productSurveysConditions['ProductSurvey.question_no']=$this->request->data['BeautyQuestion']['sub_question_id1'][0];
				}
				$productSurveysConditions['ProductSurvey.beauty_question_id']= $this->request->data['BeautyQuestion']['question_id1'];
				if(!empty($this->request->data['BeautyQuestion']['product_id']))
				$productSurveysConditions['ProductSurvey.product_id']= $this->request->data['BeautyQuestion']['product_id'];
				if(!empty($this->request->data['BeautyQuestion']['brand_id'])){
					$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
							'conditions' => array(
								'Product.brand_id' => $this->request->data['BeautyQuestion']['brand_id']
							),
							'fields'=> array(
								'Product.id',
								'Product.id'
							)
						)	
					);
                     if(!empty($products))
					$productSurveysConditions['ProductSurvey.product_id']= $products;
				}
				$productSurveysConditions["ProductSurvey.answer$i"] = 1;
				$productSurveys = $this->BeautyQuestion->ProductSurvey->find('all',array(
					'conditions'=> $productSurveysConditions,
					'fields'=> $fields,
				));
               
				$productResults = array();
				if(!empty($productSurveys[0][0])){ 
					foreach($productSurveys[0][0] as $key => $value){
					  if(empty($value))
					  $productResults[$key] = 0;
					  else
					  $productResults[$key] = $value;	
					}
				}
                $responses = array_combine($answer_fields,$productResults);
				
				//$_SESSION['userIds']=$userlist;
				$this->set('responses',$responses);
				//$this->set('userIds',$userlist);
				$this->set('productSurveys',$productSurveys[0]);
				$product_answer_fields = array();
				foreach($answer_fields as $key => $answer_field)
				$product_answer_fields[$key] = $answer_field;
				$this->set('product_answer_fields',$product_answer_fields);
				/** Bar chart Beauty Question Survery Questions **/
				if(!empty($this->request->data['BeautyQuestion']['question_id']))
				{
                    $beautyAnswerConditions = array();
					$beautyQuestionConditions = array();
					$bdata = array();
					$bchoiceanswers = array();
					if(!empty($this->request->data['BeautyQuestion']['answer'][0])){
							$data = array();
							foreach($this->request->data['BeautyQuestion']['answer'] as $answer){
								$bchoiceanswers = explode('-',$answer);
								$bdata[] = $bchoiceanswers[1];
							}
							$beautyAnswerConditions['BeautyAnswer.id'] = $bdata;
					}
					$beautyQuestion = $this->BeautyQuestion->find('first', array(
							   'conditions' => array(
									'BeautyQuestion.id'=> $this->request->data['BeautyQuestion']['question_id']
								),
								'contain' => array(
									'BeautyAnswer' => array(
										'conditions' => $beautyAnswerConditions,
										'fields' => array(
											'BeautyAnswer.id',	
											'BeautyAnswer.answer'	
										)
									)
								),
								'fields' => array(
									'BeautyQuestion.id',
									'BeautyQuestion.name',
								),
							)
					);
					$beautyQuestionAnswers = $this->BeautyQuestion->BeautyAnswer->find('list', array(
						   'conditions' => array(
								'BeautyAnswer.beauty_question_id'=> $this->request->data['BeautyQuestion']['question_id']
							),
							'fields' => array(
										'BeautyAnswer.id',
										'BeautyAnswer.answer',
							)
						)
					);
					$i = 1;
					$answer2s[0] = __l('All');
					foreach($beautyQuestionAnswers as $key => $value){
								$answer2s[$i.'-'.$key] = $value;
							$i++;
						}
					$participants  = $this->BeautyQuestion->ProductSurvey->find('all', array(
						'conditions'=> $productSurveysConditions,
						'fields'=> array(
							'Distinct(ProductSurvey.user_id)'
						),
						'recursive' => -1,
					));
					$participantUserIds = Set::extract('/ProductSurvey/user_id', $participants);
					$totalparticipants = count($participantUserIds);
					$beautyQuestionConditions['BeautyProfile.user_id'] = $participantUserIds;
					$beautyQuestionConditions['BeautyProfile.beauty_question_id'] = $this->request->data['BeautyQuestion']['question_id'];
					$ki = 1;
					$bfields = array();
					$beautyanswer_fields = array();
					$bfields  = array();
					if(!empty($beautyQuestionAnswers) && !empty($bdata)){
						foreach($beautyQuestionAnswers as $key => $answer){
						 if (in_array($key, $bdata)) {
							$beautyanswer_fields[] = $answer;
							$bfields[] = "(SUM(BeautyProfile.answer$ki)/$totalparticipants)*100 as Answer$ki";
						 }
						 $ki++;
						}					
					} else {
						foreach($beautyQuestionAnswers as $key => $answer) {
							 $beautyanswer_fields[] = $answer;
							 $bfields[] = "(SUM(BeautyProfile.answer$ki)/$totalparticipants)*100 as Answer$ki";
							 $ki++;
						}
					}
					$bfields  = implode(',',$bfields);
					$beauty_responses = array();
					if(!empty($productUserIds)){
						foreach($productUserIds as $key => $userIDList) {
							unset($beautyQuestionConditions['BeautyProfile.user_id']);
							$beautyQuestionConditions['BeautyProfile.user_id'] =  $userIDList;
							$beauty_responses[$key] = $this->BeautyQuestion->BeautyProfile->find('first',array(
								'conditions' => $beautyQuestionConditions,
								'fields' => $bfields,
								'recursive'=> -1
							));
						}
					}
					$this->set('beauty_responses',$beauty_responses);
					//$userIds = array_unique(array_merge($participantUserIds,$productUserIds));
					$this->set('userIds',$participantUserIds);
				}
				$this->set(compact('productAnswers','answers','Constfileds', 'beautyQuestion','answer2s'));
			//	$this->set('productanswer_fields',$answer_fields);
			
			} else {
			
			/** Product Survery code **/
				$productAnswerConditions = array();
				$productQuestionConditions = array();
				$data = array();
				if(!empty($this->request->data['BeautyQuestion']['answer1'][0])){
						$data = array();
						foreach($this->request->data['BeautyQuestion']['answer1'] as $answer){
							$choiceanswers = explode('-',$answer);
							$data[] = $choiceanswers[1];
						}
						$productAnswerConditions['BeautyAnswer.id'] = $data;
				}
				/*$productQuestion = $this->BeautyQuestion->find('first', array(
						   'conditions' => array(
								'BeautyQuestion.id'=> $this->request->data['BeautyQuestion']['question_id1']
							),
							'contain' => array(
								'BeautyAnswer' => array(
									'conditions' => $productAnswerConditions,
									'fields' => array(
										'BeautyAnswer.id',	
										'BeautyAnswer.answer'	
									)
								)
							),
							'fields' => array(
								'BeautyQuestion.id',
								'BeautyQuestion.name',
							),
						)
				);*/


                         /* if(!empty($this->request->data['BeautyQuestion']['product_id'])){
				$participants = $this->BeautyQuestion->ProductSurvey->find('all', array(
				         'conditions'=> array('and'=>array('ProductSurvey.beauty_question_id'=>$this->request->data['BeautyQuestion']['question_id1'], 'ProductSurvey.product_id'=> $this->request->data['BeautyQuestion']['product_id'])),
						 'fields'=>array('Distinct(ProductSurvey.user_id)'),
						 'recursive' => -1,
				));
				}else{
				$participants  = $this->BeautyQuestion->ProductSurvey->find('all', array(
						'conditions'=> $productSurveysConditions,
						'fields'=> array(
							'Distinct(ProductSurvey.user_id)'
						),
						'recursive' => -1,
					));
				}				
				/*$userlist = array();
				foreach($participants as $key =>$participant){
				$userlist[] = $participant['ProductSurvey']['user_id'];
				}
			    $_SESSION['userlist']=$userlist;
			    $this->set('userlist',$userlist);    */                        
				$productAnswers = $this->BeautyQuestion->BeautyAnswer->find('list', array(
						   'conditions' => array(
								'BeautyAnswer.beauty_question_id'=> $this->request->data['BeautyQuestion']['question_id1']
							),
							'fields' => array(
										'BeautyAnswer.id',
										'BeautyAnswer.answer',
							)
						)
				);
				
				$i = 1;
				$answers[0] = __l('All');
				foreach($productAnswers as $key => $value){
						$answers[$i.'-'.$key] = $value;
					$i++;
				}
				$fields  = array(
					'ProductSurvey.beauty_question_id',
					'BeautyQuestion.name',
				);
				
				$i = 1; 
				$answer_fields = array();
				$userlist = array();
				$productUserIds = array();
				if(!empty($productAnswers) && !empty($data)){
				foreach($productAnswers as $key => $answer){
					$productUserIdsConditions = array();
					 if (in_array($key, $data)) {
						$answer_fields['answer'.$i] = $answer;
						$fields[] = "SUM(ProductSurvey.answer$i) as Answer$i";
						$productUserIdsConditions['BeautyQuestion.id'] = $this->request->data['BeautyQuestion']['question_id1'];
						$productUserIdsConditions["ProductSurvey.answer$i"] = 1;
						if(!empty($this->request->data['BeautyQuestion']['product_id']))
						$productUserIdsConditions['ProductSurvey.product_id']= $this->request->data['BeautyQuestion']['product_id'];
						if(!empty($this->request->data['BeautyQuestion']['brand_id'])){
						$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
								'conditions' => array(
									'Product.brand_id' => $this->request->data['BeautyQuestion']['brand_id']
								),
								'fields'=> array(
									'Product.id',
									'Product.id'
								)
							)	
						);	
						if(!empty($products))
						$productUserIdsConditions['ProductSurvey.product_id']= $products;
					   }
						$participants  = $this->BeautyQuestion->ProductSurvey->find('all', array(
						'conditions' => $productUserIdsConditions,
						'recursive' => 1,
						));
						
						foreach($participants as $key =>$participant){
				           $userlist[] = $participant['ProductSurvey']['user_id'];
				        }
						
						
						if(!empty($userlist))
						$productUserIds["answer$i"] = Set::extract('/ProductSurvey/user_id', $userlist);
					 }
					 $i++;
					}					
				} else {
				      
				 	    foreach($productAnswers as $key => $answer){
						$productUserIdsConditions = array();
						$answer_fields['answer'.$i] = $answer;
						$fields[] = "SUM(ProductSurvey.answer$i) as Answer$i";
                        $productUserIdsConditions['BeautyQuestion.id'] = $this->request->data['BeautyQuestion']['question_id1'];
						$productUserIdsConditions["ProductSurvey.answer$i"] = 1;
					    if(!empty($this->request->data['BeautyQuestion']['product_id']))
						$productUserIdsConditions['ProductSurvey.product_id']= $this->request->data['BeautyQuestion']['product_id'];
						if(!empty($this->request->data['BeautyQuestion']['brand_id'])){
						$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
								'conditions' => array(
									'Product.brand_id' => $this->request->data['BeautyQuestion']['brand_id']
								),
								'fields'=> array(
									'Product.id',
									'Product.id'
								)
							)	
						);	
						if(!empty($products))
						 $productUserIdsConditions['ProductSurvey.product_id']= $products;
					    }
						$participants   =  $this->BeautyQuestion->ProductSurvey->find('all', array(
						'conditions' => $productUserIdsConditions ,
						'recursive' => 1,
						));
						
						foreach($participants as $key =>$participant){
				           $userlist[] = $participant['ProductSurvey']['user_id'];
				        }
						
						if(!empty($userlist))
						    $productUserIds["answer$i"] = Set::extract('/ProductSurvey/user_id', $userlist);
						$i++;
						}
						
				}
				
				$_SESSION['userlist']=$userlist;
			    $this->set('userlist',$userlist); 
				$fields  = implode(',',$fields);
				$productSurveysConditions = array();
				$productSurveysConditions['ProductSurvey.beauty_question_id']= $this->request->data['BeautyQuestion']['question_id1'];
				if(!empty($this->request->data['BeautyQuestion']['product_id']))
				$productSurveysConditions['ProductSurvey.product_id']= $this->request->data['BeautyQuestion']['product_id'];
				if(!empty($this->request->data['BeautyQuestion']['brand_id'])){
					$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
							'conditions' => array(
								'Product.brand_id' => $this->request->data['BeautyQuestion']['brand_id']
							),
							'fields'=> array(
								'Product.id',
								'Product.id'
							)
						)	
					);
                     if(!empty($products))
					$productSurveysConditions['ProductSurvey.product_id']= $products;
				}
				/*Age and location based*/
				
if($this->request->data['BeautyQuestion']['age_group_id1'] != NULL || $this->request->data['BeautyQuestion']['state_id1'] != NULL){

					if(!empty($this->request->data['BeautyQuestion']['age_group_id1']) && empty($this->request->data['BeautyQuestion']['state_id1'])){
					$productSurveysConditions['UserProfile.age_group_id']=$this->request->data['BeautyQuestion']['age_group_id1'];
				}
					elseif(!empty($this->request->data['BeautyQuestion']['state_id1']) && empty($this->request->data['BeautyQuestion']['age_group_id1'])){
					$productSurveysConditions['UserProfile.state_id']=$this->request->data['BeautyQuestion']['state_id1'];
					}elseif(!empty($this->request->data['BeautyQuestion']['state_id1']) && !empty($this->request->data['BeautyQuestion']['age_group_id1'])){
					$state_ids = $this->request->data['BeautyQuestion']['state_id1'];
					
					$age_group_id = $this->request->data['BeautyQuestion']['age_group_id1'];
					
					$user_Ids =  array(
					'conditions'=> array('and'=>array('UserProfile.age_group_id'=>$age_group_id, 'UserProfile.state_id'=> $state_ids),
					  )
					 );
					 
					$some = $this->BeautyQuestion->ProductSurvey->UserProfile->find('all',$user_Ids);
					$data = array();
						foreach($some as $answer){
							$data[]  = ($answer['UserProfile']['user_id']);
							
						}
						$productSurveysConditions['UserProfile.user_id'] = $data;
					}
				}
					/*Ends here*/
				$productSurveys = $this->BeautyQuestion->ProductSurvey->find('all',array(
					'conditions'=> $productSurveysConditions,
					'fields'=> $fields,
				));
				$productResults = array();
				if(!empty($productSurveys[0][0])){
					foreach($productSurveys[0][0] as $key => $value){
					  if(empty($value))
					  $productResults[$key] = 0;
					  else
					  $productResults[$key] = $value;	

					}
				}				
				$responses = array_combine($answer_fields,$productResults);
				$this->set('responses',$responses);
				$this->set('productSurveys',$productSurveys[0]);
				$product_answer_fields = array();
				foreach($answer_fields as $key => $answer_field)
				$product_answer_fields[$key] = $answer_field;
				$this->set('product_answer_fields',$product_answer_fields);
				/** Bar char Beauty Question Survery Questions **/
				if(!empty($this->request->data['BeautyQuestion']['question_id']))
				{
                    $beautyAnswerConditions = array();
					$beautyQuestionConditions = array();
					$bdata = array();
					$bchoiceanswers = array();
					if(!empty($this->request->data['BeautyQuestion']['answer'][0])){
							$data = array();
							foreach($this->request->data['BeautyQuestion']['answer'] as $answer){
								$bchoiceanswers = explode('-',$answer);
								$bdata[] = $bchoiceanswers[1];
							}
							$beautyAnswerConditions['BeautyAnswer.id'] = $bdata;
					}
					$beautyQuestion = $this->BeautyQuestion->find('first', array(
							   'conditions' => array(
									'BeautyQuestion.id'=> $this->request->data['BeautyQuestion']['question_id']
								),
								'contain' => array(
									'BeautyAnswer' => array(
										'conditions' => $beautyAnswerConditions,
										'fields' => array(
											'BeautyAnswer.id',	
											'BeautyAnswer.answer'	
										)
									)
								),
								'fields' => array(
									'BeautyQuestion.id',
									'BeautyQuestion.name',
								),
							)
					);
					$beautyQuestionAnswers = $this->BeautyQuestion->BeautyAnswer->find('list', array(
						   'conditions' => array(
								'BeautyAnswer.beauty_question_id'=> $this->request->data['BeautyQuestion']['question_id']
							),
							'fields' => array(
										'BeautyAnswer.id',
										'BeautyAnswer.answer',
							)
						)
					);
					$i = 1;
					$answer2s[0] = __l('All');
					foreach($beautyQuestionAnswers as $key => $value){
								$answer2s[$i.'-'.$key] = $value;
							$i++;
						}
					$participants  = $this->BeautyQuestion->ProductSurvey->find('all', array(
						'conditions'=> $productSurveysConditions,
						'fields'=> array(
							'Distinct(ProductSurvey.user_id)'
						),
						'recursive' => -1,
					));
					$participantUserIds = Set::extract('/ProductSurvey/user_id', $participants);
					$totalparticipants = count($participantUserIds);
					$beautyQuestionConditions['BeautyProfile.user_id'] = $participantUserIds;
					$beautyQuestionConditions['BeautyProfile.beauty_question_id'] = $this->request->data['BeautyQuestion']['question_id'];
					$ki = 1;
					$bfields = array();
					$beautyanswer_fields = array();
					$bfields  = array();
					if(!empty($beautyQuestionAnswers) && !empty($bdata)){
						foreach($beautyQuestionAnswers as $key => $answer){
						 if (in_array($key, $bdata)) {
							$beautyanswer_fields[] = $answer;
							$bfields[] = "(SUM(BeautyProfile.answer$ki)/$totalparticipants)*100 as Answer$ki";
						 }
						 $ki++;
						}					
					} else {
						foreach($beautyQuestionAnswers as $key => $answer) {
							 $beautyanswer_fields[] = $answer;
							 $bfields[] = "(SUM(BeautyProfile.answer$ki)/$totalparticipants)*100 as Answer$ki";
							 $ki++;
						}
					}
					$bfields  = implode(',',$bfields);
					$beauty_responses = array();
					if(!empty($productUserIds)){
						foreach($productUserIds as $key => $userIDList) {
							unset($beautyQuestionConditions['BeautyProfile.user_id']);
							$beautyQuestionConditions['BeautyProfile.user_id'] =  $userIDList;
							$beauty_responses[$key] = $this->BeautyQuestion->BeautyProfile->find('first',array(
								'conditions' => $beautyQuestionConditions,
								'fields' => $bfields,
								'recursive'=> -1
							));
						}
					}
					$this->set('beauty_responses',$beauty_responses);
					//$userIds = array_unique(array_merge($participantUserIds,$productUserIds));
					$this->set('userIds',$participantUserIds);
				}
				$this->set(compact('productAnswers','answers','Constfileds', 'beautyQuestion','answer2s'));
			//	$this->set('productanswer_fields',$answer_fields);
			}
		}		$beautyQuestions = $this->BeautyQuestion->find('list', array(
					   'conditions' => array(
							'BeautyQuestion.survey_type_id'=> ConstSurveyType::BeautySurvey
						),
					)
				);
		$productQuestions = $this->BeautyQuestion->find('list', array(
					   'conditions' => array(
							'BeautyQuestion.survey_type_id'=> ConstSurveyType::ProductSurvey
						),
					)
				);
		$products = $this->BeautyQuestion->ProductSurvey->Product->find('list',array(
						'order' => array(
							'Product.id' =>'desc'
					)
			)	
		);	

//pr($products);

		$ageGroups = $this->BeautyQuestion->BeautyProfile->User->UserProfile->AgeGroup->find('list',array(
						'order' => array(
							'AgeGroup.name' =>'asc'
					)
			)	
		);		
		$states = $this->BeautyQuestion->BeautyProfile->User->UserProfile->State->find('list',array(
						'order' => array(
							'State.name' =>'asc'
					)
			)	
		);
		$brands = $this->BeautyQuestion->ProductSurvey->Product->Brand->find('list',array(
						'order' => array(
							'Brand.name' =>'asc'
					)
			)	
		);
		if(empty($this->request->data)){
			$this->request->data['BeautyQuestion']['count'] = 1;
			$this->request->data['BeautyQuestion']['list'] = 0;
		}
		$this->set(compact('beautyQuestions','productQuestions','products','brands','ageGroups','states'));
	}
}
