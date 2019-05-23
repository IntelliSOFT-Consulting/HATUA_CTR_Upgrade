<?php
App::uses('AppController', 'Controller');
/**
 * SiteInspections Controller
 *
 * @property SiteInspection $SiteInspection
 */
class SiteInspectionsController extends AppController {

    public $uses = array('SiteInspection', 'Application', 'SiteQuestion');

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->SiteInspection->recursive = 0;
        $this->set('siteInspections', $this->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        $this->SiteInspection->id = $id;
        if (!$this->SiteInspection->exists()) {
            throw new NotFoundException(__('Invalid site inspection'));
        }
        $this->set('siteInspection', $this->SiteInspection->read(null, $id));
    }

    public function inspector_view($id = null) {
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

        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'SiteInspection_' . $this->params['named']['inspection_id'],  'orientation' => 'portrait');
        }
    }

    public function manager_view($id = null) {
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

        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'SiteInspection_' . $this->params['named']['inspection_id'],  'orientation' => 'portrait');
        }
    }
/**
 * add method
 *
 * @return void
 */
    private function add($application_id = null) {
        $this->SiteInspection->create();
        // $application = $this->SiteInspection->Application->read(null, $application_id);
        $application = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $application_id)
        ));
        $all_questions = $this->SiteQuestion->find('all');
        $answers = [];
        foreach ($all_questions as $question) {
            $dpoint = ['question_type' => $question['SiteQuestion']['question_type'], 'question_number' => $question['SiteQuestion']['question_number'], 
                       'question' => $question['SiteQuestion']['question']];
            $answers[] = $dpoint;
        }
        $trial = ""; $inspection_country = ""; $investigators = ""; $co_investigators = "";
        $trial .= ($application['Application']['trial_human_pharmacology'] == 1) ? "Human pharmacology (Phase I) : \n" : null;
        $trial .= ($application['Application']['trial_administration_humans'] == 1) ? "First administration to humans\n" : null;
        $trial .= ($application['Application']['trial_bioequivalence_study'] == 1) ? "Bioequivalence study\n" : null;
        $trial .= ($application['Application']['trial_other'] == 1) ? "Other : ".$application['Application']['trial_other_specify'] : null;
        $trial .= ($application['Application']['trial_therapeutic_exploratory'] == 1) ? "Therapeutic exploratory (Phase II)\n" : null;
        $trial .= ($application['Application']['trial_therapeutic_confirmatory'] == 1) ? "Therapeutic confirmatory (Phase III)\n" : null;
        $trial .= ($application['Application']['trial_therapeutic_use'] == 1) ? "Therapeutic use (Phase IV)\n" : null;
        $inspection_country .= ($application['Application']['single_site_member_state'] == 'Yes') ? "Kenya\n" : null;
        $inspection_country .= ($application['Application']['multiple_sites_member_state'] == 'Yes') ? "Kenya\n" : null;
        $inspection_country .= $application['Application']['multi_country_list'];
        $investigators = $application['Application']['investigator1_given_name']." ".$application['Application']['investigator1_family_name'].
                         "\nTel: ".$application['Application']['investigator1_telephone'].
                         "\nEmail: ".$application['Application']['investigator1_email'];
        foreach ($application['InvestigatorContact'] as $key => $value) {
            $co_investigators .= ($key+1)." ".$value['given_name']." ".$value['family_name']." Email: ".$value['email']."\n";
        }
        $count = $this->SiteInspection->find('count',  array('conditions' => array(
                        'SiteInspection.created BETWEEN ? and ?' => array(date("Y-01-01 00:00:00"), date("Y-m-d H:i:s")))));
        $count++;
        $count = ($count < 10) ? "0$count" : $count;
        $data = array('application_id' => $application_id, 'user_id' => $this->Auth->User('id'), 'study_title' => $application['Application']['study_title'], 
                      'protocol_no' => $application['Application']['protocol_no'],
                      'reference_no' => 'SI/'.date('Y').'/'.$count,
                      'trial_phase' => $trial, 'investigators' => $investigators, 'co_investigators' => $co_investigators, 'inspection_country' => $inspection_country);
        if ($this->SiteInspection->saveAssociated(array('SiteInspection' => $data, 'SiteAnswer' => $answers))) {
            #Send notification and email
            $datum = array('id' => $this->SiteInspection->id, 
                'application_id' => $application['Application']['id'], 
                'group_id' => $this->Auth->User('group_id'), 
                'protocol_no' => ($application['Application']['protocol_no']) ? $application['Application']['protocol_no'] : $application['Application']['short_title'],
                'user_id' => $this->Auth->User('id'));
            CakeResque::enqueue('default', 'InspectionShell', array('newInspectionNotifyInspector', $datum));
            $this->Session->setFlash(__('The site inspection has been saved'), 'alerts/flash_success');
            $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'inspection_id' => $this->SiteInspection->id));
        } else {
            $this->Session->setFlash(__('The site inspection could not be saved. Please, try again.'), 'alerts/flash_error');
        }
    }
    public function manager_add($application_id = null) {
        $this->add($application_id);
    }

    public function inspector_add($application_id = null) {
        $this->add($application_id);
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    private function edit($id = null, $application_id = null) {
        // debug($this->request);
        $this->SiteInspection->id = $id;
        if (!$this->SiteInspection->exists()) {
            throw new NotFoundException(__('Invalid site inspection'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->SiteInspection->saveMany($this->request->data['SiteInspection'], array('deep' => true))) {
                if (isset($this->request->data['submitReport'])) {
                    $this->SiteInspection->saveField('approved', 1);
                    $results = Hash::extract($this->request->data['SiteInspection'], '{n}.SiteAnswer.{n}.finding');
                    if (isset(array_count_values($results)['Major']) && array_count_values($results)['Major'] > 4 || array_count_values($results)['Critical'] > 0) {
                        $this->SiteInspection->saveField('conclusion', 'Site did not meet criteria!');
                        $this->SiteInspection->saveField('outcome', 'Failed Inspection');
                    }
                }
                $this->Session->setFlash(__('The site inspection has been saved'), 'alerts/flash_success');
                $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'inspection_id' => $id));
            } else {
                $this->Session->setFlash(__('The site inspection could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        } else {
            $application = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $application_id),
            'contain' => array('Amendment', 'PreviousDate', 'InvestigatorContact', 'Sponsor', 'SiteDetail', 'Organization', 'Placebo',
                'Attachment', 'CoverLetter', 'Protocol', 'PatientLeaflet', 'Brochure', 'GmpCertificate', 'Cv', 'Finance', 'Declaration',
                'IndemnityCover', 'OpinionLetter', 'ApprovalLetter', 'Statement', 'ParticipatingStudy', 'Addendum', 'Registration', 'Fee', 
                'AnnualApproval', 'Document', 'Review', 'SiteInspection', 'SiteInspection' => array('SiteAnswer')
                )));
            $this->request->data = $application;
        }
    }
    public function manager_edit($id = null, $application_id = null) {
        $this->edit($id, $application_id);
    }
        
    public function inspector_edit($id = null, $application_id = null) {
        $this->edit($id, $application_id);
    }

    public function summary($id = null, $application_id = null) {
        // debug($this->request);
        $this->SiteInspection->id = $id;
        if (!$this->SiteInspection->exists()) {
            throw new NotFoundException(__('Invalid site inspection'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->SiteInspection->saveMany($this->request->data['SiteInspection'], array('deep' => true))) {
                if (isset($this->request->data['submitReport'])) {
                    $this->SiteInspection->saveField('summary_approved', 1);
                }
                $this->Session->setFlash(__('The site inspection has been saved'), 'alerts/flash_success');
                $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'inspection_id' => $id));
            } else {
                $this->Session->setFlash(__('The site inspection could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        } else {
            $application = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $application_id),
            'contain' => array('Amendment', 'PreviousDate', 'InvestigatorContact', 'Sponsor', 'SiteDetail', 'Organization', 'Placebo',
                'Attachment', 'CoverLetter', 'Protocol', 'PatientLeaflet', 'Brochure', 'GmpCertificate', 'Cv', 'Finance', 'Declaration',
                'IndemnityCover', 'OpinionLetter', 'ApprovalLetter', 'Statement', 'ParticipatingStudy', 'Addendum', 'Registration', 'Fee', 
                'AnnualApproval', 'Document', 'Review', 'SiteInspection', 'SiteInspection' => array('SiteAnswer')
                // => array('conditions' => array('Review.type' => 'response'))
                )));
            $this->request->data = $application;
        }
    }
    public function manager_summary($id = null, $application_id = null) {
        $this->summary($id, $application_id);
    }
    public function inspector_summary($id = null, $application_id = null) {
        $this->summary($id, $application_id);
    }
