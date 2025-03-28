<?php
App::uses('AppModel', 'Model');
/**
 * SaeDate Model
 *
 * @property Sae $Sae
 */
class SaeDate extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
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
		'Sae' => array(
			'className' => 'Sae',
			'foreignKey' => 'sae_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
