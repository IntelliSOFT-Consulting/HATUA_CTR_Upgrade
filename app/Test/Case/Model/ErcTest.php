<?php
App::uses('Erc', 'Model');

/**
 * Erc Test Case
 *
 */
class ErcTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.erc'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Erc = ClassRegistry::init('Erc');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Erc);

		parent::tearDown();
	}

}
