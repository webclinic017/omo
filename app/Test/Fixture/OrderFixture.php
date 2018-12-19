<?php
/**
 * OrderFixture
 *
 */
class OrderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 9, 'unsigned' => false, 'key' => 'index'),
		'instrument_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'no_of_shares' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'order_ref_no' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'final_price' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'buy_start_range' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'buy_end_range' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'order_place_time' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'last_update' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'drip_quantity' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'terminal' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'totalorderTerminal1' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'totalorderTerminal2' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'order_by_mobile' => array('type' => 'string', 'null' => false, 'default' => 'no', 'length' => 100, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user_id' => array('column' => 'user_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'instrument_id' => 1,
			'no_of_shares' => 1,
			'order_ref_no' => 1,
			'final_price' => 1,
			'buy_start_range' => 1,
			'buy_end_range' => 1,
			'order_place_time' => 1,
			'last_update' => 1,
			'drip_quantity' => 1,
			'terminal' => 1,
			'totalorderTerminal1' => 1,
			'totalorderTerminal2' => 1,
			'order_by_mobile' => 'Lorem ipsum dolor sit amet'
		),
	);

}
