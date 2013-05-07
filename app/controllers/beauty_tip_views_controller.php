<?php
class BeautyTipViewsController extends AppController
{
    public $name = 'BeautyTipViews';
    public function admin_index()
    {
        $this->pageTitle = __l('beautyTipViews');
        $this->BeautyTipView->recursive = 0;
        $this->set('beautyTipViews', $this->paginate());
    }
   
}
