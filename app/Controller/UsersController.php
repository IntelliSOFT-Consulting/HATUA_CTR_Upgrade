<?php
App::uses('AppController', 'Controller');
App::uses('Validation', 'Utility');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public $paginate = array();
    public $uses = array('User', 'Application', 'Sae', 'Message');
    public $components = array('Search.Prg');
    public $presetVars = array(
            'filter' => array('type' => 'query', 'method' => 'orConditions', 'encode' => true),
            'start_date' => array('type' => 'value'),
            'end_date' => array('type' => 'value'),
        );

    public $helpers = array('Tools.Captcha' => array('type' => 'active'));
    
    public function beforeFilter() {
        parent::beforeFilter();
        // $this->Auth->allow('*');
        $this->Auth->allow('register', 'login', 'activate_account', 'forgotPassword', 'resetPassword', 'logout', 'initDB');
    }

    public function forgotPassword() {
        if ($this->Session->read('Auth.User')) {
            $this->Session->setFlash('You are logged in!', 'alerts/flash_success');
            $this->redirect('/', null, false);
        }
        if ($this->request->is('post')) {
            $this->User->recursive = -1;
            $user = $this->User->find('first', array('conditions' => array('User.email' => $this->request->data['User']['email'])));
            if ($user) {
                $this->User->id = $user['User']['id'];
                $this->User->saveField('forgot_password', 1);
                CakeResque::enqueue('default', 'UserShell', array('forgotPassword', $user));
                $this->Session->setFlash(__('A new password has been sent to the requested email address.'), 'alerts/flash_success');
                $this->redirect('/');
            } else {
                $this->Session->setFlash(__('Could not verify your email address.'), 'alerts/flash_error');
            }
        }
    }

    public function resetPassword($id = null) {
        //confirm user id hash for authenticity
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash(__('Could not verify the user ID. Please ensure the ID is correct.'), 'alerts/flash_error');
            $this->redirect('/');
        } else {
            $this->User->recursive = -1;
            // $user = $this->User->read(null, $id);
            $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            if ($user['User']['forgot_password'] != 1) {
                $this->Session->setFlash(__('The password has not been reset.'), 'alerts/flash_error');
                $this->redirect('/');
            }
                $password = date('Ymdhis', strtotime($user['User']['created']));
            if($this->User->save(
                                array('User' => array('password' =>  $password, 'confirm_password' => $password, 'forgot_password' => 0))
                                , array('fieldList' =>  array('password', 'confirm_password', 'forgot_password'))
            )) {
                $this->Session->setFlash(__('The password has been reset. You may login using your new password.'), 'alerts/flash_success');
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            } else {
                $this->Session->setFlash(__('The password has not been reset. Please contact PPB for further help'), 'alerts/flash_error');
            }
            $this->redirect('/');
        }
    }

    public function applicant_dashboard() {
        $applications = $this->User->Application->find('all', array(
            'limit' => 10,
            'fields' => array('Application.id','Application.user_id', 'Application.created', 'Application.protocol_no',
                'Application.study_drug', 'Application.submitted', 'Application.trial_status_id'),
            'order' => array('Application.created' => 'desc'),
            'contain' => array('Review'),
            'conditions' => array('Application.user_id' => $this->Auth->User('id')),
        ));
        $this->set('applications', $applications);
        $trial_statuses = $this->Application->TrialStatus->find('list');
        $this->set(compact('trial_statuses'));

        if ($this->request->is('post')) {
            $this->Application->create();
            $this->request->data['Application']['user_id'] = $this->Auth->User('id');
            if ($this->Application->save($this->request->data, true, array('user_id', 'email_address'))) {
                $this->Session->setFlash(__('The application has been created'), 'alerts/flash_success');
                $this->redirect(array('controller' => 'applications', 'action' => 'applicant_edit', $this->Application->id));
            } else {
                $this->Session->setFlash(__('The application could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        }

        $this->set('notifications', $this->User->Notification->find('all', array(
            'conditions' => array('Notification.user_id' => $this->Auth->User('id')), 'order' => 'Notification.created DESC'
            )));
        $this->set('messages', $this->Message->find('list', array('fields' => array('name', 'style'))));
        $this->set('saes', $this->Sae->find('all', array(
            'limit' => 5,
            'conditions' => array('Sae.user_id' => $this->Auth->User('id')), 'order' => 'Sae.created DESC'
            )));
    }

    public function manager_dashboard() {
        $applications = $this->User->Application->find('all', array(
            'limit' => 5,
            'fields' => array('Application.id','Application.created', 'Application.study_drug', 'Application.submitted', 'Application.protocol_no'),
            'order' => array('Application.created' => 'desc'),
            'conditions' => array('submitted' => 1),
            'contain' => array(),
        ));
        $this->set('applications', $applications);
        $this->User->Notification->recursive = -1;
        $this->set('notifications', $this->User->Notification->find('all', array(
            'conditions' => array('Notification.user_id' => $this->Auth->User('id')), 'order' => 'Notification.created DESC'
        )));
        $this->set('messages', $this->Message->find('list', array('fields' => array('name', 'style'))));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.group_id' => 3, 'User.is_active' => 1))));
        $this->set('saes', $this->Sae->find('all', array(
            'order' => 'Sae.created DESC'
            )));
    }

    public function inspector_dashboard() {
        $applications = $this->User->Application->find('all', array(
            'limit' => 5,
            'fields' => array('Application.id','Application.created', 'Application.study_drug', 'Application.submitted'),
            'order' => array('Application.created' => 'desc'),
            'conditions' => array('submitted' => 1),
            'contain' => array(),
        ));
        $this->set('applications', $applications);
        $this->User->Notification->recursive = -1;
        $this->set('notifications', $this->User->Notification->find('all', array(
            'conditions' => array('Notification.user_id' => $this->Auth->User('id')), 'order' => 'Notification.created DESC'
        )));
        $this->set('messages', $this->Message->find('list', array('fields' => array('name', 'style'))));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.group_id' => 3, 'User.is_active' => 1))));
        $this->set('saes', $this->Sae->find('all', array(
            'order' => 'Sae.created DESC'
            )));
    }

    public function reviewer_dashboard() {
        // $this->User->Application->recursive = -1;
        $my_applications = $this->User->Review->find('list', array(
            'conditions' => array('Review.user_id' => $this->Auth->User('id'), 'Review.type' => 'request', 'ifnull(Review.accepted,-1)' => array('accepted', '-1')),
            'fields' => array('Review.application_id'),
            'contain' => array()));
        // pr($my_applications);
        $this->set('applications', $this->User->Application->find('all', array(
            'limit' => 5, 'fields' => array('id','study_drug', 'created'),
            'order' => array('Application.created' => 'desc'),
            'conditions' => array('submitted' => 1, 'Application.id' => array_values($my_applications)),
            'contain' => array('Review'),
        )));

        $this->set('notifications', $this->User->Notification->find('all', array(
            'conditions' => array('Notification.user_id' => $this->Auth->User('id')), 'order' => 'Notification.created DESC'
            )));
        $this->set('messages', $this->Message->find('list', array('fields' => array('name', 'style'))));
    }

    public function partner_dashboard() {
        $applications = $this->Application->find('all', array(
            'limit' => 10,
            'fields' => array('Application.id','Application.user_id', 'Application.created', 'Application.protocol_no', 'Application.submitted'),
            'order' => array('Application.created' => 'desc'),
            'contain' => array(),
            'conditions' => array('Application.user_id' => $this->Auth->User('id')),
        ));
        $this->set('applications', $applications);

        $this->set('messages', $this->Message->find('list', array('fields' => array('name', 'style'))));
        if ($this->request->is('post')) {
            $this->Application->create();
            $this->request->data['Application']['user_id'] = $this->Auth->User('id');
            $fieldList = array('user_id');
            if (isset($this->request->data['Application']['email_address'])) $fieldList[] = 'email_address';
            if (isset($this->request->data['Application']['protocol_no'])) $fieldList[] = 'protocol_no';
            if ($this->Application->save($this->request->data, true, $fieldList)) {
                $this->Session->setFlash(__('The application has been created'), 'alerts/flash_success');
                $this->redirect(array('controller' => 'applications', 'action' => 'partner_edit', $this->Application->id));
            } else {
                $this->Session->setFlash(__('The application could not be saved. Please, try again.'), 'alerts/flash_error');
                // $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
        }
    }

    public function admin_dashboard() {
        $this->request->data['Feedback']['user_id'] = $this->Auth->User('id');
        $this->User->Feedback->recursive = -1;
        $this->set('previous_messages' , $this->User->Feedback->find('all', array('limit' => 3, 'order' => array('id' => 'desc'))));
    }

    public function login() {
         if ($this->Session->read('Auth.User')) {
            $this->Session->setFlash('You are logged in!', 'alerts/flash_success');
            $this->redirect('/', null, false);
        }
        if ($this->request->is('post')) {

            if (Validation::email($this->request->data['User']['username'])) {                
                $this->Auth->authenticate = array(
                    'Form' => ['fields' => ['username' => 'email']]
                );
                $this->Auth->constructAuthenticate();
                $this->request->data['User']['email'] = $this->request->data['User']['username'];
                unset($this->request->data['User']['username']);
            }

            if ($this->Auth->login()) {

                if($this->Auth->User('is_active') == 0) {
                    $this->Session->setFlash('Your account is not activated! If you have just registered, please click the activation link
                        sent to your email. Remember to check you spam folder too!', 'alerts/flash_error');
                    $this->redirect($this->Auth->logout());
                } elseif ($this->Auth->User('deactivated') == 1) {
                    $this->Session->setFlash('Your account has been deactivated! Please contact PPB.', 'alerts/flash_error');
                    $this->redirect($this->Auth->logout());
                }

                 
                // $this->redirect($this->Auth->redirect());
                // if(strlen($this->Auth->redirect()) > 12) {
                //     return $this->redirect($this->Auth->redirect());           
                // }
                if($this->Auth->User('group_id') == '1') $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
                if($this->Auth->User('group_id') == '2') $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'manager' => true));
                if($this->Auth->User('group_id') == '3') $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'reviewer' => true));
                if($this->Auth->User('group_id') == '4') $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'partner' => true));
                if($this->Auth->User('group_id') == '5') $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'applicant' => 'applicant'));
                if($this->Auth->User('group_id') == '6') $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'inspector' => true));
            } else {
                $this->Session->setFlash('Your username or password was incorrect.', 'alerts/flash_error');
            }
        }
        // App::uses('String', 'Utility');
        // // CakeResque::enqueue('default', 'FriendShell', array('findNewFriend', 'wa gwan'));
        // pr(String::insert('<strong>My name is :name and I am :age years old.</strong>', array('name' => 'Bob', 'age' => '65')));
