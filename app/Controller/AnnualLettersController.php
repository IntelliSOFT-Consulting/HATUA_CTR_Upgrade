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
				$this->redirect(array('controller' => 'applications', 'action' => 'view', $anl['Application']['id'], 'manager' => true));
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
