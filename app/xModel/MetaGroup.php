<?php
App::uses('AppModel', 'Model');
/**
 * MetaGroup Model
 *
 * @property Meta $Meta
 */
class MetaGroup extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    var $useDbConfig = 'mainsb';
	public $displayField = 'group_key';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Meta' => array(
			'className' => 'Meta',
			'foreignKey' => 'meta_group_id',
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
