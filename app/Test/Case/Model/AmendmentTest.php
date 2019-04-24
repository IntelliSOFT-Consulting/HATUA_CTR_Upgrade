<?php
App::uses('Amendment', 'Model');

/**
 * Amendment Test Case
 *
 */
class AmendmentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.amendment',
		'app.application',
		'app.user',
		'app.group',
		'app.county',
		'app.country',
		'app.trial_status',
		'app.previous_date',
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
		$this->Amendment = ClassRegistry::init('Amendment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Amendment);

		parent::tearDown();
	}

}
