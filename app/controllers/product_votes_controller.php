<?php
class ProductVotesController extends AppController
{
    public $name = 'ProductVotes';
    public function add()
    {
        $this->pageTitle = __l('Add Product Vote');
		$this->autoRender = false;
        if ($this->request->is('post')) {
		
			$this->request->data['ProductVote']['user_id'] = $this->Auth->user('id');
			$this->request->data['ProductVote']['product_slug'] = $_REQUEST['product_slug'];
			$this->request->data['ProductVote']['product_question_id'] = $_REQUEST['product_question_id'];
			$this->request->data['ProductVote']['answer'] = $_REQUEST['answer'];
			$product = $this->ProductVote->Product->find('first',array(
								'conditions' => array(
									'Product.slug' => $this->request->data['ProductVote']['product_slug'],
								),
								'fields' => array(
									'Product.id'
								),
								'recursive'=> -1
				)
			);
			$this->request->data['ProductVote']['product_id'] = $product['Product']['id'];
			$productVote = $this->ProductVote->find('first',array(
								'conditions' => array(
									'ProductVote.user_id' => $this->Auth->user('id'),
									'ProductVote.product_id' => $this->request->data['ProductVote']['product_id'],
									'ProductVote.product_question_id' => $this->request->data['ProductVote']['product_question_id'],
								),
								'fields' => array(
									'ProductVote.id'
								),
								'recursive'=> -1
				)
				);
			if(!empty($productVote))
			$this->request->data['ProductVote']['id'] = $productVote['ProductVote']['id'];
			else
	        $this->ProductVote->create();
			$this->ProductVote->save($this->request->data);
			echo "success";
		
		}
		exit;
    }
    public function admin_index($slug= null)
    {
		$conditions = array();
		if(!empty($slug)) {
			$product = $this->ProductVote->Product->find('first', array(
						'conditions' => array(
							'Product.slug'=> $slug
						),
						'fields' => array(
							'Product.id'
						),
						'recursive' => -1
				)
				);
			$conditions['ProductVote.product_id'] = $product['Product']['id'];
			
		}
        $this->pageTitle = __l('productVotes');
        $this->ProductVote->recursive = 0;
        $this->set('productVotes', $this->paginate());
    }
    public function admin_chart($slug = null)
    {
		$conditions = array();
		  if (is_null($slug)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		if(!empty($slug)) {
			$product = $this->ProductVote->Product->find('first', array(
						'conditions' => array(
							'Product.slug'=> $slug
						),
						'fields' => array(
							'Product.id',
							'Product.name',
						),
						'recursive' => -1
				)
				);
			$conditions['ProductVote.product_id'] = $product['Product']['id'];
			$this->set('product',$product);
		}
		$productQuestions = $this->ProductVote->ProductQuestion->find('all', array(
										'fields' => array(
											'ProductQuestion.name',
											'ProductQuestion.id'
										),
										'recursive' => -1
			)
		);
	    $productVotes = array();
		foreach($productQuestions as $key => $productQuestion){
			$productVotes[$key]['Question'] = $productQuestion['ProductQuestion']['name'];
			$productVotes[$key]['Answer']['yes'] = $this->ProductVote->find('count', array(
							'conditions' => array(
								'ProductVote.product_id' => $product['Product']['id'],
								'ProductVote.product_question_id' => $productQuestion['ProductQuestion']['id'],
								'ProductVote.answer' => 1,
								
							),
							'recursive' => - 1
					)
			);
			$productVotes[$key]['Answer']['no'] = $this->ProductVote->find('count', array(
							'conditions' => array(
								'ProductVote.product_id' => $product['Product']['id'],
								'ProductVote.product_question_id' => $productQuestion['ProductQuestion']['id'],
								'ProductVote.answer' => 0,
								
							),
							'recursive' => - 1
					)
			);
		}
        $this->set('productVotes', $productVotes);
    }
}
