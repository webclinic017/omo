<?php
App::uses('News', 'Model');

/**
 * News Test Case
 *
 */
class NewsTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.news',
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
		$this->News = ClassRegistry::init('News');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->News);

		parent::tearDown();
	}

}
