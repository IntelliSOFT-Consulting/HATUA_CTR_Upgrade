<?php
App::uses('AppController', 'Controller');
/**
 * Counties Controller
 *
 * @property County $County
 */
class CountiesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->County->recursive = 0;
		$this->set('counties', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->County->id = $id;
		if (!$this->County->exists()) {
			throw new NotFoundException(__('Invalid county'));
		}
		$this->set('county', $this->County->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->County->create();
			if ($this->County->save($this->request->data)) {
				$this->Session->setFlash(__('The county has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The county could not be saved. Please, try again.'));
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
		$this->County->id = $id;
		if (!$this->County->exists()) {
			throw new NotFoundException(__('Invalid county'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->County->save($this->request->data)) {
				$this->Session->setFlash(__('The county has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The county could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->County->read(null, $id);
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
		$this->County->id = $id;
		if (!$this->County->exists()) {
			throw new NotFoundException(__('Invalid county'));
		}
		if ($this->County->delete()) {
			$this->Session->setFlash(__('County deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('County was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
