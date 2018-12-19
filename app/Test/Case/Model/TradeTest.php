<?php
App::uses('Trade', 'Model');

/**
 * Trade Test Case
 *
 */
class TradeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.trade',
		'app.market',
		'app.exchange',
		'app.instrument',
		'app.sector',
		'app.sector_intraday',
		'app.corporate_action',
		'app.data_banks_eod',
		'app.data_banks_intraday',
		'app.fundamental',
		'app.fundamental_meta',
		'app.fundamental_meta_group',
		'app.index_value',
		'app.index',
		'app.market_stat',
		'app.market_meta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Trade = ClassRegistry::init('Trade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Trade);

		parent::tearDown();
	}

}
