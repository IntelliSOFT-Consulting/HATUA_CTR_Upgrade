<?php
App::uses('AppController', 'Controller');
/**
 * EthicalCommittees Controller
 *
 * @property EthicalCommittee $EthicalCommittee
 */
class EthicalCommitteesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EthicalCommittee->recursive = 0;
		$this->set('ethicalCommittees', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->EthicalCommittee->id = $id;
		if (!$this->EthicalCommittee->exists()) {
			throw new NotFoundException(__('Invalid ethical committee'));
		}
		$this->set('ethicalCommittee', $this->EthicalCommittee->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EthicalCommittee->create();
			if ($this->EthicalCommittee->save($this->request->data)) {
				$this->Session->setFlash(__('The ethical committee has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ethical committee could not be saved. Please, try again.'));
			}
		}
		$applications = $this->EthicalCommittee->Application->find('list');
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
		$this->EthicalCommittee->id = $id;
		if (!$this->EthicalCommittee->exists()) {
			throw new NotFoundException(__('Invalid ethical committee'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->EthicalCommittee->save($this->request->data)) {
				$this->Session->setFlash(__('The ethical committee has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ethical committee could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->EthicalCommittee->read(null, $id);
		}
		$applications = $this->EthicalCommittee->Application->find('list');
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
		$this->EthicalCommittee->id = $id;
		if (!$this->EthicalCommittee->exists()) {
			throw new NotFoundException(__('Invalid ethical committee'));
		}
		if ($this->EthicalCommittee->delete()) {
			$this->Session->setFlash(__('Ethical committee deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ethical committee was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
