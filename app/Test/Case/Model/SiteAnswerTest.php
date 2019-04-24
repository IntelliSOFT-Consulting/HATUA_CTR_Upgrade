<?php
App::uses('SiteAnswer', 'Model');

/**
 * SiteAnswer Test Case
 *
 */
class SiteAnswerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_answer',
		'app.site_inspection'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteAnswer = ClassRegistry::init('SiteAnswer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteAnswer);

		parent::tearDown();
	}

}
