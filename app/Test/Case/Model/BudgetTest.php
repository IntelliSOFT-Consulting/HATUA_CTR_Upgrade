<?php
App::uses('Budget', 'Model');

/**
 * Budget Test Case
 *
 */
class BudgetTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.budget',
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
		'app.concomittant_drug',
		'app.participant_flow'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Budget = ClassRegistry::init('Budget');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Budget);

		parent::tearDown();
	}

}
