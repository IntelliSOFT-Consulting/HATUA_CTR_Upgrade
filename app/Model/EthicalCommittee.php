<?php
App::uses('AppModel', 'Model');
/**
 * EthicalCommittee Model
 *
 * @property Application $Application
 */
class EthicalCommittee extends AppModel {


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

	public function beforeSave() {
		if (!empty($this->data['EthicalCommittee']['submission_date'])) {
			$this->data['EthicalCommittee']['submission_date'] = $this->dateFormatBeforeSave($this->data['EthicalCommittee']['submission_date']);
		}
		if (!empty($this->data['EthicalCommittee']['initial_approval'])) {
			$this->data['EthicalCommittee']['initial_approval'] = $this->dateFormatBeforeSave($this->data['EthicalCommittee']['initial_approval']);
		}
		return true;
	}


	function afterFind($results) {
		foreach ($results as $key => $val) {
			if (isset($val['EthicalCommittee']['submission_date'])) {
				$results[$key]['EthicalCommittee']['submission_date'] = $this->dateFormatAfterFind($val['EthicalCommittee']['submission_date']);
			}
			if (isset($val['EthicalCommittee']['initial_approval'])) {
				$results[$key]['EthicalCommittee']['initial_approval'] = $this->dateFormatAfterFind($val['EthicalCommittee']['initial_approval']);
			}
		}
		return $results;
	}
}
