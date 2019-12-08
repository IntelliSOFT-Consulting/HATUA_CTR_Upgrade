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

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MeetingDate->recursive = 0;
		$this->set('meetingDates', $this->paginate());
	}

	public function applicant_index() {
		$this->MeetingDate->recursive = 0;
		$this->set('meetingDates', $this->paginate());
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
			debug($this->request->data);
			if ($this->MeetingDate->save($this->request->data)) {
				$this->Session->setFlash(__('The meeting date has been saved'), 'alerts/flash_success');
				$this->redirect(array('action' => 'applicant_edit', $this->MeetingDate->id));
			} else {
				$this->Session->setFlash(__('The meeting date could not be saved. Please, try again.'), 'alerts/flash_error');
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
				$this->Session->setFlash(__('The meeting date has been saved'));
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

                    $this->Session->setFlash(__('The meeting date has been submitted to mcaz'), 'alerts/flash_success');
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
			throw new NotFoundException(__('Invalid meeting date'));
		}
		if ($this->MeetingDate->delete()) {
			$this->Session->setFlash(__('Meeting date deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Meeting date was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
