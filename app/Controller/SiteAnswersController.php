<?php
App::uses('AppController', 'Controller');
/**
 * SiteAnswers Controller
 *
 * @property SiteAnswer $SiteAnswer
 */
class SiteAnswersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SiteAnswer->recursive = 0;
		$this->set('siteAnswers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->SiteAnswer->id = $id;
		if (!$this->SiteAnswer->exists()) {
			throw new NotFoundException(__('Invalid site answer'));
		}
		$this->set('siteAnswer', $this->SiteAnswer->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SiteAnswer->create();
			if ($this->SiteAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The site answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The site answer could not be saved. Please, try again.'));
			}
		}
		$siteInspections = $this->SiteAnswer->SiteInspection->find('list');
		$this->set(compact('siteInspections'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->SiteAnswer->id = $id;
		if (!$this->SiteAnswer->exists()) {
			throw new NotFoundException(__('Invalid site answer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SiteAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The site answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The site answer could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SiteAnswer->read(null, $id);
		}
		$siteInspections = $this->SiteAnswer->SiteInspection->find('list');
		$this->set(compact('siteInspections'));
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
		$this->SiteAnswer->id = $id;
		if (!$this->SiteAnswer->exists()) {
			throw new NotFoundException(__('Invalid site answer'));
		}
		if ($this->SiteAnswer->delete()) {
			$this->Session->setFlash(__('Site answer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Site answer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
