<?php
App::uses('AppModel', 'Model');
/**
 * AnnualLetter Model
 *
 * @property Application $Application
 */
class AnnualLetter extends AppModel {

	public $actsAs = array('Containable', 'SoftDelete');
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
}
