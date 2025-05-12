<?php
App::uses('AppModel', 'Model');
/**
 * AmendmentApproval Model
 *
 * @property Application $Application
 */
class AmendmentApproval extends AppModel {


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
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('Attachment.model' => 'AmendmentApproval'),
        )
    );

	public function beforeSave() {
		if (!empty($this->data['AmendmentApproval']['approval_date'])) {
			$this->data['AmendmentApproval']['approval_date'] = $this->dateFormatBeforeSave($this->data['AmendmentApproval']['approval_date']);
		} 
		return true;
	}


	function afterFind($results) {
		foreach ($results as $key => $val) {
			if (isset($val['AmendmentApproval']['approval_date'])) {
				$results[$key]['AmendmentApproval']['approval_date'] = $this->dateFormatAfterFind($val['AmendmentApproval']['approval_date']);
			}
		}
	 
		return $results;
	}
}
