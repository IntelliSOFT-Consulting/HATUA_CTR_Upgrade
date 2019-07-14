<?php
App::uses('AppController', 'Controller');
/**
 * Budgets Controller
 *
 * @property Budget $Budget
 */
class BudgetsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Budget->recursive = 0;
		$this->set('budgets', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Budget->id = $id;
		if (!$this->Budget->exists()) {
			throw new NotFoundException(__('Invalid budget'));
		}
		$this->set('budget', $this->Budget->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function applicant_add() {
		if ($this->request->is('post')) {
			$this->Budget->create();
			if ($this->Budget->save($this->request->data)) {
				$this->Session->setFlash(__('The budget has been saved'), 'alerts/flash_success');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The budget could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		}
		$this->redirect($this->referer());
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Budget->id = $id;
		if (!$this->Budget->exists()) {
			throw new NotFoundException(__('Invalid budget'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Budget->save($this->request->data)) {
				$this->Session->setFlash(__('The budget has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The budget could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Budget->read(null, $id);
		}
		$applications = $this->Budget->Application->find('list');
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
		$this->Budget->id = $id;
		if (!$this->Budget->exists()) {
			throw new NotFoundException(__('Invalid budget'));
		}
		if ($this->Budget->delete()) {
			$this->Session->setFlash(__('Budget deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Budget was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