/**
 * approve method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    private function approve($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->SiteInspection->id = $id;
        if (!$this->SiteInspection->exists()) {
            throw new NotFoundException(__('Invalid site inspection'), 'alerts/flash_error');
        }
        $site_inspection = $this->SiteInspection->read(null, $id);
        if ($this->SiteInspection->save(array('approved' => 2, 'summary_approved' => 2, 'approved_by' => $this->Session->read('Auth.User.id')))) {
            $this->Session->setFlash(__('Site inspection approved'), 'alerts/flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Site inspection was not deleted'), 'alerts/flash_error');
        $this->redirect(array('controller' => 'site_inspections', 'action' => 'view', $site_inspection['application_id']));
    }
    public function manager_approve($id = null) {
        $this->approve($id);
    }
    public function inspector_approve($id = null) {
        $this->approve($id);
    }

/**
 * download methods
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    private function download_assessment($id = null) {
        $this->SiteInspection->id = $id;
        if (!$this->SiteInspection->exists()) {
            throw new NotFoundException(__('Invalid site inspection'));
        }
        $site_inspection = $this->SiteInspection->find('first', array(
            'conditions' => array('SiteInspection.id' => $id),
            'contain' => array('SiteAnswer', 'Attachment')
            )
        );
        $disp  = $site_inspection['SiteInspection'];
        $disp['SiteAnswer'] = $site_inspection['SiteAnswer'];
        $disp['Attachment'] = $site_inspection['Attachment'];
        // $site_inspection  = $this->SiteInspection->read(null, $id);
        $this->set('site_inspection', $disp);
        $this->set('akey', $site_inspection['SiteInspection']['application_id']);
        $this->pdfConfig = array('filename' => 'Site_Inspection_Assessment_' . $id,  'orientation' => 'portrait');
        $this->render('download_assessment');
    }
    public function manager_download_assessment($id = null) {
        $this->download_assessment($id);
    }
    public function inspector_download_assessment($id = null) {
        $this->download_assessment($id);
    }

    private function download_summary($id = null) {
        $this->SiteInspection->id = $id;
        if (!$this->SiteInspection->exists()) {
            throw new NotFoundException(__('Invalid site inspection'));
        }
        $site_inspection = $this->SiteInspection->find('first', array(
            'conditions' => array('SiteInspection.id' => $id),
            'contain' => array('SiteAnswer', 'Attachment')
            )
        );
        $disp  = $site_inspection['SiteInspection'];
        $disp['SiteAnswer'] = $site_inspection['SiteAnswer'];
        $disp['Attachment'] = $site_inspection['Attachment'];
        // $site_inspection  = $this->SiteInspection->read(null, $id);
        $this->set('site_inspection', $disp);
        $this->set('akey', $site_inspection['SiteInspection']['application_id']);
        $this->pdfConfig = array('filename' => 'Site_Inspection_Summary_' . $id,  'orientation' => 'portrait');
        $this->render('download_summary');
    }
    public function manager_download_summary($id = null) {
        $this->download_summary($id);
    }
    public function inspector_download_summary($id = null) {
        $this->download_summary($id);
    }
    public function applicant_download_summary($id = null) {
        $this->download_summary($id);
    }

    private function download_inspection($id = null) {
        $this->SiteInspection->id = $id;
        if (!$this->SiteInspection->exists()) {
            throw new NotFoundException(__('Invalid site inspection'));
        }
        $site_inspection = $this->SiteInspection->find('first', array(
            'conditions' => array('SiteInspection.id' => $id),
            'contain' => array('SiteAnswer', 'Attachment')
            )
        );
        $disp  = $site_inspection['SiteInspection'];
        $disp['SiteAnswer'] = $site_inspection['SiteAnswer'];
        $disp['Attachment'] = $site_inspection['Attachment'];
        // $site_inspection  = $this->SiteInspection->read(null, $id);
        $this->set('site_inspection', $disp);
        $this->set('akey', $site_inspection['SiteInspection']['application_id']);
        $this->pdfConfig = array('filename' => 'Site_Inspection_' . $id,  'orientation' => 'portrait');
        $this->render('download_inspection');
    }
    public function manager_download_inspection($id = null) {
        $this->download_inspection($id);
    }
    public function inspector_download_inspection($id = null) {
        $this->download_inspection($id);
    }
    public function applicant_download_inspection($id = null) {
        $this->download_summary($id);
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
        $this->SiteInspection->id = $id;
        if (!$this->SiteInspection->exists()) {
            throw new NotFoundException(__('Invalid site inspection'), 'alerts/flash_error');
        }
        if ($this->SiteInspection->delete()) {
            $this->Session->setFlash(__('Site inspection deleted'), 'alerts/flash_success');
            $this->redirect($this->referer());
        }
        // $this->Session->setFlash(__('Site inspection was not deleted'), 'alerts/flash_error');
        // $this->redirect('/');
        $this->redirect($this->referer());
    }
    public function manager_delete($id = null) {
        $this->delete($id);
    }
    public function inspector_delete($id = null) {
        $this->delete($id);
    }
}
