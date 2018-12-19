<?php
App::uses('Broker', 'Model');

/**
 * Broker Test Case
 *
 */
class BrokerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.broker',
		'app.user',
		'app.group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Broker = ClassRegistry::init('Broker');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Broker);

		parent::tearDown();
	}

}
