<?php
App::uses('AppController', 'Controller');
/**
 * PreviousDates Controller
 *
 * @property PreviousDate $PreviousDate
 */
class PreviousDatesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PreviousDate->recursive = 0;
		$this->set('previousDates', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PreviousDate->id = $id;
		if (!$this->PreviousDate->exists()) {
			throw new NotFoundException(__('Invalid previous date'));
		}
		$this->set('previousDate', $this->PreviousDate->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PreviousDate->create();
			if ($this->PreviousDate->save($this->request->data)) {
				$this->Session->setFlash(__('The previous date has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The previous date could not be saved. Please, try again.'));
			}
		}
		$applications = $this->PreviousDate->Application->find('list');
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
		$this->PreviousDate->id = $id;
		if (!$this->PreviousDate->exists()) {
			throw new NotFoundException(__('Invalid previous date'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PreviousDate->save($this->request->data)) {
				$this->Session->setFlash(__('The previous date has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The previous date could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PreviousDate->read(null, $id);
		}
		$applications = $this->PreviousDate->Application->find('list');
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
		$this->PreviousDate->id = $id;
		if (!$this->PreviousDate->exists()) {
			throw new NotFoundException(__('Invalid previous date'));
		}
		if(!$this->PreviousDate->isOwnedBy($id, $this->Auth->user('id'))) {
			$this->set('message', 'You do not have permission to access this resource');
			$this->set('_serialize', 'message');
		} else {
			if ($this->PreviousDate->delete()) {
				$this->set('message', 'Previous ECCT date deleted');
				$this->set('_serialize', 'message');
			} else {
				$this->set('message', 'Previous date was not deleted');
				$this->set('_serialize', 'message');
			}
		}
	}
}
