<?php
App::uses('AppModel', 'Model');
/**
 * Sponsor Model
 *
 * @property Application $Application
 */
class Sponsor extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Application' => array(
			'className' => 'Application',
			'foreignKey' => 'application_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $validate = array(							
		'sponsor' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Sponsor : Please enter the name of the sponsor'
            ),
        ),
		// 'contact_person' => array(
            // 'notEmpty' => array(
                // 'rule'     => 'notEmpty',
                // 'required' => true,
                // 'message'  => 'Please enter the sponsor contact person'
            // ),
        // ),
		'address' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Sponsor : Please enter the sponsor address'
            ),
        ),
		'telephone_number' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Sponsor : Please enter the sponsor telephone number'
            ),
        ),
		'cell_number' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Sponsor : Please enter the sponsor mobile phone number'
            ),
        ),
		'email_address' => array(
            'notEmpty' => array(
                'rule'     => 'email',
                'required' => true,
                'message'  => 'Sponsor : Please enter the sponsor\'s email address'
            ),
        ),
	);	
	
	// UTILITY METHODS
	public function isOwnedBy($sponsor, $user) {
		$application = $this->field('application_id', array('id' => $sponsor));
		return $this->Application->field('id', array('id' => $application, 'user_id' => $user)) === $application;
	}
}
