<?php
/**
 * SectorIntradayFixture
 *
 */
class SectorIntradayFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'market_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'sector_list_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'index_change' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'index_change_per' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'price_change' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'volume' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'contribution' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'index_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'index_time' => array('type' => 'time', 'null' => true, 'default' => null),
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
			'market_id' => 'Lorem ipsum dolor sit amet',
			'sector_list_id' => 1,
			'index_change' => 1,
			'index_change_per' => 1,
			'price_change' => 1,
			'volume' => 1,
			'contribution' => 1,
			'index_date' => '2014-07-23',
			'index_time' => '14:47:13'
		),
	);

}
