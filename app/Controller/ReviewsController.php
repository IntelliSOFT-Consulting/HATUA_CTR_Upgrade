<?php
App::uses('AppController', 'Controller');
/**
 * Reviews Controller
 *
 * @property Review $Review
 */
class ReviewsController extends AppController {
    public $uses = array('Review', 'Application');

    public function beforeFilter() {
        parent::beforeFilter();
        // $this->Auth->allow('*');
        $this->Auth->allow('reviewer_test');
    }

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
/*  public function add() {
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

    public function manager_edit($id = null) {
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
                       //   'function' => 'newAppNotifyReviewer',
                       //   'Reviews' => $this->request->data
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
            //  $this->Session->setFlash(__('The reviewers have been saved'), 'alerts/flash_success');
            //  $this->redirect(array('controller' => 'applications', 'action' => 'view', $id));
            // } else {
            //  $this->Session->setFlash(__('The reviewers could not be saved. Please, try again.'));
            // }
        }
        $users = $this->Review->User->find('list');
        $applications = $this->Review->Application->find('list');
        $this->set(compact('users', 'applications'));
    }

    public function add($application_id = null, $review_type = null) {
        $this->Review->create();
        $application = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $application_id),
        ));
        
        $this->loadModel('ReviewQuestion');
        $all_questions = $this->ReviewQuestion->find('all', array('conditions' => array('ReviewQuestion.review_type' => $review_type), 'order' => array('ReviewQuestion.question_number' => 'asc')));
        $answers = [];
        foreach ($all_questions as $question) {
            $dpoint = ['question_type' => $question['ReviewQuestion']['question_type'], 'question_number' => $question['ReviewQuestion']['question_number'], 
                       'review_type' => $question['ReviewQuestion']['review_type'], 'question' => $question['ReviewQuestion']['question']];
            $answers[] = $dpoint;
        }

        $data = array('application_id' => $application_id, 'user_id' => $this->Auth->User('id'), 'type' => 'reviewer_comment',
                      'assessment_type' => $review_type
                );
        if ($this->Review->saveAssociated(array('Review' => $data, 'ReviewAnswer' => $answers))) {            
            $this->Session->setFlash(__('The review assessment form has been created. Kindly complete review'), 'alerts/flash_success');
            $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'rreview_view' => $this->Review->id));
        } else {
            $this->Session->setFlash(__('The review assessment could not be created. Please contact the administrator.'), 'alerts/flash_error');
        }
    }
    public function manager_add($application_id = null, $review_type = null) {
        $this->add($application_id, $review_type);
    }
    public function reviewer_add($application_id = null, $review_type = null) {
        $this->add($application_id, $review_type);
    }

    public function manager_add_old($application_id = null, $review_type = null) {
        $this->Review->create();
        $application = $this->Application->find('first', array(
            'conditions' => array('Application.id' => $application_id),
        ));

        $data = array('application_id' => $application_id,  
                      'assessment_type' => $review_type
                );
        if ($this->Review->saveAssociated(array('Review' => $data))) {            
            $this->Session->setFlash(__('The review assessment form has been created. Kindly complete review'), 'alerts/flash_success');
            $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'rreview_view' => $this->Review->id));
        } else {
            $this->Session->setFlash(__('The review assessment could not be created. Please contact the administrator.'), 'alerts/flash_error');
        }
    }

    public function reviewer_test($id = null) {
         // if (isset($this->request->data['submitReport'])) 
        debug($this->request->data);
    }

    public function assess($id = null, $application_id = null) {
        $this->Review->id = $id;
        if (!$this->Review->exists()) {
            throw new NotFoundException(__('Invalid review id'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Review->saveMany($this->request->data['Review'], array('deep' => true))) {
                if (isset($this->request->data['submitReport'])) {
                    $this->Review->saveField('status', 'Submitted');
                    // $results = Hash::extract($this->request->data['Review'], '{n}.ReviewAnswer.{n}.comment');
                    $results = '';
                    foreach ($this->request->data['Review'] as $ansa) {
                        foreach ($ansa as $key => $value) {
                            $results .= $value['question']."\n";
                            $results .= $value['comment']."\n\n";
                        }
                    }
                    // $this->Review->saveField('summary', implode("\n\n",$results));
                    $this->Review->saveField('summary', $results);
                		$this->Session->setFlash(__('The review has been submitted'), 'alerts/flash_success');
                } else {                	
                		$this->Session->setFlash(__('The review has been saved'), 'alerts/flash_success');
                }
                $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'rreview_view' => $id));
            } else {
                $this->Session->setFlash(__('The review could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        } else {
            $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'rreview_view' => $id));
        }
    }
    public function manager_assess($id = null, $application_id = null) {
        $this->assess($id, $application_id);
    }
    public function reviewer_assess($id = null, $application_id = null) {
        $this->assess($id, $application_id);
    }

    public function summary($id = null, $application_id = null) {
        // debug($this->request);
        $this->Review->id = $id;
        if (!$this->Review->exists()) {
            throw new NotFoundException(__('Invalid review'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Review->saveMany($this->request->data['Review'], array('deep' => true))) {
                if (isset($this->request->data['submitReport'])) {
                    $this->Review->saveField('status', 'Summary');
                }
                $this->Session->setFlash(__('The review has been saved'), 'alerts/flash_success');
                $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'rreview_view' => $id));
            } else {
                $this->Session->setFlash(__('The review could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        } else {
            $this->redirect(array('controller' => 'applications' , 'action' => 'view', $application_id, 'rreview_view' => $id));
        }
    }
    public function manager_summary($id = null, $application_id = null) {
        $this->summary($id, $application_id);
    }
    public function reviewer_summary($id = null, $application_id = null) {
        $this->summary($id, $application_id);
    }

    public function reviewer_edit() {
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
 * download methods
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    private function download_assessment($id = null) {
        $this->Review->id = $id;
        if (!$this->Review->exists()) {
            throw new NotFoundException(__('Invalid review assessment'));
        }
        $review = $this->Review->find('first', array(
            'conditions' => array('Review.id' => $id),
            'contain' => array('ReviewAnswer', 'Application')
            )
        );

        // debug($review['Application']);
        $disp  = $review['Review'];
        $disp['ReviewAnswer'] = $review['ReviewAnswer'];
        // $review  = $this->Review->read(null, $id);
        $this->set('rreview', $disp);
        $this->set('application', $review);
        $this->set('akey', $review['Review']['application_id']);
        $this->pdfConfig = array('filename' => 'Review_Assessment_' . $id,  'orientation' => 'portrait');
        $this->render('download_assessment');
    }
    public function manager_download_assessment($id = null) {
        $this->download_assessment($id);
    }
    public function inspector_download_assessment($id = null) {
        $this->download_assessment($id);
    }
    public function reviewer_download_assessment($id = null) {
        $this->download_assessment($id);
    }

    private function download_summary($id = null) {
        $this->Review->id = $id;
        if (!$this->Review->exists()) {
            throw new NotFoundException(__('Invalid review summary'));
        }
        $review = $this->Review->find('first', array(
            'conditions' => array('Review.id' => $id),
            'contain' => array('ReviewAnswer', 'Application')
            )
        );
        $disp  = $review['Review'];
        $disp['ReviewAnswer'] = $review['ReviewAnswer'];
        $this->set('rreview', $disp);
        $this->set('application', $review);
        $this->set('akey', $review['Review']['application_id']);
        $this->pdfConfig = array('filename' => 'review_Summary_' . $id,  'orientation' => 'portrait');
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
    public function reviewer_download_summary($id = null) {
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
