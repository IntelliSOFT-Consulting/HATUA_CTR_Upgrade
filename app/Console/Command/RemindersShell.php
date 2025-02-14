<?php
App::uses('CakeText', 'Utility');
App::uses('ThemeView', 'View');
App::uses('HtmlHelper', 'View/Helper');

class RemindersShell extends AppShell
{

    public $uses = array('Application', 'User','AuditTrail');

    public function main()
    {
        $protocols = $this->Application->find(
            'all',
            array(
                'contain' => array('User'),
                'conditions' => array(
                    'Application.submitted' => '0',
                    'Application.deleted' => '0', 
                    'DATE(Application.created) <=' => date("Y-m-d", strtotime("-5 days"))
                )
            )
        );
         
        foreach ($protocols as $response) { 

            $this->Application->id = $response['Application']['id']; // Set the record ID
            $this->Application->saveField('deleted', 1);
            $this->Application->saveField('deleted_date', date('Y-m-d H:i:s'));

            //***************************       Send Email and Notifications Managers    *****************************
            
            $data = array(
                'function' => 'unsubmittedApplication',
                'Application' => array(
                    'id' => $response['Application']['id'],
                    'name' => $response['User']['name'],
                    'email' => $response['User']['email'],
                    'protocol_no' => (!empty($response['Application']['protocol_no'])) ?  $response['Application']['protocol_no'] : $response['Application']['created']
                )
            );
            CakeResque::enqueue('default', 'NotificationShell', array('unsubmittedApplication', $data));
            $protocol_no =  (!empty($response['Application']['protocol_no'])) ?  $response['Application']['protocol_no'] : $response['Application']['created'];
            // Create a Audit Trail
            $audit = array(
                'AuditTrail' => array(
                    'foreign_key' => $response['Application']['id'],
                    'model' => 'Application',
                    'message' => 'Automatic protocol deletion Reminder sent to ' . $response['User']['name'] . ' for protocol number ' . $protocol_no,
                    'ip' => $protocol_no
                )
            ); 
            $this->AuditTrail->Create();
            if ($this->AuditTrail->save($audit)) {
                $this->log('success', 'notifications_success');
            } else {
                $this->log('Error creating an audit trail', 'notifications_error');
               
            }
            //**********************************    END   *********************************
        }
    }
}
