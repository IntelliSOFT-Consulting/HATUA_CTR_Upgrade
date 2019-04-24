<?php
App::uses('AppController', 'Controller');
/**
 * Feedbacks Controller
 *
 * @property Feedback $Feedback
 */
class FeedbacksController extends AppController {

	public $paginate = array('order' => array('Feedback.created' => 'desc'));
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add');
	}

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Feedback->recursive = 0;
		$this->set('feedbacks', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Feedback->id = $id;
		if (!$this->Feedback->exists()) {
			throw new NotFoundException(__('Invalid feedback'));
		}
		$this->set('feedback', $this->Feedback->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$previous_messages = array();
		if($this->Auth->User('id')) {
			// $this->helpers[] = 'Text';
			$this->request->data['Feedback']['user_id'] = $this->Auth->User('id');
			$this->Feedback->recursive = -1;
			$this->paginate['conditions'] = array('user_id' => $this->Auth->User('id'));
			$this->paginate['limit'] = 5;
			// $previous_messages = $this->Feedback->find('all', array('conditions' => array('id' => $this->Auth->User('id'))));
			$previous_messages = $this->paginate();

		}
		if ($this->request->is('post')) {
			$this->Feedback->create();
			// if($this->Auth->User('id')) $this->request->data['Feedback']['user_id'] = $this->Auth->User('id');
			if (empty($this->data['Feedback']['bot_stop']) && $this->Feedback->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback has been saved'), 'alerts/flash_success');
				$this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('Your feedback could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		}
		$this->set('previous_messages', $previous_messages);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Feedback->id = $id;
		if (!$this->Feedback->exists()) {
			throw new NotFoundException(__('Invalid feedback'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Feedback->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback has been saved'));
				$this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The feedback could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Feedback->read(null, $id);
		}
		$users = $this->Feedback->User->find('list');
		$this->set(compact('users'));
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
		$this->Feedback->id = $id;
		if (!$this->Feedback->exists()) {
			throw new NotFoundException(__('Invalid feedback'));
		}
		if ($this->Feedback->delete()) {
			$this->Session->setFlash(__('Feedback deleted'), 'alerts/flash_success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Feedback was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
