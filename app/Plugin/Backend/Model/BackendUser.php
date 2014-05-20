<?php
App::uses('BackendAppModel','Backend.Model');
App::uses('AuthComponent','Controller/Component');

/**
 * @property AclBehavior $Acl
 */
class BackendUser extends BackendAppModel {

	public $actsAs = array('Containable', 'Acl' => array('type' => 'requester'));

	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'This username is already taken'
			),
		),
		'mail' => array(
			'emailCreate' => array(
				'rule' => array('email'),
				'required' => true,
				'on' => 'create',
				'message' => 'Enter a valid email address'
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Enter a valid email address'
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'This email address is already taken',
			)
		),
		'pass_old' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty')
			)
		),
		'password' => array(
			'minLength' => array(
	            'rule'    => array('minLength', '3'),
	            'message' => 'Minimum 3 characters long',
				'allowEmpty' => true
			)
		),
		/*
		'password2' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			)
		),
		*/
		'first_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty')
			)
		),
		'last_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty')
			)
		),
	);

	public $belongsTo = array(
		'BackendUserGroup' => array(
			'className' => 'Backend.BackendUserGroup'
		)
	);

	public function __construct($id=false,$table=null,$ds=null) {

		if (!Configure::read('Backend.Acl.enabled')) {
			unset($this->actsAs['Acl']);
		}

		parent::__construct($id,$table,$ds);
	}

	public function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}

		if (isset($this->data[$this->alias]['backend_user_group_id'])) {
			$groupId = $this->data[$this->alias]['backend_user_group_id'];
		} else {
			$groupId = $this->field('backend_user_group_id');
		}
		if (!$groupId) {
			return null;
		} else {
			return array('BackendUserGroup' => array('id' => $groupId));
		}

	}

	public function bindNode($user) {
		$user = array_pop($user);
		return array('model' => 'BackendUserGroup', 'foreign_key' => $user['backend_user_group_id']);
	}

	public function beforeValidate($options = array()) {
		//change password
		if (isset($this->data[$this->alias]['pass_old'])) {
			$oldPass = AuthComponent::password($this->data[$this->alias]['pass_old']);
			#$this->id = $this->data[$this->alias]['id'];
			#$this->Behaviors->disable('*');
			if (!$this->find('first',array(
				'recursive' => -1,
				'conditions'=>array(
					'id' => $this->data[$this->alias]['id'],
					'password' => $oldPass
				)
			))) {
				$this->invalidate('pass_old',__d('backend',"The current password does not match"));
			}
		}

		return true;
	}

	public function beforeSave($options = array()) {
		//when password field
		if (isset($this->data[$this->alias]['password']) && isset($this->data[$this->alias]['password2'])) {
			if (empty($this->data[$this->alias]['password']) && empty($this->data[$this->alias]['password2'])) {
				unset($this->data[$this->alias]['password']);
				unset($this->data[$this->alias]['password2']);
			} elseif (!empty($this->data[$this->alias]['password']) ) {
				if ($this->data[$this->alias]['password'] != $this->data[$this->alias]['password2']) {
					$this->invalidate('password',__d('backend',"The passwords do not match"));
					$this->invalidate('password2',__d('backend',"The passwords do not match"));
					$this->data[$this->alias]['password2'] = null;
					return false;
				}
			}
		} elseif (isset($this->data[$this->alias]['password'])) {
			$this->invalidate('password', __d('backend','Password verification not submitted'));
			$this->invalidate('password2', __d('backend','Password verification not submitted'));
			return false;
		}

		if (isset($this->data[$this->alias]['password']) && !empty($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}

	public function setupSuperuser($data) {

		$data[$this->alias]['id'] = null;
		$data[$this->alias]['backend_user_group_id'] = null;
		$data[$this->alias]['published'] = false;

		$this->create();
		return $this->save($data);
	}

}
?>