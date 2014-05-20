<?php
App::uses('BackendAppModel','Backend.Model');
class Post extends BackendAppModel {
	public $actsAs = array('Containable');
	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'item_id',
			'conditions' => array('Comment.status' => 'Y'),
			'order' => 'Comment.id DESC',
			'limit' => '3',
			'dependent' => true
		)
	);
}