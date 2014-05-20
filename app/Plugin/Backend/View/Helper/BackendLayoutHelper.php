<?php
App::uses('AppHelper','View/Helper');

/**
 * Backend Layout Helper
 */
class BackendLayoutHelper extends AppHelper {

	public $uses = array('Backend.BackendHtml');
	
	/**
	 * @param View $View
	 * @param array $settings
	 * @see View::__construct()
	 */
	public function __construct($View,$settings = array()) {
		parent::__construct($View,$settings);
		$this->plugin = &$this->_View->plugin;
	}
	
	/**
	 * Wrapper function for View::fetch()
	 * 
	 * Checks for custom elements in app and plugin view paths,
	 * if view block is empty
	 * 
	 * @param string $block View block name
	 * @param string $default Default content
	 * @return string View content
	 */
	public function fetch($block, $default = '', $ignorePlugin = false) {
		
		$contents = $this->_View->fetch($block);
		if ($contents)
			return $contents;
		
		// check app & plugin for custom layout elements
		// otherwise fallback to backend layout elements
		
		$paths = array();
		$paths[] = 'Backend.layout/backend/'.$block;
		if ($this->plugin && !$ignorePlugin && $this->plugin != 'Backend') {
			$paths[] = $this->plugin.'.layout/backend/'.$block;
		}
		$paths[] = 'layout/backend/'.$block;
		
		$_custom = $this->_fetchFirst(array_reverse($paths));
		if ($_custom)
			return $_custom;
		
		return $default;
	}
	
	/**
	 * Return first element of elements in $paths, if it exists
	 * 
	 * @param array $paths List of element paths
	 * @param array $data Element data
	 * @param array $options Element options
	 * @return string
	 */
	protected function _fetchFirst($paths, $data = array(), $options = array()) {

		for ($i=0;$i<count($paths);$i++) {
			if ($this->_View->elementExists($paths[$i]))
				return $this->_View->element($paths[$i],$data,$options);
		}
		return "";
	}

	/**
	 * Return all elements in $paths, if they exist
	 *
	 * @param array $paths List of element paths
	 * @param array $data Element data
	 * @param array $options Element options
	 * @return string
	 */
	protected function _fetchAll($paths, $data = array(), $options = array()) {

		$out = "";
		for ($i=0;$i<count($paths);$i++) {
			if ($this->_View->elementExists($paths[$i])) {
				$out .= $this->_View->element($paths[$i],$data,$options);
			}
		}
		return $out;
	}
	
	/**
	 * Fetches the css for backend layouts
	 * Load order: backend, [plugin,] app
	 * 
	 * @return string Html content for <head>
	 */
	public function css() {
		
		$paths = array();
		$paths[] = 'Backend.layout/backend/css';
		if ($this->plugin && $this->plugin != 'Backend') {
			$paths[] = $this->plugin.'.layout/backend/css';
		}
		$paths[] = 'layout/backend/css';
		return $this->_fetchAll($paths);
	}

	/**
	 * Fetches the scripts for backend layouts
	 *
	 * @return string Html content for <head>
	 */
	public function script() {
		$out = $this->_View->element('Backend.layout/backend/scripts');
		return $out;
	}
}