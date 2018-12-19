<?php
App::uses('AppModel', 'Model');
/**
 * SectorIntraday Model
 *
 * @property Market $Market
 * @property SectorList $SectorList
 */
class SectorIntraday extends AppModel {


    var $useDbConfig = 'mainsb';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
    public $actsAs = array('Containable');
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Market' => array(
			'className' => 'Market',
			'foreignKey' => 'market_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SectorList' => array(
			'className' => 'SectorList',
			'foreignKey' => 'sector_list_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
