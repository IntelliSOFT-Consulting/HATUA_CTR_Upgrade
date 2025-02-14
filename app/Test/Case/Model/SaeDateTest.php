<?php
App::uses('SaeDate', 'Model');

/**
 * SaeDate Test Case
 *
 */
class SaeDateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sae_date',
		'app.sae',
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
		'app.protocol_outsource',
		'app.outsource',
		'app.outsource_request',
		'app.investigator_contact',
		'app.application_stage',
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
		'app.ciom',
		'app.study_route',
		'app.manufacturer',
		'app.reassignment',
		'app.reminder',
		'app.participant_flow',
		'app.budget',
		'app.deviation',
		'app.suspected_drug',
		'app.route',
		'app.concomittant_drug'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SaeDate = ClassRegistry::init('SaeDate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SaeDate);

		parent::tearDown();
	}

}
