<?php
App::uses('SectorList', 'Model');

/**
 * SectorList Test Case
 *
 */
class SectorListTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sector_list',
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
		$this->SectorList = ClassRegistry::init('SectorList');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SectorList);

		parent::tearDown();
	}

}
