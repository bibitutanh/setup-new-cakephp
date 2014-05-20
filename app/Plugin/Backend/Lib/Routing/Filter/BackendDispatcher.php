<?php
App::uses('DispatcherFilter', 'Routing');

/**
 * This filter will check wheter the response was previously cached in the file system
 * and served it back to the client if appropriate.
 *
 * @package Cake.Routing.Filter
 * 
 * TODO BackendDispatcher should be flagged deprecated
 */
class BackendDispatcher extends DispatcherFilter {

/**
 * Default priority for all methods in this filter
 * This filter should run before the request gets parsed by router
 *
 * @var int
 */
	//public $priority = 10;

/**
 * Checks whether the response was cached and set the body accordingly.
 *
 * @param CakeEvent $event containing the request and response object
 * @return CakeResponse with cached content if found, null otherwise
 */
	public function beforeDispatch($event) {
		
		$request = $event->data['request'];
		
		if (isset($request->params['prefix']) && $request->params['prefix'] == 'admin' && !defined('BACKEND')) {
			define('BACKEND', true);
		}
		
	}

}
