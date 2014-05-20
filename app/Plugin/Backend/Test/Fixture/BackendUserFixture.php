<?php
/**
 * BackendUserFixture
 *
 */
class BackendUserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'root' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 127, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'first_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'last_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'mail' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'last_login' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'published' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'username' => array('column' => 'username', 'unique' => 1),
			'mail' => array('column' => 'mail', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'root' => 1,
			'username' => 'test_root',
			'password' => 'asdf',
			'first_name' => 'TestFirstName',
			'last_name' => 'TestLastName',
			'mail' => 'test_root@localhost',
			'last_login' => '',
			'published' => 1,
			'created' => '2012-09-16 19:15:39'
		),
		array(
			'id' => 2,
			'root' => 0,
			'username' => 'test_nonroot',
			'password' => 'asdf',
			'first_name' => 'TestFirstName',
			'last_name' => 'TestLastName',
			'mail' => 'test_nonroot@localhost',
			'last_login' => '',
			'published' => 1,
			'created' => '2012-09-16 19:15:39'
		),
	);

}
