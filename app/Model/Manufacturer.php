<?php
App::uses('AppModel', 'Model');
/**
 * Manufacturer Model
 *
 * @property Application $Application
 */
class Manufacturer extends AppModel {


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


    public $validate = array(
        'manufacturer_name' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Abstract: Please enter the name of the manufacturer!'
            ),
        ),
        'address' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Abstract: Please enter the manufacturing site address!'
            ),
        ),
        'manufacturer_email' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Abstract: Please enter the email of the manufacturer!'
            ),
        ),
        'manufacturing_activities' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Abstract: Please enter the manufacturing activities at the site!'
            ),
        ),
        'manufacturer_country' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Abstract: Please enter the country of the manufacturer!'
            ),
        ),
      );
}
