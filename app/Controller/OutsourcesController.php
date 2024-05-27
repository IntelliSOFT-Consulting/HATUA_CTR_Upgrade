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
	public function generatePassword($length = 8) {
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
				'contain' => array('Application'),
				'conditions' => array('Outsource.id' => $id)
			)
		);

		if ($this->request->is('post')) {
			// debug($outsource);
			// exit;
			$password=$this->generatePassword();
			$this->request->data['User']['password']=$password;
			$this->request->data['User']['confirm_password']=$password;
			$this->request->data['User']['confirm_password']=$password;			
            $this->request->data['User']['group_id'] = 8;
			$this->request->data['User']['country_id'] = $outsource['Outsource']['country_id'];
			$this->request->data['User']['county_id'] = $outsource['Outsource']['county_id'];
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				// update the outsourced
				$this->Outsource->id=$id;
				$this->Outsource->saveField('approved',1);

				$application_id=$outsource['Outsource']['application_id'];
				$user_id=$this->User->id;
				$this->loadModel('ProtocolOutsource');
				$this->ProtocolOutsource->save(array('application_id' => $application_id, 'user_id' => $user_id, 'owner_id' => $this->Application->field('user_id', array('Application.id' => $application_id))));
				$this->Session->setFlash(__('The outsourced investigator has been saved. Please assign studies to the user.'), 'alerts/flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		}


		$this->set('outsource', $outsource);
		$groups = $this->User->Group->find('list', array('order' => array('id' => 'desc')));
		$this->set(compact('groups'));
		$counties = $this->User->County->find('list', array('order' => 'County.county_name ASC'));
		$this->set(compact('counties'));
		$countries = $this->User->Country->find('list', array('order' => 'Country.name ASC'));
		$this->set(compact('countries'));
	}

	 
}
