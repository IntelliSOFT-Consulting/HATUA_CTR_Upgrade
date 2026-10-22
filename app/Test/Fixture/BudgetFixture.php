<?php
/**
 * BudgetFixture
 *
 */
class BudgetFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'application_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'year' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'budget_period' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'personnel_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'personnel' => array('type' => 'integer', 'null' => true, 'default' => null),
		'transport_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'transport' => array('type' => 'integer', 'null' => true, 'default' => null),
		'field_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'field' => array('type' => 'integer', 'null' => true, 'default' => null),
		'supplies_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'supplies' => array('type' => 'integer', 'null' => true, 'default' => null),
		'pharmacy_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'pharmacy' => array('type' => 'integer', 'null' => true, 'default' => null),
		'travel_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'travel' => array('type' => 'integer', 'null' => true, 'default' => null),
		'regulatory_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'regulatory' => array('type' => 'integer', 'null' => true, 'default' => null),
		'it_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'it' => array('type' => 'integer', 'null' => true, 'default' => null),
		'lab_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'lab' => array('type' => 'integer', 'null' => true, 'default' => null),
		'hdss_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'hdss' => array('type' => 'integer', 'null' => true, 'default' => null),
		'kemri_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'kemri' => array('type' => 'integer', 'null' => true, 'default' => null),
		'wrair_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'wrair' => array('type' => 'integer', 'null' => true, 'default' => null),
		'subject_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subject' => array('type' => 'integer', 'null' => true, 'default' => null),
		'grand_currency' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'grand_total' => array('type' => 'integer', 'null' => true, 'default' => null),
		'study_information' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'year' => 'Lorem ipsum dolor sit amet',
			'budget_period' => 'Lorem ipsum dolor sit amet',
			'personnel_currency' => 'Lorem ip',
			'personnel' => 1,
			'transport_currency' => 'Lorem ip',
			'transport' => 1,
			'field_currency' => 'Lorem ip',
			'field' => 1,
			'supplies_currency' => 'Lorem ip',
			'supplies' => 1,
			'pharmacy_currency' => 'Lorem ip',
			'pharmacy' => 1,
			'travel_currency' => 'Lorem ip',
			'travel' => 1,
			'regulatory_currency' => 'Lorem ip',
			'regulatory' => 1,
			'it_currency' => 'Lorem ip',
			'it' => 1,
			'lab_currency' => 'Lorem ip',
			'lab' => 1,
			'hdss_currency' => 'Lorem ip',
			'hdss' => 1,
			'kemri_currency' => 'Lorem ip',
			'kemri' => 1,
			'wrair_currency' => 'Lorem ip',
			'wrair' => 1,
			'subject_currency' => 'Lorem ip',
			'subject' => 1,
			'grand_currency' => 'Lorem ip',
			'grand_total' => 1,
			'study_information' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2019-07-13 21:35:47',
			'modified' => '2019-07-13 21:35:47'
		),
	);

}
