<?php
App::uses('DataBanksIntraday', 'Model');

/**
 * DataBanksIntraday Test Case
 *
 */
class DataBanksIntradayTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.data_banks_intraday',
		'app.market',
		'app.exchange',
		'app.instrument',
		'app.sector',
		'app.sector_intraday',
		'app.corporate_action',
		'app.data_banks_eod',
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
		$this->DataBanksIntraday = ClassRegistry::init('DataBanksIntraday');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DataBanksIntraday);

		parent::tearDown();
	}

}
