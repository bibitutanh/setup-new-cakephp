<?php
/**
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('BaseAuthorize', 'Controller/Component/Auth');
App::uses('BackendUser','Backend.Model');

class BackendAuthorize extends BaseAuthorize {

/**
 * Checks user authorization using a controller callback.
 *
 * @param array $user Active user data
 * @param CakeRequest $request
 * @return boolean
 */
	public function authorize($user, CakeRequest $request) {
		
		/*
		if (method_exists($this->_Controller, 'isBackendAuthorized')) {
			return (bool)$this->_Controller->isBackendAuthorized($user);
		}
		
		if (isset($request->params['admin'])) {
			return ($user && $user['root']) ? true : false;
		}
		*/
		
		$Acl = $this->_Collection->load('Acl');
		$user = array('Backend.BackendUser' => $user);
		return $Acl->check($user, $this->action($request));
	}

}
