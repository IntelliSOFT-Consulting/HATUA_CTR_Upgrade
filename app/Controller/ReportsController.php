<?php
App::uses('AppController', 'Controller');
/**
 * PreviousDates Controller
 *
 * @property PreviousDate $PreviousDate
 */
class ReportsController extends AppController {
    public $uses = array('SiteInspection', 'Application', 'Sae');

    /**
     * site inspections per month method
     *
     * @return void
    */
    public function si_per_month() {
        $data = $this->SiteInspection->find('all', array(
            'fields' => array('date_format(SiteInspection.created,"%M") as name', 'COUNT(*) as y'),
            'contain' => array(),
            'group' => 'date_format(SiteInspection.created,"%M")'
          ));
        $data = Hash::extract($data, '{n}.{n}');
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
        $this->render('si_per_month');
    }
    public function inspector_si_per_month(){
        $this->si_per_month();
    }
    public function manager_si_per_month(){
        $this->si_per_month();
    }

    public function sae_per_month() {
        $data = $this->Sae->find('all', array(
            'fields' => array('date_format(Sae.created,"%M") as name', 'COUNT(*) as y'),
            'contain' => array(),
            'group' => 'date_format(Sae.created,"%M")'
          ));
        $data = Hash::extract($data, '{n}.{n}');
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
        $this->render('sae_per_month');
    }
    public function inspector_sae_per_month(){
        $this->sae_per_month();
    }
    public function manager_sae_per_month(){
        $this->sae_per_month();
    }
    
  /**
   * view method
   *
   * @throws NotFoundException
   * @param string $id
   * @return void
   */
    public function view($id = null) {
      $this->PreviousDate->id = $id;
      if (!$this->PreviousDate->exists()) {
        throw new NotFoundException(__('Invalid previous date'));
      }
      $this->set('previousDate', $this->PreviousDate->read(null, $id));
    }

  /**
   * add method
   *
   * @return void
   */
    public function add() {
      if ($this->request->is('post')) {
        $this->PreviousDate->create();
        if ($this->PreviousDate->save($this->request->data)) {
          $this->Session->setFlash(__('The previous date has been saved'));
          $this->redirect(array('action' => 'index'));
        } else {
          $this->Session->setFlash(__('The previous date could not be saved. Please, try again.'));
        }
      }
      $applications = $this->PreviousDate->Application->find('list');
      $this->set(compact('applications'));
    }

  /**
   * edit method
   *
   * @throws NotFoundException
   * @param string $id
   * @return void
   */
    public function edit($id = null) {
      $this->PreviousDate->id = $id;
      if (!$this->PreviousDate->exists()) {
        throw new NotFoundException(__('Invalid previous date'));
      }
      if ($this->request->is('post') || $this->request->is('put')) {
        if ($this->PreviousDate->save($this->request->data)) {
          $this->Session->setFlash(__('The previous date has been saved'));
          $this->redirect(array('action' => 'index'));
        } else {
          $this->Session->setFlash(__('The previous date could not be saved. Please, try again.'));
        }
      } else {
        $this->request->data = $this->PreviousDate->read(null, $id);
      }
      $applications = $this->PreviousDate->Application->find('list');
      $this->set(compact('applications'));
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
      $this->PreviousDate->id = $id;
      if (!$this->PreviousDate->exists()) {
        throw new NotFoundException(__('Invalid previous date'));
      }
      if(!$this->PreviousDate->isOwnedBy($id, $this->Auth->user('id'))) {
        $this->set('message', 'You do not have permission to access this resource');
        $this->set('_serialize', 'message');
      } else {
        if ($this->PreviousDate->delete()) {
          $this->set('message', 'Previous ECCT date deleted');
          $this->set('_serialize', 'message');
        } else {
          $this->set('message', 'Previous date was not deleted');
          $this->set('_serialize', 'message');
        }
      }
    }
}
