<?php
App::uses('AppModel', 'Model');
/**
 * OutsourceRequest Model
 *
 * @property User $User
 * @property Application $Application
 * @property Outsource $Outsource
 */
class OutsourceRequest extends AppModel {


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
		'Outsource' => array(
			'className' => 'Outsource',
			'foreignKey' => 'outsource_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(

		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'foreign_key',
			'dependent' => true,
			'conditions' => array('Attachment.model' => 'OutsourceRequest', 'Attachment.group' => 'attachment'),
		),
	);
}
