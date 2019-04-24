<?php
App::uses('SiteDetail', 'Model');

/**
 * SiteDetail Test Case
 *
 */
class SiteDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_detail',
		'app.application',
		'app.user',
		'app.group',
		'app.previous_date',
		'app.investigator_contact',
		'app.organization'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteDetail = ClassRegistry::init('SiteDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteDetail);

		parent::tearDown();
	}

}
