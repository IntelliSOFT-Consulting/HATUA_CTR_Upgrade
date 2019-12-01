<?php
App::uses('AppController', 'Controller');
/**
 * MeetingDates Controller
 *
 * @property MeetingDate $MeetingDate
 */
class MeetingDatesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MeetingDate->recursive = 0;
		$this->set('meetingDates', $this->paginate());
	}

	public function applicant_index() {
		$this->MeetingDate->recursive = 0;
		$this->set('meetingDates', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->MeetingDate->id = $id;
		if (!$this->MeetingDate->exists()) {
			throw new NotFoundException(__('Invalid meeting date'));
		}
		$this->set('meetingDate', $this->MeetingDate->read(null, $id));
	}

	public function applicant_view($id = null) {
		$this->MeetingDate->id = $id;
		if (!$this->MeetingDate->exists()) {
			throw new NotFoundException(__('Invalid meeting date'));
		}
		$this->set('meetingDate', $this->MeetingDate->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function applicant_add() {
		if ($this->request->is('post')) {
			$this->MeetingDate->create();
			debug($this->request->data);
			if ($this->MeetingDate->save($this->request->data)) {
				$this->Session->setFlash(__('The meeting date has been saved'), 'alerts/flash_success');
				$this->redirect(array('action' => 'applicant_edit', $this->MeetingDate->id));
			} else {
				$this->Session->setFlash(__('The meeting date could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->MeetingDate->id = $id;
		if (!$this->MeetingDate->exists()) {
			throw new NotFoundException(__('Invalid meeting date'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MeetingDate->save($this->request->data)) {
				$this->Session->setFlash(__('The meeting date has been saved'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The meeting date could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		} else {
			$this->request->data = $this->MeetingDate->read(null, $id);
		}
	}

	public function applicant_edit($id = null) {
		$this->MeetingDate->id = $id;
		if (!$this->MeetingDate->exists()) {
			throw new NotFoundException(__('Invalid meeting date'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MeetingDate->save($this->request->data)) {
				$this->Session->setFlash(__('The meeting date has been saved'), 'alerts/flash_success');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The meeting date could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		} else {
			$this->request->data = $this->MeetingDate->read(null, $id);
			// debug($this->request->data);
		}
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
		$this->MeetingDate->id = $id;
		if (!$this->MeetingDate->exists()) {
			throw new NotFoundException(__('Invalid meeting date'));
		}
		if ($this->MeetingDate->delete()) {
			$this->Session->setFlash(__('Meeting date deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Meeting date was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
