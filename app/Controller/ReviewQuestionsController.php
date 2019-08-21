<?php
App::uses('AppController', 'Controller');
/**
 * ReviewQuestions Controller
 *
 * @property ReviewQuestion $ReviewQuestion
 */
class ReviewQuestionsController extends AppController {

	public $paginate = array();
	
	public function beforeFilter() {
        parent::beforeFilter();
        // $this->Auth->allow('*');
        $this->Auth->allow('questions');
    }
/**
 * index method
 *
 * @return void
 */
    
    public function questions($type = null) {
        $formdata = $this->ReviewQuestion->find('all', array(
            'conditions' => array('ReviewQuestion.review_type' => $type),
            'recursive' => 0
        ));
        if ($this->request->is('requested')) {
            return $formdata;
        }
    }
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ReviewQuestion->recursive = 0;
		$this->paginate['order'] = array('ReviewQuestion.id' => 'desc');
		// $this->paginate['conditions'] = array('ReviewQuestion.review_type' => 'quality');
		$this->set('reviewQuestions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->ReviewQuestion->id = $id;
		if (!$this->ReviewQuestion->exists()) {
			throw new NotFoundException(__('Invalid review question'));
		}
		$this->set('reviewQuestion', $this->ReviewQuestion->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ReviewQuestion->create();
			if ($this->ReviewQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The review question has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review question could not be saved. Please, try again.'));
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
		$this->ReviewQuestion->id = $id;
		if (!$this->ReviewQuestion->exists()) {
			throw new NotFoundException(__('Invalid review question'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ReviewQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The review question has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review question could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ReviewQuestion->read(null, $id);
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
		$this->ReviewQuestion->id = $id;
		if (!$this->ReviewQuestion->exists()) {
			throw new NotFoundException(__('Invalid review question'));
		}
		if ($this->ReviewQuestion->delete()) {
			$this->Session->setFlash(__('Review question deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Review question was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
