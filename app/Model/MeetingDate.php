<?php
App::uses('AppModel', 'Model');
/**
 * MeetingDate Model
 *
 * @property User $User
 */
class MeetingDate extends AppModel {

    public $actsAs = array('Containable', 'Search.Searchable');
    public $filterArgs = array(
            'email' => array('type' => 'like', 'encode' => true),
            'range' => array('type' => 'expression', 'method' => 'makeRangeCondition', 'field' => 'MeetingDate.proposed_date1 BETWEEN ? AND ?'),
        );
    public function makeRangeCondition($data = array()) {
            if(!empty($data['start_date'])) $start_date = date('Y-m-d', strtotime($data['start_date']));
            else $start_date = date('Y-m-d', strtotime('2012-05-01'));

            if(!empty($data['end_date'])) $end_date = date('Y-m-d', strtotime($data['end_date']));
            else $end_date = date('Y-m-d');

            return array($start_date, $end_date);
        }
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('Comment.model' => 'MeetingDate', 'Comment.category' => 'external' ),
        ),
    );

	public function beforeSave() {
        if (!empty($this->data['MeetingDate']['proposed_date1'])) {
            $this->data['MeetingDate']['proposed_date1'] = $this->dateTimeFormatBeforeSave($this->data['MeetingDate']['proposed_date1']);
        }
        if (!empty($this->data['MeetingDate']['proposed_date2'])) {
            $this->data['MeetingDate']['proposed_date2'] = $this->dateTimeFormatBeforeSave($this->data['MeetingDate']['proposed_date2']);
        }
        return true;
    }

    function afterFind($results) {
        foreach ($results as $key => $val) {
            if (isset($val['MeetingDate']['proposed_date1'])) {
                $results[$key]['MeetingDate']['proposed_date1'] = $this->dateTimeFormatAfterFind($val['MeetingDate']['proposed_date1']);
            }
            if (isset($val['MeetingDate']['proposed_date2'])) {
                $results[$key]['MeetingDate']['proposed_date2'] = $this->dateTimeFormatAfterFind($val['MeetingDate']['proposed_date2']);
            }
        }
        return $results;
    }
}