// generates: "My name is Bob and I am 65 years old."

    }

    public function logout() {
        $this->Session->setFlash('Good-Bye', 'alerts/flash_success');
        $this->redirect($this->Auth->logout());
    }

/**
 * index method
 *
 * @return void
 */
    /*public function admin_index() {
        // $this->paginate['conditions'] = array('user_id' => $this->Auth->User('id'));
        $this->paginate['limit'] = 10;
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }*/

    public function admin_index() {
        $this->Prg->commonProcess();
        $page_options = array('10' => '10', '20' => '20');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

            $criteria = $this->User->parseCriteria($this->passedArgs);
            // $criteria['User.deactivated'] = 0;
        $this->paginate['conditions'] = $criteria;

        $this->paginate['order'] = array('User.created' => 'desc');
        // $this->User->recursive = -1;
        $this->paginate['contain'] = array('Group', 'County', 'Country');


        //in case of csv export
        if (isset($this->request->params['ext']) && $this->request->params['ext'] == 'csv') {

              $this->csv_export($this->User->find('all', 
                      array('conditions' => $this->paginate['conditions'], 'order' => $this->paginate['order'], 'contain' => $this->paginate['contain'])
                  ));
        }
        //end csv export

            $this->set('page_options', $page_options);
            $this->set('users', $this->paginate());

    }
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->find('first', array('conditions' => array('User.id' => $id),
            'contain' => array('Group', 'County', 'Country'))));
    }

