<?php
App::uses('AppController', 'Controller');
/**
 * ProtocolOutsources Controller
 *
 * 
 * @property ProtocolOutsource $ProtocolOutsource
 */
class ProtocolOutsourcesController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;
	public $paginate = array();
    public $uses = array('ProtocolOutsource', 'User', 'Application');
    public $components = array('Search.Prg');
    public $presetVars = true;

	public function admin_index(){
		$this->Prg->commonProcess();
        $page_options = array('10' => '10', '20' => '20');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['User']['limit'] = $this->passedArgs['pages'];
            else $this->paginate['User']['limit'] = reset($page_options);

        $criteria = $this->User->parseCriteria($this->passedArgs);
        $criteria['User.group_id'] = 8;
        $this->paginate['User']['conditions'] = $criteria;

        $this->paginate['User']['order'] = array('User.created' => 'desc');
        // $this->User->recursive = -1;
        $this->paginate['User']['contain'] = array('Group', 'ProtocolOutsource' => array('Application'));
 

        $this->set('page_options', $page_options);
        $this->set('users', $this->paginate('User'));
	}

	public function admin_view($user_id = null, $application_id = null) { 
        if (empty($user_id)) {
            $this->Session->setFlash(__('User does not exist!'), 'alerts/flash_error');
            $this->redirect(array('controller' => 'protocol_outsources', 'action' => 'index'));
        }
        $user = $this->User->find('first', array(
            'contain' => array('ProtocolOutsource'=> array('Application')),
            'conditions' => array('User.id' => $user_id)
            )
        );
        $this->set('user', $user);

        $this->Prg->commonProcess();
        $criteria = $this->Application->parseCriteria($this->passedArgs); 
        $criteria['NOT'] = array('Application.id' => Hash::extract($user['ProtocolOutsource'], '{n}.application_id'));
        $this->paginate['Application']['conditions'] = $criteria;

        $this->paginate['Application']['order'] = array('User.created' => 'desc');
        $this->paginate['Application']['contain'] = array('User');

        $this->set('applications', $this->paginate('Application'));

        if ($this->request->is('post')) {
           

            $this->ProtocolOutsource->save(array('application_id' => $application_id, 'user_id' => $user_id, 'owner_id' => $this->Application->field('user_id', array('Application.id' => $application_id))));
           // Send Alert to the Outsourced User and update Audit Trails
				$app = $this->Application->read(null, $application_id);
                $data = array(
                    'function' => 'alertOutsourced',
                    'Application' => array(
                        'id' => $app['Application']['id'],
                        'protocol_no' => $app['Application']['protocol_no'],
						'name'=>$user['User']['name'],
						'email'=>$user['User']['email'],
                        'user_id'=>$user['User']['id'],
                        'new_user' =>false,
                    )
                );
                CakeResque::enqueue('default', 'NotificationShell', array('alertOutsourced', $data));

                // Create a Audit Trail
                $audit = array(
                    'AuditTrail' => array(
                        'foreign_key' => $app['Application']['id'],
                        'model' => 'Outsource',
                        'message' => 'New outsource request for the Protocol with protocol number ' . $app['Application']['protocol_no'].' outsourced to '.$user['User']['name'].  '  has been reviewed and approved by ' . $this->Auth->user('username'),
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
            $this->Session->setFlash(__('The application has been successfully assigned to the outsourced user'), 'alerts/flash_success');
             $this->redirect($this->referer());
        }
    }
	public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->ProtocolOutsource->id = $id;
        if (!$this->ProtocolOutsource->exists()) {
            throw new NotFoundException(__('Invalid study monitor'));
        }
        if ($this->ProtocolOutsource->delete()) {
            $this->Session->setFlash(__('Outsourced user deleted'), 'alerts/flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Outsourced user was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
