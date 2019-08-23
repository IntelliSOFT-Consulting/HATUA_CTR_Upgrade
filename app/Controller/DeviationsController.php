<?php
App::uses('AppController', 'Controller');
/**
 * Deviations Controller
 *
 * @property Deviation $Deviation
 */
class DeviationsController extends AppController {

    public $paginate = array();
    public $components = array('Search.Prg');
    public $presetVars = true; // using the model configuration
    public $uses = array('Deviation', 'Application');
/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Deviation->recursive = 0;
        $this->set('deviations', $this->paginate());
    }

    public function applicant_index() {
        $this->index();
    }
    public function manager_index() {
        $this->index();
    }
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        $this->Deviation->id = $id;
        if (!$this->Deviation->exists()) {
            throw new NotFoundException(__('Invalid deviation'));
        }
        $this->set('deviation', $this->Deviation->read(null, $id));
    }

    /**
 * download methods
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    private function download_deviation($id = null) {
        $this->Deviation->id = $id;
        if (!$this->Deviation->exists()) {
            throw new NotFoundException(__('Invalid protocol deviation'));
        }
        $deviation = $this->Deviation->find('first', array(
            'conditions' => array('Deviation.id' => $id),
            'contain' => array('Attachment')
            )
        );
        $disp  = $deviation['Deviation'];
        $disp['Attachment'] = $deviation['Attachment'];
        // $deviation  = $this->Deviation->read(null, $id);
        $this->set('deviation', $disp);
        $this->set('akey', $deviation['Deviation']['application_id']);
        $this->pdfConfig = array('filename' => 'Protocol_Deviation_' . $id,  'orientation' => 'portrait');
        $this->render('download_deviation');
    }
    public function applicant_download_deviation($id = null) {
        $this->download_deviation($id);
    }
    public function manager_download_deviation($id = null) {
        $this->download_deviation($id);
    }
    public function inspector_download_deviation($id = null) {
        $this->download_deviation($id);
    }

/**
 * add method
 *
 * @return void
 */
    public function applicant_add($application_id = null) {
        $this->Deviation->create();
        $application = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $application_id),
            'contain' => array('InvestigatorContact')
        ));
        $count = $this->Deviation->find('count',  array('conditions' => array(
                        'Deviation.created BETWEEN ? and ?' => array(date("Y-01-01 00:00:00"), date("Y-m-d H:i:s")))));
        $count++; 
        $count = ($count < 10) ? "0$count" : $count;
        $data = array('application_id' => $application_id,  'study_title' => $application['Application']['study_title'], 
                      'reference_no' => 'DEV/'.date('Y').'/'.$count,
                      'pi_name' => $application['InvestigatorContact'][0]['given_name'].' '.$application['InvestigatorContact'][0]['middle_name'].' '.$application['InvestigatorContact'][0]['family_name']
                );
        if ($this->Deviation->saveAssociated(array('Deviation' => $data))) {            
            $this->Session->setFlash(__('The protocol deviation has been created'), 'alerts/flash_success');
            $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'deviation_edit' => $this->Deviation->id));
        } else {
            $this->Session->setFlash(__('The protocol deviation could not be created. Please notify the administrator.'), 'alerts/flash_error');
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function applicant_edit($id = null, $application_id = null) {
        // debug($this->request);
        $this->Deviation->id = $id;
        if (!$this->Deviation->exists()) {
            throw new NotFoundException(__('Invalid site inspection'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Deviation->saveMany($this->request->data['Deviation'], array('deep' => true))) {
            	// debug($this->request->data);
                if (isset($this->request->data['submitReport'])) {
                  $this->Deviation->saveField('status', 'Submitted');                    
	                $this->Session->setFlash(__('The protocol deviation has been submitted'), 'alerts/flash_success');
	                $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'deviation_view' => $id));
                } else {
              	   $this->Session->setFlash(__('The protocol deviation has been saved'), 'alerts/flash_success');
                 	$this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'deviation_edit' => $id));
                }
            } else {
                $this->Session->setFlash(__('The protocol deviation could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        } else {
            $application = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $application_id),
            'contain' => array('Amendment', 'PreviousDate', 'InvestigatorContact', 'Sponsor', 'SiteDetail', 'Organization', 'Placebo',
                'Attachment', 'CoverLetter', 'Protocol', 'PatientLeaflet', 'Brochure', 'GmpCertificate', 'Cv', 'Finance', 'Declaration',
                'IndemnityCover', 'OpinionLetter', 'ApprovalLetter', 'Statement', 'ParticipatingStudy', 'Addendum', 'Registration', 'Fee', 
                'AnnualApproval', 'Document', 'Review', 'Deviation'
                )));
            $this->request->data = $application;
        }
    }

    public function manager_unsubmit($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Deviation->id = $id;
        if (!$this->Deviation->exists()) {
            throw new NotFoundException(__('Invalid protocol deviation'), 'alerts/flash_error');
        }
        $site_inspection = $this->Deviation->read(null, $id);
        if ($this->Deviation->saveField('status', 'Unubmitted')) {
            $this->Session->setFlash(__('Protocol deviation unsubmitted'), 'alerts/flash_success');
            //TODO: notify applicant the protocol deviation can be edited
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Site inspection was not unsubmitted'), 'alerts/flash_error');
        $this->redirect($this->referer());
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
        $this->Deviation->id = $id;
        if (!$this->Deviation->exists()) {
            throw new NotFoundException(__('Invalid deviation'));
        }
        if ($this->Deviation->delete()) {
            $this->Session->setFlash(__('Deviation deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Deviation was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
