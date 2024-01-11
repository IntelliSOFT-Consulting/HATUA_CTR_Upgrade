<?php
App::uses('AppController', 'Controller');
/**
 * StudyMonitors Controller
 *
 * @property StudyMonitor $StudyMonitor
 */
class StudyMonitorsController extends AppController {

    public $paginate = array();
    public $uses = array('StudyMonitor', 'User', 'Application');
    public $components = array('Search.Prg');
    public $presetVars = true;
/**
 * index method
 *
 * @return void
 */
    public function admin_index() {
        // $this->StudyMonitor->recursive = 0;
        // $this->set('studyMonitors', $this->paginate());
        $this->Prg->commonProcess();
        $page_options = array('10' => '10', '20' => '20');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['User']['limit'] = $this->passedArgs['pages'];
            else $this->paginate['User']['limit'] = reset($page_options);

        $criteria = $this->User->parseCriteria($this->passedArgs);
        $criteria['User.group_id'] = 7;
        $this->paginate['User']['conditions'] = $criteria;

        $this->paginate['User']['order'] = array('User.created' => 'desc');
        // $this->User->recursive = -1;
        $this->paginate['User']['contain'] = array('Group', 'StudyMonitor' => array('Application'));


        //in case of csv export
        if (isset($this->request->params['ext']) && $this->request->params['ext'] == 'csv') {

              $this->csv_export($this->User->find('all', 
                      array('conditions' => $this->paginate['User']['conditions'], 'order' => $this->paginate['User']['order'], 'contain' => $this->paginate['User']['contain'])
                  ));
        }
        //end csv export

        $this->set('page_options', $page_options);
        $this->set('users', $this->paginate('User'));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_view($user_id = null, $application_id = null) {
        // $this->StudyMonitor->id = $id;
        // if (!$this->StudyMonitor->exists()) {
        //  throw new NotFoundException(__('Invalid study monitor'));
        // }
        // $this->set('studyMonitor', $this->StudyMonitor->read(null, $id));
        if (empty($user_id)) {
            $this->Session->setFlash(__('User does not exist!'), 'alerts/flash_error');
            $this->redirect(array('controller' => 'study_monitors', 'action' => 'index'));
        }
        $user = $this->User->find('first', array(
            'contain' => array('StudyMonitor'=> array('Application')),
            'conditions' => array('User.id' => $user_id)
            )
        );
        $this->set('user', $user);

        $this->Prg->commonProcess();
        $criteria = $this->Application->parseCriteria($this->passedArgs);
        // $criteria['Application.submitted'] = 1;
        $criteria['NOT'] = array('Application.id' => Hash::extract($user['StudyMonitor'], '{n}.application_id'));
        $this->paginate['Application']['conditions'] = $criteria;

        $this->paginate['Application']['order'] = array('User.created' => 'desc');
        $this->paginate['Application']['contain'] = array('User');

        $this->set('applications', $this->paginate('Application'));

        if ($this->request->is('post')) {
            //save assignment

            $this->StudyMonitor->save(array('application_id' => $application_id, 'user_id' => $user_id, 'owner_id' => $this->Application->field('user_id', array('Application.id' => $application_id))));
            //save application
            //$this->Application->save(array('id' => $application_id, 'user_id' => $user_id), array('validate' => false, 'fieldList' => array('user_id')));

            $this->Session->setFlash(__('The application has been successfully assigned to the study monitor'), 'alerts/flash_success');
            // $this->redirect(array('controller' => 'reassignments','action' => 'index'));
            $this->redirect($this->referer());
        }
    }

/**
 * add method
 *
 * @return void
 */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->StudyMonitor->create();
            if ($this->StudyMonitor->save($this->request->data)) {
                $this->Session->setFlash(__('The study monitor has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The study monitor could not be saved. Please, try again.'));
            }
        }
        $users = $this->StudyMonitor->User->find('list');
        $applications = $this->StudyMonitor->Application->find('list');
        $amendments = $this->StudyMonitor->Amendment->find('list');
        $this->set(compact('users', 'applications', 'amendments'));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_edit($id = null) {
        $this->StudyMonitor->id = $id;
        if (!$this->StudyMonitor->exists()) {
            throw new NotFoundException(__('Invalid study monitor'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->StudyMonitor->save($this->request->data)) {
                $this->Session->setFlash(__('The study monitor has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The study monitor could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->StudyMonitor->read(null, $id);
        }
        $users = $this->StudyMonitor->User->find('list');
        $applications = $this->StudyMonitor->Application->find('list');
        $amendments = $this->StudyMonitor->Amendment->find('list');
        $this->set(compact('users', 'applications', 'amendments'));
    }

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->StudyMonitor->id = $id;
        if (!$this->StudyMonitor->exists()) {
            throw new NotFoundException(__('Invalid study monitor'));
        }
        if ($this->StudyMonitor->delete()) {
            $this->Session->setFlash(__('Study monitor deleted'), 'alerts/flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Study monitor was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    private function csv_export($cusers = ''){
        //todo: check if data exists in $users
        $_serialize = 'cusers';
        $_header = array('Id', 'Username', 'Name', 'Phone No', 'Email', 'Sponsor\'s Email' , 'Qualification', 'Role', 'Name of institution',
            'Physical Address', 'Institution Address', 'Institution Contact', 
            'Created',
            );
        $_extract = array('User.id', 'User.username', 'User.name', 'User.phone_no', 'User.email', 'User.sponsor_email', 'User.qualification',
            'Group.name', 'User.name_of_institution', 'User.institution_physical', 'User.institution_address', 'User.institution_contact', 
            'User.created');

        $this->response->download('users_'.date('Ymd_Hi').'.csv'); // <= setting the file name
        $this->viewClass = 'CsvView.Csv';
        $this->set(compact('cusers', '_serialize', '_header', '_extract'));
    }
}
