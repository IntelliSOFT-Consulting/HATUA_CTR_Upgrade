<?php
/**
 * ParticipantFlowFixture
 *
 */
class ParticipantFlowFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'application_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'year' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'original_subjects' => array('type' => 'integer', 'null' => false, 'default' => null),
		'consented' => array('type' => 'integer', 'null' => false, 'default' => null),
		'screened' => array('type' => 'integer', 'null' => false, 'default' => null),
		'enrolled' => array('type' => 'integer', 'null' => false, 'default' => null),
		'lost' => array('type' => 'integer', 'null' => false, 'default' => null),
		'withdrawn' => array('type' => 'integer', 'null' => false, 'default' => null),
		'withdrawal_reason' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'active_subjects' => array('type' => 'integer', 'null' => false, 'default' => null),
		'completed_number' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'year' => 'Lorem ipsum dolor sit amet',
			'original_subjects' => 1,
			'consented' => 1,
			'screened' => 1,
			'enrolled' => 1,
			'lost' => 1,
			'withdrawn' => 1,
			'withdrawal_reason' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'active_subjects' => 1,
			'completed_number' => 1,
			'created' => '2019-06-29 12:34:31',
			'modified' => '2019-06-29 12:34:31'
		),
	);

}
