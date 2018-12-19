<?php
App::uses('AppModel', 'Model');
/**
 * DataBanksAdjustedEod Model
 *
 * @property Market $Market
 * @property Instrument $Instrument
 */
class DataBanksAdjustedEod extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    var $useDbConfig = 'mainsb';
	public $displayField = 'instrument_id';
    public $actsAs = array('Containable');

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
		'Instrument' => array(
			'className' => 'Instrument',
			'foreignKey' => 'instrument_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
