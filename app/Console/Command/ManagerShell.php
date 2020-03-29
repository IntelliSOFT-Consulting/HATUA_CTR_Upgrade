<?php
App::uses('String', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('Router', 'Routing');
config('routes');
App::uses('Shell', 'Console');
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');

class ManagerShell extends Shell {
      public $uses = array('User', 'Application', 'Amendment','Review', 'Notification', 'Message');
      
      public function perform() {
        $this->initialize();
        $this->{array_shift($this->args)}();
      }

      public function newAnnualApproval(){
            // $this->log('starting', 'annual_approval');
            // $this->log($this->args[0], 'annual_approval');
            $managers = $this->User->find('all', array('conditions' => array('group_id' => 2, 'is_active' => 1), 'contain' => array()));
            $messages = $this->Message->find('list', array(
                                          'conditions' => array('Message.name' => array('manager_new_annual_approval_subject', 'manager_new_annual_approval')),
                                           'fields' => array('Message.name', 'Message.content')));
            $save_data = array();
            $variables = array(
              'protocol_link' => Router::url(array('controller' => 'applications', 'action' => 'view', $this->args[0]['Application']['id'],
                                             'manager' => true), true),
              'protocol_no' => $this->args[0]['Application']['protocol_no'],
              'name' => $this->args[0]['Application']['protocol_no']
            );
            foreach ($managers as $manager) {
                  $save_data[] = array('Notification' => array(
                   'user_id' => $manager['User']['id'],
                   'type' => 'manager_new_annual_approval',
                   'model' => 'Application',
                   'foreign_key' => $this->args[0]['Application']['id'],
                   'title' => $messages['manager_new_annual_approval_subject'],
                   'system_message' => String::insert($messages['manager_new_annual_approval'], $variables),
                   ),
                 );
             }

             // TODO : Set email accounts to cc notification
            $this->Notification->Create();
             if ($this->Notification->saveMany($save_data)) {
               $this->log($this->args[0], 'notifications_success');
             } else {
               $this->log('The Notifications were not sent at newAnnualApproval.', 'notifications_error');
               $this->log($this->args[0], 'notifications_error');
            }

            //<!-- Send email to PPB -->
           $message = String::insert($messages['manager_new_annual_approval'], $variables);
           $email = new CakeEmail();
           $email->config('gmail');
           $email->template('default');
           $email->emailFormat('html');
           $email->to('pv@pharmacyboardkenya.org');
           // $email->to('eddieokemwa@gmail.com');  // make sure you change this oo!!!
           $email->cc(array('info@pharmacyboardkenya.org'));
           $email->bcc(array('eddyokemwa@gmail.com'));
           $email->subject(Sanitize::html(String::insert($messages['manager_new_annual_approval_subject'], $variables), array('remove' => true)));
           $email->viewVars(array('message' => $message));
           if(!$email->send()) {
               $this->log($email, 'annual_approval');
           }
     }

     public function newFinalReport(){
            $managers = $this->User->find('all', array('conditions' => array('group_id' => 2, 'is_active' => 1), 'contain' => array()));
            $messages = $this->Message->find('list', array(
                                          'conditions' => array('Message.name' => array('manager_new_final_report_subject', 'manager_new_final_report')),
                                           'fields' => array('Message.name', 'Message.content')));
            $save_data = array();
            $variables = array(
              'protocol_link' => Router::url(array('controller' => 'applications', 'action' => 'view', $this->args[0]['Application']['id'],
                                             'manager' => true), true),
              'protocol_no' => $this->args[0]['Application']['protocol_no'],
              'name' => $this->args[0]['Application']['protocol_no']
            );
            foreach ($managers as $manager) {
                  $save_data[] = array('Notification' => array(
                   'user_id' => $manager['User']['id'],
                   'type' => 'manager_new_final_report',
                   'model' => 'Application',
                   'foreign_key' => $this->args[0]['Application']['id'],
                   'title' => $messages['manager_new_final_report_subject'],
                   'system_message' => String::insert($messages['manager_new_final_report'], $variables),
                   ),
                 );
             }

             // TODO : Set email accounts to cc notification
            $this->Notification->Create();
             if ($this->Notification->saveMany($save_data)) {
               $this->log($this->args[0], 'notifications_success');
             } else {
               $this->log('The Notifications were not sent at newAnnualApproval.', 'notifications_error');
               $this->log($this->args[0], 'notifications_error');
            }

            //<!-- Send email to PPB -->
           $message = String::insert($messages['manager_new_final_report'], $variables);
           $email = new CakeEmail();
           $email->config('gmail');
           $email->template('default');
           $email->emailFormat('html');
           $email->to('pv@pharmacyboardkenya.org');
           // $email->to('eddieokemwa@gmail.com');  // make sure you change this oo!!!
           $email->cc(array('info@pharmacyboardkenya.org'));
           $email->bcc(array('eddyokemwa@gmail.com'));
           $email->subject(Sanitize::html(String::insert($messages['manager_new_final_report_subject'], $variables), array('remove' => true)));
           $email->viewVars(array('message' => $message));
           if(!$email->send()) {
               $this->log($email, 'final_report');
           }
     }
}

