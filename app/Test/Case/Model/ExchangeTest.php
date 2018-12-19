<?php
App::uses('Exchange', 'Model');

/**
 * Exchange Test Case
 *
 */
class ExchangeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.exchange',
		'app.instrument',
		'app.sector',
		'app.sector_intraday',
		'app.corporate_action',
		'app.data_banks_eod',
		'app.market',
		'app.data_banks_intraday',
		'app.index_value',
		'app.index',
		'app.market_stat',
		'app.market_meta',
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
		$this->Exchange = ClassRegistry::init('Exchange');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Exchange);

		parent::tearDown();
	}

}
