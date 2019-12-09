<?php
App::uses('AppModel', 'Model');
/**
 * Sae Model
 *
 * @property Application $Application
 * @property User $User
 */
class Sae extends AppModel {

    public $actsAs = array('Containable', 'Search.Searchable', 'SoftDelete');
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
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country_id',
            'conditions' => '',
            'fields' => '',
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

/**
 * hasMany associations
 *
 * @var array
 */

    public $hasMany = array(
        'SuspectedDrug' => array(
            'className' => 'SuspectedDrug',
            'foreignKey' => 'sae_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),    
        'ConcomittantDrug' => array(
            'className' => 'ConcomittantDrug',
            'foreignKey' => 'sae_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ), 
        'SaeFollowup' => array(
            'className' => 'Sae',
            'foreignKey' => 'sae_id',
            'dependent' => true,
            'conditions' => array('SaeFollowup.report_type' => 'Followup'),
        ),
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('Attachment.model' => 'Sae', 'Attachment.group' => 'sae'),
        ),
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('Comment.model' => 'Sae', 'Comment.category' => 'external' ),
        ),
    );

    public $validate = array(
        'application_id' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select an approved protocol!'
            ),
        ),
        'country_id' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select a country!'
            ),
        ),
        'date_of_birth' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select a valid date of birth!'
            ),
        ),
        'reaction_onset' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select a valid reaction onset date!'
            ),
            'dateAfterStartDates' => array(
                'rule' => 'dateAfterStartDates',
                'message' => 'The reaction onset date must be after the date of drug administration'
            )
        ),
        'gender' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the gender!'
            ),
        ),
        'reaction_description' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please describe the reaction(s)!'
            ),
        ),
      );

    public function beforeSave() {
        if (!empty($this->data['Sae']['date_of_birth'])) {
            $this->data['Sae']['date_of_birth'] = $this->dateFormatBeforeSave($this->data['Sae']['date_of_birth']);
        }
        if (!empty($this->data['Sae']['reaction_onset'])) {
            $this->data['Sae']['reaction_onset'] = $this->dateFormatBeforeSave($this->data['Sae']['reaction_onset']);
        }
        if (!empty($this->data['Sae']['manufacturer_date'])) {
            $this->data['Sae']['manufacturer_date'] = $this->dateFormatBeforeSave($this->data['Sae']['manufacturer_date']);
        }
        return true;
    }

    function afterFind($results) {
        foreach ($results as $key => $val) {
            if (isset($val['Sae']['date_of_birth'])) {
                $results[$key]['Sae']['date_of_birth'] = $this->dateFormatAfterFind($val['Sae']['date_of_birth']);
            }
            if (isset($val['Sae']['reaction_onset'])) {
                $results[$key]['Sae']['reaction_onset'] = $this->dateFormatAfterFind($val['Sae']['reaction_onset']);
            }
            if (isset($val['Sae']['manufacturer_date'])) {
                $results[$key]['Sae']['manufacturer_date'] = $this->dateFormatAfterFind($val['Sae']['manufacturer_date']);
            }
        }
        return $results;
    }

    public function dateAfterStartDates($field = null) {
        if (!empty($this->data['SuspectedDrug'])) {
            foreach ($this->data['SuspectedDrug'] as $val) {
                if(strtotime($field['reaction_onset']) < strtotime($val['date_from']))    return false;
            }
        }
        return true;
    }
}
