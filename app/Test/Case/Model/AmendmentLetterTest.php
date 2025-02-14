<?php
App::uses('AmendmentLetter', 'Model');

/**
 * AmendmentLetter Test Case
 *
 */
class AmendmentLetterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.amendment_letter',
		'app.application',
		'app.user',
		'app.group',
		'app.county',
		'app.country',
		'app.review',
		'app.review_answer',
		'app.comment',
		'app.attachment',
		'app.active_inspector',
		'app.notification',
		'app.feedback',
		'app.study_monitor',
		'app.amendment',
		'app.trial_status',
		'app.investigator_contact',
		'app.application_stage',
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
		'app.reassignment',
		'app.reminder',
		'app.participant_flow',
		'app.budget',
		'app.deviation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AmendmentLetter = ClassRegistry::init('AmendmentLetter');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AmendmentLetter);

		parent::tearDown();
	}

}
