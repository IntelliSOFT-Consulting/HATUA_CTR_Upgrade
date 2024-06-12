<?php
App::uses('AppController', 'Controller');
/**
 * Outsources Controller
 *
 *  @property Outsource $Outsource
 */
class OutsourcesController extends AppController
{

	/**
	 * Scaffold
	 *
	 * @var mixed
	 */
	public $scaffold;
	public $paginate = array();
	public $uses = array('Outsource', 'User', 'Application');
	public $components = array('Search.Prg');
	public $presetVars = true;

	public function admin_index()
	{
		$this->Prg->commonProcess();
		$page_options = array('10' => '10', '20' => '20');
		if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
		if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['Outsource']['limit'] = $this->passedArgs['pages'];
		else $this->paginate['Outsource']['limit'] = reset($page_options);

		$criteria = $this->Outsource->parseCriteria($this->passedArgs);
		$criteria['Outsource.approved'] = 0;
		$this->paginate['Outsource']['conditions'] = $criteria;
		$this->paginate['Outsource']['order'] = array('Outsource.created' => 'desc');
		$this->paginate['Outsource']['contain'] = array('User', 'Application');

		$this->set('page_options', $page_options);
		$this->set('users', $this->paginate('Outsource'));
	}
	public function generatePassword($length = 8)
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$password = '';
		for ($i = 0; $i < $length; $i++) {
			$password .= $chars[rand(0, strlen($chars) - 1)];
		}
		return $password;
	}
	public function admin_view($id = null)
	{
		$outsource = $this->Outsource->find(
			'first',
			array(
				'contain' => array('Country','County','Application','Attachment'),
				'conditions' => array('Outsource.id' => $id)
			)
		); 
	
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$password = $this->generatePassword();
			$this->request->data['User']['username'] = $this->request->data['Outsource']['username'];
			$this->request->data['User']['name'] = $this->request->data['Outsource']['name'];
			$this->request->data['User']['email'] = $this->request->data['Outsource']['email'];
			$this->request->data['User']['sponsor_email'] = $this->request->data['Outsource']['sponsor_email'];
			$this->request->data['User']['qualification'] = $this->request->data['Outsource']['qualification'];
			$this->request->data['User']['phone_no'] = $this->request->data['Outsource']['phone_no'];
			$this->request->data['User']['is_active'] = $this->request->data['Outsource']['is_active'];			
			$this->request->data['User']['password'] = $password;
			$this->request->data['User']['confirm_password'] = $password;
			$this->request->data['User']['confirm_password'] = $password;
			$this->request->data['User']['group_id'] = 8;
			$this->request->data['User']['country_id'] = $this->request->data['Outsource']['country_id'];
			$this->request->data['User']['county_id'] = $this->request->data['Outsource']['county_id'];
			$this->request->data['User']['institution_physical'] = $this->request->data['Outsource']['institution_physical'];
			$this->request->data['User']['institution_address'] = $this->request->data['Outsource']['institution_address'];
			$this->request->data['User']['institution_contact'] = $this->request->data['Outsource']['institution_contact'];
			// $this->request->data['User']['institution_contact'] = $this->request->data['Outsource']['institution_contact'];
			// $this->request->data['User']['institution_contact'] = $this->request->data['Outsource']['institution_contact'];
			// $this->request->data['User']['institution_contact'] = $this->request->data['Outsource']['institution_contact'];
			// $this->request->data['User']['institution_contact'] = $this->request->data['Outsource']['institution_contact'];
			// debug($this->request->data);
			// exit;
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				// update the outsourced
				$this->Outsource->id = $id;
				$this->Outsource->saveField('approved', 1);

				$application_id = $outsource['Outsource']['application_id'];
				$user_id = $this->User->id;
				$this->loadModel('ProtocolOutsource');
				$this->ProtocolOutsource->save(array('application_id' => $application_id, 'user_id' => $user_id, 'owner_id' => $this->Application->field('user_id', array('Application.id' => $application_id))));

				// Send Alert to the Outsourced User and update Audit Trails
				$app = $this->Application->read(null, $application_id);
				$data = array(
					'function' => 'alertOutsourced',
					'Application' => array(
						'id' => $this->Outsource->id,
						'protocol_no' => $app['Application']['protocol_no'],
						'name' => $outsource['Outsource']['name'],
						'email' => $outsource['Outsource']['email'],
						'username' => $this->request->data['User']['username'],
						'password' => $this->request->data['User']['password'],
						'user_id' => $this->User->id,
						'new_user' => true,
					)
				);
				CakeResque::enqueue('default', 'NotificationShell', array('alertOutsourced', $data));

				// Create a Audit Trail
				$audit = array(
					'AuditTrail' => array(
						'foreign_key' => $id,
						'model' => 'Outsource',
						'message' => 'New outsource request for the Protocol with protocol number ' . $app['Application']['protocol_no'] . ' outsourced to ' . $outsource['Outsource']['name'] .  '  has been reviewed and approved by ' . $this->Auth->user('username'),
						'ip' => $app['Application']['protocol_no']
					)
				);
				$this->loadModel('AuditTrail');
				$this->AuditTrail->Create();
				if ($this->AuditTrail->save($audit)) {
					$this->log($this->request->data, 'audit_success');
				} else {
					$this->log('Error creating an audit trail', 'notifications_error');
					$this->log($this->request->data, 'notifications_error');
				}

				$this->Session->setFlash(__('The outsourced investigator account has been created and assigned initial protocol'), 'alerts/flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		}

		$this->request->data = $this->Outsource->find('first', array(
			'conditions' => array('Outsource.id' => $id),  
			'contain' => array('County', 'Country')
		));

		$this->set('outsource', $outsource);
		$groups = $this->User->Group->find('list', array('order' => array('id' => 'desc')));
		$this->set(compact('groups'));
		$counties = $this->User->County->find('list', array('order' => 'County.county_name ASC'));
		$this->set(compact('counties'));
		$countries = $this->User->Country->find('list', array('order' => 'Country.name ASC'));
		$this->set(compact('countries'));
	}
}
