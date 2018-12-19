<?php
App::uses('InstrumentsController', 'Controller');

/**
 * InstrumentsController Test Case
 *
 */
class InstrumentsControllerTest extends ControllerTestCase {

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

}
