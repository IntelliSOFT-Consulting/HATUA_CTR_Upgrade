<?php
App::uses('AppModel', 'Model');
/**
 * Pharmacist Model
 *
 * @property Application $Application
 */
class Pharmacist extends AppModel {


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
        'reg_no' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Pharmacist: Please enter the registration number of the pharmacist!'
            ),
        ),
        'given_name' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Pharmacist: Please enter the name of the pharmacist!'
            ),
        ),
        'valid_year' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Pharmacist: Please enter the valid year for the pharmacist!'
            ),
        ),
        'qualification' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Pharmacist: Please enter the qualification of the pharmacist!'
            ),
        ),
        'professional_address' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Pharmacist: Please enter the physical address of the pharmacist!'
            ),
        ),
        'email' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Pharmacist: Please enter the email of the pharmacist!'
            ),
        ),
      );
}
