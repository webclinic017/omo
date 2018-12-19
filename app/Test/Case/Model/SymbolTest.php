<?php
App::uses('Symbol', 'Model');

/**
 * Symbol Test Case
 *
 */
class SymbolTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.symbol',
		'app.sector'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Symbol = ClassRegistry::init('Symbol');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Symbol);

		parent::tearDown();
	}

}
