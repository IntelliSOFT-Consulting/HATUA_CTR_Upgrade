<?php
App::uses('Reviewer', 'Model');

/**
 * Reviewer Test Case
 *
 */
class ReviewerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reviewer',
		'app.user',
		'app.group',
		'app.county',
		'app.country',
		'app.application',
		'app.trial_status',
		'app.previous_date',
		'app.amendment',
		'app.investigator_contact',
		'app.organization',
		'app.site_detail',
		'app.placebo',
		'app.sponsor',
		'app.attachment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reviewer = ClassRegistry::init('Reviewer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reviewer);

		parent::tearDown();
	}

}
