<?php
App::uses('AppController', 'Controller');
/**
 * ActiveInspectors Controller
 *  @property ActiveInspector $ActiveInspector
 */
class ActiveInspectorsController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public $uses = array('ActiveInspector', 'Application', 'AuditTrail', 'User');

    public function beforeFilter()
    {
        parent::beforeFilter();
        
        $this->Auth->allow('manager_assign');
    }

	public function manager_assign($id = null)
    {
        if ($this->request->is('post')) {
            $this->ActiveInspector->create();
            $message = $this->request->data['Message'];
            unset($this->request->data['Message']);
            if (!empty($this->request->data)) {
                foreach ($this->request->data as $key => $value) {
                    $this->request->data[$key]['ActiveInspector']['application_id'] = $id;
                    $this->request->data[$key]['ActiveInspector']['type'] = 'request';
                    $this->request->data[$key]['ActiveInspector']['title'] = 'PPB request';
                    $this->request->data[$key]['ActiveInspector']['text'] = $message['text'];
                }

                if ($this->ActiveInspector->saveMany($this->request->data)) {
 
                    //end stages

                    CakeResque::enqueue('default', 'NotificationShell', array('newAppNotifyInspector', $this->request->data));

                    $this->Session->setFlash(__('The inspectors have been notified'), 'alerts/flash_success');
                    $this->redirect(array('controller' => 'applications', 'action' => 'view', $id));
                } else {
                    $this->Session->setFlash(__('The inspectors could not be notified. Please, try again.'));
                    $this->redirect(array('controller' => 'applications', 'action' => 'view', $id));
                }
            } else {
                $this->Session->setFlash(__('Please select at least one inspector'), 'alerts/flash_error');
                $this->redirect(array('controller' => 'applications', 'action' => 'view', $id));
            }
        }
        $users = $this->ActiveInspector->User->find('list');
        $applications = $this->ActiveInspector->Application->find('list');
        $this->set(compact('users', 'applications'));
    }

}
