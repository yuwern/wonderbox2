<?php
class BeautyQuestionsController extends AppController
{
    public $name = 'BeautyQuestions';
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
	public function lists($suvery_type_id = 1){
		$conditions['BeautyQuestion.survey_type_id'] = $suvery_type_id;
		$this->set('beautyQuestions',$this->BeautyQuestion->find('list',array(
												'conditions' => $conditions
		)));
	}
	public function answers($question_id = 1){
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
		$this->set('answers',$responses);
	}
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
		$this->set('answers',$responses);
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
}
