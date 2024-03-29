<?php
App::uses('DataBankOddlot', 'Model');

/**
 * DataBankOddlot Test Case
 *
 */
class DataBankOddlotTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.data_bank_oddlot',
		'app.market',
		'app.exchange',
		'app.data_banks_intraday',
		'app.instrument',
		'app.sector',
		'app.corporate_action',
		'app.data_banks_eod',
		'app.fundamental',
		'app.fundamental_meta',
		'app.fundamental_meta_group',
		'app.index_value',
		'app.market_stat',
		'app.stat'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DataBankOddlot = ClassRegistry::init('DataBankOddlot');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DataBankOddlot);

		parent::tearDown();
	}

}
