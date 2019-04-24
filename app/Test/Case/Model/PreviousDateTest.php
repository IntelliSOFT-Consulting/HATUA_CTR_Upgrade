<?php
App::uses('PreviousDate', 'Model');

/**
 * PreviousDate Test Case
 *
 */
class PreviousDateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.previous_date',
		'app.application',
		'app.user',
		'app.group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PreviousDate = ClassRegistry::init('PreviousDate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PreviousDate);

		parent::tearDown();
	}

}
