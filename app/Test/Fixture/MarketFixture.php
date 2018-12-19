<?php
/**
 * MarketFixture
 *
 */
class MarketFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'trade_date' => array('type' => 'date', 'null' => false, 'default' => null, 'key' => 'index'),
		'is_trading_day' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => '1-trading day
'),
		'market_started' => array('type' => 'time', 'null' => true, 'default' => null),
		'market_closed' => array('type' => 'time', 'null' => true, 'default' => null),
		'comments' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 124, 'collate' => 'latin1_swedish_ci', 'comment' => 'Reason of market close, delay etc', 'charset' => 'latin1'),
		'exchange_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index', 'comment' => 'DSE or CSE'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_markets_exchanges1_idx' => array('column' => 'exchange_id', 'unique' => 0),
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
			'trade_date' => '2014-07-09',
			'is_trading_day' => 1,
			'market_started' => '14:06:56',
			'market_closed' => '14:06:56',
			'comments' => 'Lorem ipsum dolor sit amet',
			'exchange_id' => 1
		),
	);

}
