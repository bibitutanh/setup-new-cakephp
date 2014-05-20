<?php
App::uses('AppHelper','View/Helper');

class DataFilterHelper extends AppHelper {
	
	public $helpers = array('Html','Form');
	
	public function create($model = null) {
		return $this->Form->create($model);
	}
	
	public function end() {
		return $this->Form->end();
	}
	
	public function filter($field, $options = array()) {
		
		$this->setEntity($field);
		
		$options = am(array(
			'required' => false	,
			'div' => false,
			'label' => false,
			'type' => 'text',
			'placeholder' => __('Select %s', Inflector::humanize($this->field())),
			'class' => 'input-medium data-filter-input'
		),$options);
		
		// selects
		if ($options['type'] == 'select') {

			
			// chosen support
			if (!isset($options['empty'])) {
				$options['empty'] = '';
			}
			if ($options['empty'] !== false) {
				$options['data-chosen-allow-single-deselect'] = true;
			}
			$options['data-placeholder'] = $options['placeholder'];
		}
		
		return $this->Form->input($field, $options);
	}
}