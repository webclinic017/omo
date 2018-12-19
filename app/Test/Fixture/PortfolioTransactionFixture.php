<?php
/**
 * PortfolioTransactionFixture
 *
 */
class PortfolioTransactionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'portfolio_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'instrument_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'transaction_type_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => '1-buy
2-sell
3-watch
4-bonus
5-withdraw
6-deposit'),
		'amount' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => 'number of shares. in case of deposit/withdraw it will be 1'),
		'rate' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => 'share price/ deposit withdraw amount/ incase of bonus it will be 0'),
		'transaction_time' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'comission' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'portfolio_id' => 1,
			'instrument_id' => 1,
			'transaction_type_id' => 1,
			'amount' => 1,
			'rate' => 1,
			'transaction_time' => '2014-08-05 11:38:15',
			'comission' => 1
		),
	);

}
