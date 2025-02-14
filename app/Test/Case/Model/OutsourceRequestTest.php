<?php
App::uses('OutsourceRequest', 'Model');

/**
 * OutsourceRequest Test Case
 *
 */
class OutsourceRequestTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.outsource_request',
		'app.user',
		'app.group',
		'app.county',
		'app.country',
		'app.review',
		'app.application',
		'app.trial_status',
		'app.active_inspector',
		'app.amendment',
		'app.attachment',
		'app.investigator_contact',
		'app.application_stage',
		'app.comment',
		'app.pharmacist',
		'app.ethical_committee',
		'app.annual_letter',
		'app.amendment_letter',
		'app.amendment_approval',
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
		'app.study_monitor',
		'app.protocol_outsource',
		'app.outsource',
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
		$this->OutsourceRequest = ClassRegistry::init('OutsourceRequest');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OutsourceRequest);

		parent::tearDown();
	}

}
