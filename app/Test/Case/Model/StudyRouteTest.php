<?php
App::uses('StudyRoute', 'Model');

/**
 * StudyRoute Test Case
 *
 */
class StudyRouteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.study_route',
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
		'app.pharmacist',
		'app.ethical_committee',
		'app.annual_letter',
		'app.organization',
		'app.site_detail',
		'app.placebo',
		'app.sponsor',
		'app.site_inspection',
		'app.site_answer',
		'app.comment',
		'app.sae',
		'app.suspected_drug',
		'app.route',
		'app.concomittant_drug',
		'app.participant_flow',
		'app.budget'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StudyRoute = ClassRegistry::init('StudyRoute');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StudyRoute);

		parent::tearDown();
	}

}
