<?php
App::uses('AppController', 'Controller');
App::uses('String', 'Utility');
App::uses('ThemeView', 'View');
App::uses('HtmlHelper', 'View/Helper');
App::uses('Sanitize', 'Utility');

/**
 * MeetingDates Controller
 *
 * @property MeetingDate $MeetingDate
 */
class MeetingDatesController extends AppController {

    public $paginate = array();
    public $components = array('Search.Prg');
    public $presetVars = true; // using the model configuration

    public function beforeFilter() {
        parent::beforeFilter();
        // $this->Auth->allow('index', 'view', 'view.pdf');
    }
/**
 * index method
 *
 * @return void
 */
    // public function applicant_index() {
    //     $this->MeetingDate->recursive = 0;
    //     $this->set('meetingDates', $this->paginate());
    // }
    public function applicant_index() {

        $this->Prg->commonProcess();
        $page_options = array('25' => '25', '20' => '20');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

        $criteria = $this->MeetingDate->parseCriteria($this->passedArgs);
        $criteria['MeetingDate.user_id'] = $this->Auth->User('id');
        $this->paginate['conditions'] = $criteria;
        $this->paginate['order'] = array('MeetingDate.created' => 'desc');

        //in case of csv export
        if (isset($this->request->params['ext']) && $this->request->params['ext'] == 'csv') {
          $this->csv_export($this->MeetingDate->find('all', 
                  array('conditions' => $this->paginate['conditions'], 'order' => $this->paginate['order'])
              ));
        }
        //end pdf export
        $this->set('page_options', $page_options);
        $this->set('meetingDates', Sanitize::clean($this->paginate(), array('encode' => false)));
    }
    public function index() {
        
        $this->Prg->commonProcess();
        $page_options = array('25' => '25', '20' => '20');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

        $criteria = $this->MeetingDate->parseCriteria($this->passedArgs);
        if (!isset($this->passedArgs['approved'])) $criteria['MeetingDate.approved'] = array(0, 1, 2);
        $this->paginate['conditions'] = $criteria;
        $this->paginate['order'] = array('MeetingDate.created' => 'desc');
        //in case of csv export
        if (isset($this->request->params['ext']) && $this->request->params['ext'] == 'csv') {
          $this->csv_export($this->MeetingDate->find('all', 
                  array('conditions' => $this->paginate['conditions'], 'order' => $this->paginate['order'])
              ));
        }
        //end pdf export

        $this->set('page_options', $page_options);
        $this->set('meetingDates', Sanitize::clean($this->paginate(), array('encode' => false)));
    }
    public function manager_index() {
        $this->index();
    }
    public function reviewer_index() {
        $this->index();
    }
	/*public function index() {
		$this->MeetingDate->recursive = 0;
		$this->set('meetingDates', $this->paginate());
	}*/
    private function csv_export($meetingDates = '') {
        $_serialize = 'meetingDates';
        $_header = array('First Date.', 'Second Date', 'Email', 'Final Decision', 'Created');
        $_extract = array('MeetingDate.proposed_date2' , 'MeetingDate.proposed_date2', 'MeetingDate.email', 'MeetingDate.final_decision', 'MeetingDate.created');

        $this->response->download('MEETING_DATEs_'.date('Ymd_Hi').'.csv'); // <= setting the file name
        $this->viewClass = 'CsvView.Csv';
        $this->set(compact('meetingDates', '_serialize', '_header', '_extract'));
    }


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->MeetingDate->id = $id;
		if (!$this->MeetingDate->exists()) {
			throw new NotFoundException(__('Invalid meeting date'));
		}
		$this->set('meetingDate', $this->MeetingDate->read(null, $id));
	}

	// public function applicant_view($id = null) {
	// 	$this->MeetingDate->id = $id;
	// 	if (!$this->MeetingDate->exists()) {
	// 		throw new NotFoundException(__('Invalid meeting date'));
	// 	}
	// 	$this->set('meetingDate', $this->MeetingDate->read(null, $id));
	// }

    public function applicant_view($id = null) {
        $this->MeetingDate->id = $id;
        if (!$this->MeetingDate->exists()) {
            throw new NotFoundException(__('Invalid meetingDate'));
        }
        $meetingDate = $this->MeetingDate->read(null, $id);
        if ($meetingDate['MeetingDate']['approved'] < 1) {
                $this->Session->setFlash(__('The meetingDate has not been submitted'), 'alerts/flash_info');
                $this->redirect(array('action' => 'edit', $this->MeetingDate->id));
        }
        if ($meetingDate['MeetingDate']['user_id'] !== $this->Auth->User('id')) {
                $this->Session->setFlash(__('You don\'t have permission to access!!'), 'alerts/flash_error');
                $this->redirect('/');
        }
        $this->set('meetingDate', $this->MeetingDate->find('first', array(
            'conditions' => array('MeetingDate.id' => $id)
            )
        ));
        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'MD_' . $id,  'orientation' => 'portrait');
        }
    }
    public function aview($id = null) {
        $this->MeetingDate->id = $id;
        if (!$this->MeetingDate->exists()) {
            throw new NotFoundException(__('Invalid meetingDate'));
        }
        $meetingDate = $this->MeetingDate->read(null, $id);
        if ($meetingDate['MeetingDate']['approved'] < 1) {
                $this->Session->setFlash(__('The meetingDate has not been submitted'), 'alerts/flash_info');
                $this->redirect(array('action' => 'edit', $this->MeetingDate->id));
        }
        $this->set('meetingDate', $this->MeetingDate->find('first', array(
            'conditions' => array('MeetingDate.id' => $id)
            )
        ));

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->MeetingDate->save($this->request->data)) {
                $this->Session->setFlash(__('The meeting date has been saved'), 'alerts/flash_success');

                //******************       Send Email and Notifications to Applicant and Managers          *****************************
                  $this->loadModel('Message');
                  $html = new HtmlHelper(new ThemeView());
                  $message = $this->Message->find('first', array('conditions' => array('name' => 'manager_meeting_date_feedback')));

                  $users = $this->MeetingDate->User->find('all', array(
                      'contain' => array(),
                      'conditions' => array('OR' => array('User.id' => $meetingDate['MeetingDate']['user_id'], 'User.group_id' => 2))
                  ));
                  foreach ($users as $user) {
                      $actioner = ($user['User']['group_id'] == 2) ? 'manager' : 'applicant';
                      $variables = array(
                        'name' => $user['User']['name'], 'proposed_date1' => $meetingDate['MeetingDate']['proposed_date1'], 'proposed_date2' => $meetingDate['MeetingDate']['proposed_date2'], 
                        'comment_subject' => 'PPB Final decision on Pre-submission meeting',
                        'comment_content' => $this->request->data['MeetingDate']['final_decision'],
                        'reference_link' => $html->link($meetingDate['MeetingDate']['proposed_date1'], array('controller' => 'meeting_dates', 'action' => 'view', $meetingDate['MeetingDate']['id'], $actioner => true, 'full_base' => true), 
                          array('escape' => false)),
                      );
                      $datum = array(
                        'email' => ($meetingDate['MeetingDate']['email'] && $actioner == 'applicant') ? $meetingDate['MeetingDate']['email'] : $user['User']['email'],
                        'id' => $this->request->data['MeetingDate']['id'], 'user_id' => $user['User']['id'], 'type' => 'manager_meeting_date_feedback', 'model' => 'MeetingDate',
                        'subject' => String::insert('PPB Final decision on Pre-submission meeting', $variables),
                        'message' => String::insert($this->request->data['MeetingDate']['final_decision'], $variables)
                      );
                      CakeResque::enqueue('default', 'GenericEmailShell', array('sendEmail', $datum));
                      CakeResque::enqueue('default', 'GenericNotificationShell', array('sendNotification', $datum));
                  }
                //**********************************    END   *********************************

                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The meeting date could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        }

        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'MD_' . $id,  'orientation' => 'portrait');
        }
    }
    public function manager_view($id = null) {
      $this->aview($id);
    }
    public function inspector_view($id = null) {
      $this->aview($id);
    }

