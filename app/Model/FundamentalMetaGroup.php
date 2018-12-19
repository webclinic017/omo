<?php
App::uses('AppModel', 'Model');
/**
 * FundamentalMetaGroup Model
 *
 * @property FundamentalMeta $FundamentalMeta
 */
class FundamentalMetaGroup extends AppModel {

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
		'FundamentalMeta' => array(
			'className' => 'FundamentalMeta',
			'foreignKey' => 'fundamental_meta_group_id',
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
