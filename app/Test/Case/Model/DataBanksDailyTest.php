<?php
App::uses('DataBanksDaily', 'Model');

/**
 * DataBanksDaily Test Case
 *
 */
class DataBanksDailyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.data_banks_daily',
		'app.market',
		'app.exchange',
		'app.data_banks_intraday',
		'app.instrument',
		'app.sector',
		'app.index_value',
		'app.market_stat',
		'app.stat'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DataBanksDaily = ClassRegistry::init('DataBanksDaily');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DataBanksDaily);

		parent::tearDown();
	}

}
