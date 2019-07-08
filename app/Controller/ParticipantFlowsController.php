<?php
App::uses('AppController', 'Controller');
/**
 * ParticipantFlows Controller
 *
 * @property ParticipantFlow $ParticipantFlow
 */
class ParticipantFlowsController extends AppController {

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->ParticipantFlow->recursive = 0;
        $this->set('participantFlows', $this->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        $this->ParticipantFlow->id = $id;
        if (!$this->ParticipantFlow->exists()) {
            throw new NotFoundException(__('Invalid participant flow'));
        }
        $this->set('participantFlow', $this->ParticipantFlow->read(null, $id));
    }

/**
 * add method
 *
 * @return void
 */
    public function applicant_add() {
        if ($this->request->is('post')) {
            $this->ParticipantFlow->create();
            if ($this->ParticipantFlow->save($this->request->data)) {
                $this->Session->setFlash(__('The participant flow has been saved'), 'alerts/flash_success');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The participant flow could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        }
        $this->redirect($this->referer());
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        $this->ParticipantFlow->id = $id;
        if (!$this->ParticipantFlow->exists()) {
            throw new NotFoundException(__('Invalid participant flow'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ParticipantFlow->save($this->request->data)) {
                $this->Session->setFlash(__('The participant flow has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The participant flow could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->ParticipantFlow->read(null, $id);
        }
        $applications = $this->ParticipantFlow->Application->find('list');
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
        $this->ParticipantFlow->id = $id;
        if (!$this->ParticipantFlow->exists()) {
            throw new NotFoundException(__('Invalid participant flow'));
        }
        if ($this->ParticipantFlow->delete()) {
            $this->Session->setFlash(__('Participant flow deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Participant flow was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
