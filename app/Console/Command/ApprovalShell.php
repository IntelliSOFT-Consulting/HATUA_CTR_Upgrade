<?php
App::uses('String', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('Router', 'Routing');
config('routes');
App::uses('Shell', 'Console');
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');

class ApprovalShell extends Shell {
    public $uses = array('User', 'Application', 'Amendment','Review', 'Notification', 'Message');
    
    //send email method
    private function  sendEmail($message = null) {        
        $Email = new CakeEmail();
        //Send Email
        $Email->config('gmail');
        $Email->template('default');
        $Email->emailFormat('html');
        $Email->to($message['email']);

        // $Email->subject(String::insert($messages['Message']['subject'], $variables));
        $Email->subject($message['subject']);
        // $Email->viewVars(array('message' => String::insert($messages['Message']['content'], $variables)));
        $Email->viewVars(array('message' => $message['message']));
        $this->log($Email, 'approval-email');
        if(!$Email->send()) {
            $this->log($Email, 'approval-email');
        }        
    }
    
    public function approval_status() {
        // fetch all submitted and approved protocols with annual letter 30 days to expiry and reminder not sent
        //send email and notification to renew application and persist reminder
        //Reminders should not be sent to completed studies

        // Prompt Manager/Reviewer to approve complete and unapproved protcols
    }


}

