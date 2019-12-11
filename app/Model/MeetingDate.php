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
            'range' => array('type' => 'expression', 'method' => 'makeRangeCondition', 'field' => 'MeetingDate.proposed_date1 BETWEEN ? AND ? OR MeetingDate.proposed_date2 BETWEEN ? AND ?'),
        );
    public function makeRangeCondition($data = array()) {
            if(!empty($data['start_date'])) $start_date = date('Y-m-d 00:00:00', strtotime($data['start_date']));
            else $start_date = date('Y-m-d 00:00:00', strtotime('2012-05-01'));

            if(!empty($data['end_date'])) $end_date = date('Y-m-d 23:59:59', strtotime($data['end_date']));
            else $end_date = date('Y-m-d 23:59:59');

            return array($start_date, $end_date, $start_date, $end_date);
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

    public $validate = array(
        'proposed_date1' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please propose a valid first date and time (dd-mm-yyyy h24:mi)!'
            ),
        ),
        'proposed_date2' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please propose a valid alternative date and time (dd-mm-yyyy h24:mi)!'
            ),
        ),
        'email' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter a valid email address!'
            ),
        ),
        'disease_background' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter background information on the disease to be treated!'
            )
        ),
        'product_background' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter background information on the product!'
            )
        ),
        'quality_development' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter information on quality development!'
            )
        ),
        'non_clinical_development' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter information on Non-clinical development!'
            )
        ),
        'regulatory_status' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter information on regulatory status!'
            )
        ),
        'advice_rationale' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the rationale for seeking advice!'
            )
        ),
        'proposed_questions' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the proposed Questions and Applicant\'s positions!'
            )
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
