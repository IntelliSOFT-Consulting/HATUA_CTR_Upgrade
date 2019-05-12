<?php
App::uses('AppModel', 'Model');
/**
 * SiteInspection Model
 *
 * @property Application $Application
 * @property SiteAnswer $SiteAnswer
 */
class SiteInspection extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'application_id';


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
        )
    );

/**
 * hasMany associations
 *
 * @var array
 */

    public $hasMany = array(
        'SiteAnswer' => array(
            'className' => 'SiteAnswer',
            'foreignKey' => 'site_inspection_id',
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
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('Attachment.model' => 'SiteInspection', 'Attachment.group' => 'site_inspections'),
        ),
        'InternalComment' => array(
            'className' => 'Comments',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('InternalComment.model' => 'SiteInspection', 'InternalComment.category' => 'internal' ),
        ),
        'ExternalComment' => array(
            'className' => 'Comments',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('ExternalComment.model' => 'SiteInspection', 'ExternalComment.category' => 'external' ),
        ),
    );

}
