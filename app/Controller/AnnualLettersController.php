<?php
App::uses('AppController', 'Controller');
/**
 * AnnualLetters Controller
 *
 * @property AnnualLetter $AnnualLetter
 */
class AnnualLettersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AnnualLetter->recursive = 0;
		$this->set('AnnualLetters', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->AnnualLetter->id = $id;
		if (!$this->AnnualLetter->exists()) {
			throw new NotFoundException(__('Invalid annual approval letter'));
		}
		$this->set('AnnualLetter', $this->AnnualLetter->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AnnualLetter->create();
			if ($this->AnnualLetter->save($this->request->data)) {
				$this->Session->setFlash(__('The annual approval letter has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The annual approval letter could not be saved. Please, try again.'));
			}
		}
		$applications = $this->AnnualLetter->Application->find('list');
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
		$this->AnnualLetter->id = $id;
		if (!$this->AnnualLetter->exists()) {
			throw new NotFoundException(__('Invalid annual approval letter'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AnnualLetter->save($this->request->data)) {
				$this->Session->setFlash(__('The annual approval letter has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The annual approval letter could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->AnnualLetter->read(null, $id);
		}
		$applications = $this->AnnualLetter->Application->find('list');
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
		$this->AnnualLetter->id = $id;
		if (!$this->AnnualLetter->exists()) {
			throw new NotFoundException(__('Invalid annual approval letter'));
		}
		if ($this->AnnualLetter->delete()) {
			$this->Session->setFlash(__('annual approval letter deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('annual approval letter was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
