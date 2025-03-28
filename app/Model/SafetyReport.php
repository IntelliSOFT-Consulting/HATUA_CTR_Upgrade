<?php
App::uses('AppModel', 'Model');
/**
 * SafetyReport Model
 *
 * @property Application $Application
 * @property User $User
 */
class SafetyReport extends AppModel
{
 
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
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
			'conditions' => array('Attachment.model' => 'Safety', 'Attachment.group' => 'attachment'),
		)
	);
}
