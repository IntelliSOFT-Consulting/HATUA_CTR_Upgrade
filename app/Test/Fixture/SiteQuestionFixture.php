<?php
/**
 * SiteQuestionFixture
 *
 */
class SiteQuestionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'question_number' => array('type' => 'integer', 'null' => false, 'default' => null),
		'question' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 800, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'question_type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'question_number' => 1,
			'question' => 'Lorem ipsum dolor sit amet',
			'question_type' => 'Lorem ipsum dolor sit amet',
			'created' => '2019-04-24 20:45:16',
			'modified' => '2019-04-24 20:45:16'
		),
	);

}
