<?php
App::uses('AppModel', 'Model');
/**
 * Deviation Model
 *
 * @property Application $Application
 */
class Deviation extends AppModel {

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
            'conditions' => array('Attachment.model' => 'SiteInspection', 'Attachment.group' => 'site_inspections'),
        ),
        'ExternalComment' => array(
            'className' => 'Comment',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('ExternalComment.model' => 'Deviation', 'ExternalComment.category' => 'external' ),
        ),
    );

	public function beforeSave() {
		if (!empty($this->data['Deviation']['deviation_date'])) {
			$this->data['Deviation']['deviation_date'] = $this->dateFormatBeforeSave($this->data['Deviation']['deviation_date']);
		}
		return true;
	}

	function afterFind($results) {
		foreach ($results as $key => $val) {
			if (isset($val['Deviation']['deviation_date'])) {
				$results[$key]['Deviation']['deviation_date'] = $this->dateFormatAfterFind($val['Deviation']['deviation_date']);
			}
		}
		return $results;
	}
}
