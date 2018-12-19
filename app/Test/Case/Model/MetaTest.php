<?php
App::uses('Meta', 'Model');

/**
 * Meta Test Case
 *
 */
class MetaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.meta',
		'app.meta_group',
		'app.event_information'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Meta = ClassRegistry::init('Meta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Meta);

		parent::tearDown();
	}

}
