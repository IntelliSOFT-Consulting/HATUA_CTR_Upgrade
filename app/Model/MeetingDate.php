<?php
App::uses('AppModel', 'Model');
/**
 * MeetingDate Model
 *
 * @property User $User
 */
class MeetingDate extends AppModel {

	//public $actsAs = array('SoftDelete');

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

	public function beforeSave() {
        if (!empty($this->data['MeetingDate']['proposed_date1'])) {
            $this->data['MeetingDate']['proposed_date1'] = $this->dateFormatBeforeSave($this->data['MeetingDate']['proposed_date1']);
        }
        if (!empty($this->data['MeetingDate']['proposed_date2'])) {
            $this->data['MeetingDate']['proposed_date2'] = $this->dateFormatBeforeSave($this->data['MeetingDate']['proposed_date2']);
        }
        return true;
    }

}
