<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {


/**
 * manager_index method
 *
 * @return void
 */
    public function manager_index() {
        $this->Comment->recursive = 0;
        $this->set('comments', $this->paginate());
    }

/**
 * manager_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function manager_view($id = null) {
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException(__('Invalid comment'));
        }
        $this->set('comment', $this->Comment->read(null, $id));
    }

/**
 * manager_add method
 *
 * @return void
 */
    public function manager_add_si_internal() {
        if ($this->request->is('post')) {
            $this->Comment->create();
            if ($this->Comment->saveAssociated($this->request->data, array('deep' => true))) {
                $this->Session->setFlash(__('The comment has been saved'), 'alerts/flash_success');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
                $this->redirect($this->referer());
            }
        }
        $users = $this->Comment->User->find('list');
        $this->set(compact('users'));
    }
    public function manager_add_si_external() {
        if ($this->request->is('post')) {
            $this->Comment->create();
            if ($this->Comment->saveAssociated($this->request->data, array('deep' => true))) {
                $this->Session->setFlash(__('The comment has been saved'), 'alerts/flash_success');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
                $this->redirect($this->referer());
            }
        }
        $users = $this->Comment->User->find('list');
        $this->set(compact('users'));
    }

/**
 * manager_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function manager_edit($id = null) {
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException(__('Invalid comment'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash(__('The comment has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Comment->read(null, $id);
        }
        $users = $this->Comment->User->find('list');
        $this->set(compact('users'));
    }

/**
 * manager_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function manager_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException(__('Invalid comment'));
        }
        if ($this->Comment->delete()) {
            $this->Session->setFlash(__('Comment deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Comment was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
