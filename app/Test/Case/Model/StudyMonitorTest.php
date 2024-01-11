<?php
App::uses('StudyMonitor', 'Model');

/**
 * StudyMonitor Test Case
 *
 */
class StudyMonitorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.study_monitor',
		'app.user',
		'app.group',
		'app.county',
		'app.country',
		'app.review',
		'app.application',
		'app.trial_status',
		'app.amendment',
		'app.attachment',
		'app.investigator_contact',
		'app.application_stage',
		'app.comment',
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
		'app.deviation',
		'app.review_answer',
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
		$this->StudyMonitor = ClassRegistry::init('StudyMonitor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StudyMonitor);

		parent::tearDown();
	}

}
