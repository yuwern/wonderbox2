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
}
