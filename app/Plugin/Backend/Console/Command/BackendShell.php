<?php
App::uses('Folder','Utiltity');
App::uses('AuthComponent','Controller/Component');

class BackendShell extends AppShell {
	
	public $uses = array();

	public $tasks = array('Backend.User','Backend.Cache');
	
	public function getOptionParser() {
	    $parser = parent::getOptionParser();
		$parser->description(__d('backend','Backend Console'));

		$parser->addSubcommand('cache',array(
			'help' => __('Cache Task'),
			'parser' => $this->Cache->getOptionParser()	
		));
		
		$parser->addSubcommand('user',array(
			'help' => __d('backend',"Manage backend users"),
			'parser' => $this->User->getOptionParser()
		));
	    return $parser;
	}		
	
	public function install() {
		
		//TODO check if tables are present in db. If not, trigger schema create --plugin Backend
		
		// setup default backend user groups
		$groups = array(
			'superuser' => array('name'=>'Superuser','root'=>true),
			'admin' => array('name'=>'Administrator','root'=>false),
		);
		$BackendUserGroup = ClassRegistry::init('Backend.BackendUserGroup');
		foreach($groups as &$group) {
			$BackendUserGroup->create();
			if (!$BackendUserGroup->save(array('BackendUserGroup'=>$group))) {
				$this->out('<warning>Failed to create Backend User Group '.$group['name'].'</warning>');
			} else {
				$this->out('<success>Created Backend User Group '.$group['name'].'</success>');
			}
		}
		
		// setup superuser
		$superGroup = $BackendUserGroup->find('first',array(
			'conditions'=>array('BackendUserGroup.root'=>true))
		);
		if (!$superGroup) {
			$this->error('No root BackendUserGroup found');
		}
		
		$email = $this->in('Superuser email:','','flohax@yahoo.de');
		
		$superuser = array(
			'backend_user_group_id' => $superGroup['BackendUserGroup']['id'],
			'username' => 'superuser',
			'password' => AuthComponent::password('superPass'),
			'first_name' => 'John',
			'last_name' => 'Doe',
			'mail' => $email,
			'published' => true
		);
		
		$BackendUser = ClassRegistry::init('Backend.BackendUser');
		if (!$BackendUser->save(array('BackendUser'=>$superuser),true)) {
			$this->out('<warning>Failed to create Backend Superuser</warning>');
		} else {
			$this->out('<success>Superuser created (Password: superPass)</success>');
		}
		
	}
}
?>