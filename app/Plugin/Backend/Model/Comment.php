<?php
App::uses('BackendAppModel','Backend.Model');
class Comment extends BackendAppModel {
	public $belongsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'item_id',
			'counterCache' => true,
			// 'counterScope' => array( //  Optional conditions array to use for updating counter cache field.
			// 	'created >=' => date('Y-m-d', strtotime('-3'))
			// )
		)
	);
}