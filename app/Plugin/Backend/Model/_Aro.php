<?php
App::uses('BackendAppModel', 'Backend.Model');
/**
 * Aro Model
 *
 * @property Aro $ParentAro
 * @property Aro $ChildAro
 * @property Aco $Aco
 */
class Aro extends BackendAppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Aco' => array(
			'className' => 'Aco',
			'joinTable' => 'aros_acos',
			'foreignKey' => 'aro_id',
			'associationForeignKey' => 'aco_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
