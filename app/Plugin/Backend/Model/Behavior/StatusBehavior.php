<?php
class StatusBehavior extends ModelBehavior {
	
	public function setup($model) {

		if (!isset($this->settings[$model->alias])) {
			if (method_exists($model, 'getStatusMap')) {
				$map = $model->getStatusMap();
			} else {	
				if (Configure::read('debug')>0)
					throw new CakeException(sprintf("Model %s has no method getStatusMap",$model->alias));
				
				$map = array();
			}
			$this->settings[$model->alias] = $map;
		}
	}
	
	public function getStatusText(Model $model, $status = null, $field = 'status') {

		$map = $this->_getStatusMap($model);
		if (!$map)
			return false;
		
		if ($status === null) {
			if (!isset($map[$field]))
				return false;
		
			return $map[$field];
		}
		
		if (is_bool($status))
			$status = intval($status);
		
		if (!isset($map[$field]) || !array_key_exists($status, $map[$field])) {
			return 'Unknown Status: '.$status;
		}
		
		return $map[$field][$status];
	}
	
	protected function _getStatusMap(Model $model) {
		return $this->settings[$model->alias];
	}
	
	public function afterFind($model, $results, $primary) {

		$map = $this->_getStatusMap($model);
		if (!$map)
			return $results;
		
		if ($primary) {

			// defined status fields
			$fields = array_keys($map);
			
			foreach($results as &$result) {
				foreach($fields as $field) {
					if (!isset($result[$model->alias][$field]))
						continue;
					
					$result['Status'][$field] = $this->getStatusText($model, $result[$model->alias][$field], $field);
				}
			}
			
		}
		
		return $results;
	}
}