<?php
/**
 * DataBanksDailyFixture
 *
 */
class DataBanksDailyFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'data_banks_daily';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'market_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'instrument_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'open' => array('type' => 'float', 'null' => true, 'default' => null),
		'high' => array('type' => 'float', 'null' => true, 'default' => null),
		'low' => array('type' => 'float', 'null' => true, 'default' => null),
		'close' => array('type' => 'float', 'null' => true, 'default' => null),
		'adj_close' => array('type' => 'float', 'null' => true, 'default' => null),
		'volume' => array('type' => 'integer', 'null' => true, 'default' => null),
		'trade' => array('type' => 'integer', 'null' => true, 'default' => null),
		'tradevalues' => array('type' => 'float', 'null' => true, 'default' => null),
		'date' => array('type' => 'datetime', 'null' => true, 'default' => null, 'key' => 'index'),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => 'CURRENT_TIMESTAMP'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_data_banks_daily_markets1_idx' => array('column' => 'market_id', 'unique' => 0),
			'fk_data_banks_daily_instruments1_idx' => array('column' => 'instrument_id', 'unique' => 0),
			'date_index' => array('column' => 'date', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'market_id' => 1,
			'instrument_id' => 1,
			'open' => 1,
			'high' => 1,
			'low' => 1,
			'close' => 1,
			'adj_close' => 1,
			'volume' => 1,
			'trade' => 1,
			'tradevalues' => 1,
			'date' => '2014-03-10 15:23:14',
			'updated' => '2014-03-10 15:23:14'
		),
	);

}
