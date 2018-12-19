<?php
App::uses('Order', 'Model');

/**
 * Order Test Case
 *
 */
class OrderTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.order',
		'app.user',
		'app.group',
		'app.instrument',
		'app.exchange',
		'app.market',
		'app.data_banks_intraday',
		'app.index_value',
		'app.index',
		'app.market_stat',
		'app.meta',
		'app.meta_group',
		'app.event_information',
		'app.event',
		'app.sector',
		'app.sector_list',
		'app.sector_intraday',
		'app.corporate_action',
		'app.data_banks_eod',
		'app.fundamental'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Order = ClassRegistry::init('Order');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Order);

		parent::tearDown();
	}

}
