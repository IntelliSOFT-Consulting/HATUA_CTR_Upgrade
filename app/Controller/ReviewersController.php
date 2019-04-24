<?php
App::uses('AppController', 'Controller');
/**
 * Reviewers Controller
 *
 * @property Reviewer $Reviewer
 */
class ReviewersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Reviewer->recursive = 0;
		$this->set('reviewers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Reviewer->id = $id;
		if (!$this->Reviewer->exists()) {
			throw new NotFoundException(__('Invalid reviewer'));
		}
		$this->set('reviewer', $this->Reviewer->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function manager_add($id = null) {
		if ($this->request->is('post')) {
			$this->Reviewer->create();
			foreach ($this->request->data as $key => $value) {
				$this->request->data[$key]['Reviewer']['application_id'] = $id;
				$this->request->data[$key]['Reviewer']['description'] = $this->request->data['Message']['text'];
			}
			unset($this->request->data['Message']);
			if ($this->Reviewer->saveMany($this->request->data)) {
				$this->Session->setFlash(__('The reviewers have been saved'), 'alerts/flash_success');
				$this->redirect(array('controller' => 'applications', 'action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The reviewer could not be saved. Please, try again.'));
			}
		}
		$users = $this->Reviewer->User->find('list');
		$applications = $this->Reviewer->Application->find('list');
		$this->set(compact('users', 'applications'));
	}

	public function reviewer_confirm($id = null) {
		$this->Reviewer->id = $id;
		if ($this->request->is('post')) {
			// $this->Reviewer->create();
			$this->Reviewer->saveField('accepted', $this->request->data['Reviewer']['accepted']);
			$this->redirect($this->referer());
		} else {
			$this->Session->setFlash('Invalid access', 'alerts/flash_error');
			$this->redirect('/');
		}
	}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Reviewer->id = $id;
		if (!$this->Reviewer->exists()) {
			throw new NotFoundException(__('Invalid reviewer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Reviewer->save($this->request->data)) {
				$this->Session->setFlash(__('The reviewer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reviewer could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Reviewer->read(null, $id);
		}
		$users = $this->Reviewer->User->find('list');
		$applications = $this->Reviewer->Application->find('list');
		$this->set(compact('users', 'applications'));
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
		$this->Reviewer->id = $id;
		if (!$this->Reviewer->exists()) {
			throw new NotFoundException(__('Invalid reviewer'));
		}
		if ($this->Reviewer->delete()) {
			$this->Session->setFlash(__('Reviewer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Reviewer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
