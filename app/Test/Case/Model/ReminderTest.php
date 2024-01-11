<?php
App::uses('Reminder', 'Model');

/**
 * Reminder Test Case
 *
 */
class ReminderTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reminder',
		'app.user',
		'app.group',
		'app.county',
		'app.country',
		'app.application',
		'app.trial_status',
		'app.review',
		'app.review_answer',
		'app.comment',
		'app.attachment',
		'app.amendment',
		'app.investigator_contact',
		'app.pharmacist',
		'app.ethical_committee',
		'app.annual_letter',
		'app.organization',
		'app.site_detail',
		'app.placebo',
		'app.sponsor',
		'app.site_inspection',
		'app.site_answer',
		'app.sae',
		'app.suspected_drug',
		'app.route',
		'app.concomittant_drug',
		'app.ciom',
		'app.study_route',
		'app.manufacturer',
		'app.participant_flow',
		'app.budget',
		'app.deviation',
		'app.notification',
		'app.feedback'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reminder = ClassRegistry::init('Reminder');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reminder);

		parent::tearDown();
	}

}
