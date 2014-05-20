<?php
App::uses('ArosAco', 'Backend.Model');

/**
 * ArosAco Test Case
 *
 */
class ArosAcoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.backend.aros_aco',
		'plugin.backend.aro',
		'plugin.backend.aco',
		'plugin.backend.permission'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ArosAco = ClassRegistry::init('Backend.ArosAco');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ArosAco);

		parent::tearDown();
	}

}
