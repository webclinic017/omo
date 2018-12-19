<?php
/**
 * PortfolioFixture
 *
 */
class PortfolioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'key' => 'index'),
		'portfolio_value' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'cash_amount' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'portfolio_name' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'broker_fee' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'broker' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'email_alert' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2, 'unsigned' => false),
		'creation_date' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'portfolio_value' => 1,
			'cash_amount' => 1,
			'portfolio_name' => 'Lorem ipsum dolor sit amet',
			'broker_fee' => 1,
			'broker' => 'Lorem ipsum dolor sit amet',
			'email_alert' => 1,
			'creation_date' => 1
		),
	);

}
