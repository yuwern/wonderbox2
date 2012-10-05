<?php
class BeautyCategoriesController extends AppController
{
    public $name = 'BeautyCategories';
    public function admin_index()
    {
        $this->pageTitle = __l('beautyCategories');
        $this->BeautyCategory->recursive = 0;
        $this->set('beautyCategories', $this->paginate());
    }
    public function admin_view($slug = null)
    {
        $this->pageTitle = __l('Beauty Category');
        $this->BeautyCategory->slug = $slug;
        if (!$this->BeautyCategory->exists()) {
            throw new NotFoundException(__l('Invalid beauty category'));
        }
        $beautyCategory = $this->BeautyCategory->find('first', array(
            'conditions' => array(
                'BeautyCategory.slug = ' => $slug
            ) ,
            'fields' => array(
                'BeautyCategory.id',
                'BeautyCategory.created',
                'BeautyCategory.modified',
                'BeautyCategory.name',
                'BeautyCategory.slug',
                'BeautyCategory.is_active',
            ) ,
            'recursive' => - 1,
        ));
        if (empty($beautyCategory)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle.= ' - ' . $beautyCategory['BeautyCategory']['name'];
        $this->set('beautyCategory', $beautyCategory);
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Beauty Category');
        if ($this->request->is('post')) {
            $this->BeautyCategory->create();
            if ($this->BeautyCategory->save($this->request->data)) {
                $this->Session->setFlash(__l('beauty category has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('beauty category could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Beauty Category');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->BeautyCategory->id = $id;
        if (!$this->BeautyCategory->exists()) {
            throw new NotFoundException(__l('Invalid beauty category'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->BeautyCategory->save($this->request->data)) {
                $this->Session->setFlash(__l('beauty category has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('beauty category could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->BeautyCategory->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['BeautyCategory']['name'];
    }
	public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->BeautyCategory->delete($id)) {
            $this->Session->setFlash(__l('Brand deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
