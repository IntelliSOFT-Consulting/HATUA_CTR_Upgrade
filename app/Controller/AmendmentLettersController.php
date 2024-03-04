<?php
App::uses('AppController', 'Controller');
App::uses('String', 'Utility');
App::uses('ThemeView', 'View');
App::uses('HtmlHelper', 'View/Helper');
App::uses('Sanitize', 'Utility');
App::uses('HttpSocket', 'Network/Http');
/**
 * AmendmentLetters Controller
 *
 * @property AmendmentLetter $AmendmentLetter
 */

class AmendmentLettersController extends AppController
{

    /**
     * Scaffold
     *
     * @var mixed
     */
    public $scaffold;

    public function beforeFilter()
    {
        parent::beforeFilter();
        // $this->Auth->allow();
        $this->Auth->allow('verify', 'download', 'manager_download', 'manager_approve', 'applicant_download', 'manager_capprove');
    }

    public function manager_capprove($id = null)
    {
        $this->AmendmentLetter->id = $id;
        if (!$this->AmendmentLetter->exists()) {
            throw new NotFoundException(__('Invalid annual approval letter'));
        }
        if ($this->AmendmentLetter->saveField('submitted', "1")) {
            $this->approval($id);
        } else {
            $this->Session->setFlash(__('The amendment approval letter could not be saved. Please, try again.'), 'alerts/flash_error');
            $this->redirect($this->referer());
        }
    }

    public function approval($id = null)
    {
        //******************       Send Email and Notifications to Applicant and Managers    *****************************
        $this->loadModel('Message');
        $html = new HtmlHelper(new ThemeView());
        $message = $this->Message->find('first', array('conditions' => array('name' => 'annual_approval_letter')));
        $anl = $this->AmendmentLetter->find('first', array('contain' => array('Application'), 'conditions' => array('AmendmentLetter.id' => $this->AmendmentLetter->id)));

        $users = $this->AmendmentLetter->Application->User->find('all', array(
            'contain' => array('Group'),
            'conditions' => array('OR' => array('User.id' => $this->AmendmentLetter->Application->field('user_id'), 'User.group_id' => 2)) //Applicant and managers
        ));
        foreach ($users as $user) {
            $variables = array(
                'name' => $user['User']['name'],
                'approval_no' => $anl['AmendmentLetter']['approval_no'],
                'protocol_no' => $anl['Application']['protocol_no'],
                'protocol_link' => $html->link($anl['Application']['protocol_no'], array(
                    'controller' => 'applications', 'action' => 'view', $anl['Application']['id'], $user['Group']['redir'] => true,
                    'full_base' => true
                ), array('escape' => false)),
                'expiry_date' => $anl['AmendmentLetter']['expiry_date'],
                'approval_date' => $anl['AmendmentLetter']['approval_date']
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

        // Create a Audit Trail
        $this->loadModel('Application');
        $this->loadModel('AuditTrail');
        $audit = array(
            'AuditTrail' => array(
                'foreign_key' => $anl['Application']['id'],
                'model' => 'Application',
                'message' => 'An amendment approval letter for the report with protocol number ' .  $this->Application->field('protocol_no', array('id' => $anl['Application']['id'])) . ' has been  approved by ' . $this->Session->read('Auth.User.username'),
                'ip' =>  $this->Application->field('protocol_no', array('id' => $anl['Application']['id']))
            )
        );
        $this->AuditTrail->Create();
        if ($this->AuditTrail->save($audit)) {
            $this->log($this->args[0], 'audit_success');
        } else {
            $this->log('Error creating an audit trail', 'notifications_error');
            $this->log($this->args[0], 'notifications_error');
        }

        $this->Session->setFlash(__('The amendment approval letter has been saved'), 'alerts/flash_success');
        $this->redirect(array('controller' => 'applications', 'action' => 'view', $anl['Application']['id'], 'aml' => $id, 'manager' => true));
    }

    public function manager_approve($id = null)
    {


        $this->AmendmentLetter->id = $id;
        if (!$this->AmendmentLetter->exists()) {
            throw new NotFoundException(__('Invalid annual approval letter'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->AmendmentLetter->save($this->request->data)) {
                $this->approval($id);
            } else {
                $this->Session->setFlash(__('The amendment approval letter could not be saved. Please, try again.'), 'alerts/flash_error');
            }
            $this->redirect($this->referer());
        }
    }
    public function applicant_download($id = null)
    {
        $this->v_download($id);
    }
    public function manager_download($id = null)
    {
        $this->v_download($id);
    }
    public function v_download($id = null)
    {
        if (strpos($this->request->url, 'pdf') !== false) {

            $this->pdfConfig = array(
                'filename' => 'AmendmentLetter_' . $id,
                'orientation' => 'portrait',
            );
        }

        $data = $this->AmendmentLetter->find(
            'first',
            array(
                'contain' => array(),
                'conditions' => array('AmendmentLetter.id' => $id),
                'order' => array('AmendmentLetter.created DESC')
            )
        );
        $this->set('AmendmentLetter', $data);
        $this->render('download');
    }
    public function download($id = null)
    {

        if (strpos($this->request->url, 'pdf') !== false) {

            $this->pdfConfig = array(
                'filename' => 'AmendmentLetter_' . $id,
                'orientation' => 'portrait',
            );
        }

        $data = $this->AmendmentLetter->find(
            'first',
            array(
                'contain' => array(),
                'conditions' => array('AmendmentLetter.status' => $id),
                'order' => array('AmendmentLetter.created DESC')
            )
        );
        $this->set('AmendmentLetter', $data);
        $this->render('download');
    }

    public function verify($id = null)
    {
        $id = base64_decode($id);
        $this->AmendmentLetter->id = $id;
        if (!$this->AmendmentLetter->exists()) {
            throw new NotFoundException(__('Invalid amendment approval letter'));
        }

        $data = $this->AmendmentLetter->read(null, $id);
        $this->pdfConfig = array(
            'filename' => 'ApprovalLetter_' . $id,
            'orientation' => 'portrait',
        );
        $this->set('AmendmentLetter', $data);

        $this->render('pdf/download');
    }
}
