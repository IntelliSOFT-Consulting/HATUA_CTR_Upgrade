<?php
App::uses('String', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('Router', 'Routing');
config('routes');
App::uses('Shell', 'Console');
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
App::uses('CakeResque', 'CakeResque.Lib');

class TestShell extends AppShell {
    public $uses = array('User', 'Application', 'Amendment','Review', 'Notification', 'Message');
    
    public function main() {
       $this->out('Hello world.');
       $email = new CakeEmail();
       $email->config('gmail'); 
    //    $email->to('jkiprotich@intellisoftkenya.com');
       $email->to('cgichuki@intellisoftkenya.com');
    // $email->to('kiprotich.japheth19@gmail.com');
       // $email->subject(Configure::read('Emails.registration.subject'));
       $email->subject('test email');
       //$email->viewVars(array('message' => 'This is a dummy message. seen'));
       if(!$email->send('My message to you')) {
           $this->log($email, 'test_email');
           $this->out('Experienced problems!!.');
        }else{
         $this->out('Successfully Sent!!!.');
        }
    }
    public function que(){
           // Enqueue the job
    $data=CakeResque::enqueue('default', 'NotificationShell', array('registrationEmail', array('email' => 'jkiprotich@intellisoftkenya.com'))); 
    $this->log($data, $data);
    // Wait for the job to be processed
    // $processed = false;
    // $start_time = time();
    // while (!$processed && time() - $start_time < 10) {
    //   $status = CakeResque::status();
    //   $processed = $status['default']['processed'] > 0;
    //   sleep(1);
    // }
    
    // Verify that the job was processed
    // $this->assertTrue($processed, 'Job was not processed');
    
    // Check the output of the job
    // $expected_output = 'Email sent to test@example.com';
    // $this->assertContains($expected_output, file_get_contents(LOGS . 'resque.log'), 'Expected output was not found in log');
 
    }
}
