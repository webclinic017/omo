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
    //var $useDbConfig = 'mainsb';
	//public $displayField = 'meta_key';


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
	protected function _findMetaList($state, $query, $results = array()) {

		if ($state === 'before') {

			//$query['conditions']="Trade.market_id=$market_id";
			$query['recursive']=0;
			return $query;
		}
		if ($state === 'after') {

			$results=Hash::combine($results, '{n}.Meta.id', '{n}');

		}

		return $results;
	}
	protected function _findMetaId($state, $query, $results = array()) {

		if ($state === 'before') {

			//$query['conditions']="Trade.market_id=$market_id";
			$query['recursive']=-1;
			$query['autocache'] = array('config' => 'minute');
			return $query;
		}
		if ($state === 'after') {

			$results=Hash::combine($results, '{n}.Meta.id', '{n}.Meta.meta_key');

		}

		return $results;
	}

}
