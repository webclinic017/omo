<?php
/**
 * BrokerFixture
 *
 */
class BrokerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'broker_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 250, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'member_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 250, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'address' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 250, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'mob' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 250, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'broker_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 250, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'broker_password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 250, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'registration_date' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'last_login_time' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'allow_IP' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'message_for_user' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'default_commision' => array('type' => 'float', 'null' => false, 'default' => '0.5', 'unsigned' => false),
		'terminal1' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'terminal2' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'totalorderTerminal1' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'totalorderTerminal2' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'allow_day_trading' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'broker_name' => 'Lorem ipsum dolor sit amet',
			'member_id' => 'Lorem ipsum dolor sit amet',
			'address' => 'Lorem ipsum dolor sit amet',
			'mob' => 'Lorem ipsum dolor sit amet',
			'broker_user_id' => 'Lorem ipsum dolor sit amet',
			'broker_password' => 'Lorem ipsum dolor sit amet',
			'registration_date' => 1,
			'last_login_time' => 1,
			'allow_IP' => 'Lorem ipsum dolor sit amet',
			'message_for_user' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'default_commision' => 1,
			'terminal1' => 'Lorem ip',
			'terminal2' => 'Lorem ip',
			'totalorderTerminal1' => 1,
			'totalorderTerminal2' => 1,
			'allow_day_trading' => 1
		),
	);

}
