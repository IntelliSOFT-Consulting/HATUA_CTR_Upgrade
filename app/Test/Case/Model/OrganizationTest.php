<?php
App::uses('Organization', 'Model');

/**
 * Organization Test Case
 *
 */
class OrganizationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.organization',
		'app.application',
		'app.user',
		'app.group',
		'app.county',
		'app.trial_status',
		'app.previous_date',
		'app.investigator_contact',
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
		$this->Organization = ClassRegistry::init('Organization');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Organization);

		parent::tearDown();
	}

}
