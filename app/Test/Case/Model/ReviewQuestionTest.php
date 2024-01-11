<?php
App::uses('ReviewQuestion', 'Model');

/**
 * ReviewQuestion Test Case
 *
 */
class ReviewQuestionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.review_question'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ReviewQuestion = ClassRegistry::init('ReviewQuestion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ReviewQuestion);

		parent::tearDown();
	}

}
