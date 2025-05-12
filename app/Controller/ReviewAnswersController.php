<?php
App::uses('AppController', 'Controller');
/**
 * ReviewAnswers Controller
 *
 * @property ReviewAnswer $ReviewAnswer
 */
class ReviewAnswersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ReviewAnswer->recursive = 0;
		$this->set('reviewAnswers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ReviewAnswer->id = $id;
		if (!$this->ReviewAnswer->exists()) {
			throw new NotFoundException(__('Invalid review answer'));
		}
		$this->set('reviewAnswer', $this->ReviewAnswer->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ReviewAnswer->create();
			if ($this->ReviewAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The review answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review answer could not be saved. Please, try again.'));
			}
		}
		$reviews = $this->ReviewAnswer->Review->find('list');
		$this->set(compact('reviews'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ReviewAnswer->id = $id;
		if (!$this->ReviewAnswer->exists()) {
			throw new NotFoundException(__('Invalid review answer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ReviewAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The review answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review answer could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ReviewAnswer->read(null, $id);
		}
		$reviews = $this->ReviewAnswer->Review->find('list');
		$this->set(compact('reviews'));
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
		$this->ReviewAnswer->id = $id;
		if (!$this->ReviewAnswer->exists()) {
			throw new NotFoundException(__('Invalid review answer'));
		}
		if ($this->ReviewAnswer->delete()) {
			$this->Session->setFlash(__('Review answer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Review answer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
