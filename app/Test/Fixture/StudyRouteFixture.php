<?php
/**
 * StudyRouteFixture
 *
 */
class StudyRouteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'application_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'date_of_previous_protocol' => array('type' => 'date', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'application_id' => 1,
			'date_of_previous_protocol' => '2019-08-15',
			'created' => '2019-08-15 23:05:54',
			'modified' => '2019-08-15 23:05:54'
		),
	);

}
