<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 */
class MessagesController extends AppController {
	public $paginate = array();
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Message->recursive = 0;
		$this->paginate['order'] = array('Message.created' => 'desc');
		$this->set('messages', $this->paginate());
		// pr($this->Message->find('list', array(
  //                                             'conditions' => array('Message.name' => array('reviewer_new_application')),
  //                                             'fields' => array('Message.name', 'Message.content'))));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->set('message', $this->Message->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The message has been saved'), 'alerts/flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message could not be saved. Please, try again.'), 'alerts/flash_error');
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
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The message has been saved'), 'alerts/flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		} else {
			$this->request->data = $this->Message->read(null, $id);
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
	// public function admin_delete($id = null) {
	// 	if (!$this->request->is('post')) {
	// 		throw new MethodNotAllowedException();
	// 	}
	// 	$this->Message->id = $id;
	// 	if (!$this->Message->exists()) {
	// 		throw new NotFoundException(__('Invalid message'));
	// 	}
	// 	if ($this->Message->delete()) {
	// 		$this->Session->setFlash(__('Message deleted'));
	// 		$this->redirect(array('action' => 'index'));
	// 	}
	// 	$this->Session->setFlash(__('Message was not deleted'));
	// 	$this->redirect(array('action' => 'index'));
	// }
}
