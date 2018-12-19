<?php
App::uses('Instrument', 'Model');

/**
 * Instrument Test Case
 *
 */
class InstrumentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.instrument',
		'app.exchange',
		'app.sector',
		'app.corporate_action',
		'app.data_banks_eod',
		'app.market',
		'app.data_banks_intraday',
		'app.index_value',
		'app.market_stat',
		'app.stat',
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
		$this->Instrument = ClassRegistry::init('Instrument');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Instrument);

		parent::tearDown();
	}

}
