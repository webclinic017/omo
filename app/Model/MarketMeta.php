<?php
App::uses('AppModel', 'Model');
/**
 * MarketMeta Model
 *
 * @property MarketStat $MarketStat
 */
class MarketMeta extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    var $useDbConfig = 'mainsb';
	public $displayField = 'meta_key';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'MarketStat' => array(
			'className' => 'MarketStat',
			'foreignKey' => 'market_meta_id',
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
