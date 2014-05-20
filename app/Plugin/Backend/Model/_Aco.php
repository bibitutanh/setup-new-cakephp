<?php
App::uses('BackendAppModel', 'Backend.Model');
/**
 * Aco Model
 *
 * @property Aco $ParentAco
 * @property Aco $ChildAco
 * @property Aro $Aro
 */
class Aco extends BackendAppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Aro' => array(
			'className' => 'Aro',
			'joinTable' => 'aros_acos',
			'foreignKey' => 'aco_id',
			'associationForeignKey' => 'aro_id',
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
