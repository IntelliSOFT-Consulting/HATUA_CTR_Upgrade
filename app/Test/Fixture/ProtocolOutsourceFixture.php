<?php
/**
 * ProtocolOutsourceFixture
 *
 */
class ProtocolOutsourceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'application_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'amendment_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'owner_id' => array('type' => 'integer', 'null' => true, 'default' => null),
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
			'user_id' => 1,
			'application_id' => 1,
			'amendment_id' => 1,
			'owner_id' => 1,
			'created' => '2024-05-27 17:43:48',
			'modified' => '2024-05-27 17:43:48'
		),
	);

}
