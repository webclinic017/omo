<?php
App::uses('DataBanksEod', 'Model');

/**
 * DataBanksEod Test Case
 *
 */
class DataBanksEodTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.data_banks_eod',
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
		$this->DataBanksEod = ClassRegistry::init('DataBanksEod');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DataBanksEod);

		parent::tearDown();
	}

}
