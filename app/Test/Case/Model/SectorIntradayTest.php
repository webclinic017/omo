<?php
App::uses('SectorIntraday', 'Model');

/**
 * SectorIntraday Test Case
 *
 */
class SectorIntradayTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sector_intraday',
		'app.market',
		'app.exchange',
		'app.instrument',
		'app.sector_list',
		'app.corporate_action',
		'app.data_banks_eod',
		'app.data_banks_intraday',
		'app.fundamental',
		'app.fundamental_meta',
		'app.fundamental_meta_group',
		'app.sector',
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
		$this->SectorIntraday = ClassRegistry::init('SectorIntraday');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SectorIntraday);

		parent::tearDown();
	}

}
