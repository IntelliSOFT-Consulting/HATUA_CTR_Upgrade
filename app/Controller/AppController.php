<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
  protected $a_contain = array('Amendment','Outsource'=>array('User'), 'EthicalCommittee', 'InvestigatorContact', 'Pharmacist', 'Sponsor', 'SiteDetail'  => array('County'), 'Organization', 'Placebo',
                'Attachment', 'CoverLetter', 'Protocol', 'PatientLeaflet', 'Brochure', 'GmpCertificate', 'Cv', 'Finance', 'Declaration',
                'IndemnityCover', 'OpinionLetter', 'ApprovalLetter', 'Statement', 'ParticipatingStudy', 'Addendum', 'Registration', 'Fee', 'Checklist',
                'AnnualApproval','AmendmentApproval' => array('Attachment'),'AmendmentChecklist','AmendmentLetter', 'ParticipantFlow', 'Budget', 'Document', 'ActiveInspector',
                'Review'  => array('InternalComment' => array('Attachment'), 'ExternalComment' => array('Attachment'), 'ReviewAnswer', 'User'), 
                'Sae','AmendmentLetter', 'AnnualLetter' => array('InternalComment' => array('Attachment'), 'ExternalComment' => array('Attachment')), 'StudyRoute', 'Manufacturer', 'Ciom',
                'Deviation' => array('ExternalComment' => array('Attachment')),
                'SiteInspection' => array('SiteAnswer', 'Attachment', 'InternalComment' => array('Attachment'), 'ExternalComment' => array('Attachment'), 'User'),
                'ApplicationStage' => array('Comment' => array('Attachment'))
    );
  public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            ),
            // 'authenticate' => array(
            //   'Form' => array(
            //       'fields' => array('username' => 'email')
            //   )
          	// )
        ),
        'RequestHandler' => array(
      'viewClassMap' => array('csv' => 'CsvView.Csv')
    ),
        'Session',
        'DebugKit.Toolbar' => array('panels' => array('DebugKit.history'))
    );
    public $helpers = array('Html', 'Form', 'Session', 'Text');

    public function beforeFilter() {
      $this->Auth->allow('display');
          //Configure AuthComponent
        // $this->set( 'domain', 'tools' );
      $redir = '';
      if($this->Auth->User('group_id') == '1')  $redir = 'admin';
      if($this->Auth->User('group_id') == '2')  $redir = 'manager';
      if($this->Auth->User('group_id') == '3')  $redir = 'reviewer';
      if($this->Auth->User('group_id') == '4')  $redir = 'partner';
      if($this->Auth->User('group_id') == '5')  $redir = 'applicant';
      if($this->Auth->User('group_id') == '6')  $redir = 'inspector';
      if($this->Auth->User('group_id') == '7')  $redir = 'monitor';

          $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => false);
          $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login', 'admin' => false);
          $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'dashboard', $redir => true);

      $this->Auth->authError = __('<div class="alert alert-error">
                      <button data-dismiss="alert" class="close">&times;</button>
                      <h4><strong>Sorry!</strong> You don\'t have sufficient permissions to access the location.</h4>
                     </div>', true);
      $this->Auth->loginError = __('<div class="alert alert-error">
                      <button data-dismiss="alert" class="close">&times;</button>
                      <h4>Invalid e-mail / password combination.  Please try again.</h4>
                     </div>', true);
      $this->set('redir', $redir);
           // $this->Auth->authenticate = array(
           //     'all' => array (
           //         'scope' => array('User.is_active' => 1)
           //     ),
           //     'Form'
           // );
    }

  // public function isAuthorized($user) {
    // if (empty($this->request->prefix)) {
      // return true;
    // }
    // Admin can access every action
    // if (isset($user['group_id']) && $user['group_id'] === '1') {
      // return true;
    // }
    // Allow actions with no parameters supplied
    // if (!empty($this->request->prefix) && !isset($this->request->params['pass'][0])) {
      // return true;
    // }
    // return false;
  // }
}
