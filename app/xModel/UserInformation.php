<?php
App::uses('AppModel', 'Model');
/**
 * UserInformation Model
 *
 * @property User $User
 * @property Meta $Meta
 */
class UserInformation extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'meta_id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Meta' => array(
			'className' => 'Meta',
			'foreignKey' => 'meta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
