<?php
App::uses('NewsMeta', 'Model');

/**
 * NewsMeta Test Case
 *
 */
class NewsMetaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.news_meta',
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
		$this->NewsMeta = ClassRegistry::init('NewsMeta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NewsMeta);

		parent::tearDown();
	}

}
