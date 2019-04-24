<?php
App::uses('SiteQuestion', 'Model');

/**
 * SiteQuestion Test Case
 *
 */
class SiteQuestionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_question'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteQuestion = ClassRegistry::init('SiteQuestion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteQuestion);

		parent::tearDown();
	}

}
