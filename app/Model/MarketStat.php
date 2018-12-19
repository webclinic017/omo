<?php
App::uses('AppModel', 'Model');
/**
 * MarketStat Model
 *
 * @property Market $Market
 * @property MarketMeta $MarketMeta
 */
class MarketStat extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    var $useDbConfig = 'mainsb';

	public $belongsTo = array(
		'Market' => array(
			'className' => 'Market',
			'foreignKey' => 'market_id',
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
