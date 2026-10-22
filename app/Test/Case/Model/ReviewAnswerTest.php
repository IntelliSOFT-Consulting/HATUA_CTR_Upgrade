<?php
App::uses('ReviewAnswer', 'Model');

/**
 * ReviewAnswer Test Case
 *
 */
class ReviewAnswerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.review_answer',
		'app.review',
		'app.user',
		'app.group',
		'app.county',
		'app.country',
		'app.application',
		'app.trial_status',
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
		$this->ReviewAnswer = ClassRegistry::init('ReviewAnswer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ReviewAnswer);

		parent::tearDown();
	}

}
