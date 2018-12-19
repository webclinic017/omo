<?php
App::uses('AppModel', 'Model');
/**
 * FundamentalMetasFundamentalMetaGroup Model
 *
 * @property FundamentalMeta $FundamentalMeta
 * @property FundamentalMetaGroup $FundamentalMetaGroup
 */
class FundamentalMetasFundamentalMetaGroup extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    var $useDbConfig = 'mainsb';

	public $belongsTo = array(
		'FundamentalMeta' => array(
			'className' => 'FundamentalMeta',
			'foreignKey' => 'fundamental_meta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FundamentalMetaGroup' => array(
			'className' => 'FundamentalMetaGroup',
			'foreignKey' => 'fundamental_meta_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
