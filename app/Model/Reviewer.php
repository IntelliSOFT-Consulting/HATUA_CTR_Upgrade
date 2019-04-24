<?php
App::uses('AppModel', 'Model');
/**
 * Reviewer Model
 *
 * @property User $User
 * @property Application $Application
 * @property Review $Review
 */
class Reviewer extends AppModel {
	public $actsAs = array('Containable');

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		// 'User' => array(
		// 	'className' => 'User',
		// 	'foreignKey' => 'user_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
		// 'Application' => array(
		// 	'className' => 'Application',
		// 	'foreignKey' => 'application_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// )
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Review' => array(
			'className' => 'Review',
			'foreignKey' => 'reviewer_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);

	public $validate = array(
	   'accepted' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => false,
                'message'  => 'Please state if there is any conflict of interest!'
            ),
         ),
	);

}
