<?php
App::uses('Aco', 'Backend.Model');

/**
 * Aco Test Case
 *
 */
class AcoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.backend.aco',
		'plugin.backend.aro',
		'plugin.backend.permission',
		'plugin.backend.aros_aco'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Aco = ClassRegistry::init('Backend.Aco');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Aco);

		parent::tearDown();
	}

}
