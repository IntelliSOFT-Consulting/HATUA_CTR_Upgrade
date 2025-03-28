<?php
App::uses('AppModel', 'Model');
/**
 * AuditTrail Model
 *
 */
class AuditTrail extends AppModel {

	
	public $actsAs = array('Containable', 'Search.Searchable');
	public $filterArgs = array( 
		'filter' => array('type' => 'query', 'method' => 'orConditions', 'encode' => true),
		'start_date' => array('type' => 'query', 'method' => 'dummy'),
        'end_date' => array('type' => 'query', 'method' => 'dummy'),
    );

	public function orConditions($data = array())
	{
	  $filter = $data['filter'];
	  $cond = array(
		'OR' => array(
		  $this->alias . '.ip LIKE' => '%' . $filter . '%',
		  $this->alias . '.hostname LIKE' => '%' . $filter . '%', 
		)
	  );
	  return $cond;
	}
	public function dummy($data = array())
    {
        return array('1' => '1');
    }

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'model' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'message' => array(
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
}
