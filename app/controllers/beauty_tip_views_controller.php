<?php
class BeautyTipViewsController extends AppController
{
    public $name = 'BeautyTipViews';
    public function admin_index($slug = null)
    {
        $this->pageTitle = __l('beautyTipViews');
        $this->BeautyTipView->recursive = 0;
		$conditions = array();
		if(!empty($slug)) {
			$beautyTip = $this->BeautyTipView->BeautyTip->find('first', array(
						'conditions' => array(
							'BeautyTip.slug'=> $slug
						),
						'fields' => array(
							'BeautyTip.id'
						),
						'recursive' => -1
				)
				);
			$conditions['BeautyTipView.beauty_tip_id'] = $beautyTip['BeautyTip']['id'];
			
		}
		$this->paginate = array(
				'conditions' => $conditions,
				'contain' => array(
					'User' => array(
							'fields' => array(
								'User.email'
							)
					),
					'BeautyTip' => array(
						'fields' => array(
							'BeautyTip.id',
							'BeautyTip.name',
							'BeautyTip.brand_id',
							'BeautyTip.beauty_category_id',
						),
						'Category' => array(
							'fields' => array(
								'Category.name'
							)	
						),
						'BeautyCategory' => array(
							'fields' => array(
								'BeautyCategory.name'
							)
						),
						'Brand' => array(
							'fields' => array(
								'Brand.name'
							)
						)
					)
				)
			);
	       $this->set('beautyTipViews', $this->paginate());
    }
   
}
