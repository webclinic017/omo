<?php
App::uses('PortfolioShare', 'Model');

/**
 * PortfolioShare Test Case
 *
 */
class PortfolioShareTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.portfolio_share',
		'app.portfolio',
		'app.user',
		'app.group',
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
		'app.fundamental_meta_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PortfolioShare = ClassRegistry::init('PortfolioShare');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PortfolioShare);

		parent::tearDown();
	}

}
