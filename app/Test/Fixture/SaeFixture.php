<?php
/**
 * SaeFixture
 *
 */
class SaeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'application_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'patient_initials' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'country' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date_of_birth' => array('type' => 'date', 'null' => true, 'default' => null),
		'age_years' => array('type' => 'integer', 'null' => true, 'default' => null),
		'reaction_onset' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'patient_died' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'prolonged_hospitalization' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'incapacity' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'life_threatening' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'reaction_description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'relevant_history' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'manufacturer_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mfr_no' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'manufacturer_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'source_study' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'source_literature' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'source_health_professional' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'report_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'report_type' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'approved' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 2),
		'approved_by' => array('type' => 'integer', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'user_id' => 1,
			'patient_initials' => 'Lorem ipsum dolor sit amet',
			'country' => 'Lorem ipsum dolor sit amet',
			'date_of_birth' => '2019-05-17',
			'age_years' => 1,
			'reaction_onset' => 'Lorem ipsum dolor sit amet',
			'patient_died' => 1,
			'prolonged_hospitalization' => 1,
			'incapacity' => 1,
			'life_threatening' => 1,
			'reaction_description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'relevant_history' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'manufacturer_name' => 'Lorem ipsum dolor sit amet',
			'mfr_no' => 'Lorem ipsum dolor sit amet',
			'manufacturer_date' => '2019-05-17',
			'source_study' => 1,
			'source_literature' => 1,
			'source_health_professional' => 1,
			'report_date' => '2019-05-17',
			'report_type' => 1,
			'approved' => 1,
			'approved_by' => 1,
			'deleted' => 1,
			'deleted_date' => '2019-05-17 16:47:28',
			'created' => '2019-05-17 16:47:28',
			'modified' => '2019-05-17 16:47:28'
		),
	);

}
