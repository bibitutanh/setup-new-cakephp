<?php
App::uses('BackendAppController','Backend.Controller');

/**
 * Dispatch backend cronjobs
 * 
 * @TODO Make use of event system here
 */
class CronController extends BackendAppController {
	
	public function beforeFilter() {
		
		$this->autoRender = false;
		$this->response->type('text');
		
		$this->Auth->allow('daily','weekly','monthly');
	}
	
	public function daily() {
		$this->_do('daily');
	}
	
	public function weekly() {
		$this->_do('weekly');
	}
	
	public function monthly() {
		$this->_do('mothly');
	}
	
	protected function _do($interval) {
		
		$this->_doLogRotation($interval);
		
		$this->response->body('OK');
	}
	
	protected function _doLogRotation($interval) {
		
		App::uses('LogRotation','Backend.Log');
		
		foreach((array) Configure::read('Backend.LogRotation') as $alias => $config) {
			if (!isset($config['schedule']) || $config['schedule'] != $interval)
				continue;
			
			$L = new LogRotation($config);
			$L->rotate();
		}
	}
}