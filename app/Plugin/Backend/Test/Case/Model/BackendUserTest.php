<?php
App::uses('BackendUser', 'Backend.Model');
App::uses('AuthComponent','Controller/Component');

/**
 * BackendUser Test Case
 *
 */
class BackendUserTest extends CakeTestCase {

	public $fixtures = array(
		'plugin.backend.backend_user'
	);

	public $dropTables = true;

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		// $this->BackendUser = ClassRegistry::init('Backend.BackendUser');
	}

	public function testAdd() {
		//Scenario: Simple add with Username only, no mail
		//MUST FAIL
		$data = array(
			'username' => 'test_add_1',
		);
		$this->BackendUser->create();
		$result = $this->BackendUser->save(array('BackendUser'=>$data));
		$this->assertFalse($result);
		$this->assertTrue(array_key_exists('mail', $this->BackendUser->validationErrors));

		//Scenario: Simple add with Username only
		//MUST VALIDATE
		$data = array(
			'username' => 'test_add_1',
			'mail' => 'test@example.com'
		);
		$this->BackendUser->create();
		$result = $this->BackendUser->save(array('BackendUser'=>$data));
		$this->assertTrue(is_array($result));

		//Scenario: Simple add with Username and password
		//MUST FAIL
		$data = array(
			'username' => 'test_add_2',
			'password' => 'my_test_password',
			'mail' => 'test2@example.com',
		);
		$this->BackendUser->create();
		$result = $this->BackendUser->save(array('BackendUser'=>$data));
		$this->assertFalse($result);
		$this->assertTrue(array_key_exists('password', $this->BackendUser->validationErrors));
		$this->assertTrue(array_key_exists('password2', $this->BackendUser->validationErrors));


		//Scenario: Simple add with Username and password
		//MUST FAIL
		$data = array(
			'username' => 'test_add_2',
			'password' => 'my_test_password',
			'password2' => '',
			'mail' => 'test2@example.com',
		);
		$this->BackendUser->create();
		$result = $this->BackendUser->save(array('BackendUser'=>$data));
		$this->assertFalse($result);
		$this->assertTrue(array_key_exists('password', $this->BackendUser->validationErrors));
		$this->assertTrue(array_key_exists('password2', $this->BackendUser->validationErrors));

		//Scenario: Simple add with Username and password
		//MUST FAIL
		$data = array(
			'username' => 'test_add_2',
			'password' => 'my_test_password',
			'password2' => 'wrong_test_password',
			'mail' => 'test2@example.com',
		);
		$this->BackendUser->create();
		$result = $this->BackendUser->save(array('BackendUser'=>$data));
		$this->assertFalse($result);
		$this->assertTrue(array_key_exists('password', $this->BackendUser->validationErrors));
		$this->assertTrue(array_key_exists('password2', $this->BackendUser->validationErrors));

	}

	public function testEdit() {

		$user = $this->BackendUser->read(null, 1);

		// Scenario: Update with password field set, no password set.
		$update = array(
			'id' => $user['BackendUser']['id'],
			'password' => '',
		);
		$result = $this->BackendUser->save($update);
		$this->assertEqual($result, false);
		$this->assertTrue(array_key_exists('password', $this->BackendUser->validationErrors));
		$this->assertTrue(array_key_exists('password2', $this->BackendUser->validationErrors));

		// Scenario: Update with password field set, password set.
		$update = array(
				'id' => $user['BackendUser']['id'],
				'password' => 'mypassword',
		);
		$result = $this->BackendUser->save($update);
		$this->assertEqual($result, false);
		//$this->assertTrue(array_key_exists('password', $this->BackendUser->validationErrors));
		$this->assertTrue(array_key_exists('password2', $this->BackendUser->validationErrors));

		// Scenario: Update with password and password2 field set, no passwords set.
		$update = array(
				'id' => $user['BackendUser']['id'],
				'password' => '',
				'password2' => ''
		);
		$result = $this->BackendUser->save($update);
		$this->assertTrue(is_array($result));

		// Scenario: Update with password field set, password set, no password2 set.
		$update = array(
				'id' => $user['BackendUser']['id'],
				'password' => 'mypassword',
				'password2' => ''
		);
		$result = $this->BackendUser->save($update);
		$this->assertEqual($result, false);
		$this->assertTrue(array_key_exists('password', $this->BackendUser->validationErrors));
		$this->assertTrue(array_key_exists('password2', $this->BackendUser->validationErrors));

		// Scenario: Update with password field set, password set, wrong password2 set.
		$update = array(
				'id' => $user['BackendUser']['id'],
				'password' => 'mypassword',
				'password2' => 'yyyy'
		);
		$result = $this->BackendUser->save($update);
		$this->assertEqual($result, false);
		$this->assertTrue(array_key_exists('password', $this->BackendUser->validationErrors));
		$this->assertTrue(array_key_exists('password2', $this->BackendUser->validationErrors));


		// Scenario: Update with password field set, password set, password2 set.
		$update = array(
				'id' => $user['BackendUser']['id'],
				'password' => 'mypassword',
				'password2' => 'mypassword'
		);
		$result = $this->BackendUser->save($update);
		$this->assertTrue(is_array($result));
		$this->assertEqual($result['BackendUser']['password'], AuthComponent::password('mypassword'));
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BackendUser);

		parent::tearDown();
	}

}
