<?php
/**
 * DataBanksIntradayFixture
 *
 */
class DataBanksIntradayFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'market_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'instrument_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'quote_bases' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'open_price' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'pub_last_traded_price' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'spot_last_traded_price' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'high_price' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'low_price' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'close_price' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'yday_close_price' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'total_trades' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'total_volume' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'total_value' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'public_total_trades' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'public_total_volume' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'public_total_value' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'spot_total_trades' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'spot_total_volume' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'spot_total_value' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'lm_date_time' => array('type' => 'datetime', 'null' => false, 'default' => null, 'key' => 'index'),
		'trade_time' => array('type' => 'time', 'null' => false, 'default' => null, 'key' => 'index'),
		'trade_date' => array('type' => 'date', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_data_banks_intradays_markets1_idx' => array('column' => 'market_id', 'unique' => 0),
			'fk_data_banks_intradays_instruments1_idx' => array('column' => 'instrument_id', 'unique' => 0),
			'lm_date_time' => array('column' => 'lm_date_time', 'unique' => 0),
			'trade_time' => array('column' => 'trade_time', 'unique' => 0),
			'trade_date' => array('column' => 'trade_date', 'unique' => 0)
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
			'quote_bases' => 'Lorem ip',
			'open_price' => 1,
			'pub_last_traded_price' => 1,
			'spot_last_traded_price' => 1,
			'high_price' => 1,
			'low_price' => 1,
			'close_price' => 1,
			'yday_close_price' => 1,
			'total_trades' => 1,
			'total_volume' => 1,
			'total_value' => 1,
			'public_total_trades' => 1,
			'public_total_volume' => 1,
			'public_total_value' => 1,
			'spot_total_trades' => 1,
			'spot_total_volume' => 1,
			'spot_total_value' => 1,
			'lm_date_time' => '2014-07-14 11:12:20',
			'trade_time' => '11:12:20',
			'trade_date' => '2014-07-14'
		),
	);

}
