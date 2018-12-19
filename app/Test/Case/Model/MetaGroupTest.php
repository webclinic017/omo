<?php
App::uses('MetaGroup', 'Model');

/**
 * MetaGroup Test Case
 *
 */
class MetaGroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.meta_group',
		'app.meta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MetaGroup = ClassRegistry::init('MetaGroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MetaGroup);

		parent::tearDown();
	}

}
