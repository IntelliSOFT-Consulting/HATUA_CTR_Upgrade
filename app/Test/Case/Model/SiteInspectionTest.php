<?php
App::uses('SiteInspection', 'Model');

/**
 * SiteInspection Test Case
 *
 */
class SiteInspectionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_inspection',
		'app.application',
		'app.user',
		'app.group',
		'app.county',
		'app.country',
		'app.review',
		'app.notification',
		'app.feedback',
		'app.trial_status',
		'app.previous_date',
		'app.amendment',
		'app.attachment',
		'app.investigator_contact',
		'app.organization',
		'app.site_detail',
		'app.placebo',
		'app.sponsor',
		'app.site_answer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteInspection = ClassRegistry::init('SiteInspection');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteInspection);

		parent::tearDown();
	}

}
