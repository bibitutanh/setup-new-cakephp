<div class="sidebar">
	<?php
	// check if view element name is passed in viewVar 'backend_sidebar_element'
	$element = ($this->get('backend_sidebar_element')) ? $this->get('backend_sidebar_element') : 'Backend.Modules/navigation/sidebar';
	// check if sidebar menu list is passed in viewVar 'backend_sidebar_menu'
	$nav = ($this->get('backend_sidebar_menu')) ? $this->get('backend_sidebar_menu') : array();
	// no sidebar menu list given and using a plugin?	
	if (!$nav && $this->params['plugin']) {
		// check if plugin has a backend-sidebar view element
		$pluginElement = Inflector::camelize($this->params['plugin']).'.backend/sidebar';
		if (isset($this->params['plugin']) && $this->elementExists($pluginElement)) {
			$element = $pluginElement;
		}
		// check if plugin has a sidebar menu list configured 
		else {
			$nav = Configure::read('Backend.Navigation.'.$this->params['plugin']);
		}
	}
	// no sidebar menu list? use default
	if (!$nav) {
		$nav = Configure::read('Backend.Navigation.default');
	}
	echo $this->element($element,array('nav'=>$nav));
	
	/*
	if($this->fetch('sidebar')) {
		echo $this->fetch('sidebar'); 
	
	} else {
		$pluginElement = Inflector::camelize($this->params['plugin']).'.backend/sidebar';
		if (isset($this->params['plugin']) && $this->elementExists($pluginElement)) {
			echo $this->element($pluginElement);
		} 
		elseif (isset($this->params['plugin']) && Configure::read('Backend.Navigation.'.$this->params['plugin'])) {
			echo $this->element('Backend.Modules/navigation/sidebar', array('nav'=>Configure::read('Backend.Navigation.'.$this->params['plugin'])));
		}
		elseif (Configure::read('Backend.Navigation.default')) {
			echo $this->element('Backend.Modules/navigation/sidebar', array('nav'=>Configure::read('Backend.Navigation.default')));
		}
		elseif (Configure::read('debug')>0) {
			echo __("No sidebar available");
		}
	}
	*/
	?>
</div>