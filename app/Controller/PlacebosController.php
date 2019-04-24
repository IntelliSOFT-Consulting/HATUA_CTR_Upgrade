<?php
App::uses('AppController', 'Controller');
/**
 * Placebos Controller
 *
 * @property Placebo $Placebo
 */
class PlacebosController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Placebo->recursive = 0;
		$this->set('placebos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Placebo->id = $id;
		if (!$this->Placebo->exists()) {
			throw new NotFoundException(__('Invalid placebo'));
		}
		$this->set('placebo', $this->Placebo->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Placebo->create();
			if ($this->Placebo->save($this->request->data)) {
				$this->Session->setFlash(__('The placebo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The placebo could not be saved. Please, try again.'));
			}
		}
		$applications = $this->Placebo->Application->find('list');
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
		$this->Placebo->id = $id;
		if (!$this->Placebo->exists()) {
			throw new NotFoundException(__('Invalid placebo'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Placebo->save($this->request->data)) {
				$this->Session->setFlash(__('The placebo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The placebo could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Placebo->read(null, $id);
		}
		$applications = $this->Placebo->Application->find('list');
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
		$this->Placebo->id = $id;
		if (!$this->Placebo->exists()) {
			throw new NotFoundException(__('Invalid placebo'));
		}
		if(!$this->Placebo->isOwnedBy($id, $this->Auth->user('id'))) {
			$this->set('message', 'You do not have permission to access this resource');
			$this->set('_serialize', 'message');
		} else {
			if ($this->Placebo->delete()) {
				$this->set('message', 'Placebo deleted');
				$this->set('_serialize', 'message');
			} else {
				$this->set('message', 'Placebo was not deleted');
				$this->set('_serialize', 'message');
			}
		}
	}
}
