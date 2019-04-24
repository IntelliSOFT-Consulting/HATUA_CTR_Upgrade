<?php
App::uses('Placebo', 'Model');

/**
 * Placebo Test Case
 *
 */
class PlaceboTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.placebo',
		'app.application',
		'app.user',
		'app.group',
		'app.county',
		'app.trial_status',
		'app.previous_date',
		'app.investigator_contact',
		'app.organization',
		'app.site_detail',
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
		$this->Placebo = ClassRegistry::init('Placebo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Placebo);

		parent::tearDown();
	}

}
