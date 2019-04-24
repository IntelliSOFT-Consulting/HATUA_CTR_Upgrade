<?php
App::uses('String', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('Router', 'Routing');
config('routes');
App::uses('Shell', 'Console');
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');

class UserShell extends Shell {
    public $uses = array('User', 'Message');

    public function perform() {
      $this->initialize();
      $this->{array_shift($this->args)}();
    }

   public function forgotPassword(){
        // $this->log($this->args[0]['User']['created'], 'forgot_email');
        $messages = $this->Message->find('list', array(
                                              'conditions' => array('Message.name' => array('forgot_email_subject', 'forgot_email')),
                                              'fields' => array('Message.name', 'Message.content')));
        $password = date('Ymdhis', strtotime($this->args[0]['User']['created']));
        // $this->log($password, 'forgot_email');
       $variables = array(
          'name' => $this->args[0]['User']['name'],
          'full_base_url' => FULL_BASE_URL,
          'ppb_ctr' => 'Pharmacy and Poisons Board Kenya Clinical Trials Registry',
          'username' => $this->args[0]['User']['username'],
          'reset_link' => Router::url(array('controller' => 'users', 'action' => 'resetPassword', $this->args[0]['User']['id']),  true),
          'password' => $password
       );

       $message = String::insert($messages['forgot_email'], $variables);
       $email = new CakeEmail();
       $email->config('gmail');
       $email->template('default');
       $email->emailFormat('html');
       $email->to($this->args[0]['User']['email']);
       $email->cc(array('pv@pharmacyboardkenya.org', 'info@pharmacyboardkenya.org'));
       $email->bcc(array('edward.okemwa@intellisoftkenya.com'));
       // $email->subject(Configure::read('Emails.registration.subject'));
       $email->subject($messages['forgot_email_subject']);
       $email->viewVars(array('message' => $message));
       if(!$email->send()) {
           $this->log($email, 'forgot_email');
       }
   }

}

