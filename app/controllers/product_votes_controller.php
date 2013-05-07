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
    public function admin_index()
    {
        $this->pageTitle = __l('productVotes');
        $this->ProductVote->recursive = 0;
        $this->set('productVotes', $this->paginate());
    }
}
