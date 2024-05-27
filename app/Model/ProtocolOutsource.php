<?php
App::uses('AppModel', 'Model');
/**
 * ProtocolOutsource Model
 *
 * @property User $User
 * @property Application $Application
 * @property Amendment $Amendment
 * @property Owner $Owner
 */
class ProtocolOutsource extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
		),
		'Amendment' => array(
			'className' => 'Amendment',
			'foreignKey' => 'amendment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		 
	);
}
