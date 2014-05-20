<?php
App::uses('BackendUserGroup', 'Backend.Model');

/**
 * BackendUserGroup Test Case
 *
 */
class BackendUserGroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.backend.backend_user_group',
		'plugin.backend.backend_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BackendUserGroup = ClassRegistry::init('Backend.BackendUserGroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BackendUserGroup);

		parent::tearDown();
	}

}
