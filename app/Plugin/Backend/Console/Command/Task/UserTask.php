<?php
App::uses('ClassRegistry','Utility');

class UserTask extends AppShell {
	
	public $UserModel;
	
	public function getOptionParser() {
	    $parser = parent::getOptionParser();
		$parser->description(__d('backend',"Mange UserModels"));
		
		$parser->addArgument('command',array(
			'help' => 'Command',
			'required' => true,
			'choices' => array('add','edit','delete')
		));
		
		$parser->addArgument('username',array(
			'help' 	=> __d('backend',"Username"),
			'required' => true,
		));
		
		$parser->addOption('password',array(
			'help' 	=> __d('backend',"Password"),
			'short' => 'p'
		));
		$parser->addOption('mail',array(
			'help' 	=> __d('backend',"Mail"),
			'short' => 'm'
		));
		$parser->addOption('root',array(
			'help' 	=> __d('backend',"Is SuperUser"),
			'short' => 'r',
			'boolean' => true
		));
		
	    return $parser;
	}
	
	/*
	public function initialize() {
		parent::initialize();
		
		$this->out("---STARTING UP---");
	}
	*/
	
	public function main() {
		$this->UserModel =& ClassRegistry::init('Backend.BackendUser');
		
		if (empty($this->args)) {
			$action = $this->in(__d('backend',"What do you wann do?"),array('add'),'add');
		} else {
			$action = array_shift($this->args);
		}
		$this->{$action}();
	}
	
	public function add() {
		Configure::write('debug',2);
		
		$userName = $this->args[0];
		$this->out(__d('backend',"Creating user '%s'",$userName));
		
		if (!isset($this->params['root'])) {
			$this->params['root'] = false;
		}
		
		if (!isset($this->params['mail'])) {
			$this->params['mail'] = $this->in(__d('backend',"Enter Mail:"),null, $userName.'@localhost');
		}
		
		if (!isset($this->params['first_name'])) {
			$this->params['first_name'] = $this->in(__d('backend',"Enter FirstName:"),null,'Backend');
		}
		
		if (!isset($this->params['last_name'])) {
			$this->params['last_name'] = $this->in(__d('backend',"Enter LastName:"),null,'Admin');
		}
		
		if (!isset($this->params['password'])) {
			$this->params['password'] = $this->in(__d('backend',"Enter Password:"),null,'adminPass');
		}
		
		do {
			$this->params['password2'] = $this->in(__d('backend',"Retype your Password:"),null,'adminPass');
		} while($this->params['password'] != $this->params['password2']);
		
		$data = $this->params;
		unset($data['help'],$data['quiet'], $data['verbose']);
		
		$data['username'] = $userName;
		$data['published'] = true;
		
		App::uses('AuthComponent','Controller/Component');
		$this->out(AuthComponent::password($data['password']));
		
		$this->hr();
		foreach($data as $key => $val) {
			$this->out($key . ":" . $val);
		}
		$this->hr();
		
		$this->UserModel->create();
		$this->UserModel->set(array($this->UserModel->alias=>$data));
		if (!$this->UserModel->save()) {
			foreach($this->UserModel->validationErrors as $field => $errors) {
				foreach($errors as $error) {
					$this->out($field . ": ".$error);
				}
			}
			$this->error(__d('backend',"Failed to save User"));
		} else {
			$this->out(__d('backend',"User '%s' saved",$data['username']));
		}
		
	}
	
	public function edit() {
		$userName = $this->args[0];
		$this->out(__d('backend',"Not implemented - Editing user '%s'",$userName));
	}
	
	public function delete() {
		$userName = $this->args[0];
		$this->out(__d('backend',"Not implemented - Deleting user '%s'",$userName));
	}
}
?>