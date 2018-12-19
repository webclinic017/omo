<?php
App::uses('UserMeta', 'Model');

/**
 * UserMeta Test Case
 *
 */
class UserMetaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_meta',
		'app.users_information'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserMeta = ClassRegistry::init('UserMeta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserMeta);

		parent::tearDown();
	}

}
