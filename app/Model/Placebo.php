<?php
App::uses('AppModel', 'Model');
/**
 * Placebo Model
 *
 * @property Application $Application
 */
class Placebo extends AppModel {


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
		'pharmaceutical_form' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Placebo : Please enter pharmaceutical form for the placebo'
            ),
        ),
		'route_of_administration' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Placebo : Please enter the route of administration for the placebo'
            ),
        ),
		'composition' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Placebo : Please enter composition for the placebo'
            ),
        ),
		'identical_indp' => array(
            'notEmpty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Placebo : Please specify if the placebo is otherwise identical to the INDP'
            ),
        ),
	       'major_ingredients' => array(
            'ifIndp' => array(
                'rule'     => array('ifIndp'),
                'required' => true,
                'message'  => 'Placebo : If No above, enter the major ingredients for the placebo else leave empty.'
            ),
        ),
	);

	public function ifIndp($field = null) {
		if($this->data['Placebo']['identical_indp'] == "No" && !empty($field['major_ingredients'])) {
			return true;
		} else if($this->data['Placebo']['identical_indp'] == "Yes" && empty($field['major_ingredients'])) {
			return true;
		}
		return false;
	}

	// UTILITY METHODS
	public function isOwnedBy($placebo, $user) {
		$application = $this->field('application_id', array('id' => $placebo));
		return $this->Application->field('id', array('id' => $application, 'user_id' => $user)) === $application;
	}
}
