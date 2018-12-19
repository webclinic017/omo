<?php
App::uses('AppModel', 'Model');
/**
 * DataBankBlock Model
 *
 * @property Market $Market
 * @property Instrument $Instrument
 */
class DataBankBlock extends AppModel {

    var $useDbConfig = 'mainsb';

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
