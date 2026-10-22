<?php
App::uses('Deviation', 'Model');

/**
 * Deviation Test Case
 *
 */
class DeviationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.deviation',
		'app.application',
		'app.user',
		'app.group',
		'app.county',
		'app.country',
		'app.review',
		'app.notification',
		'app.feedback',
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
		'app.budget'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Deviation = ClassRegistry::init('Deviation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Deviation);

		parent::tearDown();
	}

}
