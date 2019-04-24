<?php
App::uses('AppController', 'Controller');
/**
 * TrialStatuses Controller
 *
 * @property TrialStatus $TrialStatus
 */
class TrialStatusesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'index', 'edit');
	}
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->TrialStatus->recursive = 0;
		$this->set('trialStatuses', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->TrialStatus->id = $id;
		if (!$this->TrialStatus->exists()) {
			throw new NotFoundException(__('Invalid trial status'));
		}
		$this->set('trialStatus', $this->TrialStatus->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->TrialStatus->create();
			if ($this->TrialStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The trial status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trial status could not be saved. Please, try again.'));
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
		$this->TrialStatus->id = $id;
		if (!$this->TrialStatus->exists()) {
			throw new NotFoundException(__('Invalid trial status'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TrialStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The trial status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trial status could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TrialStatus->read(null, $id);
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
		$this->TrialStatus->id = $id;
		if (!$this->TrialStatus->exists()) {
			throw new NotFoundException(__('Invalid trial status'));
		}
		if ($this->TrialStatus->delete()) {
			$this->Session->setFlash(__('Trial status deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Trial status was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
