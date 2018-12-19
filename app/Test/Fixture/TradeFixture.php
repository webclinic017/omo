<?php
/**
 * TradeFixture
 *
 */
class TradeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'market_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'TRD_SNO' => array('type' => 'biginteger', 'null' => true, 'default' => null, 'unsigned' => false),
		'TRD_TOTAL_TRADES' => array('type' => 'biginteger', 'null' => true, 'default' => null, 'unsigned' => false),
		'TRD_TOTAL_VOLUME' => array('type' => 'biginteger', 'null' => true, 'default' => null, 'unsigned' => false),
		'TRD_TOTAL_VALUE' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'TRD_LM_DATE_TIME' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'trade_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'trade_time' => array('type' => 'time', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'id' => '',
			'market_id' => 1,
			'TRD_SNO' => '',
			'TRD_TOTAL_TRADES' => '',
			'TRD_TOTAL_VOLUME' => '',
			'TRD_TOTAL_VALUE' => 1,
			'TRD_LM_DATE_TIME' => '2014-07-16 11:13:10',
			'trade_date' => '2014-07-16',
			'trade_time' => '11:13:10'
		),
	);

}
