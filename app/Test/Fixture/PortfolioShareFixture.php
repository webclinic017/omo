<?php
/**
 * PortfolioShareFixture
 *
 */
class PortfolioShareFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'portfolio_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'instrument_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'no_of_shares' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'buying_price' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'buying_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'is_active' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2, 'unsigned' => false),
		'sell_price' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'sell_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'commission' => array('type' => 'float', 'null' => false, 'default' => '0.5', 'unsigned' => false),
		'exchange_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'protfolio_id' => array('column' => 'portfolio_id', 'unique' => 0)
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
			'portfolio_id' => 1,
			'instrument_id' => 1,
			'no_of_shares' => 1,
			'buying_price' => 1,
			'buying_date' => '2014-08-04 14:50:30',
			'is_active' => 1,
			'sell_price' => 1,
			'sell_date' => '2014-08-04 14:50:30',
			'commission' => 1,
			'exchange_id' => 1
		),
	);

}
