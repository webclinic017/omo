<?php
App::uses('FundamentalMeta', 'Model');

/**
 * FundamentalMeta Test Case
 *
 */
class FundamentalMetaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fundamental_meta',
		'app.fundamental_meta_group',
		'app.fundamental',
		'app.instrument',
		'app.exchange',
		'app.market',
		'app.data_banks_intraday',
		'app.index_value',
		'app.index',
		'app.market_stat',
		'app.market_meta',
		'app.sector',
		'app.sector_intraday',
		'app.sector_list',
		'app.corporate_action',
		'app.data_banks_eod'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FundamentalMeta = ClassRegistry::init('FundamentalMeta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FundamentalMeta);

		parent::tearDown();
	}

}
