<?php
App::uses('AppModel', 'Model');
/**
 * Route Model
 *
 * @property ConcomittantDrug $ConcomittantDrug
 * @property SuspectedDrug $SuspectedDrug
 */
class Route extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ConcomittantDrug' => array(
			'className' => 'ConcomittantDrug',
			'foreignKey' => 'route_id',
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
		'SuspectedDrug' => array(
			'className' => 'SuspectedDrug',
			'foreignKey' => 'route_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