/**
 * add method
 *
 * @return void
 */
	public function applicant_add() {
		if ($this->request->is('post')) {
			$this->MeetingDate->create();
			// debug($this->request->data);
			if ($this->MeetingDate->save($this->request->data, false)) {
				$this->Session->setFlash(__('The meeting date has been saved'), 'alerts/flash_success');
				$this->redirect(array('action' => 'applicant_edit', $this->MeetingDate->id));
			} else {
				$this->Session->setFlash(__('The meeting date could not be saved. Please, try again.'), 'alerts/flash_error');
                $this->redirect($this->referer());
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
	public function edit($id = null) {
		$this->MeetingDate->id = $id;
		if (!$this->MeetingDate->exists()) {
			throw new NotFoundException(__('Invalid meeting date'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MeetingDate->save($this->request->data)) {
				$this->Session->setFlash(__('The meeting date has been saved'), 'alerts/flash_success');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The meeting date could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		} else {
			$this->request->data = $this->MeetingDate->read(null, $id);
		}
	}

	// public function applicant_edit($id = null) {
	// 	$this->MeetingDate->id = $id;
	// 	if (!$this->MeetingDate->exists()) {
	// 		throw new NotFoundException(__('Invalid meeting date'));
	// 	}
	// 	if ($this->request->is('post') || $this->request->is('put')) {
	// 		if ($this->MeetingDate->save($this->request->data)) {
	// 			$this->Session->setFlash(__('The meeting date has been saved'), 'alerts/flash_success');
	// 			$this->redirect($this->referer());
	// 		} else {
	// 			$this->Session->setFlash(__('The meeting date could not be saved. Please, try again.'), 'alerts/flash_error');
	// 		}
	// 	} else {
	// 		$this->request->data = $this->MeetingDate->read(null, $id);
	// 		// debug($this->request->data);
	// 	}
	// }

	public function applicant_edit($id = null) { 
        $this->MeetingDate->id = $id;
        if (!$this->MeetingDate->exists()) {
            throw new NotFoundException(__('Invalid MeetingDate'));
        }
        $meetingDate = $this->MeetingDate->read(null, $id);
        if ($meetingDate['MeetingDate']['approved'] > 0) {
                $this->Session->setFlash(__('The meeting date has been submitted'), 'alerts/flash_info');
                $this->redirect(array('action' => 'view', $this->MeetingDate->id));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $validate = false;
            if (isset($this->request->data['submitReport'])) {
                $validate = 'first';                
            }
            if ($this->MeetingDate->saveAssociated($this->request->data, array('validate' => $validate, 'deep' => true))) {
                if (isset($this->request->data['submitReport'])) {
                    $this->MeetingDate->saveField('approved', 1);
                    $meetingDate = $this->MeetingDate->read(null, $id);

                    //******************       Send Email and Notifications to Applicant and Managers          *****************************
                    $this->loadModel('Message');
                    $html = new HtmlHelper(new ThemeView());
                    $message = $this->Message->find('first', array('conditions' => array('name' => 'applicant_meeting_date_submit')));
                    $variables = array(
                      'email' => $meetingDate['MeetingDate']['email'], 'proposed_date1' => $meetingDate['MeetingDate']['proposed_date1'], 'proposed_date2' => $meetingDate['MeetingDate']['proposed_date2'],
                      'reference_link' => $html->link($meetingDate['MeetingDate']['proposed_date1'], array('controller' => 'meetingDates', 'action' => 'view', $meetingDate['MeetingDate']['id'], 'applicant' => true, 'full_base' => true), 
                        array('escape' => false))                      );
                    $datum = array(
                        'email' => $meetingDate['MeetingDate']['email'],
                        'id' => $id, 'user_id' => $this->Auth->User('id'), 'type' => 'applicant_meeting_date_submit', 'model' => 'MeetingDate',
                        'subject' => String::insert($message['Message']['subject'], $variables),
                        'message' => String::insert($message['Message']['content'], $variables)
                      );
                    CakeResque::enqueue('default', 'GenericEmailShell', array('sendEmail', $datum));
                    CakeResque::enqueue('default', 'GenericNotificationShell', array('sendNotification', $datum));
                    $users = $this->MeetingDate->User->find('all', array(
                        'contain' => array(),
                        'conditions' => array('OR' => array('User.id' => $this->Auth->User('id'), 'User.group_id' => 2))
                    ));
                    foreach ($users as $user) {
                      $variables = array(
                      'email' => $meetingDate['MeetingDate']['email'], 'proposed_date1' => $meetingDate['MeetingDate']['proposed_date1'], 'proposed_date2' => $meetingDate['MeetingDate']['proposed_date2'],
                      'reference_link' => $html->link($meetingDate['MeetingDate']['proposed_date1'], array('controller' => 'meetingDates', 'action' => 'view', $meetingDate['MeetingDate']['id'], 'applicant' => true, 'full_base' => true), 
                        array('escape' => false))                      );
                      $datum = array(
                        'email' => $user['User']['email'],
                        'id' => $id, 'user_id' => $user['User']['id'], 'type' => 'applicant_meeting_date_submit', 'model' => 'MeetingDate',
                        'subject' => String::insert($message['Message']['subject'], $variables),
                        'message' => String::insert($message['Message']['content'], $variables)
                      );
                      CakeResque::enqueue('default', 'GenericEmailShell', array('sendEmail', $datum));
                      CakeResque::enqueue('default', 'GenericNotificationShell', array('sendNotification', $datum));
                    }
                    //**********************************    END   *********************************

                    $this->Session->setFlash(__('The meeting date has been submitted to PPB'), 'alerts/flash_success');
                    $this->redirect(array('action' => 'view', $this->MeetingDate->id));      
                }
                // debug($this->request->data);
                $this->Session->setFlash(__('The meeting date has been saved'), 'alerts/flash_success');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The meetingDate could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        } else {
            $this->request->data = $this->MeetingDate->read(null, $id);
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
		$this->MeetingDate->id = $id;
		if (!$this->MeetingDate->exists()) {
			throw new NotFoundException(__('Invalid meeting date'), 'alerts/flash_error');
		}
		if ($this->MeetingDate->delete()) {
			$this->Session->setFlash(__('Meeting date deleted'), 'alerts/flash_info');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Meeting date was not deleted'), 'alerts/flash_error');
		$this->redirect(array('action' => 'index'));
	}
    public function applicant_delete($id = null) {
      $this->delete($id);
    }
    public function manager_delete($id = null) {
      $this->delete($id);
    }
    public function reviewer_delete($id = null) {
      $this->delete($id);
    }
}
