<?php
App::uses('AppController', 'Controller');
/**
 * SuspectedDrugs Controller
 *
 * @property SuspectedDrug $SuspectedDrug
 */
class SuspectedDrugsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SuspectedDrug->recursive = 0;
		$this->set('suspectedDrugs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->SuspectedDrug->id = $id;
		if (!$this->SuspectedDrug->exists()) {
			throw new NotFoundException(__('Invalid suspected drug'));
		}
		$this->set('suspectedDrug', $this->SuspectedDrug->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SuspectedDrug->create();
			if ($this->SuspectedDrug->save($this->request->data)) {
				$this->Session->setFlash(__('The suspected drug has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The suspected drug could not be saved. Please, try again.'));
			}
		}
		$saes = $this->SuspectedDrug->Sae->find('list');
		$routes = $this->SuspectedDrug->Route->find('list');
		$this->set(compact('saes', 'routes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->SuspectedDrug->id = $id;
		if (!$this->SuspectedDrug->exists()) {
			throw new NotFoundException(__('Invalid suspected drug'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SuspectedDrug->save($this->request->data)) {
				$this->Session->setFlash(__('The suspected drug has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The suspected drug could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SuspectedDrug->read(null, $id);
		}
		$saes = $this->SuspectedDrug->Sae->find('list');
		$routes = $this->SuspectedDrug->Route->find('list');
		$this->set(compact('saes', 'routes'));
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
		$this->SuspectedDrug->id = $id;
		if (!$this->SuspectedDrug->exists()) {
			throw new NotFoundException(__('Invalid suspected drug'));
		}
		if ($this->SuspectedDrug->delete()) {
			$this->Session->setFlash(__('Suspected drug deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Suspected drug was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
