<?php
App::uses('AppModel', 'Model');
/**
 * Broker Model
 *
 * @property User $User
 */
class Broker extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
    public $displayField = 'broker_name';
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'broker_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
