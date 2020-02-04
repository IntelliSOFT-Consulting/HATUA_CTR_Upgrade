<?php
App::uses('AppController', 'Controller');
App::uses('String', 'Utility');
App::uses('ThemeView', 'View');
App::uses('HtmlHelper', 'View/Helper');
App::uses('Sanitize', 'Utility');
/**
 * AnnualLetters Controller
 *
 * @property AnnualLetter $AnnualLetter
 */
class AnnualLettersController extends AppController {
    public $uses = array('User', 'Application', 'Message', 'Pocket', 'AnnualLetter');
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
		if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'ApprovalLetter_' . $id,  'orientation' => 'portrait');
        }
		$this->set('AnnualLetter', $this->AnnualLetter->read(null, $id));
		$this->render('download');
	}

	public function applicant_view($id = null) {
		$this->view($id);
	}

	public function manager_view($id = null) {
		$this->view($id);
	}

	public function admin_view($id = null) {
		$this->view($id);
	}

/**
 * add method
 *
 * @return void
 */
    public function manager_initial($application_id = null) {
        //Create  annual approval letter

        $html = new HtmlHelper(new ThemeView());
        $approval_letter = $this->Pocket->find('first', array('conditions' => array('Pocket.name' => 'initial_approval_letter')));

        $application = $this->Application->find('first', array('conditions' => array('Application.id' => $application_id)));
        $checklist = array();
        foreach ($application['Checklist'] as $formdata) {            
          $file_link = $html->link(__($formdata['basename']), array('controller' => 'attachments',   'action' => 'download', $formdata['id'], 'admin' => false));
          (isset($checklist[$formdata['pocket_name']])) ? 
            $checklist[$formdata['pocket_name']] .= $file_link.' dated '.date('jS F Y', strtotime($formdata['file_date'])).' Version '.$formdata['version_no'].'<br>' : 
            $checklist[$formdata['pocket_name']] = $file_link.' dated '.date('jS F Y', strtotime($formdata['file_date'])).' Version '.$formdata['version_no'].'<br>';
        }
        $deeds = $this->Pocket->find('list', array(
          'fields' => array('Pocket.name', 'Pocket.content'),
          'conditions' => array('Pocket.type' => 'protocol'),
          'recursive' => 0
        ));
        // debug($deeds);
        $checkstring='';
        $cnt = 0;
        foreach ($checklist as $kech => $check) {
          $cnt++;
          $checkstring .= $cnt.'. '.$deeds[$kech].'<br>'.$check;
        }

        $cnt = $this->Application->AnnualLetter->find('count', array('conditions' => array('AnnualLetter.application_id' => $application_id)));
        $cnt++;
        $year = date('Y', strtotime($application['Application']['approval_date']));
        $approval_no = 'APL/'.$cnt.'/'.$year.'-'.$application['Application']['protocol_no'];
        $expiry_date = date('jS F Y', strtotime($application['Application']['approval_date'] . " +1 year"));
        $variables = array(
            'approval_no' => $approval_no, 'protocol_no' => $application['Application']['protocol_no'], 
            'letter_date' => date('jS F Y', strtotime($application['Application']['approval_date'])),
            'qualification' => $application['InvestigatorContact'][0]['qualification'],
            'names' => $application['InvestigatorContact'][0]['given_name'].' '.$application['InvestigatorContact'][0]['middle_name'].' '.$application['InvestigatorContact'][0]['family_name'],
            'professional_address' => $application['InvestigatorContact'][0]['professional_address'],
            'telephone' => $application['InvestigatorContact'][0]['telephone'],
            'study_title' => $application['Application']['short_title'],
            'checklist' => $checkstring,
            'expiry_date' => $expiry_date
        );
        
        $save_data = array('AnnualLetter' => array(
                'application_id' => $application['Application']['id'],
                'approval_no' => $approval_no,
                'approver' => $this->Session->read('Auth.User.name'),
                'approval_date' => date('d-m-Y'),
                'expiry_date' => date('d-m-Y', strtotime('+1 year')),
                'status' => 'submitted',
                'content' => String::insert($approval_letter['Pocket']['content'], $variables)
              ),
            );
        
        $this->AnnualLetter->Create();
        if (!$this->AnnualLetter->save($save_data)) {
             $this->Session->setFlash(__('The approval letter could not be saved.'), 'alerts/flash_error');
        }
        $this->Session->setFlash(__('The approval letter has been saved.'), 'alerts/flash_success');
        $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'ane' => $this->AnnualLetter->id));
    }

    public function manager_generate($application_id = null) {        
        // Notify managers approval generated awaiting approval
        $html = new HtmlHelper(new ThemeView());
        $type = 'manager_approve_letter';
        $message = $this->Message->find('first', array('conditions' => array('name' => $type)));
        $application = $this->Application->find('first', array('conditions' => array('Application.id' => $application_id)));
            //Create  annual approval letter
            $approval_letter = $this->Pocket->find('first', array('conditions' => array('Pocket.name' => 'annual_approval_letter')));

            $checklist = array();

            //check if Application is candidate for annual approval automatic generation
            //1. No active annual letter generated
            //2. All required files uploaded
            // $ck = null;
            // if (empty($application['AnnualLetter']) && count(array_unique(Hash::extract($application['AnnualApproval'], '{n}.group'))) >= 14) {
            //     # code...
            // } else {                
            //     //If not candidate, check if active annual letter exists: do nothing
            //     //if no letter exists, set application stage to expired and remove from public view. Mark as red in Applications and Workflow tables
            
            // }


            foreach ($application['AnnualApproval'] as $formdata) {
                if ($formdata['year'] == date('Y')) {                    
                    $file_link = $html->link(__($formdata['basename']), array('controller' => 'attachments',   'action' => 'download', $formdata['id'], 'admin' => false));
                    (isset($checklist[$formdata['pocket_name']])) ? 
                      $checklist[$formdata['pocket_name']] .= $file_link.' dated '.date('jS F Y', strtotime($formdata['file_date'])).' Version '.$formdata['version_no'].'<br>' : 
                      $checklist[$formdata['pocket_name']] = $file_link.' dated '.date('jS F Y', strtotime($formdata['file_date'])).' Version '.$formdata['version_no'].'<br>';
                }
            }
              $deeds = $this->Pocket->find('list', array(
                'fields' => array('Pocket.name', 'Pocket.content'),
                'conditions' => array('Pocket.type' => 'annual'),
                'recursive' => 0
              ));
              // debug($deeds);
              $checkstring='';
              $cnt = 0;
              foreach ($checklist as $kech => $check) {
                $cnt++;
                $checkstring .= $cnt.'. '.$deeds[$kech].'<br>'.$check;
              }

              $cnt = $this->Application->AnnualLetter->find('count', array('conditions' => array('AnnualLetter.application_id' => $application['Application']['id'])));
              $cnt++;
              $year = date('Y', strtotime($application['Application']['approval_date']));
              $approval_no = 'APL/'.$cnt.'/'.$year.'-'.$application['Application']['protocol_no'];
              // $expiry_date = date('jS F Y', strtotime($application['Application']['approval_date'] . " +1 year"));
              $expiry_date = date('jS F Y', strtotime('+1 year'));
              $variables = array(
                  'approval_no' => $approval_no, 'protocol_no' => $application['Application']['protocol_no'], 
                  'letter_date' => date('jS F Y', strtotime($application['Application']['approval_date'])),
                  'qualification' => $application['InvestigatorContact'][0]['qualification'],
                  'names' => $application['InvestigatorContact'][0]['given_name'].' '.$application['InvestigatorContact'][0]['middle_name'].' '.$application['InvestigatorContact'][0]['family_name'],
                  'professional_address' => $application['InvestigatorContact'][0]['professional_address'],
                  'telephone' => $application['InvestigatorContact'][0]['telephone'],
                  'study_title' => $application['Application']['short_title'],
                  'checklist' => $checkstring,
                  'status' => $application['TrialStatus']['name'], 
                  'expiry_date' => $expiry_date
              );
              $save_data = array('AnnualLetter' => array(
                      'application_id' => $application['Application']['id'],
                      'approval_no' => $approval_no,
                      'approver' => $this->Session->read('Auth.User.name'),
                      'approval_date' => date('d-m-Y'),
                      'expiry_date' => date('d-m-Y', strtotime('+1 year')),
                      'status' => 'submitted',
                      'content' => String::insert($approval_letter['Pocket']['content'], $variables)
                    ),
                  );
              // $this->set('save_data', $save_data);

            //***************************       Send Email and Notifications Managers    *****************************
            
            $users = $this->User->find('all', array(
                'contain' => array('Group'),
                'conditions' => array('User.group_id' => 2) //Managers
            ));
            foreach ($users as $user) {
              if (isset($application['AnnualLetter'][0])) {
                $variables = array(
                        'name' => $user['User']['name'], 'protocol_no' => $application['Application']['protocol_no'],
                        'protocol_link' => $html->link($application['Application']['protocol_no'], array('controller' => 'applications', 'action' => 'view', $application['Application']['id'], $user['Group']['redir'] => true, 
                            'full_base' => true), array('escape' => false)),
                        'approval_date' => $application['Application']['approval_date'], 'expiry_date' => $application['AnnualLetter'][0]['expiry_date']
                      );
                  $datum = array(
                    'email' => $user['User']['email'],
                    'id' => $application['Application']['id'], 'user_id' => $user['User']['id'], 'type' => $type, 'model' => 'AnnaulLetter',
                    'subject' => String::insert($message['Message']['subject'], $variables),
                    'message' => String::insert($message['Message']['content'], $variables)
                  );
                  $this->sendEmail($datum);
                  $this->sendNotification($datum);
                  $this->log($datum, 'approval_reminder');
              }              
            }
            //**********************************    END   *********************************
            //end
            $this->AnnualLetter->Create();
            if (!$this->AnnualLetter->save($save_data)) {
                 $this->Session->setFlash(__('The annual approval letter could not be saved.'), 'alerts/flash_error');
            }
            // $this->redirect($this->referer());
            $this->Session->setFlash(__('The approval letter has been saved.'), 'alerts/flash_success');
            $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'ane' => $this->AnnualLetter->id));
    }

	public function manager_add($application_id = null, $type = null) {
		// $this->AnnualLetter->create();
		// if ($this->AnnualLetter->save($this->request->data)) {
		// 	$this->Session->setFlash(__('The annual approval letter has been saved'));
		// 	$this->redirect(array('action' => 'index'));
		// } else {
		// 	$this->Session->setFlash(__('The annual approval letter could not be saved. Please, try again.'));
		// }
		 //Create  annual approval letter                 
        $this->loadModel('Pocket');
        $this->loadModel('Application');
        $html = new HtmlHelper(new ThemeView());
        $approval_letter = $this->Pocket->find('first', array('conditions' => array('Pocket.name' => 'initial_approval_letter')));

        $application = $this->Application->find('first', array('conditions' => array('Application.id' => $application_id)));
        $checklist = array();
        foreach ($application['Checklist'] as $formdata) {            
          $file_link = $html->link(__($formdata['basename']), array('controller' => 'attachments',   'action' => 'download', $formdata['id'], 'admin' => false));
          (isset($checklist[$formdata['pocket_name']])) ? 
            $checklist[$formdata['pocket_name']] .= $file_link.' dated '.date('jS F Y', strtotime($formdata['file_date'])).' Version '.$formdata['version_no'].'<br>' : 
            $checklist[$formdata['pocket_name']] = $file_link.' dated '.date('jS F Y', strtotime($formdata['file_date'])).' Version '.$formdata['version_no'].'<br>';
        }
        $deeds = $this->Pocket->find('list', array(
          'fields' => array('Pocket.name', 'Pocket.content'),
          'conditions' => array('Pocket.type' => 'protocol'),
          'recursive' => 0
        ));
        $checkstring='';
        $num = 0;
        foreach ($checklist as $kech => $check) {
          $num++;
          $checkstring .= $num.'. '.$deeds[$kech].'<br>'.$check;
        }

        $cnt = $this->Application->AnnualLetter->find('count', array('conditions' => array('date_format(AnnualLetter.created, "%Y")' => date("Y"))));
        $cnt++;
        $year = date('Y', strtotime($this->Application->field('approval_date')));
        $approval_no = 'PPB/'.$application['Application']['protocol_no']."/$year"."($cnt)";
        $expiry_date = date('jS F Y', strtotime($application['Application']['approval_date'] . " +1 year"));
        $expiry_date_s = date('Y-m-d', strtotime($application['Application']['approval_date'] . " +1 year"));
        $variables = array(
            'approval_no' => $approval_no, 'protocol_no' => $application['Application']['protocol_no'], 
            'letter_date' => date('jS F Y', strtotime($application['Application']['approval_date'])),
            'qualification' => $application['InvestigatorContact'][0]['qualification'],
            'names' => $application['InvestigatorContact'][0]['given_name'].' '.$application['InvestigatorContact'][0]['middle_name'].' '.$application['InvestigatorContact'][0]['family_name'],
            'professional_address' => $application['InvestigatorContact'][0]['professional_address'],
            'telephone' => $application['InvestigatorContact'][0]['telephone'],
            'study_title' => $application['Application']['short_title'],
            'checklist' => $checkstring,
            'expiry_date' => $expiry_date
        );
        
        $save_data = array('AnnualLetter' => array(
                'application_id' => $application['Application']['id'],
                'approval_no' => $approval_no,
                'approver' => $this->Session->read('Auth.User.name'),
                'approval_date' => date('Y-m-d H:i:s'),
                'expiry_date' => $expiry_date_s,
                'status' => 'submitted',
                'content' => String::insert($approval_letter['Pocket']['content'], $variables)
              ),
            );
        $this->AnnualLetter->Create();
        if (!$this->AnnualLetter->save($save_data)) {
             $this->log('Annual approval letter was not saved!!', 'annual_letter_error');
             $this->log($save_data, 'annual_letter_error');
        }
        $this->redirect(array('controller' => 'applications', 'action' => 'view', 1, ));
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

	public function manager_approve($id = null) {
		$this->AnnualLetter->id = $id;
		if (!$this->AnnualLetter->exists()) {
			throw new NotFoundException(__('Invalid annual approval letter'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AnnualLetter->save($this->request->data)) {

				//******************       Send Email and Notifications to Applicant and Managers    *****************************
                $this->loadModel('Message');
                $html = new HtmlHelper(new ThemeView());
                $message = $this->Message->find('first', array('conditions' => array('name' => 'annual_approval_letter')));
                $anl = $this->AnnualLetter->find('first', array('contain' => array('Application'), 'conditions' => array('AnnualLetter.id' => $this->AnnualLetter->id)));
                
                $users = $this->AnnualLetter->Application->User->find('all', array(
                    'contain' => array('Group'),
                    'conditions' => array('OR' => array('User.id' => $this->AnnualLetter->Application->field('user_id'), 'User.group_id' => 2)) //Applicant and managers
                ));
                foreach ($users as $user) {
                  $variables = array(
                    'name' => $user['User']['name'], 'approval_no' => $anl['AnnualLetter']['approval_no'], 'protocol_no' => $anl['Application']['protocol_no'],
                    'protocol_link' => $html->link($anl['Application']['protocol_no'], array('controller' => 'applications', 'action' => 'view', $anl['Application']['id'], $user['Group']['redir'] => true, 
                        'full_base' => true), array('escape' => false)),
                    'expiry_date' => $anl['AnnualLetter']['expiry_date'],
                    'approval_date' => $anl['AnnualLetter']['approval_date']
                  );
                  $datum = array(
                    'email' => $user['User']['email'],
                    'id' => $id, 'user_id' => $user['User']['id'], 'type' => 'annual_approval_letter', 'model' => 'AnnaulLetter',
                    'subject' => String::insert($message['Message']['subject'], $variables),
                    'message' => String::insert($message['Message']['content'], $variables)
                  );
                  CakeResque::enqueue('default', 'GenericEmailShell', array('sendEmail', $datum));
                  CakeResque::enqueue('default', 'GenericNotificationShell', array('sendNotification', $datum));
                }
                //**********************************    END   *********************************

				$this->Session->setFlash(__('The annual approval letter has been saved'), 'alerts/flash_success');
				$this->redirect(array('controller' => 'applications', 'action' => 'view', $anl['Application']['id'], 'anl' => $id, 'manager' => true));
			} else {
				$this->Session->setFlash(__('The annual approval letter could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		}
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
