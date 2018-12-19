<?php
App::uses('AppModel', 'Model');
/**
 * FundamentalMeta Model
 *
 * @property FundamentalMetaGroup $FundamentalMetaGroup
 * @property Fundamental $Fundamental
 */
class FundamentalMeta extends AppModel {

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
		'FundamentalMetaGroup' => array(
			'className' => 'FundamentalMetaGroup',
			'foreignKey' => 'fundamental_meta_group_id',
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
		'Fundamental' => array(
			'className' => 'Fundamental',
			'foreignKey' => 'fundamental_meta_id',
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
