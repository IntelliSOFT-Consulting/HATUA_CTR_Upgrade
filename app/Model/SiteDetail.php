<?php
App::uses('AppModel', 'Model');
/**
 * SiteDetail Model
 *
 * @property Application $Application
 */
class SiteDetail extends AppModel {


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
		),
		'County' => array(
			'className' => 'County',
			'foreignKey' => 'county_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $validate = array(
		// 'site_name' => array(
            // 'ifMultipleSites' => array(
                // 'rule'     => array('ifMultipleSites'),
                // 'required' => true,
                // 'message'  => 'Please enter the name of the site expected in Kenya'
            // ),
        // ),
        'site_name' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Sites : Please enter the name of the site expected in Kenya'
            ),
        ),
		'physical_address' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Sites : Please enter the physical address of the site expected in Kenya'
            ),
        ),
		'contact_details' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Sites : Please enter the contact details at the site.'
            ),
        ),
		'contact_person' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Sites : Please enter the contact person.'
            ),
        ),
		'county_id' => array(
            'notEmpty' => array(
                'rule'     => 'numeric',
                'required' => true,
                'message'  => 'Sites : Please select the county.'
            ),
        ),
		// 'site_capacity' => array(
            // 'notEmpty' => array(
                // 'rule'     => 'notEmpty',
                // 'required' => true,
                // 'message'  => 'Please enter the capacity of the site.'
            // ),
        // ),
	);

	// UTILITY METHODS
	public function isOwnedBy($sdetail, $user) {
		$application = $this->field('application_id', array('id' => $sdetail));
		return $this->Application->field('id', array('id' => $application, 'user_id' => $user)) === $application;
	}
}
