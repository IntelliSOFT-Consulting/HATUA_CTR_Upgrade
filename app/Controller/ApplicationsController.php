<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
/**
 * Applications Controller
 *
 * @property Application $Application
 */
class ApplicationsController extends AppController {

    public $paginate = array();
    public $components = array('Search.Prg');
    public $presetVars = true; // using the model configuration

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view', 'view.pdf');
    }

/**
 * index method
 *
 * @return void
 */
    // public function index() {
    //  $this->Application->recursive = 0;
    //  $this->set('applications', $this->paginate());
    // }
public function index() {
        $this->Prg->commonProcess();
        $page_options = array('5' => '5', '10' => '10');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

            $criteria = $this->Application->parseCriteria($this->passedArgs);
            $criteria['Application.submitted'] = 1;
            $criteria['Application.approved'] = 2;
            $criteria['Application.deactivated'] = 0;
        $this->paginate['conditions'] = $criteria;
        $this->paginate['order'] = array('Application.created' => 'desc');
        $this->paginate['contain'] = array('InvestigatorContact', 'SiteDetail' => array('County'));

            $this->set('page_options', $page_options);
            $this->set('applications', Sanitize::clean($this->paginate(), array('encode' => false)));

        $trial_statuses = $this->Application->TrialStatus->find('list');
        $this->set(compact('trial_statuses'));
    }

    public function myindex() {
        $this->Application->recursive = 0;
        $this->set('applications', $this->paginate());
    }

    public function applicant_index() {
        $this->Prg->commonProcess();
        $page_options = array('5' => '5', '10' => '10');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

            $criteria = $this->Application->parseCriteria($this->passedArgs);
            $criteria['Application.user_id'] = $this->Auth->User('id');
        $this->paginate['conditions'] = $criteria;
        $this->paginate['order'] = array('Application.created' => 'desc');
        $this->paginate['contain'] = array('InvestigatorContact', 'SiteDetail' => array('County'));

            $this->set('page_options', $page_options);
            $this->set('applications', Sanitize::clean($this->paginate(), array('encode' => false)));

        $trial_statuses = $this->Application->TrialStatus->find('list');
        $this->set(compact('trial_statuses'));
    }

    public function manager_index() {
        $this->Prg->commonProcess();
        $page_options = array('5' => '5', '10' => '10');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

            $criteria = $this->Application->parseCriteria($this->passedArgs);
            if (!isset($this->passedArgs['submitted'])) $criteria['Application.submitted'] = 1;
        $this->paginate['conditions'] = $criteria;
        $this->paginate['order'] = array('Application.created' => 'desc');

        $this->paginate['contain'] = array(
            'Review' => array('conditions' => array('Review.type' => 'request', 'Review.accepted' => 'accepted')),
            'InvestigatorContact', 'SiteDetail' => array('County'));

            $this->set('page_options', $page_options);
            $this->set('applications', Sanitize::clean($this->paginate(), array('encode' => false)));
            $this->set('users', $this->Application->User->find('list', array('conditions' => array('User.group_id' => 3, 'User.is_active' => 1))));

        $trial_statuses = $this->Application->TrialStatus->find('list');
        $this->set(compact('trial_statuses'));
    }

    public function inspector_index() {
        $this->Prg->commonProcess();
        $page_options = array('5' => '5', '10' => '10');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

            $criteria = $this->Application->parseCriteria($this->passedArgs);
            if (!isset($this->passedArgs['submitted'])) $criteria['Application.submitted'] = 1;
        $this->paginate['conditions'] = $criteria;
        $this->paginate['order'] = array('Application.created' => 'desc');

        $this->paginate['contain'] = array(
            'Review' => array('conditions' => array('Review.type' => 'request', 'Review.accepted' => 'accepted')),
            'InvestigatorContact', 'SiteDetail' => array('County'));

            $this->set('page_options', $page_options);
            $this->set('applications', Sanitize::clean($this->paginate(), array('encode' => false)));
            $this->set('users', $this->Application->User->find('list', array('conditions' => array('User.group_id' => 3, 'User.is_active' => 1))));

        $trial_statuses = $this->Application->TrialStatus->find('list');
        $this->set(compact('trial_statuses'));
    }

    public function reviewer_index() {
        $this->Prg->commonProcess();
        $page_options = array('5' => '5', '10' => '10');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

        $my_applications = $this->Application->Review->find('list', array(
            'conditions' => array('Review.user_id' => $this->Auth->User('id'), 'Review.type' => 'request', 'Review.accepted' => 'accepted'),
            'fields' => array('Review.application_id')));

            $criteria = $this->Application->parseCriteria($this->passedArgs);
            $criteria['Application.submitted'] = 1;
            $criteria['Application.id'] = $my_applications;
        $this->paginate['conditions'] = $criteria;
        $this->paginate['order'] = array('Application.created' => 'desc');
        $this->paginate['contain'] = array('InvestigatorContact', 'SiteDetail' => array('County'));

            $this->set('page_options', $page_options);
            $this->set('applications', Sanitize::clean($this->paginate(), array('encode' => false)));

        $trial_statuses = $this->Application->TrialStatus->find('list');
        $this->set(compact('trial_statuses'));
    }

    public function partner_index() {
        $this->Prg->commonProcess();
        $page_options = array('5' => '5', '10' => '10');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

            $criteria = $this->Application->parseCriteria($this->passedArgs);
            $criteria['Application.user_id'] = $this->Auth->User('id');
        $this->paginate['conditions'] = $criteria;
        $this->paginate['order'] = array('Application.created' => 'desc');
        $this->paginate['contain'] = array('InvestigatorContact', 'SiteDetail' => array('County'));

            $this->set('page_options', $page_options);
            $this->set('applications', Sanitize::clean($this->paginate(), array('encode' => false)));
    }

    public function admin_index() {
        $this->Prg->commonProcess();
        // $this->Application->softDelete(false);
        $page_options = array('5' => '5', '10' => '10');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

            $criteria = $this->Application->parseCriteria($this->passedArgs);
            // if (!isset($this->passedArgs['submitted'])) $criteria['Application.submitted'] = 1;
        $this->paginate['conditions'] = $criteria;
        $this->paginate['order'] = array('Application.created' => 'desc');

        $this->paginate['contain'] = array(
            'Review' => array('conditions' => array('Review.type' => 'request', 'Review.accepted' => 'accepted')),
            'InvestigatorContact', 'SiteDetail' => array('County'));

            $this->set('page_options', $page_options);
            $this->set('applications', Sanitize::clean($this->paginate(), array('encode' => false)));
            $this->set('users', $this->Application->User->find('list', array('conditions' => array('User.group_id' => 3, 'User.is_active' => 1))));

        $trial_statuses = $this->Application->TrialStatus->find('list');
        $this->set(compact('trial_statuses'));

    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            throw new NotFoundException(__('Invalid application'));
        }
        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'Application_' . $id,  'orientation' => 'portrait');
        }
        $this->set('application', $this->Application->read(null, $id));
    }

    public function applicant_view($id = null) {        
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            $this->Session->setFlash(__('No Protocol with given ID.'), 'alerts/flash_error');
            $this->redirect(array('controller' => 'users' , 'action' => 'dashboard'));
        }

        $response = $this->_isOwnedBy($id);

        $this->set('application', $response);
        $this->set('counties', $this->Application->SiteDetail->County->find('list'));

        if ($response['Application']['deactivated'] || $response['Application']['approved'] == 1) {
            $this->render('applicant_minimal_view');
        }

        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'Application_' . $id,  'orientation' => 'portrait');
        }

        $trial_statuses = $this->Application->TrialStatus->find('list');
        $this->set(compact('trial_statuses'));
        
        if ($this->request->is('post')) {

            $this->Application->create();
            // if ($this->Application->save($this->request->data, true, array('id', 'trial_status_id'))) {
            if (!isset($this->request->data['Application']['id']) || empty($this->request->data['Application']['id'])) {
                $this->Session->setFlash(__('No Protocol with given ID.'), 'alerts/flash_error');
                $this->redirect(array('controller' => 'users' , 'action' => 'dashboard'));
            } elseif (empty($this->request->data)) {
                $this->set('response', array('message' => 'Failure', 'errors' => 'The file you provided could not be saved. Kindly ensure that the file is less than
                    4.7MB in size. <small>If it is larger, compress (zip,tar...) it to the required size first</small>'));
            } elseif (!$this->Application->saveAll($this->request->data, array(
                'validate' => 'only',
                'fieldList' => array(
                    'Attachment' => 'file'
                    )))) {
                $this->set('response', array('message' => 'Failure', 'errors' => 'The file(s) is not valid. If the file(s) are more than
                    4.7MB in size please compress them to below 4.7MB first.'));
            } else {
                if ($this->Application->saveAssociated($this->request->data, array('validate' => false))) {
                    // $this->log($this->Application->Document->id,'debug');

                    if(isset($this->request->data['Application']['trial_status_id']) ||
                        isset($this->request->data['Application']['final_report'])) {
                        //Only updating trial_status_id i.e. Current status of the trial
                        $this->set('response', array('message' => 'Success'));
                    } else {
                        // -- Changed from
                        /*$this->set('response', array(
                        'message' => 'Success',
                        'content' => $this->Application->AnnualApproval->find('first',
                            array('conditions' =>array('Attachment.id' => $this->Application->AnnualApproval->id),
                                   'contain' => array()))));*/
                        // -- to
                        if (isset($this->request->data['AnnualApproval'])) 
                            $this->set('response', array(
                                'message' => 'Success',
                                'content' => $this->Application->Attachment->find('first',
                                    array('conditions' =>array('Attachment.id' => $this->Application->AnnualApproval->id),
                                           'contain' => array()))));
                            CakeResque::enqueue('default', 'ManagerShell', array('newAnnualApproval', $response));
                        if (isset($this->request->data['Document'])) 
                            $this->set('response', array(
                                'message' => 'Success',
                                'content' => $this->Application->Attachment->find('first',
                                    array('conditions' =>array('Attachment.id' => $this->Application->Document->id),
                                           'contain' => array()))));                        
                            CakeResque::enqueue('default', 'ManagerShell', array('newFinalReport', $response));
                    }               
                    
                } else {
                    // $this->log($this->Application->validationErrors,'debug');
                    $this->set('response', array('message' => 'Failure', 'errors' => $this->Application->validationErrors));
                }
            }
            $this->set('_serialize', 'response');
        }
        if(strpos($this->request->url, 'pdf') === false && !$response['Application']['submitted'] && !$response['Application']['deactivated']) {
            $this->Session->setFlash('This application is not yet submitted', 'alerts/flash_info');
            $this->redirect(array('action' => 'edit', $response['Application']['id']));
        }
        
    }

    private function aview($id = null) {
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
                'AnnualApproval', 'Document', 'Review', 'SiteInspection', 
                'SiteInspection' => array('SiteAnswer', 'Attachment', 'InternalComment' => array('Attachment'), 'ExternalComment' => array('Attachment'), 'User')
                )));
        $this->set('application', $application);
        $this->set('counties', $this->Application->SiteDetail->County->find('list'));
        $this->set('users', $this->Application->User->find('list', array('conditions' => array('User.group_id' => 3, 'User.is_active' => 1))));

        $this->request->data = $application;

        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'Application_' . $id,  'orientation' => 'portrait');
        }
    }
    public function manager_view($id = null) {
        $this->aview($id);
    }
    public function inspector_view($id = null) {
        $this->aview($id);
    }

    public function admin_view($id = null) {
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            $this->Session->setFlash(__('No Protocol with given ID.'), 'alerts/flash_error');
            $this->redirect(array('controller' => 'users' , 'action' => 'dashboard'));
        }
        
        $trial_statuses = $this->Application->TrialStatus->find('list');
        $this->set(compact('trial_statuses'));

        $this->set('application', $this->Application->find('first', array(
            'conditions' => array('Application.id' => $id),
            'contain' => array('Amendment', 'PreviousDate', 'InvestigatorContact', 'Sponsor', 'SiteDetail', 'Organization', 'Placebo',
                'Attachment', 'CoverLetter', 'Protocol', 'PatientLeaflet', 'Brochure', 'GmpCertificate', 'Cv', 'Finance', 'Declaration',
                'IndemnityCover', 'OpinionLetter', 'ApprovalLetter', 'Statement', 'ParticipatingStudy', 'Addendum', 'Registration', 'Fee', 
                'AnnualApproval', 'Document', 'Review'
                ))));
        $this->set('counties', $this->Application->SiteDetail->County->find('list'));
        $this->set('users', $this->Application->User->find('list', array('conditions' => array('User.group_id' => 3, 'User.is_active' => 1))));

        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'Application_' . $id,  'orientation' => 'portrait');
        }
        /*+++++++++++++++++++ADMIN UPDATE FIELDS++++++++++++++++++++*/
        if ($this->request->is('post')) {
            $this->Application->create();
            if(empty($this->request->data['Application']['id'])) $this->request->data['Application']['id'] = $id;

            $this->request->data['Application']['id'] = $id;
            $fieldList = array('id');
            $temp = array();
            foreach ($this->request->data as $key => $value) {
                if ($key == 'Application') $temp[$key] = array_keys($value);
                else {
                    $temp[$key] = array_keys(current($value));
                }
            }
            // $this->log($temp,'debug');
            /*if(isset($this->request->data['Application']['approval_date'])) $fieldList[] = 'approval_date';
            if(isset($this->request->data['Application']['protocol_no'])) $fieldList[] = 'protocol_no';
            if(isset($this->request->data['Application']['investigator1_telephone'])) $fieldList[] = 'investigator1_telephone';
            if(isset($this->request->data['Application']['investigator1_email'])) $fieldList[] = 'investigator1_email';*/
            if (    $this->request->data['Application']['id'] &&
                $this->Application->saveAssociated($this->request->data, array('fieldList' => $temp))) {
                    $message = array('message' => 'Success');
            } else {
                $message = array('message' => 'Failure');
            }
            $errors = $this->Application->validationErrors;
            $this->set(compact('message', 'errors'));
                $this->set('_serialize', array('message', 'errors'));
            // $this->set('_serialize', 'message');
        }
    }

    public function manager_approve($id = null) {
        if ($this->request->is('post')) {
            // pr($this->request->data);
            if ($this->request->data['Application']['approved'] == null) {
                $this->Session->setFlash(__('Please select if approved or not.'), 'alerts/flash_error');
                $this->redirect(array('action' => 'view', $id));
            } else {
                if($this->Auth->password($this->request->data['Application']['password']) === $this->Auth->User('confirm_password')) {
                    $this->Application->create();
                    if ($this->Application->save($this->request->data, true, array('id', 'approved', 'approved_reason', 'approval_date'))) {
                        $data = array(
                            'application_id' => $this->Application->id,
                            'message' => $this->request->data['Application']['approved_reason'],
                            'manager' => $this->Auth->User('id'));
                        CakeResque::enqueue('default', 'NotificationShell', array('managerApproveApplication', $data));
                        $this->Session->setFlash(__('successfully approved the protocol.'), 'alerts/flash_success');
                        $this->redirect(array('action' => 'view', $id));
                    } else {
                        $this->Session->setFlash(__('Error. Unable to update protocol.'), 'alerts/flash_error');
                        $this->redirect(array('action' => 'view', $id));
                    }
                } else {
                    $this->Session->setFlash(__('The password you have entered is not correct! Please enter the correct password
                        and try again.'), 'alerts/flash_error');
                    $this->redirect(array('action' => 'view', $id));
                }
            }
        } else {
            $this->Session->setFlash(__('Not post.'), 'alerts/flash_info');
            $this->redirect(array('action' => 'view', $id));
        }
    }

    public function manager_view_notification($id = null, $notification = null) {
        $this->Application->id = $id;
        if (!$this->Application->exists() || empty($notification)) {
            $this->Session->setFlash(__('No Protocol with given ID.'), 'alerts/flash_info');
            $this->redirect(array('controller' => 'users' , 'action' => 'dashboard'));
        } else {
            $this->loadModel('Notification');
            $this->Notification->id = $notification;
            if($this->Notification->delete()) {
                // $this->Session->setFlash(__('Click the assigned reviewers tab to view response.'), 'alerts/flash_success');
                $this->redirect(array('action' => 'view', $id));
            } else {
                // $this->Session->setFlash(__('Click the assigned reviewers tab to view response.'), 'alerts/flash_info');
                $this->redirect(array('action' => 'view', $id));
            }
        }
    }

    public function inspector_view_notification($id = null, $notification = null) {
        $this->Application->id = $id;
        if (!$this->Application->exists() || empty($notification)) {
            $this->Session->setFlash(__('No Protocol with given ID.'), 'alerts/flash_info');
            $this->redirect(array('controller' => 'users' , 'action' => 'dashboard'));
        } else {
            $this->loadModel('Notification');
            $this->Notification->id = $notification;
            if($this->Notification->delete()) {
                // $this->Session->setFlash(__('Click the assigned reviewers tab to view response.'), 'alerts/flash_success');
                $this->redirect(array('action' => 'view', $id));
            } else {
                // $this->Session->setFlash(__('Click the assigned reviewers tab to view response.'), 'alerts/flash_info');
                $this->redirect(array('action' => 'view', $id));
            }
        }
    }

    public function reviewer_view($id = null) {
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            throw new NotFoundException(__('Invalid application'));
        }

        #TODO: in this condition, add the search for if I have accepted to review the app
        $my_applications = $this->Application->Review->find('list', array(
            'conditions' => array('Review.user_id' => $this->Auth->User('id'), 'Review.type' => 'request'),
            'fields' => array('Review.application_id', 'Review.accepted')));
        if (isset($my_applications[$id])) {
            if ($my_applications[$id] == 'accepted') {
                $application = $this->Application->find('first', array(
                    'conditions' => array('Application.id' => $id),
                    'contain' => array('Amendment', 'PreviousDate', 'InvestigatorContact', 'Sponsor', 'SiteDetail', 'Organization',
                        'Placebo', 'Attachment', 'CoverLetter', 'Protocol', 'PatientLeaflet', 'Brochure', 'GmpCertificate', 'Cv', 'Finance',
                        'Declaration', 'IndemnityCover', 'OpinionLetter', 'ApprovalLetter', 'Statement', 'ParticipatingStudy', 'Addendum', 
                        'AnnualApproval', 'Document', 'Registration', 'Fee', 'Review' => array(
                            'conditions' => array('Review.user_id' => $this->Auth->User('id'),  'Review.type' => 'reviewer_comment')))));
                $this->set('counties', $this->Application->SiteDetail->County->find('list'));
                $this->set('application', $application);
                if ($application['Application']['deactivated']) {
                    $this->render('reviewer_minimal_view');
                }
            } else {
                $this->Session->setFlash(__('You have declined to review this protocol.'), 'alerts/flash_info');
                $this->redirect(array('action' => 'index'));
            }
        } else {
            $application = $this->Application->find('first', array(
                    'conditions' => array('Application.id' => $id),
                    'contain' => array('Review' => array('conditions' => array('Review.user_id' => $this->Auth->User('id')))),
                ));
            $this->set('application', $application);
            $this->render('reviewer_minimal_view');
        }

        if ($application['Application']['deactivated'] || $application['Application']['approved'] == 1) {
            $this->render('applicant_minimal_view');
        }

        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'Application_' . $id,  'orientation' => 'portrait');
        }
    }

