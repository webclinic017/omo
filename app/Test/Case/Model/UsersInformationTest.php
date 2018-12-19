<?php
App::uses('UsersInformation', 'Model');

/**
 * UsersInformation Test Case
 *
 */
class UsersInformationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.users_information',
		'app.user',
		'app.group',
		'app.user_meta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UsersInformation = ClassRegistry::init('UsersInformation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UsersInformation);

		parent::tearDown();
	}

}
