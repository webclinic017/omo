<?php
App::uses('AppModel', 'Model');
/**
 * DataBankOddlot Model
 *
 * @property Market $Market
 * @property Instrument $Instrument
 */
class DataBankOddlot extends AppModel {

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
