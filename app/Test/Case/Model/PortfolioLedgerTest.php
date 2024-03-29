<?php
App::uses('PortfolioLedger', 'Model');

/**
 * PortfolioLedger Test Case
 *
 */
class PortfolioLedgerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.portfolio_ledger',
		'app.portfolio',
		'app.user',
		'app.group',
		'app.portfolio_transaction',
		'app.instrument',
		'app.exchange',
		'app.market',
		'app.data_banks_intraday',
		'app.index_value',
		'app.index',
		'app.market_stat',
		'app.market_meta',
		'app.sector',
		'app.sector_list',
		'app.sector_intraday',
		'app.corporate_action',
		'app.data_banks_eod',
		'app.fundamental',
		'app.fundamental_meta',
		'app.fundamental_meta_group',
		'app.transaction_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PortfolioLedger = ClassRegistry::init('PortfolioLedger');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PortfolioLedger);

		parent::tearDown();
	}

}
