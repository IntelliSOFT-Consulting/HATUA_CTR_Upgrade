<?php
App::uses('AppController', 'Controller');
/**
 * SiteInspections Controller
 *
 * @property SiteInspection $SiteInspection
 */
class SiteInspectionsController extends AppController {

    public $uses = array('SiteInspection', 'Application', 'SiteQuestion');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SiteInspection->recursive = 0;
		$this->set('siteInspections', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->SiteInspection->id = $id;
		if (!$this->SiteInspection->exists()) {
			throw new NotFoundException(__('Invalid site inspection'));
		}
		$this->set('siteInspection', $this->SiteInspection->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function manager_add($application_id = null) {
		// if ($this->request->is('post')) {
			$this->SiteInspection->create();
			// $application = $this->SiteInspection->Application->read(null, $application_id);
			$application = $this->Application->find('first', array(
		        'conditions' => array('Application.id' => $application_id)
		    ));
			$all_questions = $this->SiteQuestion->find('all');
			$answers = [];
			foreach ($all_questions as $question) {
				$dpoint = ['question_type' => $question['SiteQuestion']['question_type'], 'question_number' => $question['SiteQuestion']['question_number'], 
						   'question' => $question['SiteQuestion']['question']];
				$answers[] = $dpoint;
			}
			$data = array('application_id' => $application_id, 'study_title' => $application['Application']['study_title'], 'protocol_no' => $application['Application']['protocol_no']);
			if ($this->SiteInspection->saveAssociated(array('SiteInspection' => $data, 'SiteAnswer' => $answers))) {
				$this->Session->setFlash(__('The site inspection has been saved'), 'alerts/flash_success');
				$this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id));
			} else {
				$this->Session->setFlash(__('The site inspection could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		// }
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->SiteInspection->id = $id;
		if (!$this->SiteInspection->exists()) {
			throw new NotFoundException(__('Invalid site inspection'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SiteInspection->save($this->request->data)) {
				$this->Session->setFlash(__('The site inspection has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The site inspection could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SiteInspection->read(null, $id);
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
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->SiteInspection->id = $id;
		if (!$this->SiteInspection->exists()) {
			throw new NotFoundException(__('Invalid site inspection'));
		}
		if ($this->SiteInspection->delete()) {
			$this->Session->setFlash(__('Site inspection deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Site inspection was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
