<?php
App::uses('AppController', 'Controller');
App::uses('String', 'Utility');
App::uses('ThemeView', 'View');
App::uses('HtmlHelper', 'View/Helper');
App::uses('Sanitize', 'Utility');
App::uses('HttpSocket', 'Network/Http');
/**
 * AmendmentApprovals Controller
 * @property AmendmentApproval $AmendmentApproval
 */
class AmendmentApprovalsController extends AppController
{

	/**
	 * Scaffold
	 *
	 * @var mixed
	 */
	public $scaffold;

	public $uses = array('User', 'Application', 'Message', 'AmendmentApproval');



	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('manager_approve','genereateQRCode','file_download');
	}
	public function genereateQRCode($id = null)
    {

        $this->loadModel('AmendmentLetter');

        $currentId = base64_encode($id);

        $currentUrl = Router::url('/amendment_letters/verify/' . $currentId, true);

        $options = array(
            'ssl_verify_peer' => false
        );
        $HttpSocket = new HttpSocket($options);

        //Request Access Token
        $initiate = $HttpSocket->post(
            'https://smp.imeja.co.ke/api/qr/generate',
            array('url' => $currentUrl),
            array('header' => array())
        );

        // debug($initiate);
        // exit;
        if ($initiate->isOk()) {

            $body = $initiate->body;
            $resp = json_decode($body, true);
            $this->AmendmentLetter->id = $id;
            if (!$this->AmendmentLetter->exists()) {
                throw new NotFoundException(__('Invalid amendment approval letter'));
            }
            $qr_code = $resp['data']['qr_code'];
            $data = $this->AmendmentLetter->read(null, $id);
            $data['AmendmentLetter']['qrcode'] = $qr_code;

            $this->AmendmentLetter->Create();
            if ($this->AmendmentLetter->save($data)) {
            }
        } else {
            $body = $initiate->body;
        }
    }

	public function manager_approve($application_id)
	{
		if ($this->request->data['AmendmentApproval']['status'] == null) {
			$this->Session->setFlash(__('Please select if approved or not.'), 'alerts/flash_error');
			$this->redirect($this->referer());
		} else {
			if ($this->Auth->password($this->request->data['AmendmentApproval']['password']) === $this->Auth->User('confirm_password')) {
				 
				$id=$this->request->data['AmendmentApproval']['amendment'];
				$this->AmendmentApproval->create();
				if ($this->AmendmentApproval->saveAssociated($this->request->data, array('deep' => true))) {
					 
					if($this->request->data['AmendmentApproval']['status'] == 'approved'){

						$this->loadModel('Pocket');
						$this->loadModel('AmendmentLetter');
						$this->loadModel('Application');
						$html = new HtmlHelper(new ThemeView());
						$approval_letter = $this->Pocket->find('first', array('conditions' => array('Pocket.name' => 'amendment_letter')));
						$application = $this->Application->find('first', array('conditions' => array('Application.id' => $application_id)));
						$checklist = array();
						$data = $application['AmendmentChecklist'];
				
				
						foreach ($data as $formdata) {
							if ($formdata['year'] == $id) {
								$pocket_name = !empty($formdata['pocket_name']) ? $formdata['pocket_name'] : $formdata['description'];
				
								$file_link = $html->link(__($formdata['basename']), array('controller' => 'attachments',   'action' => 'download', $formdata['id'], 'admin' => false, 'full_base' => true));
								(isset($checklist[$formdata['pocket_name']])) ?
									$checklist[$pocket_name] .= $file_link . ' dated ' . date('jS F Y', strtotime($formdata['file_date'])) . ' Version ' . $formdata['version_no'] . '<br>' :
									$checklist[$pocket_name] = $file_link . ' dated ' . date('jS F Y', strtotime($formdata['file_date'])) . ' Version ' . $formdata['version_no'] . '<br>';
							}
						}
						$deeds = $this->Pocket->find('list', array(
							'fields' => array('Pocket.name', 'Pocket.content'),
							'conditions' => array('Pocket.type' => 'amendment'),
							'recursive' => 0
						));
				
					 
						$checkstring = '';
						$num = 0; 
						foreach ($checklist as $kech => $check) {             
							$num++;            
							// $checkstring .= $num . '. ' . $deeds[$kech] . '<br>' . $check;
							$checkstring .= $num . '. ' . (isset($deeds[$kech]) ? $deeds[$kech] : $kech) . '<br>' . $check;
				
						}
						// debug($checkstring);
						// exit;
				
						$cnt = $this->Application->AmendmentLetter->find('count', array('conditions' => array('date_format(AmendmentLetter.created, "%Y")' => date("Y"))));
						$cnt++;
						$year = date('Y', strtotime($application['Application']['approval_date']));
						$approval_no = 'PPB/' . $application['Application']['protocol_no'] . "/$year" . "($cnt)";
						$expiry_date = date('jS F Y', strtotime($application['Application']['approval_date'] . " +1 year"));
						$expiry_date_s = date('Y-m-d', strtotime($application['Application']['approval_date'] . " +1 year"));
				
						$qualification = $names = $professional_address = $telephone = null;
						if (isset($application['InvestigatorContact'][0])) {
							$qualification = $application['InvestigatorContact'][0]['qualification'];
							$names = $application['InvestigatorContact'][0]['given_name'] . ' ' . $application['InvestigatorContact'][0]['middle_name'] . ' ' . $application['InvestigatorContact'][0]['family_name'];
							$professional_address = $application['InvestigatorContact'][0]['professional_address'];
							$telephone = $application['InvestigatorContact'][0]['telephone'];
						}
						$variables = array(
							'approval_no' => $approval_no, 'protocol_no' => $application['Application']['protocol_no'],
							'letter_date' => date('jS F Y', strtotime($application['Application']['approval_date'])),
							'qualification' => $qualification,
							'names' => $names,
							'professional_address' => $professional_address,
							'telephone' => $telephone,
							'study_title' => $application['Application']['study_title'],
							'checklist' => $checkstring,
							'expiry_date' => $expiry_date
						);
				
						$save_data = array(
							'AmendmentLetter' => array(
								'application_id' => $application['Application']['id'],
								'approval_no' => $approval_no,
								'approver' => $this->Session->read('Auth.User.name'),
								'approval_date' => date('Y-m-d H:i:s'),
								'expiry_date' => $expiry_date_s,
								'status' => $id,
								'content' => String::insert($approval_letter['Pocket']['content'], $variables)
							),
						);
						$this->AmendmentLetter->Create();
						if (!$this->AmendmentLetter->save($save_data)) {
							$this->log('Amendment approval letter was not saved!!', 'annual_letter_error');
							$this->log($save_data, 'annual_letter_error');
						}
				
				
						//******************       Send Email and Notifications Managers    *****************************
						$this->loadModel('Message');
						$html = new HtmlHelper(new ThemeView());
						$message = $this->Message->find('first', array('conditions' => array('name' => 'manager_approve_amendment_letter')));
						$this->loadModel('User');
						$users = $this->User->find('all', array(
							'contain' => array('Group'),
							'conditions' => array('OR' => array('User.id' => $application['Application']['user_id'], 'User.group_id' => 2)) //Applicant and managers
							
						));
						foreach ($users as $user) {
							$variables = array(
								'name' => $user['User']['name'], 
								'approval_no' => $approval_no, 
								'protocol_no' => $application['Application']['protocol_no'],
								'protocol_link' => $html->link($application['Application']['protocol_no'], array(
									'controller' => 'applications', 'action' => 'view', $application['Application']['id'], $user['Group']['redir'] => true,
									'full_base' => true
								), array('escape' => false)),
								'approval_date' => $application['Application']['approval_date']
							);
							$datum = array(
								'email' => $user['User']['email'],
								'id' => $id, 
								'user_id' => $user['User']['id'],
								'type' => 'manager_approve_amendment_letter',
								'model' => 'AmendmentLetter',
								'subject' => String::insert($message['Message']['subject'], $variables),
								'message' => String::insert($message['Message']['content'], $variables)
							);
							CakeResque::enqueue('default', 'GenericEmailShell', array('sendEmail', $datum));
							CakeResque::enqueue('default', 'GenericNotificationShell', array('sendNotification', $datum));
						}
						//**********************************    END   *********************************
						//end
						// Create a Audit Trail
						// $this->loadModel('User');
						$this->loadModel('AuditTrail');
						$audit = array(
							'AuditTrail' => array(
								'foreign_key' => $application['Application']['id'] ,
								'model' => 'Application',
								'message' => 'Amendment for the report with protocol number ' .  $application['Application']['protocol_no'] . ' has been successfully approved by ' . $this->Auth->user('username'),
								'ip' =>  $application['Application']['protocol_no']
							)
						);
						$this->AuditTrail->Create();
						if ($this->AuditTrail->save($audit)) {
							$this->log($this->args[0], 'audit_success');
						} else {
							$this->log('Error creating an audit trail', 'notifications_error');
							$this->log($this->args[0], 'notifications_error');
						}
						$this->genereateQRCode($this->AmendmentLetter->id);
						$this->Session->setFlash(__('Successfully approved the protocol. '), 'alerts/flash_success');
						$this->redirect($this->referer());
					}
				} else {
					$errors = $this->AmendmentApproval->validationErrors;
					debug($errors);
					exit;

					$this->Session->setFlash(__('The Approval could not be saved. Please, try again.'), 'alerts/flash_error');
					$this->redirect($this->referer());
				}
			} else {
				$this->Session->setFlash(__('The password you have entered is not correct! Please enter the correct password
				and try again.'), 'alerts/flash_error');
				$this->redirect($this->referer());
			}
		}
	}

	public function file_download($id){
		$this->viewClass = 'Media';
        $this->AmendmentApproval->Attachment->id = $id;
        if (!$this->AmendmentApproval->Attachment->exists()) {
            $this->Session->setFlash(__('The requested file does not exist!.'), 'alerts/flash_error');
            $this->redirect($this->referer());
        } 
        $attachment = $this->AmendmentApproval->Attachment->find('first', array('conditions' => array('Attachment.id' => $id, 'model' => 'AmendmentApproval')));
        $params = array(
            'id'        => $attachment['Attachment']['basename'],
            'download'  => true,
            'path'      => 'media' . DS . 'transfer' . DS . $attachment['Attachment']['dirname'] . DS
        );
        $this->set($params);
	}
}
