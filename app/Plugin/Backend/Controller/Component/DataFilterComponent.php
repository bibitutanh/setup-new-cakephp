<?php
App::uses('Component','Controller');
class DataFilterComponent extends Component {
	
	public $Controller;
	
	public function initialize($controller) {
		$this->Controller = $controller;
	}
	
	public function paginate($query = null, $obj = null) {
		
		$conditions = $this->filterConditions($query);
		return $this->Controller->paginate($conditions);
	}
	
	public function filterConditions($query = null) {
		
		if ($query === null) {
			$request = $this->Controller->request;
			$query = ($request->is('post')) ? $request->data : $this->Controller->passedArgs;
		}
		
		$ignore = array('page','limit','sort','direction');
		$conditions = array();
		$query = Hash::flatten($query);
		foreach($query as $k => $v) {
			if (strlen(trim($v)) < 1)
				continue;
			
			if (in_array($k, $ignore))
				continue;
			
			// check for multiple searches
			$searches = explode(';',$v);
			foreach($searches as $search) {
				// check for operator e.g. "like: My search term"
				$op = explode(':',$search);
				if (count($op) == 1) {
					$term = $op[0];
					if (is_numeric($term) || is_bool($term))
						$op = 'eq';
					else
						$op = 'like';
						
				} else {
					list($op, $term) = $op;
				}
				$term = trim($term);
				//TODO sanitize user input
				
				switch($op) {
					case "like":
					case "%";
						$conditions[] = sprintf("%s LIKE '%%%s%%'",$k,$term);
						break;
					case "llike":
					case "l%":
						$conditions[] = sprintf("%s LIKE '%s%%'",$k,$term);
						break;
					case "rlike":
					case "r%":
						$conditions[] = sprintf("%s LIKE '%%%s'",$k,$term);
						break;
					case "equal":
					case "eq":
					case "==":
						$conditions[$k] = $term; 
						break;
				}
			}
		}
		
		return $conditions;
	}
	
}