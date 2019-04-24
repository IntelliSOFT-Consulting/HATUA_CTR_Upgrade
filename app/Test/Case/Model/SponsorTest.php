<?php
App::uses('Sponsor', 'Model');

/**
 * Sponsor Test Case
 *
 */
class SponsorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sponsor',
		'app.application',
		'app.user',
		'app.group',
		'app.county',
		'app.trial_status',
		'app.previous_date',
		'app.investigator_contact',
		'app.organization',
		'app.site_detail',
		'app.attachment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sponsor = ClassRegistry::init('Sponsor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sponsor);

		parent::tearDown();
	}

}
