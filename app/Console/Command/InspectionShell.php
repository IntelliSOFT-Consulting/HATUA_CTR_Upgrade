<?php
App::uses('String', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('Router', 'Routing');
config('routes');
App::uses('Shell', 'Console');
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');

class InspectionShell extends Shell {
    public $uses = array('User', 'Application', 'Amendment','Review', 'Notification', 'Message');
    
    public function perform() {
      $this->initialize();
      $this->{array_shift($this->args)}();
    }

    public function  newInspectionNotifyInspector() {
        $messages = $this->Message->find('first', array(
                                    'conditions' => array('Message.name' => array('inspector_new_inspection'))));

        $save_data = array();
        if($this->args[0]['group_id'] == '2') $actioner = 'manager';
        elseif($this->args[0]['group_id'] == '6') $actioner = 'inspector';
        $variables = array(
            'protocol_link' => Router::url(array('controller' => 'applications', 'action' => 'view', $this->args[0]['application_id'],
                                           $actioner => true), true),
            'protocol_no' => $this->args[0]['protocol_no']
        );
        $save_data = array('Notification' => array(
           'user_id' => $this->args[0]['user_id'],
           'type' => 'inspector_new_inspection',
           'model' => 'SiteInspection',
           'foreign_key' => $this->args[0]['id'],
           'system_message' => String::insert($messages['Message']['content'], $variables),
           ),
        );

        $this->Notification->Create();
        if ($this->Notification->save($save_data)) {
             $this->log('The application could not be saved at newInspectionNotifyInspector. Please, try again.', 'notifications_error');
             $this->log($save_data, 'notifications_error');
        }
    }
   
}

