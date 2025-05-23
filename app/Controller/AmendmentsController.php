<?php
App::uses('AppController', 'Controller');
/**
 * Amendments Controller
 *
 * @property Amendment $Amendment 
 */
class AmendmentsController extends AppController
{

	/**
	 * index method
	 *
	 * @return void
	 */
	public function applicant_index()
	{
		$this->Amendment->recursive = 0;
		$this->set('amendments', $this->paginate());
	}
	public function  applicant_edit_amd($id = null)
	{
		$this->loadModel('Amend');
		$this->loadModel('Attachment');
		$this->loadModel('Application');
		$this->Amend->id = $id;
		if (!$this->Amend->exists()) {
			$this->Session->setFlash(__('Invalid Amendment.'), 'alerts/flash_error');
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		$amndt = $this->Amend->find('first', array('conditions' => array('Amend.id' => $id), 'contain' => array('Attachment', 'Amendment')));

		$appId = $amndt['Amend']['application_id'];

		$app = $this->Application->find('first', array('conditions' => array('Application.id' => $appId), 'contain' => array('Amendment')));


		if ($this->request->is('post') || $this->request->is('put')) {
			$filedata = $this->request->data;
			$validate = false;
			if (isset($this->request->data['submitReport'])) {
				$validate = 'first';

				$counts = isset($filedata['Attachment']) ? $filedata['Attachment'] : [];
				if(!empty($filedata['Attachment'])){
				$this->request->data['Amend']['submitted'] = 1;
				$this->request->data['Amend']['date_submitted'] = date('Y-m-d H:i:s');
				}else{
					$message = "You need to upload the cover letter. Please, try again.";
					 $this->Session->setFlash(__($message), 'alerts/flash_error');
					return  $this->redirect($this->referer());
				}
			}


			$filedata = $this->request->data;

			// Check if 'Attachment' exists and get the first element
			$attachments = isset($filedata['Attachment']) ? $filedata['Attachment'] : [];
			$firstAttachment = !empty($attachments) ? reset($attachments) : [];

			if (!empty($firstAttachment) && !empty($firstAttachment['foreign_key'])) {
				$foreignKey = $firstAttachment['foreign_key'];

				// Find existing amendment using foreign_key
				$existingAmend = $this->Amend->find('first', [
					'conditions' => ['Amend.id' => $foreignKey],
					'fields' => ['id']
				]);

				if (!empty($existingAmend)) {
					$filedata['Amend']['id'] = $existingAmend['Amend']['id']; // Use existing ID
				}
			}

			if ($this->Amend->saveAssociated($filedata, array('validate' => $validate, 'deep' => true))) {
				if ($validate) {
					$this->Session->setFlash(__('You have successfully submitted the amendment to PPB. PPB will review
						this amendment and notify you on the progress. You can view the progress of the application by clicking on
						&#39;my applications&#39; on the dashboard menu. Thank you.'), 'alerts/flash_success');
					$this->redirect(array('action' => 'edit', $amndt['Amend']['amendment_id']));
				} else {
					$message = "The amendment justification has been saved";
					if ($this->RequestHandler->isAjax()) {
						// Get the last key in 'Attachment' array
						end($this->request->data['Attachment']);
						$lastKey = key($this->request->data['Attachment']);

						$latestAttachment = $this->Amend->Attachment->find('first', [
							'conditions' => [
								'Attachment.foreign_key' => $this->request->data['Attachment'][$lastKey]['foreign_key']
							],
							'order' => ['Attachment.id' => 'DESC'], // Get the most recently added attachment
							'contain' => []
						]);

						$this->set('response', [
							'message' => 'Success',
							'content' => $latestAttachment
						]);
					} else {

						$this->Session->setFlash(__($message), 'alerts/flash_success');
						$this->redirect(array('action' => 'edit_amd', $this->Amend->id));
					}
				}
			} else {
				$message = "The amendment could not be saved. Please, try again.";
				if ($this->RequestHandler->isAjax()) {
					$this->set('response', array('message' => 'Failure', 'errors' => $message));
				} else {
					$this->Session->setFlash(__($message), 'alerts/flash_error');
				}
			}
			if ($this->RequestHandler->isAjax()) $this->set('_serialize', 'response');
		} else {
			$this->request->data = $amndt;
		}
		$contains = $this->a_contain;
		$contains['Amendment'] =  array('Attachment', 'CoverLetter', 'Amend');

		$contains['Review'] = array('conditions' => array('Review.type' => 'ppb_comment'));
		$application = $this->Amendment->Application->find('first', array(
			'conditions' => array('Application.id' => $amndt['Amend']['application_id']),
			'contain' => $contains
		));
		$counter = 'amd-' . count($app['Amendment']);
		$this->set('counter', $counter);
		$this->set('current', $id);
		$this->set('application', $application);
	}


	public function applicant_basic_add($amd, $apl)
	{
		$this->loadModel('Amend');
		$this->Amend->create();
		if ($this->Amend->save($this->request->data, false)) {

			$this->Session->setFlash(__('Amendment Justification has been saved, please proceed'), 'alerts/flash_success');
			$this->redirect(array('action' => 'edit_amd', $this->Amend->id));
		} else {
			$this->Session->setFlash(__('The amendment could not be saved. Please, try again.'));
		}
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null)
	{
		$this->Amendment->id = $id;
		if (!$this->Amendment->exists()) {
			throw new NotFoundException(__('Invalid amendment'));
		}
		$this->set('amendment', $this->Amendment->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function applicant_add($id = null)
	{
		$this->Amendment->Application->id = $id;

		$application = $this->_isNewAmndt($id);
		$this->Amendment->create();
		$this->request->data['Amendment']['application_id'] = $id;

		// debug($this->request->data);
		// exit;
		if ($this->Amendment->save($this->request->data, false)) {
			$amd = $this->Amendment->id;
			// Create a new Amend as well
			$this->loadModel('Amend');
			$this->Amend->create();
			$this->request->data['Amend']['amendment_id'] = $amd;
			$this->request->data['Amend']['application_id'] = $id;

			// now save this data
			$this->Amend->save($this->request->data, false);

			$data = array(
				'id' => $this->Amendment->id,
				'application_id' => $application['Application']['id'],
				'user_id' => $this->Auth->User('id'),
				'protocol_no' => $application['Application']['protocol_no']
			);
			CakeResque::enqueue('default', 'NotificationShell', array('newAmndtNotifyApplicant', $data));
			$this->Session->setFlash(__('New amendment'), 'alerts/flash_success');
			$this->redirect(array('action' => 'edit_amd', $this->Amend->id));
		} else {
			$this->Session->setFlash(__('The amendment could not be saved. Please, try again.'));
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function applicant_edit($id = null)
	{
		$this->Amendment->id = $id;
		if (!$this->Amendment->exists()) {
			$this->Session->setFlash(__('Invalid Amendment.'), 'alerts/flash_error');
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		$amndt = $this->Amendment->find('first', array('conditions' => array('Amendment.id' => $id), 'contain' => array('Amend')));
		if (!empty($amndt['Amend'])) {
			$notSubmitted = array_filter($amndt['Amend'], function ($amend) {
				return isset($amend['submitted']) && $amend['submitted'] === '0';
			});

			if (!empty($notSubmitted)) {
				usort($notSubmitted, function ($a, $b) {
					return strtotime($b['created']) - strtotime($a['created']);
				});

				// Pick the latest unsubmitted amendment
				$latestUnsubmitted = reset($notSubmitted);
				// debug($latestUnsubmitted['id']);
				return $this->redirect(array('action' => 'edit_amd', $latestUnsubmitted['id']));
			}
		}

		// debug($amndt);
		// exit;

		$contains = $this->a_contain;
		$contains['Amendment'] =  array('Attachment', 'CoverLetter', 'Amend');

		$contains['Review'] = array('conditions' => array('Review.type' => 'ppb_comment'));
		$application = $this->Amendment->Application->find('first', array(
			'conditions' => array('Application.id' => $amndt['Amendment']['application_id']),
			'contain' => $contains
		));

		$this->_isEditAmndt($application['Application']['user_id'], $application['Application']['id'], $amndt['Amendment']['submitted']);

		if ($this->request->is('post') || $this->request->is('put')) {
			if (isset($this->request->data['cancelReport'])) {
				$this->Session->setFlash(__('Amendment cancelled. You may edit and submit it later.'), 'alerts/flash_info');
				$this->redirect(array('controller' => 'applications', 'action' => 'view', $amndt['Amendment']['application_id']));
			}
			$validate = false;
			if (isset($this->request->data['submitReport'])) {
				$validate = 'first';
				$this->request->data['Amendment']['submitted'] = 1;
				$this->request->data['Amendment']['date_submitted'] = date('Y-m-d H:i:s');
			}

			$filedata = $this->request->data;
			unset($filedata['Amendment']);
			if (empty($this->request->data)) {
				$this->Session->setFlash(__('The file(s) you provided could not be saved. Kindly ensure that the file(s) are less than
					18 MB in size. <small>If they are larger, compress (zip,tar...) them to the required size first</small>'), 'alerts/flash_error');
				$this->redirect(array('action' => 'edit', $id));
			} elseif (!$this->Amendment->saveAll($filedata, array(
				'validate' => 'only',
				'fieldList' => array(
					'Attachment' => 'file'
				)
			))) {
				$this->Session->setFlash(__('The file(s) is not valid. If the file(s) are more than
					18 MB in size please compress them to below 18 MB first.'), 'alerts/flash_error');
			} else {
				if ($this->Amendment->saveAssociated($this->request->data, array('validate' => $validate, 'deep' => true))) {
					if ($validate) {
						$this->Session->setFlash(__('You have successfully submitted the amendment to PPB. PPB will review
							this amendment and notify you on the progress. You can view the progress of the application by clicking on
							&#39;my applications&#39; on the dashboard menu. Thank you.'), 'alerts/flash_success');
						// CakeResque::enqueue('default', 'NotificationShell', array('submitAmndtNotifyManagersReviewers',
						// 	$amndt['Amendment']['application_id']));
						$this->redirect(array('controller' => 'applications', 'action' => 'view', $amndt['Amendment']['application_id']));
					} else {
						$this->Session->setFlash(__('The amendment has been saved'), 'alerts/flash_success');
						$this->redirect(array('action' => 'edit', $this->Amendment->id));
					}
				} else {
					$this->Session->setFlash(__('The amendment could not be saved. Please, try again.'), 'alerts/flash_error');
				}
			}
		} else {
			$this->request->data = $amndt;
		}
		$this->set('current', $id);
		$this->set('application', $application);
	}

	/**
	 * delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function applicant_delete($id = null)
	{
		// if (!$this->request->is('post')) {
		// 	throw new MethodNotAllowedException();
		// }
		$this->Amendment->id = $id;
		if (!$this->Amendment->exists()) {
			throw new NotFoundException(__('Invalid amendment'));
		}
		if ($this->Amendment->delete()) {
			$this->Session->setFlash(__('Amendment deleted'), 'alerts/flash_success');
			$this->redirect(array('controller' => 'applications', 'action' => 'view', $this->Amendment->field('application_id')));
		}
		$this->Session->setFlash(__('Amendment was not deleted'), 'alerts/flash_error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * Utility Methods
	 */
	protected function _isNewAmndt($id)
	{
		$application = $this->Amendment->Application->find('first', array(
			'conditions' => array('Application.id' => $id),
			'fields' => array('Application.id', 'Application.submitted', 'Application.user_id', 'Application.protocol_no'),
			'contain' => array('Amendment' => array('conditions' => array('Amendment.submitted' => 0), 'fields' => 'Amendment.id')),
		));
		if (empty($application)) {
			$this->Session->setFlash(__('Application not found.'), 'alerts/flash_error');
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		} elseif ($application['Application']['user_id'] != $this->Auth->User('id')) {
			$this->Session->setFlash(__('You do not have permission to access this resource.'), 'alerts/flash_error');
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		} elseif (!empty($application['Amendment'])) {
			$this->Session->setFlash(__('You have an unsubmitted amendment for this application. Please edit and submit the
				pending amendment
				before you create a new one.'), 'alerts/flash_error');
			$this->redirect(array('controller' => 'amendments', 'action' => 'edit', $application['Amendment'][0]['id']));
		} elseif ($application['Application']['submitted'] != 1) {
			$this->Session->setFlash(
				__('You cannot amend this application because it has not been submitted to PPB.'),
				'alerts/flash_error'
			);
			$this->redirect(array('controller' => 'applications', 'action' => 'edit', $id));
		}
		return $application;
	}

	protected function _isEditAmndt($user_id, $application_id, $amndt_submitted)
	{
		if ($user_id != $this->Auth->User('id')) {
			$this->Session->setFlash(__('You do not have permission to access this amendment'), 'alerts/flash_error');
			$this->redirect(array('controller' => 'applications', 'action' => 'index'));
		} elseif ($amndt_submitted) {
			$this->Session->setFlash(__('Amendment already submitted to PPB. You may create a new amendment.'), 'alerts/flash_info');
			$this->redirect(array('controller' => 'applications', 'action' => 'view', $application_id));
		}
	}
}
