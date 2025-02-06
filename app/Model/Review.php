<?php
App::uses('AppModel', 'Model');
/**
 * Review Model
 *
 * @property Reviewer $Reviewer
 */
class Review extends AppModel {

    public $actsAs = array('Timestamp');

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

	public $hasMany = array(
        'ReviewAnswer' => array(
            'className' => 'ReviewAnswer',
            'foreignKey' => 'review_id',
            'dependent' => true,
        ),
        'InternalComment' => array(
            'className' => 'Comment',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('InternalComment.model' => 'Review', 'InternalComment.category' => 'internal' ),
        ),
        'ExternalComment' => array(
            'className' => 'Comment',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('ExternalComment.model' => 'Review', 'ExternalComment.category' => 'external' ),
        ), 
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array('Attachment.model' => 'Review', 'Attachment.group' => 'attachment'),
        ),
    );
}