/**
 * add method
 *
 * @return void
*/
    /*public function applicant_add() {
        if ($this->request->is('post')) {
            $this->Application->create();
            $reviews = array('user_id' => $this->Auth->user('id'), 'description' => 'Applicant create');
            $this->request->data['Reviewer'][] = $reviews;
            if ($this->Application->saveAssociated($this->request->data, array('validate' => false))) {
                $this->Session->setFlash(__('The application has been created'), 'alerts/flash_success');
                $this->redirect(array('action' => 'applicant_edit', $this->Application->id));
            } else {
                $this->Session->setFlash(__('The application could not be saved. Please, try again.'));
            }
        }
    }*/
    /*public function applicant_add() {
        if ($this->request->is('post')) {
            $this->Application->create();
            $this->request->data['Application']['user_id'] = $this->Auth->User('id');
            if ($this->Application->save($this->request->data, true, array('email_address'))) {
                $this->Session->setFlash(__('The application has been created'), 'alerts/flash_success');
                $this->redirect(array('action' => 'applicant_edit', $this->Application->id));
            } else {
                $this->Session->setFlash(__('The application could not be saved. Please, try again.'), 'alerts/flash_error');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
        }
    }*/

    /*public function partner_add() {
        if ($this->request->is('post')) {
            $this->Application->create();
            $this->request->data['Application']['user_id'] = $this->Auth->User('id');
            //pr($this->request->data);
            if ($this->Application->save($this->request->data, true, array('email_address'))) {
                $this->Session->setFlash(__('The application has been created'), 'alerts/flash_success');
                $this->redirect(array('action' => 'partner_edit', $this->Application->id));
            } else {
                $this->Session->setFlash(__('The application could not be saveder. Please, try again.'), 'alerts/flash_error');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
        }
    }*/

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function applicant_edit($id = null) {
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            $this->Session->setFlash(__('Application not found.'), 'alerts/flash_error');
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
        }

        $response = $this->_isApplicant($id);

        if ($response['Application']['deactivated']) {
            $this->redirect(array('action' => 'view', $id));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if (isset($this->request->data['cancelReport'])) {
                $this->Session->setFlash(__('Form cancelled.'), 'alerts/flash_info');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            $validate = false;
            if (isset($this->request->data['submitReport'])) {
                $validate = 'first';
                $this->request->data['Application']['submitted'] = 1;
                $this->request->data['Application']['date_submitted'] = date('Y-m-d H:i:s');
                if (empty($response['Application']['protocol_no'])) {
                    $count = $this->Application->find('count',  array('conditions' => array(
                            'Application.date_submitted BETWEEN ? and ?' => array(date("Y-m-01 00:00:00"), date("Y-m-d H:i:s")))));
                    $count++;
                    $count = ($count < 10) ? "0$count" : $count;
                    $this->request->data['Application']['protocol_no'] = 'ECCT/'.date('y/m').'/'.$count;
                }
            }

            $filedata = $this->request->data;
            unset($filedata['Application']);
            if(empty($this->request->data)) {
                $message = 'The file you provided could not be saved. Kindly ensure that the file is less than
                        4.7MB in size. <small>If it is larger, compress (zip,tar...) it to the required size first</small>';
                if($this->RequestHandler->isAjax()) {
                    $this->set('response', array('message' => 'Failure', 'errors' => $message));
                } else {
                    $this->Session->setFlash(__($message), 'alerts/flash_error');
                    $this->redirect(array('action' => 'edit', $id));
                }

            }
              elseif (!$this->Application->saveAll($filedata, array(
                'validate' => 'only',
                'fieldList' => array(
                    'Attachment' => 'file'
                    )))) {
                $message = 'The file is not valid. If the file is more than 4.7MB in size please compress it to below 4.7MB first.
                If the file is an image file, ensure the image resolution is within 1600X1600 pixels.';
                if($this->RequestHandler->isAjax()) $this->set('response', array('message' => 'Failure', 'errors' => $message));
                else $this->Session->setFlash(__($message), 'alerts/flash_error');
            }
            else {
                if ($this->Application->saveAssociated($this->request->data, array('validate' => $validate, 'deep' => true))) {
                    if($validate) {
                           $data = array(
                            'function' => 'ppbNewApplication',
                            'Application' => array(
                                'id' => $this->request->data['Application']['id'],
                                'name' => $this->Auth->user('name'),
                                'email' => $this->Auth->user('email'),
                                'protocol_no' => (!empty($response['Application']['protocol_no'])) ?  $response['Application']['protocol_no'] : $this->request->data['Application']['protocol_no']
                            )
                           );
                           CakeResque::enqueue('default', 'NotificationShell', array('ppbNewApplication', $data));

                        $this->Session->setFlash(__('You have successfully submitted the application to PPB.
                            Your assigned protocol number is '.$data['Application']['protocol_no'].'. PPB will review
                            this application and notify you on the progress. You can view the progress of the application by clicking on
                            &lsquo;my applications&rsquo; on the dashboard menu. Thank you.'), 'alerts/flash_success');
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $message = 'The change to the application has been saved. You may continue editing the report. Remember to submit the report when you are done.';
                        if($this->RequestHandler->isAjax()) {
                            // $this->set('response', array('message' => 'Success', 'content' => $message));
                            $this->set('response', array(
                                'message' => 'Success',
                                'content' => $this->Application->Attachment->find('first',
                                    array('conditions' =>array(
                                        'Attachment.id' => $this->Application->{array_pop(array_keys($this->request->data))}->id),
                                           'contain' => array()))));
                        } else {
                            $this->Session->setFlash(__($message), 'alerts/flash_success');
                            $this->redirect(array('action' => 'edit', $this->Application->id));
                        }
                    }
                } else {
                    $message = 'The application was not successfully submitted. Please correct the errors below..';
                    if($this->RequestHandler->isAjax()) {
                        $this->set('response', array('message' => 'Failure', 'errors' => $message));
                    } else {
                        $this->Session->setFlash(__($message), 'alerts/flash_error');
                    }
                }
            }
            if($this->RequestHandler->isAjax()) $this->set('_serialize', 'response');
        } else {
            $this->request->data = $response;
        }
        $counties = $this->Application->SiteDetail->County->find('list', array('order' => 'County.county_name ASC'));
        $this->set(compact('counties'));
    }

    public function partner_edit($id = null) {
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            $this->Session->setFlash(__('Application not found.'), 'alerts/flash_error');
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
        }

        $response = $this->_isApplicant($id);

        if ($this->request->is('post') || $this->request->is('put')) {
            if (isset($this->request->data['cancelReport'])) {
                $this->Session->setFlash(__('Form cancelled.'), 'alerts/flash_info');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            $validate = false;
            if (isset($this->request->data['submitReport'])) {
                $validate = 'first';
                $this->request->data['Application']['submitted'] = 1;
                $this->request->data['Application']['date_submitted'] = date('Y-m-d H:i:s');
                if (empty($response['Application']['protocol_no'])) {
                    $count = $this->Application->find('count',  array('conditions' => array(
                        'Application.submitted' => 1,
                        'Application.date_submitted BETWEEN ? and ?' => array(date("Y-m-01 H:i:s"), date("Y-m-d H:i:s")))));
                    $count++;
                    $count = ($count < 10) ? "0$count" : $count;
                    $this->request->data['Application']['protocol_no'] = 'ECCT/'.date('y/m').'/'.$count;
                }
            }
            // $this->data = Sanitize::clean($this->data, array('encode' => false));
            if ($this->Application->saveAssociated($this->request->data, array('validate' => $validate, 'deep' => true))) {
                if($validate) {
                    $this->Session->setFlash(__('You have successfully submitted the application to PPB. PPB will review
                        this application and notify you on the progress. You can view the progress of the application by clicking on
                        &#39;my applications&#39; on the dashboard menu. Thank you.'), 'alerts/flash_success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The application has been saved'), 'alerts/flash_success');
                    $this->redirect(array('action' => 'edit', $this->Application->id));
                }
            } else {
                $this->Session->setFlash(__('The application was not successfully submitted. Please correct the errors below.'), 'alerts/flash_error');
            }
        } else {
            $this->request->data = $response;
        }
        $counties = $this->Application->SiteDetail->County->find('list', array('order' => 'County.county_name ASC'));
        $this->set(compact('counties'));
        $this->set('protocol_no', $response['Application']['protocol_no']);
        // $trial_statuses = $this->Application->TrialStatus->find('list');
        // $this->set(compact('trial_statuses'));
    }

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            throw new NotFoundException(__('Invalid application'));
        }
        if ($this->Application->delete()) {
            $this->Session->setFlash(__('Application deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Application was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function applicant_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            throw new NotFoundException(__('Invalid application'));
        }
        $this->_isApplicant($id);
        if (!$this->Application->delete()) {
            $this->Session->setFlash(__('Application deleted'), 'alerts/flash_success');
            $this->redirect(array('controller' =>'users', 'action' => 'dashboard'));
        }
        $this->Session->setFlash(__('Application was not deleted'), 'alerts/flash_error');
        $this->redirect(array('controller' =>'users', 'action' => 'dashboard'));
    }

    public function manager_delete($id = null) {
        if (!$this->request->is('post')) {
            $this->Session->setFlash(__('Application does not exist!'), 'alerts/flash_error');
            $this->redirect($this->referer());
        }
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            throw new NotFoundException(__('Invalid application'));
        }
        if (!$this->Application->delete()) {
            $this->Session->setFlash(__('Application deleted'), 'alerts/flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Application was not deleted'), 'alerts/flash_error');
        $this->redirect(array('controller' =>'users', 'action' => 'dashboard'));
    }

    public function admin_delete($id = null, $delete = true) {
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            $this->Session->setFlash(__('Application does not exist!'), 'alerts/flash_error');
            $this->redirect($this->referer());
        }

        if ($delete) {
            if (!$this->Application->delete()) {
                $this->Session->setFlash(__('Application deleted'), 'alerts/flash_success');
            }
        } else {
            if ($this->Application->saveField('deleted', $delete)) {
                $this->Session->setFlash(__('The application has been successfully Undeleted.'), 'alerts/flash_success');
            }
        }
        $this->redirect($this->referer());
    }

    public function manager_deactivate($id = null, $activate = true) {
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            $this->Session->setFlash(__('Application does not exist!'), 'alerts/flash_error');
            $this->redirect(array('action' => 'index'));
        }

        if($this->Application->saveField('deactivated', $activate)) {
            if($activate) $this->Session->setFlash(__('The application has been successfully Deactivated.'),
                'alerts/flash_success');
            else $this->Session->setFlash(__('The application has been successfully Reactivated.'),
                'alerts/flash_success');
            $this->redirect(array( 'action' => 'view', $id));
        }
    }

    public function admin_unsubmit($id = null) {
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            $this->Session->setFlash(__('Application does not exist!'), 'alerts/flash_error');
            $this->redirect(array('action' => 'index'));
        }

        if($this->Application->saveField('submitted', 0)) {
            $this->Session->setFlash(__('The application has been successfully Unsubmitted.
                The user is now able to edit the application.'), 'alerts/flash_success');
            $this->redirect($this->referer());
        }
    }

/**
* Utility Methods
*/
    protected function _isApplicant($id) {
        // $response = $this->Application->isOwnedBy($id, $this->Auth->user('id'));
        $response = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $id),
            'contain' => array('Amendment', 'PreviousDate', 'InvestigatorContact', 'Sponsor', 'SiteDetail', 'Organization', 'Placebo',
                    'Attachment', 'CoverLetter', 'Protocol', 'PatientLeaflet', 'Brochure', 'GmpCertificate', 'Cv', 'Finance', 'Declaration',
                    'IndemnityCover', 'OpinionLetter', 'ApprovalLetter', 'Statement', 'ParticipatingStudy', 'Addendum', 'Registration', 'Fee')));
        if($response['Application']['user_id'] != $this->Auth->user('id')) {
            $this->log("_isOwnedBy: application id = ".$response['Application']['id']." User = ".$this->Auth->user('id'),'debug');
            $this->Session->setFlash(__('You do not have permission to access this resource'), 'alerts/flash_error');
            $this->redirect(array('action' => 'index'));
        } elseif ($response['Application']['submitted']) {
            $this->Session->setFlash(__('You cannot edit this application because it has been submitted to PPB.'), 'alerts/flash_error');
            $this->redirect(array('action' => 'index'));
        }
        return $response;
    }


    protected function _isOwnedBy($id) {
        // $response = $this->Application->isOwnedBy($id, $this->Auth->user('id'));
        $response = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $id),
            'contain' => array('Amendment' => array('Attachment'), 'PreviousDate', 'InvestigatorContact', 'Sponsor', 'SiteDetail', 'Organization', 'Placebo',
                'Attachment', 'CoverLetter', 'Protocol', 'PatientLeaflet', 'Brochure', 'GmpCertificate', 'Cv', 'Finance', 'Declaration',
                'IndemnityCover', 'OpinionLetter', 'ApprovalLetter', 'Statement', 'ParticipatingStudy', 'Addendum', 'Registration', 'Fee', 
                'AnnualApproval', 'Document', 'Review' => array('conditions' => array('Review.type' => 'ppb_comment')), 'SiteInspection', 
                'SiteInspection' => array(
                        'conditions' => array('SiteInspection.summary_approved' => 2),
                        'SiteAnswer', 'Attachment', 'InternalComment' => array('Attachment'), 'ExternalComment' => array('Attachment')
                    )
                )
            // 'contain' => array('Amendment' => array('Attachment'), 'PreviousDate', 'InvestigatorContact', 'Sponsor', 'SiteDetail',
            //     'Organization', 'Placebo', 'CoverLetter', 'Protocol', 'PatientLeaflet', 'Brochure', 'GmpCertificate', 'Cv', 'Finance', 'Declaration',
            //         'IndemnityCover', 'OpinionLetter', 'ApprovalLetter', 'Statement', 'ParticipatingStudy', 'Addendum', 'Registration', 'Fee',
            //         'Attachment', 'AnnualApproval', 'Document', 'Review' => array('conditions' => array('Review.type' => 'ppb_comment')),
            //     )
            )
        );
        if($response['Application']['user_id'] != $this->Auth->user('id')) {
            $this->log("_isOwnedBy: application id = ".$response['Application']['id']." User = ".$this->Auth->user('id'),'debug');
            $this->Session->setFlash(__('You do not have permission to access this resource.'), 'alerts/flash_error');
            $this->redirect(array('action' => 'index'));
        }
        return $response;
    }
}
