<?php
App::uses('AppController', 'Controller');
/**
 * MultiCenters Controller
 *
 */
class MultiCentersController extends AppController
{
	// public $uses = array('User', 'Application', 'Message', 'Pocket', 'AnnualLetter');


	/**
	 * Scaffold
	 *
	 * @var mixed
	 */
	public $scaffold;

	// create admin index
	public function admin_index()
	{
		$page_options = array('10' => '10', '20' => '20');
		$this->MultiCenter->recursive = 0;
		$this->set('multicenters', $this->paginate());
		$this->set('page_options', $page_options);
	}

	public function mapExtraFields($child, $parent)
	{
		$child['Application']['gender'] = '';
		$child['Application']['scope'] = '';
		$child['Application']['phase'] = '';
		$child['Application']['age_span'] = '';
		$child['Application']['site_exists'] = '';
		$child['Application']['product_type'] = '';

		// check initial_date_submitted is not empty then assign the value to the child datetime field
		if (!empty($parent['Application']['initial_date_submitted'])) {
			// convert the date to a valid datetime format
			$child['Application']['initial_date_submitted'] = date('Y-m-d H:i:s', strtotime($parent['Application']['initial_date_submitted']));
		}

		return $child;
	}

	public function admin_assign_site_study($id)
	{
		$this->loadModel('Application');
		$this->MultiCenter->id = $id;
		if (!$this->MultiCenter->exists()) {
			throw new NotFoundException(__('Invalid Multi Center request'));
		}

		// Check if already approved



		$center = $this->MultiCenter->read(null, $id);
		if ($center['MultiCenter']['status'] === 'Approved') {

			$this->Session->setFlash(__('The request has already been approved. Please try another request'), 'alerts/flash_error');
			return $this->redirect(array('action' => 'admin_index'));
		}
		// Retrieve the application and its related data
		$application = $this->Application->find('first', array(
			'conditions' => array('Application.id' => $center['MultiCenter']['application_id']),
			// 'contain' => array('MultiCenter', 'Sae', 'Message', 'MeetingDate')
		));

		if (empty($application)) {
			throw new NotFoundException(__('Invalid application'));
		}

		// debug($application);
		// exit;

		// count how many multicenters are already assigned to this application use the application table
		$assignedCenters = $this->Application->find('count', array(
			'conditions' => array('Application.application_id' => $center['MultiCenter']['application_id'])
		));
		// map them in terms of alphabetical letters i.e. A, B, C, D, E, F, G, H, I, J, K, L, M, N, O
		$assignedCenters = chr(65 + $assignedCenters);


		$newApplication = $application;
		unset($newApplication['Application']['id']);
		$newApplication['Application']['protocol_no'] = $application['Application']['protocol_no'] . ' - ' . $assignedCenters;
		$newApplication['Application']['application_id'] = $application['Application']['id'];
		$newApplication['Application']['user_id'] = $center['MultiCenter']['user_id'];
		$newApplication['Application']['is_child'] = true;
		$newApplication['Application']['submitted'] = 0;
		$newApplication['Application']['created'] = date("Y-m-d H:i:s");

		// call another function to map some extra fields
		$newApplication = $this->mapExtraFields($newApplication, $application);

		$this->Application->create();
		if ($this->Application->save($newApplication, array('validate' => true))) {
			// update the current Multicenter as approved
			$newApplicationId = $this->Application->id;
			$this->MultiCenter->saveField('status', 'Approved');
			$this->MultiCenter->saveField('app_id', $newApplicationId);

			$this->Session->setFlash(__('The application has been copied successfully.'), 'alerts/flash_success');
		} else {
			$validationErrors = $this->Application->validationErrors;
			$errorMessage = 'Application could not be copied. <br>';
			foreach ($validationErrors as $field => $errors) {
				foreach ($errors as $error) {
					$errorMessage .= $error . ' <br>';
				}
			}

			// Set flash message with validation errors
			$this->Session->setFlash(__($errorMessage), 'alerts/flash_error');
			$this->redirect($this->referer());
		}
		return $this->redirect(array('action' => 'admin_index'));
	}
}
