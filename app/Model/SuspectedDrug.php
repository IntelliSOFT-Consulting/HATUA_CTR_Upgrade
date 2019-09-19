<?php
App::uses('AppModel', 'Model');
/**
 * SuspectedDrug Model
 *
 * @property Sae $Sae
 * @property Route $Route
 */
class SuspectedDrug extends AppModel {


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
/**
 * Validation rules
 *
 * @var array
 */

    public $validate = array(
	    'generic_name' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the generic name of the suspected drug!'
            ),
        ),
        'dose' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the dose of the suspected drug!'
            ),
        ),
        'route_id' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the administration route of the suspected drug!'
            ),
        ),
        'indication' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the indication for use for the suspected drug!'
            ),
        ),
        'reaction_abate' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please indicate if the reaction abated for the suspected drug!'
            ),
        ),
        'date_from' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the therapy date for the suspected drug!'
            ),
            'beforeStopDate' => array(
            	'rule' => 'beforeStopDate',
            	'message' => 'The therapy start date must be less than or equal to the the therapy stop date'
            )
        ),
        'reaction_reappear' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please indicate if the reaction reappeared for the suspected drug!'
            ),
        ),
	);

	public function beforeStopDate($field = null){
		if(!empty($this->data['SuspectedDrug']['date_from'])) {
			return (strtotime($field['date_from']) <= strtotime($this->data['SuspectedDrug']['date_to']));
		}
		return true;
    }
}
