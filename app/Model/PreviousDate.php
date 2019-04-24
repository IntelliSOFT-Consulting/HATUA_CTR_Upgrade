<?php
App::uses('AppModel', 'Model');
/**
 * PreviousDate Model
 *
 * @property Application $Application
 */
class PreviousDate extends AppModel {


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
		/*'Amendment' => array(
			'className' => 'Amendment',
			'foreignKey' => 'amendment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*/
	);

	// public $validate = array(
		// 'date_of_previous_protocol' => array(
			// 'rule' => 'notEmpty',
			// 'message' => 'Please enter a valid date',
		// ),
	// );

	public function beforeSave() {
		if (!empty($this->data['PreviousDate']['date_of_previous_protocol'])) {
			$this->data['PreviousDate']['date_of_previous_protocol'] = $this->dateFormatBeforeSave($this->data['PreviousDate']['date_of_previous_protocol']);
		}
		return true;
	}


	function afterFind($results) {
		foreach ($results as $key => $val) {
			if (isset($val['PreviousDate']['date_of_previous_protocol'])) {
				$results[$key]['PreviousDate']['date_of_previous_protocol'] = $this->dateFormatAfterFind($val['PreviousDate']['date_of_previous_protocol']);
			}
		}
		return $results;
	}

	// UTILITY METHODS
	public function isOwnedBy($pdate, $user) {
		$application = $this->field('application_id', array('id' => $pdate));
		return $this->Application->field('id', array('id' => $application, 'user_id' => $user)) === $application;
	}
}
