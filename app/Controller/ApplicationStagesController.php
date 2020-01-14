<?php
App::uses('AppController', 'Controller');
App::uses('ThemeView', 'View');
App::uses('HtmlHelper', 'View/Helper');
/**
 * ApplicationStages Controller
 *
 * @property ApplicationStage $ApplicationStage
 */
class ApplicationStagesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ApplicationStage->recursive = 0;
		$this->set('applicationStages', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ApplicationStage->id = $id;
		if (!$this->ApplicationStage->exists()) {
			throw new NotFoundException(__('Invalid application stage'));
		}
		$this->set('applicationStage', $this->ApplicationStage->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ApplicationStage->create();
			if ($this->ApplicationStage->save($this->request->data)) {
				$this->Session->setFlash(__('The application stage has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The application stage could not be saved. Please, try again.'));
			}
		}
		$applications = $this->ApplicationStage->Application->find('list');
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
		$this->ApplicationStage->id = $id;
		if (!$this->ApplicationStage->exists()) {
			throw new NotFoundException(__('Invalid application stage'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ApplicationStage->save($this->request->data)) {
				$this->Session->setFlash(__('The application stage has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The application stage could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ApplicationStage->read(null, $id);
		}
		$applications = $this->ApplicationStage->Application->find('list');
		$this->set(compact('applications'));
	}

	public function manager_complete_screening($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->ApplicationStage->id = $id;
        if (!$this->ApplicationStage->exists()) {
            throw new NotFoundException(__('Invalid Application Stage'), 'alerts/flash_error');
        }

        $stage = $this->ApplicationStage->read(null, $id);
        // $this->ApplicationStage->set(array(
        //                   'status' => 'Complete',
        //                   'comment' => 'Manager close screening',
        //                   'end_date' => date('Y-m-d')
        // ));
        $this->ApplicationStage->set('status', 'Complete');
        $this->ApplicationStage->set('comment', 'Manager close screening');
        if(empty($stage['ApplicationStage']['end_date'])) $this->ApplicationStage->set('end_date', date('Y-m-d'));

        
        if ($this->ApplicationStage->save()) {
        	// $this->ApplicationStage->saveField('end_date', date('Y-m-d'));

        	//Create ScreeningSubmission stage if not exists first or complete if existed
        	$ssu = $this->ApplicationStage->find('first', array(
                      'contain' => array(),
                      'conditions' => array('ApplicationStage.application_id' => $stage['ApplicationStage']['application_id'], 'ApplicationStage.stage' => 'ScreeningSubmission')
                  ));
        	if(empty($ssu)) {
        		$this->ApplicationStage->create();
				$this->ApplicationStage->save(array('ApplicationStage' => array(
						'application_id' => $stage['ApplicationStage']['application_id'],
						'stage' => 'ScreeningSubmission',
						'status' => 'Complete',
						'comment' => 'Direct confirmation',
						'start_date' => date('Y-m-d'),
						'end_date' => date('Y-m-d'),
						))
				);
        	} else {
        		$this->ApplicationStage->create();
        		$ssu['ApplicationStage']['status'] = 'Complete';
        		$ssu['ApplicationStage']['comment'] = 'Manager direct complete';
        		$ssu['ApplicationStage']['end_date'] = date('Y-m-d');
				$this->ApplicationStage->save($ssu);
        	}

        	//Create new assign stage.
        	$this->ApplicationStage->create();
			$this->ApplicationStage->save(array('ApplicationStage' => array(
					'application_id' => $stage['ApplicationStage']['application_id'],
					'stage' => 'Assign',
					'status' => 'Start',
					'start_date' => date('Y-m-d')
					))
			);

            $this->Session->setFlash(__('Screening completed'), 'alerts/flash_success');

            //******************       Send Email and Notifications to Applicant and Managers          *****************************
	              $this->loadModel('Message');
	              $html = new HtmlHelper(new ThemeView());
	              $message = $this->Message->find('first', array('conditions' => array('name' => 'screening_feedback')));
	              $this->loadModel('Application');
	              $app = $this->Application->find('first', array(
	                  'contain' => array(),
	                  'conditions' => array('Application.id' => $stage['ApplicationStage']['application_id'])
	              ));

	              $users = $this->Application->User->find('all', array(
	                  'contain' => array(),
	                  'conditions' => array('OR' => array('User.id' => $app['Application']['user_id'], 'User.group_id' => 2))
	              ));
	              foreach ($users as $user) {
	                  $actioner = ($user['User']['group_id'] == 2) ? 'manager' : 'applicant';
	                  $variables = array(
	                    'name' => $user['User']['name'], 'protocol_no' => $app['Application']['protocol_no'], 
	                    'comment_subject' => 'Completed screening process',
	                    'comment_content' => 'Screening process has been successfully completed.',
	                    'reference_link' => $html->link($app['Application']['protocol_no'], array('controller' => 'applications', 'action' => 'view', $app['Application']['id'],
	                        'deviation_edit' => $app['Application']['id'], $actioner => true, 'full_base' => true), 
	                      array('escape' => false)),
	                  );
	                  $datum = array(
	                    'email' => $user['User']['email'],
	                    'id' => $stage['ApplicationStage']['id'], 'user_id' => $user['User']['id'], 'type' => 'screening_feedback', 'model' => 'Application',
	                    'subject' => String::insert($message['Message']['subject'], $variables),
	                    'message' => String::insert($message['Message']['content'], $variables)
	                  );
	                  CakeResque::enqueue('default', 'GenericEmailShell', array('sendEmail', $datum));
	                  CakeResque::enqueue('default', 'GenericNotificationShell', array('sendNotification', $datum));
	              }
            //**********************************    END   *********************************

            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Screening not completed'), 'alerts/flash_error');
        $this->redirect($this->referer());
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
		$this->ApplicationStage->id = $id;
		if (!$this->ApplicationStage->exists()) {
			throw new NotFoundException(__('Invalid application stage'));
		}
		if ($this->ApplicationStage->delete()) {
			$this->Session->setFlash(__('Application stage deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Application stage was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
