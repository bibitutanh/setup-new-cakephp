<?php
App::uses('BackendAppController','Backend.Controller');

class AppearanceController extends BackendAppController {

	public $uses = array();
	
	public function admin_index() {
		$this->redirect('typo');
	}
	
	public function admin_typo() {}
	
	public function admin_form() {}
	
	public function admin_collapsable() {}
	
	//TODO sanitation. check security concerns.
	public function admin_flash($element = 'default', $message = 'Test Message') {
		
		$this->Session->setFlash($message, $element);
		
		$this->set(compact('element','message'));
	}
	
}
?>