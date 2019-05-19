<?php
App::uses('AppModel', 'Model');
/**
 * SuspectedDrug Model
 *
 * @property Sae $Sae
 * @property Route $Route
 */
class SuspectedDrug extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'deleted' => array(
			'boolean' => array(
				'rule' => array('boolean'),
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
		),
		'Route' => array(
			'className' => 'Route',
			'foreignKey' => 'route_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    public function beforeSave() {
        if (!empty($this->data['SuspectedDrug']['date_from'])) {
            $this->data['SuspectedDrug']['date_from'] = $this->dateFormatBeforeSave($this->data['SuspectedDrug']['date_from']);
        }
        if (!empty($this->data['SuspectedDrug']['date_to'])) {
            $this->data['SuspectedDrug']['date_to'] = $this->dateFormatBeforeSave($this->data['SuspectedDrug']['date_to']);
        }
        return true;
    }
}
