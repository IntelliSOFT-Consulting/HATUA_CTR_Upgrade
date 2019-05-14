<?php
App::uses('AppController', 'Controller');
/**
 * Reviews Controller
 *
 * @property Review $Review
 */
class ReviewsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Review->recursive = 0;
		$this->set('reviews', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		$this->set('review', $this->Review->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
/*	public function add() {
		if ($this->request->is('post')) {
			$this->Review->create();
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
			}
		}
		$reviewers = $this->Review->Reviewer->find('list');
		$this->set(compact('reviewers'));
	}*/

	public function manager_add($id = null) {
		if ($this->request->is('post')) {
			$this->Review->create();
			$message = $this->request->data['Message'];
			unset($this->request->data['Message']);
			if(!empty($this->request->data)) {
				foreach ($this->request->data as $key => $value) {
					$this->request->data[$key]['Review']['application_id'] = $id;
					$this->request->data[$key]['Review']['type'] = 'request';
					$this->request->data[$key]['Review']['title'] = 'PPB request';
					$this->request->data[$key]['Review']['text'] = $message['text'];
				}

				if ($this->Review->saveMany($this->request->data)) {
					// Create object of Gearman client
				       // $client = new GearmanClient();
				       // Add Gearman server
				       // $client->addServer("127.0.0.1", 4730);
				       // Process job through worker
				       // $data = array(
				       // 	'function' => 'newAppNotifyReviewer',
				       // 	'Reviews' => $this->request->data
				       // );
				       // $client->doBackground('sendnotification', serialize($data));
				       CakeResque::enqueue('default', 'NotificationShell', array('newAppNotifyReviewer', $this->request->data));

					$this->Session->setFlash(__('The reviewers have been notified'), 'alerts/flash_success');
					$this->redirect(array('controller' => 'applications', 'action' => 'view', $id));
				} else {
					$this->Session->setFlash(__('The reviewers could not be notified. Please, try again.'));
					$this->redirect(array('controller' => 'applications', 'action' => 'view', $id));
				}
			} else {
				$this->Session->setFlash(__('Please select at least one reviewer'), 'alerts/flash_error');
				$this->redirect(array('controller' => 'applications', 'action' => 'view', $id));
			}
		}
		$users = $this->Review->User->find('list');
		$applications = $this->Review->Application->find('list');
		$this->set(compact('users', 'applications'));
	}

	public function manager_comment($id = null) {
		if ($this->request->is('post')) {
			$this->Review->create();
			$this->request->data['Review']['user_id'] = $this->Auth->User('id');
			$this->request->data['Review']['type'] = 'ppb_comment';

			if($this->Auth->password($this->request->data['Review']['password']) === $this->Auth->User('confirm_password')) {
				if ($this->Review->save($this->request->data)) {
					$data = array(
						'application_id' => $this->request->data['Review']['application_id'],
						'manager' => $this->Auth->User('id'));
					CakeResque::enqueue('default', 'NotificationShell', array('managerCommentNotifyApplicant', $data));
					$this->Session->setFlash(__('Thank you. Your comments have been saved. They are now visible to the investigator'),
						'alerts/flash_success');
					$this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['Review']['application_id']));
				} else {
					$this->Session->setFlash(__('Your comments could not be saved. Please, try again.'));
				}
			} else {
				$this->Session->setFlash(__('The password you have entered is not correct! Please enter the correct password
					and try again.'), 'alerts/flash_error');
				$this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['Review']['application_id']));
			}

			// if ($this->Review->saveMany($this->request->data)) {
			// 	$this->Session->setFlash(__('The reviewers have been saved'), 'alerts/flash_success');
			// 	$this->redirect(array('controller' => 'applications', 'action' => 'view', $id));
			// } else {
			// 	$this->Session->setFlash(__('The reviewers could not be saved. Please, try again.'));
			// }
		}
		$users = $this->Review->User->find('list');
		$applications = $this->Review->Application->find('list');
		$this->set(compact('users', 'applications'));
	}

	public function reviewer_add() {
		if ($this->request->is('post')) {
			$this->Review->create();
			$this->request->data['Review']['user_id'] = $this->Auth->User('id');
			$this->request->data['Review']['type'] = 'reviewer_comment';

			if($this->Auth->password($this->request->data['Review']['password']) === $this->Auth->User('confirm_password')) {
				if ($this->Review->save($this->request->data)) {
					// Set job to notify managers
					CakeResque::enqueue('default', 'NotificationShell', array('reviewerCommentNotifyManagers',
						$this->request->data['Review']['application_id'], $this->Auth->User('id')));
					$this->Session->setFlash(__('Thank you. Your review comments have been sent to PPB'),
						'alerts/flash_success');
					$this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['Review']['application_id']));
				} else {
					$this->Session->setFlash(__('Your comments could not be saved. Please, try again.'));
				}
			} else {
				$this->Session->setFlash(__('The password you have entered is not correct! Please enter the correct password
					and try again.'), 'alerts/flash_error');
				$this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['Review']['application_id']));
			}

		}
		$users = $this->Review->User->find('list');
		$applications = $this->Review->Application->find('list');
		$this->set(compact('users', 'applications'));
	}

	public function reviewer_respond() {
		if ($this->request->is('post')) {
			if (empty($this->request->data['Review']['accepted'])) {
				$this->Session->setFlash(__('Please accept / decline the offer!!'), 'alerts/flash_error');
				$this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['Review']['application_id']));
			}

			$review = $this->Review->find('first', array('conditions' => array(
				'Review.application_id' => $this->request->data['Review']['application_id'],
				'Review.user_id' => $this->Auth->User('id'),
				'Review.type' => 'request'), 'contain' => array()));
			if(!empty($review)){
				$this->Review->create();
				$review['Review']['accepted'] = $this->request->data['Review']['accepted'];
				$review['Review']['recommendation'] = $this->request->data['Review']['recommendation'];
				if($this->Auth->password($this->request->data['Review']['password']) === $this->Auth->User('confirm_password')) {
				   if ($this->Review->save($review)) {
				       /*$client = new GearmanClient();
				       // Add Gearman server
				       $client->addServer("127.0.0.1", 4730);
				       // Process job through worker
				       $data = array(
				       	'function' => 'ppRequestReviewerResponse',
				       	'Reviewer' => $review
				       );
				       $client->doBackground('sendnotification', serialize($data));*/
				       CakeResque::enqueue('default', 'NotificationShell', array('ppbRequestReviewerResponse', $review));

				       if($review['Review']['accepted'] == 'accepted') {
				       	$this->Session->setFlash(__('Thank you. Your response has been sent to PPB. You may proceed to
			             	review the application'),  'alerts/flash_success');
			             	$this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['Review']['application_id']));
					} elseif($review['Review']['accepted'] == 'declined') {
						$this->Session->setFlash(__('Thank you for your prompt response.'),  'alerts/flash_info');
			             	$this->redirect(array('controller' => 'applications', 'action' => 'index'));
					} else {
						$this->Session->setFlash(__('NO response.'),  'alerts/flash_info');
			             	$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
					}

				  } else {
					$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
					$this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['Review']['application_id']));
				  }
				} else {
					$this->Session->setFlash(__('The password you have entered is not correct! Please enter your correct password
						and try again.'), 'alerts/flash_error');
					$this->redirect(array('controller' => 'applications', 'action' => 'view', $this->request->data['Review']['application_id']));
				}
			} else {
				$this->Session->setFlash(__('Seems the request review is empty!'), 'alerts/flash_error');
				$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
			}
		} else {
			$this->Session->setFlash(__('Invalid method signature!'), 'alerts/flash_error');
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
		}
		// $users = $this->Review->User->find('list');
		// $applications = $this->Review->Application->find('list');
		// $this->set(compact('users', 'applications'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Review->read(null, $id);
		}
		$reviewers = $this->Review->Reviewer->find('list');
		$this->set(compact('reviewers'));
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
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		if ($this->Review->delete()) {
			$this->Session->setFlash(__('Review deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Review was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}