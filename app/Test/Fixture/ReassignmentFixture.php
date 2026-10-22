<?php
/**
 * ReassignmentFixture
 *
 */
class ReassignmentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'application_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'orig_user' => array('type' => 'integer', 'null' => true, 'default' => null),
		'new_user' => array('type' => 'integer', 'null' => true, 'default' => null),
		'assigning_user' => array('type' => 'integer', 'null' => true, 'default' => null),
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
			'orig_user' => 1,
			'new_user' => 1,
			'assigning_user' => 1,
			'created' => '2020-02-25 22:32:15',
			'modified' => '2020-02-25 22:32:15'
		),
	);

}
