<?php
App::uses('AppController', 'Controller');
/**
 * Reassignments Controller
 *
 * @property Reassignment $Reassignment
 */
class ReassignmentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Reassignment->recursive = 0;
		$this->set('reassignments', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Reassignment->id = $id;
		if (!$this->Reassignment->exists()) {
			throw new NotFoundException(__('Invalid reassignment'));
		}
		$this->set('reassignment', $this->Reassignment->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Reassignment->create();
			if ($this->Reassignment->save($this->request->data)) {
				$this->Session->setFlash(__('The reassignment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reassignment could not be saved. Please, try again.'));
			}
		}
		$applications = $this->Reassignment->Application->find('list');
		$this->set(compact('applications'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Reassignment->id = $id;
		if (!$this->Reassignment->exists()) {
			throw new NotFoundException(__('Invalid reassignment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Reassignment->save($this->request->data)) {
				$this->Session->setFlash(__('The reassignment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reassignment could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Reassignment->read(null, $id);
		}
		$applications = $this->Reassignment->Application->find('list');
		$this->set(compact('applications'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Reassignment->id = $id;
		if (!$this->Reassignment->exists()) {
			throw new NotFoundException(__('Invalid reassignment'));
		}
		if ($this->Reassignment->delete()) {
			$this->Session->setFlash(__('Reassignment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Reassignment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