/**
 * add method
 *
 * @return void
 */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'), 'alerts/flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));        
        $counties = $this->User->County->find('list', array('order' => 'County.county_name ASC'));
        $this->set(compact('counties'));
        $countries = $this->User->Country->find('list', array('order' => 'Country.name ASC'));
        $this->set(compact('countries'));
    }

/**
 * register method
 *
 * @return void
 */
    public function register() {

        if ($this->request->is('post')) {
            $this->User->create();
            $this->request->data['User']['group_id'] = 5;
            $this->request->data['User']['emailed'] = 1;
            $this->request->data['User']['activation_key'] = $this->Auth->password($this->request->data['User']['email']);
            $this->User->Behaviors->attach('Tools.Captcha');
            if (empty($this->data['User']['bot_stop']) && $this->User->save($this->request->data)) {
                $id = $this->User->id;
                $this->request->data['User'] = array_merge($this->request->data['User'], array('id' => $id));
                /*// $this->Auth->login($this->request->data['User']); // Login user automatically
                // Create object of Gearman client
                    $client = new GearmanClient();
                    // Add Gearman server
                    $client->addServer("127.0.0.1", 4730);
                    // Process job through worker
                    $this->request->data['function'] = 'registrationEmail';
                    $client->doBackground('sendnotification', serialize($this->request->data));*/
                    CakeResque::enqueue('default', 'NotificationShell', array('registrationEmail', $this->request->data));

                $this->Session->setFlash(__('You have successfully registered. Please click on the link sent to your email address to
                    activate your account. <small><span class="label label-info">Note</span> Check your spam folder if you
                    don\'t see it in your inbox.</small>'), 'alerts/flash_success');
                $this->redirect('/');
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        }
        $counties = $this->User->County->find('list', array('order' => 'County.county_name ASC'));
        $this->set(compact('counties'));
        $countries = $this->User->Country->find('list', array('order' => 'Country.name ASC'));
        $this->set(compact('countries'));
    }

    public function activate_account($activation_key = null) {
        if($activation_key) {
            $user = $this->User->find('first', array('conditions' => array('activation_key' => $activation_key), 'contain' => array()));
            if($user) {
                $this->User->create();
                $data['User'] = array('id' => $user['User']['id'], 'is_active' => 1, 'activation_key' => '');
                if($this->User->save($data, true, array('id', 'is_active', 'activation_key'))) {
                    $this->Session->setFlash(__('You have successfully activated your account. Please login to continue.'),
                        'alerts/flash_success');
                    $this->redirect(array('action' => 'login'));
                } else {
                    $this->Session->setFlash(__('Unable to activate account.'), 'alerts/flash_error');
                    $this->redirect('/');
                }
            } else {
                $this->Session->setFlash(__('Invalid activation token.'), 'alerts/flash_error');
                $this->redirect('/');
            }
        } else {
            $this->Session->setFlash(__('Invalid activation token.'), 'alerts/flash_error');
            $this->redirect('/');
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function profile() {
        if ($this->request->is('post')  || $this->request->is('put')) {
            $this->request->data['User']['id'] = $this->Session->read('Auth.User.id');
            $this->User->create();
            if ($this->User->save($this->request->data, true, array('old_password', 'password', 'confirm_password'))) {
                $this->Session->setFlash(__('The password has been changed'), 'alerts/flash_success');
                $this->redirect(array('action' => 'profile'));
            } else {
                $this->Session->setFlash(__('The password could not be changed.'), 'alerts/flash_error');
                // pr($this->request->data);
            }
        }
        $this->set('user', $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->User('id')), 'contain' => array())));
        $this->User->Country->recursive = -1;
        $this->set('country', $this->User->Country->findById($this->Auth->user('country_id'), array('name')));
        $this->User->County->recursive = -1;
        $this->set('county', $this->User->County->findById($this->Auth->user('county_id'), array('county_name')));
    }

    public function edit() {
        if ($this->request->is('post') || $this->request->is('put')) {
            $fieldlist = array('name', 'email', 'phone_no', 'name_of_institution', 'institution_physical', 'institution_address',
                'institution_contact', 'county_id', 'country_id', 'sponsor_email', 'qualification');
            if ($this->User->save($this->request->data, true, $fieldlist)) {
                $this->Session->setFlash(__('Your registration details have been updated.'), 'alerts/flash_success');
                $this->redirect(array('action' => 'profile'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        } else {
            // $this->request->data = $this->User->read(null, $id);
            $this->request->data = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->User('id')),
                'contain' => array()));
        }
        $counties = $this->User->County->find('list', array('order' => 'County.county_name ASC'));
        $this->set(compact('counties'));
        $countries = $this->User->Country->find('list', array('order' => 'Country.name ASC'));
        $this->set(compact('countries'));
    }

    public function admin_edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash(__('User does not exist!'), 'alerts/flash_error');
            $this->redirect($this->referer());
        }
        $fieldlist = array('name', 'email', 'phone_no', 'name_of_institution', 'institution_physical', 'institution_address',
                'institution_contact', 'county_id', 'country_id', 'group_id', 'is_active');
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Your registration details have been updated.'), 'alerts/flash_success');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'alerts/flash_error');
            }
        } else {
            // $this->request->data = $this->User->read(null, $id);
            $fieldlist[] = 'id'; $fieldlist[] = 'group_id'; $fieldlist[] = 'username';
            $this->request->data = $this->User->find('first', array('conditions' => array('User.id' => $id), 'fields' => $fieldlist,
                'contain' => array('County', 'Country')));
        }
        $counties = $this->User->County->find('list', array('order' => 'County.county_name ASC'));
        $this->set(compact('counties'));
        $countries = $this->User->Country->find('list', array('order' => 'Country.name ASC'));
        $this->set(compact('countries'));
        $this->set('groups', $this->User->Group->find('list'));
    }

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_delete($id = null, $activate = true) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash(__('User does not exist!'), 'alerts/flash_error');
            $this->redirect($this->referer());
        }

        if ($this->User->saveField('deactivated', $activate)) {
            if($activate) $this->Session->setFlash(__('The User has been successfully Deactivated.'), 'alerts/flash_success');
            if(!$activate) $this->Session->setFlash(__('The User has been successfully Activated.'), 'alerts/flash_success');
        }

        $this->redirect($this->referer());
    }

    public function admin_approve($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash(__('User does not exist!'), 'alerts/flash_error');
            $this->redirect($this->referer());
        }

        $data['User'] = array('id' => $id, 'is_active' => 1, 'activation_key' => '');
        if($this->User->save($data, true, array('id', 'is_active', 'activation_key'))) {
            $this->Session->setFlash(__('You have successfully activated this account. The user can now login to continue.'),
                'alerts/flash_success');
            $this->redirect($this->referer());
        } else {
            $this->Session->setFlash(__('Unable to activate the account.'), 'alerts/flash_error');
            $this->redirect($this->referer());
        }

        $this->redirect($this->referer());
    }

    private function csv_export($cusers = ''){
        //todo: check if data exists in $users
        $_serialize = 'cusers';
        $_header = array('Id', 'Username', 'Name', 'Phone No', 'Email', 'Sponsor\'s Email' , 'Qualification', 'Role', 'Name of institution',
            'Physical Address', 'Institution Address', 'Institution Contact', 'County', 'Country', 
            'Created',
            );
        $_extract = array('User.id', 'User.username', 'User.name', 'User.phone_no', 'User.email', 'User.sponsor_email', 'User.qualification',
            'Group.name', 'User.name_of_institution', 'User.institution_physical', 'User.institution_address', 'User.institution_contact', 
            'County.county_name', 'Country.name', 
            'User.created');

        $this->response->download('users_'.date('Ymd_Hi').'.csv'); // <= setting the file name
        $this->viewClass = 'CsvView.Csv';
        $this->set(compact('cusers', '_serialize', '_header', '_extract'));
    }

    public function initDB() {
        $group = $this->User->Group;
        //Allow admins to everything
        $group->id = 1;
        $this->Acl->allow($group, 'controllers');

        //Allow Managers
        $group->id = 2;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Applications/manager_index');
        $this->Acl->allow($group, 'controllers/Applications/manager_view');
        $this->Acl->allow($group, 'controllers/Applications/manager_view_notification');
        $this->Acl->allow($group, 'controllers/Applications/manager_approve');
        $this->Acl->allow($group, 'controllers/Applications/manager_delete');
        $this->Acl->allow($group, 'controllers/Applications/manager_deactivate');
        $this->Acl->allow($group, 'controllers/Applications/stages');
        $this->Acl->allow($group, 'controllers/Attachments/manager_download');
        $this->Acl->allow($group, 'controllers/Attachments/download');
        $this->Acl->allow($group, 'controllers/Notifications');
        $this->Acl->allow($group, 'controllers/Notifications/manager_resend');
        $this->Acl->allow($group, 'controllers/Reviews/manager_add');
        $this->Acl->allow($group, 'controllers/Reviews/manager_comment');
        $this->Acl->allow($group, 'controllers/Reviews/manager_assign');
        $this->Acl->allow($group, 'controllers/Reviews/manager_assess');
        $this->Acl->allow($group, 'controllers/Reviews/manager_summary');
        $this->Acl->allow($group, 'controllers/Reviews/manager_download_assessment');
        $this->Acl->allow($group, 'controllers/Reviews/manager_download_summary');
        $this->Acl->allow($group, 'controllers/Users/manager_dashboard');
        $this->Acl->allow($group, 'controllers/Users/profile');
        $this->Acl->allow($group, 'controllers/Users/edit');
        $this->Acl->allow($group, 'controllers/SiteInspections');
        $this->Acl->allow($group, 'controllers/Comments');
        $this->Acl->allow($group, 'controllers/Saes');
        $this->Acl->allow($group, 'controllers/Reports');
        $this->Acl->allow($group, 'controllers/AnnualLetters/manager_approve');
        $this->Acl->allow($group, 'controllers/AnnualLetters/manager_view');
        $this->Acl->allow($group, 'controllers/Deviations/manager_index');
        $this->Acl->allow($group, 'controllers/Deviations/manager_unsubmit');
        $this->Acl->allow($group, 'controllers/Deviations/manager_download_deviation');

        //Allow Inpectors
        $group->id = 6;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Applications/inspector_index');
        $this->Acl->allow($group, 'controllers/Applications/inspector_view');
        $this->Acl->allow($group, 'controllers/Applications/inspector_view_notification');
        $this->Acl->allow($group, 'controllers/Applications/stages');
        $this->Acl->allow($group, 'controllers/Attachments/inspector_download');
        $this->Acl->allow($group, 'controllers/Attachments/download');
        $this->Acl->allow($group, 'controllers/Notifications');
        $this->Acl->allow($group, 'controllers/Users/inspector_dashboard');
        $this->Acl->allow($group, 'controllers/Users/profile');
        $this->Acl->allow($group, 'controllers/Users/edit');
        $this->Acl->allow($group, 'controllers/SiteInspections');
        $this->Acl->allow($group, 'controllers/Comments');
        $this->Acl->allow($group, 'controllers/Saes');
        $this->Acl->allow($group, 'controllers/Reports');

        //Allow Reviewers
        $group->id = 3;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Applications/reviewer_index');
        $this->Acl->allow($group, 'controllers/Applications/reviewer_view');
        $this->Acl->allow($group, 'controllers/Applications/stages');
        $this->Acl->allow($group, 'controllers/Attachments/reviewer_download');
        $this->Acl->allow($group, 'controllers/Attachments/download');
        $this->Acl->allow($group, 'controllers/Notifications');
        $this->Acl->allow($group, 'controllers/Reviews/reviewer_add');
        $this->Acl->allow($group, 'controllers/Reviews/reviewer_respond');
        $this->Acl->allow($group, 'controllers/Reviews/reviewer_assess');
        $this->Acl->allow($group, 'controllers/Reviews/reviewer_summary');
        $this->Acl->allow($group, 'controllers/Reviews/reviewer_download_assessment');
        $this->Acl->allow($group, 'controllers/Reviews/reviewer_download_summary');
        $this->Acl->allow($group, 'controllers/Users/reviewer_dashboard');
        $this->Acl->allow($group, 'controllers/Users/profile');
        $this->Acl->allow($group, 'controllers/Users/edit');
        $this->Acl->allow($group, 'controllers/Comments');

        //Allow Partners
        $group->id = 4;
        $this->Acl->deny($group, 'controllers');
        // $this->Acl->allow($group, 'controllers/Applications/partner_add');
        $this->Acl->allow($group, 'controllers/Applications/partner_index');
        $this->Acl->allow($group, 'controllers/Applications/partner_edit');
        $this->Acl->allow($group, 'controllers/Applications/stages');
        $this->Acl->allow($group, 'controllers/Notifications');
        $this->Acl->allow($group, 'controllers/Users/partner_dashboard');
        $this->Acl->allow($group, 'controllers/Users/profile');
        $this->Acl->allow($group, 'controllers/Users/edit');

        //Allow applicants
        $group->id = 5;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Amendments/applicant_index');
        $this->Acl->allow($group, 'controllers/Amendments/applicant_add');
        $this->Acl->allow($group, 'controllers/Amendments/applicant_edit');
        $this->Acl->allow($group, 'controllers/Amendments/applicant_delete');
        $this->Acl->allow($group, 'controllers/Applications/applicant_index');
        // $this->Acl->allow($group, 'controllers/Applications/applicant_add');  //why?
        $this->Acl->allow($group, 'controllers/Applications/applicant_view');
        $this->Acl->allow($group, 'controllers/Applications/applicant_edit');
        $this->Acl->allow($group, 'controllers/Applications/applicant_delete');
        $this->Acl->allow($group, 'controllers/Applications/applicant_final_report');
        $this->Acl->allow($group, 'controllers/Applications/stages');
        $this->Acl->allow($group, 'controllers/Attachments/applicant_download');
        $this->Acl->allow($group, 'controllers/Attachments/download');
        $this->Acl->allow($group, 'controllers/Attachments/delete');
        $this->Acl->allow($group, 'controllers/InvestigatorContacts/delete');
        $this->Acl->allow($group, 'controllers/Notifications');
        $this->Acl->allow($group, 'controllers/Organizations/delete');
        $this->Acl->allow($group, 'controllers/PreviousDates/delete');
        $this->Acl->allow($group, 'controllers/StudyRoutes/delete');
        $this->Acl->allow($group, 'controllers/Manufacturers/delete');
        $this->Acl->allow($group, 'controllers/Placebos/delete');
        $this->Acl->allow($group, 'controllers/SiteDetails/delete');
        $this->Acl->allow($group, 'controllers/Sponsors/delete');
        $this->Acl->allow($group, 'controllers/Users/applicant_dashboard');
        $this->Acl->allow($group, 'controllers/Users/profile');
        $this->Acl->allow($group, 'controllers/Users/edit');
        $this->Acl->allow($group, 'controllers/SiteInspections/applicant_download_summary');
        $this->Acl->allow($group, 'controllers/SiteInspections/applicant_index');
        $this->Acl->allow($group, 'controllers/Comments/applicant_add_si_external');
        $this->Acl->allow($group, 'controllers/Comments/applicant_add_dev_external');
        $this->Acl->allow($group, 'controllers/Comments/applicant_add_sae_external');
        $this->Acl->allow($group, 'controllers/Saes/applicant_add');
        $this->Acl->allow($group, 'controllers/Saes/applicant_edit');
        $this->Acl->allow($group, 'controllers/Saes/applicant_index');
        $this->Acl->allow($group, 'controllers/Saes/applicant_view');
        $this->Acl->allow($group, 'controllers/Saes/applicant_delete');
        $this->Acl->allow($group, 'controllers/Saes/applicant_followup');
        $this->Acl->allow($group, 'controllers/ParticipantFlows/applicant_add');
        $this->Acl->allow($group, 'controllers/Budgets/applicant_add');
        $this->Acl->allow($group, 'controllers/EthicalCommittees/applicant_add');
        $this->Acl->allow($group, 'controllers/Manufacturers/applicant_add');
        $this->Acl->allow($group, 'controllers/AnnualLetters/applicant_view');
        $this->Acl->allow($group, 'controllers/Deviations/applicant_add');
        $this->Acl->allow($group, 'controllers/Deviations/applicant_download_deviation');
        $this->Acl->allow($group, 'controllers/Deviations/applicant_index');
        $this->Acl->allow($group, 'controllers/Deviations/applicant_edit');
        $this->Acl->allow($group, 'controllers/Reviews/manager_download_summary');
        $this->Acl->allow($group, 'controllers/Comments');

        //we add an exit to avoid an ugly "missing views" error message
        echo "all done";
        exit;
    }
}
