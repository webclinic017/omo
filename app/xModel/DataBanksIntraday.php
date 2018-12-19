<?php
App::uses('AppModel', 'Model');
/**
 * DataBanksIntraday Model
 *
 * @property Market $Market
 * @property Instrument $Instrument
 */
class DataBanksIntraday extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    var $useDbConfig = 'mainsb';
	public $displayField = 'lm_date_time';


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
