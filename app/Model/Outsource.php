<?php
App::uses('AppModel', 'Model');
/**
 * Outsource Model
 *
 * @property Application $Application
 * @property User $User
 * @property County $County
 * @property Country $Country 
 */
class Outsource extends AppModel
{

	public $actsAs = array('Containable', 'Search.Searchable');


	public $filterArgs = array(
		'filter' => array('type' => 'query', 'method' => 'orConditions', 'encode' => true),
	  );
	  public function orConditions($data = array())
	  {
		$filter = $data['filter'];
		$cond = array(
		  'OR' => array(
			$this->alias . '.email LIKE' => '%' . $filter . '%',
			$this->alias . '.name LIKE' => '%' . $filter . '%',
			$this->alias . '.username LIKE' => '%' . $filter . '%',
		  )
		);
		return $cond;
	  }
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule'     => 'notEmpty',
				'required' => true,
				'message'  => 'Please provide username'
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule'     => 'notEmpty',
				'required' => true,
				'message'  => 'Please provide name'
			),
		),
		'email' => array(
			'notEmpty' => array(
				'rule'     => 'notEmpty',
				'required' => true,
				'message'  => 'Please provide email address'
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please provide email address',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone_no' => array(
			'notEmpty' => array(
				'rule'     => 'notEmpty',
				'required' => true,
				'message'  => 'Please provide phone number'
			), 
		),
		'country_id' => array(
			'notEmpty' => array(
				'rule'     => 'notEmpty',
				'required' => true,
				'message'  => 'Please provide user country'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please provide user country',
				//'allowEmpty' => false,
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
		),
		'County' => array(
			'className' => 'County',
			'foreignKey' => 'county_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
