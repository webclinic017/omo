<?php
/**
 * IndexValueFixture
 *
 */
class IndexValueFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'market_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'index_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'capital_value' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'deviation' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'percentage_deviation' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'date_time' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_index_values_markets1_idx' => array('column' => 'market_id', 'unique' => 0),
			'fk_index_values_indexes1_idx' => array('column' => 'index_id', 'unique' => 0)
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
			'index_id' => 1,
			'capital_value' => 1,
			'deviation' => 1,
			'percentage_deviation' => 1,
			'date_time' => '2014-07-10 11:59:39'
		),
	);

}
