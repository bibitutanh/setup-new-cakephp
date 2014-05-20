<?php
App::uses('AppModel', 'Model');
class BackendAppModel extends AppModel {
	public $actsAs = array('Containable');
	public $components = array(
		'Acl'
	);
}
?>