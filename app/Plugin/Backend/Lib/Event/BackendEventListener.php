<?php
App::uses('CakeEventListener', 'Event');

class BackendEventListener implements CakeEventListener {
	
	/* (non-PHPdoc)
	 * @see CakeEventListener::implementedEvents()
	 */
	public function implementedEvents() {
		
		return array(
			'Backend.Controller.Auth.onLogin' => 'onLogin',
			'Backend.Controller.Auth.onLoginFail' => 'onLoginFail',
			'Backend.Controller.Auth.onLogout' => 'onLogout',	
		);
	}
	
	/**
	 * AuthController onLoginFail
	 * @param CakeEvent $event
	 */
	public function onLoginFail(CakeEvent $event) {
		$this->log(__("Invalid login for user '%s' from IP %s", 
			strval($event->data['user']['username']),strval($event->data['ip'])),'auth');
	}

	/**
	 * AuthController onLogin
	 * @param CakeEvent $event
	 */
	public function onLogin($event) {

		$this->log(__("User '%s' just logged in", $event->data['username']),'auth');

		//Write LastLogin Date
		$event->subject()->BackendUser->id = $event->data['id'];
		$event->subject()->BackendUser->saveField('last_login',date("Y-m-d H:i:s"));
		
		//return $redirectUri;
	}

	/**
	 * AuthController onLogout
	 * @param CakeEvent $event
	 */
	public function onLogout(CakeEvent $event) {
		$this->log(__("User '%s' just logged out", $event->data['username']),'auth');
	}

	/**
	 * Log wrapper
	 * 
	 * @param string $msg
	 * @param string $type
	 * @param string $scope
	 */
	protected function log($msg, $type = 'debug', $scope = 'backend') {
		CakeLog::write($type, $msg, $scope);
	}
}