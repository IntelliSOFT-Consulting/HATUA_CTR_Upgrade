<?php
App::uses('ParticipantFlow', 'Model');

/**
 * ParticipantFlow Test Case
 *
 */
class ParticipantFlowTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.participant_flow',
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
		'app.ethical_committee',
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
		'app.concomittant_drug'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ParticipantFlow = ClassRegistry::init('ParticipantFlow');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ParticipantFlow);

		parent::tearDown();
	}

}
