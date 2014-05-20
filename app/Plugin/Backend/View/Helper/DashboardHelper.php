<?php 
class DashboardHelper extends AppHelper {
	
	public $helpers = array('Html');
	
	public $cols = 4;
	
	protected $_activeItem = null;
	
	protected $_activeSection = null;
	
	protected $_currentCol = 0;
	
	public function sectionStart($heading = null, $headingUrl = null, $options = array()) {
		
		#debug("section start");
		$this->_activeSection = uniqid('dashboard-section');
		return '<div class="row-fluid dashboard">';
	}
	
	public function sectionEnd() {
		if (!$this->_activeSection)
			return true;
		
		$this->_activeSection = null;
		return '</div>';
	}
	
	public function itemStart($heading = null, $headingUrl = array(), $options = array()) {

		#debug("item start");
		
		$this->_activeItem = uniqid('dashboard-item');
		
		$this->_View->start($this->_activeItem);
		if ($heading && $headingUrl) {
			echo $this->Html->tag('h4', $this->Html->link($heading, $headingUrl, $options));
		}
		elseif ($heading) {
			echo $this->Html->tag('h4', $heading);
		}
	}
	
	public function itemEnd() {
		if (!$this->_activeItem)
			return true;
		
		$this->_View->end();
		
		#debug("item end");
		
		$out = "";
		
		// start section, if none started
		if (!$this->_activeSection)
			$out .= $this->sectionStart();
		
		// fetch contents
		$out .= $this->Html->div('span3',
			$this->Html->div('dashboard-item', $this->_View->fetch($this->_activeItem))
		);
		
		// auto cols
		if (++$this->_currentCol % $this->cols == 0) {
			$out .= $this->sectionEnd();
		}
		
		// reset active item 
		$this->_activeItem = null;
		
		return $out;
	}
	
	public function itemFromArray($item = array()) {
		$this->itemStart($item['title'],$item['url']);
		echo $this->_View->element('Backend.dashboard/dashboard_item',compact('item'));
		return $this->itemEnd();
	}
}
?>