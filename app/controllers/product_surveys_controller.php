<?php
class ProductSurveysController extends AppController
{
    public $name = 'ProductSurveys';
	public function beforeFilter()
    {
        $this->Security->enabled = false; 
		$this->Security->validatePost = false; 	
        parent::beforeFilter();
    }
    public function add()
    {
        $this->pageTitle = __l('Add Product Survey');
        if ($this->request->is('post')) {
		if($this->request->data['ProductSurvey'][7]['answer1'] == 1 ||$this->request->data['ProductSurvey'][7]['answer2'] == 1 || $this->request->data['ProductSurvey'][7]['answer3'] == 1   ){
			unset($this->request->data['ProductSurvey'][8]);
		}
		 if(!empty($this->request->data['ProductSurvey'])){
			  $this->autoRender = false;
			  $this->layout = false;
			   $user_id = $this->Auth->user('id');
   			   $product_id = $this->request->data['OtherValue']['product_id'];
				   foreach($this->request->data['ProductSurvey'] as $key =>$productProfile){
							$this->ProductSurvey->create();
							$productResult = array();
							$productResult['ProductSurvey']['user_id'] = $user_id;
							$productResult['ProductSurvey']['product_id'] = $product_id;
							foreach($productProfile as $keyAnswer=>$productAnswer){
								$productResult['ProductSurvey'][$keyAnswer] = $productAnswer;
							}
						$this->ProductSurvey->save($productResult,false);
					}
					$this->ProductSurvey->User->updateAll(array(
					   'User.available_wonder_points' => 'User.available_wonder_points + '. $this->request->data['OtherValue']['wonder_point']
					) , array(
						'User.id' => $this->Auth->user('id') ,
					));
					$this->loadModel('Transaction');
					$wonderpoint = $this->request->data['OtherValue']['wonder_point'];
					$data['Transaction']['user_id'] = $user_id;
					$data['Transaction']['foreign_id'] = $product_id;
					$data['Transaction']['class'] = 'ProductSurvey';
					$data['Transaction']['wonder_points'] = $wonderpoint;
					$data['Transaction']['payment_gateway_id'] = ConstPaymentGateways::WonderPoint;
					$data['Transaction']['description'] = 'ProductSurvey';
					$data['Transaction']['gateway_fees'] = 0;
					$data['Transaction']['transaction_type_id'] = ConstTransactionTypes::ProductSurveryWonderPoint;
				    $transaction_id = $this->Transaction->log($data);
			}
			$user =	$this->ProductSurvey->User->find('first',array(
										'conditions'=> array(
											'User.id'=>$this->Auth->user('id') 
										),
										'fields'=> array(
										'User.available_wonder_points'
										),
									'recursive'=> -1
							));
			echo 'WonderPoints : '.$user['User']['available_wonder_points'];
			exit;
        }
        $beautyQuestions = $this->ProductSurvey->BeautyQuestion->find('list');
        $products = $this->ProductSurvey->Product->find('list');
        $users = $this->ProductSurvey->User->find('list');
        $this->set(compact('beautyQuestions', 'products', 'users'));
    }

