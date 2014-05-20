<?php
App::uses('Configure','Core');

class BackendView extends View {
	
	protected $_layoutConfig = array();
	
	public function __construct($controller = null) {
		
		/*
		if (!Configure::load('layout', 'default', false))
			throw new Exception('CakeLayout configuration not found');
		
		$this->_layoutConfig = Configure::read('CakeLayout');
		*/
		parent::__construct($controller);
	}
	
	public function render($view = null, $layout = null) {
		
		/*
		if (null === $layout)
			$layout = $this->layout;
		
		$modules = $this->_getLayoutModules($layout);
		$this->set('modules', $modules);
		$this->Helpers->load('CakeLayout.Layout');
		*/
		return parent::render($view,$layout);
	}
	
	/**
	 * @param unknown_type $layout
	 * @return multitype:
	 * @deprecated
	 */
	protected function _getLayoutModules($layout) {
		
		if (!array_key_exists($layout, $this->_layoutConfig)) {
			return array();	
		}
		
		return $this->_layoutConfig[$layout];
	}
	
} 
?>