<?php
App::uses('Fundamental', 'Model');

/**
 * Fundamental Test Case
 *
 */
class FundamentalTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fundamental',
		'app.instrument',
		'app.exchange',
		'app.sector',
		'app.corporate_action',
		'app.data_banks_eod',
		'app.market',
		'app.data_banks_intraday',
		'app.index_value',
		'app.market_stat',
		'app.stat',
		'app.fundamental_meta',
		'app.fundamental_meta_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Fundamental = ClassRegistry::init('Fundamental');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Fundamental);

		parent::tearDown();
	}

}