    public function admin_index()
    {
        $this->pageTitle = __l('productSurveys');
        $this->ProductSurvey->recursive = 0;
	    $this->set('productSurveys', $this->paginate());
    }
	public function test(){
		$this->autoRender = false;
		$participants  = $this->ProductSurvey->find('all', array(
			'conditions'=> array(
				'ProductSurvey.beauty_question_id'=> 20
			),
            'recursive' => -1,
        ));
			echo "<pre>";
		foreach($participants as $participant){
			//print_r($participant);
					echo "<br/>";
			echo 'INSERT INTO `product_surveys` (`id`, `created`, `modified`, `beauty_question_id`, `question_no`, `product_id`, `user_id`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `answer6`, `answer7`, `answer8`, `answer9`, `answer10`, `answer11`, `answer12`, `other_answer`) VALUES';
	

			if($participant['ProductSurvey']['answer1'] == 1)		
			echo '(null,now(), now(), 20, 1, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 1, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer1'] == 2)		
			echo '(null,now(), now(), 20, 2, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 1, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer1'] == 3)		
			echo '(null,now(), now(), 20, 3, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 1, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer1'] == 4)		
			echo '(null,now(), now(), 20, 4, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 0, 1,0, 0, 0, 0, 0, 0, 0, 0, NULL);';	
			if($participant['ProductSurvey']['answer1'] == 5)		
			echo '(null,now(), now(), 20, 5, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 0, 0,1, 0, 0, 0, 0, 0, 0, 0, NULL);';
					echo "<br/>";
			echo 'INSERT INTO `product_surveys` (`id`, `created`, `modified`, `beauty_question_id`, `question_no`, `product_id`, `user_id`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `answer6`, `answer7`, `answer8`, `answer9`, `answer10`, `answer11`, `answer12`, `other_answer`) VALUES';
	
			if($participant['ProductSurvey']['answer2'] == 1)		
			echo '(null,now(), now(), 20, 1, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 1, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer2'] == 2)		
			echo '(null,now(), now(), 20, 2, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 1, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer2'] == 3)		
			echo '(null,now(), now(), 20, 3, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 1, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer2'] == 4)		
			echo '(null,now(), now(), 20, 4, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 0, 1,0, 0, 0, 0, 0, 0, 0, 0, NULL);';	
			if($participant['ProductSurvey']['answer2'] == 5)		
			echo '(null,now(), now(), 20, 5, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 0, 0,1, 0, 0, 0, 0, 0, 0, 0, NULL);';
			echo "<br/>";
	echo 'INSERT INTO `product_surveys` (`id`, `created`, `modified`, `beauty_question_id`, `question_no`, `product_id`, `user_id`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `answer6`, `answer7`, `answer8`, `answer9`, `answer10`, `answer11`, `answer12`, `other_answer`) VALUES';
			
			if($participant['ProductSurvey']['answer3'] == 1)		
			echo '(null,now(), now(), 20, 1, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 1, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer3'] == 2)		
			echo '(null,now(), now(), 20, 2, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 1, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer3'] == 3)		
			echo '(null,now(), now(), 20, 3, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 1, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer3'] == 4)		
			echo '(null,now(), now(), 20, 4, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 0, 1,0, 0, 0, 0, 0, 0, 0, 0, NULL);';	
			if($participant['ProductSurvey']['answer3'] == 5)		
			echo '(null,now(), now(), 20, 5, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 0, 0,1, 0, 0, 0, 0, 0, 0, 0, NULL);';
	echo "<br/>";
				echo 'INSERT INTO `product_surveys` (`id`, `created`, `modified`, `beauty_question_id`, `question_no`, `product_id`, `user_id`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `answer6`, `answer7`, `answer8`, `answer9`, `answer10`, `answer11`, `answer12`, `other_answer`) VALUES';
		
			if($participant['ProductSurvey']['answer4'] == 1)		
			echo '(null,now(), now(), 20, 1, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 1, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer4'] == 2)		
			echo '(null,now(), now(), 20, 2, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 1, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer4'] == 3)		
			echo '(null,now(), now(), 20, 3, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 1, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer4'] == 4)		
			echo '(null,now(), now(), 20, 4, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 0, 1,0, 0, 0, 0, 0, 0, 0, 0, NULL);';	
			if($participant['ProductSurvey']['answer4'] == 5)		
			echo '(null,now(), now(), 20, 5, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 0, 0,1, 0, 0, 0, 0, 0, 0, 0, NULL);';
				echo "<br/>";
		echo 'INSERT INTO `product_surveys` (`id`, `created`, `modified`, `beauty_question_id`, `question_no`, `product_id`, `user_id`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `answer6`, `answer7`, `answer8`, `answer9`, `answer10`, `answer11`, `answer12`, `other_answer`) VALUES';
		
			if($participant['ProductSurvey']['answer5'] == 1)		
			echo '(null,now(), now(), 20, 1, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 1, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer5'] == 2)		
			echo '(null,now(), now(), 20, 2, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 1, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer5'] == 3)		
			echo '(null,now(), now(), 20, 3, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 1, 0,0, 0, 0, 0, 0, 0, 0, 0, NULL);';
			if($participant['ProductSurvey']['answer5'] == 4)		
			echo '(null,now(), now(), 20, 4, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 0, 1,0, 0, 0, 0, 0, 0, 0, 0, NULL);';	
			if($participant['ProductSurvey']['answer5'] == 5)		
			echo '(null,now(), now(), 20, 5, '.$participant['ProductSurvey']['product_id'].','. $participant['ProductSurvey']['user_id'].', 0, 0, 0, 0,1, 0, 0, 0, 0, 0, 0, 0, NULL);';
			
			echo "<br/>";

		}
		echo "test";
		exit;
	}
   }
