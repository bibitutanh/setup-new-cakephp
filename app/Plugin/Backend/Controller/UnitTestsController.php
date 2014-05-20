<?php
App::uses('BackendAppController','Backend.Controller');

class UnitTestsController extends BackendAppController {

	public function admin_index() {
		
		$this->set('testUrl',Router::url('/',true).'test.php');
	}
}