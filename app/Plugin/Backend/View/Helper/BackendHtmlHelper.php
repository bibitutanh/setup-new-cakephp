<?php
App::uses('AppHelper','View/Helper');

/**
 * BackendHtmlHelper Helper
 * 
 * Helper class that holds some useful function to output data
 * 
 * @author Flow
 * @property HtmlHelper $Html
 * @property JqueryCollapsableHelper $JqueryCollapsable
 */
class BackendHtmlHelper extends AppHelper {

	public $helpers = array('Html');
	
	public function __construct(&$View, $settings = array())  {
		parent::__construct($View, $settings);
		
		$this->Html->loadConfig('Backend.display_tags');
	}

/**
 * Icon for boolean variable
 * 
 * @param boolean $boolVar Boolean value
 * @param mixed $params CSS class prefix string or array with html attributes
 * @deprecated
 */	
	public function iconBool($boolVar) {
		trigger_error("BackendHtmlHelper::iconBool() is deprecated. User icon() method instead",E_USER_NOTICE);
		return $this->icon($boolVar);
	}

/**
 * Generate Icon for given $params
 * 
 * @param string $name Icon name
 */	
	public function icon($name) {
		// boolean magic
		if (is_bool($name)) {
			$name = ($name === true) ? 'ok' : 'minus-sign';
		}
		return $this->Html->useTag('icon',$name);
	}
	
	public function phone($number, $attr = array(), $prompt = null) {
		
		$title = (isset($attr['title'])) ? $attr['title'] : $number;
		
		return $this->Html->link($title, 'tel:'+$number, $attr, $prompt);
	}
	
	/**
	 * Prints an array as DL list
	 * 
	 * @param array $list Array to print
	 * @param string $parent Keypath of parent node
	 */
	public function printNestedList($list, $parent = null) {
		
		$out = "";
		
		foreach($list as $k => $v) {
			$path = ($parent) ? $parent.".".$k : $k;
			if (is_array($v) || is_object($v)) {
				$out .= $this->printNestedList($v, $path);
				continue;
			}
			
			if (is_null($v)) {
				$v = 'NULL';
			}
			elseif (is_bool($v)) {
				$v = ($v === true) ? 'TRUE' : 'FALSE';
			}
			
			$tmp = "";
			$tmp .= $this->Html->tag('dt', $path."&nbsp;");
			$tmp .= $this->Html->tag('dd', $v."&nbsp;");
			
			$out .= $tmp;
		}
		
		if ($parent)
			return $out;

		return $this->Html->tag('dl',$out);
	}
	
	/**
	 * @deprecated
	 * @param unknown_type $data
	 * @param unknown_type $params
	 */
	public function collapsableNestedList($data, $params = array()) {
		trigger_error('BackendHtmlHelper::collapsableNestedList is DEPRECATED. Use JqueryCollapsable Plugin instead!',E_USER_NOTICE);
		return $this->JqueryCollapsable->collapsableNestedList($data, $params);
	}
	
}
?>
