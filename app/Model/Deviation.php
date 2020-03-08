<?php
App::uses('AppModel', 'Model');
/**
 * Deviation Model
 *
 * @property Application $Application
 */
class Deviation extends AppModel {

	public $actsAs = array('Containable', 'Search.Searchable');
    public $filterArgs = array(
            'reference_no' => array('type' => 'like', 'encode' => true),
            'protocol_no' => array('type' => 'like', 'encode' => true),
            'range' => array('type' => 'expression', 'method' => 'makeRangeCondition', 'field' => 'Sae.created BETWEEN ? AND ?'),
        );
    public function makeRangeCondition($data = array()) {
            if(!empty($data['start_date'])) $start_date = date('Y-m-d', strtotime($data['start_date']));
            else $start_date = date('Y-m-d', strtotime('2012-05-01'));

            if(!empty($data['end_date'])) $end_date = date('Y-m-d', strtotime($data['end_date']));
            else $end_date = date('Y-m-d');

            return array($start_date, $end_date);
        }
        
/**
 * Validation rules
 *
 * @var array
 */


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
