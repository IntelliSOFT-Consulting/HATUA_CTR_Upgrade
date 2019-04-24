<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 */
class GroupsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->set('group', $this->Group->find('first', array('conditions' => array('Group.id' => $id), 'contain' => array())));
	}

/**
 * add method
 *
 * @return void
 */
	// public function add() {
	// 	if ($this->request->is('post')) {
	// 		$this->Group->create();
	// 		if ($this->Group->save($this->request->data)) {
	// 			$this->Session->setFlash(__('The group has been saved'));
	// 			$this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
	// 		}
	// 	}
	// }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The role has been saved'), 'alerts/flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The role could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		} else {
			$this->request->data = $this->Group->read(null, $id);
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
	// public function delete($id = null) {
	// 	if (!$this->request->is('post')) {
	// 		throw new MethodNotAllowedException();
	// 	}
	// 	$this->Group->id = $id;
	// 	if (!$this->Group->exists()) {
	// 		throw new NotFoundException(__('Invalid group'));
	// 	}
	// 	if ($this->Group->delete()) {
	// 		$this->Session->setFlash(__('Group deleted'));
	// 		$this->redirect(array('action' => 'index'));
	// 	}
	// 	$this->Session->setFlash(__('Group was not deleted'));
	// 	$this->redirect(array('action' => 'index'));
	// }
}
