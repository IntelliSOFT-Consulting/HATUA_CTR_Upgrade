<?php
App::uses('AppController', 'Controller');
/**
 * SiteQuestions Controller
 *
 * @property SiteQuestion $SiteQuestion
 */
class SiteQuestionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->SiteQuestion->recursive = 0;
		$this->set('siteQuestions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->SiteQuestion->id = $id;
		if (!$this->SiteQuestion->exists()) {
			throw new NotFoundException(__('Invalid site question'));
		}
		$this->set('siteQuestion', $this->SiteQuestion->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SiteQuestion->create();
			if ($this->SiteQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The site question has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The site question could not be saved. Please, try again.'));
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
		$this->SiteQuestion->id = $id;
		if (!$this->SiteQuestion->exists()) {
			throw new NotFoundException(__('Invalid site question'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SiteQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The site question has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The site question could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SiteQuestion->read(null, $id);
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
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->SiteQuestion->id = $id;
		if (!$this->SiteQuestion->exists()) {
			throw new NotFoundException(__('Invalid site question'));
		}
		if ($this->SiteQuestion->delete()) {
			$this->Session->setFlash(__('Site question deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Site question was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
