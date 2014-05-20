<?php
App::uses('BackendAppController','Backend.Controller');

/**
 * @property Aro $Aro
 * @property Aco $Aco
 * @property Permission $Permission
 */
class AclController extends BackendAppController {
	
	public $uses = array('Aro','Aco','Permission');
	
	public function admin_index($parent_id = 1) {
		
		$this->Aro->recursive = -1;
		$aros = $this->Aro->find('all',array(
			'conditions' => array('Aro.parent_id'=>'')		
		));
		
		$this->Aco->recursive = -1;
		
		$acos = $this->Aco->find('all',array(
				'conditions' => array('or' => array('Aco.parent_id' => $parent_id, 'Aco.id'=>array(1,$parent_id))),
				'order'=>'Aco.lft ASC')
		);
		
		$this->Permission->recursive = -1;
		$permissions = $this->Permission->find('all');
		
		$this->set(compact('aros','acos','permissions'));
	}
	
	public function admin_allow($aro_id = null, $aco_id = null, $method = null) {
		$this->_updateNode($aro_id, $aco_id, 'allow', $method);
	}
	
	public function admin_deny($aro_id = null, $aco_id = null, $method = null) {
		$this->_updateNode($aro_id, $aco_id, 'deny', $method);
	}
	
	public function admin_reset($aro_id = null, $aco_id = null, $method = null) {
		$this->_updateNode($aro_id, $aco_id, 'reset', $method);
	}
	
	protected function _updateNode($aro_id = null, $aco_id = null, $mode = null, $method = null) {
		
		if (!$aro_id || !$aco_id || !$mode || !$method)
			throw new CakeException(__('Invalid request'));
		
		$node = $this->Permission->find('first',array(
			'conditions' => array('Permission.aro_id'=>$aro_id,'Permission.aco_id'=>$aco_id)	
		));
		
		$modeMap = array(
			'allow' => 1,
			'reset' => 0,
			'deny' => -1	
		);
		if (!array_key_exists($mode,$modeMap))
			throw new CakeException(__('Invalid update mode'));
		
		$perms = array();
		foreach(array('create','read','update','delete') as $_method) {
			$perm = ($node) ? $node['Permission']['_'.$_method] : 0;
			if ($method == $_method)
				$perm = $modeMap[$mode];
			
			$perms[$_method] = $perm;
		}
		
		$permission = array(
			'id' => ($node) ? $node['Permission']['id'] : null,
			'aro_id' => $aro_id,
			'aco_id' => $aco_id,
			'_create' => $perms['create'],
			'_read' => $perms['read'],
			'_update' => $perms['update'],
			'_delete' => $perms['delete'],
		);
		$this->Permission->create();
		if ($this->Permission->save(array('Permission'=>$permission))) {
			$this->Session->setFlash("Updated to $mode",'success');
		} else {
			$this->Session->setFlash("Failed to update to mode $mode",'error');
		}
		$this->redirect($this->referer());
	}
	
}