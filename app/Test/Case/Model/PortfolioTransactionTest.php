<?php
App::uses('PortfolioTransaction', 'Model');

/**
 * PortfolioTransaction Test Case
 *
 */
class PortfolioTransactionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.portfolio_transaction',
		'app.portfolio',
		'app.user',
		'app.group',
		'app.portfolio_share',
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
		$this->PortfolioTransaction = ClassRegistry::init('PortfolioTransaction');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PortfolioTransaction);

		parent::tearDown();
	}

}
