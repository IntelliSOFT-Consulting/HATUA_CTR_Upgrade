<?php
App::uses('AppController', 'Controller');
/**
 * Sponsors Controller
 *
 * @property Sponsor $Sponsor
 */
class SponsorsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sponsor->recursive = 0;
		$this->set('sponsors', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		$this->set('sponsor', $this->Sponsor->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Sponsor->create();
			if ($this->Sponsor->save($this->request->data)) {
				$this->Session->setFlash(__('The sponsor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sponsor could not be saved. Please, try again.'));
			}
		}
		$applications = $this->Sponsor->Application->find('list');
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
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Sponsor->save($this->request->data)) {
				$this->Session->setFlash(__('The sponsor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sponsor could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Sponsor->read(null, $id);
		}
		$applications = $this->Sponsor->Application->find('list');
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
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		if(!$this->Sponsor->isOwnedBy($id, $this->Auth->user('id'))) {
			$this->set('message', 'You do not have permission to access this resource');
			$this->set('_serialize', 'message');
		} else {
			if ($this->Sponsor->delete()) {
				$this->set('message', 'Sponsor deleted');
				$this->set('_serialize', 'message');
			} else {
				$this->set('message', 'Sponsor was not deleted');
				$$this->set('_serialize', 'message');
			}
		}
	}
}
