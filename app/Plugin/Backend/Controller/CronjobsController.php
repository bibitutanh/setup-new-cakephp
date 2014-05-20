<?php
App::uses('File','Utility');

class CronjobsController extends BackendAppController {
	
	public $uses = array();
	
	public $cronjobs = array();
	
	public $cronlogLimit = 100;
	
	public function beforeFilter() {
		parent::beforeFilter();
	
		$this->Auth->allow('run','run_all');
		
		$this->cronjobs = array(
			'daily' => array(
				'enabled' => true,
				'url' => '/backend/cron/daily',
				'interval' => 1*DAY,
				'expectOk' => 'OK',
				'expectFail' => 'FAILURE',
				'expectError' => 'ERROR',
			),
			'weekly' => array(
				'enabled' => true,
				'url' => '/backend/cron/weekly',
				'interval' => 1*WEEK,
				'expectOk' => 'OK',
				'expectFail' => 'FAILURE',
				'expectError' => 'ERROR',
			),
			'monthly' => array(
				'enabled' => true,
				'url' => '/backend/cron/monthly',
				'interval' => 1*MONTH,
				'expectOk' => 'OK',
				'expectFail' => 'FAILURE',
				'expectError' => 'ERROR',
			),
		);
		
		if (Configure::read('Backend.Cronjob')) {
			$this->cronjobs = am($this->cronjobs, (array) Configure::read('Backend.Cronjob'));
		}
	}
	
	public function run($id = null) {
		
		$this->autoRender = false;
		$this->response->type('text');
		
		// get cronjob
		if (!isset($this->cronjobs[$id])) {
			$this->response->statusCode(400);
			$this->response->body('NOTFOUND');
			return;
		}
			
		$force = isset($this->passedArgs['force']) ? $this->passedArgs['force'] : false;
		list($result, $stats) = $this->_run($id, $this->cronjobs[$id], $force);
		
		$this->response->body($result['response']);
	}
	
	public function run_all() {
	
		$this->autoRender = false;
		$this->response->type('text');

		$allStats = array();
		foreach($this->cronjobs as $id => $config) {
			if (!$config['enabled'])
				continue;
			
			$allStats[$id] = $this->_run($id, $config);
		}
		
		$this->response->body(count($allStats));
	}
	
	public function admin_index() {
		
		$cronjobs = $this->cronjobs;
		$stats = array();
		foreach($cronjobs as $id => $config) {
			$_stats = $this->_getStats($id);
			if (!isset($_stats[0])) {
				$stats[$id] = false;
				continue;
			}
			$stats[$id] = $_stats[0];
 		}
		$this->set(compact('cronjobs','stats'));
	}
	
	public function admin_view($id = null) {

		if (!isset($this->cronjobs[$id]))
			throw new NotFoundException("Cronjob $id not found");
		
		$cronjob = $this->cronjobs[$id];
		$stats = $this->_getStats($id);
		$this->set(compact('id','cronjob','stats'));
	}
	
	public function admin_run($id = null) {

		if (!isset($this->cronjobs[$id]))
			throw new NotFoundException("Cronjob $id not found");
		
		$force = isset($this->passedArgs['force']) ? $this->passedArgs['force'] : false;
		
		list($result, $stats) = $this->_run($id, $this->cronjobs[$id], $force);
		
		$this->Session->setFlash($result['message']);
		$this->redirect(array('action'=>'view',$id));
	}
	
	public function admin_run_all() {

		$allStats = array();
		foreach($this->cronjobs as $id => $config) {
			if (!$config['enabled'])
				continue;
			
			$allStats[$id] = $this->_run($id, $config);
		}
		
		$this->set(compact('allStats'));
	}
	
	protected function _run($id, $config, $force = false) {

		// open stats
		$stats = $this->_getStats($id);
		
		// check interval
		if (isset($stats[0])) {
			$last = $stats[0];
			if (!$force && $last['time'] + $config['interval'] > time()) {
				$wait = $last['time'] + $config['interval'] - time();
				$last['wait'] = $wait;
				$last['message'] = sprintf("Cronjob timeout. Wait %+d seconds",$wait);
				return array($last, $stats);
			}
		}
		
		try {
			// request cron
			$url = Router::url($config['url'],true);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			$info = curl_getinfo($ch);
			curl_close($ch);
		} catch(Exception $e) {
			CakeLog::critical("Cronjob $id failed", 'cron');
			$response = $config['expectError'];
		}
		
		// map results
		switch(true) {
			case ($response == $config['expectError']):
			case $info['http_code'] >= 400:
				$message = 'Cronjob returned errors';
				break;
			case $response == $config['expectFail']:
				$message = 'Cronjob failed';
				break;
			case $info['http_code'] == 200:
			case $response == $config['expectOk']:
				$message = 'Cronjob successful';
				break;
			default:
				$message = 'Cronjob response unknown: '.$response;
				$response = 'UNKNOWN';
				break;
		}
		
		$result = array(
			'time' => time(),
			'response' => $response,
			'message' => $message,
			'time_elapsed' => $info['total_time'],
		);
		
		// write stats
		array_unshift($stats, $result);
		$stats = array_slice($stats,0,$this->cronlogLimit);
		$this->_setStats($id, $stats);
		
		return array($result, $stats);
	}
	
	protected function _getStats($id) {

		$stats = array();
		$path = TMP."backend".DS."cron-".$id.".stat";
		$File = new File($path, true);
		$content = $File->read();
		if ($content) {
			$stats = unserialize($content);
		}
		$File->close();
		return $stats;
	}
	
	protected function _setStats($id, $stats = array()) {
			
		$path = TMP."backend".DS."cron-".$id.".stat";
		$File = new File($path, true);
		$File->write(serialize($stats));
		$File->close();
	}
}