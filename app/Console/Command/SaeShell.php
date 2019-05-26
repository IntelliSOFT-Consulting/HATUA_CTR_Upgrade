<?php
App::uses('String', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('Router', 'Routing');
config('routes');
App::uses('Shell', 'Console');
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
App::import('Core', 'Helper');

class SaeShell extends Shell {
    public $uses = array('User','Sae', 'Notification', 'Message');

    public function perform() {
      $this->initialize();
      $this->{array_shift($this->args)}();
    }

    public function  applicantSaeSubmit() {
        $messages = $this->Message->find('first', array(
                                    'conditions' => array('Message.name' => array('applicant_sae_submit'))));
        $users = $this->User->find('all', array(
            'contain' => array(),
            'conditions' => array('OR' => array('User.id' => $this->args[0]['user_id'], 'User.group_id' => 2))
          ));
        $this->log($users, 'sae_shell');
        // Dear :name,
        // New :reference_no for :protocol_no has been submitted for review to PPB on :modified.
        $html = new HtmlHelper();
        $Email = new CakeEmail();
        $this->log($users, 'sae_shell');
        foreach ($users as $user) {
            $this->log($user, 'sae_shell');
            $save_data = array();
            if($user['User']['group_id'] == '2') {
                $actioner = 'manager';
            } else {
              $actioner = 'applicant'; 
            }
            $variables = array(
                'name' => $user['User']['name'],
                'reference_no' => $html->link($this->args[0]['reference_no'], array('controller' => 'saes', 'action' => 'view', $this->args[0]['id'], $actioner => true), array('escape' => false)),
                'protocol_no' => $this->args[0]['protocol_no']
            );
            $save_data = array('Notification' => array(
               'user_id' => $user['User']['id'],
               'type' => 'applicant_sae_submit',
               'model' => 'Sae',
               'foreign_key' => $this->args[0]['id'],
               'title' => String::insert($messages['Message']['subject'], $variables),
               'system_message' => String::insert($messages['Message']['content'], $variables),
               ),
            );

            $this->log($save_data, 'sae_shell');
            $this->log($variables, 'sae_shell');
            //Send notification
            $this->Notification->Create();
            if (!$this->Notification->save($save_data)) {
                 $this->log('The application could not be saved at applicantSaeSubmit. Please, try again.', 'notifications_error');
                 $this->log($save_data, 'sae_shell');
            }
            //Send Email
            $Email->config('gmail');
            $Email->template('default');
            $Email->emailFormat('html');
            if($actioner === 'applicant') $Email->to(($this->args[0]['email']) ? $this->args[0]['email'] : $user['User']['email']);
            else $email->to(($user['User']['email']) ? $user['User']['email'] : 'pv@pharmacyboardkenya.org');
            $Email->subject(String::insert($messages['Message']['subject'], $variables));
            $Email->viewVars(array('message' => String::insert($messages['Message']['content'], $variables)));
            if(!$Email->send()) {
                 $this->log($Email, 'applicant_sae_submit');
            }
            $this->log($Email, 'sae_shell');
        }
        
    }
   
}

