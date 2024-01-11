<?php
App::uses('ApplicationStage', 'Model');

/**
 * ApplicationStage Test Case
 *
 */
class ApplicationStageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.application_stage',
		'app.application',
		'app.user',
		'app.group',
		'app.county',
		'app.country',
		'app.review',
		'app.review_answer',
		'app.comment',
		'app.attachment',
		'app.notification',
		'app.feedback',
		'app.trial_status',
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
		$this->ApplicationStage = ClassRegistry::init('ApplicationStage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ApplicationStage);

		parent::tearDown();
	}

}
