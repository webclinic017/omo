<?php
App::uses('AppModel', 'Model');
/**
 * Instrument Model
 *
 * @property Exchange $Exchange
 * @property Sector $Sector
 * @property CorporateAction $CorporateAction
 * @property DataBanksEod $DataBanksEod
 * @property DataBanksIntraday $DataBanksIntraday
 * @property Fundamental $Fundamental
 */
class Instrument extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    var $useDbConfig = 'mainsb';

    public $displayField = 'instrument_code';

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
		),
		'SectorList' => array(
			'className' => 'SectorList',
			'foreignKey' => 'sector_list_id',
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
		'CorporateAction' => array(
			'className' => 'CorporateAction',
			'foreignKey' => 'instrument_id',
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
		'DataBanksEod' => array(
			'className' => 'DataBanksEod',
			'foreignKey' => 'instrument_id',
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
		'DataBanksIntraday' => array(
			'className' => 'DataBanksIntraday',
			'foreignKey' => 'instrument_id',
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
		'Fundamental' => array(
			'className' => 'Fundamental',
			'foreignKey' => 'instrument_id',
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
