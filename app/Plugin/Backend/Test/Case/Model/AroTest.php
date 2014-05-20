<?php
App::uses('Aro', 'Backend.Model');

/**
 * Aro Test Case
 *
 */
class AroTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.backend.aro',
		'plugin.backend.aco',
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
		$this->Aro = ClassRegistry::init('Backend.Aro');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Aro);

		parent::tearDown();
	}

}
