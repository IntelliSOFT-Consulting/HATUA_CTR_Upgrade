<?php
/**
 * OutsourceRequestFixture
 *
 */
class OutsourceRequestFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'application_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'outsource_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'sae' => array('type' => 'integer', 'null' => true, 'default' => null),
		'ciom' => array('type' => 'integer', 'null' => true, 'default' => null),
		'dev' => array('type' => 'integer', 'null' => true, 'default' => null),
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
			'outsource_id' => 1,
			'sae' => 1,
			'ciom' => 1,
			'dev' => 1,
			'created' => '2024-06-13 16:43:03',
			'modified' => '2024-06-13 16:43:03'
		),
	);

}
