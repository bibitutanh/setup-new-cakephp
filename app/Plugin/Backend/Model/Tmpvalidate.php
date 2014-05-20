<?php
App::uses('BackendAppModel','Backend.Model');
App::uses('AuthComponent','Controller/Component');

/**
 * @property AclBehavior $Acl
 */
class Tmpvalidate extends BackendAppModel {

	public $actsAs = array('Containable', 'Acl' => array('type' => 'requester'));


}