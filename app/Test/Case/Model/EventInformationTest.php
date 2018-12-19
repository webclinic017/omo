<?php
App::uses('EventInformation', 'Model');

/**
 * EventInformation Test Case
 *
 */
class EventInformationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.event_information',
		'app.event',
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
		'app.fundamental_meta_group',
		'app.meta',
		'app.meta_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->EventInformation = ClassRegistry::init('EventInformation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->EventInformation);

		parent::tearDown();
	}

}
