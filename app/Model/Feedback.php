<?php
App::uses('AppModel', 'Model');
/**
 * Feedback Model
 *
 * @property User $User
 */
class Feedback extends AppModel {


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

	public $validate = array(
	'email' => array(
            'notEmpty' => array(
                'rule'     => 'email',
                'required' => true,
                'message'  => 'Please provide a valid email address'
            ),
        ),
	'subject' => array(
	      'notempty' => array(
	        'rule' => array('notempty'),
	        'message' => 'Subject cannot be empty!',
	      ),
	    ),
	'feedback' => array(
	      'notempty' => array(
	        'rule' => array('notempty'),
	        'message' => 'Message body cannot be empty!',
	      ),
	    ),
	 );
}
