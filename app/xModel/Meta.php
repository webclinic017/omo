<?php
App::uses('AppModel', 'Model');
/**
 * Meta Model
 *
 * @property MetaGroup $MetaGroup
 * @property EventInformation $EventInformation
 */
class Meta extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    var $useDbConfig = 'mainsb';
	public $displayField = 'meta_key';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'MetaGroup' => array(
			'className' => 'MetaGroup',
			'foreignKey' => 'meta_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'EventInformation' => array(
			'className' => 'EventInformation',
			'foreignKey' => 'meta_id',
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
