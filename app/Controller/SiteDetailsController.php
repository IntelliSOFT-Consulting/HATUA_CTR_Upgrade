<?php
App::uses('AppController', 'Controller');
/**
 * SiteDetails Controller
 *
 * @property SiteDetail $SiteDetail
 */
class SiteDetailsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SiteDetail->recursive = 0;
		$this->set('siteDetails', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->SiteDetail->id = $id;
		if (!$this->SiteDetail->exists()) {
			throw new NotFoundException(__('Invalid site detail'));
		}
		$this->set('siteDetail', $this->SiteDetail->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SiteDetail->create();
			if ($this->SiteDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The site detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The site detail could not be saved. Please, try again.'));
			}
		}
		$applications = $this->SiteDetail->Application->find('list');
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
		$this->SiteDetail->id = $id;
		if (!$this->SiteDetail->exists()) {
			throw new NotFoundException(__('Invalid site detail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SiteDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The site detail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The site detail could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SiteDetail->read(null, $id);
		}
		$applications = $this->SiteDetail->Application->find('list');
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
		$this->SiteDetail->id = $id;
		if (!$this->SiteDetail->exists()) {
			throw new NotFoundException(__('Invalid site detail'));
		}
		if(!$this->SiteDetail->isOwnedBy($id, $this->Auth->user('id'))) {
			$this->set('message', 'You do not have permission to access this resource');
			$this->set('_serialize', 'message');
		} else {
			if ($this->SiteDetail->delete()) {
				$this->set('message', 'Site details deleted');
				$this->set('_serialize', 'message');
			} else {
				$this->set('message', 'Site details was not deleted');
				$this->set('_serialize', 'message');
			}
		}
	}
}
