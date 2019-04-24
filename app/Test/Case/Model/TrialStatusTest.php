<?php
App::uses('TrialStatus', 'Model');

/**
 * TrialStatus Test Case
 *
 */
class TrialStatusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.trial_status'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TrialStatus = ClassRegistry::init('TrialStatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TrialStatus);

		parent::tearDown();
	}

}
