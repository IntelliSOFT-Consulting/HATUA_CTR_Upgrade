<?php
App::uses('AppController', 'Controller');
/**
 * InvestigatorContacts Controller
 *
 * @property InvestigatorContact $InvestigatorContact
 */
class InvestigatorContactsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->InvestigatorContact->recursive = 0;
		$this->set('investigatorContacts', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->InvestigatorContact->id = $id;
		if (!$this->InvestigatorContact->exists()) {
			throw new NotFoundException(__('Invalid investigator contact'));
		}
		$this->set('investigatorContact', $this->InvestigatorContact->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InvestigatorContact->create();
			if ($this->InvestigatorContact->save($this->request->data)) {
				$this->Session->setFlash(__('The investigator contact has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The investigator contact could not be saved. Please, try again.'));
			}
		}
		$applications = $this->InvestigatorContact->Application->find('list');
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
		$this->InvestigatorContact->id = $id;
		if (!$this->InvestigatorContact->exists()) {
			throw new NotFoundException(__('Invalid investigator contact'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->InvestigatorContact->save($this->request->data)) {
				$this->Session->setFlash(__('The investigator contact has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The investigator contact could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->InvestigatorContact->read(null, $id);
		}
		$applications = $this->InvestigatorContact->Application->find('list');
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
		$this->InvestigatorContact->id = $id;
		if (!$this->InvestigatorContact->exists()) {
			throw new NotFoundException(__('Invalid investigator contact'));
		}
		if(!$this->InvestigatorContact->isOwnedBy($id, $this->Auth->user('id'))) {
			$this->set('message', 'You do not have permission to access this resource');
			$this->set('_serialize', 'message');
		} else {
			if ($this->InvestigatorContact->delete()) {
				$this->set('message', 'Investigator contact deleted');
				$this->set('_serialize', 'message');
			} else {
				$this->set('message', 'Investigator contact was not deleted');
				$this->set('_serialize', 'message');
			}
		}
	}
}
