<?php
App::uses('AppController', 'Controller');
/**
 * Pockets Controller
 *
 * @property Pocket $Pocket
 */
class PocketsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        // $this->Auth->allow('*');
        $this->Auth->allow('view', 'checklist');
    }
/**
 * index method
 *
 * @return void
 */
    public function admin_index() {
        $this->Pocket->recursive = 0;
        $this->paginate = array('conditions' => array('Pocket.type' => 'content'));
        $this->set('pockets', $this->paginate());
    }
    public function admin_cindex() {
        $this->Pocket->recursive = 0;
        $this->paginate = array('conditions' => array('Pocket.type' => 'annual'));
        $this->set('pockets', $this->paginate());
    }
    public function checklist() {
        $formdata = $this->Pocket->find('list', array(
            'fields' => array('Pocket.name', 'Pocket.content'),
            'conditions' => array('Pocket.type' => 'annual'),
            'recursive' => 0
        ));
        if ($this->request->is('requested')) {
            return $formdata;
        }
    }
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    
    public function view($id = null) {
        $this->Pocket->id = $id;
        if (!$this->Pocket->exists()) {
            throw new NotFoundException(__('Invalid pocket'));
        }
        $pocket = $this->Pocket->read(null, $id);
        $this->set('pocket');
        if ($this->request->is('requested')) {
            return $pocket;
        }
    }

/**
 * add method
 *
 * @return void
 */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Pocket->create();
            if ($this->Pocket->save($this->request->data)) {
                $this->Session->setFlash(__('The pocket has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The pocket could not be saved. Please, try again.'));
            }
        }
    }
    public function admin_cadd() {
        if ($this->request->is('post')) {
            $this->Pocket->create();
            if ($this->Pocket->save($this->request->data)) {
                $this->Session->setFlash(__('The pocket has been saved'));
                $this->redirect(array('action' => 'cindex'));
            } else {
                $this->Session->setFlash(__('The pocket could not be saved. Please, try again.'));
            }
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_edit($id = null) {
        $this->Pocket->id = $id;
        if (!$this->Pocket->exists()) {
            throw new NotFoundException(__('Invalid pocket'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Pocket->save($this->request->data)) {
                $this->Session->setFlash(__('The pocket has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The pocket could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Pocket->read(null, $id);
        }
    }
    public function admin_cedit($id = null) {
        $this->Pocket->id = $id;
        if (!$this->Pocket->exists()) {
            throw new NotFoundException(__('Invalid pocket'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Pocket->save($this->request->data)) {
                $this->Session->setFlash(__('The pocket has been saved'));
                $this->redirect(array('action' => 'cindex'));
            } else {
                $this->Session->setFlash(__('The pocket could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Pocket->read(null, $id);
        }
    }

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Pocket->id = $id;
        if (!$this->Pocket->exists()) {
            throw new NotFoundException(__('Invalid pocket'));
        }
        if ($this->Pocket->delete()) {
            $this->Session->setFlash(__('Pocket deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Pocket was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
