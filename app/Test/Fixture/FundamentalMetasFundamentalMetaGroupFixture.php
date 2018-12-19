<?php
/**
 * FundamentalMetasFundamentalMetaGroupFixture
 *
 */
class FundamentalMetasFundamentalMetaGroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'fundamental_meta_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'fundamental_meta_group_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'fundamental_meta_id' => 1,
			'fundamental_meta_group_id' => 1
		),
	);

}
