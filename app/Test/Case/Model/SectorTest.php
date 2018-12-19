<?php
App::uses('Sector', 'Model');

/**
 * Sector Test Case
 *
 */
class SectorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sector',
		'app.exchange',
		'app.instrument',
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
		'app.fundamental_meta_group',
		'app.sector_intraday'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sector = ClassRegistry::init('Sector');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sector);

		parent::tearDown();
	}

}
