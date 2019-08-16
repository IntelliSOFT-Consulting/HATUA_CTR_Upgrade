<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');
/**
 * Pharmacists Controller
 *
 * @property Pharmacist $Pharmacist
 */
class PharmacistsController extends AppController {

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('fetch');
    }

/**
 * fetch method
 *
 * @return void
 */
	public function fetch($regno = null) {
		$HttpSocket = new HttpSocket();
		// string query
		$response = $HttpSocket->get('https://rhris.pharmacyboardkenya.org/api_version/getPharmacist/'.$regno, '', array(
			'header' => array('Authorization' => 'qSMOuUlY0ra54]zQrrp30Gtwfm5PKyf4rY0&Q$W]$HSvSGdXu=MX')
			));
		$this->set('response', $response->body);
		$this->set('_serialize', 'response');

	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Pharmacist->recursive = 0;
		$this->set('pharmacists', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Pharmacist->id = $id;
		if (!$this->Pharmacist->exists()) {
			throw new NotFoundException(__('Invalid pharmacist'));
		}
		$this->set('pharmacist', $this->Pharmacist->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Pharmacist->create();
			if ($this->Pharmacist->save($this->request->data)) {
				$this->Session->setFlash(__('The pharmacist has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pharmacist could not be saved. Please, try again.'));
			}
		}
		$applications = $this->Pharmacist->Application->find('list');
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
		$this->Pharmacist->id = $id;
		if (!$this->Pharmacist->exists()) {
			throw new NotFoundException(__('Invalid pharmacist'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Pharmacist->save($this->request->data)) {
				$this->Session->setFlash(__('The pharmacist has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pharmacist could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Pharmacist->read(null, $id);
		}
		$applications = $this->Pharmacist->Application->find('list');
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
		$this->Pharmacist->id = $id;
		if (!$this->Pharmacist->exists()) {
			throw new NotFoundException(__('Invalid pharmacist'));
		}
		if ($this->Pharmacist->delete()) {
			$this->Session->setFlash(__('Pharmacist deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Pharmacist was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
