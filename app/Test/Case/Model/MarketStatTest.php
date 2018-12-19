<?php
App::uses('MarketStat', 'Model');

/**
 * MarketStat Test Case
 *
 */
class MarketStatTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.market_stat',
		'app.market',
		'app.exchange',
		'app.data_banks_intraday',
		'app.instrument',
		'app.sector',
		'app.corporate_action',
		'app.data_banks_eod',
		'app.fundamental',
		'app.fundamental_meta',
		'app.fundamental_meta_group',
		'app.index_value',
		'app.market_meta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MarketStat = ClassRegistry::init('MarketStat');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MarketStat);

		parent::tearDown();
	}

}
