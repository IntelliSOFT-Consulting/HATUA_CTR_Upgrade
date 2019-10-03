<?php
App::uses('AppController', 'Controller');
App::uses('String', 'Utility');
App::uses('ThemeView', 'View');
App::uses('HtmlHelper', 'View/Helper');
App::uses('Sanitize', 'Utility');
App::uses('CakeTime', 'Utility');
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
        $this->Auth->allow('index', 'view', 'view.pdf', 'apl', 'apn', 'study_title', 'myindex');
    }

/**
 * stages method
 *
 * @return array
 */
    public function stages($id = null) {
        $stages = [];
        $application = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $id),
            'contain' => array('Review')
        ));
        if ($application) {
            if ($application['Application']['protocol_no']) {
                $application_name = $application['Application']['protocol_no'];
            } elseif ($application['Application']['short_title']) {
                $application_name = $application['Application']['short_title'];
            } else {
                $application_name = $application['Application']['created'];
            }
        
            //creation
            $csd = new DateTime($application['Application']['created']);            
            $ccolor = 'success';
            $stages['Creation'] = ['application_name' => $application_name, 'label' => 'Start', 'days' => '', 'start_date' => $csd->format('d-M-Y'), 'color' => $ccolor];

            //Applicant submit
            $stages['Submit'] = ['label' => 'Submit', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
            if ($application['Application']['submitted']) {
                $ced = ($application['Application']['date_submitted']) ? new DateTime($application['Application']['date_submitted']) : new DateTime();
                $cdays = $ced->diff($csd)->format('%a');
                $stages['Creation']['end_date'] = $ced->format('d-M-Y');
                $stages['Creation']['days'] = $cdays;

                $stages['Submit']['start_date'] = $ced->format('d-M-Y');         
                $stages['Submit']['color'] = 'success';         
            }

            //Review
            // debug(Hash::extract($application, 'Review.{n}[id=2].id'));
            $stages['Review'] = ['label' => 'Review', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
            if (in_array('request', Hash::extract($application, 'Review.{n}.type'))) {
                $rsd = new DateTime(min(Hash::extract($application, 'Review.{n}.created')));
                $stages['Submit']['end_date'] = $rsd->format('d-M-Y');
                $stages['Submit']['days'] = $rsd->diff($ced)->format('%a');

                $stages['Review']['start_date'] = $rsd->format('d-M-Y');
                $stages['Review']['color'] = 'success';
            }

            //Feedback
            $stages['Feedback'] = ['label' => 'Feedback', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
            if (in_array('ppb_comment', Hash::extract($application, 'Review.{n}.type'))) {
                // debug(Hash::extract($application, 'Review.{n}[type=ppb_comment].id'));
                $fsd = new DateTime(min(Hash::extract($application, 'Review.{n}[type=ppb_comment].created')));
                $stages['Review']['end_date'] = $fsd->format('d-M-Y');
                $stages['Review']['days'] = $fsd->diff($rsd)->format('%a');

                $stages['Feedback']['start_date'] = $fsd->format('d-M-Y');
                $stages['Feedback']['color'] = 'success';
            } 

            //Approval
            $stages['Approval'] = ['label' => 'Approval', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
            if ($application['Application']['approved']) {
                $asd = new DateTime($application['Application']['approval_date']);
                $stages['Feedback']['end_date'] = $asd->format('d-M-Y');
                $stages['Feedback']['days'] = $asd->diff($fsd)->format('%a');

                $stages['Approval']['start_date'] = $asd->format('d-M-Y');
                $stages['Approval']['color'] = ($application['Application']['approved'] == '2') ? 'success' : 'warning';
            } 

            //Completion


        } else {            
            $stages['Creation'] = ['application_name' => '<< protocol no. >>', 'label' => 'Start', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
            $stages['Submit'] = ['label' => 'Submit', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
            $stages['Review'] = ['label' => 'Review', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
            $stages['Feedback'] = ['label' => 'Feedback', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
            $stages['Approval'] = ['label' => 'Approval', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
        }

        $this->set('stages', $stages);
        $this->set('_serialize', 'stages');
        if ($this->request->is('requested')) {
            return $stages;
        }        
    }    
    /*public function admin_stages($id = null) {
        $this->stages($id);
    }
    public function manager_stages($id = null) {
        $this->stages($id);
    }
    public function inspector_stages($id = null) {
        $this->stages($id);
    }
    public function reviewer_stages($id = null) {
        $this->stages($id);
    }
    public function partner_stages($id = null) {
        $this->stages($id);
    }
    public function applicant_stages($id = null) {
        $this->stages($id);
    }*/
/**
 * index method
 *
 * @return void
 */

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
        $this->paginate['contain'] = array('InvestigatorContact', 'Sponsor', 'SiteDetail' => array('County'));

            $this->set('page_options', $page_options);
            $this->set('applications', Sanitize::clean($this->paginate(), array('encode' => false)));

        $trial_statuses = $this->Application->TrialStatus->find('list');
        $this->set(compact('trial_statuses'));
    }

    public function myindex() {
        // $this->response->download("export.csv");
        $applications = $this->Application->find('all');
        $this->set(compact('applications'));
        $this->layout = false;
        return;
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
        $this->paginate['contain'] = array('InvestigatorContact', 'Sponsor', 'SiteDetail' => array('County'), 'Review' => array('User'));
            
            //in case of csv export
            if (isset($this->request->params['ext']) && $this->request->params['ext'] == 'csv') {
              $this->csv_export($this->Application->find('all', 
                      array('conditions' => $this->paginate['conditions'], 'order' => $this->paginate['order'], 'contain' => $this->a_contain)
                  ));
            }
            //end pdf export

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
                'Review' => array('conditions' => array('Review.type' => 'request', 'Review.accepted' => 'accepted'), 'User'),
                'TrialStatus',
                'InvestigatorContact', 'Sponsor', 'SiteDetail' => array('County'));

            //in case of csv export
            if (isset($this->request->params['ext']) && $this->request->params['ext'] == 'csv') {
              $this->csv_export($this->Application->find('all', 
                      array('conditions' => $this->paginate['conditions'], 'order' => $this->paginate['order'], 'contain' => $this->a_contain)
                  ));
            }
            //end csv export

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
            'InvestigatorContact', 'Sponsor', 'SiteDetail' => array('County'));

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
        $this->paginate['contain'] = array('InvestigatorContact', 'Sponsor', 'SiteDetail' => array('County'));

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
        $this->paginate['contain'] = array('InvestigatorContact', 'Sponsor', 'SiteDetail' => array('County'));

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

        // $this->paginate['contain'] = array(
        //     'Review' => array('conditions' => array('Review.type' => 'request', 'Review.accepted' => 'accepted')),
        //     'InvestigatorContact', 'Sponsor', 'SiteDetail' => array('County'));
        $this->paginate['contain'] = array(
                'Review' => array('conditions' => array('Review.type' => 'request', 'Review.accepted' => 'accepted'), 'User'),
                'TrialStatus',
                'InvestigatorContact', 'Sponsor', 'SiteDetail' => array('County'));
           //in case of csv export
            if (isset($this->request->params['ext']) && $this->request->params['ext'] == 'csv') {
              $this->csv_export($this->Application->find('all', 
                      array('conditions' => $this->paginate['conditions'], 'order' => $this->paginate['order'], 'contain' => $this->a_contain)
                  ));
            }
            //end pdf export

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
    public function study_title($id = null) {
        $study_title = $this->Application->field(
            'study_title', array('id' => $id)
        );
        if ($this->request->is('requested')) {
            return $study_title;
        }
    }

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
                            // CakeResque::enqueue('default', 'ManagerShell', array('newAnnualApproval', $response));
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
        
        $application = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $id),
            'contain' => $this->a_contain));
        $this->request->data = $application;

        if(strpos($this->request->url, 'pdf') === false && !$response['Application']['submitted'] && !$response['Application']['deactivated']) {
            $this->Session->setFlash('This application is not yet submitted', 'alerts/flash_info');
            $this->redirect(array('action' => 'edit', $response['Application']['id']));
        }
        
    }

    public function applicant_final_report($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        } else {
          if ($this->Application->save($this->request->data, true, array('id', 'final_report', 'laymans_summary', 
                'quantity_imported', 'quantity_dispensed', 'quantity_destroyed', 'quantity_exported', 'balance_site', 'final_date'))) {
              $this->Session->setFlash(__('Final report successfully submitted.'), 'alerts/flash_success');
              $this->redirect(array('action' => 'view', $id));
          } else {
              $this->Session->setFlash(__('Error. Unable to submit final report.'), 'alerts/flash_error');
              $this->redirect(array('action' => 'view', $id));
          }
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
            'contain' => $this->a_contain));

        $this->set('application', $application);
        $this->set('counties', $this->Application->SiteDetail->County->find('list'));
        $this->set('users', $this->Application->User->find('list', array('conditions' => array('User.group_id' => array(3, 2, 6), 'User.is_active' => 1))));

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
                $contains = $this->a_contain;
                $contains['Review']['conditions'] = array('Review.user_id' => $this->Auth->User('id'),  'Review.type' => 'reviewer_comment');
                $application = $this->Application->find('first', array(
                    'conditions' => array('Application.id' => $id),
                    'contain' => $contains));
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

        $this->request->data = $application;

        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'Application_' . $id,  'orientation' => 'portrait');
        }
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
            'contain' => array('Amendment', 'EthicalCommittee', 'InvestigatorContact', 'Pharmacist', 'Sponsor', 'SiteDetail', 'Organization', 'Placebo',
                'Attachment', 'CoverLetter', 'Protocol', 'PatientLeaflet', 'Brochure', 'GmpCertificate', 'Cv', 'Finance', 'Declaration',
                'IndemnityCover', 'OpinionLetter', 'ApprovalLetter', 'Statement', 'ParticipatingStudy', 'Addendum', 'Registration', 'Fee', 'Checklist', 'AnnualLetter', 'StudyRoute', 'Manufacturer',
                'AnnualApproval', 'ParticipantFlow', 'Budget', 'Deviation', 'Document', 'Review' => array('ReviewAnswer')
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
                        
                        //Create  annual approval letter                 
                        $this->loadModel('Pocket');
                        $this->loadModel('AnnualLetter');
                        $html = new HtmlHelper(new ThemeView());
                        $this->Application->read();
                        $approval_letter = $this->Pocket->find('first', array('conditions' => array('Pocket.name' => 'initial_approval_letter'), 'contain' => array('InvestigatorContact')));

                        $application = $this->Application->find('first', array('conditions' => array('Application.id' => $this->Application->id)));
                        $checklist = array();
                        foreach ($application['Checklist'] as $formdata) {            
                          $file_link = $html->link(__($formdata['basename']), array('controller' => 'attachments',   'action' => 'download', $formdata['id'], 'admin' => false));
                          (isset($checklist[$formdata['pocket_name']])) ? 
                            $checklist[$formdata['pocket_name']] .= $file_link.' dated '.date('jS F Y', strtotime($formdata['file_date'])).' Version '.$formdata['version_no'].'<br>' : 
                            $checklist[$formdata['pocket_name']] = $file_link.' dated '.date('jS F Y', strtotime($formdata['file_date'])).' Version '.$formdata['version_no'].'<br>';
                        }
                        $deeds = $this->Pocket->find('list', array(
                          'fields' => array('Pocket.name', 'Pocket.content'),
                          'conditions' => array('Pocket.type' => 'protocol'),
                          'recursive' => 0
                        ));
                        $checkstring='';
                        $num = 0;
                        foreach ($checklist as $kech => $check) {
                          $num++;
                          $checkstring .= $num.'. '.$deeds[$kech].'<br>'.$check;
                        }

                        $cnt = $this->Application->AnnualLetter->find('count', array('conditions' => array('date_format(AnnualLetter.created, "%Y")' => date("Y"))));
                        $cnt++;
                        $year = date('Y', strtotime($this->Application->field('approval_date')));
                        $approval_no = 'PPB/'.$application['Application']['protocol_no']."/$year"."($cnt)";
                        $expiry_date = date('jS F Y', strtotime($application['Application']['approval_date'] . " +1 year"));
                        $expiry_date_s = date('Y-m-d', strtotime($application['Application']['approval_date'] . " +1 year"));
                        $variables = array(
                            'approval_no' => $approval_no, 'protocol_no' => $application['Application']['protocol_no'], 
                            'letter_date' => date('jS F Y', strtotime($application['Application']['approval_date'])),
                            'qualification' => $application['InvestigatorContact'][0]['qualification'],
                            'names' => $application['InvestigatorContact'][0]['given_name'].' '.$application['InvestigatorContact'][0]['middle_name'].' '.$application['InvestigatorContact'][0]['family_name'],
                            'professional_address' => $application['InvestigatorContact'][0]['professional_address'],
                            'telephone' => $application['InvestigatorContact'][0]['telephone'],
                            'study_title' => $application['Application']['short_title'],
                            'checklist' => $checkstring,
                            'expiry_date' => $expiry_date
                        );
                        
                        $save_data = array('AnnualLetter' => array(
                                'application_id' => $application['Application']['id'],
                                'approval_no' => $approval_no,
                                'approver' => $this->Session->read('Auth.User.name'),
                                'approval_date' => date('Y-m-d H:i:s'),
                                'expiry_date' => $expiry_date_s,
                                'status' => 'submitted',
                                'content' => String::insert($approval_letter['Pocket']['content'], $variables)
                              ),
                            );
                        $this->AnnualLetter->Create();
                        if (!$this->AnnualLetter->save($save_data)) {
                             $this->log('Annual approval letter was not saved!!', 'annual_letter_error');
                             $this->log($save_data, 'annual_letter_error');
                        }
                        // end        

                        //******************       Send Email and Notifications Managers    *****************************
                        $this->loadModel('Message');
                        $html = new HtmlHelper(new ThemeView());
                        $message = $this->Message->find('first', array('conditions' => array('name' => 'manager_approve_letter')));
                        
                        $users = $this->Application->User->find('all', array(
                            'contain' => array('Group'),
                            // 'conditions' => array('OR' => array('User.id' => $this->Application->field('user_id'), 'User.group_id' => 2)) //Applicant and managers
                            'conditions' => array('User.group_id' => 2) //Applicant and managers
                        ));
                        foreach ($users as $user) {
                          $variables = array(
                            'name' => $user['User']['name'], 'approval_no' => $approval_no, 'protocol_no' => $this->Application->field('protocol_no'),
                            'protocol_link' => $html->link($this->Application->field('protocol_no'), array('controller' => 'applications', 'action' => 'view', $this->Application->id, $user['Group']['redir'] => true, 
                                'full_base' => true), array('escape' => false)),
                            'approval_date' => $this->Application->field('approval_date')
                          );
                          $datum = array(
                            'email' => $user['User']['email'],
                            'id' => $id, 'user_id' => $user['User']['id'], 'type' => 'manager_approve_letter', 'model' => 'AnnaulLetter',
                            'subject' => String::insert($message['Message']['subject'], $variables),
                            'message' => String::insert($message['Message']['content'], $variables)
                          );
                          CakeResque::enqueue('default', 'GenericEmailShell', array('sendEmail', $datum));
                          CakeResque::enqueue('default', 'GenericNotificationShell', array('sendNotification', $datum));
                        }
                        //**********************************    END   *********************************
                        //end
                        
                        $this->Session->setFlash(__('Successfully approved the protocol. '), 'alerts/flash_success');
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

    public function apl() {
        //Create  annual approval letter
        $users = $this->Application->User->find('all', array(
                'contain' => array('Group'),
                'conditions' => array('OR' => array('User.id' => 6, 'User.group_id' => 2)) //Applicant and managers //Applicant and managers
            ));
            // foreach ($users as $user) {
            //     $this->out('User: ' . $user['User']['name']);
            //   if (isset($application['AnnualLetter'][0])) {
            //     $this->out('AnnualLetter ' . $application['AnnualLetter'][0]);
            //     $variables = array(
            //             'name' => $user['User']['name'], 'protocol_no' => $application['Application']['protocol_no'],
            //             'protocol_link' => $html->link($application['Application']['protocol_no'], array('controller' => 'applications', 'action' => 'view', $application['Application']['id'], $user['Group']['redir'] => true, 
            //                 'full_base' => true), array('escape' => false)),
            //             'approval_date' => $application['Application']['approval_date'], 'expiry_date' => $application['AnnualLetter'][0]['expiry_date']
            //           );
            //       $datum = array(
            //         'email' => $user['User']['email'],
            //         'id' => $id, 'user_id' => $user['User']['id'], 'type' => $type, 'model' => 'AnnaulLetter',
            //         'subject' => String::insert($message['Message']['subject'], $variables),
            //         'message' => String::insert($message['Message']['content'], $variables)
            //       );
            //       $this->sendEmail($datum);
            //       $this->sendNotification($datum);
            //       $this->log($datum, 'approval_reminder');
            //   }              
            // }
        debug($users);

        // $this->loadModel('Pocket');
        // $this->loadModel('AnnualLetter');
        // $html = new HtmlHelper(new ThemeView());
        // $this->Application->read(null, 46);
        // $approval_letter = $this->Pocket->find('first', array('conditions' => array('Pocket.name' => 'initial_approval_letter'), 'contain' => array('InvestigatorContact')));

        // $application = $this->Application->find('first', array('conditions' => array('Application.id' => $this->Application->id)));
        // $checklist = array();
        // foreach ($application['Checklist'] as $formdata) {            
        //   $file_link = $html->link(__($formdata['basename']), array('controller' => 'attachments',   'action' => 'download', $formdata['id'], 'admin' => false));
        //   (isset($checklist[$formdata['pocket_name']])) ? 
        //     $checklist[$formdata['pocket_name']] .= $file_link.' dated '.date('jS F Y', strtotime($formdata['file_date'])).' Version '.$formdata['version_no'].'<br>' : 
        //     $checklist[$formdata['pocket_name']] = $file_link.' dated '.date('jS F Y', strtotime($formdata['file_date'])).' Version '.$formdata['version_no'].'<br>';
        // }
        // $deeds = $this->Pocket->find('list', array(
        //   'fields' => array('Pocket.name', 'Pocket.content'),
        //   'conditions' => array('Pocket.type' => 'protocol'),
        //   'recursive' => 0
        // ));
        // // debug($deeds);
        // $checkstring='';
        // $cnt = 0;
        // foreach ($checklist as $kech => $check) {
        //   $cnt++;
        //   $checkstring .= $cnt.'. '.$deeds[$kech].'<br>'.$check;
        // }

        // $cnt = $this->Application->AnnualLetter->find('count', array('conditions' => array('AnnualLetter.application_id' => $this->Application->id)));
        // $cnt++;
        // $year = date('Y', strtotime($this->Application->field('approval_date')));
        // $approval_no = 'APL/'.$cnt.'/'.$year.'-'.$application['Application']['protocol_no'];
        // $expiry_date = date('jS F Y', strtotime($application['Application']['approval_date'] . " +1 year"));
        // $variables = array(
        //     'approval_no' => $approval_no, 'protocol_no' => $application['Application']['protocol_no'], 
        //     'letter_date' => date('jS F Y', strtotime($application['Application']['approval_date'])),
        //     'qualification' => $application['InvestigatorContact'][0]['qualification'],
        //     'names' => $application['InvestigatorContact'][0]['given_name'].' '.$application['InvestigatorContact'][0]['middle_name'].' '.$application['InvestigatorContact'][0]['family_name'],
        //     'professional_address' => $application['InvestigatorContact'][0]['professional_address'],
        //     'telephone' => $application['InvestigatorContact'][0]['telephone'],
        //     'study_title' => $application['Application']['short_title'],
        //     'checklist' => $checkstring,
        //     'expiry_date' => $expiry_date
        // );
        
        // $save_data = array('AnnualLetter' => array(
        //         'application_id' => $application['Application']['id'],
        //         'approval_no' => $approval_no,
        //         'approver' => $this->Session->read('Auth.User.name'),
        //         'approval_date' => date('Y-m-d H:i:s'),
        //         'expiry_date' => $expiry_date,
        //         'status' => 'AnnualApprovalLetter',
        //         'content' => String::insert($approval_letter['Pocket']['content'], $variables)
        //       ),
        //     );
        // $this->layout = false;
        // $this->set('save_data', $save_data);
    }

    public function apn() {
          //Create  annual approval letter
          $this->loadModel('Pocket');
          $this->loadModel('AnnualLetter');
          $html = new HtmlHelper(new ThemeView());
          $this->Application->read(null, 46);
          $approval_letter = $this->Pocket->find('first', array('conditions' => array('Pocket.name' => 'annual_approval_letter'), 'contain' => array()));

          $application = $this->Application->find('first', array('conditions' => array('Application.id' => $this->Application->id)));
          $checklist = array();
          foreach ($application['AnnualApproval'] as $formdata) {            
            $file_link = $html->link(__($formdata['basename']), array('controller' => 'attachments',   'action' => 'download', $formdata['id'], 'admin' => false));
            (isset($checklist[$formdata['pocket_name']])) ? 
              $checklist[$formdata['pocket_name']] .= $file_link.' dated '.date('jS F Y', strtotime($formdata['file_date'])).' Version '.$formdata['version_no'].'<br>' : 
              $checklist[$formdata['pocket_name']] = $file_link.' dated '.date('jS F Y', strtotime($formdata['file_date'])).' Version '.$formdata['version_no'].'<br>';
          }
          $deeds = $this->Pocket->find('list', array(
            'fields' => array('Pocket.name', 'Pocket.content'),
            'conditions' => array('Pocket.type' => 'annual'),
            'recursive' => 0
          ));
          // debug($deeds);
          $checkstring='';
          $cnt = 0;
          foreach ($checklist as $kech => $check) {
            $cnt++;
            $checkstring .= $cnt.'. '.$deeds[$kech].'<br>'.$check;
          }

          $cnt = $this->Application->AnnualLetter->find('count', array('conditions' => array('AnnualLetter.application_id' => $this->Application->id)));
          $cnt++;
          $year = date('Y', strtotime($this->Application->field('approval_date')));
          $approval_no = 'APL/'.$cnt.'/'.$year.'-'.$application['Application']['protocol_no'];
          $expiry_date = date('jS F Y', strtotime($application['Application']['approval_date'] . " +1 year"));
          $variables = array(
              'approval_no' => $approval_no, 'protocol_no' => $application['Application']['protocol_no'], 
              'letter_date' => date('jS F Y', strtotime($application['Application']['approval_date'])),
              'qualification' => $application['InvestigatorContact'][0]['qualification'],
              'names' => $application['InvestigatorContact'][0]['given_name'].' '.$application['InvestigatorContact'][0]['middle_name'].' '.$application['InvestigatorContact'][0]['family_name'],
              'professional_address' => $application['InvestigatorContact'][0]['professional_address'],
              'telephone' => $application['InvestigatorContact'][0]['telephone'],
              'study_title' => $application['Application']['short_title'],
              'checklist' => $checkstring,
              'status' => $application['TrialStatus']['name'], 
              'expiry_date' => $expiry_date
          );
          $save_data = array('AnnualLetter' => array(
                  'application_id' => $application['Application']['id'],
                  'approval_no' => $approval_no,
                  'approver' => $this->Session->read('Auth.User.name'),
                  'approval_date' => date('Y-m-d H:i:s'),
                  'expiry_date' => $expiry_date,
                  'status' => 'AnnualApprovalLetter',
                  'content' => String::insert($approval_letter['Pocket']['content'], $variables)
                ),
              );
          $this->layout = false;
          $this->set('save_data', $save_data);
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

                    // debug($this->request->data);
                    // return;
        if ($response['Application']['deactivated']) {
            $this->redirect(array('action' => 'view', $id));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            // debug($this->request->data);
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
                    $message = 'The application was not successfully submitted. Please correct the errors below...';
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
            'contain' => array('Amendment', 'EthicalCommittee', 'InvestigatorContact', 'Pharmacist', 'Sponsor', 'SiteDetail', 'Organization', 'Placebo', 'Budget',
                    'Attachment', 'CoverLetter', 'Protocol', 'PatientLeaflet', 'Brochure', 'GmpCertificate', 'Cv', 'Finance', 'Declaration', 'AnnualLetter', 'StudyRoute', 'Manufacturer',
                    'IndemnityCover', 'OpinionLetter', 'ApprovalLetter', 'Statement', 'ParticipatingStudy', 'Addendum', 'Registration', 'Fee', 'Checklist')));
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


    private function _isOwnedBy($id) {
        // $response = $this->Application->isOwnedBy($id, $this->Auth->user('id'));
        $contains = $this->a_contain;
        $contains['SiteInspection']['conditions'] = array('SiteInspection.summary_approved' => 2);
        $contains['Review']['conditions'] = array('Review.type' => 'ppb_comment');
        // debug($contains);
        $response = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $id),
            'contain' => $contains,
            )
        );
        if($response['Application']['user_id'] != $this->Auth->user('id')) {
            $this->log("_isOwnedBy: application id = ".$response['Application']['id']." User = ".$this->Auth->user('id'),'debug');
            $this->Session->setFlash(__('You do not have permission to access this resource.'), 'alerts/flash_error');
            $this->redirect(array('action' => 'index'));
        }
        return $response;
    }


    private function csv_export($applications = '') {
        //todo: check if data exists in $applications
        /*$_serialize = 'capplications';
        $_header = array('Protocol No', 'Study Title', 'Short Title', 'Date Submitted', 'Approval Date',
            'Assigned Reviewer 1', 'Reviewer response 1', 'Assigned Reviewer 2', 'Reviewer response 2', 'Assigned Reviewer 3', 'Reviewer response 3', 'Assigned Reviewer 4', 'Reviewer response 4',
            'Trial Status', 'Trial Phase I', 'Trial Phase II', 'Trial Phase III', 'Trial Phase IV', 
            'Study Site', 'Approved Participants',
            'Scope: Diagnosis', 'Scope: Prophylaxis', 'Scope: Therapy', 'Scope: Safety', 'Scope: Efficacy', 'Scope: Pharmacokinetic', 'Scope: Pharmacodynamic', 'Scope: Bioequivalence', 'Scope: Dose Response', 'Scope: Pharmacogenetic', 'Scope: Pharmacogenomic', 'Scope: Pharmacoecomomic', 'Scope: Others', 'Scope: Others Specify', 
            'Version No', 'Date of Protocol', 'Study Drug', 'Disease Condition',
            'Approval Date of Protocol', 'Biologicals', 'Proteins', 'Immunologicals', 'Vaccines', 'Hormones', 'Toxoid', 'Chemical', 'Chemical Name', 'Medical Device', 'Medical Device Name', 'Co-ordinating Investigator Name', 'Co-ordinating Investigator Qualification', 'Co-ordinating Investigator Telephone', 'Co-ordinating Investigator Email', 'Principal Investigator Name', 'Principal Investigator Qualification', 'Principal Investigator Telephone', 'Principal Investigator Email', 'Sponsor Name', 'Sponsor Phone', 'Sponsor Email',
            'Created',
            );
        $_extract = array('Application.protocol_no', 'Application.study_title', 'Application.short_title', 'Application.date_submitted', 'Application.approval_date',
            'Review.0.User.name', 'Review.0.accepted', 'Review.1.User.name', 'Review.1.accepted', 'Review.2.User.name', 'Review.2.accepted', 'Review.4.User.name', 'Review.4.accepted', 
            'TrialStatus.name', 'Application.trial_human_pharmacology', 'Application.trial_therapeutic_exploratory', 'Application.trial_therapeutic_confirmatory', 'Application.trial_therapeutic_use',
            'Application.single_site_member_state_f', 'Application.number_participants',
            'Application.scope_diagnosis', 'Application.scope_prophylaxis', 'Application.scope_therapy', 'Application.scope_safety', 'Application.scope_efficacy', 'Application.scope_pharmacokinetic', 'Application.scope_pharmacodynamic', 'Application.scope_bioequivalence', 'Application.scope_dose_response', 'Application.scope_pharmacogenetic', 'Application.scope_pharmacogenomic', 'Application.scope_pharmacoecomomic', 'Application.scope_others', 'Application.scope_others_specify', 
            'Application.version_no', 'Application.date_of_protocol', 'Application.study_drug', 'Application.disease_condition',
            'Application.approval_date', 'Application.product_type_biologicals', 'Application.product_type_proteins',
            'Application.product_type_immunologicals', 'Application.product_type_vaccines', 'Application.product_type_hormones', 'Application.product_type_toxoid', 'Application.product_type_chemical', 'Application.product_type_chemical_name', 'Application.product_type_medical_device', 'Application.product_type_medical_device_name', 'Application.investigator1_given_name', 'Application.investigator1_qualification', 'Application.investigator1_telephone', 'Application.investigator1_email', 'InvestigatorContact.0.given_name', 'InvestigatorContact.0.qualification', 'InvestigatorContact.0.telephone', 'InvestigatorContact.0.email', 'Sponsor.0.sponsor', 'Sponsor.0.cell_number', 'Sponsor.0.email_address', 
            'Application.created');

        $this->response->download('applications_'.date('Ymd_Hi').'.csv'); // <= setting the file name
        $this->viewClass = 'CsvView.Csv';
        $this->set(compact('capplications', '_serialize', '_header', '_extract'));*/
        $this->response->download('applications_'.date('Ymd_Hi').'.csv'); // <= setting the file name
        $this->set(compact('applications'));
        $this->layout = false;
        $this->render('csv_export');
    }
}
