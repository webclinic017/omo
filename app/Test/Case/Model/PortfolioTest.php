<?php
App::uses('Portfolio', 'Model');

/**
 * Portfolio Test Case
 *
 */
class PortfolioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.portfolio',
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
		$this->Portfolio = ClassRegistry::init('Portfolio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Portfolio);

		parent::tearDown();
	}

}
