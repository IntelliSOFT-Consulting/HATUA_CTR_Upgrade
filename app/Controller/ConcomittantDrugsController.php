<?php
App::uses('AppController', 'Controller');
/**
 * ConcomittantDrugs Controller
 *
 * @property ConcomittantDrug $ConcomittantDrug
 */
class ConcomittantDrugsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ConcomittantDrug->recursive = 0;
		$this->set('concomittantDrugs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ConcomittantDrug->id = $id;
		if (!$this->ConcomittantDrug->exists()) {
			throw new NotFoundException(__('Invalid concomittant drug'));
		}
		$this->set('concomittantDrug', $this->ConcomittantDrug->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ConcomittantDrug->create();
			if ($this->ConcomittantDrug->save($this->request->data)) {
				$this->Session->setFlash(__('The concomittant drug has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The concomittant drug could not be saved. Please, try again.'));
			}
		}
		$saes = $this->ConcomittantDrug->Sae->find('list');
		$routes = $this->ConcomittantDrug->Route->find('list');
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
		$this->ConcomittantDrug->id = $id;
		if (!$this->ConcomittantDrug->exists()) {
			throw new NotFoundException(__('Invalid concomittant drug'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ConcomittantDrug->save($this->request->data)) {
				$this->Session->setFlash(__('The concomittant drug has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The concomittant drug could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ConcomittantDrug->read(null, $id);
		}
		$saes = $this->ConcomittantDrug->Sae->find('list');
		$routes = $this->ConcomittantDrug->Route->find('list');
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
		$this->ConcomittantDrug->id = $id;
		if (!$this->ConcomittantDrug->exists()) {
			throw new NotFoundException(__('Invalid concomittant drug'));
		}
		if ($this->ConcomittantDrug->delete()) {
			$this->Session->setFlash(__('Concomittant drug deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Concomittant drug was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
