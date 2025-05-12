<?php
App::uses('AppController', 'Controller');
/**
 * StudyRoutes Controller
 *
 * @property StudyRoute $StudyRoute
 */
class StudyRoutesController extends AppController {
	public function beforeFilter() {
        parent::beforeFilter();
        // $this->Auth->allow('*');
        $this->Auth->allow('routeslist');
    }

    public function routeslist() {
    	$this->loadModel('Route');
        $formdata = $this->Route->find('list', array(
            'fields' => array('Route.value', 'Route.name'),
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
	public function index() {
		$this->StudyRoute->recursive = 0;
		$this->set('studyRoutes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->StudyRoute->id = $id;
		if (!$this->StudyRoute->exists()) {
			throw new NotFoundException(__('Invalid study route'));
		}
		$this->set('studyRoute', $this->StudyRoute->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->StudyRoute->create();
			if ($this->StudyRoute->save($this->request->data)) {
				$this->Session->setFlash(__('The study route has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The study route could not be saved. Please, try again.'));
			}
		}
		$applications = $this->StudyRoute->Application->find('list');
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
		$this->StudyRoute->id = $id;
		if (!$this->StudyRoute->exists()) {
			throw new NotFoundException(__('Invalid study route'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->StudyRoute->save($this->request->data)) {
				$this->Session->setFlash(__('The study route has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The study route could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->StudyRoute->read(null, $id);
		}
		$applications = $this->StudyRoute->Application->find('list');
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
		$this->StudyRoute->id = $id;
		if (!$this->StudyRoute->exists()) {
			throw new NotFoundException(__('Invalid study route'));
		}
		if ($this->StudyRoute->delete()) {
			$this->Session->setFlash(__('Study route deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Study route was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
