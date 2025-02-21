<?php
App::uses('AppModel', 'Model');
/**
 * Amend Model
 *
 * @property Amendment $Amendment
 * @property Application $Application
 */
class Amend extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'cover_letter' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'summary' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please provide a summary of the proposed amendments',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'reason' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please provide a reason for the amendment',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'objectives_impacts' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please provide the impact of the amendment on the original study objectives',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'endpoints_impacts' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please provide the impact of the amendments on the study endpoints and data generated',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'safety_impacts' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please provide the impact of the proposed amendments on the safety and wellbeing of study participants',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Amendment' => array(
			'className' => 'Amendment',
			'foreignKey' => 'amendment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Application' => array(
			'className' => 'Application',
			'foreignKey' => 'application_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
