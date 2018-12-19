<?php
App::uses('AppModel', 'Model');
/**
 * SectorList Model
 *
 * @property Exchange $Exchange
 * @property Instrument $Instrument
 * @property SectorIntraday $SectorIntraday
 */
class SectorList extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    var $useDbConfig = 'mainsb';
	public $displayField = 'name';

    public $actsAs = array('Containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Exchange' => array(
			'className' => 'Exchange',
			'foreignKey' => 'exchange_id',
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
		'Instrument' => array(
			'className' => 'Instrument',
			'foreignKey' => 'sector_list_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SectorIntraday' => array(
			'className' => 'SectorIntraday',
			'foreignKey' => 'sector_list_id',
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
