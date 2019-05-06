<?php

App::uses('Component', 'Controller');

class SiteBaseComponent extends Component {
    public $uses = array('SiteInspection', 'Application', 'SiteQuestion');

    public function view($id = null) {

    $this->SiteInspection = ClassRegistry::init('SiteInspection');
    $this->Application = ClassRegistry::init('Application');
    $this->SiteQuestion = ClassRegistry::init('SiteQuestion');
    
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            $this->Session->setFlash(__('No Protocol with given ID.'), 'alerts/flash_error');
            $this->redirect(array('controller' => 'users' , 'action' => 'dashboard'));
        }

        $trial_statuses = $this->Application->TrialStatus->find('list');
        $this->set(compact('trial_statuses'));

        $application = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $id),
            'contain' => array('Amendment', 'PreviousDate', 'InvestigatorContact', 'Sponsor', 'SiteDetail', 'Organization', 'Placebo',
                'Attachment', 'CoverLetter', 'Protocol', 'PatientLeaflet', 'Brochure', 'GmpCertificate', 'Cv', 'Finance', 'Declaration',
                'IndemnityCover', 'OpinionLetter', 'ApprovalLetter', 'Statement', 'ParticipatingStudy', 'Addendum', 'Registration', 'Fee', 
                'AnnualApproval', 'Document', 'Review', 'SiteInspection', 'SiteInspection' => array('SiteAnswer')
                // => array('conditions' => array('Review.type' => 'response'))
                )));
        $this->set('application', $application);
        $this->set('counties', $this->Application->SiteDetail->County->find('list'));
        $this->set('users', $this->Application->User->find('list', array('conditions' => array('User.group_id' => 3, 'User.is_active' => 1))));

        $this->request->data = $application;

        
    }
}

?>