<?php
App::uses('AppController', 'Controller');
/**
 * Saes Controller
 *
 * @property Sae $Sae
 */
class SaesController extends AppController {
    public $paginate = array();
/**
 * index method
 *
 * @return void
 */
    public function applicant_index() {
        $this->Sae->recursive = 0;
        $this->paginate['contain'] = array('Application', 'Country');
        $this->paginate['conditions'] = array('Sae.user_id' => $this->Auth->User('id'));
        $this->set('saes', $this->paginate());
    }
    public function index() {
        $this->Sae->recursive = 0;
        $this->paginate['contain'] = array('Application', 'Country');
        $this->set('saes', $this->paginate());
    }
    public function manager_index() {
        $this->index();
    }
    public function inspector_index() {
        $this->index();
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function applicant_view($id = null) {
        $this->Sae->id = $id;
        if (!$this->Sae->exists()) {
            throw new NotFoundException(__('Invalid sae'));
        }
        $sae = $this->Sae->read(null, $id);
        if ($sae['Sae']['approved'] < 1) {
                $this->Session->setFlash(__('The sae has been submitted'), 'alerts/flash_info');
                $this->redirect(array('action' => 'edit', $this->Sae->id));
        }
        if ($sae['Sae']['user_id'] !== $this->Auth->User('id')) {
                $this->Session->setFlash(__('You don\'t have permission to access!!'), 'alerts/flash_error');
                $this->redirect('/');
        }
        $this->set('sae', $this->Sae->find('first', array(
            'contain' => array('Application', 'Country', 'SuspectedDrug' => array('Route'), 'ConcomittantDrug' => array('Route')),
            'conditions' => array('Sae.id' => $id)
            )
        ));
        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'SAE_' . $id,  'orientation' => 'portrait');
        }
    }
    public function aview($id = null) {
        $this->Sae->id = $id;
        if (!$this->Sae->exists()) {
            throw new NotFoundException(__('Invalid sae'));
        }
        $sae = $this->Sae->read(null, $id);
        if ($sae['Sae']['approved'] < 1) {
            $this->Session->setFlash(__('The sae has not been submitted'), 'alerts/flash_info');
        }

        $this->set('sae', $this->Sae->find('first', array(
            'contain' => array('Application', 'Country', 'SuspectedDrug' => array('Route'), 'ConcomittantDrug' => array('Route')),
            'conditions' => array('Sae.id' => $id)
            )
        ));
        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'SAE_' . $id,  'orientation' => 'portrait');
        }
    }
    public function manager_view($id = null) {
      $this->aview($id);
    }
    public function inspector_view($id = null) {
      $this->aview($id);
    }
/**
 * add method
 *
 * @return void
 */
    public function applicant_add() {
        if ($this->request->is('post')) {
            $this->Sae->create();
            if ($this->Sae->save($this->request->data)) {
                $this->Session->setFlash(__('The sae has been saved'), 'alerts/flash_success');
                $this->redirect(array('action' => 'edit', $this->Sae->id));
            } else {
                $this->Session->setFlash(__('The sae could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        }
        // $applications = $this->Sae->Application->find('list');
        // $users = $this->Sae->User->find('list');
        // $this->set(compact('applications', 'users'));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function applicant_edit($id = null) {
        $this->Sae->id = $id;
        if (!$this->Sae->exists()) {
            throw new NotFoundException(__('Invalid sae'));
        }
        $sae = $this->Sae->read(null, $id);
        if ($sae['Sae']['approved'] > 0) {
                $this->Session->setFlash(__('The sae has been submitted'), 'alerts/flash_info');
                $this->redirect(array('action' => 'view', $this->Sae->id));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Sae->saveAssociated($this->request->data, array('deep' => true))) {
                if (isset($this->request->data['submitReport'])) {
                    $this->Sae->saveField('approved', 1);
                    $this->Session->setFlash(__('The sae has been submitted to mcaz'), 'alerts/flash_success');
                    $this->redirect(array('action' => 'view', $this->Sae->id));               
                }
                $this->Session->setFlash(__('The sae has been saved'), 'alerts/flash_success');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The sae could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        } else {
            $this->request->data = $this->Sae->read(null, $id);
        }

        $sae = $this->request->data;

        $applications = $this->Sae->Application->find('list', array(
            'fields' => array('Application.id', 'Application.protocol_no'),
            'conditions' => array('Application.user_id' => $this->Session->read('Auth.User.id'))));
        $routes = $this->Sae->SuspectedDrug->Route->find('list');
        $countries = $this->Sae->Country->find('list');
        $this->set(compact('sae', 'routes', 'countries', 'applications'));
    }

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function applicant_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Sae->id = $id;
        if (!$this->Sae->exists()) {
            throw new NotFoundException(__('Invalid sae'));
        }
        if ($this->Sae->delete()) {
            $this->Session->setFlash(__('Sae deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Sae was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
