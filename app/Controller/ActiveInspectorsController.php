<?php
App::uses('AppController', 'Controller');
/**
 * ActiveInspectors Controller
 *  @property ActiveInspector $ActiveInspector
 */
class ActiveInspectorsController extends AppController
{

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

        $this->Auth->allow('manager_assign', 'manager_revoke', 'inspector_respond');
    }
    public function inspector_respond()
    {
        if ($this->request->is('post')) {
            if (empty($this->request->data['ActiveInspector']['accepted'])) {
                $this->Session->setFlash(__('Please accept / decline the offer!!'), 'alerts/flash_error');
                $this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['ActiveInspector']['application_id']));
            }
            if (empty($this->request->data['ActiveInspector']['conflict'])) {
                $this->Session->setFlash(__('Please declare your conflict of interest with this offer!!'), 'alerts/flash_error');
                $this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['ActiveInspector']['application_id']));
            }


            $review = $this->ActiveInspector->find('first', array('conditions' => array(
                'ActiveInspector.application_id' => $this->request->data['ActiveInspector']['application_id'],
                'ActiveInspector.user_id' => $this->Auth->User('id'),
                'ActiveInspector.type' => 'request'
            ), 'contain' => array()));
            if (!empty($review)) {
                $this->ActiveInspector->create();
                $review['ActiveInspector']['accepted'] = $this->request->data['ActiveInspector']['accepted'];
                $review['ActiveInspector']['recommendation'] = $this->request->data['ActiveInspector']['recommendation'];
                $review['ActiveInspector']['conflict'] = $this->request->data['ActiveInspector']['conflict'];
                if ($this->Auth->password($this->request->data['ActiveInspector']['password']) === $this->Auth->User('confirm_password')) {
                    if ($this->ActiveInspector->save($review)) {


                        //end stages
                        // Create a Audit Trail
                        $this->loadModel('AuditTrail');
                        $audit = array(
                            'AuditTrail' => array(
                                'foreign_key' => $this->request->data['ActiveInspector']['application_id'],
                                'model' => 'ActiveInspector',
                                'message' => 'Inspector ' . $this->Auth->User('username') . ' ' . $this->request->data['ActiveInspector']['accepted'] . ' a site inspection request for the report with protocol number ' .  $this->Application->field('protocol_no', array('id' => $this->request->data['ActiveInspector']['application_id'])),
                                'ip' =>  $this->Application->field('protocol_no', array('id' => $this->request->data['ActiveInspector']['application_id']))
                            )
                        );
                        $this->AuditTrail->Create();
                        if ($this->AuditTrail->save($audit)) {
                            $this->log($this->request->data['ActiveInspector'], 'audit_success');
                        } else {
                            $this->log('Error creating an audit trail', 'audit_error');
                            $this->log($this->request->data['ActiveInspector'], 'audit_error');
                        }

                        CakeResque::enqueue('default', 'NotificationShell', array('ppbRequestReviewResponse', $review));

                        if ($review['ActiveInspector']['accepted'] == 'accepted') {
                            $this->Session->setFlash(__('Thank you. Your response has been sent to PPB. You may proceed to review the application'),  'alerts/flash_success');
                            $this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['ActiveInspector']['application_id']));
                        } elseif ($review['ActiveInspector']['accepted'] == 'declined') {
                            $this->Session->setFlash(__('Thank you for your prompt response.'),  'alerts/flash_info');
                            $this->redirect(array('controller' => 'applications', 'action' => 'index'));
                        } else {
                            $this->Session->setFlash(__('NO response.'),  'alerts/flash_info');
                            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
                        }
                    } else {
                        $this->Session->setFlash(__('The review could not be saved. Please, try again.'));
                        $this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['ActiveInspector']['application_id']));
                    }
                } else {
                    $this->Session->setFlash(__('The password you have entered is not correct! Please enter your correct password
                    and try again.'), 'alerts/flash_error');
                    $this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['ActiveInspector']['application_id']));
                }
            } else {
                $this->Session->setFlash(__('Seems the request review is empty!'), 'alerts/flash_error');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
        } else {
            $this->Session->setFlash(__('Invalid method signature!'), 'alerts/flash_error');
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
        }
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

    public function manager_revoke($id = null, $application_id)
    {
        $this->ActiveInspector->id = $id;
        if (!$this->ActiveInspector->exists()) {
            throw new NotFoundException(__('Invalid Assignment'));
        }

        $app = $this->ActiveInspector->find('first', array(
            'conditions' => array('ActiveInspector.id' => $id),
        ));
        // debug($app);
        // exit;
        if ($this->ActiveInspector->delete()) {

            $this->loadModel('AuditTrail');
            $audit = array(
                'AuditTrail' => array(
                    'foreign_key' => $application_id,
                    'model' => 'Application',
                    'message' => 'Site inspection assigned to ' . $app['User']['username'] . ' for the protocol with reference number ' . $app['Application']['protocol_no'] . ' has been revorked by ' . $this->Auth->user('name'),
                    'ip' => $app['Application']['protocol_no']
                )
            );
            $this->AuditTrail->Create();
            if ($this->AuditTrail->save($audit)) {
                $this->log($app['Application']['protocol_no'], 'audit_success');
            } else {
                $this->log('Error creating an audit trail', 'audit_error');
                $this->log($app['Application']['protocol_no'], 'audit_error');
            }
            $this->Session->setFlash(__('The inspector request has been revoked'), 'alerts/flash_success');
            $this->redirect(array('controller' => 'applications', 'action' => 'view', $application_id));
        }
        $this->Session->setFlash(__('Site assignment was not deleted'));
        $this->redirect(array('controller' => 'applications', 'action' => 'view', $application_id));
    }
}
