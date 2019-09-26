<?php
App::uses('Ciom', 'Model');

/**
 * Ciom Test Case
 *
 */
class CiomTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ciom',
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
		'app.study_route',
		'app.manufacturer',
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
		$this->Ciom = ClassRegistry::init('Ciom');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ciom);

		parent::tearDown();
	}

}
