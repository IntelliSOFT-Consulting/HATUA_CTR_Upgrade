<?php
App::uses('InvestigatorContact', 'Model');

/**
 * InvestigatorContact Test Case
 *
 */
class InvestigatorContactTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.investigator_contact',
		'app.application',
		'app.user',
		'app.group',
		'app.previous_date'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InvestigatorContact = ClassRegistry::init('InvestigatorContact');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InvestigatorContact);

		parent::tearDown();
	}

}
