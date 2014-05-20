<?php
class SystemController extends BackendAppController {
	
	public $uses = array();
	
	public function admin_index() {
	
		$tabs = array(
			array(
				'title'=>__d('backend',"CAKE Globals"),
				'type'=>'ajax',
				'content'=>array('action'=>'globals')
			),
			array(
				'title'=>__d('backend',"PHP Info"),
				'type'=>'ajax',
				'content'=>array('action'=>'phpinfo')
			),
			array(
				'title'=>__d('backend',"Loaded Plugins"),
				'type'=>'ajax',
				'content'=>array('action'=>'plugins')
			),
		);
		$this->set(compact('tabs'));
	}

/**
 * Display PHPINFO
 * 
 * @see http://www.mainelydesign.com/blog/view/displaying-phpinfo-without-css-styles
 * @param int $what PHP Info option
 */	
	public function admin_phpinfo($what = INFO_ALL) {
		ob_start();
		phpinfo($what);
		$pinfo = ob_get_contents();
		ob_end_clean();
		 
		$phpinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
		
		$this->set(compact('phpinfo'));
	}

/**
 * Displays CAKE PHP Global constants
 */	
	public function admin_globals() {
		
		$globals = array(
			'APP','APP_DIR','APPLIBS','CACHE','CAKE','CAKE_CORE_INCLUDE_PATH','CORE_PATH','CSS','CSS_URL',
			'DS','FULL_BASE_URL','IMAGES','IMAGES_URL','JS','JS_URL','LOGS','ROOT','TESTS',
			'TMP', 'VENDORS','WEBROOT_DIR','WWW_ROOT'
		);
		
		$this->set(compact('globals'));
	}

/**
 * Displays information about loaded Cake plugins
 */	
	public function admin_plugins() {
		
		$plugins = CakePlugin::loaded();
		
		$this->set(compact('plugins'));
	}
	
	public function admin_datetime() {
		
		$data = array();
		
		$data['dateDefaultTimezoneGet'] = date_default_timezone_get();
		$data['dateTimeZoneIniGet'] = ini_get('date.timezone');
		
		$this->set(compact('data'));
	}
	
	public function admin_session() {
		
		$session = $this->Session->read();
		$this->set(compact('session'));
	}
	
	public function admin_config() {
		
		$config = Configure::read();
		$this->set(compact('config'));
	}
	
}