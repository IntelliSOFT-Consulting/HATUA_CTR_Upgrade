<?php
App::uses('County', 'Model');

/**
 * County Test Case
 *
 */
class CountyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.county'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->County = ClassRegistry::init('County');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->County);

		parent::tearDown();
	}

}
