<?php
App::uses('ExchangesController', 'Controller');

/**
 * ExchangesController Test Case
 *
 */
class ExchangesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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

}
