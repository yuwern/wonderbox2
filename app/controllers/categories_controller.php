<?php
class CategoriesController extends AppController
{
    public $name = 'Categories';
    public function admin_index()
    {
        $this->pageTitle = __l('Categories');
        $this->Category->recursive = 0;
        $this->set('categories', $this->paginate());
	 	$moreActions = $this->Category->moreActions;
	    $this->set(compact('moreActions'));  
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Category');
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__l('Category has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Category could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Category');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__l('Invalid category'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__l('Category has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Category could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->Category->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['Category']['name'];
      }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Category->delete($id)) {
            $this->Session->setFlash(__l('Category deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
