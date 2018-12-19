<?php
App::uses('IndexValue', 'Model');

/**
 * IndexValue Test Case
 *
 */
class IndexValueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.index_value',
		'app.market',
		'app.exchange',
		'app.data_banks_intraday',
		'app.instrument',
		'app.sector',
		'app.sector_intraday',
		'app.corporate_action',
		'app.data_banks_eod',
		'app.fundamental',
		'app.fundamental_meta',
		'app.fundamental_meta_group',
		'app.market_stat',
		'app.market_meta',
		'app.index'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->IndexValue = ClassRegistry::init('IndexValue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IndexValue);

		parent::tearDown();
	}

}
