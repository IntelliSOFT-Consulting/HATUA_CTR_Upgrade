<?php
App::uses('AppModel', 'Model');
/**
 * AnnualLetter Model
 *
 * @property Application $Application
 */
class AnnualLetter extends AppModel {

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
		)
	);

	public $hasMany = array(
         
        'InternalComment' => array(
            'className' => 'Comment',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('InternalComment.model' => 'AnnualLetter', 'InternalComment.category' => 'annual' ),
        ),
        'ExternalComment' => array(
            'className' => 'Comment',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('ExternalComment.model' => 'AnnualLetter', 'ExternalComment.category' => 'annual' ),
        ),
    );

	public function beforeSave() {
		if (!empty($this->data['AnnualLetter']['approval_date'])) {
			$this->data['AnnualLetter']['approval_date'] = $this->dateFormatBeforeSave($this->data['AnnualLetter']['approval_date']);
		}
		if (!empty($this->data['AnnualLetter']['expiry_date'])) {
			$this->data['AnnualLetter']['expiry_date'] = $this->dateFormatBeforeSave($this->data['AnnualLetter']['expiry_date']);
		}
		return true;
	}


	function afterFind($results) {
		foreach ($results as $key => $val) {
			if (isset($val['AnnualLetter']['approval_date'])) {
				$results[$key]['AnnualLetter']['approval_date'] = $this->dateFormatAfterFind($val['AnnualLetter']['approval_date']);
			}
		}
		foreach ($results as $key => $val) {
			if (isset($val['AnnualLetter']['expiry_date'])) {
				$results[$key]['AnnualLetter']['expiry_date'] = $this->dateFormatAfterFind($val['AnnualLetter']['expiry_date']);
			}
		}
		return $results;
	}
}
