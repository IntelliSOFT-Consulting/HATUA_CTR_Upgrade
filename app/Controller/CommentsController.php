<?php
App::uses('AppController', 'Controller');
App::uses('String', 'Utility');
App::uses('ThemeView', 'View');
App::uses('HtmlHelper', 'View/Helper');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {


/**
 * manager_index method
 *
 * @return void
 */
    public function manager_index() {
        $this->Comment->recursive = 0;
        $this->set('comments', $this->paginate());
    }

/**
 * manager_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function manager_view($id = null) {
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException(__('Invalid comment'));
        }
        $this->set('comment', $this->Comment->read(null, $id));
    }

/**
 * manager_add method
 *
 * @return void
 */
    private function add_si_internal() {
        if ($this->request->is('post')) {
            $this->Comment->create();
            if ($this->Comment->saveAssociated($this->request->data, array('deep' => true))) {

                //******************       Send Email and Notifications to Applicant and Managers          *****************************
                  $this->loadModel('Message');
                  $html = new HtmlHelper(new ThemeView());
                  $message = $this->Message->find('first', array('conditions' => array('name' => 'manager_si_feedback')));
                  $this->loadModel('SiteInspection');
                  $sae = $this->SiteInspection->find('first', array(
                      'contain' => array(),
                      'conditions' => array('SiteInspection.id' => $this->request->data['Comment']['foreign_key'])
                  ));

                  $users = $this->Comment->User->find('all', array(
                      'contain' => array(),
                      'conditions' => array('OR' => array('User.id' => $sae['SiteInspection']['user_id'], 'User.group_id' => array(2, 6)))
                  ));
                  foreach ($users as $user) {
                      if($user['User']['group_id'] == 2) $actioner =  'manager';
                      if($user['User']['group_id'] == 6) $actioner =  'inspector';
                      if($user['User']['group_id'] == 5) $actioner =  'applicant';

                      $variables = array(
                        'name' => $user['User']['name'], 'reference_no' => $sae['SiteInspection']['reference_no'], 
                        'comment_subject' => $this->request->data['Comment']['subject'],
                        'comment_content' => $this->request->data['Comment']['content'],
                        'reference_link' => $html->link($sae['SiteInspection']['reference_no'], array('controller' => 'site_inspections', 'action' => 'view', $sae['SiteInspection']['id'], $actioner => true, 'full_base' => true), 
                          array('escape' => false)),
                      );
                      $datum = array(
                        'email' => ($sae['SiteInspection']['reporter_email'] && $actioner == 'applicant') ? $sae['SiteInspection']['reporter_email'] : $user['User']['email'],
                        'id' => $this->request->data['Comment']['foreign_key'], 'user_id' => $user['User']['id'], 'type' => 'manager_sae_feedback', 'model' => 'SiteInspection',
                        'subject' => String::insert($message['Message']['subject'], $variables),
                        'message' => String::insert($message['Message']['content'], $variables)
                      );
                      CakeResque::enqueue('default', 'GenericEmailShell', array('sendEmail', $datum));
                      CakeResque::enqueue('default', 'GenericNotificationShell', array('sendNotification', $datum));
                  }
                //**********************************    END   *********************************

                $this->Session->setFlash(__('The comment has been saved'), 'alerts/flash_success');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.'), 'alerts/flash_success');
                $this->redirect($this->referer());
            }
        }
        $users = $this->Comment->User->find('list');
        $this->set(compact('users'));
    }
    private function add_si_external() {
        if ($this->request->is('post')) {
            $this->Comment->create();
            if ($this->Comment->saveAssociated($this->request->data, array('deep' => true))) {

                //******************       Send Email and Notifications to Applicant and Managers          *****************************
                  $this->loadModel('Message');
                  $html = new HtmlHelper(new ThemeView());
                  $message = $this->Message->find('first', array('conditions' => array('name' => 'manager_si_feedback')));
                  $this->loadModel('SiteInspection');
                  $sae = $this->SiteInspection->find('first', array(
                      'contain' => array(),
                      'conditions' => array('SiteInspection.id' => $this->request->data['Comment']['foreign_key'])
                  ));

                  $users = $this->Comment->User->find('all', array(
                      'contain' => array(),
                      'conditions' => array('OR' => array('User.id' => $sae['SiteInspection']['user_id'], 'User.group_id' => array(2, 6)))
                  ));
                  foreach ($users as $user) {
                      if($user['User']['group_id'] == 2) $actioner =  'manager';
                      if($user['User']['group_id'] == 6) $actioner =  'inspector';
                      if($user['User']['group_id'] == 5) $actioner =  'applicant';

                      $variables = array(
                        'name' => $user['User']['name'], 'reference_no' => $sae['SiteInspection']['reference_no'], 
                        'comment_subject' => $this->request->data['Comment']['subject'],
                        'comment_content' => $this->request->data['Comment']['content'],
                        'reference_link' => $html->link($sae['SiteInspection']['reference_no'], array('controller' => 'site_inspections', 'action' => 'view', $sae['SiteInspection']['id'], $actioner => true, 'full_base' => true), 
                          array('escape' => false)),
                      );
                      $datum = array(
                        'email' => ($sae['SiteInspection']['reporter_email'] && $actioner == 'applicant') ? $sae['SiteInspection']['reporter_email'] : $user['User']['email'],
                        'id' => $this->request->data['Comment']['foreign_key'], 'user_id' => $user['User']['id'], 'type' => 'manager_sae_feedback', 'model' => 'SiteInspection',
                        'subject' => String::insert($message['Message']['subject'], $variables),
                        'message' => String::insert($message['Message']['content'], $variables)
                      );
                      CakeResque::enqueue('default', 'GenericEmailShell', array('sendEmail', $datum));
                      CakeResque::enqueue('default', 'GenericNotificationShell', array('sendNotification', $datum));
                  }
                //**********************************    END   *********************************
                  
                $this->Session->setFlash(__('The comment has been saved'), 'alerts/flash_success');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.'), 'alerts/flash_success');
                $this->redirect($this->referer());
            }
        }
        $users = $this->Comment->User->find('list');
        $this->set(compact('users'));
    }
    public function manager_add_si_internal() {
        $this->add_si_internal();
    }
    public function manager_add_si_external() {
        $this->add_si_external();
    }
    public function inspector_add_si_internal() {
        $this->add_si_internal();
    }
    public function inspector_add_si_external() {
        $this->add_si_external();
    }
    public function applicant_add_si_external() {
        $this->add_si_external();
    }


    private function add_sae_external() {
        if ($this->request->is('post')) {
            $this->Comment->create();
            if ($this->Comment->saveAssociated($this->request->data, array('deep' => true))) {
                
                //******************       Send Email and Notifications to Applicant and Managers          *****************************
                  $this->loadModel('Message');
                  $html = new HtmlHelper(new ThemeView());
                  $message = $this->Message->find('first', array('conditions' => array('name' => 'manager_sae_feedback')));
                  $this->loadModel('Sae');
                  $sae = $this->Sae->find('first', array(
                      'contain' => array(),
                      'conditions' => array('Sae.id' => $this->request->data['Comment']['foreign_key'])
                  ));

                  $users = $this->Comment->User->find('all', array(
                      'contain' => array(),
                      'conditions' => array('OR' => array('User.id' => $sae['Sae']['user_id'], 'User.group_id' => 2))
                  ));
                  foreach ($users as $user) {
                      $actioner = ($user['User']['group_id'] == 2) ? 'manager' : 'applicant';
                      $variables = array(
                        'name' => $user['User']['name'], 'reference_no' => $sae['Sae']['reference_no'], 
                        'comment_subject' => $this->request->data['Comment']['subject'],
                        'comment_content' => $this->request->data['Comment']['content'],
                        'reference_link' => $html->link($sae['Sae']['reference_no'], array('controller' => 'saes', 'action' => 'view', $sae['Sae']['id'], $actioner => true, 'full_base' => true), 
                          array('escape' => false)),
                      );
                      $datum = array(
                        'email' => ($sae['Sae']['reporter_email'] && $actioner == 'applicant') ? $sae['Sae']['reporter_email'] : $user['User']['email'],
                        'id' => $this->request->data['Comment']['foreign_key'], 'user_id' => $user['User']['id'], 'type' => 'manager_sae_feedback', 'model' => 'Sae',
                        'subject' => String::insert($message['Message']['subject'], $variables),
                        'message' => String::insert($message['Message']['content'], $variables)
                      );
                      CakeResque::enqueue('default', 'GenericEmailShell', array('sendEmail', $datum));
                      CakeResque::enqueue('default', 'GenericNotificationShell', array('sendNotification', $datum));
                  }
                //**********************************    END   *********************************

                $this->Session->setFlash(__('The comment has been sent to the user'), 'alerts/flash_success');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.'), 'alerts/flash_success');
                $this->redirect($this->referer());
            }
        }
        $users = $this->Comment->User->find('list');
        $this->set(compact('users'));
    }
    public function manager_add_sae_external() {
        $this->add_sae_external();
    }
    public function inspector_add_sae_external() {
        $this->add_sae_external();
    }
    public function applicant_add_sae_external() {
        $this->add_sae_external();
    }

/**
 * manager_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function manager_edit($id = null) {
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException(__('Invalid comment'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash(__('The comment has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Comment->read(null, $id);
        }
        $users = $this->Comment->User->find('list');
        $this->set(compact('users'));
    }

/**
 * manager_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function manager_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException(__('Invalid comment'));
        }
        if ($this->Comment->delete()) {
            $this->Session->setFlash(__('Comment deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Comment was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
