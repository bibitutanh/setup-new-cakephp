<?php
class AppController extends Controller{
	var $components = array( 'Auth', 'Session', 'RequestHandler' );

	function isAuthorized($user)
	{
		return true;
	}

	function beforeFilter()
	{
		$this->set('model', $this->modelClass);
		$this->set('controller', Inflector::tableize($this->modelClass));
	}

	function beforeRender( )
	{
		if($this->request->is('ajax'))
			$this->layout = 'ajax';
		elseif($this->layout == 'default')
			$this->layout = 'main';
	}
}
