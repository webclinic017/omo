<?php
App::uses('AppModel', 'Model');
/**
 * UserMeta Model
 *
 * @property UsersInformation $UsersInformation
 */
class UserMeta extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'meta_key';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'UsersInformation' => array(
			'className' => 'UsersInformation',
			'foreignKey' => 'user_meta_id',
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
