<?php
App::uses('AppModel', 'Model');
/**
 * StudyMonitor Model
 *
 * @property User $User
 * @property Application $Application
 * @property Amendment $Amendment
 */
class StudyMonitor extends AppModel
{
    public $actsAs = array('Containable', 'Search.Searchable');
    public $filterArgs = array(
        'protocol_no' => array('type' => 'like', 'encode' => true),
        'filter' => array('type' => 'query', 'method' => 'findByProtocol', 'encode' => true),
    );
    public function orConditions($data = array())
    {
        $filter = $data['filter'];
        $cond = array(
            'OR' => array(
                $this->alias . '.email LIKE' => '%' . $filter . '%',
                $this->alias . '.name LIKE' => '%' . $filter . '%',
                $this->alias . '.username LIKE' => '%' . $filter . '%',
            )
        );
        return $cond;
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
        ),
        'Application' => array(
            'className' => 'Application',
            'foreignKey' => 'application_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Amendment' => array(
            'className' => 'Amendment',
            'foreignKey' => 'amendment_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
