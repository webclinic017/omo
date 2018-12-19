<?php
/**
 * DataBankOddlotFixture
 *
 */
class DataBankOddlotFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'market_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'instrument_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'max_price' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'min_price' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'volume' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'trade' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'tradevalues' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'date' => array('type' => 'date', 'null' => true, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => 'CURRENT_TIMESTAMP'),
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
			'id' => 1,
			'market_id' => 1,
			'instrument_id' => 1,
			'max_price' => 1,
			'min_price' => 1,
			'volume' => 1,
			'trade' => 1,
			'tradevalues' => 1,
			'date' => '2014-07-09',
			'updated' => '2014-07-09 12:48:47'
		),
	);

}
